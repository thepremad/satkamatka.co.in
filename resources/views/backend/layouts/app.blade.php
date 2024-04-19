<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>SatkaMatka @yield('title')</title>
    {{-- <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">
    @include('backend.partials.styles')

    <style>
        .main-menu{
            background-color: #ffe4e4 !important !important;
        }
        .main-menu.menu-light .navigation{
            background-color: #ffe4e4 !important !important;
        }
        .main-menu.menu-light .navigation li a > *{
            /* color: ; */
        }
        .main-menu.menu-light .navigation > li.open:not(.menu-item-closing) > a, .main-menu.menu-light .navigation > li.sidebar-group-active > a {
            color: #565360;
            background: #a7a3a3;
            border-radius: 6px;
        }

@media screen and (min-width: 576px) {
    /* Override sidenav-overlay styles when the screen is wider than 576px */
    .sidenav-overlay.show {
        touch-action: none !important;
    }

    /* Apply styles to the main menu when the screen is wider than 576px */
    .main-menu.menu-fixed.menu-light.menu-accordion.menu-shadow.menu-native-scroll {
        touch-action: pinch-zoom !important;
    }
}
    </style>
    @yield('styles')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('backend.partials.head')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    @include('backend.partials.sidebar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('backend.partials.footer')
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <!-- BEGIN: Script-->
    @include('backend.partials.scripts')
    @yield('scripts')
    @stack('scripts')
    <!-- END: Script-->

</body>
<!-- END: Body-->

</html>
