<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css" />
    <!--begin::Global Theme Styles(used by all pages) -->
        <link href="{{ asset('backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--begin::Fonts -->
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
        </script>
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <!-- begin:: Page -->
        <div class="kt-grid kt-grid--ver kt-grid--root">
            <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

                    <!--begin::Aside-->
                    <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url({{ asset('backend/media/bg/bg-4.jpg')}}">
                        <div class="kt-grid__item">
                            <a href="javascript:void(0)" class="kt-login__logo">
                                <img src="{{ asset('backend/media/logos/Starsoft-logo-left-Justify.png')}}">
                            </a>
                        </div>
                        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                            <div class="kt-grid__item kt-grid__item--middle">
                                <h3 class="kt-login__title">Welcome to Starsoft Wax Center!</h3>
                                <h4 class="kt-login__subtitle">At Starsoft, we take pride in everything we do. Our state of the art facility and skilled staff are committed to making you feel comfortable in your own skin.</h4>
                            </div>
                        </div>
                        <div class="kt-grid__item">
                            <div class="kt-login__info">
                                <div class="kt-login__copyright">
                                    &copy {{ now()->year }} Starsoft Wax Center
                                </div>
                                <div class="kt-login__menu">
                                    <a href="javascript:void(0)" class="kt-link">Privacy</a>
                                    <a href="javascript:void(0)" class="kt-link">Legal</a>
                                    <a href="javascript:void(0)" class="kt-link">Contact</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--begin::Aside-->

                    <!--begin::Content-->
                    <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

                       <!--begin::Body-->
                        <div class="kt-login__body">
                             @yield('content')
                        </div>

                        <!--end::Body-->
                    </div>

                    <!--end::Content-->
                </div>
            </div>
        </div>


</body>
</html>
