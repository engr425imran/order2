@php 
    use \App\Http\Controllers\ProductController; 
    
    $n = $f_inv_s->inv_name;
    $mf_val = 0;
    $mf_val_ = 0;
    
@endphp

@extends('master')
@section('title')
    {{-- {{$title}} --}}
@endsection
@section('content')

    <style>
        
        .modal-body.bg {
            background-color: #FBFBFB;
        }

        #sizing-addon2 {
            padding: 5px;
        }       
        

        .table.inv_table td {
            padding: 0.2rem 0.2rem !important;
            background: #fff;
        }

        .inv_table .select2-selection--single {
            height: 31px !important;
            padding: 0px;
        }

        .inv_table .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 3px !important;
            right: 6px !important;
        }

        .w-12 {
            width: 12%;
        }

        .form-group {
            margin-bottom: .5rem !important;
        }
        .form-group-sm {
            margin-bottom: .5rem;
            margin-top: .5rem;
        }

        .w-12 .form-control-sm {
            padding-left: .1rem;
        }

        .form-control-sm {
            padding: 0 2px 2px 3px;
            height: 30px;
        }

        .w-12 select,
        .tax-ex select {
            height: 31px;
        }

        .mt-9 {
            margin-top: .9rem;
        }
        

        .w-12 .select2-selection__arrow b {
            border-color: #888 transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            left: 12%;
            margin-left: -4px;
            margin-top: 13px;
            position: absolute;
            top: 50%;
            width: 0;
        }

        .w-12.account .select2-selection__arrow b {
            left: 68%;
        }

        
        .fs-9 {
            font-size: 5px;
        }

        .fs-1 {
            font-size: 1.3rem;
        }

        .fs-pt {
            padding-top: .3rem;
        }

        .btn-sm.taxrate, .btn-sm.remove_taxamount {
            padding: 0.1rem 0.2rem;
            font-size: 0.445rem;
            line-height: 1;
            border-radius: 0.21rem;
        }

        .hide {
            display: none;
        }

        .invalid {
            border-color: #ff7588 !important;
        }


        .table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #e3ebf3;
            border-right: none;
            border-left: none;
            font-size: 12px;
            font-weight: 600;
            background: linear-gradient(#fff,#fafafa);
            background-color: #fafafa !important;
            border-top: none;
        }

        .table-striped tbody tr:nth-of-type(2n+1) {
            background-color: rgba(255, 255, 255, 0.5) !important;
        }

        .card-body {
            background: #fafafa;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }

        .card-header {
            border-bottom: 1px solid #ddd;
            background: linear-gradient(#fff,#f5f7f8);
        }

        .card-footer {
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            border-top: none;
            height: 60px;
        }

        .app-content {
            background: linear-gradient(#fff,#f8f8f8);
        }

        .select2-container--classic .select2-selection--single, .select2-container--default .select2-selection--single {
            height: 30px !important;
            padding: 0px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            top: 35%;
        }
        .table {
            margin-bottom: 0px;
            background-color: #fff;
        }

        .custom-btn {
            background: linear-gradient(#fff, #e6eaec);
            border: 1px solid #cfd2d4;
            transition: opacity .2s ease-out;
            height: 30px;
            border-radius: 3px;
            text-align: center;
        }

        /* .show > .dropdown-menu {
            left: -91px !important;
        } */

        .btn-save {
            background: linear-gradient(#00b1e6, #0382b3);
            background-color: rgba(0, 0, 0, 0);
            border: 1px solid #0078a5 !important;
            background-color: #00b1e6;
            padding: .45rem 1.9rem;
            font-size: .85rem;
            color: #fff;
        }

        .btn-save:hover {
            background: linear-gradient(#00a1d2, #03739f);
            color: #fff;
            border: 1px solid #0078a5;
        }

        .btn-app {
            background: linear-gradient(#7bd000, #6bb101);
            border: 1px solid #5cac00;
            padding: .45rem 2.9rem;
            font-size: .85rem;
            color: #fff;
        }

        .btn-app:hover {
            background: linear-gradient(#7bd000, #6bb101);
            color: #fff;
        }

        .btn-cancel {
            border: 1px solid #949a9e !important;
            background: linear-gradient( #bbbec2, #949a9e);
            text-shadow: none;
            color: #fff !important;
            padding: .45rem 1.2rem;
            font-size: .85rem;
        }
        
        .add_more {
            color: #40c65e;
        }

        .save_type {

            top: 8px;
            right: 33px;
            border: none !important;
            background: transparent;
            color: #fff !important;
            font-size: 13px !important;
        }
        .show-tax,.hide-tax {
            padding: 2px 0px 2px 6px;
            margin-left: 0px;
            margin-right: 10px;
            font-size: 9px;
            border: 1px solid #c1c1c1;
        }
        .hide-tax{
            padding: 2px 0px;
        }
        .table th, .table td {
            border-bottom: unset;
            border-top: unset;
        }
        .select2-results__options li.select2-results__option:nth-child(2) {
          color: #34df98;
        }
        .accounts label {
            margin: 4px 4px 0px 0px;
            white-space: nowrap;
            padding: 6px 6px 0px 0px;
            font-size: 13px;
            font-weight: 600;
        }
        .accounts {
            display: flex;
            width: 93%;
        }
        .tax-rate{
            width: 100%;
        }
       
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #c2c1da;
            opacity: 1; /* Firefox */
        } 
        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: #c2c1da;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: #c2c1da;
        }
        .form-control-sm, .w-12 .form-control-sm {
            padding-left: .1rem;
            padding: 10px;
            height: 35px;
        }
        .select2-container--classic .select2-selection--single, .select2-container--default .select2-selection--single {
            height: 35px !important;
            padding: 0px;
            border: 1px solid #ccd6e6;
        }
        td.width_8 {
            width: 107px;
        }
        .w-12 {
            width: 236px;
        }
        .return_sell_desc {
            width: 93%;
        }
        p.amount{
            padding: 11px 0px;
            font-size: 14px;
        }
        .content_data_1{
            border-bottom: 1px solid #e1e0e0;
        }
        .custom-btn {
            height: 39px;
        }
        .btn.add_line {
            width: 90%;
            border-right: 1px solid #cac9c9;
        }
        .custom-btn>* {
            font-size: 16px;
            font-weight: 600;
        }
        .table-bordered th, .table-bordered td{
            border: unset;
        }
        
        .horizontal-menu-2 .page-body-wrapper .main-panel .content-wrapper {
          padding-top: 0px;
        }
        .navbar {
            display: none !important;
        }
        .card .card-body {
            padding: 5px 30px;
        }
        .card-header {
            padding: 16px;
        }   
        .back-arrow {
            color: #007eff;
            line-height: 0;
        }
        .back-arrow:before {
            content: '\2190';
            font-size: 26px;
            position: relative;
            transition: 0.3s ease-in;
            left: 0px;
        }
        .back-btn:hover > a > i:before {
            left: -15px;
        }
        .horizontal-menu-2 .page-body-wrapper .main-panel .content-wrapper {
          padding-top: 0px;
        }
        .c_btn {
            background: linear-gradient(#fff,#e6eaec);
            background-color: rgba(0, 0, 0, 0);
            border: 1px solid #cfd2d4 !important;
            background-color: #fafafa;
            padding: .45rem 1.9rem;
            font-size: .85rem;
            color: #048fc2;
            font-weight: 700;
        }
    </style>

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="back-btn">
                <a href="javascript:history.back()"><i class="back-arrow"></i> Back</a>
            </div>  
        </div>
        <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            <div class="media width-250 float-right">
                <div class="media-left media-middle">
                    <div id="sp-bar-total-sales"><canvas style="display: inline-block; width: 152px; height: 30px; vertical-align: top;" width="152" height="30"></canvas></div>
                </div>
                <div class="media-body media-right text-right">
                    <h3 class="m-0">${{number_format($a_inv_sum,2)}}</h3><span class="text-muted">Sales</span>
                </div>
            </div>
        </div>
    </div>

    <section id="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Invoice</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a class="settings"><i class="fa fa-cog"></i></a></li>
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        

                        <form action="{{route('update.invoice')}}" method="POST" class="edit_invoice_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="inv_id" value="{{$inv->invoice_id}}">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-preview mt-1 mb-3" type="button"><i class="fa fa-eye"></i> Print/Preview</button>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                            <label>Customer</label>
                                            <select name="cust_id" class="select2 form-control customer_change" required>
                                                <option value="{{$inv->cust_id}}">{{$inv->customer->display_name}}</option>
                                                <option value="add_new_cust" class="add_new_cust">Add New Customer</option>
                                                @foreach ($customers as $cus)
                                                    <option value="{{$cus->cust_id}}">{{ $cus->display_name }}</option>
                                                @endforeach
                                            </select>                                            
                                        </div>                                       
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Invoice Date</label>
                                            <input type="text" name="invoice_date" id="datepicker" class="form-control form-control-sm current_date" value="{{$inv->invoice_date}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 pull-left">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input type="text" name="due_date" class="form-control form-control-sm datepicker ren_due change_data" value="{{$inv->due_date}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="invoice_id">Invoice ID</label>
                                            <input type="text" value="{{$n.$inv->invoice_code}}" id="invoice_id" class="form-control form-control-sm" readonly>
                                            <input type="hidden" name="invoice_code" value="{{$inv->invoice_code}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 pull-left">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" id="email" class="form-control form-control-sm" value="{{ $inv->email != '' ? $inv->email : $inv->customer->email }}">
                                        </div>
                                    </div>
                                    <div class="res_customer col-md-9 p-0"></div>
                                    
                                    <div class="col-md-3 pull-left">
                                        <div class="form-group">
                                            <label>Sales Rep</label>
                                            <select name="sales_rep" class="form-control form-control-sm">
                                                <option value="">(None)</option>
                                                <option value="add_new_sales_rep">(Add New Sales Resp)</option>
                                                @foreach($salesrep as $key=>$rep)
                                                    <option @if($inv->sales_rep == $rep->id) selected @endif value="{{$rep->id}}" selected>{{$rep->firstname}} {{$rep->lastname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="reference">Reference</label>
                                            <input type="text" name="reference" id="reference" class="form-control form-control-sm" value="{{$inv->reference}}">
                                        </div>
                                    </div>
                                    
                                   


                                    @foreach ($inv_more_fields as $mf)
                                    @php
                                        $mf_val ++
                                    @endphp
                                        <div class="form-group col-md-3 extra_input_{{$mf_val}}">
                                            <label for="" class="">{{$mf->new_label_name}}</label>
                                            <input type="hidden" class="label_current_name" name="new_label_name[]" value="{{$mf->new_label_name}}">
                                            <input type="text" class="form-control form-control-sm" name="new_field_data[]" value="{{$mf->new_field_data}}">
                                        </div>
                                    @endforeach
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="inv_description" id="description" class="form-control form-control-sm">{{$inv->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="new_label_inv"></div>
                                    
                                    <div class="clearfix"></div>

                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                   

                                    <div class="no_padding col-md-6" style="margin-bottom: 1.5em;">
                                        <div class="form-group form-group-sm">
                                            <br>
                                        </div>
                                    </div>


                                    <div class="col-md-3 text-right">
                                        <label for="">Amounts are</label>
                                    </div>

                                    <div class="col-md-3 text-right tax-ex">

                                        <select name="tax_ein" id="" class="form-control form-control-sm taxaxin">
                                            @php
                                                if ( $inv->tax_ein == 1 ){
                                                    echo'<option value="1">Tax Exclusive</option>
                                                    <option value="2">Tax Inclusive</option>
                                                    <option value="3">No Tax</option>';
                                                } else if ( $inv->tax_ein == 2) {
                                                    echo'<option value="2">Tax Inclusive</option>
                                                    <option value="1">Tax Exclusive</option>
                                                    <option value="3">No Tax</option>';
                                                } else if ( $inv->tax_ein == 3) {
                                                    echo'<option value="3">No Tax</option>
                                                    <option value="2">Tax Inclusive</option>
                                                    <option value="1">Tax Exclusive</option>';
                                                }
                                            @endphp
                                            
                                            
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="table-bordered table-striped ">
                                            <table class="table inv_table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th colspan="4">Items</th>
                                                        <th>Qty.</th>
                                                        <th>Price</th>
                                                        <th>Disc %</th>
                                                        <th class="tax-amount hide">Tax Amount <button class="hide-tax btn" type="button"><i class="fa fa-minus"></i></button></th>
                                                        <th class="text-right">Amount</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    {{-- @if (count($inv_details) > 0) --}}

                                                        @foreach ($inv_details as $item)
                                                            {{-- <input type="hidden" name="inv_details_id[]" value="{{$item->in_details}}"> --}}
                                                            @if ($item->ac_id > 0)
                                                            <tr class="content_data">
                                                                <td class="w-12 products-section">
                                                                    <div class="form-group form-group-sm">
                                                                        <select name="product[]" class="form-control form-control-sm catch_product">
                                                                            <option value="">Select Item</option>
                                                                            <option value="additem" class="add_more">&#43; Add New Item</option>
                                                                            @foreach ($products as $p)
                                                                                <option @if($item->product_id == $p->product_id) selected @endif  value="{{$p->product_id}}">{{$p->item_name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td class="width_25" colspan="3">
                                                                    <div class="form-group form-group-sm">
                                                                        <input type="text" name="description[]" class="form-control form-control-sm return_sell_desc" maxlength="100" placeholder="Enter Item Description" value="{{$item->id_description}}">
                                                                    </div>
                                                                </td>
                                                                <td class="width_8 quantity-control"> 
                                                                    
                                                                    <div class="form-group form-group-sm">
                                                                       <input type="number" name="quantity[]" min="0" step="0.01" title="Numbers Only" class="form-control form-control-sm quantity return_qty" value="{{$item->id_quantity}}">
                                                                    </div>
                                                                </td>
                                                                <td class="width_8 quantity-control">
                                                                    <div class="form-group form-group-sm">
                                                                        <input type="number" name="rate[]" min="0" step="0.01" class="form-control form-control-sm rate return_sell_rate" value="{{$item->id_rate}}">
                                                                    </div>
                                                                </td>
                                                                <td class="width_8 quantity-control">
                                                                    <div class="form-group form-group-sm">
                                                                        <input type="number" name="discount[]" min="0" step="0.01" class="form-control form-control-sm discount" value="{{$item->id_discount}}">
                                                                    </div>
                                                                </td>
                                                                <td class="width_8 taxamount tax-amount hide" style="width: 120px;">
                                                                    <div class="form-group form-group-sm">
                                                                        <input type="number" name="tax_amount[]" min="0" step="0.01" class="form-control form-control-sm tax_amount return_sell_taxAmount" readonly value="{{$item->id_tax_amount}}">
                                                                    </div>
                                                                </td>
                                                                <td class="width_11" style="width: 120px;">
                                                                    <div class="form-group form-group-sm">
                                                                        <input type="hidden" name="amount[]" class="form-control form-control-sm amount text-right" value="{{$item->id_amount}}" >
                                                                        <p class="amount text-right">{{$item->id_amount}}</p>
                                                                    </div>
                                                                </td>
                                                                <td class="width_4">
                                                                    <div class="form-group form-group-sm">        
                                                                        
                                                                        <button type="button" value="3" class="bill_remove_field btn btn-xs p-0"><i class="fa fa-trash fa-1x danger fs-1 pl-1 pr-1 fs-pt "></i></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="content_data_1">
                                                                <td colspan="1"></td>
                                                                <td class="width_15 account" colspan="3">
                                                                    <div class="form-group form-group-sm accounts">
                                                                        <label>Account</label>
                                                                        <select name="account[]" class="form-control form-control-sm catch_account return_sell_acc">
                                                                            <option value="{{$item->ac_id}}">{{$item->ac_number}} - {{$item->ac_name}}</option>
                                                                            <option value="addAcount" class="add_more">&#43; Add Account</option>
                                                                        
                                                                            @php
                                                                                $ac_type_1 = ProductController::get_acgrouptype(1);
                                                                                $ac_type_2 = ProductController::get_acgrouptype(2);
                                                                                $ac_type_3 = ProductController::get_acgrouptype(3);
                                                                                $ac_type_4 = ProductController::get_acgrouptype(4);
                                                                                $ac_type_5 = ProductController::get_acgrouptype(5);
                                                                            @endphp
                                                                                
                                                                            <optgroup label="Income">
                                
                                                                                @foreach ($ac_type_1 as $ac)
                                                                                <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                                                @endforeach
                                                                            </optgroup>
                                                                                
                                                                            <optgroup label="Equity">
                                
                                                                                @foreach ($ac_type_2 as $ac)
                                                                                <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                                                @endforeach
                                                                            </optgroup>
                                
                                                                                                                            
                                                                            <optgroup label="Liability">
                                
                                                                                @foreach ($ac_type_5 as $ac)
                                                                                <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                                                @endforeach
                                                                            </optgroup>
                                                                                
                                                                            <optgroup label="Assets">
                                
                                                                                @foreach ($ac_type_4 as $ac)
                                                                                <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                                                @endforeach
                                                                            </optgroup>
                                                                            
                                                                            <optgroup label="Expense">
                                
                                                                                @foreach ($ac_type_3 as $ac)
                                                                                <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                                                @endforeach
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td class="width_15"  colspan="3">
                                                                    <div class="form-group form-group-sm accounts tax-rate">
                                                                        <label><button class="show-tax btn" type="button"><i class="fa fa-plus"></i></button><span>Tax Rate</span></label>
                                                                        <select name="tax[]" class="form-control form-control-sm notax addtax return_sell_tax">
                                                                            <option value="{{$item->i_tax_amount.'__'.$item->i_tex_id}}"  selected>{{$item->tax_name.' ('.$item->i_tax_amount.' %)' }}</option>
                                                                            <option value="addNewTax" class="add_more">&#43; Add New Tax</option>
                                                                            
                                                                            @foreach ($tax_rates as $tax_rates1)
                                                                                <option value="{{ $tax_rates1->tax_amount.'__'.$tax_rates1->tax_id }}">
                                                                                    {{ $tax_rates1->tax_name.' ('.$tax_rates1->tax_amount.' %)' }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            @endif
                                                        @endforeach

                                                    <tr class="field_to_add_before"></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12">
                                        <br>
                                        <div class="row">
                                            <div class="offset-md-2 col-md-8">
                                                <div class="btn-group btn-group-sm custom-btn btn-block">
                                                    <button type="button" class="btn btn-block add_line" value="3">Add new line</button>
                                                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split more_line" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="false">
                                                      <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                      <li class="dropdown-item add_multiline" value="5">Add 5</li>
                                                      <li class="dropdown-item add_multiline" value="10">Add 10</li>
                                                      <li class="dropdown-item add_multiline" value="20">Add 20</li>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            {{-- Add New line --}}
                                            <div class="col-md-5">
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <label class="mt-9">Subtotal</label>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group-sm text-center">
                                                    
                                                    <input type="text" class="sub_total form-control form-control-sm text-center" value="{{$inv->sub_total}}" placeholder="Total" disabled> 
                                                    
                                                    <input type="hidden" name="sub_total" class="sub_total" value="{{$inv->sub_total}}">
                                                    
                                                    <br>
                                                </div>
                                            </div>
                                            <!--<div class="more_tax_show col-md-12" style="padding:0;">-->
                                            <!--</div>-->
                                            
                                            <div class="col-md-10 text-right">
                                                 <label class="mt-9 vat">Sum of All Tax</label>
                                            </div>
                                            <div class="col-md-2 vat">
                                                <div class="form-group-sm text-center">
                                                    
                                                    <input type="text" class="vat_total form-control form-control-sm text-center" value="0" placeholder="Total" disabled="">
                                                    <input type="hidden" name="vat_total" class="vat_total"> 
                                                    
                                                    <br>
                                                </div>
                                            </div>
                                            
                                            <!--<div class="col-md-10 text-right include_adjustment hide pull-left">-->
                                            <!--    <label class="mt-9">Includes Adjustments to Tax</label>-->
                                            <!--</div>-->
                                            <!--<div class="col-md-2 include_adjustment hide pull-right">-->
                                            <!--    <div class="form-group-sm text-center">-->
                                                    
                                            <!--        <input type="text" name="adjustment_tax" class="adjustment_tax form-control form-control-sm text-center" min="0" value="{{$inv->adjustment_tax}}" placeholder="Total">-->
                                                    
                                            <!--        <br>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                              
                                            <div class="col-md-10 text-right pull-left">
                                                <label class="mt-9"><b>Total</b></label>
                                            </div>
                                            <div class="col-md-2 pull-right">
                                                <div class="form-group-sm text-center">
                                                    
                                                    <input type="text" class="final_total form-control form-control-sm text-center" value="{{$inv->final_total}}" placeholder="Total" disabled> 
                                                    
                                                    <input type="hidden" name="final_total" class="final_total" value="{{$inv->final_total}}">
                                                    
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <br>
                                <div class="col-12">
                                    <label>Add Invoice Note</label>
                                    <textarea cols="4" name="invoice_note" placeholder="Add Note" class="form-control">{{$inv->inv_note}}</textarea>
                                </div>                                
                            </div>
                            <div class="col-12 p-0 text-center card-footer">
                                <div class="row">
                                    <div class="col-md-6 ">

                                        @if ($inv->inv_status == 2)
                                            
                                        @else
                                            
                                            
                                            <button class="btn btn-save pull-left mt-1 ml-1 " value="2" name="save_option" type="submit">Save and submit for approval</button>
                                            
                                            <!--<select name="save_option" id="" class="save_type form-control col-md-1">-->
                                            <!--    <option value="0" class="">&#8595;</option>-->
                                            <!--    <option value="2">Save and submit for approval</option>-->
                                            <!--    <option value="3">Save and add another</option>-->
                                            <!--</select>-->
                                        @endif


                                    </div>

                                    <div class="col-md-6">
                                        
                                        <a class="btn btn-cancel pull-right mt-1 mr-1" href="{{url('/cubebooks/invoices')}}"> Cancel </a> 
                                        <button class="btn btn-app pull-right mt-1 mr-1" value="3" name="approve" type="submit"> Approve</button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <table class="js_content d-none">
        <tr class=" content_data">
            <td class="w-12">
                <div class="form-group form-group-sm">
                    <select name="product[]" class="form-control form-control-sm catch_product">
                        <option value=""></option>
                        <option value="additem" class="add_more">&#43; Add New Item</option>
                        @foreach ($products as $p)
                            <option value="{{$p->product_id}}">{{$p->item_name}}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group form-group-sm">
                    <textarea type="" name="description[]" class="form-control form-control-sm return_sell_desc" maxlength="100"></textarea>
                </div>
            </td>
            <td> 
                
                <div class="form-group form-group-sm">
                <input type="number" name="quantity[]" min="0" step="0.01" title="Numbers Only" class="form-control form-control-sm quantity return_qty">
                </div>
            </td>
            <td>
                <div class="form-group form-group-sm">
                    <input type="number" name="rate[]" min="0" step="0.01" class="form-control form-control-sm rate return_sell_rate">
                </div>
            </td>
            <td>
                <div class="form-group form-group-sm">
                    <input type="number" name="discount[]" min="0" step="0.01" class="form-control form-control-sm discount" value="0">
                </div>
            </td>
            <td class="w-12 account">
                <div class="form-group form-group-sm">
                    <select name="account[]" class="form-control form-control-sm catch_account return_sell_acc">
                        <option value="0" ></option>
                        <option value="addAcount" class="add_more">&#43; Add Account</option>
                    
                        @php
                            $ac_type_1 = ProductController::get_acgrouptype(1);
                            $ac_type_2 = ProductController::get_acgrouptype(2);
                            $ac_type_3 = ProductController::get_acgrouptype(3);
                            $ac_type_4 = ProductController::get_acgrouptype(4);
                            $ac_type_5 = ProductController::get_acgrouptype(5);
                        @endphp
                            
                        <optgroup label="Income">

                            @foreach ($ac_type_1 as $ac)
                            <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                            @endforeach
                        </optgroup>
                            
                        <optgroup label="Equity">

                            @foreach ($ac_type_2 as $ac)
                            <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                            @endforeach
                        </optgroup>

                                                                        
                        <optgroup label="Liability">

                            @foreach ($ac_type_5 as $ac)
                            <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                            @endforeach
                        </optgroup>
                            
                        <optgroup label="Assets">

                            @foreach ($ac_type_4 as $ac)
                            <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                            @endforeach
                        </optgroup>
                        
                        <optgroup label="Expense">

                            @foreach ($ac_type_3 as $ac)
                            <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </td>
            <td class="w-12">
                <div class="form-group form-group-sm">
                    <select name="tax[]" class="form-control form-control-sm notax addtax return_sell_tax">
                        <option value="0"  selected></option>
                        <option value="addNewTax" class="add_more">&#43; Add New Tax</option>
                        
                        @foreach ($tax_rates as $tax_rates1)
                            <option value="{{ $tax_rates1->tax_amount.'__'.$tax_rates1->tax_id }}">
                                {{ $tax_rates1->tax_name.' ('.$tax_rates1->tax_amount.' %)' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td class="taxamount">
                <div class="form-group form-group-sm">
                    <input type="number" name="tax_amount[]" min="0" value="0" step="0.01" class="form-control form-control-sm tax_amount return_sell_taxAmount" readonly>
                </div>
            </td>
            <td>
                <div class="form-group form-group-sm">
                    <input type="text" name="amount[]" value="0" class="form-control form-control-sm amount" readonly>
                </div>
            </td>
            <td>
                <div class="form-group form-group-sm">        
                    
                    <button type="button" value="3" class="bill_remove_field btn btn-xs p-0"><i class="fa fa-trash fa-1x danger fs-1 pl-1 pr-1 fs-pt "></i></button>
                </div>
            </td>
        </tr>
    </table>




    {{-- Add item --}}
    <div class="modal fade add__modal" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header"> 
                    <h4 class="modal-title">New Item </h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('saveproInvoice') }}" method="POST" enctype="multipart/form-data"> 

                    @csrf

                    <div class="modal-body bg">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="item_code">Item code</label>
                                        <input type="text" name="item_code" id="item_code" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="item_name">Item Name</label>
                                        <input type="text" name="item_name" id="item_name" class="form-control form-control-sm" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-5"></div>

                                <div class="col-md-12"><hr></div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <fieldset>
                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input purchase"  name="purchase" value="0" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">I Purchase this item</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-3 pl-0 h_element_p">
                                    <label for="p_unit_price"> <sub>Unit price</sub> </label>
                                    <input type="text" name="p_unit_price" id="p_unit_price" class="form-control form-control-sm">
                                </div>
    
        
                                <div class="col-md-3 pl-0 h_element_p">
                                    <label for="p_account"><sub>Purchase Account</sub></label>
                                    <div class="input-group">
                                        <select name="p_account" id="p_account" class="form-control form-control-sm purchase_account" aria-describedby="sizing-addon2">

                                            <option value=""></option>

                                            @php
                                                $ac_type_p_1 = ProductController::get_acgrouptype(1);
                                                $ac_type_p_2 = ProductController::get_acgrouptype(2);
                                                $ac_type_p_3 = ProductController::get_acgrouptype(3);
                                                $ac_type_p_4 = ProductController::get_acgrouptype(4);
                                                $ac_type_p_5 = ProductController::get_acgrouptype(5);
                                            @endphp

                                            <optgroup label="Expense">

                                                @foreach ($ac_type_p_3 as $ac)
                                                    <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                @endforeach
                                            </optgroup>

                                                                                            
                                            <optgroup label="Assets">

                                                @foreach ($ac_type_p_4 as $ac)
                                                    <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                @endforeach
                                            </optgroup>

                                                                                            
                                            <optgroup label="Liability">

                                                @foreach ($ac_type_p_5 as $ac)
                                                    <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                @endforeach
                                            </optgroup>
                                                
                                            <optgroup label="Equity">

                                                @foreach ($ac_type_p_2 as $ac)
                                                    <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                @endforeach
                                            </optgroup>

                                            <optgroup label="Income">

                                                @foreach ($ac_type_p_1 as $ac)
                                                    <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                @endforeach
                                            </optgroup>
                                                
                                            


                                        </select>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="sizing-addon2"> <i class="ft-chevron-down"></i> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 pl-0 h_element_p">
                                    <label for="p_tax_rate"><sub>Tax Rate</sub></label>
                                    <div class="input-group">
                                        <select name="p_tax_rate" id="p_tax_rate" class="form-control form-control-sm throw_pacinfo" aria-describedby="sizing-addon2">
                                            <option value=""></option>
                                            
                                        </select>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="sizing-addon2"> <i class="ft-chevron-down"></i> </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 h_element_p"></div>
                                <div class="col-md-9 pl-0 h_element_p">
                                    <label for="p_description"><sub>Purchase Description</sub> <sub class=" text-muted">(for my suppliers)</sub></label>
                                    <textarea name="p_description" id="p_description" rows="3" class="form-control form-control-sm"></textarea>
                                    
                                </div>
                                <div class="col-md-12"><hr></div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <fieldset>
                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input check sell" checked name="sell" value="1" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">I sell this item</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-3 pl-0 h_element_s">
                                    <label for="s_unit_price"> <sub>Unit price</sub> </label>
                                    <input type="text" name="s_unit_price" id="s_unit_price" class="form-control form-control-sm">
                                </div>
    
        
                                <div class="col-md-3 pl-0 h_element_s">
                                    <label for="s_account"><sub>Sell Account</sub></label>
                                    <div class="input-group">
                                        <select name="s_account" id="s_account" class="form-control form-control-sm sell_account" aria-describedby="sizing-addon2">
                                            <option value=""></option>

                                            @php
                                                $ac_type_1 = ProductController::get_acgrouptype(1);
                                                $ac_type_2 = ProductController::get_acgrouptype(2);
                                                $ac_type_3 = ProductController::get_acgrouptype(3);
                                                $ac_type_4 = ProductController::get_acgrouptype(4);
                                                $ac_type_5 = ProductController::get_acgrouptype(5);
                                            @endphp
                                                
                                            <optgroup label="Income">

                                                @foreach ($ac_type_1 as $ac)
                                                <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                @endforeach
                                            </optgroup>
                                                
                                            <optgroup label="Equity">

                                                @foreach ($ac_type_2 as $ac)
                                                <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                @endforeach
                                            </optgroup>

                                                                                            
                                            <optgroup label="Liability">

                                                @foreach ($ac_type_5 as $ac)
                                                <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                @endforeach
                                            </optgroup>
                                                
                                            <optgroup label="Assets">

                                                @foreach ($ac_type_4 as $ac)
                                                <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                @endforeach
                                            </optgroup>
                                            
                                            <optgroup label="Expense">

                                                @foreach ($ac_type_3 as $ac)
                                                <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                @endforeach
                                            </optgroup>


                                            
                                        </select>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="sizing-addon2"> <i class="ft-chevron-down"></i> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 pl-0 h_element_s">
                                    <label for="s_tax_rate"><sub>Tax Rate</sub></label>
                                    <div class="input-group">
                                        <select name="s_tax_rate" id="s_tax_rate" class="form-control form-control-sm throw_sacinfo" aria-describedby="sizing-addon2">
                                            <option value=""></option>
                                        </select>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="sizing-addon2"> <i class="ft-chevron-down"></i> </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 h_element_s"></div>
                                <div class="col-md-9 pl-0 h_element_s">
                                    <label for="s_description"><sub>Sell Description</sub> <sub class=" text-muted">(for my customers)</sub></label>
                                    <textarea name="s_description" id="s_description" rows="3" class="form-control form-control-sm"></textarea>
                                    
                                </div>
                                <div class="col-md-12"><hr></div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <fieldset>
                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input check track" name="track" value="0" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">I track this item</label>
                                        </div>
                                    </fieldset>
                                </div>
            
    
        
                                <div class="col-md-4 pl-0 h_element_t">
                                    <label for="inventory_account"><sub>Inventory Asset Account</sub></label>

                                    <div class="input-group">
                                        <select name="inventory_account" id="inventory_account" class="form-control form-control-sm" aria-describedby="sizing-addon2">
                                            <option value=""></option>
                                            <option value="{{$iaccount->ac_id}}">{{$iaccount->ac_name}}</option>
                                        </select>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="sizing-addon2"> <i class="ft-chevron-down"></i> </span>
                                        </div>
                                    </div>
                                </div>

                                
                                
                                <div class="col-md-5 h_element_t"></div>
                                <div class="col-md-12"><hr></div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success btn-sm" type="submit"> Save Now !
                        </button>
                        <button type="button" class="btn btn-outline-warning btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Add account --}}
    <div class="modal fade add_acc_modal" role="dialog">
        <div class="modal-dialog modal-md">
    
            <div class="modal-content">
    
                <div class="modal-header"> 
                    <h4 class="modal-title">Add Account </h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
    
                <div class="modal-body bg">
    
                    <form action="{{ route('saveAccountInvoice') }}" method="POST" enctype="multipart/form-data">
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
                                <option value="">select tax</option>
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
                            <button class="btn btn-outline-success btn-sm btn_dis" type="submit"> Save Now !
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

    {{-- Add tax --}}
    <div class="modal fade add_tax_modal" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header"> 
                    <h4 class="modal-title">Add Tax Rate </h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('savetaxInvoice') }}" method="POST" enctype="multipart/form-data"> 

                    @csrf

                    <div class="modal-body bg">
                            
                        <div class="form-group">
                            <label for="tax_name">Tax Rate Display Name :</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="tax_name" placeholder="Tax Rate Display Name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="tax_amount">Tax Rate Amount :</label>
                            <input type="number" class="form-control form-control-sm" id="tax_amount" name="tax_amount" placeholder="Tax Rate Amount" required>
                        </div>
                        
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success btn-sm" type="submit"> Save Now !
                        </button>
                        <button type="button" class="btn btn-outline-warning btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    {{-- Settings --}}
    <div class="modal fade settings_modal" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header"> 
                    <h4 class="modal-title">Settings </h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body bg">
                        
                    <a class="add_label success"><i class="ft-plus"></i> Add new field</a><br>


                    @foreach ($inv_more_fields as $mf)

                        @php $mf_val_ ++; @endphp

                        <div class="form-row" val="{{$mf_val_}}">
                            <label for="" class="">{{$mf->new_label_name}}</label>
                            <input type="text" class="form-control form-control-sm change_label col-md-11" name="change_label" placeholder="Label Name" value="{{$mf->new_label_name}}">
                            <button type="button" class="btn btn-xs remove_label col-md-1" value="{{$mf->i_m_id}}"><i class="fa fa-trash fa-1x danger "></i></button>
                            <div class="clearfix"></div>
                        </div>
                    @endforeach



                    <div class="new_label"></div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

        {{-- View Modal --}}
    <div class="modal fade view__modal" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div id="doc_bill">

                    <div class="modal-header">
                    </div>

                    <div class="modal-body px-0">

                        <div class="bill">

                            <span class="throw_inv_content mb-2" ></span>

                            <br>

                        </div>
                    </div>
                </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn c_btn btn-primary pdf" onclick="genPDF()">Print PDF</button>
                        <button type="button" class="btn btn-app pt-1 pb-1 print_bill ml-3">Print</button>
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left addCustomer" id="add_new_cust" tabindex="-1" role="dialog" aria-labelledby="addCustomerLabel16" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600 text-center" id="myModalLabel33">Customer Info</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                              
                </div>

                <form action="{{ route('saveCust') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <label for="timesheetinput2">Company</label>
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="company" class="form-control" >
                                    <div class="form-control-position">
                                        <i class="fa fa-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Display Name</label>
                                    <input type="text" name="display_name" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Contact Person</label>
                                    <input type="text" name="contact_person" class="form-control">
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="text" name="mobile" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" >
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input type="text" name="fax" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Other</label>
                                    <input type="text" name="other" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" name="website" class="form-control">
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
                                        <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" role="tab" aria-selected="false">Notes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3" role="tab" aria-selected="false">Vat Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4" role="tab" aria-selected="false">Payment & Billing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab5" data-toggle="tab" aria-controls="tab5" href="#tab5" role="tab" aria-selected="false">Attachments</a>
                                    </li>
                                </ul>
                                <div class="tab-content px-1 pt-1">
                                    <div class="tab-pane active" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Billing Address</label>
                                                            <input type="text" class="form-control" name="b_street" id="b_street" placeholder="Street">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="b_city" id="b_city" placeholder="City/Town">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="b_state" id="b_state" placeholder="State/Province">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="b_postal" id="b_postal" placeholder="Postal Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="b_country" id="b_country" placeholder="Country">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Shipping Address</label> <label> (Same as Billing Address) <input type="checkbox" id="shipadd" name="shipadd"></label>
                                                            
                                                            <input type="text" class="form-control" name="c_street" id="c_street" placeholder="Street">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="c_city" id="c_city" placeholder="City/Town">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="c_state" id="c_state" placeholder="State/Province">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="c_postal" id="c_postal" placeholder="Postal Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="c_country" id="c_country" placeholder="Country">
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
                                                    <label>Notes</label>
                                                    <textarea class="form-control" name="note" rows="8"></textarea>
                                                </div>
                                            
                                            </div>
                            
                                        </div> 
                                    </div>

                                    <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="base-tab3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>VAT Reg. No.</label>
                                                    <input type="text" name="vat_reg_no" class="form-control">
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="base-tab4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Preferred Payment Method</label>
                                                            <select class="select2 form-control" name="payment_method">
                                                                <option value="1">Cash</option>
                                                                <option value="2">Check</option>
                                                                <option value="3">Credit</option>
                                                                <option value="4">Debit</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Preferred Delivery Method</label>
                                                            <select class="select2 form-control" name="delivery_method">
                                                                <option value="">None</option>
                                                                <option value="1">Print Later</option>
                                                                <option value="2">Send Later</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Terms</label>
                                                            <select class="select2 form-control" name="terms">
                                                                <option value="1">Due on Receipt</option>
                                                                <option value="2">Net 15</option>
                                                                <option value="3">Net 30</option>
                                                                <option value="4">Net 60</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Opening Balance</label>
                                                            <input type="text" name="opening_balance" value="0.0" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>As Of</label>
                                                            <input type="date" name="as_of_date" class="form-control" value="{{ date('Y-m-d') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="tab-pane" id="tab5" role="tabpanel" aria-labelledby="base-tab5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><i class="icon-anchor"></i> Attachments</label>
                                                    <input type="file" class="form-control" name="att" placeholder="Country">
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                </div>
                            </div>                   
                        </div>                    
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="close">
                        <input type="submit" class="btn btn-outline-primary btn-md" id="savecust" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="hide label_data">
        
        <label for="label_name">Label name :</label>
        <input type="text" class="form-control form-control-sm change_label col-md-11" name="change_label" placeholder="Label Name">
        <button type="button" class="btn btn-xs remove_label col-md-1" value=""><i class="fa fa-trash fa-1x danger "></i></button>
        <div class="clearfix"></div>
    </div>

    <div class="form-group hide label_data_">
        <label for="" class="label_current_name"></label>
        <input type="hidden" class="label_current_name" name="new_label_name[]">
        <input type="text" class="form-control form-control-sm" name="new_field_data[]">
    </div>

@endsection

@push('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script> 

        $(function() {
            $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
            $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
            $("#datepicker_due").datepicker({ dateFormat: 'yy-mm-dd' });
        });
    
        $(document).ready( function () {

            var val = $('.customer_change').val();

            $.ajax({

                url:"{{route('chech.customerInfo')}}",

                method:"GET",

                data:{val:val},

                success: function(data)
                {
                    $('.res_customer').html(data);
                    $('.res_customer').val(data);
                    $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
                }

            });

            $(document).on('click', '.btn-preview', function() {
                
                var formInvoice = $('.edit_invoice_form');
  
                $('.throw_inv_content').html("<h1 class='text-primary text-center'><i class='fa fa-spinner fa-spin fa-2x'></i></h1>");

                $.ajax({

                    url:"{{route('invPrintPrev')}}",
                    method:"POST",
                    data: formInvoice.serialize(),
                    success: function(data) 
                    {
                        $('.throw_inv_content').html(data);
                    }

                });

                $('.view__modal').modal();
            });

            $(document).on('change', '.customer_change', function(){

                var val = $(this).val();
                if(val != 'add_new_cust'){
                    $.ajax({

                        url:"{{route('chech.customerInfo')}}",

                        method:"GET",

                        data:{val:val},

                        success: function(data)
                        {
                            // .html(data);
                            $('.res_customer').html(data);
                            $('.res_customer').val(data);
                            // $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
                        }

                    });

                    $.ajax({

                        url:"{{route('chech.customerInfodue')}}",

                        method:"GET",

                        data:{val:val},

                        success: function(data)
                        {
                            // .html(data);
                            // $('.ren_due').html(data);
                            $('.ren_due').val(data);
                            // $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
                        }

                    });
                }else if(val == 'add_new_cust'){
                    $('#add_new_cust').modal();
                }

            });

            
            $(document).on('change', '.catch_terms', function(){

                var val = $(this).val();
                var cd = $('.current_date').val();

                $.ajax({

                    url:"{{route('chech.customerterms')}}",

                    method:"GET",

                    data:{
                        val:val,
                        cd:cd
                    },

                    success: function(data)
                    {
                        $('.change_data').val(data);
                    }

                });
            });

            $(document).on('change', '.current_date', function(){

                var cd = $(this).val();
                var terms = $('.catch_terms').val();

                $.ajax({

                    url:"{{route('change.invdate')}}",

                    method:"GET",

                    data:{
                        cd:cd,
                        terms:terms
                    },

                    success: function(data)
                    {
                        $('.change_data').val(data);
                    }

                });
            });
        });


        $(document).ready(function () {
            
            var content_data =  `<td class="w-12 products-section">
                                    <div class="form-group form-group-sm">
                                        <select name="product[]" class="form-control form-control-sm catch_product">
                                            <option value="">Select Item</option>
                                            <option value="additem" class="add_more">&#43; Add New Item</option>
                                            @foreach ($products as $p)
                                                <option value="{{$p->product_id}}">{{$p->item_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                               
                                <td class="width_25" colspan="3">
                                    <div class="form-group form-group-sm">
                                        <input type="text" name="description[]" class="form-control form-control-sm return_sell_desc" maxlength="100" placeholder="Enter Item Description">
                                    </div>
                                </td>
                                <td class="width_8 quantity-control"> 
                                    
                                    <div class="form-group form-group-sm">
                                       <input type="number" name="quantity[]" min="0" step="0.01" title="Numbers Only" class="form-control form-control-sm quantity return_qty">
                                    </div>
                                </td>
                                <td class="width_8 quantity-control">
                                    <div class="form-group form-group-sm">
                                        <input type="number" name="rate[]" min="0" step="0.01" class="form-control form-control-sm rate return_sell_rate">
                                    </div>
                                </td>
                                <td class="width_8 quantity-control">
                                    <div class="form-group form-group-sm">
                                        <input type="number" name="discount[]" min="0" step="0.01" class="form-control form-control-sm discount" value="0">
                                    </div>
                                </td>
                                <td class="width_8 taxamount tax-amount hide" style="width: 120px;">
                                    <div class="form-group form-group-sm">
                                        <input type="number" name="tax_amount[]" min="0" value="0" step="0.01" class="form-control form-control-sm tax_amount return_sell_taxAmount" readonly>
                                    </div>
                                </td>
                                <td class="width_11" style="width: 120px;">
                                    <div class="form-group form-group-sm">
                                        <input type="hidden" name="amount[]" value="0" class="form-control form-control-sm amount text-right">
                                        <p class="amount text-right"></p>
                                    </div>
                                </td>
                                <td class="width_4">
                                    <div class="form-group form-group-sm">        
                                        
                                        <button type="button" value="3" class="bill_remove_field btn btn-xs p-0"><i class="fa fa-trash fa-1x danger fs-1 pl-1 pr-1 fs-pt "></i></button>
                                    </div>
                                </td>`;
            var content_data_1 = `<td colspan="1"></td>
                                    <td class="width_15 account" colspan="3">
                                        <div class="form-group form-group-sm accounts">
                                            <label>Account</label>
                                            <select name="account[]" class="form-control form-control-sm catch_account return_sell_acc">
                                                <option value="0" >Select Account Type</option>
                                                <option value="addAcount" class="add_more">&#43; Add Account</option>
                                               
                                                @php
                                                    $ac_type_1 = ProductController::get_acgrouptype(1);
                                                    $ac_type_2 = ProductController::get_acgrouptype(2);
                                                    $ac_type_3 = ProductController::get_acgrouptype(3);
                                                    $ac_type_4 = ProductController::get_acgrouptype(4);
                                                    $ac_type_5 = ProductController::get_acgrouptype(5);
                                                @endphp
                                                    
                                                <optgroup label="Income">

                                                    @foreach ($ac_type_1 as $ac)
                                                    <option @if(isset($inv_settings) and $ac->ac_id == $inv_settings->default_account_type) selected @endif value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                    @endforeach
                                                </optgroup>
                                                    
                                                <optgroup label="Equity">

                                                    @foreach ($ac_type_2 as $ac)
                                                    <option @if(isset($inv_settings) and $ac->ac_id == $inv_settings->default_account_type) selected @endif value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                    @endforeach
                                                </optgroup>

                                                                                                
                                                <optgroup label="Liability">

                                                    @foreach ($ac_type_5 as $ac)
                                                    <option @if(isset($inv_settings) and $ac->ac_id == $inv_settings->default_account_type) selected @endif value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                    @endforeach
                                                </optgroup>
                                                    
                                                <optgroup label="Assets">

                                                    @foreach ($ac_type_4 as $ac)
                                                    <option @if(isset($inv_settings) and $ac->ac_id == $inv_settings->default_account_type) selected @endif value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                    @endforeach
                                                </optgroup>
                                                
                                                <optgroup label="Expense">

                                                    @foreach ($ac_type_3 as $ac)
                                                    <option @if(isset($inv_settings) and $ac->ac_id == $inv_settings->default_account_type) selected @endif value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="width_15"  colspan="3">
                                        <div class="form-group form-group-sm accounts tax-rate">
                                            <label><button class="show-tax btn" type="button"><i class="fa fa-plus"></i></button><span>Tax Rate</span></label>
                                            <select name="tax[]" class="form-control form-control-sm notax addtax return_sell_tax">
                                                <option value="0"  selected>Select a tax</option>
                                                <option value="addNewTax" class="add_more">&#43; Add New Tax</option>
                                                
                                                @foreach ($tax_rates as $tax_rates1)
                                                    <option @if(isset($inv_settings) and ($tax_rates1->tax_amount.'__'.$tax_rates1->tax_id) == $inv_settings->default_tax_rate) selected @endif value="{{ $tax_rates1->tax_amount.'__'.$tax_rates1->tax_id }}">
                                                        {{ $tax_rates1->tax_name.' ('.$tax_rates1->tax_amount.' %)' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" name="" class="form-control form-control-sm notax">
                                            <input type="hidden" name="tax[]" class="form-control form-control-sm onlytax"> --}}
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>`;

            var val = $('.catch_account').val();

            var accounttax = $('.catch_account').parent().parent().next().find('.notax');

            var onlytax = $('.catch_account').parent().parent().next().find('.onlytax');




            

            $(document).on('click', '.add_line', function () {

                var val = parseInt($(this).val());

                // if (val == 1){

                    val = val + 1;

                    $(this).val(val);

                    $(".bill_remove_field").val(val);

                    $('<tr class="delField_' + val + ' mt-4 ">' + content_data +'</tr><tr class="delField_1_' + val + ' mt-4 ">'+content_data_1+ '</tr>').insertBefore(".field_to_add_before");

                    var taxamount = $('.remove_taxamount').val();
                    var taxaxin = $('.taxaxin').val();
                    if (taxamount == 0) {
                        reCalculate ();
                    }
                // }
            });

            $(document).on('click', '.add_multiline', function () {

                var val = parseInt($(this).val());

                var inval = parseInt($('.add_line').val());

                var add_line = inval + val;

                // if (val == 1){

                    $(".add_line").val(add_line);

                    for(var i=1; i<=val; i++) {

                        var count = inval+i;

                        $('<tr class="delField_' + count + ' mt-4 ">' + content_data + '</tr><tr class="delField_1_' + count + ' mt-4 ">'+content_data_1+'</tr>').insertBefore(".field_to_add_before");
                    }

                    var taxamount = $('.remove_taxamount').val();
                    var taxaxin = $('.taxaxin').val();
                    if (taxamount == 0) {
                        reCalculate ();
                    }
                // }
            });

            $(document).on('click', '.bill_remove_field', function () {

                var delval = parseInt($('.add_line').val());

                // console.log(delval);

                if (delval > 1) {

                    $(".add_line").val(delval - 1);
                    $(this).parent().parent().parent().next().remove();
                    $(this).parent().parent().parent().remove();

                    fullCalculation();
                
                }

            });



            $(document).on('click', '.taxrate', function () {

                var val = $(this).val();
                var val2 = 0;
                if ( val == 1 ) {
                    $(".taxamount").removeClass('hide');
                    $(".include_adjustment").removeClass('hide');
                    $(".taxrate").addClass('hide');
                    $(".taxrate").val(val2);
                }

            });

            $(document).on('change', '.taxaxin', function () { 
                reCalculate(); 
                fullCalculation(); 
            });
            

            $(document).on('click', '.remove_taxamount', function () {

                var val = $('.remove_taxamount').val();
                var val2 = 1;

                if ( val == 0 ) {
                    $(".taxrate").val(val2);
                    $(".taxamount").addClass('hide');
                    $(".include_adjustment").addClass('hide');
                    $(".taxrate").removeClass('hide');
                }
            });
            
            // Product 
            $(document).on('change', '.catch_product', function () {

                var val = $(this).val();

                var skuid = $(this).parent().parent().next().find('.return_sell_desc');
                
                var prorateid = $(this).parent().parent().next().next().next().find('.return_sell_rate');
                var proaccid = $(this).parent().parent().parent().next().find('.return_sell_acc')
                var protax = $(this).parent().parent().parent().next().find('.return_sell_tax'); 
                var protaxamount = $(this).parent().parent().parent().next().find('.return_sell_taxAmount'); 
                var amnt = $(this).parent().parent().next().next().next().next().find('.amount');

                // var qty = 1;
                var qty = $(this).parent().parent().next().next().find('.return_qty').val(1);


                var ratee = 0;

                

                $.ajax({

                    url:"{{route('catch.product')}}",

                    method:"GET",

                    data:{val:val},

                    success: function(data)
                    {
                        data = JSON.parse(data);
                        //product
                        skuid.val(data.product.s_description);

                        //product rate
                        prorateid.val(data.product.product_rate);
                        amnt[0].value = data.product.product_rate;
                        amnt[1].innerText = data.product.product_rate;
                        ratee = data.product.product_rate;

                        //product account
                        proaccid.html(data.product.product_account);

                        //product tax
                        protax.html(data.product.product_tax);

                        //product tax amount
                        var total = Math.round(((ratee) * 1) * 100) / 100;
                        var tx_amnt = Math.round((((total * data.product.tax_amount) / 100) * 1) * 100) / 100;

                        // txt_amnt.val(tx_amnt);
                        protaxamount.val(tx_amnt);
                        fullCalculation();

                         $('#loader').addClass('hide');
                    },
                    error: function(e){
                         $('#loader').addClass('hide');
                         alert(e);
                    }
                });

                // $.ajax({

                //     url:"{{route('catch.productRate')}}",

                //     method:"GET",

                //     data:{val:val},

                //     success: function(data)
                //     {
                //         prorateid.val(data);
                //         amnt[0].value = data;
                //         amnt[1].innerText = data;
                //         ratee = data;
                //     }
                // });

                // $.ajax({

                //     url:"{{route('catch.productAccount')}}",

                //     method:"GET",

                //     data:{val:val},

                //     success: function(data)
                //     {                        
                //         proaccid.html(data);
                //     }
                // });

                // $.ajax({

                //     url:"{{route('catch.productTax')}}",

                //     method:"GET",

                //     data:{val:val},

                //     success: function(data)
                //     {                        
                //         protax.html(data);

                //     }
                // });

                // $.ajax({

                //     url:"{{route('catch.productTaxamount')}}",

                //     method:"GET",

                //     data:{val:val},

                //     success: function(data)
                //     {                        

                //         var total = Math.round(((ratee) * 1) * 100) / 100;

                //         var tx_amnt = Math.round((((total * data) / 100) * 1) * 100) / 100;

                //         // txt_amnt.val(tx_amnt);

                //         protaxamount.val(tx_amnt);

                //         fullCalculation();
                //     }
                // });

                
            });

            // Account
            $(document).on('change', '.catch_account', function () {

                var val = $(this).val();

                var accounttax = $(this).parent().parent().next().find('.notax');

                var txt_amnt = $(this).parent().parent().next().next().find('.tax_amount');

                var onlytax = $(this).parent().parent().next().find('.onlytax');


                var discount = $(this).parent().parent().prev().find('.discount').val();
                var rate = $(this).parent().parent().prev().prev().find('.rate').val();
                var quantity = $(this).parent().parent().prev().prev().prev().find('.quantity').val();

                
                var tax_rate_percentage = 0;

                $.ajax({

                    url:"{{route('chech.actax')}}",

                    method:"GET",

                    data:{val:val},

                    success: function(data)
                    {
                        var options = data.split('___');

                        accounttax.html(options[0]);

                        tax_rate_percentage += options[1];

                        // console.log(options[1]);
                        // console.log(options);

                        if(discount*1 > 0 && discount*1 != '' && discount <= 100){

                        }else{

                            discount = 0;
                        }

                        
                        if(quantity*1 > 0 && rate*1 > 0){

                            var total = Math.round(((quantity*rate) * 1) * 100) / 100;

                            var after_dis = Math.round(((total - (total * discount)/100) * 1) * 100) / 100;

                            var tx_amnt = Math.round((((after_dis * tax_rate_percentage) / 100) * 1) * 100) / 100;

                            txt_amnt.val(tx_amnt);
                            
                        }else{

                            txt_amnt.val(0);

                        }

                        fullCalculation(); 

                    }
                });
            });

            // Invoice calculateion start
            $(document).on('keyup change', '.quantity', function () {

                fullCalculation(); 
                
            });


            $(document).on('keyup change', '.rate', function () {

                fullCalculation();
            });

            $(document).on('keyup change', '.discount', function () {

                fullCalculation();
            });

            $(document).on('keyup change', '.notax', function () {
                

                var discount = $(this).parent().parent().prev().prev().find('.discount').val();
                var rate = $(this).parent().parent().prev().prev().prev().find('.rate').val();
                var quantity = $(this).parent().parent().prev().prev().prev().prev().find('.quantity').val();

                
                var txt_amnt = $(this).parent().parent().next().find('.tax_amount');

                // tax_rate_percentage = $(this).val()*1;

                
                var txxx = $(this).val().split("__");

                var tax_rate_percentage = Math.round((txxx[0] * 1) * 100) / 100;

                if(discount*1 > 0 && discount*1 != '' && discount <= 100){

                }else{

                    discount = 0;
                }

                
                if(quantity*1 > 0 && rate*1 > 0){

                    var total = Math.round(((quantity*rate) * 1) * 100) / 100;

                    var after_dis = Math.round(((total - (total * discount)/100) * 1) * 100) / 100;

                    var tx_amnt = Math.round((((after_dis * tax_rate_percentage) / 100) * 1) * 100) / 100;

                    txt_amnt.val(tx_amnt);
                    
                }else{

                    txt_amnt.val(0);

                }


                fullCalculation();

            });

            $(document).on('keyup change', '.tax_amount', function () {

                fullCalculation();
            });

            $(document).on('focusout', '.adjustment_tax', function () {

                var adjustment = $(this).val();

                if(adjustment >= 0){

                    var quantity = $(".quantity");

                    var tax_amount = $(".tax_amount");

                    var quantity = $(".quantity");
                    var rate = $(".rate");
                    var discount = $(".discount");
                    var tax = $(".notax");

                    var tot_qty = 0;

                    for (var i = 0; i < quantity.length; i++) {

                        var qty = Math.round((quantity[i]['value'] * 1) * 100) / 100;

                        tot_qty += qty;
                    }

                    var fraction = Math.round((adjustment / tot_qty * 1) * 100) / 100;

                    console.log(fraction);

                    for (var i = 0; i < quantity.length; i++) {

                        var qty = Math.round((quantity[i]['value'] * 1) * 100) / 100;
                    
                        var rat = Math.round((rate[i]['value'] * 1) * 100) / 100;

                        var dis = Math.round((discount[i]['value'] * 1) * 100) / 100;

                        
                        if(dis*1 > 0 && dis*1 != '' && dis <= 100){

                        }else{
                            dis = 0;
                        }

                        
                        if(qty*1 > 0 && rat*1 > 0){

                            var total = Math.round(((qty*rat) * 1) * 100) / 100;

                            var after_dis = Math.round(((total - (total * dis)/100) * 1) * 100) / 100;

                            
                            var txxx = tax[i]['value'].split("__");

                            var tax_rate_percentage = Math.round((txxx[0] * 1) * 100) / 100;

                            var orginal_tx_amnt = Math.round((((after_dis * tax_rate_percentage) / 100) * 1) * 100) / 100;
                        }

                        var tx_amnt = orginal_tx_amnt;
                        
                        var tt = fraction*qty;
                        
                        var out = tx_amnt + tt;

                        tax_amount[i].value = out;
                    }

                    fullCalculation();

                }

                
            });

        });


        function reCalculate () {

            var taxaxin = $('.taxaxin').val();            

            if ( taxaxin == 1 ) {

                if($(".taxrate").val() == 0){
                    
                    $(".taxrate").addClass('hide');
                    $(".taxamount").removeClass('hide');
                    $(".include_adjustment").removeClass('hide');
                    

                }else{

                    $(".taxrate").removeClass('hide');
                    $(".taxamount").addClass('hide');
                    
                }

                $(".vat").removeClass('hide');
                $(".notax").prop("disabled", false);
                $(".taxrate").prop("disabled", false);

            } else if ( taxaxin == 2 ) {

                $(".taxrate").addClass('hide');
                $(".taxamount").addClass('hide');
                $(".include_adjustment").addClass('hide');
                $(".notax").prop("disabled", false);
                $(".vat").removeClass('hide');
                
            } else if ( taxaxin == 3 ) {

                $(".notax").attr("disabled", true);
                $(".taxrate").attr("disabled", true);
                $(".taxamount").addClass('hide');
                $(".include_adjustment").addClass('hide');
                $(".vat").addClass('hide');
            }

        }
        
        function fullCalculation () {

            // Quantity Calculation
            var quantity = $(".quantity");
            var rate = $(".rate");
            var discount = $(".discount");
            var tax = $(".notax");
            var tax_amount = $(".tax_amount");
            var amount = $("input.amount");

            // console.log(quantity[0]['value']);

            var subtotal = 0;

            var total_tax_amnt = 0;

            var final_total = 0;

            var total_orginal_tax_amnt = 0;

            var tax_rate_percentage = 0;

            var more_tax_show = '';


            var tax_type = $(".taxaxin").val();


            if(tax_type == 1){

                for (var i = 0; i < quantity.length; i++) {

                    var qty = Math.round((quantity[i]['value'] * 1) * 100) / 100;
                    
                    var rat = Math.round((rate[i]['value'] * 1) * 100) / 100;

                    var dis = Math.round((discount[i]['value'] * 1) * 100) / 100;

                    var txxx = tax[i]['value'].split("__");

                    var tax_rate_percentage = Math.round((txxx[0] * 1) * 100) / 100;
                    

                    var tx_amnt =  Math.round((tax_amount[i]['value'] * 1) * 100) / 100;


                    if(dis*1 > 0 && dis*1 != '' && dis <= 100){

                    }else{
                        dis = 0;
                    }

                    if(tx_amnt*1 > 0 && tx_amnt*1 != ''){

                    }else{

                        tx_amnt = 0
                    }
                    
                    if(qty*1 > 0 && rat*1 > 0){

                        var total = Math.round(((qty*rat) * 1) * 100) / 100;

                        var after_dis = Math.round(((total - (total * dis)/100) * 1) * 100) / 100;

                        var orginal_tx_amnt = Math.round((((after_dis * tax_rate_percentage) / 100) * 1) * 100) / 100;

                        var no = i + 1;

                        more_tax_show += "<div class='col-md-10 text-right pull-left'><label class='mt-9'>"+no+". Tax "+tax_rate_percentage+" %</label></div><div class='col-md-2 pull-right'><div class='form-group-sm text-center'><input type='text' name='tax[]' value='"+orginal_tx_amnt+"' class='form-control form-control-sm text-center' disabled></div></div>";

                        tax_amount[i].value = orginal_tx_amnt;

                        total_orginal_tax_amnt += orginal_tx_amnt;

                        total_tax_amnt += orginal_tx_amnt;

                        amount[i].value = after_dis;
                        amount[i].parentElement.lastElementChild.innerText = after_dis;

                        subtotal = subtotal + amount[i]['value']*1;


                    }else{

                        discount[i].value = 0;
                        tax_amount[i].value = 0;
                        amount[i].value = 0;
                        amount[i].parentElement.lastElementChild.innerText = 0;
                        // quantity[i].value = 0;
                        // rate[i].value = 0;

                    }

                    // subtotal = subtotal + amount[i]['value']*1;

                }

                $('.sub_total').val(subtotal);

                $('.more_tax_show').html(more_tax_show);

                final_total = Math.round(((subtotal + total_tax_amnt) * 1) * 100) / 100;

                var adjustment_to_tx = Math.round(((total_tax_amnt - total_orginal_tax_amnt) * 1) * 100) / 100;

                $('.vat_total').val(total_tax_amnt);

                $('.adjustment_tax').val(adjustment_to_tx);

                $('.final_total').val(final_total);

            }

            if(tax_type == 2){

                for (var i = 0; i < quantity.length; i++) {

                    var qty = Math.round((quantity[i]['value'] * 1) * 100) / 100;
                    
                    var rat = Math.round((rate[i]['value'] * 1) * 100) / 100;

                    var dis = Math.round((discount[i]['value'] * 1) * 100) / 100;


                    var txxx = tax[i]['value'].split("__");

                    var tax_rate_percentage = Math.round((txxx[0] * 1) * 100) / 100;

                    if(dis*1 > 0 && dis*1 != '' && dis <= 100){

                    }else{
                        dis = 0;
                    }                    

                    var tx_amnt = 0;
                    
                    
                    if(qty*1 > 0 && rat*1 > 0){

                        var total = Math.round(((qty*rat) * 1) * 100) / 100;

                        var after_dis = Math.round(((total - (total * dis)/100) * 1) * 100) / 100;

                        
                        tx_amnt =  Math.round((after_dis - (after_dis / (1 + (tax_rate_percentage / 100))) * 1) * 100) / 100;

                        var no = i + 1;

                        more_tax_show += "<div class='col-md-10 text-right pull-left'><label class='mt-9'>"+no+". Tax "+tax_rate_percentage+" %</label></div><div class='col-md-2 pull-right'><div class='form-group-sm text-center'><input type='text' name='tax[]' value='"+tx_amnt+"' class='form-control form-control-sm text-center' disabled></div></div>";


                        total_tax_amnt += tx_amnt;

                        amount[i].value = after_dis;
                        amount[i].parentElement.lastElementChild.innerText = after_dis;

                        subtotal = subtotal + amount[i]['value']*1;

                        subtotal = Math.round((subtotal) * 100) / 100;
                    }else{

                        discount[i].value = 0;
                        tax_amount[i].value = 0;
                        amount[i].value = 0;
                        amount[i].parentElement.lastElementChild.innerText = 0;
                        // quantity[i].value = 0;
                        // rate[i].value = 0;

                    }

                    // subtotal = subtotal + amount[i]['value']*1;

                }

                $('.sub_total').val(subtotal);

                $('.more_tax_show').html(more_tax_show);

                // final_total = subtotal;
                final_total = Math.round((subtotal) * 100) / 100;
                $('.final_total').val(final_total);

            }

            if(tax_type == 3){

                for (var i = 0; i < quantity.length; i++) {

                    var qty = Math.round((quantity[i]['value'] * 1) * 100) / 100;
                    
                    var rat = Math.round((rate[i]['value'] * 1) * 100) / 100;

                    var dis = Math.round((discount[i]['value'] * 1) * 100) / 100;

                    if(dis*1 > 0 && dis*1 != '' && dis <= 100){

                    }else{
                        dis = 0;
                    }
                    
                    if(qty*1 > 0 && rat*1 > 0){

                        var total = Math.round(((qty*rat) * 1) * 100) / 100;

                        var after_dis = Math.round(((total - (total * dis)/100) * 1) * 100) / 100;

                        amount[i].value = after_dis;
                        amount[i].parentElement.lastElementChild.innerText = after_dis;

                        subtotal = subtotal + amount[i]['value']*1;
                        

                    }else{

                        discount[i].value = 0;
                        tax_amount[i].value = 0;
                        amount[i].value = 0;
                        amount[i].parentElement.lastElementChild.innerText = 0;

                    }

                }

                $('.sub_total').val(subtotal);

                $('.more_tax_show').html(more_tax_show);

                $('.final_total').val(subtotal);

            }
        }

        $(document).ready(function () { 
            $(".select2").select2();
            $("#datatable").DataTable();


            
            $(document).on('change', '.catch_product', function() {

                var new_item = $(this).val();

                if (new_item == 'additem') {

                    $(".purchase").click(function() {
                        if($(this).is(":checked")) {
                            $(".purchase").val(1);
                            $(".h_element_p").show(400);
                        } else {
                            $(".purchase").val(0);
                            $(".h_element_p").hide(300);
                        }
                    });

                    var pur = $('.purchase').val();

                    if ( pur == 0 ) {
                        $(".h_element_p").hide();
                    }


                    $('.add__modal').modal();
                }
            }); 
            
            $(document).on('change', '.catch_account', function() {

                var add_acount = $(this).val();

                if (add_acount == 'addAcount') {
                    $('.add_acc_modal').modal();
                }
            });
            
            $(document).on('change', '.addtax', function() {

                var add_tax = $(this).val();

                if (add_tax == 'addNewTax') {
                    $('.add_tax_modal').modal();
                }
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
                            $(".btn_dis").prop("disabled", true);
                            $(".btn_dis").addClass("btn-outline-danger");
                            
                        } else if ( data == '2') {
                        
                            $('.emsg').addClass('hidden');
                            $('.ac_number').removeClass('invalid');
                            $(".btn_dis").prop("disabled", false);
                            $(".btn_dis").removeClass("btn-outline-danger");
                        }        
                    }

                });

            });


            
            $(document).on('change', '.purchase_account', function() {

                var ac_id = $(this).val();

                $.ajax({

                    url:"{{route('catch.pactax')}}",

                    method:"GET",

                    data:{ac_id:ac_id},

                    success: function(data)
                    {
                        $('.throw_pacinfo').html(data);
                    }
                });
            });

            $(document).on('change', '.sell_account', function() {

                var ac_id = $(this).val();

                $.ajax({

                    url:"{{route('catch.sactax')}}",

                    method:"GET",

                    data:{ac_id:ac_id},

                    success: function(data)
                    {
                        $('.throw_sacinfo').html(data);
                    }
                });

            });


            $(".purchase").click(function() {
                if($(this).is(":checked")) {
                    $(".purchase").val(1);
                    $(".h_element_p").show(400);
                } else {
                    $(".purchase").val(0);
                    $(".h_element_p").hide(300);
                }
            });

            $(".sell").click(function() {
                if($(this).is(":checked")) {
                    $(".sell").val(1);
                    $(".h_element_s").show(400);
                } else {
                    $(".sell").val(0);
                    $(".h_element_s").hide(300);
                }
            });

            $(".h_element_t").hide();

            $(".track").click(function() {
                
                if($(this).is(":checked")) {

                    $(".track").val(1);
                    $(".sell").val(1);
                    $(".purchase").val(1);
                    $(".h_element_t").show(400);
                    $(".h_element_p").show(400);
                    $(".h_element_s").show(400);
                    $(".purchase").prop("checked", true);
                    $(".purchase").prop("disabled", true);
                    $(".sell").prop("checked", true);
                    $(".sell").prop("disabled", true);

                } else {

                    $(".track").val(0);
                    $(".h_element_t").hide(300);
                    $(".purchase").prop("disabled", false);
                    $(".sell").prop("disabled", false);

                }
            });
        });


        
        //******************************  For Settings Start *********************************//
            $(document).ready(function () {
                $(document).on('click', '.settings', function() {
    
                    $('.settings_modal').modal();
                });

                var label_data = $('.label_data').html();
                var label_data_ = $('.label_data_').html();

                $(document).on('click', '.add_label', function() {

                    var lvl_val = $(this).attr('val')*1;
                    lvl_val+=1;


                    $(this).attr('val',lvl_val);

                    var line = $(this).parent().parent().parent().parent().parent().parent().parent().find('.new_label_inv');

                    $('<div class="form-row" val="'+lvl_val+'">'+label_data+'</div>').insertBefore(".new_label");
                    $('<div class="form-group col-md-3 extra_input_'+lvl_val+'">'+label_data_+'</div>').insertBefore(line);
                    
                });

                $(document).on('keyup', '.change_label', function() {

                    var label_name = $(this).val();
                    // var line = $(this).parent().parent().parent().parent().parent().parent().parent().find('.label_current_name');
                    var line = $(this).parent().parent().parent().parent().parent().parent().parent().children().next().children().children().children().children().find('.label_current_name');

                    $(line).html(label_name);
                    $(line).val(label_name);
                    
                });

                $(document).on('click', '.remove_label', function () {

                    var lavel_del = $(this).val();

                    var lvl_val = $(this).parent().attr('val');

                    var delval = parseInt($(this).parent().attr('val'));
                    
                    // if (delval > 1) {

                        $(".add_label").val(delval - 1);

                        $(this).parent().remove();
                        $('.extra_input_'+lvl_val).remove();

                        $.ajax({
    
                            url:"{{route('extraMorefielddeledit')}}",
                
                            method:"GET",
                
                            data:{
                                lavel_del:lavel_del
                            },
                
                            success: function(data) 
                            {
                                console.log(data);
                            }
                
                        });

                    // }

                });


            });
        //******************************  For Settings End **********************************//
        $('.show-tax').click(function(){
            $('.tax-amount').removeClass('hide');
            $(this).addClass('hide');
        });

        $('.hide-tax').click(function(){
            $('.tax-amount').addClass('hide');
            $('.show-tax').removeClass('hide');
        });
    </script>
        <script type="text/javascript">
        function genPDF()
        {
            var formInvoice = $('.edit_invoice_form');
            $.ajax({
                url: "{{ route('update.invoice.ajax') }}",
                 method:"POST",
                data: formInvoice.serialize(),
                success: function(resp){
                    if(resp){
                        createinvoicePDF(resp);
                    }else{
                        alert('Something went wrong! Please try later');
                    }
                }
            });
        }
        function createinvoicePDF($id){
            var invoice_name = 'invoice';
            var pdfname = invoice_name+'-'+$id+'.pdf';
            var HTML_Width = $("#doc_bill").width();
            var HTML_Height = $("#doc_bill").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            html2canvas($("#doc_bill")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                
                pdf.textWithLink('https://www.keepctrl.co.za', (PDF_Width / 2) - 90, PDF_Height-30, { url: 'https://www.keepctrl.co.za' });
                pdf.text('Page ' + String(i) + ' of ' + String(totalPDFPages+1), PDF_Width -130, PDF_Height-30, { align: 'center'});
                var myImage = new Image();
                myImage.src = "{{url('/public/new/images/newlogo.jpg')}}";
                myImage.onload = function(){
                    pdf.addImage(myImage, "JPEG", PDF_Width/2 - 35, PDF_Height-130, 70, 70);
                    pdf.save(pdfname);
                };
                
            });
            setTimeout(function() {
                window.location = '/cubebooks/invoices';
            }, 2000);
        }
    </script>
@endpush