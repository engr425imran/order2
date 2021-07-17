@extends('master')
@section('title')
    Jani
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
        <h3 class="content-header-title mb-0">Add Employee</h3>

    </div>

</div>
<div class="content-body">
    <div class="row">
        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New Employee</h4>
                       <!-- @@@@@@@@@@ Start Messages @@@@@@@@@@@@ -->
      
      <!-- @@@@@@@@@@ End Messages @@@@@@@@@@@@ -->
                </div>
                <div class="card-content">
                    <div class="card-body">
                    
                        <ul class="nav nav-pills nav-pill-toolbar">
                            <li class="nav-item">
                                <a class="nav-link active" id="base-pill41" data-toggle="pill" href="#pill41" aria-expanded="true">Personal Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-pill42" data-toggle="pill" href="#pill42" aria-expanded="false">Addresses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-pill43" data-toggle="pill" href="#pill43" aria-expanded="false">Contact Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-pill43" data-toggle="pill" href="#pill44" aria-expanded="false">Bank Details</a>
                            </li>
                              <li class="nav-item">
                                <a class="nav-link" id="base-pill46" data-toggle="pill" href="#pill46" aria-expanded="false">Employment Details</a>
                            </li>
                              <li class="nav-item">
                                <a class="nav-link" id="base-pill56" data-toggle="pill" href="#pill56" aria-expanded="false">Medical Aid</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-pill43" data-toggle="pill" href="#pill45" aria-expanded="false">Payslip</a>
                            </li>
                           

                        </ul>
                        <form action="{{url('save-employee')}}" method="post">
                            @csrf
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel" class="tab-pane active" id="pill41" aria-expanded="true" aria-labelledby="base-pill41">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                            <h5>Personal Details</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="projectinput1">Employee Type : </label>
                                                <div class="col-md-4">
                                  <select class="select2 form-control" name="type">
                                  <option>Select Type</option>
                                  <option value="1">Person</option>
                                  <option value="2">Member / Director</option>
                                 <option value="3">Personal Service Provider (company, close corp or trust)</option>
                                                    </select>
                                                     
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-2">Employee Code :</label>
                                                <div class="col-md-4">
                                                    <input type="text" name="code" class="form-control" id="lastName2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">Title :</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="title" class="form-control" id="lastName2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">Initials :</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="initials" class="form-control" id="lastName2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">First Name :</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="first_name" class="form-control" id="lastName2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">Second Name :</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="second_name" class="form-control" id="lastName2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">Surname :</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="surname" class="form-control" id="lastName2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">Known as Name :</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="nickname" class="form-control" id="lastName2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">ID Number :</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="id_no" class="form-control" id="lastName2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">Date of Birth:</label>
                                                <div class="col-md-5">
                                                    <div class="input-group date" id="datetimepicker8">
                                                        <input type="text" name="dob" id="" class="form-control" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <span class="fa fa-calendar-o"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- <small>The employee is now 29</small> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">Passport Number :</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="passport_no" class="form-control" id="lastName2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">Passport Country :</label>
                                                <div class="col-md-8">
                                                    <select class="select2 form-control" name="passport_country">
                                                        <option value="">Select Country</option>
                                                        @foreach($country as $cc)
                                                        <option value="{{$cc->id}}">{{$cc->name}}</option>
                                                       @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">The employee is an asylum seeker :</label>
                                                <div class="col-md-8">
                                                    <div class="d-inline-block custom-control custom-checkbox mr-1">
                                                        <input type="checkbox" class="custom-control-input" name="is_asylum_seeker"  id="checkbox2">
                                                        <label class="custom-control-label" for="checkbox2"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">Asylum seeker permit number :</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="asylum_permit_number" class="form-control" id="lastName2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="lastName2" class="col-md-2">The employee is a refugee :</label>
                                                <div class="col-md-8">
                                                    <div class="d-inline-block custom-control custom-checkbox mr-1">
                                                        <input type="checkbox" class="custom-control-input" name="refugee"  id="checkbox3">
                                                        <label class="custom-control-label" for="checkbox3">This option can't be selected if the employee is an asylum seeker</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pill42" aria-labelledby="base-pill42">
                                 <div class="row">

                                    <div class="col-md-6">
                                        <hr>
                                        <h5>Physical/Residential Address</h5>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Unit Number :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="p_unit_number" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Complex Name :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="p_complex_name" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Street No :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="p_street_number" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Street/Farm Name :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="p_street_name" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Suburb/District :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="p_district" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">City/town :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="p_city" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Postal Code :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="p_postal_code" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="lastName2" class="col-md-4"> Country :</label>
                                            <div class="col-md-8">
                                              <select class="select2 form-control" name="p_country" style="width: 100%;">
                                                    <option>Select Country</option>
                                                        @foreach($country as $cc)
                                                        <option value="{{$cc->id}}">{{$cc->name}}</option>
                                                       @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <hr>
                                        <h5>Postal Address</h5>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="d-inline-block custom-control custom-checkbox mr-1">
                                                    <input type="checkbox" class="custom-control-input" name="default_physical_address" id="checkbox5">
                                                    <label class="custom-control-label" for="checkbox5">Default from physical/residential address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Address Type</label>
                                            <div class="col-md-8">
                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                    <input type="radio" class="custom-control-input" value="1" name="address_type" id="radio5">
                                                    <label class="custom-control-label" for="radio5">Post Box</label>
                                                </div>
                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                    <input type="radio" class="custom-control-input" value="2" name="address_type" id="radio6">
                                                    <label class="custom-control-label" for="radio6">Street Address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Unit Number :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="po_unit_number" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Complex Name :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="po_complex_name" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Street No :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="po_street_number" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Street/Farm Name :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="po_street_name" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Suburb/District :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="po_district" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">City/town :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="po_city" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Postal Code :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="po_postal_code" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="lastName2" class="col-md-4"> Country :</label>
                                            <div class="col-md-8">
                                                <select class="select2 form-control" name="po_country" style="width: 100%;">
                                                    <option>Select Country</option>
                                                        @foreach($country as $cc)
                                                        <option value="{{$cc->id}}">{{$cc->name}}</option>
                                                       @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Care of postal address</label>
                                            <div class="col-md-8">
                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                    <input type="radio" class="custom-control-input" name="co_postal" id="radio7">
                                                    <label class="custom-control-label" for="radio7"></label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <hr>
                                        <h5>Work Address</h5>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="d-inline-block custom-control custom-checkbox mr-1">
                                                    <input type="checkbox" class="custom-control-input" name="default_physical_address1" id="checkbox2">
                                                    <label class="custom-control-label" for="checkbox2">Default from physical address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="d-inline-block custom-control custom-checkbox mr-1">
                                                    <input type="checkbox" class="custom-control-input" name="default_company_address" id="checkbox2">
                                                    <label class="custom-control-label" for="checkbox2">Default from company address</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Unit Number :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="wo_unit_number" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Complex Name :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="wo_complex_name" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Street No :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="wo_street_no" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Street/Farm Name :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="wo_street_name" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Suburb/District :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="wo_district" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">City/town :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="wo_city" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Postal Code :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="wo_postal_code" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="lastName2" class="col-md-4"> Country :</label>
                                            <div class="col-md-8">
                                                <select class="select2 form-control" name="wo_country" style="width: 100%;">
                                                    <option>Select Country</option>
                                                        @foreach($country as $cc)
                                                        <option value="{{$cc->id}}">{{$cc->name}}</option>
                                                       @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pill43" aria-labelledby="base-pill43">
                                <div class="row">

                                    <div class="col-md-6">
                                        <hr>
                                        <h5>Contact Details</h5>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Home Number :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="home_number" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Work Number :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="work_number" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Cell Number :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="cell_number" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Fax Number :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="fax_number" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Email Address :</label>
                                            <div class="col-md-8">
                                                <input type="email" name="email" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <hr>
                                        <h5>Emergency Contact Details</h5>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Contact Person :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="emergency_contact_name" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Contact Telephone Number 1 :</label>
                                            <div class="col-md-8">
                                                <input type="number" name="emergency_contact_number1" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Contact Telephone Number 2 :</label>
                                            <div class="col-md-8">
                                                <input type="number" name="emergency_contact_number2" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>
                            </div>   
                            <div class="tab-pane" id="pill44" aria-labelledby="base-pill44">
                                <div class="row">

                                    <div class="col-md-12">
                                        <hr>
                                        <h5>Bank Account Type</h5>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Account Type :</label>
                                            <div class="col-md-8">
                                                <select class="custom-select form-control" name="account_type">
                                                    <option value="1">Not Paid Electronically</option>
                                                    <option value="2">Cheque/Current Account</option>
                                                    <option value="3">Savings Account</option>
                                                    <option value="4">Transmission Account</option>

                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Account holder Relationship :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="relationship" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <hr>
                                        <h5>Bank Account Details</h5>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Bank Name :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="bank_name" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Branch Name :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="branch_name" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Branch Code :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="branch_code" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Account Holder Name :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="account_holder_name" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Account Number :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="account_number" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                    </div>

                                    
                                </div>
                            </div>   
                                                        <div class="tab-pane" id="pill46" aria-labelledby="base-pill46">
                                  <div class="row">

                                    <div class="col-md-7">
                                        <hr>
                                        <h5>Employment Details</h5>
                                        <hr>
                                    <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Employee is paid :</label>
                                            <div class="col-md-8">
               <select style="width:100%;" class="custom-select form-control" onchange="get_employment_cycle();" name="ecycle_type_id" id="employee_pay_type">
                                  <option>Select Cycle Name</option>
                                  <option value="1">Weekly</option>
                                  <option value="2">Fortnightly</option>
                                 <option value="3">Monthly</option>
                                                    </select>
                                            </div>

                                        </div>
                                               <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Cycle :</label>
                                            <div class="col-md-8">
                                       <select style="width:100%;" class="select2 form-control" name="eperiod_id" id="employee_pay_cycle">
                                  <option>Select Cycle </option>
                                 
                                                    </select>
                                            </div>

                                        </div>
                                      <div class="form-group row">
                                                <label for="lastName2" class="col-md-4">Start Date:</label>
                                                <div class="col-md-5">
                               <div class="input-group date" id="datetimepicker99">
                        <input type="text" name="estart_date" id="" placeholder="Start Date" class="form-control">
                         <div class="input-group-append">
                                       <span class="input-group-text">
                                  <span class="fa fa-calendar-o"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- <small>The employee is now 29</small> -->
                                                </div>
                                            </div>
                                              <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Working Hours Per Day :</label>
                                            <div class="col-md-8">
                                                <input type="number" id="working_hours_per_day" name="working_hours_per_day" onkeyup="get_week_hour_sum();" placeholder="Working Hours Per Day" class="form-control" value="0" id="proposalTitle2">
                                            </div>

                                        </div>
                                                    <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Working Days Per Week :</label>
                                            <div class="col-md-8">
                                                <input type="number" id="working_days_per_week" name="working_days_per_week" onkeyup="get_week_hour_sum();" placeholder="Working Days Per Week" value="0" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                             <div class="form-group row">
                             <label for="proposalTitle2" class="col-md-4">Working Hours Per Week:</label>
                                            <div class="col-md-8">
                                                <input type="number" id="working_hour_per_week" value="0" name="working_hour_per_week" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                                         <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Weekly wage :</label>
                                            <div class="col-md-8">
                                                <input type="number" id="weekly_wage" onkeyup="get_weekly_wage();" value="0" name="weekly_wage" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                                          <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Annual Wage :</label>
                                            <div class="col-md-8">
                                                <input type="number" id="annual_wage" onkeyup="get_annual_wage();" value="0" name="annual_wage" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                                   <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Rate Per Day :</label>
                                            <div class="col-md-8">
                   <input type="number" id="rate_per_day" value="0" name="rate_per_day" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                                          <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Rate Per Hour :</label>
                                            <div class="col-md-8">
                                                <input type="number" id="rate_per_hour" value="0" name="rate_per_hour" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>

                                        </div>
                                        </div>
                            </div>
                             <div class="tab-pane" id="pill56" aria-labelledby="base-pill56">
                                <div class="row">
                                    <div class="col-md-6">
                                                       <hr>
                                        <h5>Medical Aid</h5>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Type of medical aid :</label>
                                            <div class="col-md-8">
                                                <select class="custom-select form-control" id="type_of_medical_aid" onchange="private_hide();" name="type_of_medical_aid">
                                <option value="1">Private</option>
                                <option value="2">Company</option>
                                                   

                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">No of beneficiaries                         (Main member & dependants) :</label>
                                            <div class="col-md-8">
                                                <input type="text" name="no_of_benifi" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                                      <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Frequency Medical Aid is paid :</label>
                                            <div class="col-md-8">
                                                <select class="custom-select form-control" name="frequency_medical_aid_paid">
                                        <option value="1">Week</option>
                                                   

                                                </select>
                                            </div>

                                        </div>
                                                   <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Total paid per frequency :</label>
                                            <div class="col-md-8">
                                                <input type="number" name="total_paid_per_frequency" id="total_paid_per_frequency" onkeyup="update_price();"class="form-control" >
                                            </div>

                                        </div>
                                                          <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Private portion :</label>
                                            <div class="col-md-8">
                                           <input type="number" name="private_portion" id="private_portion" class="form-control" readonly>
                                            </div>

                                        </div>
                                                          <div id="company_portion" style="display:none;" class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Company portion :</label>
                                            <div class="col-md-8">
<input type="number"  name="company_portion" class="form-control" id="company"  onkeyup="update_private();">
                                            </div>

                                        </div>                     
                                        <div class="form-group row">
                                            <label for="proposalTitle2" class="col-md-4">Medical Aid Tax Credits :</label>
                                            <div class="col-md-8">
                                                <input type="number" name="medical_aid_tax_credits" class="form-control" id="proposalTitle2">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pill45" aria-labelledby="base-pill45">
                                <p>This is a payslip tab.</p>
                            </div>

                        </div>
                        <input type="submit" value="Save Employee" class="btn btn-md btn-success pull-right mb-2" name="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection