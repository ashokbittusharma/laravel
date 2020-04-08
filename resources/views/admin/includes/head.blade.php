    <!--begin::Fonts -->
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">        <!--end::Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
            WebFont.load({
                google: {
                    "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
                },
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
            function displayLoader(){
               $("#overlay").show(); 
            }
             function hideLoader(){
               $("#overlay").hide(); 
            }
           
        </script>
<link href="{{ asset('backend/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Fonts -->
 @if(Request::path() == 'admin/booking/calendar' || Request::is('admin/booking/calendar/*'))       
  <link href="{{ asset('backend/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
  @endif
    <!--begin:: Global Mandatory Vendors -->
    <link href="{{ asset('backend/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/vendors/general/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" /> 
    <link href="{{ asset('backend/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('backend/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />    
    <!--begin::Global Theme Styles(used by all pages) -->
        <link href="{{ asset('backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ asset('backend/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />

    <!--Employee Page-->
    <link href="{{ asset('backend/css/pages/wizard/wizard-4.css') }}" rel="stylesheet" type="text/css" />

    @if(Request::path() == 'admin/booking/' || Request::is('admin/booking/*'))
        <link href="{{ asset('backend/js/datatable/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/js/datatable/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
    @endif
