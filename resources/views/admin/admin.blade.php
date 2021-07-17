<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Dashboard Template · Bootstrap v4.6</title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" /> --}}
    
    <script src="{{asset('js/adminDashborad.js')}}"></script>
    

    <!-- Bootstrap core CSS -->
<link href="{{asset('css/app.css')}}" rel="stylesheet">
<style>
</style>
    
    <!-- Custom styles for this template -->
    <link href="{{asset('css/adminDashboard.css')}}" rel="stylesheet">
  </head>
  <body>
    @include('includes.header')
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <i class="fab fa-dashcube"></i> &nbsp;
              Dashboard 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-dolly"></i> &nbsp;
              Basic Information
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/pays')}}">
              <i class="fas fa-shopping-cart"></i>&nbsp;
              Generete Payslips
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/')}}">
              <i class="fas fa-person-booth"></i>&nbsp;
              Customer Slips
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-flag-checkered"></i>&nbsp;
              Tax Certificate
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fab fa-stack-exchange"></i>&nbsp;
              Leave
            </a>
          </li>
        </ul>

      
      </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    @role( 'Employee' )
   
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        @if(Session::has('news'))
        <div class="alert alert-success" role="alert">
          <p>Leave Application Submitted Succsessfull</p>
        </div>
        @endif
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="{{url('/leaves/create')}}" class="btn btn-sm btn-outline-secondary">Apply for Leave </a>
            
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>
      @php
        $leaves=App\Models\Leave::where('email', auth()->user()->email)->get();      @endphp
      @foreach ($leaves as $item)
        @if(!$item->status)
          <div class="row">
          
            <div class="col-md-4 ">
              <div class="card">
                <div class="card-header">
                  {{ auth()->user()->name }} has Submiited item Application
                </div>
                <div class="card-body">
                  <h5 class="card-title"> Reason :{{ $item->comment }}</h5>
                  <h3> Start Date :{{ $item->startdate}}</h3>
                  <h3>End Date : {{ $item->enddate}}</h3>
                <br><br><br>
                </div>
              </div>
            </div>          
          </div>
          @endif
            <div id="hide" class="alert alert-success" role="alert">
                <h3 class="remveMessage">Your leave application has been approved  <i class="fa fa-times" onclick="hide()" aria-hidden="true">reome me</i> </h3>
            </div>

        @endforeach

   {{-- @endif --}}
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <h2 class="bg-dark text-light">Leave</h2>
          <h4>12:00</h4>
          <span>Annual leave day</span>
        </div>
        <div class="col-md-5">
          <h2 class="bg-dark text-light">Inbox</h2>
          <input type="text" style="float: right;" placeholder="search here ...">
          <div class="mt-5">
            <p style="width:100%; height:70px;">No data</p>
          </div>
        </div>       
      </div>
      <div class="contianer">
        <h3> Employee Payslips :<h3>
          <div class="row">

          
        <div class="col-md-10">
          
          <table class="table  mt-5 table-dark table-striped">
            <thead>
              <tr>
                  <th># ID</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>First Date</th>
                  <th>End Date</th>
              </tr>
            </thead>
            @php
               $slips= App\Models\Pay::where('employee_id', auth()->user()->id)->get();
            @endphp
            
                <tbody>
                  <tr>
                    @foreach ($slips as $item)
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->firstPeriodEndDate }}</td>
                    <td>{{ $item->lastDayMonth }}</td>
                </tr>
                @endforeach
              </tbody>
          </table>

        </div>
      </div>

      </div>

    </div>

    @endrole
    @can('will see payslips', Model::class)
       Here is some payroll slips need some crud
       <a href="{{url('/pays')}}">GO tO</a>
    @endcan
    @can('will approve leave', Model::class)
      @php
      $leave = App\Models\Leave::orderBy('created_at', 'desc')->limit(1)->get(); 
  
      @endphp
      @foreach ($leave as $item)
        @if(Session::has('applicationapproved'))
        <div class="alert alert-success" role="alert">
          <p>Leave Application Approved </p>
        </div>
        @endif
        @if(!$item->status)
          <div class="card mt-4">
            <div class="card-header">
              @php    
              $applicats=App\Models\User::where('email', $item->email)->first();
              @endphp
              {{ $applicats->name }} has  apply for leave Application
            </div>
          
            
            <div class="card-body bg-light">        
              <h3 class="card-title"> Start Date :{{ $item->startdate }} </h5>
              <h3>End Date {{ $item->enddate}}</h2>
            <a href="{{url('approveLeave/'.$item->id)}}" class="btn btn-primary">Approve</a>
            </div>
          </div>

          @else
          <div class="container mt-5 ">
            <div class="row">
              <div class="row">
                <p>No Application Has Submiited yet</p>

              </div>

            </div>

          </div>

         @endif
      @endforeach
      
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th># ID</th>
              <th>Type</th>
              <th>start Date</th>
              <th>End Date</th>
              <th>Status</th>
            </tr>
          </thead>
          @php
            $leaves = App\Models\Leave::orderBy('created_at', 'ASC')->get();    
          @endphp
          @foreach ($leaves as $item)
          
          <tbody>
            <tr>
              <td> {{ $loop->index +1 }}</td>
              <td>{{ $item->type }}</td>
              <td> {{ $item->startdate}}</td>
              <td>{{ $item->enddate }}</td>
              @if($item->status)
              <td> Approved</td>
              @else 
              <td><a href="{{url('approveLeave/'.$item->id)}}" class="btn btn-danger">Approve</a></td>
              @endif 
            </tr>
            @endforeach
          </tbody>
        </table>
        @endcan
      </div>
    </main>
  </div>
</div>
<script>
  function hide(){
    document.getElementById("hide").style.display = "none";
  }
  
</script>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
      <script src="{{asset('js/app.js')}}"></script>        
  </body>
</html>