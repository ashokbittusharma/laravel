@extends('layouts.admin') @section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Edit Appointment
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('admin-dashboard') }}" class="kt-subheader__breadcrumbs-link">
                    Dashboard </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('appointments') }}" class="kt-subheader__breadcrumbs-link">
                    Appointments </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="javascript:void(0)" class="kt-subheader__breadcrumbs-link">
                    Edit Appointment </a>

                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <a href="{{ route('appointments') }}" class="btn btn-info"><i class="fa fa-angle-double-left"></i>Back</a>
            <!-- <button id="addAppointmentBTN" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAppointmentModal">Add Appointment</button> -->
        </div>
    </div>
</div>

<!-- end:: Content Head -->
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

	<div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-success" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_2_tab_content" role="tab" aria-selected="true">
                            <i class="la la-dashboard"></i> Appointment Detail
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_3_tab_content" role="tab">
                            <i class="la la-money"></i>Payment Info
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content">
                <div class="tab-pane active" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">
                    <form class="kt-form" id="editAppointmentForm">
                        @csrf
                        <input type="hidden" name="appointment" value="{{$appointment->id}}">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="kt-section__body">
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-xl-6">
                                            <label class="col-xl-12 col-lg-12 col-form-label">Customer: </label>
                                            <div class="col-lg-12 col-xl-12">

                                                <div class="input-group">
                                                    <select name="customer" id="selectCustomerAppointment" class="form-control kt-selectpicker">
                                                        <option value="">Select</option>
                                                        @foreach($customers as $customer)
                                                        <option value="{{$customer->id}}" @if( $customer->id == $appointment->customer) selected="selected" @endif>{{$customer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <!-- <span class="input-group-append">
                                            <button class="btn btn-default" type="button" tabindex="-1" id="addNewCustomer">Add<span class="la la-user-plus" aria-hidden="true"></span></button>
                                                    </span> -->
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-6">
                                            <label class="col-xl-12 col-lg-12 col-form-label">Assign to Employee</label>
                                            <div class="col-lg-12 col-xl-12">
                                                <select name="assignEmployee" class="form-control kt-selectpicker">
                                                    <option value="">Select</option>
                                                    @foreach($employees as $employee)
                                                    <option value="{{$employee->id}}"  @if( $employee->id == $appointment->employee) selected="selected" @endif>{{$employee->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6 col-xl-6">
                                            <label class="col-xl-12 col-lg-12 col-form-label">Service Category</label>
                                            <div class="col-lg-12 col-xl-12">
                                                <select class="form-control kt-selectpicker addServiceCategory" name="serviceCategory" onchange="getservices(this)">
                                                    <option value="">Select</option>
                                                    @foreach($serviceCats as $serviceCat)
                                                    <option value="{{$serviceCat->id}}" @if( $serviceCat->id == $appointment->service_cat) selected="selected" @endif>{{$serviceCat->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-6">
                                            <label class="col-xl-12 col-lg-12 col-form-label">Service</label>
                                            <div class="col-lg-12 col-xl-12">
                                                <select class="form-control kt-selectpicker servicesAdd" name="service">
                                                    <option value="">Select</option>
                                                    @foreach($services as $services)
                                                    <option value="{{$services->id}}"  @if( $services->id == $appointment->service) selected="selected" @endif>{{$services->name}}</option>
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
                                                    <input type="text" class="form-control" readonly="" placeholder="Select date" id="datepicker" name="appointment_date" value="{{$appointment->date}}">
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
                                                        <input class="form-control" id="timepicker" readonly="" @if($appointment) value="{{$appointment->time}}" @else value="00:00:00 AM" @endif type="text" name="appointment_time">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Default checked -->
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-xl-6">
                                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" data-original-title="Check this checkbox if you want your customer to receive an email about the scheduled appointment.">
                                                <input type="checkbox" @if($appointment->notify_customer == 'yes') checked="checked" @endif name="customer_notify">Notify the customer(s)<span></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6 col-xl-6">
                                            <label class="col-xl-12 col-lg-12 col-form-label">Payment Method</label>
                                            <div class="col-lg-12 col-xl-12">
                                                <select class="form-control kt-selectpicker" name="payment_method">
                                                    <option value="onsite" @if($appointment->payment_method == 'onsite') checked="checked" @endif>onSite</option>
                                                    <option value="stripe" @if($appointment->payment_method == 'stripe') checked="checked" @endif>Stripe</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xl-6">

                                    </div>

                                    <div class="form-group">
                                        <label class="col-xl-12 col-lg-12 col-form-label">Note (Internal)</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="input-group">
                                                <textarea name="note" class="form-control" id="service_description" rows="4">{{$appointment->note}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-group-last">
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="input-group">
                                               <button type="submit" class="btn btn-primary">Update Appointment</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </form>
                </div>
                <div class="tab-pane" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">
                    <div class="container invoice">
                          <div class="invoice-body">
                            <div class="row">
                              <div class="col-sm-6 col-xs-6">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h3 class="panel-title">Customer Details</h3>
                                  </div>
                                  <div class="panel-body">
                                    <dl class="dl-horizontal">
                                      <dt>Name</dt>
                                      <dd>{{$selectedCustomers[0]->name}}</dd>
                                      <dt>Phone</dt>
                                      <dd>{{$selectedCustomers[0]->phone}}</dd>
                                      <dt>Email</dt>
                                      <dd>{{$selectedCustomers[0]->email}}</dd>
                                      <dt>&nbsp;</dt>
                                      <dd>&nbsp;</dd>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6 col-xs-6">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h3 class="panel-title">Payment </h3>
                                  </div>
                                  <div class="panel-body">
                                    <dl class="dl-horizontal">
                                      <dt>&nbsp;</dt>
                                      <dt><a href="#">View Payment Detail</a></dt>
                                      <dt>Date:</dt>
                                      <dd>@php echo date('M d, Y', strtotime($paymentinfo[0]->payment_date)); @endphp</dd>
                                      <dt>Payment Method:</dt>
                                      <dd>{{$paymentinfo[0]->payment_type}}</dd>
                                      <dt>Status</dt>
                                      <dd>{{$paymentinfo[0]->payment_status}}</dd>
                                      <dt>&nbsp;</dt>
                                      <dd>&nbsp;</dd>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h3 class="panel-title">Service :</h3>
                              </div>
                              <table class="table table-bordered table-condensed">
                                <thead>
                                  <tr>
                                    <th>Item / Details</th>
                                    <th class="text-center colfix">Unit Cost</th>
                                    <th class="text-center colfix">Partial Payment</th>
                                    <th class="text-center colfix">Discount</th>
                                    <th class="text-center colfix">Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                     {{$services->name}}
                                      
                                    </td>
                                    <td class="text-right">
                                      <span class="mono">$@php echo sprintf('%.2f', $services->price); @endphp</span>
                                    </td>
                                    <td class="text-right">
                                      NIL
                                    </td>
                                    <td class="text-right">
                                      NIL
                                    </td>
                                    <td class="text-right">
                                      $@php echo sprintf('%.2f', $services->price); @endphp
                                    </td>
                                  </tr>

                                </tbody>
                              </table>
                            </div>
                            

                          </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!--Modal end add appointments-->

@endsection