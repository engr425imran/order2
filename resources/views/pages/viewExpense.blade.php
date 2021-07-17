@php 
    use \App\Http\Controllers\ProductController; 

    $sum_total = ($inv->final_total - $in_pay_s);
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

        .w-15 {
            width: 15%;
        }

        .w-25 {
            width: 25%;
        }

        .form-group {
            margin-bottom: .5rem !important;
        }
        .form-group-sm {
            margin-top: .5rem;
            margin-left: .5rem;
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

        .fs-11 {
            font-size: 11px;
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
        }

        .custom-btn {
            background: linear-gradient(#fff, #e6eaec);
            border: 1px solid #cfd2d4;
            transition: opacity .2s ease-out;
            height: 30px;
            border-radius: 3px;
            text-align: center;
        }

        /*.show > .dropdown-menu {
            left: -91px !important;
        }*/

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
            color: #048fc2;
        }

        .view_inv {
            font-size: 12px;
        }

        .color-1 {
            color: #048fc2;
        }

        .bottom_line {
            border-top: 1px solid #000;
            border-bottom: 3px double #000;
            margin-bottom: 0;
            font-size: 20px;
        }

        .top_line {
            border-top: 1px dotted #cccccc;
        }

        .perivew {
            color: #048fc2;
        }

        .perivew:hover {
            color: #048fc2;
        }

        .lr_border {
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
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

        .inv_p {
            padding: 5px 35px 5px 0;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.5;
        }
        .inv_p2 {
            font-size: 13px;
            font-weight: 500;
            line-height: 1.5;
        }
        .vertical_top {
            vertical-align: top;
        }

        .inv_from {
            line-height: 2;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .by_none {
            border-top: none !important;
            border-bottom: none !important;
        }

        .bold_hr {
            border-top: 1px solid rgba(0, 0, 0, 0.52);
        }

        .bold_hr2 {
            border-top: 2px solid rgba(0, 0, 0, 0.52);
        }

        .payment_text {
            color: #000000;
        }
            
    </style>

    

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top"></div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
            </div>
        </div>
    </div>

    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Expense </h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="col-md-12 lr_border">
                            <div class="row">

                                <div class="col-md-6"></div>
                                <div class="col-md-6 text-right">
                                    <button 
                                        type="button"
                                        class="btn perivew" 
                                        invoice_id="{{$this_id}}"
                                    >
                                    <i class="fa fa-eye"></i> Perivew
                                    </button>

                                    <button 
                                        type="button"
                                        class="btn c_btn btn-md send_email" 
                                        invoice_id="{{$this_id}}"
                                    > Email

                                    </button>

                                    {{-- <button 
                                        type="button"
                                        class="btn c_btn btn-md ml-2"
                                    > Print PDF --}}

                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="card-body card-dashboard">
                            <div class="row view_inv">

                                <div class="col-md-6">

                                    <table>
                                        <tr>
                                            <th class="pr-1"><label>To</label></th>
                                            <th class="pr-1"><label>Date</label></th>
                                            <th class="pr-1"><label>Due Date</label></th>
                                            
                                        </tr>
                                        <tr>
                                            <td class="pr-1 color-1">{{$inv->display_name}}</td>
                                            <td class="pr-1">{{$inv->payment_date}}</td>
                                            <td class="pr-1">{{$inv->due_date}}</td>
                                            
                                        </tr>

                                        <input type="hidden" value="{{$invs->inv_name}}{{$inv->invoice_code}}" class="inv_name">
                                    </table>                                    
                                    <br>

                                    <table>
                                        <tr>
                                            <th class="pr-1"><label>Address</label></th>
                                        </tr>
                                        <tr>
                                            <td class="pr-1 color-1">{{$inv->b_street .' '. $inv->b_state .' '. $inv->b_city .' '. $inv->b_postal .' '. $inv->b_country}}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-6">
                                    <table class="pull-right">
                                        <tr>
                                            <th class="pr-1"><label>Total</label></th>
                                        </tr>
                                        <tr>
                                            <td class="pr-1 text-right">{{$inv->final_total}}</td>
                                        </tr>
                                        <div class="clearfix"></div>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                </div>


                                <div class="col-md-12 text-right">
                                    <label>Amounts are</label>
                                    @if ($inv->tax_ein ==1)
                                        <span><b>Tax Exclusive</b></span>
                                    @endif
                                    @if ($inv->tax_ein ==2)
                                        <span><b>Tax Inclusive</b></span>
                                    @endif
                                    @if ($inv->tax_ein ==3)
                                        <span><b>No Tax</b></span>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <div class="table-bordered table-striped ">
                                        <table class="table inv_table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Item Code </th>
                                                    <th>Description </th>
                                                    <th>Quantity </th>
                                                    <th>Unit Price </th>
                                                    <th>Disc %</th>
                                                    <th>Account</th>
                                                    <th>Tax Rate</th>
                                                    <th>Tax Amount</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($inv_details as $item)
                                                    <tr class="content_data">
                                                        <td class="w-12">
                                                            <div class="form-group form-group-sm">
                                                                <p class="">{{$item->item_code}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="w-15">
                                                            <div class="form-group form-group-sm">
                                                                <p class="">{{$item->id_description}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="w-12">
                                                            <div class="form-group form-group-sm">
                                                                <p>{{$item->id_quantity}} </p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group form-group-sm">
                                                                <p>{{$item->id_rate}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="w-12">
                                                            <div class="form-group form-group-sm">
                                                                <p>{{$item->id_discount}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="w-15 account">
                                                            <div class="form-group form-group-sm">
                                                                <p>{{$item->ac_name}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="w-15">
                                                            <div class="form-group form-group-sm">
                                                                <p>{{$item->tax_name}} </p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group form-group-sm">
                                                                <p>{{$item->id_tax_amount}} </p>
                                                            </div>
                                                        </td>
                                                        <td class="w-12">
                                                            <div class="form-group form-group-sm pr-1">
                                                                <p class="text-right"> {{$item->id_amount}}</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <br>

                                    <div class="row">
                                        <div class="col-md-5">
                                        </div>
                                        <div class="col-md-5 text-right">
                                            <label class="mt-9">Subtotal</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group-sm text-center">
                                                <span class=" pull-right pr-1">{{$inv->sub_total}}</span> 
                                                <br>
                                            </div>
                                        </div>
                                        <div class="more_tax_show col-md-12" style="padding:0;">  
                                            
                                        </div>
                                        @php
                                            $t_tax = 0;
                                        @endphp
                                        @foreach ($inv_details as $i_d)
                                           
                                            @php
                                                $t_tax += $i_d->id_tax_amount;
                                            @endphp
                                        @endforeach

                                        <div class="col-md-10 text-right">
                                                <label class="mt-9 vat">Total Sales Tax 0%</label>
                                        </div>
                                        <div class="col-md-2 vat">
                                            <div class="form-group-sm text-center">

                                                <span class="pull-right pr-1">{{$t_tax}}</span>
                                                
                                                <br>
                                            </div>
                                        </div>
                                        
                                        @if ($inv->final_total > $sum_total)

                                            <div class="col-md-8 text-right pull-left">
                                            </div>
                                            <div class="col-md-2 text-right pull-left top_line">
                                                <label class="mt-9"><b>TOTAL</b></label>
                                            </div>
                                            <div class="col-md-2 pull-right top_line">
                                                <div class="form-group-sm text-center">
                                                    <span class="pull-right pr-1"><b> {{$inv->final_total}}</b></span>
                                                    <br>
                                                </div>
                                            </div>

                                            @foreach ($inv_payments as $i_p)
                                                <div class="col-md-8 text-right pull-left">
                                                </div>
                                                <div class="col-md-2 text-right pull-left top_line">
                                                    <label class="mt-9">Less Payment </label>
                                                    <p class="color-1">{{$i_p->pay_date}}</p>
                                                </div>
                                                <div class="col-md-2 pull-right top_line">
                                                    <div class="form-group-sm text-center">
                                                        <span class="pull-right pr-1 color-1"> {{$i_p->amount}}</span>
                                                        <br>
                                                    </div>
                                                </div>
                                            @endforeach


                                        
                                            <div class="col-md-8 text-right pull-left">
                                            </div>
                                            <div class="col-md-2 text-right pull-left bottom_line">
                                                <label class="mt-9"><b>AMOUNT DUE</b></label>
                                            </div>
                                            <div class="col-md-2 pull-right bottom_line">
                                                <div class="form-group-sm text-center">
                                                    <span class="pull-right pr-1"> <b>{{$sum_total}}</b></span>
                                                    <br>
                                                </div>
                                            </div>
                                        @else
                                        
                                            <div class="col-md-8 text-right pull-left">
                                            </div>
                                            <div class="col-md-2 text-right pull-left bottom_line">
                                                <label class="mt-9"><b>Total</b></label>
                                            </div>
                                            <div class="col-md-2 pull-right bottom_line">
                                                <div class="form-group-sm text-center">
                                                    <span class="pull-right pr-1"> <b>{{$inv->final_total}}</b></span>
                                                    <br>
                                                </div>
                                            </div>

                                        @endif                                        
                                    </div>
                                </div>                                    
                            </div>
                            <br>                                
                        </div>
                    </div>
                </div>
            </div>

            @php
                $paid = DB::table('inv_payment_details')->where('inv_id', $inv->expense_id)->sum('amount');

                $due = ($inv->final_total - $paid);
            @endphp

            @if ($due==0)

            @else
            
                <div class="col-md-12">
                    <div class="card">
                        
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <p>Receive a payment</p>
                                <div class="row view_inv">
                                    <div class="col-md-8">
                                        <table>
                                            <tr>
                                                <th class="pr-1"><label>Amount Paid</label></th>
                                                <th class="pr-1"><label>Date Paid</label></th>
                                                <th class="pr-1"><label>Paid To</label></th>
                                                <th class="pr-1"><label>Reference</label></th>
                                            </tr>
                                            <tr>
                                                <form action="{{route('savePaymentExpense')}}" method="post">
                                                    @csrf

                                                    <input type="hidden" name="inv_id" value="{{$inv->expense_id}}">

                                                    <td class="pr-1 color-1">
                                                        <input type="number" class="form-control form-control-sm"  min="0.01" step="0.01" max="{{$sum_total}}" name="amount" required>
                                                    </td>
                                                    <td class="pr-1">
                                                        <input type="text" class="form-control form-control-sm datepicker" name="pay_date" required>
                                                    </td>
                                                    <td class="pr-1 w-25">
                                                        <div class="position-relative has-icon-right">
                                                            <select name="account_id" id="acc"  class="form-control form-control-sm" required>
                                                                <option value=""></option>
                                                                @php
                                                                    $ac_type_p_2 = ProductController::get_acgrouptype(2);
                                                                    $ac_type_p_5 = ProductController::get_acgrouptype(5);
                                                                @endphp
                                                                                                                
                                                                <optgroup label="Liability">

                                                                    @foreach ($ac_type_p_5 as $ac)
                                                                        @if ($ac->ac_id == 31 || $ac->ac_id == 32)
                                                                            <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </optgroup>
                                                                    
                                                                <optgroup label="Equity">

                                                                    @foreach ($ac_type_p_2 as $ac)
                                                                        @if ($ac->ac_id == 22)
                                                                            <option value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </optgroup>
                                                            </select>
                                                            <label for="acc" class="form-control-position"><i class="fa fa-angle-down"></i></label>
                                                        </div>
                                                    </td>
                                                    <td class="pr-1">
                                                        <input type="text" class="form-control form-control-sm" name="reference">
                                                    </td>
                                                    <td class="pr-1">
                                                        <button class="btn btn-app" type="submit"> Payment </button>
                                                    </td>
                                                </form>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                                <br>                                
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- View Modal --}}
    <div class="modal fade view__modal" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div id="doc_bill">

                    <div class="modal-header">

                        <div class="col-md-12">

                            <h6 class="text-center"><b>Invoice Perivew<b></h6>
       
                        </div>
                    </div>

                    <div class="modal-body px-0">

                        <div class="bill">

                            <span class="throw_inv_content mb-2" ></span>

                            <br>

                        </div>
                    </div>
                </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn c_btn pdf">Print PDF</button>
                        <button type="button" class="btn btn-app print_bill ml-3">Print</button>
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>

    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script> 

        $(function() {
            $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
            $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
            $("#datepicker_due").datepicker({ dateFormat: 'yy-mm-dd' });
        });

        $(document).ready( function () {

            $(document).on('change', '.customer_change', function(){

                var val = $(this).val();

                $.ajax({

                    url:"{{route('chech.customerInfo')}}",

                    method:"GET",

                    data:{val:val},

                    success: function(data)
                    {
                        // .html(data);
                        $('.res_customer').html(data);
                        $('.res_customer').val(data);
                        $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
                    }

                });
            });

            $(document).on('click', '.perivew', function() {
                
                var invoice_id = $(this).attr('invoice_id');

                $('.throw_inv_content').html("<h1 class='text-primary text-center'><i class='fa fa-spinner fa-spin fa-2x'></i></h1>");



                $.ajax({

                    url:"{{route('catchInvInfo')}}",

                    method:"GET",

                    data:{invoice_id:invoice_id},

                    success: function(data) 
                    {
                        $('.throw_inv_content').html(data);
                    }

                });

                $('.view__modal').modal();
            });

            $(document).on('click', '.pdf', function() {

                CreatePDFfromHTML();
            });

            $(document).on('click', '.send_email', function() {

                var invoice_id = $(this).attr('invoice_id');



                $.confirm({
                    icon: 'fa fa-paper-plane',
                    title: 'Email',
                    animationSpeed: 1000,
                    content: '' +
                        '<form action="" class="formName">' +
                        '<div class="form-group">' +
                        '<label>Enter a valid email</label>' +
                        '<input type="email" placeholder="Email" class="email form-control" required />' +
                        '</div>' +
                        '</form>',
                    buttons: {     
                        formSubmit: {
                            text: 'Send',
                            btnClass: 'btn-green',
                            action: function () {
                                var email = this.$content.find('.email').val();
                                
                                var errorText = this.$content.find('.text-danger');
                                if(!isEmail(email)){
                                    $.alert({
                                        content: "Please enter a valid E-mail.",
                                        type: 'red'
                                    });
                                    return false;
                                }

                                $.ajax({

                                    url:"{{route('sendinvmail')}}",

                                    method:"GET",

                                    data:{
                                        invoice_id:invoice_id,
                                        email:email

                                    },

                                    success: function(data) 
                                    {
                                        console.log(data);
                                        if (data == '1') {
                                            success();

                                        } else {
                                            error();
                                        }
                                    }

                                });   

                                // $.alert('Your name is ' + name);
                            }
                        },
                        cancel: {
                            btnClass: 'btn-red',
                            function () {
                            
                            //close
                            },
                        }    
                    },
                    onContentReady: function () {
                        // bind to events
                        var jc = this;
                        this.$content.find('form').on('submit', function (e) {
                            // if the user submits the form by pressing enter in the field.
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    },

                });
            });
            
        });

        $(document).ready(function() {

            $(document).on('click','.print_bill',function () {

                var prtContent = document.getElementById("doc_bill");

                var WinPrint = window.open('', '', 'left=0,top=0,width=1200,height=900,toolbar=0,scrollbars=0,status=0');

                WinPrint.document.writeln('<html><head><title></title><style>body {background-color: #fff!important;}</style>');


                WinPrint.document.writeln('<html><head><style>.hide_print_sec {display:none;}</style>');

                WinPrint.document.writeln('<html><head><link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet"></head>');
                WinPrint.document.writeln('<html><head><link rel="stylesheet" href="{{ asset('public/css/vendors.min.css') }}"></head>');
                WinPrint.document.writeln('<html><head><link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}"></head>');
                WinPrint.document.writeln('<html><head><link rel="stylesheet" href="{{ asset('public/css/bootstrap-extended.css') }}"></head>');

                WinPrint.document.writeln('<html><head><link rel="stylesheet" href="{{ asset('public/css/style.css') }}"></head>');
                WinPrint.document.writeln('<html><head><link rel="stylesheet" href="{{ asset('public/css/custom.css') }}"></head>');
                
                WinPrint.document.writeln('<html><head><style>.inv_p {padding: 5px 35px 5px 0;font-size: 13px;font-weight: 600;line-height: 1.5;}</style></head>');
                WinPrint.document.writeln('<html><head><style>.inv_p2 {font-size: 13px;font-weight: 500;line-height: 1.5;} .vertical_top {vertical-align: top;} .inv_from {line-height: 2;}.uppercase {text-transform: uppercase;} .by_none {border-top: none !important;border-bottom: none !important;} .bold_hr {border-top: 1px solid rgba(0, 0, 0, 0.52);} .bold_hr2 { border-top: 2px solid rgba(0, 0, 0, 0.52);} .payment_text {color: #000000;}</style></head>');

                // WinPrint.document.writeln('<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> ');


                WinPrint.document.writeln('<br>');

                WinPrint.document.writeln(prtContent.innerHTML);

                WinPrint.document.close();
                WinPrint.focus();

            });

        });
        function CreatePDFfromHTML() {
            var inv_name = $('.inv_name').val();

            var pdfname = inv_name+'.pdf';

            var HTML_Width = $("#bill").width();
            var HTML_Height = $("#bill").height();
            var top_left_margin = 10;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 4);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            html2canvas($("#bill")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save(pdfname);
                // $("#bill").hide();
            });
        };

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        function success () {

            toastr["success"]("Mail Send sussfully done.")

            toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "2000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        }

        function error() {
            toastr["error"]("Sorry, Mail not send.")

            toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "2000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        } 
    </script>
@endpush