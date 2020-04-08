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
                                            services categories </a>

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
            Services Categories
        </h3>
    </div>
    <div class="kt-portlet__head-toolbar">
        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addServicsCat">Add services Category</button>
    </div>
</div>
<div class="kt-portlet__body">

    <!--begin: Datatable -->
    <table id="servicesCategories" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </tfoot>
 
        <tbody>
            @php
                $i = 1
            @endphp
            @foreach($getServicesCat as $serviceCat)
            <tr>
                <td>{{  $i }}</td>
                <td class="formTD"><span class="visibleContent_{{  $i }}">{{$serviceCat->name}}</span><form id="serviceCat_{{  $i }}" class="form-group SerCatupdateForm" style="margin-bottom: 0px;"> @csrf <input type="hidden" name="category_id" data-val = "{{$serviceCat->id}}" value="@php echo base64_encode(base64_encode($serviceCat->id)) @endphp"><input class="form-control updateFields_{{  $i }}" type="text" name="category" value="{{$serviceCat->name}}" style="display: none;" required="required"></form></td>
                <td>
                    <button type="button" class="btn btn-success editServCat visibleContent_{{  $i }}" id="editCat_{{  $i }}">Edit</button>                    
                    <button type="button" class="btn btn-danger deleteServeCat visibleContent_{{  $i }}" id ="@php echo base64_encode(base64_encode($serviceCat->id)) @endphp">Delete</button>
                    <span style="display: none;" class="updateFields_{{  $i }}">
                        <button type="button" class="btn btn-info updateCat" id="updateServCatFields_{{  $i }}">Update</button>
                        <button type="button" id= "cancelBtn_{{  $i }}" class="btn btn-dark canelupdate">Cancel</button>
                    </span>
                </td>                
            </tr>
            @php
                $i = $i + 1
            @endphp
            @endforeach
        </tbody>
    </table>

    <!--end: Datatable -->
</div>
</div>
</div>
<!-- end:: Content -->


<!-- Modal -->
<div class="modal fade" id="addServicsCat" tabindex="-1" role="dialog" aria-labelledby="addServicsCatLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add service Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="addCategory" id="addCategory">
            @csrf
          <div class="form-group">
            <label for="catName">Category Name:</label>
            <input type="text" class="form-control" name="category" id="catName">
          </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveServCat">Save Category</button>
      </div>
    </div>
  </div>
</div>

@endsection
