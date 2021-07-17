<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="CubeApps is Small Business Accounting.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="Cubeapps">
    <title>Cubeapps | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{asset('public/img/apple-icon-120.png')}}">    
    <link rel="shortcut icon" href="{{asset('public/img/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('public/new/vendors/mdi/css/newmaterialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/new/vendors/puse-icons-feather/newfeather.css') }}">
        <link rel="stylesheet" href="{{ asset('public/new/vendors/css/newvendor.bundle.base.css') }}">
        
        <link rel="stylesheet" href="{{ asset('public/new/vendors/morris.js/newmorris.css') }}">
    {{--============================ ALL Css library Start ============================--}}
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/vendors.min.css')}}">   
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/unslider.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/climacons.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/fonts/meteocons/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/morris.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/sweetalert2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/icheck/icheck.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/icheck/custom.css')}}">
        <link rel="stylesheet" href="{{ asset('public/new/css/newstyle.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/newbootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/newbootstrap-extended.css')}}">    
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/fonts/simple-line-icons/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/timeline.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/toastr.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/select2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/datatables.min.css')}}">
        <link rel="stylesheet" type="text/css"  href="{{asset('public/css/bootstrap-fileupload.css')}}" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="{{ asset('public/css/jquery-confirm.min.css') }}">
    {{--============================ ALL Css library End ============================--}}

    @yield('stylesheet')

    {{-- custom css ( fahad_Coder ) --}}
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/custom.css')}}">

    {{--================= ALL Custom Style Start =================--}}
        <style>

            .main-menu.menu-dark .navigation > li > a {
                padding: 5px 30px 5px 14px;
            }

            body.vertical-layout.vertical-menu.menu-expanded .main-menu .navigation li.has-sub > a:not(.mm-next)::after {
                top: 5px;
            }

            body.vertical-layout.vertical-menu.menu-expanded .main-menu .navigation > li > a > span {
                font-size: .9rem;
            }

            .main-menu.menu-dark .navigation > li ul li > a {
                padding: 5px 18px 5px 50px;
            }

            .main-menu.menu-dark .navigation li a {
                font-size: .9rem;
            }


            /*  */

        </style>
    {{--================= ALL Custom Style End =================--}}

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-menu-2" data-open="click" data-menu="vertical-menu" data-col="2-columns">
<nav class="navbar horizontal-layout-2 col-lg-12 col-12 p-0 d-flex flex-row align-items-start">
    {{-- *************************** Top Nav Start *************************** --}}
        @include('layouts.new.top_nav')
    {{-- *************************** Top Nav End *************************** --}}
    
    
    {{-- *************************** Menu Start *************************** --}}
        @include('layouts.new.menu')

    {{-- *************************** Menu Start end *************************** --}}  
       </nav>
       <br><br>

    {{-- *************************** Content Start *************************** --}}
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>

            </div>

        </div>
    {{-- *************************** Content End *************************** --}}

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    {{-- *************************** Footer Start *************************** --}}
        <footer class="footer footer-static footer-light navbar-border">
            <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
                <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 
                    <a 
                        class="text-bold-800 grey darken-2" 
                        href="http://cubeapps.co.za" 
                        target="_blank">Cubeapps 
                    </a>
                </span>
                
                <span class="float-md-right d-none d-lg-block">Developed by 
                    <a href="http://cubeapps.co.za" target="_blank">CubeApps</a>
                </span>
            </p>
        </footer>
    {{-- *************************** Footer End *************************** --}}


    {{--============================ ALL Javascript library Start ============================--}}

        <!-- BEGIN: Vendor JS-->
        {{-- <script src="{{asset('public/js/app.js')}}"></script> --}}
        <script src="{{asset('public/js/vendors.min.js')}}"></script>
        <script src="{{asset('public/js/jquery.sticky.js')}}"></script>
        <script src="{{asset('public/js/jquery.sparkline.min.js')}}"></script>
        <!-- BEGIN Vendor JS-->
        
        <script src="{{asset('public/js/jquery.steps.min.js') }}"></script>
        <script src="{{asset('public/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('public/js/icheck/icheck.min.js') }}"></script>
        <script src="{{ asset('public/js/sweetalert2.all.min.js') }}"></script>
        <!-- BEGIN: Page Vendor JS-->
        <script src="{{asset('public/js/raphael-min.js')}}"></script>        
        <script src="{{asset('public/js/morris.min.js')}}"></script>        
        <script src="{{asset('public/js/unslider-min.js')}}"></script>        
        <script src="{{asset('public/js/horizontal-timeline.js')}}"></script>
        <!-- END: Page Vendor JS-->
        
        <!-- BEGIN: Theme JS-->
        <script src="{{asset('public/js/app-menu.js')}}"></script>        
        <script src="{{asset('public/js/app2.js')}}"></script>
        {{-- <script src="{{asset('public/js/app2.js')}}"></script> --}}
        <!-- END: Theme JS-->
        
        <script src="{{asset('public/dt/datatable/datatables.min.js')}}"></script>
        {{-- <script src="{{asset('public/js/dashboard-ecommerce.js')}}"></script> --}}
        <script src="{{asset('/public/js/toastr.min.js')}}"></script>
        <script src="{{asset('public/js/select2.full.min.js')}}"></script>        
        <script type="text/javascript" src="{{asset('public/js/bootstrap-fileupload.js')}}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ asset('public/js/jquery-confirm.min.js') }}"></script>

        {{-- All Blade page script comes here. --}}
        {{-- Fahad coder script --}}
        @yield('script')

        @stack('script')
        
        {{-- All Success & Error Messages Start --}}
        <script>
            @if (session()->has('success'))
            
                toastr["success"]("{{ session()->get('success') }}")

                toastr.options = {
                    "closeButton": true,
                    "debug": true,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
            @endif

            @if (session()->has('err'))

                toastr["error"]("{{ session()->get('err') }}")

                toastr.options = {
                    "closeButton": true,
                    "debug": true,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
            
            @endif
        </script>
        {{-- All Success & Error Messages End --}}

        
        <script>
            $(document).ready(function () { 
                $(".select2").select2();

                // $("#datatable").DataTable();
            });

            
            //    $(window).on("load", function (e) 
            //    {
            //        console.log("loaded");
            //        var preloader = document.getElementById("loading");
            //        preloader.style.display = 'none';
                    
            //    })

        </script>    
    {{--============================ ALL Javascript library End ============================--}}

</body>
<!-- END: Body-->

</html>
