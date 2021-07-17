@extends('master')

@section('content')
  <!--<div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
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
              <a class="nav-link" href="{{url('admin/allproducts')}}">
                <i class="fas fa-shopping-cart"></i>&nbsp;
                Payslips
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
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
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4"> -->
     
      <div class="container">
        <h2>Leave Application</h2>
        <div class="bg-dark" style="width: 100%;height:10px;"><h3 class="bg-light">Apply</h3></div>
        <div class="row">
           
          <div class="col-md-5">
            <form action="{{ route('leaves') }}" class="mt-5" method="post" class="form">
                @csrf
                <div class="form-group">
                    <label for="payPeriodCycle" >Leave type *</label><br>
                    <select name="type" id="" class="from-control">
                        <option value="monthly" class="from-control">Annualy</option>
                        <option value="Family Responsibility">Family Responsibilty</option>
                        <option value="weekly" class="from-control">monthly</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name" > &nbsp Start Date</label><br>
                    <input type="date" class="form-control" id="startdate" name="startdate" >
                </div>
                
                <div class="form-group">
                    <label for="firstPeriodEndDate" > &nbsp End Date *</label><br>
                    <input type="date" name="enddate"  class="form-control" placholder="DD MM YYYY">
                </div>
              
                <div class="form-group">
                    <label for="lastDayMonth" > &nbsp Comment *</label><br>
                    <input type="text"  name="comment"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="lastDayMonth" > &nbsp Refrence *</label><br>
                    <input type="text"  name="refrence"  class="form-control">
                </div>
                
               <div class="">
                 <button type="submit" class="btn btn-warning"> Submit</button> 
               </div>
            </form>
           
          </div>
        </div>
      </div>   
          
     <main>
    </div>
  </div>
  
  
@endsection
