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
                  <div class="modal-content">
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