
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


<body class="vertical-layout vertical-menu 1-column   blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                         <img src="{{asset('public/img/stack-logo-dark.png')}}" alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Link is valid till 2 minutes</span></h6>
                                </div>
                                <div class="card-content">
                                    
                                    
                                    <div class="card-body">
                                        @if(Session::has('success'))
                                        <div class="alert bg-success alert-dismissible mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <strong>{{ Session::get('success') }}</strong>
                                        </div> 
                                        @endif
                                        <form class="form-horizontal"  method="POST" action="{{route('code.verify')}}" novalidate>
                                            
                                   
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control " id="code" value="" name="code" placeholder="Enter Your Verification Code" required>
                                                    <input type="hidden" class="form-control " name="userid" value="{{$user}}" placeholder="" required>
<!--                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>-->
                                            {{csrf_field()}}

                                            </fieldset>
                                            
                                    
                                        <button type="submit" class="btn btn-outline-danger btn-block"><i class="ft-user"></i> {{ __('Verify') }}</button>
                                    
                                            
                                            
                                            
                                            
                                          
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer border-0">
                                    <p class="float-sm-left text-center"><a href="login-simple.html" class="card-link">Login</a></p>
                                    <p class="float-sm-right text-center">New to Stack ? <a href="register-simple.html" class="card-link">Create Account</a></p>
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


