@php
    use \App\Http\Controllers\InvoiceController;

    
@endphp

@extends('master')
@section('title')
    {{-- {{$title}} --}}
@endsection
@section('stylesheet')

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

        .w-100 {
            width: 100%;
        }

        .b_color {
            background: #e8f1ff !important;
        }
        .table td {
            font-size: 11px;
        } 
        
    </style>
@endsection
@section('content')


    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">General Ledger Report</h3>
            <div class="row breadcrumbs-top">
                
            </div>
        </div>
        {{-- <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <a href="#" class="btn-icon btn btn-secondary btn-round btn-success add_modal btn-sm" data-toggle="modal" data-target="#xlarge">
                    <i class="fa fa-university"></i> Add Account</a>
            </div>
        </div> --}}
    </div>




    <section id="">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header ">

                        <div class="col-md-12">
                            
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="from-group">
                                        <label for="from">From</label><br>
                                        <input type="text" class="from-control datepicker w-100 date_from">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="from-group">
                                        <label for="from">To</label><br>
                                        <input type="text" class="from-control datepicker w-100 date_to">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <button
                                        type="button"
                                        class="btn btn-blue btn-sm search"
                                        > Update

                                    </button>
                                </div>
                                
                                <div class="col-md-12">
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title">
           
                        </h4>


                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            
                    </div>

                    <div class="card-content">
                        <div class="card-body card-dashboard pt-0">

                            <div class="col-md-12">
                                {{-- General Ledger Summary
                                <br>
                                Demo company
                                <br>
                                From 1 February 2020 to 29 February 2020 --}}
                                <h4 class="search_term"></h4>
                                
                            </div>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="fs-11">
                                        <th class="cw-45">Account</th>
                                        <th class="text-right">Debit</th>
                                        <th class="text-right">Credit</th>
                                        <th class="text-right">Net Movement</th>
                                    </tr>
                                </thead>

                                <tbody class="search_res">
                                    @php
                                        $credit = 0;
                                        $c_total = 0;

                                        $pyament_acc = 0;
                                        $py_ac = 0;

                                        $receivable_ac_c = 0;
                                        $receivable_ac_ct = 0;

                                        $reAcPaySum =0;

                                        $fc_total =0;
                                        $fd_total =0;

                                    @endphp

                                    @foreach ($accounts as $a1)

                                        @php
                                            $receivable_ac_c = DB::table('invoices')
                                                        ->leftJoin('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
                                                        ->where('invoices.user_id', InvoiceController::get_user_id(auth()->user()->id))
                                                        ->where('invoices.status', 3)
                                                        ->where('invoice_details.account', $a1->ac_id)
                                                        ->sum('amount');

                                            $reAcPay = DB::table('invoices')
                                                        ->leftJoin('inv_payment_details', 'invoices.invoice_id', '=', 'inv_payment_details.inv_id')
                                                        ->where('invoices.user_id', InvoiceController::get_user_id(auth()->user()->id))
                                                        ->where('invoices.status', 3)
                                                        ->sum('amount');
                                            
                                            $receivable_ac_ct +=$receivable_ac_c;

                                            $reAcPaySum += $reAcPay;

                                            $debit_reAc = ($receivable_ac_ct - $reAcPay);

                                        @endphp
                                        
                                    @endforeach

                                    @if ($receivable_ac_ct > 0)

                                        <tr>
                                            <td class="text-primary">Accounts Receivable (610)</td>
                                            <td class="text-primary text-right">{{$receivable_ac_ct}}</td>
                                            <td class="text-primary text-right">{{$reAcPay}}</td>
                                            <td class="text-primary text-right">{{$debit_reAc}}</td>
                                        </tr>
                                    @endif

                                    @foreach ($accounts as $a)

                                        @php
                                            $credit = DB::table('invoices')
                                                    ->leftJoin('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
                                                    ->where('invoices.user_id', InvoiceController::get_user_id(auth()->user()->id))
                                                    ->where('invoices.status', 3)
                                                    ->where('invoice_details.account', $a->ac_id)
                                                    ->sum('amount');

                                            $pyament_acc = DB::table('invoices')
                                                    ->leftJoin('inv_payment_details', 'invoices.invoice_id', '=', 'inv_payment_details.inv_id')
                                                    ->where('invoices.user_id', InvoiceController::get_user_id(auth()->user()->id))
                                                    ->where('invoices.status', 3)
                                                    ->where('inv_payment_details.account_id', $a->ac_id)
                                                    ->sum('amount');

                                            $py_ac += $pyament_acc;
                                            
                                            $c_total +=$credit;

                                            $fc_total =($reAcPay + $c_total);

                                            $fd_total =($py_ac + $receivable_ac_ct);

                                        @endphp

                                        @if ($credit > 0 )
                                            <tr>
                                                <td class="text-primary">{{$a->ac_name.' ('. $a->ac_number.' )'}}</td>
                                                <td class="text-primary text-right">0</td>
                                                <td class="text-primary text-right">{{$credit}}</td>
                                                <td class="text-primary text-right">({{$credit}})</td>
                                            </tr>
                                        @endif

                                        @if ($pyament_acc > 0 )
                                            <tr>
                                                <td class="text-primary">{{$a->ac_name.' ('. $a->ac_number.' )'}}</td>
                                                <td class="text-primary text-right">{{$pyament_acc}}</td>
                                                <td class="text-primary text-right">0</td>
                                                <td class="text-primary text-right">{{$pyament_acc}}</td>
                                            </tr>
                                        @endif
                                        
                                    @endforeach
                                    <tr class="b_color">
                                        <td><b>Total</b></td>
                                        <td class="text-right"><b>{{$fd_total}}</b></td>
                                        <td class="text-right"><b>{{$fc_total}}</b></td>
                                        <td class="text-right"><b></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@push('script')
    <script>

        $(function() {
            $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
            $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
            $("#datepicker_due").datepicker({ dateFormat: 'yy-mm-dd' });
        });
    
        $(document).ready(function () {

            $(document).on('click', '.search', function() {

                var date_from = $(".date_from").val();
                var date_to = $(".date_to").val();

                $('.search_term').html("<b>General Ledger Summary </b>" + "( " + date_from + " to " + date_to + " )<div class='col-md-12'><br></div>");

                $('.search_res').html("<td colspan='4' class='text-center'><h1 class='text-primary p-2'><i class='fa fa-spinner fa-spin'></i></h1></td>");

                $.ajax({

                    url: "{{route('search.ledger')}}",

                    method: "GET",

                    data: {
                        dt_from: date_from,
                        dt_to: date_to
                    },

                    success: function(data) {

                        if (data == "1") {

                            $('.search_res').html("<tr><td colspan='8'>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</td></tr>");

                        } else {
                            $('.search_res').html(data);
                        }

                    }

                });

            });
        });
    
    </script>
@endpush