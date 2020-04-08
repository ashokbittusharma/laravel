@extends('layouts.admin')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Booking </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
               
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    All services </a>

                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">                                         
            </div>
        </div>
    </div>
</div>

<!-- end:: Subheader -->

                        <!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
<div class="kt-portlet__head kt-portlet__head--lg">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon2-line-chart"></i>
        </span>
        <h3 class="kt-portlet__head-title">
        All Services
        </h3>
    </div>
    <div class="kt-portlet__head-toolbar">
        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addService">Add Service</button>
    </div>
</div>
<div class="kt-portlet__body">
<table id="servicesListing" class="display kt-datatable__table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Service</th>
                <th>Category</th>
                <th>Duration</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Service</th>
                <th>Category</th>
                <th>Duration</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </tfoot>
 
        <tbody>
            @foreach($getServices as $service)
            <tr>
                <td>
                    <div class="kt-user-card-v2">
                        <div class="kt-user-card-v2__pic">
                        @if(!empty($service->cat_img))
                            <img src="/backend/media/services/{{$service->cat_img}}" alt="photo">
                        @else
                            <div class="kt-badge kt-badge--xl kt-badge--warning">{{$service->nameTag}}</div>
                        @endif
                        </div>
                        <div class="kt-user-card-v2__details"><a href="javascript:void(0)" class="editServiceBtn" data-service = "@php echo base64_encode(base64_encode($service->id)); @endphp">{{$service->name}}</a></div>
                    </div>
                </td>
                <td>{{$service->cat}}</td>
                <td>{{$service->duration}}</td>
                <td>$@php echo number_format((float)$service->price, 2, '.', ''); @endphp</td>
                <td>
                    <button type="button" class="btn btn-success editServiceBtn" data-service = "@php echo base64_encode(base64_encode($service->id)); @endphp">Edit Service</button>                   
                    <button type="button" class="btn btn-danger deleteService" id="@php echo base64_encode(base64_encode($service->id)); @endphp">Delete</button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!--end: Datatable -->
</div>
</div>
</div>
<!-- end:: Content -->


<!-- Modal add services -->
<div class="modal fade" id="addService" tabindex="-1" role="dialog" aria-labelledby="addServicsLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><!--start-->
        @php
        $optionString = '';
        $array = array(00, 05, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55);
        for ($i=0; $i < 24; $i++) { 
              $hours = $i.'h';
             foreach ($array as $key => $value) {
                  $min = $value.'min';
                  $timeInterval = $hours.' '.$min;
                  $timeInterval = ($timeInterval != '0h 0min') ? $timeInterval : '';
                  $optionString .= '<option value = "'. $timeInterval.'">'.$timeInterval.'</option>';
             }
        }
        @endphp
        
            <!--begin: Form Wizard Form-->
                        <form class="kt-form" id="addServiceForm">
                           @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="kt-section__body">
                                                    <div class="form-group row text-center">
                                                        <div class="col-lg-12 col-xl-12">
                                                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_apps_user_add_avatar">
                                                                <div class="kt-avatar__holder" style="overflow: hidden;"><img id="service_avatar_preview" src="{{asset('backend/media/icons/svg/Design/Image.svg')}}" width="100%" height="100%"></div>
                                                                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                                                    <i class="fa fa-pen"></i>
                                                                    <input type="file" name="service_avatar" id="service_avatar" accept="image/*">
                                                                </label>
                                                                <span id="services_avatar__cancel" class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                                                    <i class="fa fa-times"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="form-group row">
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Name</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" name="service_name" type="text" value="">      
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Category</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <select name="service_category" class="form-control kt-selectpicker">
                                                                <option value="">Select</option>
                                                                @foreach($getServicescat as $catName)
                                                                 <option value="{{ $catName->id }}">{{ $catName->name }}</option>
                                                                @endforeach

                                                            </select>           
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Duration</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                               <select class="form-control kt-selectpicker" name="service_duration"> @php  echo $optionString; @endphp </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Price($)</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input id="dob-cstmr" class="form-control" type="number" name="service_price" placeholder="">           
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Buffer Time Before</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <select class="form-control kt-selectpicker" name="service_btb">@php  echo $optionString; @endphp</select>          
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Buffer Time After</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                               <select class="form-control kt-selectpicker" name="service_bta">@php  echo $optionString; @endphp</select>         
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <!-- Default checked -->
                                                   <div class="paymentGroup">     
                                                    <label class="col-xl-12 col-lg-12 col-form-label">Payment Settings</label>
                                                    <div class="form-group d-flex">
                                                    <label class="col-3 col-form-label">On-Site</label>
                                                    <div class="col-3">
                                                        <span class="kt-switch kt-switch--outline kt-swi-tch--icon kt-switch--success">
                                                        <label>
                                                        <input type="checkbox" checked="checked" name="service_paymentoption_onsite">
                                                        <span></span>
                                                        </label>
                                                        </span>
                                                    </div>
                                                    <label class="col-3 col-form-label">Stripe</label>
                                                    <div class="col-3">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                        <label>
                                                        <input type="checkbox" name="service_paymentoption_stripe">
                                                        <span></span>
                                                        </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                                    <div class="form-group form-group-last">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Description</label>
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
        <button type="button" class="btn btn-primary" id="saveServCatBtn">Save Category</button>
      </div>
    </div>
  </div>
</div>

<!--Modal Edit services-->

<!-- Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServicsLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><!--start-->
        @php
        $optionString = '';
        $array = array(00, 05, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55);
        for ($i=0; $i < 24; $i++) { 
              $hours = $i.'h';
             foreach ($array as $key => $value) {
                  $min = $value.'min';
                  $timeInterval = $hours.' '.$min;
                  $timeInterval = ($timeInterval != '0h 0min') ? $timeInterval : '';
                  $optionString .= '<option value = "'. $timeInterval.'">'.$timeInterval.'</option>';
             }
        }
        @endphp
        
            <!--begin: Form Wizard Form-->
                        <form class="kt-form" id="editServiceForm">
                           @csrf
                           <input type="hidden" name="service" id="serviceEdit" value="">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="kt-section__body">
                                                    <div class="form-group row text-center">
                                                        <div class="col-lg-12 col-xl-12">
                                                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_apps_user_add_avatar">
                                                                <div class="kt-avatar__holder" style="overflow: hidden;"><img id="service_avatar_edit_preview" src="{{asset('backend/media/icons/svg/Design/Image.svg')}}" width="100%" height="100%"></div>
                                                                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                                                    <i class="fa fa-pen"></i>
                                                                    <input type="file" name="service_avatar" id="service_avatar_edit" accept="image/*">
                                                                </label>
                                                                <span id="services_avatar_edit_cancel" class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                                                    <i class="fa fa-times"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="form-group row">
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Name</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" id="service_name_edit" name="service_name" type="text" value="">      
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Category</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <select name="service_category" class="form-control kt-selectpicker" id="service_category_edit">
                                                                <option value="">Select</option>
                                                                 @foreach($getServicescat as $catName)
                                                                 <option value="{{ $catName->id }}">{{ $catName->name }}</option>
                                                                @endforeach

                                                            </select>           
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Duration</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                               <select class="form-control kt-selectpicker" name="service_duration" id="service_duration_edit"> @php  echo $optionString; @endphp </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Price($)</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="number" name="service_price" placeholder="" id="service_price_edit">           
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Buffer Time Before</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <select class="form-control kt-selectpicker" name="service_btb" id="service_btb_edit">@php  echo $optionString; @endphp</select>          
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xl-6">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Buffer Time After</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                               <select class="form-control kt-selectpicker" name="service_bta" id="service_bta_edit">@php  echo $optionString; @endphp</select>         
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <!-- Default checked -->
                                                   <div class="paymentGroup">     
                                                    <label class="col-xl-12 col-lg-12 col-form-label">Payment Settings</label>
                                                    <div class="form-group d-flex">
                                                    <label class="col-3 col-form-label">On-Site</label>
                                                    <div class="col-3">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                        <label>
                                                        <input type="checkbox" checked="checked" name="service_paymentoption_onsite" id="service_paymentoption_onsite_edit">
                                                        <span></span>
                                                        </label>
                                                        </span>
                                                    </div>
                                                    <label class="col-3 col-form-label">Stripe</label>
                                                    <div class="col-3">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                        <label>
                                                        <input type="checkbox" name="service_paymentoption_stripe" id="service_paymentoption_stripe_edit">
                                                        <span></span>
                                                        </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                                    <div class="form-group form-group-last">
                                                        <label class="col-xl-12 col-lg-12 col-form-label">Description</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <div class="input-group">
                                                                <textarea name="note" class="form-control" rows="4" id="note_edit"></textarea>
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
        <button type="button" class="btn btn-primary" id="updateService">Update Category</button>
      </div>
    </div>
  </div>
</div>


@endsection
