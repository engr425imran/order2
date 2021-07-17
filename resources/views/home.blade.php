<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="utf-8" />
        <title>Ctrl Finance Software</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="Ctrl is a best finance software" name="description" />
        <meta content="" name="keywords" />
        <meta content="" name="author" />

        <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
        <![endif]-->

        <!-- CSS Files
    ================================================== -->
        <link id="bootstrap" href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link id="bootstrap-grid" href="{{asset('frontend/css/bootstrap-grid.min.css')}}" rel="stylesheet" type="text/css" />
        <link id="bootstrap-reboot" href="{{asset('frontend/css/bootstrap-reboot.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet" type="text/css" />
         <link href="{{asset('frontend/css/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('frontend/css/owl.theme.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('frontend/css/owl.transitions.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('frontend/css/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('frontend/css/jquery.countdown.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css" />

        <!-- color scheme -->
        <link id="colors" href="{{asset('frontend/css/colors/scheme-03.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('frontend/css/coloring.css')}}" rel="stylesheet" type="text/css" />


    </head>

    <body>
        <div id="wrapper">

            <!-- header begin -->
            <header class="transparent scroll-bg-color">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="de-flex sm-pt10">
                                <div class="de-flex-col">
                                    <!-- logo begin -->
                                    <div id="logo">
                                        <a href="{{URL::to('/')}}">
                                            <img alt="" class="logo" src="{{asset('frontend/images/logo-light.png')}}" /> 
                                            <img alt="" class="logo-2" src="{{asset('frontend/images/logo.png')}}" />
                                        </a>
                                    </div>
                                    <!-- logo close -->
                                </div>
                                <div class="de-flex-col header-col-mid">
                                    <!-- mainmenu begin -->
                                    <ul id="mainmenu">
                                        <li>
                                            <a href="index.html">Home<span></span></a>
                                           <!-- <ul>
                                                <li><a href="index.html">Homepage 1</a></li>
                                                <li><a href="index-2.html">Homepage 2</a></li>
                                                <li><a href="index-3.html">Homepage 3</a></li>
                                            </ul>-->
                                        </li>
                                        <li>
                                            <a href="#">Services<span></span></a>
                                            <ul>
                                                <li><a href="">  Free Software</a></li>
                                                <li><a href="">Accounting</a></li>
                                                <li><a href="">Tax</a></li>
                                                <li><a href="">Payroll Outsourcing</a></li>
                                                <li><a href="">Company Formations</a></li>
                                                
                                            
                                                <!--<li><a href="about.html">About Us</a></li>
                                                <li><a href="jobs.html">Jobs</a></li>
                                                <li><a href="contact.html">Contact</a></li>-->
                                            </ul>
                                        </li>
                                        <li>
                                            <!--<a href="#">Pricing<span></span></a>
                                            <ul>
                                                <li><a href="pricing.html">Software Pricing</a></li>
                                                <li><a href="pricing.html">Other Pricing</a></li>
                                                <!--<li><a href="features.html">Features</a></li>
												<li><a href="pricing.html">Pricing</a></li>
                                                <li><a href="reviews.html">Reviews</a></li>
                                                <li><a href="download.html">Download</a></li>
                                                <li><a href="video-tutorial.html">Video Tutorial</a></li>-->
                                            </ul>
                                        </li>
                                        <li>
                                            <!--<a href="#">Pages<span></span></a>
                                            <ul>
												<li><a href="blog.html">Blog</a></li>
												<li><a href="gallery.html">Gallery</a></li>
                                                <li><a href="login.html">Login</a></li>
												<li><a href="login-2.html">Login 2</a></li>
                                                <li><a href="register.html">Register</a></li>
												<li><a href="contact.html">Contact Us</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Elements<span></span></a>
                                            <ul>
												<li><a href="icons-font-awesome.html">Font Awesome Icons</a></li>
												<li><a href="icons-elegant.html">Elegant Icons</a></li>
												<li><a href="icons-etline.html">Etline Icons</a></li>
                                                <li><a href="alerts.html">Alerts</a></li>
												<li><a href="accordion.html">Accordion</a></li>
												<li><a href="modal.html">Modal</a></li>
												<li><a href="progress-bar.html">Progress Bar</a></li>
												<li><a href="tabs.html">Tabs</a></li>
												<li><a href="timeline.html">Timeline</a></li>
												<li><a href="counters.html">Counters</a></li>
                                            </ul>
                                        </li>-->
                                    </ul>
                                </div>
                                
                                <div class="de-flex-col">
                                    <a class="btn-border" href="{{ url('login') }}"><i class=""></i> Log In</a>
                                    <span id="menu-btn"></span>
                               
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- header close -->
            <!-- content begin -->
            <div class="no-bottom no-top" id="content">
                <div id="top"></div>

                <section aria-label="section" data-bgimage="{{asset('frontend/images/background/3.jpg')}} bottom" class="text-light">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6text-center wow fadeInLeft" data-wow-delay=".5s">
                                <img src="{{asset('frontend/images/misc/1.png')}}" class="img-fluid" alt="" />
                            </div>

                            <div class="col-lg-5 offset-lg-1 wow fadeInRight" data-wow-delay=".5s">
                                <div class="spacer-10"></div>
                                 <div class="h1 text-light"><br>
                                    
                                    <div class="typed-strings">
                                        <p>Take</p>
                                        <p>Be In</p>
                                        <p>Keep</p>
                                        
                                    </div>
                                    
                                    <div class="typed"></div>
                                <a class="h1" style="color: yellowgreen">Ctrl</a>
                                     Of your finances
                                
                                </div>
                                <p class="lead">Finally, free online invoicing software! Expert advice and great accountancy packages.</p>
                                <div class="spacer-20"></div>
                                <a class="btn-custom" href="{{ route('register') }}">Get Started</a>&nbsp;
                                <a class="btn-border btn-invert" href="{{ route('login') }}">Log In</a>
                                <div class="mb-sm-30"></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="section-highlight" class="text-light" data-bgcolor="#2d2a39">
                    <div class="container">
                        <div class="text-center">
                            <span class="p-title">Discover</span><br>
                            <h2>What we do</h2>
                            <div class="small-border"></div>
                        </div>
                        <div class="row sequence">
                            
                         <div class="col-lg-4 col-md-6 mb30">
                            <div class="feature-box f-boxed style-3">
                                <i class="bg-color i-circle fa fa-cloud"></i>
                                <div class="text">
                                    <h4>Cloud Software</h4>
                                    Save time and keep control of your finances.
                                </div>
                                <i class="wm fa fa-cloud"></i>
                            </div>
                        </div>
                            
                            <div class="col-lg-4 col-md-6 mb30">
                            <div class="feature-box f-boxed style-3">
                                <i class="bg-color i-circle fa fa-line-chart"></i>
                                <div class="text">
                                    <h4>Accounting And Tax</h4>
                                    Accounting, Bookkeeping, Vat and Tax.
                                </div>
                                <i class="wm fa fa-chart"></i>
                            </div>
                        </div>
                            
                        <div class="col-lg-4 col-md-6 mb30">
                            <div class="feature-box f-boxed style-3">
                                <i class="bg-color i-circle fa fa-money"></i>
                                <div class="text">
                                    <h4>Payroll</h4>
                                    Payroll Outsourcing.
                                </div>
                                <i class="wm fa fa-money"></i>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 mb30">
                            <div class="feature-box f-boxed style-3">
                                <i class="bg-color i-circle fa fa-star"></i>
                                <div class="text">
                                    <h4>Business Advisory</h4>
                                    Business development, finance and growth.
                                </div>
                                <i class="wm fa fa-star"></i>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 mb30">
                            <div class="feature-box f-boxed style-3">
                                <i class="bg-color i-circle fa fa-usd"></i>
                                <div class="text">
                                    <h4>Fixed Monthly Pricing</h4>
                                    Fixed Monthly Pricing agreed in advance with no additional extras.
                                </div>
                                <i class="wm fa fa-usd"></i>
                            </div>
                        </div>
                        

                        <div class="col-lg-4 col-md-6 mb30">
                            <div class="feature-box f-boxed style-3">
                                <i class="bg-color i-circle fa fa-bullhorn"></i>
                                <div class="text">
                                    <h4>Unlimited Support and Advice</h4>
                                    Call or email us as many times as you need, we are always here to help.
                                </div>
                                <i class="wm fa fa-bullhorn"></i>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                </section>

                <section id="section-banner" class="text-light" data-bgcolor="#282533">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 d-none d-lg-block d-xl-block text-center wow fadeInRight" data-wow-delay="0s">
                                <img class="relative img-fluid" src="{{asset('frontend/images/misc/5.png')}}" alt="" />
                            </div>

                            <div class="col-lg-5 offset-md-1 wow fadeInLeft" data-wow-delay="0s">
                                <span class="p-title">Sofware</span>
                                <h2>
                                    Simple Invoice and Expense Software
                                </h2>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Invoices</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Expenses</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Add ons</a>
                              </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"><p>Our Software makes it easy for Small Businesses to manage Invoices and Expenses.</p></div>
                              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"><p>Our Software makes it easy for Small Businesses to manage Invoices and Expenses.</p></div>
                              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"><p>Our Software makes it easy for Small Businesses to manage Invoices and Expenses.</p></div>
                            </div>
                                <div class="spacer-half"></div>
                                <a class="btn-custom" href="features.html">Learn More</a>&nbsp;
                                <a class="btn-border btn-invert" href="download.html">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- section begin -->
            <section class="text-light" data-bgcolor="#2d2a39">
                <div class="container">
                    <div class="row">
                        <div class="col text-center"> 
                                    <span class="p-title">Select</span><br>
                                    <h2>Pricing Plans</h2>
                                    <div class="small-border"></div>
                                    
                            <div class="switch-set">
                                <div>Monthly</div>                              
                                <div><input id="sw-1" class="switch" type="checkbox" /></div>                   
                                <div>Yearly</div>
                                <div class="spacer-20"></div>
                            </div>
                            
                        </div>
                    </div>
                         
                                    <div class="row sequence">
                                        <div class="col-lg-4 col-md-6 col-sm-12 sq-item wow">
                                            <div class="pricing-s1 mb30">
                                                <div class="top">
                                                    <h2>Free</h2>
                                                    <p class="plan-tagline">Basic</p>            
                                                </div>
                                                <div class="mid text-light bg-color">
                                                    <p class="price">
                                                        <span class="currency">$</span>
                                                        <span class="m opt-1">0</span>
                                                        <span class="y opt-2">0</span>
                                                        <span class="month">p/mo</span>
                                                    </p>               
                                                </div>
                                                
                                                <div class="bottom">

                                                    <ul>
                                                        <li><i class="fa fa-check"></i>1 device</li>
                                                        <li><i class="fa fa-check"></i>Daily reminder</li>
                                                        <li><i class="fa fa-check"></i>Simple reporting</li>
                                                        <li><i class="fa fa-check"></i>Standart dashboard</li>
                                                        <li><i class="fa fa-check"></i>Email Notification</li>
                                                        <li><i class="fa fa-check"></i>Email Support</li>
                                                    </ul>
                                                </div>
                                                
                                                <div class="action">
                                                    <a href="register.html" class="btn-custom">Sign Up Now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 sq-item wow">
                                            <div class="pricing-s1 mb30">
                                                <div class="top">
                                                    <h2>Pro</h2>
                                                    <p class="plan-tagline">For Individuals
                                                </div>
                                                    <div class="mid text-light bg-color">
                                                    <p class="price">
                                                        <span class="currency">$</span>
                                                        <span class="m opt-1">9.59</span>
                                                        <span class="y opt-2">7.46</span>
                                                        <span class="month">p/mo</span>
                                                    </p>     
                                                </div>
                                                <div class="bottom">
                                                    <ul>
                                                        <li><i class="fa fa-check"></i>Up to 2 devices</li>
                                                        <li><i class="fa fa-check"></i>Daily reminder</li>
                                                        <li><i class="fa fa-check"></i>Detailed reporting</li>
                                                        <li><i class="fa fa-check"></i>Interactive dashboard</li>
                                                        <li><i class="fa fa-check"></i>Email and SMS notification</li>
                                                        <li><i class="fa fa-check"></i>24/7 Customer Support</li>
                                                    </ul>
                                                </div>
                                                
                                                <div class="action">
                                                    <a href="register.html" class="btn-custom">Sign Up Now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 sq-item wow">
                                            <div class="pricing-s1 mb30">
                                                <div class="top">
                                                    <h2>For Teams</h2>
                                                    <p class="plan-tagline">Best for organization</p>
                                                </div>
                                                <div class="mid text-light bg-color">
                                                    <p class="price">
                                                        <span class="currency">$</span>
                                                        <span class="m opt-1">24.99</span>
                                                        <span class="y opt-2">16.49</span>
                                                        <span class="month">p/mo</span>
                                                    </p>     
                                                </div>
                                                <div class="bottom">
                                                    <ul>
                                                        <li><i class="fa fa-check"></i>Up to 10 devices</li>
                                                        <li><i class="fa fa-check"></i>Daily reminder</li>
                                                        <li><i class="fa fa-check"></i>Detailed reporting</li>
                                                        <li><i class="fa fa-check"></i>Interactive dashboard</li>
                                                        <li><i class="fa fa-check"></i>Email and SMS notification</li>
                                                        <li><i class="fa fa-check"></i>24/7 Customer Support</li>
                                                    </ul>
                                                </div>
                                                
                                                <div class="action">
                                                    <a href="register.html" class="btn-custom">Sign Up Now</a>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 offset-lg-3 text-center">
                                            <small>Price shown are in ZAR </small>
                                        </div>
                                    </div>

                                    <div class="spacer-double"></div>


                                    <div class="row">

                                        <div class="col-md-12 text-center">
                                            <h2>FAQ</h2>
                                            <div class="small-border"></div>
                                        </div>

                        <div class="col-md-6">
                            <!-- Accordion -->
                            <div id="accordion-1" class="accordion">

                                <!-- Accordion item 1 -->
                                <div class="card">
                                    <div id="heading-a1" class="card-header shadow-sm border-0">
                                        <h6 class="mb-0 font-weight-bold"><a href="#" data-toggle="collapse" data-target="#collapse-a1" aria-expanded="false" aria-controls="collapse-a1" class="d-block position-relative collapsible-link py-2">How do i get the app for my phone?</a></h6>
                                    </div>
                                    <div id="collapse-a1" aria-labelledby="heading-a1" data-parent="#accordion-1" class="collapse">
                                        <div class="card-body p-4">
                                            <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Accordion item 2 -->
                                <div class="card">
                                    <div id="heading-a2" class="card-header shadow-sm border-0">
                                        <h6 class="mb-0 font-weight-bold"><a href="#" data-toggle="collapse" data-target="#collapse-a2" aria-expanded="false" aria-controls="collapse-a2" class="d-block position-relative collapsed collapsible-link py-2">What plan I should choose?</a></h6>
                                    </div>
                                    <div id="collapse-a2" aria-labelledby="heading-a2" data-parent="#accordion-1" class="collapse">
                                        <div class="card-body p-4">
                                            <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Accordion item 3 -->
                                <div class="card">
                                    <div id="heading-a3" class="card-header shadow-sm border-0">
                                        <h6 class="mb-0 font-weight-bold"><a href="#" data-toggle="collapse" data-target="#collapse-a3" aria-expanded="false" aria-controls="collapse-a3" class="d-block position-relative collapsed collapsible-link py-2">What happen to my app if I stop paying?</a></h6>
                                    </div>
                                    <div id="collapse-a3" aria-labelledby="heading-a3" data-parent="#accordion-1" class="collapse">
                                        <div class="card-body p-4">
                                            <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        

                        <div class="col-md-6">
                            <!-- Accordion -->
                            <div id="accordion-2" class="accordion">

                                <!-- Accordion item 1 -->
                                <div class="card">
                                    <div id="heading-b1" class="card-header shadow-sm border-0">
                                        <h6 class="mb-0 font-weight-bold"><a href="#" data-toggle="collapse" data-target="#collapse-b1" aria-expanded="false" aria-controls="collapse-b1" class="d-block position-relative collapsible-link py-2">Does it have in-app purchases?</a></h6>
                                    </div>
                                    <div id="collapse-b1" aria-labelledby="heading-b1" data-parent="#accordion-2" class="collapse">
                                        <div class="card-body p-4">
                                            <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Accordion item 2 -->
                                <div class="card">
                                    <div id="heading-b2" class="card-header shadow-sm border-0">
                                        <h6 class="mb-0 font-weight-bold"><a href="#" data-toggle="collapse" data-target="#collapse-b2" aria-expanded="false" aria-controls="collapse-b2" class="d-block position-relative collapsed collapsible-link py-2">Can I use this app on multiple devices?</a></h6>
                                    </div>
                                    <div id="collapse-b2" aria-labelledby="heading-b2" data-parent="#accordion-2" class="collapse">
                                        <div class="card-body p-4">
                                            <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Accordion item 3 -->
                                <div class="card">
                                    <div id="heading-b3" class="card-header shadow-sm border-0">
                                        <h6 class="mb-0 font-weight-bold"><a href="#" data-toggle="collapse" data-target="#collapse-b3" aria-expanded="false" aria-controls="collapse-b3" class="d-block position-relative collapsed collapsible-link py-2">Is my phone supported for this app?</a></h6>
                                    </div>
                                    <div id="collapse-b3" aria-labelledby="heading-b3" data-parent="#accordion-2" class="collapse">
                                        <div class="card-body p-4">
                                            <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- section close -->

               <!-- <section id="section-testimonial" class="text-light" data-bgcolor="#282533">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <span class="p-title">Latest</span><br>
                                    <h2>Customer Reviews</h2>
                                    <div class="small-border"></div>
                                </div>
                                <div class="owl-carousel owl-theme wow fadeInUp" id="testimonial-carousel">
                                    <div class="item">
                                        <div class="de_testi opt-2 review">
                                            <blockquote>
                                                <div class="p-rating">
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <h3>Pretty Awesome!</h3>
                                                <p>Great app, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>
                                                <div class="de_testi_by"><span>John, Pixar Studio</span></div>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="de_testi opt-2 review">
                                            <blockquote>
                                                <div class="p-rating">
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <h3>Excellent!</h3>
                                                <p>Great app, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>
                                                <div class="de_testi_by"><span>Sarah, Microsoft</span></div>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="de_testi opt-2 review">
                                            <blockquote>
                                                <div class="p-rating">
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <h3>Unbelievable!</h3>
                                                <p>Great app, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>
                                                <div class="de_testi_by"><span>Michael, Apple</span></div>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="de_testi opt-2 review">
                                            <blockquote>
                                                <div class="p-rating">
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <h3>Fantastic!</h3>
                                                <p>Great app, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>
                                                <div class="de_testi_by"><span>Thomas, Samsung</span></div>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="de_testi opt-2 review">
                                            <blockquote>
                                                <div class="p-rating">
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <h3>Easy to use!</h3>
                                                <p>Great app, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>
                                                <div class="de_testi_by"><span>John, Pixar Studio</span></div>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="de_testi opt-2 review">
                                            <blockquote>
                                                <div class="p-rating">
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <h3>Beauty Interface!</h3>
                                                <p>Great app, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>
                                                <div class="de_testi_by"><span>Sarah, Microsoft</span></div>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="de_testi opt-2 review">
                                            <blockquote>
                                                <div class="p-rating">
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <h3>Great App!</h3>
                                                <p>Great app, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>
                                                <div class="de_testi_by"><span>Michael, Apple</span></div>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="de_testi opt-2 review">
                                            <blockquote>
                                                <div class="p-rating">
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <h3>Love It!</h3>
                                                <p>Great app, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>
                                                <div class="de_testi_by"><span>Thomas, Samsung</span></div>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="section-fun-facts" class="pt60 pb60 text-light" data-bgcolor="#2d2a39">
                    <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <h2 class="no-bottom id-color">2010</h2>
                            <h5>Year we've founded</h5>
                        </div>

                     <div class="col-md-3">
                            <h2 class="no-bottom id-color">3m</h2>
                            <h5>Monthly active users</h5>
                        </div>

                     <div class="col-md-3">
                            <h2 class="no-bottom id-color">100+</h2>
                            <h5>Team members</h5>
                        </div>

                     <div class="col-md-3">
                            <h2 class="no-bottom id-color">75</h2>
                            <h5>Countries using our product</h5>
                        </div>
                    </div>
                </div>
                </section>

                <section aria-label="section" class="no-top no-bottom text-light" data-bgcolor="#282533">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <span class="p-title">Download</span><br>
                                <h2>Available on iOS and Android</h2>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem.</p>
                                <a href="download.html"><img src="images/misc/download-appstore.png" class="img-fluid" alt="download"></a>&nbsp;
                                <a href="download.html"><img src="images/misc/download-playstore.png" class="img-fluid" alt="download"></a>
                            </div>

                            <div class="col-md-6 text-center">
                                <img src="images/misc/2.png" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- content close -->

            <a href="#" id="back-to-top"></a>
        
        <!-- footer begin -->
            <footer class="footer-light">
                <div class="container">
                    <div class="row">
						<div class="col-lg-2">
                            <div class="widget">
                                <a href="/"><img alt="" class="logo" src="{{asset('frontend/images/logo-light.png')}}"></a>
                            </div>
                        </div>
						
                        <div class="col-lg-2">
                                    <div class="widget">
                                        <h5>Company</h5>
                                        <ul>
											<li><a class="a-underline" href="about.html">About Us<span></span></a></li>
                                            <li><a class="a-underline" href="jobs.html">Jobs<span></span></a></li>
                                            <li><a class="a-underline" href="contact.html">Contact<span></span></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="widget">
                                        <h5>Product</h5>
                                        <ul>
                                           <li><a class="a-underline" href="features.html">Features<span></span></a></li>
                                           <li><a class="a-underline" href="pricing.html">Pricing<span></span></a></li>
                                           <li><a class="a-underline" href="reviews.html">Reviews<span></span></a></li>
                                           <li><a class="a-underline" href="download.html">Download<span></span></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="widget">
                                        <h5>Resources</h5>
                                        <ul>
                                            <li><a class="a-underline" href="blog.html">Blog<span></span></a></li>
                                            <li><a class="a-underline" href="video-tutorial.html">Video Tutorial<span></span></a></li>
                                        </ul>
                                    </div>
                                </div>


                        <div class="col-lg-4">
                            <div class="widget">
                                <h5>Newsletter</h5>

                                <p>Signup for our newsletter to get the latest news, updates and special offers in your inbox.</p>
                                <form action="blank.php" class="row" id="form_subscribe" method="post" name="form_subscribe">
                                    <div class="col text-center">
                                        <input class="form-control" id="name_1" name="name_1" placeholder="enter your email" type="text" /> <a href="#" id="btn-submit"><i class="arrow_right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                                <div class="spacer-10"></div>
                                <small>Your email is safe with us. We don't spam.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="subfooter">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="de-flex">
                                    <div class="de-flex-col">
                                        <span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=kpIkSupOsm9wgpnYLJRmVUMJyEpC2YotQPcAVUgTBuBQ0xToRASSF3hmRNav"></script></span>
                                        &copy; Copyright 2020 - Ctrl
                                    </div>
                                    

                                    <div class="de-flex-col">
                                        <div class="social-icons">
                                            <a href="#"><i class="fa fa-facebook fa-lg"></i></a>
                                            <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                                            <a href="#"><i class="fa fa-linkedin fa-lg"></i></a>
                                            <a href="#"><i class="fa fa-pinterest fa-lg"></i></a>
                                            <a href="#"><i class="fa fa-rss fa-lg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- footer close -->

            <div id="preloader">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
        </div>

        <div id="cookieConsent">
            <div class="container-fluid">
                <div class="de-flex">
                    <div class="de-flex-content">
                        This website is using cookies. <a href="#" target="_blank">More info</a>.
                    </div>
                    <div class="de-flex-content">
                        <a class="cookieConsentOK">Accept All Cookies</a>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Javascript Files
    ================================================== -->
        <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
        <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('frontend/js/wow.min.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.isotope.min.js')}}"></script>
        <script src="{{asset('frontend/js/easing.js')}}"></script>
        <script src="{{asset('frontend/js/owl.carousel.js')}}"></script>
        <script src="{{asset('frontend/js/validation.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('frontend/js/enquire.min.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.stellar.min.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.plugin.js')}}"></script>
        <script src="{{asset('frontend/js/typed.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.countTo.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.countdown.js')}}"></script>
        <script src="{{asset('frontend/js/typed.js')}}"></script>
        <script src="{{asset('frontend/js/designesia.js')}}"></script>

        <script>
        $(function () {
            // jquery typed plugin
            $(".typed").typed({
                stringsElement: $('.typed-strings'),
                typeSpeed: 100,
                backDelay: 1500,
                loop: true,
                contentType: 'html', // or text
                // defaults to false for infinite loop
                loopCount: false,
                callback: function () { null; },
                resetCallback: function () { newTyped(); }
            });
        });
    </script>       

    </body>
</html>
