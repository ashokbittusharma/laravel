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


class CustomerController extends Controller
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
        return view('admin.listingCustomer');
    }

     /**
     * Show the add employee.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add()
    {
        $user = \Auth::user();
        return view('admin.addCustomer');
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
            $getCustomerInfo = DB::table('users')->select('name', 'fname', 'lname', 'email', 'phone', 'gender', 'dob', 'avatar', 'note')->where('id', Crypt::decryptString($eid))->get()->toArray(); 
            $getCustomerInfo[0]->dob = date("F d, Y", strtotime($getCustomerInfo[0]->dob));
            $getCustomerInfo[0]->id = $eid;
            $data['getCustomerInfo'] = $getCustomerInfo[0];
            return view('admin.editCustomer', $data);
        }else
        {

            return redirect('/admin/customers');
        }
        
    }

    public function registerCustomer(Request $request){
        $validatorInputs = [];
        $validatorInputs['customer_first_name'] = 'required';
        $validatorInputs['customer_last_name'] = 'required';
        $validatorInputs['customer_email'] = 'required|email|unique:users,email';
        $validatorInputs['customer_phone'] = 'required';
        $validatorInputs['customer_gender'] = 'required';
        $validatorInputs['customer_dob'] = 'required';
         if($request->file('kt_apps_customer_add_customer_avatar')){
            $validatorInputs['kt_apps_customer_add_customer_avatar'] = 'image';
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
             $user = new User();
            if(!empty($request->file('kt_apps_customer_add_customer_avatar'))){
             $avatar = time().'.'.$request->file('kt_apps_customer_add_customer_avatar')->extension();
             $request->kt_apps_customer_add_customer_avatar->move(public_path('backend/media/users'), $avatar);    
             $user->avatar = $avatar;
            }
            $user->name = $request->get('customer_first_name').' '.$request->get('customer_last_name');
            $user->fname = $request->get('customer_first_name');
            $user->lname = $request->get('customer_last_name');
            $user->email = $request->get('customer_email');
            $user->phone = $request->get('customer_phone');
            $user->gender = $request->get('customer_gender');
            $user->dob = date("Y-m-d", strtotime($request->get('customer_dob')));            
            $user->password = Hash::make('12345');
            $user->note = $request->get('note');
            $user->role = '3';          
            $user->save();
            if(!empty($user->id)){
                return response()->json(['status' => 'success', 'user' => $user->id, 'username' => $request->get('customer_first_name').' '.$request->get('customer_last_name'), 'message'=>'Customer has been register successfully.']);
            }
            else{
                return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
            }
     
        }

    }

    /**
     * Show all customers.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAllCustomers(Request $request)
    {
        $pagination = $request->get('pagination');
        $page = (!empty($pagination['page'])) ? $pagination['page'] : 1;
        $perpage = (!empty($pagination['perpage'])) ? $pagination['perpage'] : 10;


        //$limit = ($page == 1 ) ? 1 : 5 * $page;
        $jsonResponse = $data = $meta = []; 
        $curentuser = \Auth::user();
        $totalcustomers = DB::table('users')->where(['role' => '3', 'status' => 'active'])->get()->toArray(); 
       // print_r($totalemployees); die;
        $customers = DB::table('users')->where(['role' => '3', 'status' => 'active'])->skip($perpage * ($page -1))->take($perpage)->get()->toArray();  
        if(!empty($customers)){
            $meta =  ["page" =>  $page, "pages" => (array_key_exists('pages', $pagination)) ? $pagination['pages'] : floor(count($totalcustomers)/$perpage), "perpage" => $perpage, "total" => count($totalcustomers), "sort" => "asc", "field" => "RecordID", "query" => DB::table('users')->where(['role' => '3', 'status' => 'active'])->skip($perpage * ($page -1))->take($perpage)->toSql()];
            $count = 1;
            foreach ($customers as $key => $value) {
                $value->RecordID = $count;
                $value->eid = Crypt::encryptString($value->id);
                $value->nameTag = ($value->name) ? $this->initials($value->name) : '';
                if(!empty($value->avatar)){
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
    

    public function editCustomer(Request $request){
        $validatorInputs = [];
        $validatorInputs['customer_first_name'] = 'required';
        $validatorInputs['customer_last_name'] = 'required';
        $validatorInputs['customer_phone'] = 'required';
        $validatorInputs['customer_gender'] = 'required';
        $validatorInputs['customer_dob'] = 'required';
         if($request->file('kt_apps_customer_add_customer_avatar')){
            $validatorInputs['kt_apps_customer_add_customer_avatar'] = 'image';
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
            $user = User::find(Crypt::decryptString($request->get('userid')));
            if(!empty($request->file('kt_apps_customer_add_customer_avatar'))){
             $avatar = time().'.'.$request->file('kt_apps_customer_add_customer_avatar')->extension();
             $request->kt_apps_customer_add_customer_avatar->move(public_path('backend/media/users'), $avatar);    
             $user->avatar = $avatar;
            }
            $user->name = $request->get('customer_first_name').' '.$request->get('customer_last_name');
            $user->fname = $request->get('customer_first_name');
            $user->lname = $request->get('customer_last_name');
            $user->phone = $request->get('customer_phone');
            $user->gender = $request->get('customer_gender');
            $user->dob = date("Y-m-d", strtotime($request->get('customer_dob')));            
            $user->note = $request->get('note');
            $user->role = '3';          
            $user->save();
            if(!empty($user->id)){
                return response()->json(['status' => 'success', 'user' => $user->id,'message'=>'Customer info has been updated successfully.']);
            }
            else{
                return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
            }
     
        }       
    }

    public function deleteCustomer(Request $request){

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
