<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-dark bg-gradient-x-primary navbar-shadow">            
    
    <div class="navbar-wrapper" style="background-color: #2AD29C;">
        
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        <img class="brand-logo" alt="admin logo" src="{{asset('public/img/stack-logo-light.png')}}">
                        <h2 class="brand-text">Cubeapps</h2>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                </li>
            </ul>
        </div>
        
        
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile" style="background-color: #2AD29C;">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                            <i class="ft-menu"></i>
                        </a>
                    </li>

                    <li class="dropdown nav-item mega-dropdown">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-paper-plane"></i></a>
                        <ul class="mega-dropdown-menu dropdown-menu row">
                            <li class="col-md-3 col-sm-6">
                                <h6 class="dropdown-menu-header text-uppercase"><i class="fa fa-random"></i> Customers</h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>
                                            <li><a class="dropdown-item" href="{{ route('add.invoice') }}"><i class="ft-file"></i>Add Invoice</a></li>
                                            <li><a class="dropdown-item" href="{{ route('customers') }}"><i class="ft-users success"></i><span class="success">Customers</span></a></li>
                                            <li><a class="dropdown-item" href="{{ route('inactiveCustomers') }}"><i class="ft-users danger"></i><span class="danger"> Inactive Customers</span></a></li>
                                            
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="col-md-3 col-sm-6">
                                <h6 class="dropdown-menu-header text-uppercase"><i class="fa fa-bank"></i> Accounts</h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>
                                            <li><a class="dropdown-item" href="{{ route('account') }}"><i class="ft-file"></i>Accounts</a></li>
                                            <li><a class="dropdown-item" href="{{ route('general.ledger') }}"><i class="ft-file"></i>General ledger</a></li>
                                            
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            
                            
                            
                            
                        </ul>
                    </li>
                    
                
                    
                    
                    
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                    
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
                        <div class="search-input">
                            <input class="input" type="text" placeholder="Search CubeApps...">
                        </div>
                    </li>
                </ul>
                
                <ul class="nav navbar-nav float-right">
                    
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                            <i class="ficon ft-bell"></i>
                            <span class="badge badge-pill badge-danger badge-up">5</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0">
                                    <span class="grey darken-2">Notifications</span>
                                    <span class="notification-tag badge badge-danger float-right m-0">5 New</span>
                                </h6>
                            </li>
                            <li class="scrollable-container media-list">
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center">
                                            <i class="ft-plus-square icon-bg-circle bg-cyan"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading">You have new order!</h6>
                                            <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                            <small>
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">30 minutes ago</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center">
                                            <i class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading red darken-1">99% Server load</h6>
                                            <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p>
                                            <small>
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Five hour ago</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center">
                                            <i class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                                            <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p>
                                            <small> 
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="ft-check-circle icon-bg-circle bg-cyan"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Complete the task</h6><small>
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Generate monthly report</h6><small>
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                            <i class="ficon ft-mail"></i>
                            <span class="badge badge-pill badge-warning badge-up">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0">
                                    <span class="grey darken-2">Messages</span>
                                    <span class="notification-tag badge badge-warning float-right m-0">4 New</span>
                                </h6>
                            </li>
                            
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all messages</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="avatar avatar-online">
                                <img src="{{ (auth()->user()->image) ? asset(auth()->user()->image) : asset('public/img/no_image.jpg') }}" alt="avatar">
                            </span>
                            <span class="user-name">{{auth()->user()->name}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('userProfile')}}">
                                <i class="ft-user"></i> Edit Profile
                            </a>
                            {{-- <a class="dropdown-item" href="app-email.html">
                                <i class="ft-mail"></i> My Inbox
                            </a>
                            <a class="dropdown-item" href="user-cards.html">
                                <i class="ft-check-square"></i> Task
                            </a>
                            <a class="dropdown-item" href="app-chat.html">
                                <i class="ft-message-square"></i> Chats
                            </a> --}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('user.logout')}}"><i class="ft-power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>