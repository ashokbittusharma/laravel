@extends('layouts.admin')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Basic Calendar </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Booking </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Calendar </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<!-- <a href="" class="kt-subheader__breadcrumbs-link">
					Basic Calendar </a> -->

				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="kt-subheader__wrapper">
				<!-- <a href="#" class="btn kt-subheader__btn-primary">
					Actions &nbsp;

					<i class="flaticon2-calendar-1"></i>
				</a> -->
			</div>
		</div>
	</div>
</div>

<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="row">
		<div class="col-lg-12">

			<!--begin::Portlet-->
			<div class="kt-portlet" id="kt_portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="flaticon-map-location"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Calendar
						</h3>
					</div>
					<!-- <div class="kt-portlet__head-toolbar">
						<a href="#" class="btn btn-brand btn-elevate">
							<i class="la la-plus"></i>
							Add Event
						</a>
					</div> -->
				</div>
				<div class="kt-portlet__body">
					<div id="kt_calendar"></div>
				</div>
			</div>

			<!--end::Portlet-->
		</div>
	</div>
</div>

<!-- end:: Content -->

@endsection