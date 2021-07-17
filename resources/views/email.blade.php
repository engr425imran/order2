<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cubeapps | @yield('title')</title>

    {{--============================ ALL Css library Start ============================--}}
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.css')}}">
    {{--============================ ALL Css library End ============================--}}

    @yield('stylesheet')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns fixed-navbar">

    {{-- *************************** Content Start *************************** --}}
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-body">
                    
                   <div class="container">
                        @yield('content')
                   </div>
    
                </div>
            </div>
        </div>
    {{-- *************************** Content End *************************** --}}

    {{--============================ ALL Javascript library Start ============================--}}
    @yield('script')

    @stack('script')
</body>
<!-- END: Body-->

</html>
