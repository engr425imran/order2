@php
    use \App\Http\Controllers\AccountController;
@endphp

@extends('master')
@section('title')
    {{-- {{$title}} --}}
@endsection
@section('stylesheet')
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/css/datatables.min.css')}}"> --}}
    {{-- <link href="{{asset('public/css/bootstrap-fileupload.css')}}" rel="stylesheet" /> --}}

    <style>
        .fs-11 th,
        .fs-11 td {
            font-size: 11.4px;
        }
        .modal-body.bg {
            background-color: #FBFBFB;
        }

        .invalid {
            border-color: #ff7588 !important;
        }

        .table th, .table td {
            padding: 0.75rem 1rem;
        }

        .fs-11 .cw-45 {
            width: 45% !important;
        }
        .budget-label{
            line-height: 2 !important;
        }

        .list {
            border: 1px solid #d6d6d6;
            margin: 1rem;
            font-size: 14px;
            font-weight: 400;
        }

        .list .list-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background-color: #fafafa;
        }
        .list .list-header h5 {
            margin: 0;
            line-height: 2rem;
            font-size: 14px;
            font-weight: 600;
        }
        .list.budgets .list-item.budget.base-blue {
            display: grid;
            grid-gap: 1rem;
            grid-template-columns: 1fr 3fr 1fr 1fr auto;
        }
        .list.budgets .list-item.budget {
            padding-right: 0;
        }
        .list .list-item {
            border: 1px solid transparent;
            border-top-color: #d6d6d6;
            margin: 0;
            padding: .5rem 1rem;
            background-color: #fff;
        }
        .list .list-item:hover {
            cursor: pointer;
            border: 1px solid #2b9fd9;
            background: rgba(43,159,217,.05);
        }
        .truncate-text {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .list.budgets .list-item.budget.base-blue .budget-amount {
            text-align: right;
        }

        .budget-detail{
            padding: 0 !important;
            border-radius: 8px;
        }
        .budget-detail-scroll-container {
            flex-grow: 1;
            overflow: scroll;
            padding-bottom: 3em;
        }
        .budget-detail-scroll-container .budget-detail-effects {
            display: flex;
        }
        .budget-detail-scroll-container .budget-detail-effects-list {
            flex: 0 0 14rem;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .budget-detail-effects-list-month, .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item, .budget-detail-scroll-container .budget-detail-effects-list .create-budget-effect-button-container {
            margin-left: -1px !important;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .budget-detail-effects-list-month {
            top: 0;
            position: sticky;
            position: -webkit-sticky;
            z-index: 200;
            background: #f5f5f5;
            text-align: center;
            margin: 0;
            padding: 1rem 0;
            font-weight: 600;
            border: 1px solid #d6d6d6;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .create-budget-effect-button-container {
            border: 1px solid #d6d6d6;
            border-top: 0;
            margin-bottom: 1rem;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .create-budget-effect-button-container .create-budget-effect-button {
            width: 100%;
            padding: .5rem;
            border: 0;
            border-radius: 0;
            background: transparent;
            line-height: 1;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .create-budget-effect-button-container .create-budget-effect-button .fa-plus-circle {
            color: #1f2c33;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item.base-blue {
            box-shadow: inset 0.25rem 0 0 0 #2da0da, inset 0 -1px 0 0 #d6d6d6, inset -1px 0 0 0 #d6d6d6;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item {
            background: #fff;
            height: 5.5rem;
            padding: .5rem .5rem .5rem .75rem;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-details {
            margin-bottom: 1rem;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-controls, .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-details .number-input {
            height: 2rem;
            margin: 0;
            text-align: right;
            width: 60%;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .popper-container {
            position: relative;
            top: 1rem;
            left: -6rem;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-controls .ignore-budget-effect-button.base-blue {
            color: #2da0da;
            background-color: rgba(45,160,218,.08);
            border-color: rgba(45,160,218,.08);
        }
         .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-details .budget-effect-date:active,  .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-details .budget-effect-date:focus,  .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-details .number-input:active,  .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-details .number-input:focus {
            outline: none;
            border: 1px solid #2b9fd9;
            box-shadow: 0 0 5px #cacaca;
        }
         .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-details .budget-effect-date {
            height: 2rem;
            padding: .5rem;
            border-radius: 2px;
            border: 1px solid #fff;
        }
         .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-details .number-input:not(:focus) {
            border: 1px solid #fff;
            box-shadow: none;
        }
         .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-details .number-input {
            height: 2rem;
            margin: 0;
            text-align: right;
            width: 60%;
        }
        .budget-detail-scroll-container .budget-detail-effects-list .budget-effect-list-item .budget-effect-list-item-controls .delete-budget-effect-button {
            color: #f75d70;
            background-color: rgba(247,93,112,.08);
            border-color: rgba(247,93,112,.08);
        }
        .float-tooltip {
            position: relative;
            display: inline-block;
        }
        .float-tooltip__content--top {
            bottom: calc(100% + .5rem);
            left: 50%;
            transform: translateX(-50%);
        }
        .float-tooltip__content {
            position: absolute;
            z-index: 1002;
            display: none;
            width: max-content;
            max-width: 12rem;
            padding: .5rem 1rem;
            color: #fff;
            font-weight: 400;
            font-size: 14px;
            font-family: myriad-pro,sans-serif;
            line-height: 1rem;
            text-align: center;
            background-color: #202d33;
            border-radius: 2px;
        }
        .datepicker-wrapper{
            width: 60%;
        }
    </style>
@endsection
@section('content')


    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Accounts</h3>
            <div class="row breadcrumbs-top">
                
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                {{-- <a class="btn-icon btn btn-secondary btn-round" ><i class="ft-bell"></i> </a> --}}
                <a href="#" class="btn-icon btn btn-secondary btn-round btn-success add_modal btn-sm" data-toggle="modal" data-target="#xlarge">
                    <i class="fa fa-university"></i> Add Account</a>
            </div>
        </div>
    </div>




    <section id="">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">Chart of accounts:</h4>


                        <ul class="nav mt-3 mb-3 nav nav-pills nav-pills-cust nav-pills-icons" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" href="#allaccount" role="tablist" data-toggle="tab"><i class="fa fa-university" aria-hidden="true"></i>All Accounts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#assets" role="tab" data-toggle="tab"><i class="fa fa-university" aria-hidden="true"></i>Assets</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#income" role="tablist" data-toggle="tab"><i class="fa fa-university" aria-hidden="true"></i>Income</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#liability" role="tab" data-toggle="tab"><i class="fa fa-university" aria-hidden="true"></i>Liability</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#equity" role="tab" data-toggle="tab"><i class="fa fa-university" aria-hidden="true"></i>Equity</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#expense" role="tab" data-toggle="tab"><i class="fa fa-university" aria-hidden="true"></i>Expense</a>
                            </li>
                        </ul>


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

                    <div class="card-content">
                        <div class="card-body card-dashboard pt-0">
                            <div class="tab-content">

                                <div role="tabpanel" id="allaccount" class="tab-pane active show col-xl-12 col-lg-12 px-0">
                                    <table id="datatable1" class="table  table-bordered table-striped">
                                        <thead>
                                            <tr class="fs-11">
                                                <th>Number</th>
                                                <th class="cw-45">Name</th>
                                                <th>Type</th>
                                                <th>Tax Rate</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Net Movement</th>
                                                
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
    
                                        <tbody>
    
                                            @foreach ($accounts as $item)

                                                <tr class="fs-11">
                                                    <td> {{$item->ac_number}} </td>
                                                    <td> <span class="text-primary">{{$item->ac_name}}</span> <br> <sub>{{$item->description}}</sub></td>
                                                    <td> {{$item->type_name}} </td>
                                                    <td> {{$item->tax_name . ' (' . $item->tax_amount . '%)'}} </td>
                                                    <td> 0 </td>
                                                    <td> 200 </td>
                                                    <td> -200 </td>
                                                    
                                                    <td>
                                                        <a href class="btn btn-primary btn-sm btn-round edit_modal" ac_id = "{{$item->ac_id}}" title="Edit">
                                                            <i class="ft-edit-2"></i>
                                                        </a>
                                                        <a href class="btn btn-info btn-sm btn-round add_budget_modal" ac_id = "{{$item->ac_id}}" title="Budget">
                                                            <i class="ft-plus"></i>
                                                        </a>
                                                        <a href class="btn btn-danger btn-sm btn-round delete_modal" ac_id = "{{$item->ac_id}}" title="Delete">
                                                            <i class="ft-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                
                                @php $ac_type_p_1 = AccountController::get_acgrouptype(1); @endphp
                                

                                @if (isset($ac_type_p_1))

                                    <div role="tabpanel" id="income" class="tab-pane col-xl-12 col-lg-12 px-0">
                                        <table id="datatable2" class="table  table-bordered table-striped">
                                            <thead>
                                                <tr class="fs-11">
                                                    <th>Number</th>
                                                    <th class="cw-45">Name</th>
                                                    <th>Type</th>
                                                    <th>Tax Rate</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
        
                                            <tbody>
        
                                                @foreach ($ac_type_p_1 as $item)

                                                    <tr class="fs-11">
                                                        <td> {{$item->ac_number}} </td>
                                                        <td> <span class="text-primary">{{$item->ac_name}}</span> <br> <sub>{{$item->description}}</sub></td>
                                                        <td> {{$item->type_name}} </td>
                                                        <td> {{$item->tax_name . ' (' . $item->tax_amount . '%)'}} </td>
                                                        <td>
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-primary btn-sm btn-round edit_modal" 

                                                                ac_id = "{{$item->ac_id}}"
                                                                >
                                                            
                                                                <i class="ft-edit-2"></i>
                                                            
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    
                                                @endforeach
                                                
                    
                                            </tbody>
                                
                                        </table>
                                    </div>
                                
                                
                                @endif

                                
                                @php $ac_type_p_2 = AccountController::get_acgrouptype(2); @endphp

                                @if (isset($ac_type_p_2))

                                    <div role="tabpanel" id="equity" class="tab-pane col-xl-12 col-lg-12 px-0">
                                        <table id="datatable3" class="table  table-bordered table-striped">
                                            <thead>
                                                <tr class="fs-11">
                                                    <th>Number</th>
                                                    <th class="cw-45">Name</th>
                                                    <th>Type</th>
                                                    <th>Tax Rate</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
        
                                            <tbody>
        
                                                @foreach ($ac_type_p_2 as $item)

                                                    <tr class="fs-11">
                                                        <td> {{$item->ac_number}} </td>
                                                        <td><span class="text-primary"> {{$item->ac_name}} </span><br> <sub>{{$item->description}}</sub></td>
                                                        <td> {{$item->type_name}} </td>
                                                        <td> {{$item->tax_name . ' (' . $item->tax_amount . '%)'}} </td>
                                                        <td>
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-primary btn-sm btn-round edit_modal" 

                                                                ac_id = "{{$item->ac_id}}"
                                                                >
                                                                <i class="ft-edit-2"></i>
                                                            </button>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                                
                    
                                            </tbody>
                                
                                        </table>
                                    </div>
                                @endif
                                
                                @php $ac_type_p_3 = AccountController::get_acgrouptype(3); @endphp
                             

                                @if (isset($ac_type_p_3))
                                    
                                    <div role="tabpanel" id="expense" class="tab-pane col-xl-12 col-lg-12 px-0">
                                        <table id="datatable4" class="table  table-bordered table-striped">
                                            <thead>
                                                <tr class="fs-11">
                                                    <th>Number</th>
                                                    <th class="cw-45">Name</th>
                                                    <th>Type</th>
                                                    <th>Tax Rate</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
        
                                            <tbody>
        
                                                @foreach ($ac_type_p_3 as $item)

                                                    
                                                    <tr class="fs-11">
                                                        <td> {{$item->ac_number}} </td>
                                                        <td><span class="text-primary"> {{$item->ac_name}} </span><br> <sub>{{$item->description}}</sub></td>
                                                        <td> {{$item->type_name}} </td>
                                                        <td> {{$item->tax_name . ' (' . $item->tax_amount . '%)'}} </td>
                                                        <td>
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-primary btn-sm btn-round edit_modal" 

                                                                ac_id = "{{$item->ac_id}}"
                                                                >
                                                            
                                                                <i class="ft-edit-2"></i>
                                                            
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                
                                @php $ac_type_p_4 = AccountController::get_acgrouptype(4); @endphp
                                   
                                @if (isset($ac_type_p_4))                                        
                                    
                                    <div role="tabpanel" id="assets" class="tab-pane col-xl-12 col-lg-12 px-0">
                                        <table id="datatable5" class="table  table-bordered table-striped">
                                            <thead>
                                                <tr class="fs-11">
                                                    <th>Number</th>
                                                    <th class="cw-45">Name</th>
                                                    <th>Type</th>
                                                    <th>Tax Rate</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
        
                                            <tbody>
        
                                                @foreach ($ac_type_p_4 as $item)

                                                    <tr class="fs-11">
                                                        <td> {{$item->ac_number}} </td>
                                                        <td><span class="text-primary"> {{$item->ac_name}} </span><br> <sub>{{$item->description}}</sub></td>
                                                        <td> {{$item->type_name}} </td>
                                                        <td> {{$item->tax_name . ' (' . $item->tax_amount . '%)'}} </td>
                                                        <td>
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-primary btn-sm btn-round edit_modal" 

                                                                ac_id = "{{$item->ac_id}}"
                                                                >
                                                            
                                                                <i class="ft-edit-2"></i>
                                                            
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    
                                                @endforeach
                                                
                    
                                            </tbody>
                                
                                        </table>
                                    </div>
                                @endif
                                
                                @php $ac_type_p_5 = AccountController::get_acgrouptype(5); @endphp

                                @if (isset($ac_type_p_5))
                                    <div role="tabpanel" id="liability" class="tab-pane col-xl-12 col-lg-12 px-0">
                                        <table id="datatable6" class="table  table-bordered table-striped">
                                            <thead>
                                                <tr class="fs-11">
                                                    <th>Number</th>
                                                    <th class="cw-45">Name</th>
                                                    <th>Type</th>
                                                    <th>Tax Rate</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
        
                                            <tbody>
        
                                                @foreach ($ac_type_p_5 as $item)

                                                    <tr class="fs-11">
                                                        <td> {{$item->ac_number}} </td>
                                                        <td> <span class="text-primary"> {{$item->ac_name}}</span> <br> <sub>{{$item->description}}</sub></td>
                                                        <td> {{$item->type_name}} </td>
                                                        <td> {{$item->tax_name . ' (' . $item->tax_amount . '%)'}} </td>
                                                        <td>
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-primary btn-sm btn-round edit_modal" 

                                                                ac_id = "{{$item->ac_id}}"
                                                                >
                                                            
                                                                <i class="ft-edit-2"></i>
                                                            
                                                            </button>
                                                        </td>
                                                    </tr>                                                    
                                                @endforeach                                                
                    
                                            </tbody>
                                
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Add account --}}
    <div class="modal fade add__modal" role="dialog">
        <div class="modal-dialog modal-md">
    
            <div class="modal-content">
    
                <div class="modal-header"> 
                    <h4 class="modal-title">Add Account </h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
    
                <div class="modal-body bg">
    
                    <form action="{{ route('saveAccount') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                                                
                        <div class="form-group form-group-sm">
                            <label for="name">Account Number :</label>
                            <p><sup>A unique code/number for this account</sup></p>
                            <input type="text" class="form-control form-control-sm ac_number" id="name" name="ac_number" required autocomplete="off">
                            <span class="emsg hidden text-danger">Please Try another number</span>
                        </div>

                        <div class="form-group">
                            <label for="name">Account Name :</label>
                            <p><sup>A short title for this account (limited to 150 characters)</sup></p>
                            <input type="text" class="form-control form-control-sm" id="name" name="ac_name" required>
                        </div>

                        
                        <div class="form-group">
                            <label for="ac_type">Account Type :</label>
                            <br>

                            <select class="form-control form-control-sm " name="ac_type" id="ac_type" style="width: 100%" required>

                                <option value="">select type</option>

                                <optgroup label="Income">
                                    <option value="1">Turnover</option>
                                    <option value="2">Other income</option>
                                
                                </optgroup>

                                <optgroup label="Equity">
                                    <option value="3">Equity</option>
                                
                                </optgroup>
                                <optgroup label="Expense">
                                    <option  value="4">Cost of sales (direct costs)</option>
                                    <option  value="5">Depreciation</option>
                                    <option  value="6">Expense</option>
                                </optgroup>
                                <optgroup label="Assets">
                                    <option  value="7">Bank</option>
                                    <option  value="8">Current Asset</option>
                                    <option  value="9">Fixed Asset</option>
                                    <option  value="10">Inventory</option>
                                </optgroup>
                                <optgroup label="Liability">

                                    <option  value="11">Current liability</option>
                                    <option  value="12">Non current liability</option>
                                </optgroup>
               
                            </select>
                            
                        </div>

                        <div class="form-group">
                            <label for="tax_account">Tax :</label>
                            <br>

                            <select class="form-control form-control-sm" name="tax_account" id="tax_account" style="width: 100%">

                                @foreach ($taxs as $item)
                                    <option value="{{$item->tax_id}}">{{$item->tax_name .' ('. $item->tax_amount . '%)'}}</option>
                                @endforeach
                            </select>
                            
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <p><sup>A description of how this account should be used</sup></p>
                            <textarea name="description" id="description"  rows="3" class="form-control  form-control-sm"></textarea>
                        </div>

                        <div class="col-12 p-0 text-center">
                            <button class="btn btn-outline-success btn-sm" type="submit"> Save Now !
                            </button>
                            
                        </div>
                    </form>
    
    
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit account --}}
    <div class="modal fade edit__modal" role="dialog">
        <div class="modal-dialog modal-md">
    
            <div class="modal-content">
    
                <div class="modal-header"> 
                    <h4 class="modal-title">Edit Account details</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
    
                <div class="modal-body bg">
    
                    <form action="{{ route('updateAccount') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <span class="catch_acinfo"></span>                    

                        <div class="col-12 p-0 text-center">
                            <button class="btn btn-outline-success btn-sm" type="submit"> Update Now !
                            </button>
                            
                        </div>
                    </form>
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade addbudget__modal" role="dialog">
        <div class="modal-dialog modal-lg">
    
            <div class="modal-content">
                <div class="modal-header"> 
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade createbudget__modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                <form class="create-budget-form" action="{{route('budget.store')}}" method="POST">
                    <div class="modal-body bg">
                        @csrf
                        <input type="hidden" name="account_id">
                        <div class="row">
                            <div class="col-md-8 first-col">
                                <div class="form-group row">
                                    <label class="col-sm-4 budget-label">Budget name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="budget_name" class="form-control form-control-sm" placeholder="What is this budger for?">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 budget-label">Budget occurs:</label>
                                    <div class="col-sm-4">
                                        <select name="budget_occurs" class="form-control form-control-sm">
                                            <option value="once">Once</option>
                                            <option value="weekly">Every week</option>
                                            <option value="fortnightly">Every 2 weeks</option>
                                            <option value="monthly">Every month</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 budget-label">Budget starts on:</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="budget_starts" class="form-control form-control-sm" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 budget-label">Budget ends on:</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="budget_ends" class="form-control form-control-sm" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 budget-label">Budget type:</label>
                                    <div class="col-sm-4">
                                        <select name="budget_type" class="form-control form-control-sm">
                                            <option value="fixed">Fixed value</option>
                                            <option value="increasing">Increasing value</option>
                                            <option value="decreasing">Decreasing value</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 budget-label">Budget value is:</label>
                                    <div class="col-sm-4">
                                        <input name="budget_value" type="number" step="0.00" class="form-control form-control-sm" placeholder="0.00">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                        </div>     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade editbudget__modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                <form class="update-budget-form" action="{{route('budget.update')}}" method="POST">
                    <div class="modal-body bg">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-8 first-col">
                                <div class="form-group row">
                                    <label class="col-sm-4 budget-label">Budget occurs:</label>
                                    <div class="col-sm-5">
                                        <select name="budget_occurs" class="form-control form-control-sm">
                                            <option value="once">Once</option>
                                            <option value="weekly">Every week</option>
                                            <option value="fortnightly">Every 2 weeks</option>
                                            <option value="monthly">Every month</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 budget-label">Replace from:</label>
                                    <div class="col-sm-5">
                                        <input type="date" name="budget_starts" class="form-control form-control-sm" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 budget-label">Budget to:</label>
                                    <div class="col-sm-5">
                                        <input type="date" name="budget_ends" class="form-control form-control-sm" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 budget-label">Budget type:</label>
                                    <div class="col-sm-5">
                                        <select name="budget_type" class="form-control form-control-sm">
                                            <option value="fixed">Fixed value</option>
                                            <option value="increasing">Increasing value</option>
                                            <option value="decreasing">Decreasing value</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 budget-label">Budget value is:</label>
                                    <div class="col-sm-5">
                                        <input name="budget_value" type="number" step="0.00" class="form-control form-control-sm" placeholder="0.00">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                        </div>     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade editbudgetbatch__modal" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header"></div>
                <form class="update-budget-form" action="{{route('budget.update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="name">
                    <input type="hidden" name="account_id">

                    <div class="modal-body bg budget-detail">
                        <section class="budget-detail-scroll-container">
                            <div class="budget-detail-effects">
                                
                            </div>
                        </section>   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@push('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
    <script>
        $(document).ready(function () {

            $(document).on('click', '.add_modal', function() {
                
                
                $('.add__modal').modal();
            });

            $(document).on('click', '.edit_modal', function(e) {
                e.preventDefault();

                var ac_id = $(this).attr('ac_id');

                $.ajax({

                    url:"{{route('catch.accinfo')}}",

                    method:"GET",

                    data:{ac_id:ac_id},

                    success: function(data)
                    {
                        $('.catch_acinfo').html(data);
                    }
                });


            
                // var investment_id = $(this).attr('investment_id');

                // var amount = $(this).attr('amount');
                
                // var note = $(this).attr('note');
                
                // var account_id = $(this).attr('account_id');
                
                // var account_name = $(this).attr('account_name');
                // var created_date = $(this).attr('created_date');
                
                
                // $('.investment_id').val(investment_id);
                
                // $('.amount').val(amount);

                // $('.note').val(note);
                
                // $('.created_date').val(created_date);
                
                // $('.account_name').val(account_id);
                
                // $('.account_name').html(account_name);

                
                $('.edit__modal').modal();
            });

            $(document).on('click', '.add_budget_modal', async function(e) {
                e.preventDefault();
                var addBudgetModal = $('.addbudget__modal');
                var ac_id = $(this).attr('ac_id');

                const account = await $.get("{{route('get.accinfo')}}",{ac_id});

                updateBudgetModalContent(account,addBudgetModal);
                
                addBudgetModal.modal();
            });
            
            $(document).on("keyup", '.ac_number', function() {

                var val = $(".ac_number").val();
                
                $.ajax({

                    url:"{{route('catch.acNumber')}}",

                    method:"GET",

                    data:{val:val},

                    success: function(data) 
                    {
                        // console.log(data);
                        if ( data == '1' ) {
                                
                            $('.emsg').removeClass('hidden');
                            $('.emsg').show();
                            $('.ac_number').addClass('invalid');
                            
                        } else if ( data == '2') {
                        
                            $('.emsg').addClass('hidden');
                            $('.ac_number').removeClass('invalid');
                        }        
                    }

                });
                
            });
            
            $(document).on("keyup", '.ac_number_update', function() {

                var val = $(".ac_number_update").val();
                var account_id = $(".account_id").val();

                console.log(account_id);
                
                $.ajax({

                    url:"{{route('catch.acNumberup')}}",

                    method:"GET",

                    data:{
                        val:val,
                        account_id:account_id
                    },

                    success: function(data) 
                    {
                        // console.log(data);
                        if ( data == '1' ) {
                                
                            $('.emsg').removeClass('hidden');
                            $('.emsg').show();
                            $('.ac_number_update').addClass('invalid');
                            
                        } else if ( data == '2') {
                        
                            $('.emsg').addClass('hidden');
                            $('.ac_number_update').removeClass('invalid');
                        }        
                    }

                });
                
            });
            
            function updateBudgetModalContent(account, modal){
                if(account){
                    modal.find('.modal-title').text(`Budgets for ${account.ac_name}`);

                    if(account.budgets.length > 0){
                        let lists = '';
                        $.each(account.budgets, function(index, item){
                            lists += `
                            <div class="list-item budget base-blue edit-budget" budget_date="${item.date}" budget_name="${item.name}" ac_id="${account.ac_id}" budget_id="${item.id}">
                                <span class="budget-date">${item.date}</span>
                                <span class="budget-name truncate-text">${item.name}</span>
                                <span class="budget-label"></span>
                                <span class="budget-amount">$${item.value}</span>
                                <div class="budget-effect-list-item__move-button-container"></div>
                            </div>
                            `;
                        });
                        modal.find('.modal-body').html(`
                            <div class="list budgets">
                                <div class="list-header">
                                    <h5>Base scenario budgets (${account.budgets.length})</h5>
                                    <button class="btn btn-sm btn-primary btn-round create-budget" ac_id="${account.ac_id}">Create budget</button>
                                </div>
                                <div class="list-items">
                                    ${lists}
                                </div>
                            </div>
                        `);
                    }else{
                        modal.find('.modal-body').html(`
                            <div class="container text-center">
                                <h4>No cash budgets created this month</h4>
                                <p>Budgets act as <strong>placeholders</strong> for future cash movements and will <strong>'fill up'</strong> with your Paid and Due bills</p>
                                <button class="btn btn-md btn-primary create-budget" ac_id="${account.ac_id}">Create budget</button>
                            </div>
                        `);
                    }
                }
            }
            $(document).on('click', '.create-budget', async function(){
                var createBudgetModal = $('.createbudget__modal');
                var ac_id = $(this).attr('ac_id');

                const account = await $.get("{{route('get.accinfo')}}",{ac_id});
                if(createBudgetModal){
                    createBudgetModal.find('input[name=account_id]').val(account.ac_id);
                    createBudgetModal.find('.modal-header').html(`
                        <div>
                            <h4 class="modal-title">Creating a budget for ${account.ac_name}</h4>
                            <small>Use the options below to define your budget name, amount and payment schedule.</small>  
                        </div>
                    `);
                }
                createBudgetModal.modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

            $(document).on('submit', '.create-budget-form', function(e){
                e.preventDefault();
                $(this).find('button[type=submit]').prop('disabled', true);
                let ac_id = $(this).find('input[name=account_id]').val();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: async function(resp){
                        if(resp.success){
                            const account = await $.get("{{route('get.accinfo')}}",{ac_id});
                            updateBudgetModalContent(account, $('.addbudget__modal'));
                            $('.createbudget__modal').modal('hide');
                            $('.createbudget__modal').find('form')[0].reset();
                            $('.createbudget__modal').find('form').find('button[type=submit]').prop('disabled', false);
                        }
                    }
                });
            });

            $(document).on('click', '.edit-budget', async function(){
                var editBudgetModal = $('.editbudgetbatch__modal');
                var budget_name = $(this).attr('budget_name');
                var budget_date = $(this).attr('budget_date');
                var ac_id = $(this).attr('ac_id');

                const budgets = await $.get("{{route('budget.getbudget')}}",{ac_id,budget_name});
                editBudgetModal.find('input[name=name]').val(budget_name);
                editBudgetModal.find('input[name=account_id]').val(ac_id);
                
                if(budgets){
                    editBudgetModal.find('.modal-header').html(`
                        <div>
                            <h4 class="modal-title">Updating </h4>
                            <small>Any budget payments outside the date range below will not be replaced.</small>  
                        </div>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    `);

                    var budgetEffectContainer = editBudgetModal.find('.budget-detail-effects');
                    budgetEffectContainer.empty();
                    $.each(budgets, function(lastdate, budget){
                        let list = '';
                        $.each(budget.details, function(i, details){
                            list += `
                                <div class="budget-effect-list-item base-blue budget_${details.date}">
                                    <div class="budget-effect-list-item-details">
                                        <div class="datepicker-wrapper">
                                            <input type="date" name="budget[${details.id}][date]" class="form-control form-control-sm" value="${details.date}">
                                        </div>
                                        <div class="popper-container"></div>
                                        <input name="budget[${details.id}][value]" class="number-input budget-effect-value-input" type="text" value="${details.value}"></div>
                                        <div class="budget-effect-list-item-controls"><div class="float-tooltip">
                                            <button type="button" class="ignore-budget-effect-button base-blue"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            <div class="float-tooltip__content float-tooltip__content--top">Ignore</div>
                                        </div>
                                        <div class="float-tooltip">
                                            <button type="button" class="delete-budget-effect-button"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                            <div class="float-tooltip__content float-tooltip__content--top">Delete</div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        budgetEffectContainer.append(`
                            <div class="budget-detail-effects-list">
                                <p class="budget-detail-effects-list-month">${budget.date}</p>
                                ${list}
                                <div class="create-budget-effect-button-container">
                                    <button type="button" class="create-budget-effect-button" last_date="${lastdate}"><i class="fa fa-plus-circle"></i></button>
                                </div>
                            </div>
                        `)
                    });

                    $('.budget-detail').scrollTo('.budget_'+budget_date);
                }
                editBudgetModal.modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

            $(document).on('click', '.delete-budget-effect-button', function(){
                $(this).parent().parent().parent().remove();
            });

            $(document).on('submit','.update-budget-form', function(e){
                e.preventDefault();
                let form = this;
                Swal.fire({
                    title: 'Updating budget payment',
                    text: "Any budget payment outside the new date range will not be replaced.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if(result.value){
                        $.ajax({
                            url: $(form).attr('action'),
                            type: 'POST',
                            data: $(form).serialize(),
                            success: function(resp){
                               if(resp.success){
                                   Swal.fire({
                                        text: resp.msg,
                                        type: 'success'
                                   }).then(async () => {
                                        const account = await $.get("{{route('get.accinfo')}}",{ac_id:resp.account_id});
                                        updateBudgetModalContent(account, $('.addbudget__modal'));
                                        $('.editbudgetbatch__modal').modal('hide');
                                   });
                               }
                            }
                        })
                    }
                })
            });

            $(document).on('click', '.create-budget-effect-button',function(){
                var lastdate = $(this).attr('last_date');
                $(this).before(`
                    <div class="budget-effect-list-item base-blue">
                        <div class="budget-effect-list-item-details">
                            <div class="datepicker-wrapper">
                                <input type="date" name="budget[new][date][]" class="form-control form-control-sm" value="${lastdate}">
                            </div>
                            <div class="popper-container"></div>
                            <input name="budget[new][value][]" class="number-input budget-effect-value-input" type="text" value="0"></div>
                            <div class="budget-effect-list-item-controls"><div class="float-tooltip">
                                <button class="ignore-budget-effect-button base-blue"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                <div class="float-tooltip__content float-tooltip__content--top">Ignore</div>
                            </div>
                            <div class="float-tooltip">
                                <button class="delete-budget-effect-button"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                <div class="float-tooltip__content float-tooltip__content--top">Delete</div>
                            </div>
                        </div>
                    </div>
                `)
            });

            $('select[name=budget_occurs]').on('change', function(){
                switch(this.value){
                    case 'once':
                    break;
                    case 'weekly':
                    break;
                    case 'fortnightly':
                    break;
                    case 'monthly':
                    break;
                    case 'quarterly':
                    break;
                    case 'annually':
                    break;
                }
            });
            $('select[name=budget_type]').on('change', function(){
                var form = $('.create-budget-form');
                form.find('.first-col > .adjustment').remove();
                switch(this.value){
                    case 'increasing':
                    form.find('.first-col').append(`
                        <div class="form-group row adjustment">
                            <label class="col-sm-4 budget-label"></label>
                            <div class="col-sm-4">
                                <select name="budget_adjustment_type" class="form-control form-control-sm">
                                    <option value="$">$ Increase</option>
                                    <option value="%">% Increase</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input name="budget_adjustment_value" type="number" step="0.00" class="form-control form-control-sm" placeholder="0.00">
                            </div>
                        </div> 
                    `);
                    
                    break; 
                    case 'decreasing': 
                    form.find('.first-col').append(`
                        <div class="form-group row adjustment">
                            <label class="col-sm-4 budget-label"></label>
                            <div class="col-sm-4">
                                <select name="budget_adjustment_type" class="form-control form-control-sm">
                                    <option value="$">$ Decrease</option>
                                    <option value="%">% Decrease</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input name="budget_adjustment_value" type="number" step="0.00" class="form-control form-control-sm" placeholder="0.00">
                            </div>
                        </div> 
                    `);
                    break;

                    default: 
                    form.find('.first-col > .adjustment').remove();
                }
            });
            $(".select2").select2();

            $("#datatable1").DataTable();
            $("#datatable2").DataTable();
            $("#datatable3").DataTable();
            $("#datatable4").DataTable();
            $("#datatable5").DataTable();
            $("#datatable6").DataTable();
        });
    
    </script>
@endpush