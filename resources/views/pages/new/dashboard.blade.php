@php
    use \App\Http\Controllers\HomeController;
    $paid ='';
@endphp
@extends('newmaster')
@section('title')
    {{$title}}
@endsection

@section('stylesheet')
    {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> --}}
<style type="text/css">
  .canvas-con {
     display: flex;
     align-items: center;
     justify-content: center;
     min-height: 365px;
     position: relative;
  }

   .canvas-con-inner {
     height: 100%;
  }
   .canvas-con-inner, .legend-con {
     display: inline-block;
  }
   .legend-con {
     font-family: Roboto;
     display: inline-block;
     min-width: 235px;
  }
   .legend-con ul {
     list-style: none;
  }
   .legend-con li {
     display: flex;
     align-items: center;
     margin-bottom: 4px;
  }
   .legend-con li span {
     display: inline-block;
  }
 .legend-con li span.chart-legend {
   width: 25px;
   height: 25px;
   margin-right: 10px;
}
.chart-legend-value {
    position: absolute;
    left: auto;
    right: 0px;
}
#invoices_expenses{
  width: 100%;
  height: 200px;
}
</style>


<?php 
//hinalilaram
$role = auth()->user()->roles[0]->name;  //dd($role);
?>


@endsection
@section('content')

@php
         $awaiting_invoices = \DB::table('invoices')
            ->leftJoin('customers', 'invoices.cust_id', '=', 'customers.cust_id')
            ->where('invoices.user_id', auth()->user()->id)
            ->where('invoices.status', 3)
            ->get();

        $invoice_paid_count = 0;
        foreach($awaiting_invoices as $invoice){
            $paid = DB::table('inv_payment_details')->where('inv_id', $invoice->invoice_id)->sum('amount');
            if($invoice->final_total - $paid == 0){
                $invoice_paid_count++;
            }
        }
@endphp

  <div class="content-wrapper">
    <div class="container mt-4">
    @if( $role == 'Employee' )
    <h1>EMPLOYEE</h1>
    @elseif($role == 'Admin')
    <h1>ADMIN</h1>
    @elseif($role == 'Payroll Admin')
    <h1>PAYROLL ADMIN</h1>
    @elseif($role == 'Manager')
    <h1> MANAGER</h1>
    @endif
                
      <div class="row">
        
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
          
          <div class="card card-statistics">
            
            <div class="card-body">
              
              <div class="d-flex align-items-center justify-content-center">
                <div class="highlight-icon bg-light mr-3">
                  <i class="mdi mdi-cube text-success icon-lg"></i>
                </div>
                  
                <div class="wrapper">
                  <p class="card-text mb-0">Weekly</p>
                  <div class="fluid-container">
                    <h3 class="card-title mb-0">{{$total_inv}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center">
                <div class="highlight-icon bg-light mr-3">
                  <i class="mdi mdi-briefcase-check text-primary icon-lg"></i>
                </div>
                <div class="wrapper">
                  <p class="card-text mb-0">Fortnightly</p>
                  <div class="fluid-container">
                    <h3 class="card-title mb-0">{{HomeController::check_inv_statistics(1)}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center">
                <div class="highlight-icon bg-light mr-3">
                  <i class="mdi mdi-account-multiple text-danger icon-lg"></i>
                </div>
                <div class="wrapper">
                  <p class="card-text mb-0">Monthly</p>
                  <div class="fluid-container">
                    <h3 class="card-title mb-0">{{HomeController::check_inv_statistics(3) - $invoice_paid_count}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center">
                <div class="highlight-icon bg-light mr-3">
                  <i class="mdi mdi-airballoon text-info icon-lg"></i>
                </div>
                <div class="wrapper">
                  <p class="card-text mb-0">Paid Invoice</p>
                  <div class="fluid-container">
                    <h3 class="card-title mb-0">{{$p_inv}}</h3>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div> -->

      <!-- <div class="row">
        <div class="col-md-4 col-sm-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Recent Customers</h5>

              @foreach ($invoices as $cus)
                
                @if ($cus->status == 1 || $cus->status == 2)
                <a href="{{ url('/cubebooks/edit-invoice/'.$cus->invoice_id) }}" target="_blank" class="media border-0">

                  <div class="d-flex align-items-start pb-3 pt-1 mb-4 border-bottom">
                    <img src="https://placehold.it/50x50" alt="brand logo">
                    <div class="wrapper w-100 pl-3">
                      <div class="d-flex align-items-center justify-content-between">
                        <h4>{{$cus->display_name}}</h4>
                        <h5 class="text-gray text-small" style="margin-left: 70px;">${{number_format($cus->final_total)}}</h5>
                      </div>
                      @php
                          $paid = DB::table('inv_payment_details')->where('inv_id', $cus->invoice_id)->sum('amount');

                          $due = ($cus->final_total - $paid);
                      @endphp
                      
                      @if ($due==0)
                          <span class="badge badge-info badge-lg mb-2">Paid</span>
                      @elseif ($cus->status == 1)
                          <span class="badge badge-success badge-lg mb-2">Draft</span>
                      @elseif ($cus->status == 2)
                          <span class="badge badge-warning badge-lg mb-2">Awaiting Approval</span>
                      @else 
                          <span class="badge badge-danger badge-lg mb-2">Awaiting Payment</span>
                      @endif
                      
                    </div>
                  </div>
                </a>
                @endif
                @if ($cus->status == 3)
                <a href="{{ url('/cubebooks/edit-invoice/'.$cus->invoice_id) }}" target="_blank" class="media border-0">

                  <div class="d-flex align-items-start pb-3 pt-1 mb-4 border-bottom">
                    <img src="https://placehold.it/50x50" alt="brand logo">
                    <div class="wrapper w-100 pl-3">
                      <div class="d-flex align-items-center justify-content-between">
                        <h4>{{$cus->display_name}}</h4>
                        <h5 class="text-gray text-small" style="margin-left: 70px;">${{number_format($cus->final_total)}}</h5>
                      </div>
                      @php
                          $paid = DB::table('inv_payment_details')->where('inv_id', $cus->invoice_id)->sum('amount');

                          $due = ($cus->final_total - $paid);
                      @endphp
                      
                      @if ($due==0)
                          <span class="badge badge-info badge-lg mb-2">Paid</span>
                      @elseif ($cus->status == 1)
                          <span class="badge badge-success badge-lg mb-2">Draft</span>
                      @elseif ($cus->status == 2)
                          <span class="badge badge-warning badge-lg mb-2">Awaiting Approval</span>
                      @else 
                          <span class="badge badge-danger badge-lg mb-2">Awaiting Payment</span>
                      @endif
                      
                    </div>
                  </div>
                </a>
              @endif
              
            @endforeach
            
              
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Top Selling Products</h5>
              <div class="row border-bottom pb-3 mb-3">
                <div class="col-12 py-4 my-3">
                  <canvas id="DashboardBarChart-1" style="height:100px"></canvas>
                </div>
                <div class="col-12 mt-3">
                  <div class="d-flex align-items-end">
                    <h1 class="display-4 font-weight-semibold mb-0">8935</h1>
                    <h5 class="ml-3 mb-2">Sales Per Day</h5>
                  </div>
                  <p class="mt-0 mb-2">Some quick example text to build</p>
                  <div class="d-flex align-items-center">
                    <div class="progress progress-md w-100 mr-3">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 38%" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">38%</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="d-flex align-items-end">
                    <h1 class="display-4 font-weight-semibold mb-0">6843</h1>
                    <h5 class="ml-3 mb-2">Orders Per Day</h5>
                  </div>
                  <p class="mt-0 mb-2">Proin eget tortor risus.</p>
                  <div class="d-flex align-items-center">
                    <div class="progress progress-md w-100 mr-3">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: 64%" aria-valuenow="64" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">64%</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Revenue</h5>
              <div class="w-75 mx-auto">
                <div class="d-flex justify-content-between text-center mb-2">
                  <div class="wrapper">
                    <h4>6,256</h4>
                    <small class="text-muted">Totel sales</small>
                  </div>
                  <div class="wrapper">
                    <h4>8569</h4>
                    <small class="text-muted">Open Compaign</small>
                  </div>
                </div>
              </div>
              <div id="morris-line-example" style="height:250px;"></div>
              <div class="w-75 mx-auto">
                <div class="d-flex justify-content-between text-center mt-5">
                  <div class="wrapper">
                    <h4>5136</h4>
                    <small class="text-muted">Online Sales</small>
                  </div>
                  <div class="wrapper">
                    <h4>4596</h4>
                    <small class="text-muted">Store Sales</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center">
                <div class="highlight-icon bg-light mr-3">
                  <i class="mdi mdi-cube text-success icon-lg"></i>
                </div>
                <div class="wrapper">
                  <p class="card-text mb-0">Active Customers</p>
                  <div class="fluid-container">
                    <h3 class="card-title mb-0">{{$a_customer}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center">
                <div class="highlight-icon bg-light mr-3">
                  <i class="mdi mdi-briefcase-check text-primary icon-lg"></i>
                </div>
                <div class="wrapper">
                  <p class="card-text mb-0">Inactive Customer</p>
                  <div class="fluid-container">
                    <h3 class="card-title mb-0">{{$i_customer}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center">
                <div class="highlight-icon bg-light mr-3">
                  <i class="mdi mdi-account-multiple text-danger icon-lg"></i>
                </div>
                <div class="wrapper">
                  <p class="card-text mb-0">Banking</p>
                  <div class="fluid-container">
                    <h3 class="card-title mb-0">4,658</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center">
                <div class="highlight-icon bg-light mr-3">
                  <i class="mdi mdi-airballoon text-info icon-lg"></i>
                </div>
                <div class="wrapper">
                  <p class="card-text mb-0">Accounting</p>
                  <div class="fluid-container">
                    <h3 class="card-title mb-0">5.6 M</h3>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div> -->
      
      <!-- Graph -->
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="wrapper">
                  <div class="fluid-container">
                    <h3 class="card-title mb-0 text-center">Your Invoices</h3>
                    <div class="canvas-con invoice-con">
                      <div class="canvas-con-inner">
                          <canvas id="mychart" height="200px" width="250px"></canvas>
                      </div>
                      <div id="my-legend-con" class="legend-con"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="wrapper">
                  <div class="fluid-container">
                    <h3 class="card-title mb-0 text-center">Your Expenses</h3>
                    <div class="canvas-con expense-con">
                      <div class="canvas-con-inner">
                          <canvas id="myexpenses" height="200px" width="250px"></canvas>
                      </div>
                      <div id="expenses-legend-con" class="legend-con"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="wrapper">
                  <div class="fluid-container">
                    <h3 class="card-title mb-0 text-center">Your Invoices & Expenses</h3>
                    <div class="canvas-con expense-con">
                      <div class="canvas-con-inner">
                          <canvas id="invoices_expenses" width="1050px" height="300px"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Invoice Summary</h5>
              <div class="table-responsive">
                <table class="table center-aligned-table">
                  <thead>
                    <tr>
                      <th class="border-bottom-0">Invoice</th>
                      <th class="border-bottom-0">Ref</th>
                      <th class="border-bottom-0">To</th>
                      <th class="border-bottom-0">Date</th>
                      <th class="border-bottom-0">Due Date</th>
                      <th class="border-bottom-0">Amount Due</th>
                      <th class="border-bottom-0">Amount Paid</th>
                      <th class="border-bottom-0">Status</th>
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
                                                @elseif($item->status == 3)
                                                    <span class="badge badge-pill badge-danger">Awaiting Payment</span>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                    
                    
                  </tbody>
                </table>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  @endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>

<script type="text/javascript">
  Chart.pluginService.register({
    beforeDraw: function (chart) {
        var width = chart.chart.width,
            height = chart.chart.height,
            ctx = chart.chart.ctx;
        ctx.restore();
        var fontSize = (height / 200).toFixed(2);
        ctx.font = fontSize + "em sans-serif";
        ctx.textBaseline = "middle";
        var text = chart.config.options.elements.center.text,
            textX = Math.round((width - ctx.measureText(text).width) / 2),
            textY = height / 2;
        ctx.fillText(text, textX, textY);
        ctx.save();
    }
});
textInside = 'Invoices';
var labelsData = ['Over Due', 'Due this week', "Due {{$next_week_date_start}} {{$next_week_month_start}} - {{$next_week_date_end}} {{$next_week_month_end}}", "Due {{$fort_night_date_start}} {{$fort_night_month_start}} - {{$fort_night_date_end}} {{$fort_night_month_end}}","Due {{$twenty_first_day_date_start}} {{$twenty_first_day_month_start}} - {{$twenty_first_day_date_end}} {{$twenty_first_day_month_end}}" ];
var chartData = [["Over Due", {{$invoice_over_due}}], ["Due this week", {{$invoice_due_this_week}}], ["Due {{$next_week_date_start}} {{$next_week_month_start}} - {{$next_week_date_end}} {{$next_week_month_end}}" , {{$invoice_next_week}}], ["Due {{$fort_night_date_start}} {{$fort_night_month_start}} - {{$fort_night_date_end}} {{$fort_night_month_end}}", {{$invoice_fort_night}} ],["Due {{$twenty_first_day_date_start}} {{$twenty_first_day_month_start}} - {{$twenty_first_day_date_end}} {{$twenty_first_day_month_end}}" ,{{$invoice_twenty_first_night}}]];

var invoiceData = [];
var i = 0;
$.each(chartData, function( index, data ){
  invoiceData.push(chartData[i++][1]);
});


var myChart = new Chart(document.getElementById('mychart'), {
    type: 'doughnut',
    animation:{
        animateScale:true
    },
    data: {
        labels: labelsData,
        datasets: [{
            label: 'Invoices',
            data: invoiceData,
            backgroundColor: [
                "#ff2401",
                "#fe9704",
                "#fff900",
                "#0bf900",
                "#973afb"
            ]
        }]
    },
    options: {
        elements: {
          center: {
            text: textInside
          }
        },
        responsive: true,
        legend: false,
        legendCallback: function(chart) {
            var legendHtml = [];
            legendHtml.push('<ul>');
            var item = chart.data.datasets[0];
            for (var i=0; i < item.data.length; i++) {
                legendHtml.push('<li>');
                legendHtml.push('<span class="chart-legend" style="background-color:' + item.backgroundColor[i] +'"></span>');
                 legendHtml.push('<span class="chart-legend-label-text">' + chart.data.labels[i]+'</span>');
                 legendHtml.push('<span class="chart-legend-value">R' + item.data[i]+'</span>');
                legendHtml.push('</li>');
            }

            legendHtml.push('</ul>');
            return legendHtml.join("");
        },
        tooltips: {
             enabled: true,
             mode: 'label',
             callbacks: {
                label: function(tooltipItem, data) {
                    var indice = tooltipItem.index;
                    return data.labels[indice] + ": R"+data.datasets[0].data[indice].toFixed(2);
                }
             }
         },
    }
});

$('#my-legend-con').html(myChart.generateLegend());

//expenses chart
expensetextInside = 'Expenses';
var expenseLabelsData = ['Over Due', 'Due this week', "Due {{$next_week_date_start}} {{$next_week_month_start}} - {{$next_week_date_end}} {{$next_week_month_end}}", "Due {{$fort_night_date_start}} {{$fort_night_month_start}} - {{$fort_night_date_end}} {{$fort_night_month_end}}", "Due {{$twenty_first_day_date_start}} {{$twenty_first_day_month_start}} - {{$twenty_first_day_date_end}} {{$twenty_first_day_month_end}}" ];
var expenseChartData = [["Over Due", {{$expense_over_due}}], ["Due this week", {{$expense_due_this_week}}], ["Due {{$next_week_date_start}} {{$next_week_month_start}} - {{$next_week_date_end}} {{$next_week_month_end}}" , {{$expense_next_week}}], ["Due {{$fort_night_date_start}} {{$fort_night_month_start}} - {{$fort_night_date_end}} {{$fort_night_month_end}}", {{$expense_fort_night}}], ["Due {{$twenty_first_day_date_start}} {{$twenty_first_day_month_start}} - {{$twenty_first_day_date_end}} {{$twenty_first_day_month_end}}" ,{{$expense_twenty_first_night}}]];
var expenseData = [];
var i = 0;
$.each(expenseChartData, function( index, data ){
  expenseData.push(expenseChartData[i++][1]);
});
var expenseChart = new Chart(document.getElementById('myexpenses'), {
    type: 'doughnut',
    animation:{
        animateScale:true
    },
    data: {
        labels: expenseLabelsData,
        datasets: [{
            label: 'Expenses',
            data: expenseData,
            backgroundColor: [
                "#ff2401",
                "#fe9704",
                "#fff900",
                "#0bf900",
                "#973afb"
            ]
        }]
    },
    options: {
        elements: {
          center: {
            text: expensetextInside
          }
        },
        responsive: true,
        legend: false,
        legendCallback: function(chart) {
            var legendHtml = [];
            legendHtml.push('<ul>');
            var item = chart.data.datasets[0];
            for (var i=0; i < item.data.length; i++) {
                legendHtml.push('<li>');
                legendHtml.push('<span class="chart-legend" style="background-color:' + item.backgroundColor[i] +'"></span>');
                legendHtml.push('<span class="chart-legend-label-text">' + chart.data.labels[i]+'</span>');
                legendHtml.push('<span class="chart-legend-value">R' + item.data[i]+'</span>');
                legendHtml.push('</li>');
            }

            legendHtml.push('</ul>');
            return legendHtml.join("");
        },
        tooltips: {
             enabled: true,
             mode: 'label',
             callbacks: {
                label: function(tooltipItem, data) {
                    var indice = tooltipItem.index;
                    return data.labels[indice] + ": R"+data.datasets[0].data[indice].toFixed(2);
                }
             }
         },
    }
});
$('#expenses-legend-con').html(expenseChart.generateLegend());


console.log(document.getElementById('expenses-legend-con'));



//expense and invoices

//expenses chart
var invoiceExpenseLabelsData = <?php echo json_encode($months) ?>;
var monthlyInvoicesChartData = <?php echo json_encode($monthly_invoices_dues) ?>;
var monthlyExpensesChartData = @php echo json_encode($monthly_expenses_dues) @endphp;

expensetextInside = '';
var labels = invoiceExpenseLabelsData;
var expenseData = [];
var i = 0;

var expenseInvoiceChartBar = new Chart(document.getElementById('invoices_expenses'), {
    type: 'bar',
    animation:{
        animateScale:true
    },
    data: {
        labels: labels,
        datasets: [{
            label: 'Invoices',
            data: monthlyInvoicesChartData,
            backgroundColor: "#0bf900"
        },{
            label: 'Expenses',
            data: monthlyExpensesChartData,
            backgroundColor: "#ff2401"
        }]
    },
    options: {
        elements: {
          center: {
            text: expensetextInside
          }
        },
        responsive: true,
       
       
    }
});


</script>
<script>
  
//Invoices and Expenses

</script>
@endpush