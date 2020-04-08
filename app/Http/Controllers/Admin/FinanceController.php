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


class FinanceController extends Controller
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
        $user = \Auth::user();
        return view('admin.general_services_categories');
    }

     /**
     * Show the all services.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function coupons()
    {
        $user = \Auth::user();
        return view('admin.finance.coupons');
    }
    
    /**
     * [payments description]
     * @return [type] [description]
     */
    public function payments()
    {
         $data = [];
        $user = \Auth::user();
        $data['customers'] = DB::table('users')->where(['role' => 3,'status' => 'active'])->get()->toArray();        
        $data['employees'] = DB::table('users')->where(['role' => 2,'status' => 'active'])->get()->toArray();
        $data['serviceCats'] = DB::table('services_categories')->where(['status' => 'active'])->get()->toArray();
        $data['services'] = DB::table('services')->where(['status' => 'active'])->get()->toArray();
        return view('admin.finance.payments', $data);
    }

    /**
     * [getpaymentinfo description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getpaymentinfo(Request $request){
        if ($request->isMethod('post')) {
        $apiData = [];
        //check if there is filters 
        $columns = $request->get('columns');
        $whereCond = [];
        foreach($columns as $key => $val){
             if($val['search']['value']){
                switch ($val['data']) {
                    case 'paymentDueDate':
                                $datesArray = explode("|", $val['search']['value']);
                                array_push($whereCond, ['payment_info.payment_date', '>=', date("Y-m-d h:i:s", strtotime($datesArray[0]))]);
                                array_push($whereCond, ['payment_info.payment_date', '<=', date("Y-m-d h:i:s", strtotime($datesArray[1]))]);
                        break;

                    case 'customerName':
                          array_push($whereCond, ['payment_info.customer_id', '=', $val['search']['value']]);
                        break; 

                    case 'employeeName':
                          array_push($whereCond, ['payment_info.employee_id', '=', $val['search']['value']]);
                        break; 

                    case 'serviceName':
                          array_push($whereCond, ['payment_info.service', '=', $val['search']['value']]);
                        break;  

                    case 'paymentstatus':
                          array_push($whereCond, ['payment_info.payment_status', '=', $val['search']['value']]);
                        break;        

                }
             }
        }
                 if(!empty($whereCond)){
                       $getPaymentInfoDataCount = DB::table('payment_info')
                               ->leftJoin('users as customerData', 'payment_info.customer_id', '=', 'customerData.id')
                               ->leftJoin('users as EmployeeData', 'payment_info.employee_id', '=', 'EmployeeData.id')
                               ->leftJoin('services', 'payment_info.service_id', '=', 'services.id')
                               ->where($whereCond)
                               ->select('payment_info.id', 'payment_info.payment_date as paymentDueDate', 'payment_info.payment_status as paymentstatus', 'payment_info.payment_type', 'customerData.name as customerName', 'customerData.email as customerEmail', 'customerData.phone as customerPhone', 'EmployeeData.name as employeeName', 'services.name as serviceName', 'services.duration as serviceDuration', 'services.price as servicePrice')
                               ->orderBy('payment_info.payment_date', 'desc')
                               ->get()
                               ->toArray();

                        $getPaymentInfoData =DB::table('payment_info')
                                           ->leftJoin('users as customerData', 'payment_info.customer_id', '=', 'customerData.id')
                                           ->leftJoin('users as EmployeeData', 'payment_info.employee_id', '=', 'EmployeeData.id')
                                           ->leftJoin('services', 'payment_info.service_id', '=', 'services.id')
                                           ->where($whereCond)
                                           ->select('payment_info.id', 'payment_info.payment_date as paymentDueDate', 'payment_info.payment_status as paymentstatus', 'payment_info.payment_type', 'customerData.name as customerName', 'customerData.email as customerEmail', 'customerData.phone as customerPhone', 'EmployeeData.name as employeeName', 'services.name as serviceName', 'services.duration as serviceDuration', 'services.price as servicePrice')
                                           ->orderBy('payment_info.payment_date', 'desc')
                                           ->skip($request->get('start'))
                                           ->take($request->get('length'))
                                           ->get()
                                           ->toArray();

                    }else{
                        $getPaymentInfoDataCount = DB::table('payment_info')
                                                   ->leftJoin('users as customerData', 'payment_info.customer_id', '=', 'customerData.id')
                                                   ->leftJoin('users as EmployeeData', 'payment_info.employee_id', '=', 'EmployeeData.id')
                                                   ->leftJoin('services', 'payment_info.service_id', '=', 'services.id')
                                                   ->select('payment_info.id', 'payment_info.payment_date as paymentDueDate', 'payment_info.payment_status as paymentstatus', 'payment_info.payment_type', 'customerData.name as customerName', 'customerData.email as customerEmail', 'customerData.phone as customerPhone', 'EmployeeData.name as employeeName', 'services.name as serviceName', 'services.duration as serviceDuration', 'services.price as servicePrice')
                                                   ->orderBy('payment_info.payment_date', 'desc')
                                                   ->get()
                                                   ->toArray();

                    $getPaymentInfoData =DB::table('payment_info')
                                                   ->leftJoin('users as customerData', 'payment_info.customer_id', '=', 'customerData.id')
                                                   ->leftJoin('users as EmployeeData', 'payment_info.employee_id', '=', 'EmployeeData.id')
                                                   ->leftJoin('services', 'payment_info.service_id', '=', 'services.id')
                                                   ->select('payment_info.id', 'payment_info.payment_date as paymentDueDate', 'payment_info.payment_status as paymentstatus', 'payment_info.payment_type', 'customerData.name as customerName', 'customerData.email as customerEmail', 'customerData.phone as customerPhone', 'EmployeeData.name as employeeName', 'services.name as serviceName', 'services.duration as serviceDuration', 'services.price as servicePrice')
                                                   ->orderBy('payment_info.payment_date', 'desc')
                                           ->skip($request->get('start'))
                                           ->take($request->get('length'))
                                           ->get()
                                           ->toArray();

                    }
                               foreach ($getPaymentInfoData as $key => $paymentinfo) {
                                    $getPaymentInfoData[$key]->Actions = null;
                                    $getPaymentInfoData[$key]->ID = Crypt::encryptString($getPaymentInfoData[$key]->id);
                                    $getPaymentInfoData[$key]->paymenttDate = date("M d, Y", strtotime($paymentinfo->paymentDueDate));
                                }                      
        $apiData['iTotalRecords'] = count($getPaymentInfoData);
        $apiData['iTotalDisplayRecords'] = count($getPaymentInfoData);
        $apiData['sEcho'] = 0;
        $apiData['sColumns'] = "";
        $apiData['aaData'] = $getPaymentInfoData;
        return json_encode($apiData);
     }
    }

}

