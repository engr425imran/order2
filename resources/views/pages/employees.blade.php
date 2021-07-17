@extends('master')
@section('title')
    {{$title}}
@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-fileupload.css')}}"/>
    <style>
        .table th {
            font-size: 13px;
        }
        .table td {
            font-size: 11px;
        }
        .w_12 {
            width: 12%;
        }
        .fs-15 {
            font-size: 15px;
        }
        .hide {
            display: none;
        }
        .show {
            display: block;
        }
    </style>
@endsection

@section('content')

    <div class="content-header row">

        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Employees</h3>
            <div class="row breadcrumbs-top">
        
            </div>
        </div>

        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <!--<a class="btn-icon btn btn-secondary btn-round" ><i class="ft-bell"></i> </a>-->
                <a href="#" class="btn-icon btn btn-secondary btn-round btn-success" data-toggle="modal" data-target="#xlarge"><i class="fa fa-user"></i> Add Employee</a>
            </div>
        </div>
    </div>




    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Employee List:</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Employee Code</th>
                                        <th>First Name</th>
                                        <th>Surname</th>
                                        <th>Known As</th>
                                        <th>Email Address</th>
                                        <th>Date of Birth</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($employees as $e)
                                        <tr>
                                            <td>{{$e->employee_code}}</td>
                                            <td>{{$e->first_name}}</td>
                                            <td>{{$e->surname}}</td>
                                            <td>{{$e->nickname}}</td>
                                            <td>{{$e->email}}</td>
                                            <td>{{$e->dob}}</td>
                                            

                                            <!--    @if ($e->this_employee_is)
                                                    <span>an Asylum Seeker</span>
                                                @elseif ($e->e_is_refugee)
                                                    <span>a Refugee</span>
                                                
                                                @else 
                                                    <span>Null</span>
                                                @endif

                                            </td>-->
                                            
                                            <!--<td>{{$e->dob}}</td>-->
                                            <td class="pr-0">
                                                <!-- <button 
                                                    type="button" 
                                                    class="btn btn-primary btn-sm btn-round edit_modal"
                                                    customer_id="{{$e->employee_id}}"
                                                    >
                                                    <i class="ft-edit-2 fs-15"></i>                                                
                                                </button> -->
                                                <a href="{{url('/cubebooks/edit-employee') }}/{{$e->employee_id}}"><button 
                                                    type="button" 
                                                    class="btn btn-primary btn-sm btn-round"
                                                    customer_id="{{$e->employee_id}}"
                                                    >
                                                    <i class="ft-edit-2 fs-15"></i>                                                
                                                </button>
                                            </a>
                                                
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
    </section>


    
    <div class="modal fade text-left addModel" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600 text-center" id="myModalLabel33">Add An Employee</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                              
                </div>

                <form action="{{ route('saveEmployee') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Employee Code</label>
                                    <input type="text" name="employee_code" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>First Names</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input type="text" name="surname" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Known as</label>
                                    <input type="text" name="nickname" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--<div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                <label >RSA ID Number</label>
                                
                                    <input type="text" name="id_no" class="form-control" >
                                    
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="timesheetinput2">Passport Number</label>
                                    <input type="text" name="passport_no" class="form-control" >
                                   
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Date of Birth:</label>
                                    <input type="date" name="dob" id="" class="form-control" required>
                                    
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Email Address</label>
                                    <input type="email" name="email" id="" class="form-control" required>
                                    
                                </div>
                            </div>
                            
                        </div>
                       <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label style="margin-top: 3px;">This Employee is an Asylum Seeker</label>
                                   <input type="checkbox" name="this_employee_is">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label style="margin-top: 3px;">This Employee is a Refugee</label>
                                   <input type="checkbox" name="e_is_refugee">
                                </div>
                            </div>
                           
                            
                            
                            
                        </div>  
                                                        
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs nav-linetriangle no-hover-bg" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" role="tab" aria-selected="true">Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" role="tab" aria-selected="false">Employment</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab6" data-toggle="tab" aria-controls="tab6" href="#tab6" role="tab" aria-selected="false">Emergency Contact</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab7" data-toggle="tab" aria-controls="tab7" href="#tab7" role="tab" aria-selected="false">Payment Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3" role="tab" aria-selected="false">Taxes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab8" data-toggle="tab" aria-controls="tab8" href="#tab8" role="tab" aria-selected="false">Medical Aid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4" role="tab" aria-selected="false">Private RA</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4" role="tab" aria-selected="false">Payslip</a>
                                    </li> -->
                                    
                                    
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4" role="tab" aria-selected="false">Leave</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4" role="tab" aria-selected="false">Transactions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4" role="tab" aria-selected="false">Year to date</a>
                                    </li> -->
                                    
                              <!--  </ul>
                                <div class="tab-content px-1 pt-1">
                                    <div class="tab-pane active" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Physical Address</label>
                                                            <input type="text" class="form-control" name="street_name" id="b_street" placeholder="Street">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="city" id="b_city" placeholder="City/Town">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="state" id="b_state" placeholder="State/Province">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="postal_code" id="b_postal" placeholder="Postal Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="country" id="b_country" placeholder="Country">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Postal Address</label>
                                                            
                                                            <input type="text" class="form-control" name="p_street" id="c_street" placeholder="Street">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="p_city" id="c_city" placeholder="City/Town">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="p_state" id="c_state" placeholder="State/Province">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="p_postal" id="c_postal" placeholder="Postal Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="p_country" id="c_country" placeholder="Country">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        
                                    </div>
                                    
                                    
                                    <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="base-tab2">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Employee is Paid</label>
                                                    <select class="select2 form-control employee_pay_type" name="e_is_paid" id="select-pay-cycle">
                                                        <option value="">Select Option</option>
                                                        <option value="weekly">Weekly</option>
                                                        <option value="fortnightly">Fortnightly</option>
                                                        <option value="monthly">Monthly</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Working Hours Per Day</label>
                                                    <input type="number" id="working_hours_per_day" onkeyup="get_week_hour_sum();"  value="0" name="working_hours_per_day" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Working Days Per Week</label>
                                                    <input type="number" id="working_days_per_week" onkeyup="get_week_hour_sum();" value="0" name="working_days_per_week" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" name="estart_date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row hide" id="weekly-pay">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Fixed Weekly Wage</label>
                                                    <input type="text" name="weekly_wage" id="weekly_wage" onkeyup="get_weekly_wage();"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Average Working Hours per week</label>
                                                    <input type="text" name="working_hour_per_week" value="0" id="working_hour_per_week" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Annual Wage</label>
                                                    <input type="text" name="annual_wage" id="annual_wage" onkeyup="get_annual_wage();" value="0"   class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Rate per Day</label>
                                                    <input type="text"  name="rate_per_day" id="rate_per_day" value="0" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Rate per Hour</label>
                                                    <input type="text" name="rate_per_hour" id="rate_per_hour" value="0"   class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row hide" id="fortnightly-pay">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Fixed Bi-Weekly Wage</label>
                                                    <input type="text" id="bi_weekly_wage" onkeyup="get_weekly_wage();" name="fortnighlty_wage" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Average Working Hours per Bi-Week</label>
                                                    <input type="text" name="working_hour_bi_week" class="form-control" id="working_hour_bi_week">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Annual Wage</label>
                                                    <input type="text"  name="bi_annual_wage" id="bi_annual_wage" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Rate per Day</label>
                                                    <input type="text" id="bi_rate_per_day" value="0" name="bi_rate_per_day" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Rate per Hour</label>
                                                    <input type="text" id="bi_rate_per_hour" value="0"   name="bi_rate_per_hour" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row hide" id="monthly-pay">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Fixed Monthly Salary</label>
                                                    <input type="text" id="monthly_wage" onkeyup="get_weekly_wage();" name="monthly_salary" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Average Working Hours per Month</label>
                                                    <input type="text" name="working_hour_month" class="form-control" id="working_hour_month">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Annual Salary</label>
                                                    <input type="text" id="monthly_annual_wage" name="monthly_annual_wage" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Rate per Day</label>
                                                    <input type="text" id="monthly_rate_per_day" value="0" name="monthly_rate_per_day" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Rate per Hour</label>
                                                    <input type="text"  name="monthly_rate_per_hour" id="monthly_rate_per_hour" value="0"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab6" role="tabpanel" aria-labelledby="base-tab6">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Contact Person</label>
                                                            <input type="text" class="form-control" name="emergency_contact_name" id="b_street" placeholder="Contact Person">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Contact Telephone Number 1</label>
                                                            <input type="text" class="form-control" name="emergency_contact_number1" id="b_street" placeholder="Contact Telephone Number 1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Contact Telephone Number 2</label>
                                                            <input type="text" class="form-control" name="emergency_contact_number2" id="b_street" placeholder="Contact Telephone Number 2">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    
                                                </div>
                                                
                                            </div>
                                        </div> 
                                        
                                    </div>
                                    <div class="tab-pane" id="tab7" role="tabpanel" aria-labelledby="base-tab7">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>I pay this employee by:</label>
                                                    <select class="select2 form-control" name="pay_this_e_by" id="select-pay-terms">
                                                        <option value="">Select Option</option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="Cheque">Cheque</option>
                                                        <option value="electronic">Electronic Transfer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row hide" id="electronic-terms">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Type of Account:</label>
                                                        <select class="select2 form-control" name="account_type" >
                                                            <option value="">Select Option</option>
                                                            <option value="">Cash</option>
                                                            <option value="">Cheque</option>
                                                            <option value="">Electronic</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Bank: <br></label>
                                                        <select class="select2 form-control" name="bank_name" >
                                                            <option value="">Select Option</option>
                                                            <option value="">Cash</option>
                                                            <option value="">Cheque</option>
                                                            <option value="">Electronic</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Other Bank</label>
                                                        <input type="text" name="other_bank" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Branch Code</label>
                                                        <input type="text" name="branch_code" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Branch Name</label>
                                                        <input type="text" name="branch_name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Account Number</label>
                                                        <input type="text" name="account_number" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Account holder name</label>
                                                        <input type="text" name="acc_holder_name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Account holder relationship:</label>
                                                        <select class="select2 form-control" name="acc_holder_relation" >
                                                            <option value="">Select Option</option>
                                                            <option value="">Cash</option>
                                                            <option value="">Cheque</option>
                                                            <option value="">Electronic</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="base-tab3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tax this employee according to</label>
                                                    <select class="select2 form-control" name="tax_e_according_to">
                                                        <option value="1">Statutory Tables</option>
                                                        <option value="2">Fixed 25%</option>
                                                        <option value="3">Tax Directive</option>
                                                       <!-- <option value="4">Debit</option>-->
                                    <!--                </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>IRP5 Start Date</label>
                                                    <input type="date" name="irp5_start_date" id="" class="form-control form-control-sm datepicker ren_due change_data" value="">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Directives Number</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="directories_number_1" class="form-control" >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="directories_number_2" class="form-control" >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="directories_number_3" class="form-control" >
                                            </div>
                                        </div>
                                        <br>
                                        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Income Tax Number</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                               <input type="text" name="income_tax_number" class="form-control" >
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Voluntary PAYE Over Deduction:</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                               <input type="checkbox" name="voluntary_paye" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Select a reason if this employee must not pay Unemployment Insurance (UIF):</label>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="select2 " name="select_a_reason">
                                                        <option value="1">Not Selected</option>
                                                        <option value="2">Check</option>
                                                        <option value="3">Credit</option>
                                                        <option value="4">Debit</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Skills Development levy (SDL) must not be paid for this employee:</label>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="checkbox" name="sdl" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Exclude this employee from the Occupational Injuries and Diseases (OID) report:</label>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="checkbox" name="oid" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab8" role="tabpanel" aria-labelledby="base-tab8">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Type of medical aid:</label>
                                                    <select class="select2 form-control" name="type_of_medical_aid" id="medical-aid">
                                                        <option value="private">Private</option>
                                                        <option value="company">Company</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>No of beneficiaries (Main member & dependant)</label>
                                                    <input type="text" name="no_of_beneficiaries" class="form-control">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Frequency Medical Aid is Paid: <br></label>
                                                    <select class="select2 form-control" name="frequency_medical_aid" >
                                                        <option value="">Select Option</option>
                                                        <option value="">Week</option>
                                                        <option value="">Cheque</option>
                                                        <option value="">Electronic</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Total Paid per frequency: </label>
                                                    <input type="text" name="total_paid_frequency" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 hide" id="company-portion">
                                                <div class="form-group">
                                                    <label>Copmany Portion: </label>
                                                    <input type="text" name="company_portion" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="private-portion">
                                                <div class="form-group">
                                                    <label>Private Portion: </label>
                                                    <input type="text" name="private_portion" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="aid-credits">
                                                <div class="form-group">
                                                    <label>Medical Aid Tax Credits:</label>
                                                    <input type="text" name="tax_credits" class="form-control">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="base-tab4">
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Add Private RA <br></label>
                                                    <select class="select2 form-control " id="private-ra" name="payment_method" >

                                                        <option value="">Select Option</option>
                                                        <option value="private-ra1">1</option>
                                                        <option value="private-ra2">2</option>
                                                        <option value="private-ra-3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="private-r1 hide" id="ra1">
                                            
                                            <div class="row field_wrapper">
                                                <div class="col-md-4">
                                                    
                                                        <div class="form-group">
                                                            <label>The Employee Contributes R</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_contributes_r1" id="b_street" placeholder="Contribution">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>per month to a retirement annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            <label>From:</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="date" class="form-control" name="e_ra_from1" id="" placeholder="">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>with clrearence number annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_clearence_no1" id="b_street" placeholder="">
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="private-r2 hide" id="ra2">
                                            <div class="row field_wrapper">
                                                <div class="col-md-4">
                                                    
                                                        <div class="form-group">
                                                            <label>The Employee Contributes R</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_contributes_r11" id="b_street" placeholder="Contribution">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>per month to a retirement annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            <label>From:</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="date" class="form-control" name="e_ra_from11" id="" placeholder="">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>with clrearence number annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_clearence_no11" id="b_street" placeholder="">
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="row field_wrapper">
                                                <div class="col-md-4">
                                                    
                                                        <div class="form-group">
                                                            <label>The Employee Contributes R</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_contributes_r2" id="b_street" placeholder="Contribution">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>per month to a retirement annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            <label>From:</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="date" class="form-control" name="e_ra_from2" id="" placeholder="">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>with clrearence number annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_clearence_no2" id="b_street" placeholder="">
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="private-r3 hide" id="ra3">
                                            <div class="row field_wrapper">
                                                <div class="col-md-4">
                                                    
                                                        <div class="form-group">
                                                            <label>The Employee Contributes R</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_contributes_r111" id="b_street" placeholder="Contribution">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>per month to a retirement annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            <label>From:</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="date" class="form-control" name="e_ra_from111" id="" placeholder="">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>with clrearence number annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_clearence_no111" id="b_street" placeholder="">
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="row field_wrapper">
                                                <div class="col-md-4">
                                                    
                                                        <div class="form-group">
                                                            <label>The Employee Contributes R</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_contributes_r22" id="b_street" placeholder="Contribution">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>per month to a retirement annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            <label>From:</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="date" class="form-control" name="e_ra_from22" id="" placeholder="">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>with clrearence number annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_clearence_no22" id="b_street" placeholder="Contribution">
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="row field_wrapper">
                                                <div class="col-md-4">
                                                    
                                                        <div class="form-group">
                                                            <label>The Employee Contributes R</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_contributes_r3" id="b_street" placeholder="Contribution">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>per month to a retirement annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            <label>From:</label>
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="date" class="form-control" name="e_ra_from3" id="" placeholder="">
                                                            
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <label>with clrearence number annuity</label>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    
                                                        <div class="form-group">
                                                            
                                                            <input type="text" class="form-control" name="e_clearence_no3" id="b_street" placeholder="">
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                   
                        </div>                    
                    </div> -->
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="close">
                        <input type="submit" class="btn btn-outline-primary btn-md" id="saveEmployee" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade text-left edit__modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <label class="modal-title text-text-bold-600 text-center" id="myModalLabel33">Edit Customer Info</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                              
                </div>

                <form action="{{ route('updateCustomer') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body"> 

                        <div class="throw_customerinfo"></div>
                   
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="close">
                        <input type="submit" class="btn btn-outline-primary btn-md" id="" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade text-left delModel" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600 text-center" id="myModalLabel33">Customer Info</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                              
                </div>
                <form action="#" method="post" id="addCustForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Are You sure want to delete <b><span class="custName" style="color:red;"></span></b> ?</label>
                                </div>
                            </div>
                                <input type="hidden" id="custID" class="form-control">
                        </div>
                        {{csrf_field()}}                            
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="close">
                        <input type="button" class="btn btn-outline-danger btn-md" id="delcust" value="Delete">
                    </div>
                </form>                                 
            </div>
        </div>
    </div>
    
@endsection

@section('script')

    {{-- <script type="text/javascript" src="{{asset('public/dt/datatable/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/bootstrap-fileupload.js')}}"></script> --}}

    <script>

        $(document).ready(function(){
            $('#pmenu').addClass('active');
            $('#cst').addClass('active');

            $(".edit_modal").on('click', function() {

                var c_id = $(this).attr('customer_id');

                $.ajax({

                    url:"{{route('catch.employeeInfo')}}",

                    method:"GET",

                    data:{c_id:c_id},

                    success: function(data)
                    {
                        $('.throw_customerinfo').html(data);
                    }
                });

                $('.edit__modal').modal();

            });

            $('.table').on('click', '.inactive', function() {
                
                var this_data = $(this);
                var cust_id = $(this).val();
                    
                $.confirm({
                    
                    icon: 'fa fa-smile-o',
                    theme: 'modern',
                    closeIcon: true,
                    animation: 'scale',
                    type: 'red',
                    autoClose: 'cancel|10000',
                    escapeKey: 'cancel',
                    
                    buttons: {
                    
                        Inactive: {
                    
                            btnClass: 'btn-red',
                        
                            action: function() {
                        
                                $.ajax({
                        
                                    url:"{{route('inactive.customer')}}",
                                    
                                    method:"GET",
                                    
                                    data:{cust_id:cust_id},
                                    
                                    success: function(data) {
                        
                                        if(data == "1"){    
                                        
                                            this_data.parent().parent().fadeOut();
                                        
                                        } else {
                                        
                                            console.log(data);
                                        
                                        }
                                    }
                                });
                        
                                this.setCloseAnimation('zoom');
                            }
                        
                        },
                    
                        cancel: function() {
                        
                            $.alert('Canceled!');
                            
                            this.setCloseAnimation('zoom');
                        }
                    }
                });
            });
            $('#select-pay-cycle').change(function() {
                if(this.value == 'weekly') {
                    $('#weekly-pay').removeClass("hide");
                    $('#fornightly-pay').addClass("hide");
                    $('#monthly-pay').addClass("hide");
                }
                else if(this.value == 'fortnightly') {
                    $('#weekly-pay').addClass("hide");
                    $('#fortnightly-pay').removeClass("hide");
                    $('#monthly-pay').addClass("hide");
                }
                else if(this.value == 'monthly') {
                    $('#weekly-pay').addClass("hide");
                    $('#fortnightly-pay').addClass("hide");
                    $('#monthly-pay').removeClass("hide");
                }
                else {
                    $('#weekly-pay').removeClass("show").addClass("hide");
                    $('#fortnightly-pay').removeClass("show").addClass("hide");
                    $('#monthly-pay').removeClass("show").addClass("hide");
                }
            });
            $('#select-pay-terms').change(function() {
                if(this.value == 'electronic') {
                    $('#electronic-terms').removeClass("hide");
                    
                }
                else {
                    $('#electronic-terms').removeClass("show").addClass("hide");
                }
            });
            $('#medical-aid').change(function() {
                if(this.value == 'company') {
                    $('#company-portion').removeClass("hide");
                    $('#aid-credits').addClass("hide");
                    $('#private-portion').addClass("hide");
                }
                else if(this.value == 'private') {
                    $('#company-portion').addClass("hide");
                    $('#aid-credits').removeClass("hide");
                    $('#private-portion').removeClass("hide");
                }
                else {
                    $('#company-portion').removeClass("show").addClass("hide");

                }
            });
            $('#private-ra').change(function () {
                if(this.value == 'private-ra1') {
                    $('#ra1').removeClass("hide");
                    $('#ra2').addClass("hide");
                    $('#ra3').addClass("hide");
                    
                } else if(this.value == 'private-ra2') {
                    $('#ra2').removeClass("hide");
                    $('#ra1').addClass("hide");
                    $('#ra3').addClass("hide");
                } else if(this.value == 'private-ra-3') {
                    $('#ra3').removeClass("hide");
                    $('#ra2').addClass("hide");
                    $('#ra1').addClass("hide");
                } else {
                    $('#ra1').removeClass("show").addClass("hide");
                    $('#ra2').removeClass("show").addClass("hide");
                    $('#ra3').removeClass("show").addClass("hide");
                }

            });
            $('#datetimepicker8').datetimepicker({
                format: 'DD-MM-YYYY'
            });
            // var maxField = 2; //Input fields increment limitation
            // var addButton = $('.add_button'); //Add button selector
            // var wrapper = $('.field_wrapper'); //Input field wrapper
            // var fieldHTML = '<div class="row"><div class="col-md-4"><div class="form-group"><label>The Employee Contributes R</label></div></div><div class="col-md-3"><div class="form-group"><input type="text" class="form-control" name="b_street" id="b_street" placeholder="Contribution"></div></div><div class="col-md-3"><div class="form-group"><label>per month to a retirement annuity</label></div></div><div class="col-md-3"><div class="form-group"><label>From:</label></div></div><div class="col-md-3"><div class="form-group"><input type="date" class="form-control" name="b_street" id="" placeholder=""></div></div><div class="col-md-3"><div class="form-group"><label>with clrearence number annuity</label></div></div><div class="col-md-3"><div class="form-group"><input type="text" class="form-control" name="b_street" id="b_street" placeholder="Contribution"></div></div></div><div class="col-md-3"><div class="form-group"><button class=" btn-danger remove_button"> Remove New</button></div></div></div>'; //New input field html 
            // var x = 1; //Initial field counter is 1

            // //Once add button is clicked
            // $(addButton).click(function(){
            //     //Check maximum number of input fields
            //     if(x < maxField){ 
            //         x++; //Increment field counter
            //         $(wrapper).append(fieldHTML); //Add field html
            //     }
            // });

            // //Once remove button is clicked
            // $(wrapper).on('click', '.remove_button', function(e){
            //     e.preventDefault();
            //     $(this).parent('div').remove(); //Remove field html
            //     x--; //Decrement field counter
            // });

            $("#datatable").DataTable();
        });
    </script>
    <script>
        function get_week_hour_sum() {
            var working_hours_per_day=$("#working_hours_per_day").val(); 
            var working_days_per_week=$("#working_days_per_week").val(); 
            var weekly= $("#weekly_wage").val();
            var sum=0;
            sum=parseFloat(working_hours_per_day)*parseFloat(working_days_per_week);
            var hhh=sum.toFixed(2);
            var bi_hhh=hhh*2;
            var mon_hhh=hhh*52;
            var month_hhh=mon_hhh/12;

               var div=0;
            div=parseFloat(weekly)/parseFloat(working_days_per_week);
            var divv=0;
             divv=parseFloat(weekly)/parseFloat(hhh);
             $("#working_hour_per_week").val(hhh);
             $("#working_hour_bi_week").val(bi_hhh);
             $("#working_hour_month").val(month_hhh);
              $("#rate_per_day").val(div.toFixed(2));
            $("#rate_per_hour").val(divv.toFixed(2));
            }
    </script>
    <script>
        function get_weekly_wage() {
           var weekly= $("#weekly_wage").val();
           var bi_weekly= $("#bi_weekly_wage").val();
           var monthly_w= $("#monthly_wage").val();
           var working_days_per_week=$("#working_days_per_week").val(); 
           var working_hour_per_week=$("#working_hour_per_week").val(); 
           var working_hour_bi_week=$("#working_hour_bi_week").val(); 
           var working_hour_month=$("#working_hour_month").val(); 
           var div=0;
           div=parseFloat(weekly)/parseFloat(working_days_per_week);
           var bi_div=0;
           bi_div=parseFloat(bi_weekly)/parseFloat(working_days_per_week*2);
           var month_div=0;
           month_div=parseFloat(monthly_w)/parseFloat(working_days_per_week*52/12);
           var divv=0;
             divv=parseFloat(weekly)/parseFloat(working_hour_per_week);
           var bi_divv=0;
             bi_divv=parseFloat(bi_weekly)/parseFloat(working_hour_bi_week);  
            var month_divv=0;
             month_divv=parseFloat(monthly_w)/parseFloat(working_hour_month);    
           var sum=0;
            sum=parseFloat(weekly)*52;
            bi_sum=parseFloat(bi_weekly)*26;
            monthly_wa=parseFloat(monthly_w)*12;
            $("#annual_wage").val(sum.toFixed(2));
            $("#bi_annual_wage").val(bi_sum.toFixed(2));
            $("#monthly_annual_wage").val(monthly_wa.toFixed(2));
            $("#rate_per_day").val(div.toFixed(2));
            $("#bi_rate_per_day").val(bi_div.toFixed(2));
            $("#monthly_rate_per_day").val(month_div.toFixed(2));
            
            $("#rate_per_hour").val(divv.toFixed(2));
            $("#bi_rate_per_hour").val(bi_divv.toFixed(2));
            $("#monthly_rate_per_hour").val(month_divv.toFixed(2));
           
        }
     
    </script>
    


@endsection
