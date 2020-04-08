
<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
	var KTAppOptions = {
		"colors": {
			"state": {
				"brand": "#5d78ff",
				"dark": "#282a3c",
				"light": "#ffffff",
				"primary": "#5867dd",
				"success": "#34bfa3",
				"info": "#36a3f7",
				"warning": "#ffb822",
				"danger": "#fd3995"
			},
			"base": {
				"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
				"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
			}
		}
	};
</script>

<!-- end::Global Config -->

<!--begin:: Global Mandatory Vendors -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="{{ asset('backend/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/tooltip.js/dist/umd/tooltip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script>

<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<script src="{{ asset('backend/vendors/general/jquery-form/dist/jquery.form.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/chart.js/dist/Chart.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/owl.carousel/dist/owl.carousel.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/jquery-validation/dist/jquery.validate.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/jquery-validation/dist/additional-methods.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/custom/js/vendors/jquery-validation.init.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/custom/js/vendors/sweetalert2.init.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>


@if(Request::path() == 'admin/booking/calendar' || Request::is('admin/booking/calendar/*'))
		
		<script src="{{ asset('backend/js/pages/components/calendar/basic.js') }}" type="text/javascript"></script>
@endif

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('backend/js/scripts.bundle.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<!--Dashboard-->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('backend/js/pages/dashboard.js') }}" type="text/javascript"></script>
<!-- <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/custom/gmaps/gmaps.js') }}" type="text/javascript"></script> -->
<!--employee page-->
@if(Request::path() == 'admin/employees' || Request::is('admin/employees/*'))
<script src="{{ asset('backend/js/pages/custom/employee/listEmployee-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/pages/custom/employee/add-employee.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/pages/custom/employee/edit-employee.js') }}" type="text/javascript"></script>
@endif
@if(Request::path() == 'admin/customers' || Request::is('admin/customers/*'))
<script src="{{ asset('backend/js/pages/custom/customer/listcustomer-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/pages/custom/customer/add-customer.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/pages/custom/customer/edit-customer.js') }}" type="text/javascript"></script>
@endif


@if(Request::path() == 'admin/booking/service-categories' || Request::is('admin/booking/service-categories/*') || Request::path() == 'admin/booking/services' || Request::is('admin/booking/services/*'))
<script src="{{ asset('backend/js/datatable/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/datatable/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/datatable/dataTables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/pages/custom/services/services.js') }}" type="text/javascript"></script>
@endif


@if(Request::path() == 'admin/booking/appointments' || Request::is('admin/booking/appointments/*'))

<script src="{{ asset('backend/js/pages/custom/appointments/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/pages/custom/appointments/list-appointment-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/pages/custom/appointments/add-appointment.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/pages/custom/appointments/appointment.js') }}" type="text/javascript"></script>
@endif

@if(Request::path() == 'admin/finance/payments' || Request::is('admin/finance/payments/*'))

<script src="{{ asset('backend/js/pages/custom/payment/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/pages/custom/payment/list-paymentinfo-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/pages/custom/payment/payment.js') }}" type="text/javascript"></script>
@endif
