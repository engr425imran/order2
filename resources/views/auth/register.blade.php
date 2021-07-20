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
    <title>Cubeapps </title><title></title>
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
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-extended.css')}}">
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
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <img src="{{asset('public/img/stack-logo-dark.png')}}" alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Easily Using</span></h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body text-center">
                                        <a href="#" class="btn btn-social mb-1 mr-1 btn-outline-facebook"><span class="fa fa-facebook"></span> <span class="px-1">facebook</span> </a>
                                        <a href="#" class="btn btn-social mb-1 btn-outline-google"><span class="fa fa-google-plus font-medium-4"></span> <span class="px-1">google</span> </a>
                                    </div>
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>OR Using Email</span></p>
                                    <div class="card-body pt-0">

                                        

        
                                        <form method="POST" action="{{ route('register') }}">
                                            
                                            <fieldset class="form-group floating-label-form-group">
                                                <label for="user-name">Email Name</label>
                                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </fieldset>
                                            
                                            
                                            <fieldset class="form-group floating-label-form-group">
                                                <label for="user-email">Your Email Address</label>
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </fieldset>
                                            
                                            
                                            <fieldset class="form-group floating-label-form-group">
                                                <label for="user-email">Your Phone Number</label>
                                                <input id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </fieldset>

                                            <fieldset class="form-group floating-label-form-group">
                                                <label for="user-email">Company Name</label>
                                                <input id="company" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}" required>
                                                @if ($errors->has('company_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('company_name') }}</strong>
                                                    </span>
                                                @endif
                                            </fieldset>
                                            
                                            
                                            <fieldset class="form-group floating-label-form-group mb-1">
                                                <label for="user-password">Enter Password</label>
                                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                               @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </fieldset>
                                            
                                            @csrf
                                            
                                            
                                            <fieldset class="form-group floating-label-form-group mb-1">
                                                <label for="user-password">Confirm Password</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </fieldset>
                                            
                                            
                                            <div class="form-group row">
                                                <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                                                    <fieldset>
                                                        <input type="checkbox" id="remember-me" class="chk-remember">
                                                        <label for="remember-me"> Remember Me</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                                            </div>
                                            
                                            
                                            <button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-user"></i> {{ __('Register') }}</button>
                                        </form>
                                    </div>
                                    
                                     <div class="card-footer">
                                    <div class="">
                                        
                                        <p class="float-sm-right text-center m-0">Already have an account? <a href="{{route('login')}}" class="card-link">Sign in</a></p>
                                    </div>
                                </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
            
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
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


