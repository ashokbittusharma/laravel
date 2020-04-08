<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use Session;
use Illuminate\Support\Facades\DB;
use App\Model\Services_categories;
use App\Model\Services;
use App\Model\Appointments;
use App\Model\PaymentInfo;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class BookingController extends Controller
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
     * Show the service categories.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('/admin/booking/service-categories');
    }

    public function serviceCategoires(){
        /*Get All Services*/
        $data = [];
        $getServicesCat = DB::table('services_categories')->where(['status' => 'active'])->get()->toArray();
        $data['getServicesCat'] = $getServicesCat;
       return view('admin.services.services_categories', $data); 
    }
    /**
     * Show the all services.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function calendar()
    {
        $user = \Auth::user();
        return view('admin.calendar');
    }


     /**
     * Show the all services.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function allServices()
    {
        $user = \Auth::user();

        $getServices = DB::table('services')
                         ->leftjoin('services_categories', 'services.category_id', '=', 'services_categories.id')
                         ->where(['services.status' => 'active']) 
                         ->select('services.*', 'services_categories.name as cat', 'services_categories.id as catID')
                         ->get()
                         ->toArray();
        if(!empty($getServices)){
            foreach ($getServices as $key => $service) {
                $getString = $this->initials($service->name);
                $getServices[$key]->nameTag = (strlen($getString) > 2) ? substr($getString, 0, 2) : $getString;
            }
        }

        //Get subcategories
        $getServicescat = DB::table('services_categories')
                     ->where(['status' => 'active'])
                     ->get()
                     ->toArray();

        $data['getServices'] = $getServices;
        $data['getServicescat'] = $getServicescat;
        return view('admin.services.services_all', $data);
    }


    public function addServiceCategory(Request $request){

        if($request->get('category')){
           $Services_categories = new Services_categories;
           $Services_categories->name = $request->get('category');
           $Services_categories->slug = $this->create_slug(strtolower($request->get('category')));          
           $Services_categories->save();
           return response()->json(['status' => 'success', 'message' =>'Service Category has been added successfully.']);
        }else{
            return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
        }
    }

    /*
    * @update service categories 
    **/

    public function updateServiceCategory(Request $request){
       if($request->get('category')){
           $Services_categories = Services_categories::find(base64_decode(base64_decode($request->get('category_id'))));
           $Services_categories->name = $request->get('category');
           $Services_categories->slug = $this->create_slug(strtolower($request->get('category')));          
           $Services_categories->save();
           return response()->json(['status' => 'success', 'message' =>'Service Category has been updated successfully.']);
        }else{
            return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
        } 
    }
    
    /**
    *@ create slug
    **/
    function create_slug($string){
       $slug=preg_replace('/[^A-Za-z0-9-]+/', '_', $string);
       return $slug;
    }

    public function deleteServiceCategory(Request $request){

        if($request->get('serviceCat')){
           $serviceCat = Services_categories::find(base64_decode(base64_decode($request->get('serviceCat'))));
           $serviceCat->status = 'deleted';
           $serviceCat->save();
           return response()->json(['status' => 'success', 'message' =>'Service category has been deleted successfully.']);
        }else{
            return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
        }
    }


    /**
     *
    */
    public function addService(Request $request){
        $validatorInputs = [];
        $validatorInputs['service_name'] = 'required';
        $validatorInputs['service_category'] = 'required';
        $validatorInputs['service_duration'] = 'required';
         if($request->file('service_avatar')){
            $validatorInputs['service_avatar'] = 'image';
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
           if($request->file('service_avatar')){
                 $avatar = time().'.'.$request->file('service_avatar')->extension();
                 $request->service_avatar->move(public_path('backend/media/services'), $avatar);
            }

            $Services = new Services();
            $Services->name = $request->get('service_name');
            $Services->category_id = $request->get('service_category');
            $Services->duration = $request->get('service_duration');
            $Services->price = $request->get('service_price');
            $Services->btb = $request->get('service_btb');
            $Services->bta = $request->get('service_bta');
            if ($request->get('service_paymentoption_onsite')) {
                $Services->payment_onsite = 'yes';
            }else{
                $Services->payment_onsite = 'no';
            }
            if ($request->get('service_paymentoption_stripe')) {
                $Services->payment_stripe = 'yes';
            }else{
                $Services->payment_stripe = 'no';
            }
            $Services->description = $request->get('note');

            if($request->file('service_avatar')){
                $Services->cat_img = $avatar;
            }
                    
            $Services->save();
            if(!empty($Services->id)){
                return response()->json(['status' => 'success','service' => $Services->id,'message'=>'Service has been inserted successfully.']);
            }
            else{
                return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
            }            
     
        }
    }

    public function initials($str) {
        $ret = '';
        foreach (explode(' ', $str) as $word)
            $ret .= strtoupper($word[0]);
        return $ret;
    }
//delete a service
    public function deleteService(Request $request){
         if(!empty($request->get('serviceID'))){
           $serviceCat = Services::find(base64_decode(base64_decode($request->get('serviceID'))));
           $serviceCat->status = 'deleted';
           $serviceCat->save();
           return response()->json(['status' => 'success', 'message' =>'Service has been deleted successfully.']);
        }else{
            return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
        }
    }
//get a service
    public function getEditingService(Request $request){
        if (!empty($request->get('serviceID'))) {
            $getServices = DB::table('services')
                         ->leftjoin('services_categories', 'services.category_id', '=', 'services_categories.id')
                         ->where(['services.id' => base64_decode(base64_decode($request->get('serviceID')))]) 
                         ->select('services.*', 'services_categories.name as cat', 'services_categories.id as catID')
                         ->get()
                         ->toArray();
            if(!empty($getServices)){
            return response()->json(['status' => 'success', 'serviceData'=> $getServices[0],'message' =>'Service info']);
          }else{
            return response()->json(['status' => 'error','message'=>'This service is not found.']); 
          }

        }else{
             return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);   
        }
        
        
    }


    public function editService(Request $request){
        $validatorInputs = [];
        $validatorInputs['service_name'] = 'required';
        $validatorInputs['service_category'] = 'required';
        $validatorInputs['service_duration'] = 'required';
         if($request->file('service_avatar')){
            $validatorInputs['service_avatar'] = 'image';
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
           if($request->file('service_avatar')){
                 $avatar = time().'.'.$request->file('service_avatar')->extension();
                 $request->service_avatar->move(public_path('backend/media/services'), $avatar);
            }

            $Services = Services::find($request->get('service'));
            $Services->name = $request->get('service_name');
            $Services->category_id = $request->get('service_category');
            $Services->duration = $request->get('service_duration');
            $Services->price = $request->get('service_price');
            $Services->btb = $request->get('service_btb');
            $Services->bta = $request->get('service_bta');
            if ($request->get('service_paymentoption_onsite')) {
                $Services->payment_onsite = 'yes';
            }else{
                $Services->payment_onsite = 'no';
            }
            if ($request->get('service_paymentoption_stripe')) {
                $Services->payment_stripe = 'yes';
            }else{
                $Services->payment_stripe = 'no';
            }
            $Services->description = $request->get('note');

            if($request->file('service_avatar')){
                $Services->cat_img = $avatar;
            }     
            $Services->save();
                return response()->json(['status' => 'success', 'message'=>'Service has been updated successfully.']);
                    
     
        }
    }
    
    public function getService(Request $request){
       if(!empty($request->get('serviceCat'))){
           $getServices = DB::table('services')
                         ->where(['category_id' => $request->get('serviceCat'), 'status' => 'active']) 
                         ->select('id', 'name')
                         ->get()
                         ->toArray();
            if(!empty($getServices)){
               return response()->json(['status' => 'success', 'serviceData'=> $getServices,'message' =>'Service info']);
            }else{
              return response()->json(['status' => 'error','message'=>'There is no services under this selected category.']);
            }
            
       }else{
          return response()->json(['status' => 'error','message'=>'There is no services under this selected category.']); 
       }
    }

    public function appointments(){
        
        $data = [];
        $user = \Auth::user();
        $data['customers'] = DB::table('users')->where(['role' => 3,'status' => 'active'])->get()->toArray();        
        $data['employees'] = DB::table('users')->where(['role' => 2,'status' => 'active'])->get()->toArray();
        $data['serviceCats'] = DB::table('services_categories')->where(['status' => 'active'])->get()->toArray();
        $data['services'] = DB::table('services')->where(['status' => 'active'])->get()->toArray();
        
        return view('admin.appointments.appointmentsListing', $data);
    }

    /**
     * [getAppointments description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getAppointments(Request $request){
       // print_r($request->all());
        if ($request->isMethod('post')) {
            $apiData = [];
        //check if there is filters 
        $columns = $request->get('columns');
        $whereCond = [];
        foreach($columns as $key => $val){
             if($val['search']['value']){
                switch ($val['data']) {
                    case 'appointmentDate':
                                $datesArray = explode("|", $val['search']['value']);
                                array_push($whereCond, ['appointments.appointment_datetime', '>=', date("Y-m-d h:i:s", strtotime($datesArray[0]. ' 00:00:00'))]);
                                array_push($whereCond, ['appointments.appointment_datetime', '<=', date("Y-m-d h:i:s", strtotime($datesArray[1]. '23:59:00'))]);
                        break;

                    case 'customerName':
                          array_push($whereCond, ['appointments.customer', '=', $val['search']['value']]);
                        break; 

                    case 'employeeName':
                          array_push($whereCond, ['appointments.employee', '=', $val['search']['value']]);
                        break; 

                    case 'serviceName':
                          array_push($whereCond, ['appointments.service', '=', $val['search']['value']]);
                        break;  

                    case 'appointmentstatus':
                          array_push($whereCond, ['appointments.status', '=', $val['search']['value']]);
                        break;        

                }
             }
        }
        if(!empty($whereCond)){
           $getAppointmentsDataCount = DB::table('appointments')
                               ->leftJoin('users as customerData', 'appointments.customer', '=', 'customerData.id')
                               ->leftJoin('users as EmployeeData', 'appointments.employee', '=', 'EmployeeData.id')
                               ->leftJoin('services', 'appointments.service', '=', 'services.id')
                               ->where($whereCond)
                               ->select('appointments.id', 'appointments.appointment_datetime as appointmentDate', 'appointments.status as appointmentstatus', 'customerData.name as customerName', 'customerData.email as customerEmail', 'customerData.phone as customerPhone', 'EmployeeData.name as employeeName', 'services.name as serviceName', 'services.duration as serviceDuration', 'services.price as servicePrice')
                               ->orderBy('appointments.created_at', 'desc')
                               ->get()
                               ->toArray();
        $getAppointmentsData = DB::table('appointments')
                               ->leftJoin('users as customerData', 'appointments.customer', '=', 'customerData.id')
                               ->leftJoin('users as EmployeeData', 'appointments.employee', '=', 'EmployeeData.id')
                               ->leftJoin('services', 'appointments.service', '=', 'services.id')
                               ->select('appointments.id', 'appointments.appointment_datetime as appointmentDate', 'appointments.status as appointmentstatus', 'customerData.name as customerName', 'customerData.email as customerEmail', 'customerData.phone as customerPhone', 'EmployeeData.name as employeeName', 'services.name as serviceName', 'services.duration as serviceDuration', 'services.price as servicePrice')
                               ->where($whereCond)
                               ->orderBy('appointments.created_at', 'desc')
                               ->skip($request->get('start'))
                               ->take($request->get('length'))
                               ->get()
                               ->toArray();

        }else{
            $getAppointmentsDataCount = DB::table('appointments')
                               ->leftJoin('users as customerData', 'appointments.customer', '=', 'customerData.id')
                               ->leftJoin('users as EmployeeData', 'appointments.employee', '=', 'EmployeeData.id')
                               ->leftJoin('services', 'appointments.service', '=', 'services.id')
                               ->select('appointments.id', 'appointments.appointment_datetime as appointmentDate', 'appointments.status as appointmentstatus', 'customerData.name as customerName', 'customerData.email as customerEmail', 'customerData.phone as customerPhone', 'EmployeeData.name as employeeName', 'services.name as serviceName', 'services.duration as serviceDuration', 'services.price as servicePrice')
                               ->orderBy('appointments.created_at', 'desc')
                               ->get()
                               ->toArray();
        $getAppointmentsData = DB::table('appointments')
                               ->leftJoin('users as customerData', 'appointments.customer', '=', 'customerData.id')
                               ->leftJoin('users as EmployeeData', 'appointments.employee', '=', 'EmployeeData.id')
                               ->leftJoin('services', 'appointments.service', '=', 'services.id')
                               ->select('appointments.id', 'appointments.appointment_datetime as appointmentDate', 'appointments.status as appointmentstatus', 'customerData.name as customerName', 'customerData.email as customerEmail', 'customerData.phone as customerPhone', 'EmployeeData.name as employeeName', 'services.name as serviceName', 'services.duration as serviceDuration', 'services.price as servicePrice')
                               ->orderBy('appointments.created_at', 'desc')
                               ->skip($request->get('start'))
                               ->take($request->get('length'))
                               ->get()
                               ->toArray();

        }
        
       foreach ($getAppointmentsData as $key => $appointment) {
            $getAppointmentsData[$key]->Actions = null;
             $getAppointmentsData[$key]->ID = Crypt::encryptString($getAppointmentsData[$key]->id);
            $getAppointmentsData[$key]->appointmentDate = date("M d, Y", strtotime($appointment->appointmentDate));
        }                      
        $apiData['iTotalRecords'] = count($getAppointmentsDataCount);
        $apiData['iTotalDisplayRecords'] = count($getAppointmentsDataCount);
        $apiData['sEcho'] = 0;
        $apiData['sColumns'] = "";
        $apiData['aaData'] = $getAppointmentsData;
        return json_encode($apiData);
        }
        
    }

   /**
    * createAppointment()
    * @param  Request
    * @return json
    */
    public function createAppointment(Request $request){
        $validatorInputs = [];
        $validatorInputs['customer'] = 'required';
        $validatorInputs['serviceCategory'] = 'required';
        $validatorInputs['service'] = 'required';
        $validatorInputs['appointment_date'] = 'required';
        $validatorInputs['appointment_time'] = 'required';
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
           $date = $request->get('appointment_date');
           $time = $request->get('appointment_time');

           //Appointment Record
            $appointment = new Appointments();
            $appointment->customer = $request->get('customer');
            $appointment->employee = $request->get('assignEmployee');
            $appointment->service_cat = $request->get('serviceCategory');
            $appointment->service = $request->get('service');
            $appointment->appointment_datetime = date('Y-m-d H:i:s', strtotime("$date $time"));
            $appointment->note = $request->get('note');
            $appointment->payment_method = $request->get('payment_method');
            if($request->get('customer_notify')){
                $appointment->notify_customer = 'yes';
            }else{
                $appointment->notify_customer = 'no';
            }          
            $appointment->save();

            //payment record
            $paymentInfo = new PaymentInfo();
            $paymentInfo->appointment_id = $appointment->id;
            $paymentInfo->payment_type = $request->get('payment_method');
            $paymentInfo->customer_id = $request->get('customer');
            $paymentInfo->employee_id = $request->get('assignEmployee');
            $paymentInfo->service_id = $request->get('service');
            $paymentInfo->payment_date = date('Y-m-d H:i:s', strtotime("$date $time"));                    
            $paymentInfo->save();


            if(!empty($paymentInfo->id)){
                return response()->json(['status' => 'success','appointment' => $appointment->id, 'payemntinfo' => $paymentInfo->id, 'message'=>'Appointment has been created successfully.']);
            }
            else{
                return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
            }            
     
        }
    }

    /**
     * [editAppointments description]
     * @param  Request $request       [description]
     * @param  [type]  $appointmentID [description]
     * @return [type]                 [description]
     */
    public function editAppointments(Request $request, $id){
        $data = [];
        $user = \Auth::user();
        try {
                $id = Crypt::decryptString($id);
            } catch (DecryptException $e) {
                return redirect()->route('appointments')->with('error','You have no permission for this page!');
            }
        $appointmentData = DB::table('appointments')->where(['id' => $id ])->get()->toArray();
        $appointmentDateTime =  $appointmentData[0]->appointment_datetime;
        $appointmentData[0]->date = date('M d, Y', strtotime($appointmentData[0]->appointment_datetime));
         $appointmentData[0]->time = date('h:i:s A', strtotime($appointmentData[0]->appointment_datetime));
        $data['appointment'] = $appointmentData[0];
        if($appointmentData){
            $data['customers'] = DB::table('users')->where(['role' => 3,'status' => 'active'])->get()->toArray();   
            $data['selectedCustomers'] = DB::table('users')->where(['id'=>$appointmentData[0]->customer,'role' => 3,'status' => 'active'])->get()->toArray();      
            $data['employees'] = DB::table('users')->where(['role' => 2,'status' => 'active'])->get()->toArray();
            $data['serviceCats'] = DB::table('services_categories')->where(['status' => 'active'])->get()->toArray();
            $data['services'] = DB::table('services')->where(['id'=> $appointmentData[0]->service,'status' => 'active'])->get()->toArray();
            $data['paymentinfo'] = DB::table('payment_info')->where(['appointment_id'=> $appointmentData[0]->id])->get()->toArray();

        return view('admin.appointments.editAppointments', $data);
        }else{
         return redirect()->route('appointments')->with('error','You have no permission for this page!');
        }
        
    }
    
    /**
     * [editAppointmentsdetail description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function editAppointmentsdetail(Request $request){
        $validatorInputs = [];
        $validatorInputs['customer'] = 'required';
        $validatorInputs['serviceCategory'] = 'required';
        $validatorInputs['service'] = 'required';
        $validatorInputs['appointment_date'] = 'required';
        $validatorInputs['appointment_time'] = 'required';
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
           $date = $request->get('appointment_date');
           $time = $request->get('appointment_time');

           //Appointment Record
            $appointment = Appointments::find($request->get('appointment'));
            $appointment->customer = $request->get('customer');
            $appointment->employee = $request->get('assignEmployee');
            $appointment->service_cat = $request->get('serviceCategory');
            $appointment->service = $request->get('service');
            $appointment->appointment_datetime = date('Y-m-d H:i:s', strtotime("$date $time"));
            $appointment->note = $request->get('note');
            $appointment->payment_method = $request->get('payment_method');
            if($request->get('customer_notify')){
                $appointment->notify_customer = 'yes';
            }else{
                $appointment->notify_customer = 'no';
            }          
            $appointment->save();

            //payment record
            DB::table('payment_info')
            ->where('appointment_id', $request->get('appointment'))
            ->update(['payment_type' => $request->get('payment_method'), 'customer_id' => $request->get('customer'), 'employee_id' => $request->get('assignEmployee'), 'service_id' => $request->get('service'), 'payment_date' => date('Y-m-d H:i:s', strtotime("$date $time"))]);

           // if(!empty($paymentInfo->id)){
                return response()->json(['status' => 'success','message'=>'Appointment has been updated successfully.']);
           // }
            //else{
             //   return response()->json(['status' => 'error','message'=>'Somthing went wrong.']);
            //}            
     
        }
    }
}
