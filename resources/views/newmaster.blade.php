<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cubeapps | @yield('title') </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="CubeApps is Small Business Accounting.">
  <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="Cubeapps">
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('public/new/vendors/mdi/css/newmaterialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/new/vendors/puse-icons-feather/newfeather.css') }}">
  <link rel="stylesheet" href="{{ asset('public/new/vendors/css/newvendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('public/new/vendors/morris.js/newmorris.css') }}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/vendors.min.css')}}">   
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/unslider.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/climacons.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/fonts/meteocons/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/morris.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/sweetalert2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/icheck/icheck.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/icheck/custom.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/newbootstrap.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/newbootstrap-extended.css')}}">   
  <link rel="stylesheet" href="{{ asset('public/new/css/newstyle.css') }}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/components.css')}}">
  <link rel="stylesheet" href="{{ asset('public/css/jquery-confirm.min.css') }}">
  <!-- endinject --> 
  <link rel="shortcut icon" href="{{ asset('public/img/favicon.ico') }}" />

  
  @yield('stylesheet')

</head>

<body class="horizontal-menu-2">
  <div class="container-scroller">
    <!-- Horizontal Menu Start -->
    <nav class="navbar horizontal-layout-2 col-lg-12 col-12 p-0 d-flex flex-row align-items-start">

            <div class="container">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="{{ route('home') }}"><img src="{{ asset('/public/new/images/newlogo.svg') }}" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{ asset('/public/new/images/logo-mini.svg') }}" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center pr-0">
          
          <ul class="navbar-nav header-links">
            <li class="nav-item">
              <a href="#" class="nav-link">Schedule <span class="badge badge-success ml-1">New</span></a>
            </li>
             <li class="nav-item active">
              <a href="{{route('reports')}}" class="nav-link"><i class="mdi mdi-elevation-rise"></i>Reports</a>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="modal" data-target="#exampleModal">
                <i class="mdi mdi-bookmark-plus-outline">Shortcuts</i>
                
              </a>
              <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
                <div class="modal-dialog modal-lg" role="document" style="color: black">
                  <div class="modal-content" style="background-color: white; width: 800px; margin-left: 200px;">
                    <div class="row" style="margin-left: 20px; margin-right: 20px;">
                      <div class="modal-header col-md-6" style="border-bottom: 1px solid black;">
                        <h5 class="modal-title" id="exampleModalLabel" ><i class="fa fa-drivers-license-o"> &nbsp Customers</i></h5>
                      
                      </div>
                      <div class="modal-header col-md-6 " style="border-bottom: 1px solid black;">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-bank"> &nbsp Accounts</i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>
                    <div class="row">
                      <div class="modal-body col-md-6">
                        <ul>
                            <a class="dropdown-item" href="{{ route('add.invoice') }}"><i class="ft-file"></i>Add Invoice</a><br>
                            <a class="dropdown-item" href="{{ route('customers') }}"><i class="ft-users success"></i><span class="success">Customers</span></a><br>
                            <a class="dropdown-item" href="{{ route('inactiveCustomers') }}"><i class="ft-users danger"></i><span class="danger"> Inactive Customers</span></a>
                            
                        </ul>
                      </div>
                      <div class="modal-body col-md-6">
                        <ul>
                            <a class="dropdown-item" href="{{ route('account') }}"><i class="ft-file"></i>Accounts</a><br>
                            <a class="dropdown-item" href="{{ route('general.ledger') }}"><i class="ft-file"></i>General ledger</a>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </li>
          </ul>
          <ul class="navbar-nav ml-auto dropdown-menus">
            
            <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="avatar avatar-online">
                <img src="{{ (auth()->user()->image) ? asset(auth()->user()->image) : asset('public/img/no_image.jpg') }}" alt="avatar">
              </span> 
              <h6 class="user-name" style="margin-top: -25px;"> &nbsp &nbsp &nbsp &nbsp {{auth()->user()->name}}</h6>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              
              <a class="dropdown-item" href="{{route('userProfile')}}">
                  <i class="ft-user"></i> Edit Profile
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('user.logout')}}"><i class="ft-power"></i> Logout</a>
              
            </div>
          </li>
          </ul>
          <button type="button" class="navbar-toggler d-block d-md-none"><i class="mdi mdi-menu"></i></button>
        </div>
      </div>

      {{-- *************************** Menu Start *************************** --}}
        @include('layouts.new.menu')
    </nav>
   	  {{-- *************************** Menu Start end *************************** --}}  
      

      {{-- *************************** Content Start *************************** --}}
    <!-- Horizontal Menu Ends -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        @yield('content')
        <!-- content-wrapper ends -->
        {{-- *************************** Footer Start *************************** --}}

        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020 <a href="http://cubeapps.co.za/" target="_blank">CubeApps</a>. All rights reserved.</span>
            
          </div>
        </footer>

        {{-- *************************** Footer End *************************** --}}
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  		@yield('script')

        @stack('script')
        
        
  <script src="{{ asset('public/new/vendors/js/newvendor.bundle.base.js') }}"></script>
  <script src="{{asset('public/js/jquery.sticky.js')}}"></script>
        <script src="{{asset('public/js/prism.min.js')}}"></script>
        <script src="{{asset('public/js/jquery.sparkline.min.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
   <script src="{{asset('public/js/jquery.steps.min.js') }}"></script>
        <script src="{{asset('public/js/jquery.validate.min.js') }}"></script>
        <script src="{{asset('public/js/icheck/icheck.min.js') }}"></script>
        <script src="{{asset('public/js/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('public/new/vendors/chart.js/newChart.min.js') }}"></script>
  <script src="{{ asset('public/new/vendors/raphael/newraphael.min.js') }}"></script>
  <script src="{{ asset('public/new/vendors/morris.js/newmorris.min.js') }}"></script>
  <script src="{{asset('public/js/unslider-min.js')}}"></script> 
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('public/new/js/newoff-canvas.js') }}"></script>
  <script src="{{ asset('public/new/js/newhoverable-collapse.js') }}"></script>
  <script src="{{ asset('public/new/js/newmisc.js') }}"></script>
  <script src="{{ asset('public/new/js/newsettings.js') }}"></script>
  <script src="{{ asset('public/new/js/newtodolist.js') }}"></script>
  
  <script src="{{asset('public/js/customizer.min.js')}}"></script>
        <script src="{{asset('public/js/breadcrumbs-with-stats.min.js')}}"></script>
        
        
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('public/new/js/newdashboard.js') }}"></script>
  <script src="{{ asset('public/new/js/newhorizontal-menu.js') }}"></script>
  <!-- End custom js for this page-->
</body>

</html>
