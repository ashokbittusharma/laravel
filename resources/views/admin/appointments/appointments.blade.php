@extends('layouts.admin')

@section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Appointments
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        </div>
        <div class="kt-subheader__toolbar">
            <button id="addAppointmentBTN" type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addAppointmentModal">Add Appointment</button>
        </div>
    </div>
</div>

<!-- end:: Content Head -->
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    @include('../../flash-message')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__body kt-portlet__body--fit">

            <!--begin: Datatable -->
            <div class="kt-datatable" id="kt_apps_user_list_datatable"></div>

            <!--end: Datatable -->
        </div>
    </div>

    <!--end::Portlet-->

    <!--begin::Modal-->
    <div class="modal fade" id="kt_datatable_records_fetch_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selected Records</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="kt-scroll" data-scroll="true" data-height="200">
                        <ul id="kt_apps_user_fetch_records_selected"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-brand" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->
</div>


<!-- Modal add appointments -->
<div class="modal fade" id="addAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="addServicsLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><!--start-->
      
        
            <!--begin: Form Wizard Form-->
            <form class="kt-form" id="addAppointmentForm">
               @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="kt-section__body">
                             <div class="form-group row">
                                <div class="col-lg-6 col-xl-6">
                                    <label class="col-xl-12 col-lg-12 col-form-label">Customer:</label>
                                    <div class="col-lg-12 col-xl-12">

                                      <div class="input-group">
                                        <select name="customer" id="selectCustomerAppointment" class="form-control kt-selectpicker">
                                            <option value="">Select</option>
                                            @foreach($customers as $customer)  
                                             <option value="{{$customer->id}}">{{$customer->name}}</option>
                                            @endforeach 
                                        </select> 
                                        <span class="input-group-append">
                                        <button class="btn btn-default" type="button" tabindex="-1" id="addNewCustomer">Add<span class="la la-user-plus" aria-hidden="true"></span></button>
                                      </span>
                                      </div> 
                                      <!-- <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div> -->


                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6">
                                <label class="col-xl-12 col-lg-12 col-form-label">Assign to Employee</label>
                                    <div class="col-lg-12 col-xl-12">
                                        <select name="assignEmployee" class="form-control kt-selectpicker">
                                        <option value="">Select</option>
                                       @foreach($employees as $employee)  
                                         <option value="{{$employee->id}}">{{$employee->name}}</option>
                                        @endforeach

                                    </select>           
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6 col-xl-6">
                                <label class="col-xl-12 col-lg-12 col-form-label">Service Category</label>
                                    <div class="col-lg-12 col-xl-12">
                                       <select class="form-control kt-selectpicker addServiceCategory" name="serviceCategory"onchange="getservices(this)">
                                        <option value="">Select</option>
                                        @foreach($serviceCats as $serviceCat)  
                                         <option value="{{$serviceCat->id}}">{{$serviceCat->name}}</option>
                                        @endforeach    
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6">
                                <label class="col-xl-12 col-lg-12 col-form-label">Service</label>
                                    <div class="col-lg-12 col-xl-12">
                                        <select class="form-control kt-selectpicker servicesAdd" name="service">
                                        <option value="">Select</option>
                                        @foreach($serviceCats as $serviceCat)  
                                         <option value="{{$serviceCat->id}}">{{$serviceCat->name}}</option>
                                        @endforeach    
                                        </select>          
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-xl-6">
                                <label class="col-xl-12 col-lg-12 col-form-label">Date</label>
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="input-group date">
                                            <input type="text" class="form-control" readonly="" placeholder="Select date" id="datepicker" name="appointment_date">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6">
                                <label class="col-xl-12 col-lg-12 col-form-label">Time</label>
                                    <div class="col-lg-12 col-xl-12">
                                       <div class="input-group timepicker">
                                            <div class="input-group timepicker">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-exclamation-circle"></i>
                                                </span>
                                            </div>
                                            <input class="form-control" id="timepicker" readonly="" value="00:00:00 AM" type="text" name="appointment_time">
                                        </div>
                                       </div>        
                                    </div>
                                </div>
                            </div>
                                <!-- Default checked -->
                             <div class="form-group row">
                                <div class="col-lg-6 col-xl-6">
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand" data-skin="dark"  data-toggle="kt-tooltip" data-placement="top" data-original-title="Check this checkbox if you want your customer to
receive an email about the scheduled appointment.">
                                    <input type="checkbox" checked="checked" name="customer_notify">Notify the customer(s)<span></span>
                                </label>
                                </div>
                                <div class="col-lg-6 col-xl-6">
                                 <label class="col-xl-12 col-lg-12 col-form-label">Payment Method</label>
                                    <div class="col-lg-12 col-xl-12">
                                        <select class="form-control kt-selectpicker" name="payment_method">
                                        <option value="onsite">onSite</option>
                                        <option value="stripe">Stripe</option>   
                                        </select>          
                                    </div>
                                </div>
                            </div>    




                            <div class="col-lg-6 col-xl-6">    
                                
                            </div>    
                          
                            <div class="form-group form-group-last">
                                <label class="col-xl-12 col-lg-12 col-form-label">Note (Internal)</label>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="input-group">
                                        <textarea name="note" class="form-control" id="service_description" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>

                            



                        </div>
                    </div>
                </div>
                            
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="$('#addAppointmentForm').submit();" id="saveAppointmentBtn">Save Appointment</button>
      </div>
    </div>
  </div>
</div>

<!--Modal end add appointments-->

<!-- Modal add customer -->
<div class="modal fade" id="addNewCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addServicsLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><!--start-->
      
          <!--begin: Form Wizard Form-->
                        <form class="kt-form" id="addNewcustomer">
                           @csrf
                            <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                <div class="kt-heading kt-heading--md">Customer's Profile Details:</div>
                                <div class="kt-section kt-section--first">
                                    <div class="kt-wizard-v4__form">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="kt-section__body">
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_apps_user_add_avatar">
                                                                <div class="kt-avatar__holder" style="overflow: hidden;"><img id="emp_avatar_preview" src="{{asset('backend/media/users/default.jpg')}}" width="100%" height="100%"></div>
                                                                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                                                    <i class="fa fa-pen"></i>
                                                                    <input type="file" name="kt_apps_customer_add_customer_avatar" id="emp_avatar" accept="image/*">
                                                                </label>
                                                                <span id="kt-avatar__cancel" class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                                                    <i class="fa fa-times"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input class="form-control" name="customer_first_name" type="text" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input class="form-control" name="customer_last_name" type="text" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Gender</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <select name="customer_gender" class="form-control" aria-invalid="false">
                                                                <option value="">Select</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>

                                                            </select>           
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Date Of Birth</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input id="dob-cstmr" class="form-control" type="text" name="customer_dob" readonly="" placeholder="Select date">           
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                                <input type="text" name="customer_phone" class="form-control" value="" placeholder="+15678967456" aria-describedby="basic-addon1">
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                                <input type="text" class="form-control" value="" name="customer_email" placeholder="Email" aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-last row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Note(Internal)</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group">
                                                                <textarea name="note" class="form-control" id="note" rows="4"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 1-->

                          
                            <!--end: Form Wizard Step 1-->

                           

                            <!--begin: Form Actions -->
                           <!--  <div class="kt-form__actions">
                               
                               <input class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="add-customer-submit" type="submit" name="submit" >
                                <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="add-customer-submit" >
                                    Submit
                                </div>
                               
                            </div> -->

                            <!--end: Form Actions -->
                        </form>

                        <!--end: Form Wizard Form-->
            

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  onclick="handleSubmit()">Save Customer</button>
      </div>
    </div>
  </div>
</div>

<!--Modal end add appointments-->




@endsection
