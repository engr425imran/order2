@php
    use \App\Http\Controllers\HomeController;
    $paid ='';
@endphp
@extends('master')
@section('title')
    {{$title}}
@endsection

@section('stylesheet')
    {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> --}}

@endsection
@section('content')
                
    {{-- ************************** First Section Start ************************** --}}
    
        <div class="row">

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-primary bg-darken-2">
                                <i class="icon-docs font-large-2 white"></i>
                            </div>
                            <div class="p-2 bg-gradient-x-primary white media-body">
                                <h5>Invoice</h5>
                                <h5 class="text-bold-400 mb-0"><i class="ft-droplet"></i> {{$total_inv}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-danger bg-darken-2">
                                <i class="icon-bar-chart font-large-2 white"></i>
                            </div>
                            <div class="p-2 bg-gradient-x-danger white media-body">
                                <h5>Draft Invoice</h5>
                                <h5 class="text-bold-400 mb-0">
                                    {{--<i class="ft-arrow-up"></i>--}}
                                    <i class="ft-droplet"></i>{{HomeController::check_inv_statistics(1)}}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-warning bg-darken-2">
                                <i class="fa fa-bank font-large-2 white"></i>
                            </div>
                            <div class="p-2 bg-gradient-x-warning white media-body">
                                <h5>Awaiting Payment</h5>
                                <h5 class="text-bold-400 mb-0">
                                    {{-- <i class="ft-arrow-down"></i>  --}}
                                    <i class="ft-droplet"></i>
                                    {{HomeController::check_inv_statistics(2)}}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-success bg-darken-2">
                                <i class="fa fa-balance-scale font-large-2 white"></i>
                            </div>
                            <div class="p-2 bg-gradient-x-success white media-body">
                                <h5>Paid Invoice</h5>
                                <h5 class="text-bold-400 mb-0">
                                    {{-- <i class="ft-arrow-up"></i>  --}}
                                    <i class="ft-droplet"></i>
                                    {{$p_inv}}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    {{-- ************************** First Section End **************************** --}}   


    {{-- ************************** Second Section Start ************************* --}}   
       
                
        <!--Product sale & buyers -->
        <div class="row match-height">
            
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Products Sales</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div id="invoice" class="height-300"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent customer --}}
            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Recent Customers</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content px-1">
                        <div id="recent-buyers" class="media-list height-300 position-relative">

                            @foreach ($invoices as $cus)

                                @if ($cus->status == 1 || $cus->status == 2)
                                <a href="{{ url('/cubebooks/edit-invoice/'.$cus->invoice_id) }}" target="_blank" class="media border-0">

                                    <div class="media-left pr-1">
                                        <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle" src="{{asset('public/img/avatar-s-1.png')}}" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="media-body w-100">
                                        <h6 class="list-group-item-heading">{{$cus->display_name}} <span class="font-medium-4 float-right pt-1">${{number_format($cus->final_total)}}</span></h6>
                                        <p class="list-group-item-text mb-0">
                                            @php
                                                $paid = DB::table('inv_payment_details')->where('inv_id', $cus->invoice_id)->sum('amount');

                                                $due = ($cus->final_total - $paid);
                                            @endphp
                                            
                                            @if ($due==0)
                                                <span class="badge badge-pill badge-success">Paid</span>
                                            @elseif ($cus->status == 1)
                                                <span class="badge badge-pill badge-secondary">Draft</span>
                                            @elseif ($cus->status == 2)
                                                <span class="badge badge-pill badge-warning">Awaiting Approval</span>
                                            @else 
                                                <span class="badge badge-pill badge-danger">Awaiting Payment</span>
                                            @endif
                                        </p>
                                    </div>
                                </a>
                                @endif
                                @if ($cus->status == 3)
                                <a href="{{ url('/cubebooks/view-invoice/'.$cus->invoice_id) }}" target="_blank" class="media border-0">

                                    <div class="media-left pr-1">
                                        <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle" src="{{asset('public/img/avatar-s-1.png')}}" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="media-body w-100">
                                        <h6 class="list-group-item-heading">{{$cus->display_name}} <span class="font-medium-4 float-right pt-1">${{number_format($cus->final_total)}}</span></h6>
                                        <p class="list-group-item-text mb-0">
                                            @php
                                                $paid = DB::table('inv_payment_details')->where('inv_id', $cus->invoice_id)->sum('amount');

                                                $due = ($cus->final_total - $paid);
                                            @endphp
                                            
                                            @if ($due==0)
                                                <span class="badge badge-pill badge-success">Paid</span>
                                            @elseif ($cus->status == 1)
                                                <span class="badge badge-pill badge-secondary">Draft</span>
                                            @elseif ($cus->status == 2)
                                                <span class="badge badge-pill badge-warning">Awaiting Approval</span>
                                            @else 
                                                <span class="badge badge-pill badge-danger">Awaiting Payment</span>
                                            @endif
                                        </p>
                                    </div>
                                </a>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
                
    {{-- ************************** Second Section End *************************** --}}


    {{-- ************************** Third Section Start ************************** --}}

        <div class="row">

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-primary bg-darken-2">
                                <i class="icon-users font-large-2 white"></i>
                            </div>
                            <div class="p-2 bg-gradient-x-primary white media-body">
                                <h5>Active Customers</h5>
                                <h5 class="text-bold-400 mb-0"><i class="ft-droplet"></i> {{$a_customer}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-danger bg-darken-2">
                                <i class="icon-users font-large-2 white"></i>
                            </div>
                            <div class="p-2 bg-gradient-x-danger white media-body">
                                <h5>Inactive Customer</h5>
                                <h5 class="text-bold-400 mb-0"><i class="ft-arrow-down"></i>{{$i_customer}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-warning bg-darken-2">
                                <i class="fa fa-bank font-large-2 white"></i>
                            </div>
                            <div class="p-2 bg-gradient-x-warning white media-body">
                                <h5>Banking</h5>
                                <h5 class="text-bold-400 mb-0"><i class="ft-arrow-down"></i> 4,658</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-success bg-darken-2">
                                <i class="fa fa-balance-scale font-large-2 white"></i>
                            </div>
                            <div class="p-2 bg-gradient-x-success white media-body">
                                <h5>Accounting</h5>
                                <h5 class="text-bold-400 mb-0"><i class="ft-arrow-up"></i> 5.6 M</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--Recent Orders & Monthly Salse -->
        <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Recent Orders</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p>{{--Total paid invoices 240, unpaid 150.--}} <span class="float-right"><a href="{{route('invoices')}}" target="_blank">Invoice Summary <i class="ft-arrow-right"></i></a></span></p>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover mb-0 ps-container ps-theme-default">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Ref</th>
                                        <th>To</th>
                                        <th>Date</th>
                                        <th>Due Date</th>
                                        <th>Due</th>
                                        <th>Paid</th>
                                        <th>Status</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($invoices as $item)
                                        @php
                                            $paid = DB::table('inv_payment_details')->where('inv_id', $item->invoice_id)->sum('amount');

                                            $due = ($item->final_total - $paid);
                                        @endphp
                                        <tr>
                                            <td>
                                                @if ($item->status == 1 || $item->status == 2)

                                                    <a href="{{ url('/cubebooks/edit-invoice/'.$item->invoice_id) }}" target="_blank">
                                                        {{$invName.$item->invoice_code}}
                                                    </a>
                                                @endif

                                                @if ($item->status == 3)

                                                    <a href="{{ url('/cubebooks/view-invoice/'.$item->invoice_id) }}" target="_blank">
                                                        {{$invName.$item->invoice_code}}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$item->reference}}</td>
                                            <td>{{$item->display_name}}</td>
                                            <td>{{$item->invoice_date}}</td>
                                            <td>{{$item->due_date}}</td>
                                            <td>{{$due}}</td>
                                            <td>{{$paid}}</td>
                                            <td>
                                                @if ($due==0)
                                                    <span class="badge badge-pill badge-success">Paid</span>
                                                @elseif ($item->status == 1)
                                                    <span class="badge badge-pill badge-secondary">Draft</span>
                                                @elseif ($item->status == 2)
                                                    <span class="badge badge-pill badge-warning">Awaiting Approval</span>
                                                @else 
                                                    <span class="badge badge-pill badge-danger">Awaiting Payment</span>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                                <thead>
                                    <tr>
                                        <th>SKU</th>
                                        <th>Invoice#</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-truncate">PO-10521</td>
                                        <td class="text-truncate"><a href="#">INV-001001</a></td>
                                        <td class="text-truncate">Elizabeth W.</td>
                                        <td class="text-truncate"><span class="badge badge-success">Paid</span></td>
                                        <td class="text-truncate">$ 1200.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">PO-532521</td>
                                        <td class="text-truncate"><a href="#">INV-01112</a></td>
                                        <td class="text-truncate">Doris R.</td>
                                        <td class="text-truncate"><span class="badge badge-warning">Overdue</span></td>
                                        <td class="text-truncate">$ 5685.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">PO-05521</td>
                                        <td class="text-truncate"><a href="#">INV-001012</a></td>
                                        <td class="text-truncate">Andrew D.</td>
                                        <td class="text-truncate"><span class="badge badge-success">Paid</span></td>
                                        <td class="text-truncate">$ 152.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">PO-15521</td>
                                        <td class="text-truncate"><a href="#">INV-001401</a></td>
                                        <td class="text-truncate">Megan S.</td>
                                        <td class="text-truncate"><span class="badge badge-success">Paid</span></td>
                                        <td class="text-truncate">$ 1450.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">PO-32521</td>
                                        <td class="text-truncate"><a href="#">INV-008101</a></td>
                                        <td class="text-truncate">Walter R.</td>
                                        <td class="text-truncate"><span class="badge badge-warning">Overdue</span></td>
                                        <td class="text-truncate">$ 685.00</td>
                                    </tr>
                                </tbody>
                            </table> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body sales-growth-chart">
                            <div id="monthly-sales" class="height-250"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="chart-title mb-1 text-center">
                            <h6>Total monthly Sales.</h6>
                        </div>
                        <div class="chart-stats text-center">
                            <a href="#" class="btn btn-sm btn-primary mr-1">Statistics <i class="ft-bar-chart"></i></a> <span class="text-muted">for the last year.</span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

    {{-- ************************** Third Section End **************************** --}}

    <!--/Recent Orders & Monthly Salse -->
    <!-- Social & Weather -->
    {{-- <div class="row match-height">
        <div class="col-xl-4 col-lg-12">
            <div class="card bg-gradient-x-danger">
                <div class="card-content">
                    <div class="card-body">
                        <div class="animated-weather-icons text-center float-left">
                            <svg version="1.1" id="cloudHailAlt2" class="climacon climacon_cloudHailAlt climacon-blue-grey climacon-darken-2 height-100" viewBox="15 15 70 70">
                                <g class="climacon_iconWrap climacon_iconWrap-cloudHailAlt">
                                    <g class="climacon_wrapperComponent climacon_wrapperComponent-hailAlt">
                                        <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left">
                                            <circle cx="42" cy="65.498" r="2"></circle>
                                        </g>
                                        <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle">
                                            <circle cx="49.999" cy="65.498" r="2"></circle>
                                        </g>
                                        <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right">
                                            <circle cx="57.998" cy="65.498" r="2"></circle>
                                        </g>
                                        <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left">
                                            <circle cx="42" cy="65.498" r="2"></circle>
                                        </g>
                                        <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle">
                                            <circle cx="49.999" cy="65.498" r="2"></circle>
                                        </g>
                                        <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right">
                                            <circle cx="57.998" cy="65.498" r="2"></circle>
                                        </g>
                                    </g>
                                    <g class="climacon_wrapperComponent climacon_wrapperComponent-cloud">
                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_cloud" d="M63.999,64.941v-4.381c2.39-1.384,3.999-3.961,3.999-6.92c0-4.417-3.581-8-7.998-8c-1.602,0-3.084,0.48-4.334,1.291c-1.23-5.317-5.974-9.29-11.665-9.29c-6.626,0-11.998,5.372-11.998,11.998c0,3.549,1.55,6.728,3.999,8.924v4.916c-4.776-2.768-7.998-7.922-7.998-13.84c0-8.835,7.162-15.997,15.997-15.997c6.004,0,11.229,3.311,13.966,8.203c0.663-0.113,1.336-0.205,2.033-0.205c6.626,0,11.998,5.372,11.998,12C71.998,58.863,68.656,63.293,63.999,64.941z"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="weather-details text-center">
                            <span class="block white darken-1">Snow</span>
                            <span class="font-large-2 block white darken-4">-5&deg;</span>
                            <span class="font-medium-4 text-bold-500 white darken-1">London, UK</span>
                        </div>
                    </div>
                    <div class="card-footer bg-gradient-x-danger border-0">
                        <div class="row">
                            <div class="col-4 text-center display-table-cell white">
                                <i class="me-wind font-large-1 lighten-3 align-middle"></i> <span class="align-middle">2MPH</span>
                            </div>
                            <div class="col-4 text-center display-table-cell white">
                                <i class="me-sun2 font-large-1 lighten-3 align-middle"></i> <span class="align-middle">2%</span>
                            </div>
                            <div class="col-4 text-center display-table-cell white">
                                <i class="me-thermometer font-large-1 lighten-3 align-middle"></i> <span class="align-middle">13.0&deg;</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card bg-gradient-x-info white">
                <div class="card-content">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="fa fa-twitter font-large-2"></i>
                        </div>
                        <div class="tweet-slider">
                            <ul>
                                <li>Congratulations to Rob Jones in accounting for winning our <span class="yellow">#NFL</span> football pool!
                                    <p class="text-italic pt-1">- John Doe</p>
                                </li>
                                <li>Contests are a great thing to partner on. Partnerships immediately <span class="yellow">#DOUBLE</span> the reach.
                                    <p class="text-italic pt-1">- John Doe</p>
                                </li>
                                <li>Puns, humor, and quotes are great content on <span class="yellow">#Twitter</span>. Find some related to your business.
                                    <p class="text-italic pt-1">- John Doe</p>
                                </li>
                                <li>Are there <span class="yellow">#common-sense</span> facts related to your business? Combine them with a great photo.
                                    <p class="text-italic pt-1">- John Doe</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card bg-gradient-x-primary white">
                <div class="card-content">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="fa fa-facebook font-large-2"></i>
                        </div>
                        <div class="fb-post-slider">
                            <ul>
                                <li>Congratulations to Rob Jones in accounting for winning our #NFL football pool!
                                    <p class="text-italic pt-1">- John Doe</p>
                                </li>
                                <li>Contests are a great thing to partner on. Partnerships immediately #DOUBLE the reach.
                                    <p class="text-italic pt-1">- John Doe</p>
                                </li>
                                <li>Puns, humor, and quotes are great content on #Twitter. Find some related to your business.
                                    <p class="text-italic pt-1">- John Doe</p>
                                </li>
                                <li>Are there #common-sense facts related to your business? Combine them with a great photo.
                                    <p class="text-italic pt-1">- John Doe</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!--/ Social & Weather -->
    <!-- Basic Horizontal Timeline -->
    {{-- <div class="row match-height">
        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Horizontal Timeline</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="card-text">
                            <section class="cd-horizontal-timeline">
                                <div class="timeline">
                                    <div class="events-wrapper">
                                        <div class="events">
                                            <ol>
                                                <li><a href="#0" data-date="16/01/2015" class="selected">16 Jan</a></li>
                                                <li><a href="#0" data-date="28/02/2015">28 Feb</a></li>
                                                <li><a href="#0" data-date="20/04/2015">20 Mar</a></li>
                                                <li><a href="#0" data-date="20/05/2015">20 May</a></li>
                                                <li><a href="#0" data-date="09/07/2015">09 Jul</a></li>
                                                <li><a href="#0" data-date="30/08/2015">30 Aug</a></li>
                                                <li><a href="#0" data-date="15/09/2015">15 Sep</a></li>
                                            </ol>
                                            <span class="filling-line" aria-hidden="true"></span>
                                        </div>
                                        <!-- .events -->
                                    </div>
                                    <!-- .events-wrapper -->
                                    <ul class="cd-timeline-navigation">
                                        <li><a href="#0" class="prev inactive">Prev</a></li>
                                        <li><a href="#0" class="next">Next</a></li>
                                    </ul>
                                    <!-- .cd-timeline-navigation -->
                                </div>
                                <!-- .timeline -->
                                <div class="events-content">
                                    <ol>
                                        <li class="selected" data-date="16/01/2015">
                                            <blockquote class="blockquote border-0">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img class="media-object img-xl mr-1" src="{{asset('public/img/avatar-s-1.png')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <div class="media-body">
                                                        Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                    </div>
                                                </div>
                                                <footer class="blockquote-footer text-right">Steve Jobs
                                                    <cite title="Source Title">Entrepreneur</cite>
                                                </footer>
                                            </blockquote>
                                            <p class="lead mt-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                            </p>
                                        </li>
                                        <li data-date="28/02/2015">
                                            <blockquote class="blockquote border-0">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img class="media-object img-xl mr-1" src="{{asset('public/img/avatar-s-1.png')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <div class="media-body">
                                                        Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                    </div>
                                                </div>
                                                <footer class="blockquote-footer text-right">Steve Jobs
                                                    <cite title="Source Title">Entrepreneur</cite>
                                                </footer>
                                            </blockquote>
                                            <p class="lead mt-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                            </p>
                                        </li>
                                        <li data-date="20/04/2015">
                                            <blockquote class="blockquote border-0">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img class="media-object img-xl mr-1" src="{{asset('public/img/avatar-s-1.png')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <div class="media-body">
                                                        Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                    </div>
                                                </div>
                                                <footer class="blockquote-footer text-right">Steve Jobs
                                                    <cite title="Source Title">Entrepreneur</cite>
                                                </footer>
                                            </blockquote>
                                            <p class="lead mt-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                            </p>
                                        </li>
                                        <li data-date="20/05/2015">
                                            <blockquote class="blockquote border-0">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img class="media-object img-xl mr-1" src="{{asset('public/img/avatar-s-1.png')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <div class="media-body">
                                                        Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                    </div>
                                                </div>
                                                <footer class="blockquote-footer text-right">Steve Jobs
                                                    <cite title="Source Title">Entrepreneur</cite>
                                                </footer>
                                            </blockquote>
                                            <p class="lead mt-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                            </p>
                                        </li>
                                        <li data-date="09/07/2015">
                                            <blockquote class="blockquote border-0">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img class="media-object img-xl mr-1" src="{{asset('public/img/avatar-s-1.png')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <div class="media-body">
                                                        Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                    </div>
                                                </div>
                                                <footer class="blockquote-footer text-right">Steve Jobs
                                                    <cite title="Source Title">Entrepreneur</cite>
                                                </footer>
                                            </blockquote>
                                            <p class="lead mt-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                            </p>
                                        </li>
                                        <li data-date="30/08/2015">
                                            <blockquote class="blockquote border-0">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img class="media-object img-xl mr-1" src="{{asset('public/img/avatar-s-1.png')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <div class="media-body">
                                                        Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                    </div>
                                                </div>
                                                <footer class="blockquote-footer text-right">Steve Jobs
                                                    <cite title="Source Title">Entrepreneur</cite>
                                                </footer>
                                            </blockquote>
                                            <p class="lead mt-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                            </p>
                                        </li>
                                        <li data-date="15/09/2015">
                                            <blockquote class="blockquote border-0">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img class="media-object img-xl mr-1" src="{{asset('public/img/avatar-s-1.png')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <div class="media-body">
                                                        Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                    </div>
                                                </div>
                                                <footer class="blockquote-footer text-right">Steve Jobs
                                                    <cite title="Source Title">Entrepreneur</cite>
                                                </footer>
                                            </blockquote>
                                            <p class="lead mt-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                            </p>
                                        </li>
                                    </ol>
                                </div>
                                <!-- .events-content -->
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic Card</h4>
                </div>
                <div class="card-content">
                    <img class="img-fluid" src="{{asset('public/img/avatar-s-1.png')}}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                    <span class="float-left">3 hours ago</span>
                    <span class="float-right">
                        <a href="#" class="card-link">Read More <i class="fa fa-angle-right"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div> --}}
@endsection


{{-- @section('script')
<script>
    $(document).ready(function(){
        $('#dmenu').addClass('active');
    });
</script>
@endsection --}}


@php

    $inv = '';
    $data = '';

    $inv_awaiting = 0;
    $inv_pay = 0;

    // $g='';
                              
    for ($x = 1; $x <= intval(date('m')); $x++) {
        if($x<10){
        $g="0".$x;
        }else{
        $g=$x;
        }


        
        $inv =  HomeController::invoice_statistics(date('Y-').$g.'-').' ';
        $inv_awaiting =  HomeController::inv_awaiting_statistics(date('Y-').$g.'-', 2).' ';
        $inv_pay =  HomeController::inv_awaiting_statistics(date('Y-').$g.'-', 3).' ';
        
        $data .="{ 
                    month: '".date('Y-').$g."', 
                    inv: ".$inv.", 
                    inv_awaiting: ".$inv_awaiting.", 
                    inv_pay: ".$inv_pay."
                },";
        
    }
                            
    

    // $data = substr($data, 0, );
@endphp

@push('script')    
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>  
<script>
        // <?php  

        //     $inv_data ='';
        //     for ($x = 1; $x <= intval(date('m')); $x++) {
        //         if($x<10){
        //             $g="0".$x;
        //         }else{
        //             $g=$x;
        //         }

        //         // $t_inv = HomeController::invoice_statistics(date('Y-').$g.'-').', ';
        //         $t_inv = 0;
        //         $e = 0;
        //         $a = 0;
        //         $d = 0;

        //         // $inv_data.='{ month:'.$t_inv.', electronics:'.$e.', apparel:'.$a.', decor:'.$d.'}, ';
        //         $inv_data.='{ month:'.$t_inv.', electronics:'.$e.', apparel:'.$a.', decor:'.$d.'}, ';

        //         $inv_data = substr($inv_data, 0, 2);

        //         $a = 0;
                
        //     }
        // ?>


    $(window).on("load", function(){

        //************************  Scrollbar Start ************************//

            var recent_buyers = new PerfectScrollbar("#recent-buyers", {
                wheelPropagation: true
            });

        //************************  Scrollbar End *************************//

        /********************************************
        *               PRODUCTS SALES              *
        ********************************************/

        
        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        Morris.Area({
            element: 'invoice',

            data: [{!!$data!!}],
            xkey: 'month',
            // // ykeys: ['electronics', 'apparel', 'decor'],
            // // labels: ['Invoice', 'Apparel', 'Decor'],
            ykeys: ['inv', 'inv_awaiting', 'inv_pay'],
            labels: ['Invoice', 'Awaiting Approval', 'Awaiting Payment'],
            // data: [{
            //     month: '2017-01',
            //     electronics: 0,
            //     apparel: 0,
            //     decor: 0
            // },{
            //     month: '2017-02',
            //     electronics: 240,
            //     apparel: 0,
            //     decor: 20
            // },{
            //     month: '2017-03',
            //     electronics: 0,
            //     apparel: 40,
            //     decor: 0
            // }],
            // xkey: 'month',
            // ykeys: ['electronics', 'apparel', 'decor'],
            // labels: ['Electronics', 'Apparel', 'Decor'],

            xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
                var month = months[x.getMonth()];
                return month;
            },
            dateFormat: function(x) {
                var month = months[new Date(x).getMonth()];
                return month;
            },
            behaveLikeLine: true,
            ymax: 300,
            resize: true,
            pointSize: 0,
            pointStrokeColors:['#00B5B8', '#FA8E57', '#F25E75'],
            smooth: true,
            gridLineColor: '#E4E7ED',
            numLines: 6,
            gridtextSize: 14,
            lineWidth: 0,
            fillOpacity: 0.9,
            hideHover: 'auto',
            lineColors: ['#00B5B8', '#FA8E57', '#F25E75']
        });
    });
        
</script>
@endpush