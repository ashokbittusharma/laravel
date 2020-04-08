<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Carbon;


class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the Employee listing.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();        
        return view('admin.listingEmployee');
    }

     /**
     * Show the add employee.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add()
    {
        $user = \Auth::user();
        return view('admin.addEmployee');
    }

    /**
     * Show the Add employee's detail.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */ 
    public function registerEmployee(Request $request){
    	$validatorInputs = [];
    	$validatorInputs['profile_first_name'] = 'required';
    	$validatorInputs['profile_last_name'] = 'required';
    	$validatorInputs['profile_email'] = 'required|email|unique:users,email';
    	$validatorInputs['profile_phone'] = 'required';
    	 if($request->file('kt_apps_user_add_user_avatar')){
	    	$validatorInputs['kt_apps_user_add_user_avatar'] = 'image';
	    }
        $validator = Validator::make($request->all(), $validatorInputs);
        if ($validator->fails())
            {
                $html='';
                foreach ($validator->getMessageBag()->toArray() as $key => $value) {
                   $html .= $value[0].'.';
                }
                 return response()->json(['status' => 'error','message'=> $html]); die;
        }
        if ($validator->passes()) {
           if($request->file('kt_apps_user_add_user_avatar')){
                 $avatar = time().'.'.$request->file('kt_apps_user_add_user_avatar')->extension();
                 $request->kt_apps_user_add_user_avatar->move(public_path('backend/media/users'), $avatar);
        	}

            $user = new User();
            $user->name = $request->get('profile_first_name').' '.$request->get('profile_last_name');
            $user->fname = $request->get('profile_first_name');
            $user->lname = $request->get('profile_last_name');
            $user->email = $request->get('profile_email');
            if($request->file('kt_apps_user_add_user_avatar')){
	            $user->avatar = $avatar;
	        }
            $user->password = Hash::make('12345');
            $user->note = $request->get('note');
            if(!empty($request->get('dob'))){
                $user->dob = date("Y-m-d", strtotime($request->get('dob')));
            }
            if(!empty($request->get('profile_phone'))){
            	$user->phone = $request->get('profile_phone');
            }
            if(!empty($request->get('gender'))){
            	$user->gender = $request->get('gender');
            }
            $user->role = '2';          
            $user->save();
            if(!empty($user->id)){
                return response()->json(['status' => 'success','user' => $user->id,'message'=>'Employee has been register successfully.']);
            }
            else{
                return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
            }            
     
        }
         
    }

     /**
     * Show the edit employee.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request, $eid)
    {   if ($eid) {
	    	$data = [];
	        $user = \Auth::user();
	        $getEmployeeInfo = DB::table('users')->select('name', 'fname', 'lname', 'email', 'phone', 'gender', 'dob', 'avatar', 'note')->where('id', Crypt::decryptString($eid))->get()->toArray(); 
	        $getEmployeeInfo[0]->dob = date("F d, Y", strtotime($getEmployeeInfo[0]->dob));
	        $getEmployeeInfo[0]->id = $eid;
	        $data['getEmpInfo'] = $getEmployeeInfo[0];
	        return view('admin.editEmployee', $data);
	    }else
	    {

	    	return redirect('/admin/employees');
	    }
        
    }

    public function editEmployee(Request $request){
    	$validatorInputs = [];
    	$validatorInputs['profile_first_name'] = 'required';
    	$validatorInputs['profile_last_name'] = 'required';
    	$validatorInputs['profile_phone'] = 'required';
    	 if($request->file('kt_apps_user_add_user_avatar')){
	    	$validatorInputs['kt_apps_user_add_user_avatar'] = 'image';
	    }
        $validator = Validator::make($request->all(), $validatorInputs);
        if ($validator->fails())
            {
                $html='';
                foreach ($validator->getMessageBag()->toArray() as $key => $value) {
                   $html .= $value[0].'.';
                }
                 return response()->json(['status' => 'error','message'=> $html]); die;
        }
        if ($validator->passes()) {
           if($request->file('kt_apps_user_add_user_avatar')){
                 $avatar = time().'.'.$request->file('kt_apps_user_add_user_avatar')->extension();
                 $request->kt_apps_user_add_user_avatar->move(public_path('backend/media/users'), $avatar);
        	}
            $user = User::find(Crypt::decryptString($request->get('userid')));

			$user->name = $request->get('profile_first_name').' '.$request->get('profile_last_name');
            $user->fname = $request->get('profile_first_name');
            $user->lname = $request->get('profile_last_name');
            if($request->file('kt_apps_user_add_user_avatar')){
	            $user->avatar = $avatar;
	        }
            $user->password = Hash::make('12345');
            $user->note = $request->get('note');
            if(!empty($request->get('dob'))){
                $user->dob = date("Y-m-d", strtotime($request->get('dob')));
            }
            if(!empty($request->get('profile_phone'))){
            	$user->phone = $request->get('profile_phone');
            }
            if(!empty($request->get('gender'))){
            	$user->gender = $request->get('gender');
            }           
                   
            $user->save();
            if(!empty($user->id)){
                return response()->json(['status' => 'success','user' => $user->id,'message'=>'Employee has been updated successfully.']);
            }
            else{
                return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
            }            
     
        }
         
    }
     /**
     * Show all employees.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAllEmployees(Request $request)
    {
    	$pagination = $request->get('pagination');
    	$page = (!empty($pagination['page'])) ? $pagination['page'] : 1;
        $perpage = (!empty($pagination['perpage'])) ? $pagination['perpage'] : 10;


        //$limit = ($page == 1 ) ? 1 : 5 * $page;
        $jsonResponse = $data = $meta = []; 
        $curentuser = \Auth::user();
        $totalemployees = DB::table('users')->where(['role' => '2', 'status' => 'active'])->get()->toArray(); 
        $employees = DB::table('users')->where(['role' => '2', 'status' => 'active'])->skip($perpage * ($page -1))->take($perpage)->get()->toArray();  
        if(!empty($employees)){
            $meta =  ["page" =>  $page, "pages" => (array_key_exists('pages', $pagination)) ? $pagination['pages'] : floor(count($totalemployees)/$perpage), "perpage" => $perpage, "total" => count($totalemployees), "sort" => "asc", "field" => "RecordID", "query" => DB::table('users')->where(['role' => '2', 'status' => 'active'])->skip($perpage * ($page -1))->take($perpage)->toSql()];
            $count = 1;
            foreach ($employees as $key => $value) {
            	$value->RecordID = $count;
                $value->eid = Crypt::encryptString($value->id);
            	$value->nameTag = ($value->name) ? $this->initials($value->name) : '';
            	if($value->avatar){
            		if (file_exists( public_path() . '/backend/media/users/'.$value->avatar)) {
            			$value->avatar = '/backend/media/users/'.$value->avatar;
            		}else{
            			$value->avatar = '';

            		}
            		
            	}
            	array_push($data, $value); 
            	$count++;
            }
        }else{

        }
        $jsonResponse =['meta' => $meta, 'data' => $data];
        return response()->json($jsonResponse);
    }

    public function initials($str) {
        $ret = '';
        foreach (explode(' ', $str) as $word)
            $ret .= strtoupper($word[0]);
        return $ret;
    }


public function deleteEmployee(Request $request){

        if($request->get('user')){
           $user = User::find(Crypt::decryptString($request->get('user')));
           $user->status = 'deleted';
           $user->save();
           return response()->json(['status' => 'success', 'message' =>'Customer has been deleted successfully.']);
        }else{
            return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
        }
    }
    
}
