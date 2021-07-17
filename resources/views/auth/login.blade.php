<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="CubeApps for SME's.">
    <meta name="keywords" content="Accounting, Cloud Accounting, Quickbooks, Xero, Sage, web app">
    <meta name="author" content="CubeApps">
    <title>Keep Ctrl </title><title></title>
    <link rel="apple-touch-icon" href="{{asset('public/img/apple-icon-120.png')}}">
    <link rel="shortcut icon" href="{{asset('public/img/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/vendors.min.css')}}">
   
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/unslider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/climacons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fonts/meteocons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/morris.css')}}">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/newbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/newbootstrap-extended.css')}}">
    @yield('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/components.css')}}">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/timeline.css')}}">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/toastr.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{asset('public/css/select2.min.css')}}">
    <!-- END: Custom CSS-->

</head>
<body class="vertical-layout vertical-menu 1-column  bg-full-screen-image " data-open="click" data-menu="vertical-menu" data-col="1-column">
    <!-- BEGIN: Content-->
      <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            

            
            
        <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0 pb-0" style="padding-top: 0px;">
                                    <div class="card-title text-center">
                                        <img src="{{asset('/public/new/images/newlogo.jpg')}}" alt="branding logo">
                                    </div>
                                   
                                </div>
                                <form method="POST" action="{{route('login')}}">
                                <div class="card-content">
                                    
                                    <div class="card-body text-center">
                                      </div>
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>Login Using Email</span></p>
                                    
                                    
                                    
                                    
                                    
        <div class="card-body pt-0">
                                        

                                        
            <fieldset class="form-group floating-label-form-group">
                <label for="user-name">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required  autofocus>

            </fieldset>

            <fieldset class="form-group floating-label-form-group mb-1">
                <label for="user-password">Enter Password</label>
                <input id="password" type="password" class="form-control " name="password" required >

            </fieldset>

            @csrf

            <div class="form-group row">
                <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                    <div class="form-check">
                    <fieldset>
                       <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label for="remember-me"> Remember Me</label>
                    </fieldset>
                    </div>
                </div>
                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="{{url('/password/reset')}}" class="card-link">Forgot Password?</a></div>
            </div>
        </div>
                                    
                                    
                                    
                                    
                                    <div class="card-body pt-0">
                                        <button type="submit" class="btn btn-outline-danger btn-block"><i class="ft-user"></i> {{ __('Login') }}</button>
                                    </div>
                                    
                                </div>
                        

 
                                  <div class="card-footer">
                                    <div class="">
                                        
                                        <p class="float-sm-right text-center m-0"> <a class="badge badge-success ml-1">New to Ctrl. ? <a href="{{route('register')}}" class="card-link">Sign Up</a></p>
                                    </div>
                                </div>
</form>


                            </div>
                        </div>
                    </div>
                </section>

            </div>
            
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('public/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="../../../app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/forms/form-login-register.js"></script>
    <!-- END: Page JS-->


</body>
</html>


