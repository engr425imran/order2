@extends('master')
@section('title')
    {{$title}}
@endsection
@section('stylesheet')
    <style>
        .width-20 {
            width: 25%;
        }
        .table tr td {
            font-size: 11px;
            line-height: 3;
        }
        .modal-md {
            max-width: 850px;
        }
        .btn.btn-icons {
            width: 30px;
            height: 30px;
            padding: 4px;
            text-align: center;
            vertical-align: top;
        }
        .hide{
            display: none;
        }
    </style>
@endsection
@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="card-title mb-0"><i class="fa fa-bank"></i> Banking </h6>
                {{-- <button type="button" class="btn btn-sm btn-success ml-auto" data-toggle="modal" data-target="#defaultModal">
                    <i class="mdi mdi-plus"></i>Add a Bank or Credit Card
                </button> --}}
            </div>


            <div class="d-flex justify-content-between align-items-center">
                {{-- <h6 class=" mb-0"> Bank or Credit Card </h6> --}}
                <div class="row col-md-8">
                
                    <div class="form-group col-md-10 row pr-0">
                        <label for="mobile" class="col-sm-3 pr-0 col-form-label">Bank or Credit Card</label>

                        <div class="input-group px-0 col-sm-4 banking">
                            
                            <select name="" class="form-control form-control-sm bank_account_select" id="">
                                <option value="">Select Bank or Credit Card</option>
                                {{-- <option value="">(Add New)</option> --}}
                                
                                @foreach ($bank_accounts as $item)

                                    <option value="{{$item->b_a_id}}" @if($bank_account_default->b_a_id == $item->b_a_id) selected @endif>{{$item->b_account_name}}</option>

                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-5 pr-0 pl-5">
                            <h3 class=" text-primary">R. 876543</h3>
                            <span> <sup> Bank Balance</sup></span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">

                    <div class="row ">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs tab-simple-styled" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-3-1" data-toggle="tab" href="#transaction" role="tab" aria-controls="transaction" aria-selected="true">
                                        <i class="mdi mdi-home-account"></i>New Transactions
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-3-2" data-toggle="tab" href="#reviewed" role="tab" aria-controls="profile-3-2" aria-selected="false"><i class="mdi mdi-star"></i>Reviewed Transactions
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content tab-content-basic">
                                <div class="tab-pane fade active show" id="transaction" role="tabpanel" aria-labelledby="tab-3-2">
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-secondary delete_selected" disabled>Delete</button>
                                        <button class="btn btn-sm btn-outline-success click_csv">Import Bank Statements</button>
                                    </div>

                                    <div class="mt-2 mb-2 csv_section hidden">
                                        <b>File Import Details</b>

                                        <form action="{{ route('savebankcsv') }}" class="mt-2" method="POST" enctype="multipart/form-data">

                                            @csrf
                                            
                                            <div class="col-md-6 px-0">
                                            
                                                <div class="form-group row mb-1">
                                                    <label for="amount" class="col-sm-3 col-form-label text-right">Import File Type </label>

                                                    <div class="input-group col-sm-5 px-0">

                                                        <select name="file_type" id="" class="form-control form-control-sm">
                                                            <option value="ofx">OFX</option>
                                                            <option value="csv">CSV</option>
                                                        </select>
                                                    </div>

                                                    
                                                    <div class="col-sm-4">
                                                        <a href="#" class="csv_doc">How do I set up a csv file?</a>
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group row mb-1">
                                                    <label for="" class="col-sm-3 col-form-label text-right">Bank or credit card </label>

                                                    <div class="input-group col-sm-5 px-0">

                                                        <select name="bank_account" class="form-control form-control-sm">
                                                            <option value="">Select Bank or Credit Card</option>
                                                            @foreach ($bank_accounts as $item)
                                                                <option value="{{$item->b_a_id}}" @if($bank_account_default->b_a_id == $item->b_a_id) selected @endif>{{$item->b_account_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="form-group row mb-1">
                                                    <label for="amount" class="col-sm-3 col-form-label text-right">Import File:</label>

                                                    <div class="input-group col-sm-5 px-0">
                                      
                                                        <input type="file" class="form-control form-control-sm" id="Name" placeholder="" name="csv_file" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-5 pl-0">
                                                        <button type="submit" class="btn btn-success btn-sm">Import File</button>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <form action="{{route('saveTransactions')}}" method="POST" class="form-save-newtrans">
                                        @csrf
                                        <input type="hidden" name="bank_account_id" value="{{$bank_account_default->b_a_id}}">
                                        <table class="new_transaction_table table table-bordered table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <fieldset>
                                                            <input type="checkbox" class="all_check">
                                                        </fieldset>
                                                    </th>
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th>Type</th>
                                                    <th>Selection</th>
                                                    <th>Reference</th>
                                                    <th>VAT</th>
                                                    <th>Spent</th>
                                                    <th>Received</th>
                                                    <th>Rec</th>
                                                    <th class="w-7">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if(count($new_transaction) > 0)
                                                    @foreach ($new_transaction as $transaction)
                                                    <tr class="content_data">
                                                        <td>
                                                            <fieldset>
                                                                <input type="hidden" name="trans_id[]" value="{{$transaction->bt_id}}">
                                                                <input type="checkbox" class="single_check" trans-id="{{$transaction->bt_id}}">
                                                            </fieldset>
                                                        </td>
                                                        <td class="px-2px" width="9%">
                                                            <div class="form-group form-group-sm my-0">
                                                                <input type="text" name="date[]" class="form-control form-control-sm date_field" value="{{date('Y-m-d', strtotime($transaction->date))}}">
                                                            </div>
                                                        </td>
                                                        <td class="px-2px" width="15%">
                                                            <div class="form-group form-group-sm my-0">
                                                                <input type="text" name="description[]" class="form-control form-control-sm" value="{{$transaction->description}}">
                                                            </div>
                                                        </td>
                                                        <td class="px-2px" width="10%"> 
                                                            <div class="form-group form-group-sm my-0">
                                                                <select name="type[]" class="form-control form-control-sm type_field" data-selection="{{$transaction->selection_id}}">
                                                                    <option value="">Select</option>
                                                                    <option value="account" @if($transaction->type == 'account') selected @endif>Account</option>
                                                                    <option value="customer" @if($transaction->type == 'customer') selected @endif>Customer</option>
                                                                    <option value="supplier" @if($transaction->type == 'supplier') selected @endif>Supplier</option>
                                                                    <option value="transfer" @if($transaction->type == 'transfer') selected @endif>Transfer</option>
                                                                    <option value="vat" @if($transaction->type == 'vat') selected @endif>VAT</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="px-2px" width="14%"> 
                                                            <div class="form-group form-group-sm my-0">
                                                                <select name="selection[]" class="form-control form-control-sm selection_field">
                                                                    <option value="">None</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="px-2px"> 
                                                            <div class="form-group form-group-sm my-0">
                                                                <input type="text" name="reference[]" class="form-control form-control-sm" value="{{$transaction->reference}}">
                                                            </div>
                                                        </td>
                                                        <td class="px-2px">
                                                            <div class="form-group form-group-sm my-0">
                                                                <div class="form-group form-group-sm my-0">
                                                                    <select name="vat[]" class="form-control form-control-sm">
                                                                        <option value="">Select</option>
                                                                        @foreach($vats as $vat)
                                                                        <option value="{{$vat->tax_id}}" amount="{{$vat->tax_amount}}" @if($transaction->vat==$vat->tax_id) selected @endif>{{$vat->tax_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-2px">
                                                            <div class="form-group form-group-sm my-0">
                                                                <input type="text" name="spent[]" class="form-control form-control-sm" value="{{$transaction->spent}}">
                                                            </div>
                                                        </td>
                                                        <td class="px-2px">
                                                            <div class="form-group form-group-sm my-0">
                                                                <input type="text" name="received[]" class="form-control form-control-sm" value="{{$transaction->received}}">
                                                            </div>
                                                        </td>
                                                        <td class="text-center px-2px">
                                                            <fieldset>
                                                                <input type="checkbox" name="reconcile[]" class="rec_checkbox" @if($transaction->reconcile == 1) checked @endif>
                                                            </fieldset>
                                                        </td>
                                                        <td class="text-right px_5" width="10%">
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-icons btn-rounded btn-secondary show_tx_details"
                                                                >
                                                                <i class="mdi mdi-arrow-down"></i>
                                                            </button>
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-icons btn-rounded btn-success manual_add"
                                                                >
                                                                <i class="mdi mdi-plus"></i>
                                                            </button>
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-icons btn-rounded btn-danger manual_delete"
                                                                data-id="{{$transaction->bt_id}}"
                                                                >
                                                                <i class="mdi mdi-trash-can"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr class="tx_details hide" tx-id="{{$transaction->bt_id}}">
                                                        @php 
                                                            $ex_amount = 0;
                                                            $vat_amount = 0;

                                                            if($transaction->spent > 0)
                                                                $ex_amount = $transaction->spent;
                                                            if($transaction->received > 0)
                                                                $ex_amount = $transaction->received;


                                                            if($transaction->tax_amount != null){
                                                                $vat_amount = ($transaction->tax_amount/100)*$ex_amount;
                                                                $ex_amount = $ex_amount-$vat_amount;
                                                            }
                                                        @endphp
                                                        <td></td>
                                                        <td colspan="100">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <strong>Transaction Details</strong>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col col-md-2 text-left" style="min-width: 105px">
                                                                    <b>Exclusive Amount</b>
                                                                </div>
                                                                <div class="col col-md-2" style="min-width: 105px">
                                                                    <b>VAT Amount</b>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col col-md-2 text-left" style="min-width: 105px">
                                                                    <input type="text" class="form-control form-control-sm tx-details-ex-amount" value="{{number_format($ex_amount,2, '.','')}}">
                                                                </div>
                                                                <div class="col col-md-2" style="min-width: 105px">
                                                                    <input type="text" class="form-control form-control-sm tx-details-vat" disabled value="{{number_format($vat_amount,2, '.','')}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                                <tr class="content_data content_data_empty">
                                                    <td>
                                                        <fieldset>
                                                            <input type="checkbox" class="single_check">
                                                        </fieldset>
                                                    </td>
                                                    <td class="px-2px" width="9%">
                                                        <div class="form-group form-group-sm my-0">
                                                            <input type="text" name="date[]" class="form-control form-control-sm date_field" value="{{date('Y-m-d', strtotime(now()))}}">
                                                        </div>
                                                    </td>
                                                    <td class="px-2px" width="15%">
                                                        <div class="form-group form-group-sm my-0">
                                                            <input type="text" name="description[]" class="form-control form-control-sm">
                                                        </div>
                                                    </td>
                                                    <td class="px-2px" width="10%"> 
                                                        <div class="form-group form-group-sm my-0">
                                                            <select name="type[]" class="form-control form-control-sm type_field">
                                                                <option value="">Select</option>
                                                                <option value="account">Account</option>
                                                                <option value="customer">Customer</option>
                                                                <option value="supplier">Supplier</option>
                                                                <option value="transfer">Transfer</option>
                                                                <option value="vat">VAT</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="px-2px" width="14%"> 
                                                        <div class="form-group form-group-sm my-0">
                                                            <select name="selection[]" class="form-control form-control-sm selection_field">
                                                                <option value="">None</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="px-2px"> 
                                                        <div class="form-group form-group-sm my-0">
                                                            <input type="text" name="reference[]" class="form-control form-control-sm">
                                                        </div>
                                                    </td>
                                                    <td class="px-2px">
                                                        <div class="form-group form-group-sm my-0">
                                                            <div class="form-group form-group-sm my-0">
                                                                <select name="vat[]" class="form-control form-control-sm">
                                                                    <option value="">Select</option>
                                                                    @foreach($vats as $vat)
                                                                        <option value="{{$vat->tax_id}}" amount="{{$vat->tax_amount}}">{{$vat->tax_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-2px">
                                                        <div class="form-group form-group-sm my-0">
                                                            <input type="text" name="spent[]" class="form-control form-control-sm">
                                                        </div>
                                                    </td>
                                                    <td class="px-2px">
                                                        <div class="form-group form-group-sm my-0">
                                                            <input type="text" name="received[]" class="form-control form-control-sm">
                                                        </div>
                                                    </td>
                                                    <td class="text-center px-2px">
                                                        <fieldset>
                                                            <input type="checkbox" name="reconcile[]" class="rec_checkbox">
                                                        </fieldset>
                                                    </td>
                                                    <td class="text-right px_5">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-icons btn-rounded btn-secondary show_tx_details"
                                                            >
                                                            <i class="mdi mdi-arrow-down"></i>
                                                        </button>
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-icons btn-rounded btn-success manual_add"
                                                            value="1"
                                                            >
                                                            <i class="mdi mdi-plus"></i>
                                                        </button>
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-icons btn-rounded btn-danger manual_delete"
                                                            value="1"
                                                            >
                                                            <i class="mdi mdi-trash-can"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr class="tx_details tx_details_empty hide">
                                                    <td></td>
                                                    <td colspan="100">
                                                        <div class="row">
                                                            <div class="col">
                                                                <strong>Transaction Details</strong>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col col-md-2 text-left" style="min-width: 105px">
                                                                <b>Exclusive Amount</b>
                                                            </div>
                                                            <div class="col col-md-2" style="min-width: 105px">
                                                                <b>VAT Amount</b>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col col-md-2 text-left" style="min-width: 105px">
                                                                <input type="text" class="form-control form-control-sm tx-details-ex-amount" value="">
                                                            </div>
                                                            <div class="col col-md-2" style="min-width: 105px">
                                                                <input type="text" class="form-control form-control-sm tx-details-vat" value="" disabled>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-sm btn-primary">Save Now</button>
                                            <button type="button" class="btn btn-sm btn-secondary mark_reviewed_selected">Mark selected as Reviewed</button>
                                            <button type="button" class="btn btn-sm btn-secondary mark_reviewed_all">Mark all as Reviewed</button>
                                        </div>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="reviewed" role="tabpanel" aria-labelledby="tab-3-3">
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-secondary delete_selected" disabled>Delete</button>
                                    </div>
                                    <form action="{{route('saveTransactions')}}" method="POST" class="form-save-reviewedtrans">
                                        @csrf
                                        <input type="hidden" name="bank_account_id" value="{{$bank_account_default->b_a_id}}">
                                        <table class="reviewed_transaction_table table table-bordered table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <fieldset>
                                                            <input type="checkbox" class="all_check">
                                                        </fieldset>
                                                    </th>
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th>Type</th>
                                                    <th>Selection</th>
                                                    <th>Reference</th>
                                                    <th>VAT</th>
                                                    <th>Spent</th>
                                                    <th>Received</th>
                                                    <th>Rec</th>
                                                    <th class="w-7">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if(count($reviewed_transaction) > 0)
                                                    @foreach ($reviewed_transaction as $transaction)
                                                    <tr class="content_data">
                                                        <td>
                                                            <fieldset>
                                                                <input type="hidden" name="trans_id[]" value="{{$transaction->bt_id}}">
                                                                <input type="checkbox" class="single_check" trans-id="{{$transaction->bt_id}}">
                                                            </fieldset>
                                                        </td>
                                                        <td class="px-2px" width="9%">
                                                            <div class="form-group form-group-sm my-0">
                                                                <input type="text" name="date[]" class="form-control form-control-sm date_field" value="{{date('Y-m-d', strtotime($transaction->date))}}">
                                                            </div>
                                                        </td>
                                                        <td class="px-2px" width="15%">
                                                            <div class="form-group form-group-sm my-0">
                                                                <input type="text" name="description[]" class="form-control form-control-sm" value="{{$transaction->description}}">
                                                            </div>
                                                        </td>
                                                        <td class="px-2px" width="10%"> 
                                                            <div class="form-group form-group-sm my-0">
                                                                <select name="type[]" class="form-control form-control-sm type_field" data-selection="{{$transaction->selection_id}}">
                                                                    <option value="">Select</option>
                                                                    <option value="account" @if($transaction->type == 'account') selected @endif>Account</option>
                                                                    <option value="customer" @if($transaction->type == 'customer') selected @endif>Customer</option>
                                                                    <option value="supplier" @if($transaction->type == 'supplier') selected @endif>Supplier</option>
                                                                    <option value="transfer" @if($transaction->type == 'transfer') selected @endif>Transfer</option>
                                                                    <option value="vat" @if($transaction->type == 'vat') selected @endif>VAT</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="px-2px" width="14%"> 
                                                            <div class="form-group form-group-sm my-0">
                                                                <select name="selection[]" class="form-control form-control-sm selection_field">
                                                                    <option value="">None</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="px-2px"> 
                                                            <div class="form-group form-group-sm my-0">
                                                                <input type="text" name="reference[]" class="form-control form-control-sm" value="{{$transaction->reference}}">
                                                            </div>
                                                        </td>
                                                        <td class="px-2px">
                                                            <div class="form-group form-group-sm my-0">
                                                                <div class="form-group form-group-sm my-0">
                                                                    <select name="vat[]" class="form-control form-control-sm">
                                                                        <option value="">Select</option>
                                                                        @foreach($vats as $vat)
                                                                        <option value="{{$vat->tax_id}}" amount="{{$vat->tax_amount}}" @if($transaction->vat==$vat->tax_id) selected @endif>{{$vat->tax_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-2px">
                                                            <div class="form-group form-group-sm my-0">
                                                                <input type="text" name="spent[]" class="form-control form-control-sm" value="{{$transaction->spent}}">
                                                            </div>
                                                        </td>
                                                        <td class="px-2px">
                                                            <div class="form-group form-group-sm my-0">
                                                                <input type="text" name="received[]" class="form-control form-control-sm" value="{{$transaction->received}}">
                                                            </div>
                                                        </td>
                                                        <td class="text-center px-2px">
                                                            <fieldset>
                                                                <input type="checkbox" name="reconcile[]" class="rec_checkbox" @if($transaction->reconcile == 1) checked @endif>
                                                            </fieldset>
                                                        </td>
                                                        <td class="text-right px_5">
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-icons btn-rounded btn-secondary show_tx_details"
                                                                >
                                                                <i class="mdi mdi-arrow-down"></i>
                                                            </button>
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-icons btn-rounded btn-danger manual_delete"
                                                                data-id="{{$transaction->bt_id}}"
                                                                >
                                                                <i class="mdi mdi-trash-can"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr class="tx_details hide" tx-id="{{$transaction->bt_id}}">
                                                        @php 
                                                            $ex_amount = 0;
                                                            $vat_amount = 0;

                                                            if($transaction->spent > 0)
                                                                $ex_amount = $transaction->spent;
                                                            if($transaction->received > 0)
                                                                $ex_amount = $transaction->received;


                                                            if($transaction->tax_amount != null){
                                                                $vat_amount = ($transaction->tax_amount/100)*$ex_amount;
                                                                $ex_amount = $ex_amount-$vat_amount;
                                                            }
                                                        @endphp
                                                        <td></td>
                                                        <td colspan="100">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <strong>Transaction Details</strong>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col col-md-2 text-left" style="min-width: 105px">
                                                                    <b>Exclusive Amount</b>
                                                                </div>
                                                                <div class="col col-md-2" style="min-width: 105px">
                                                                    <b>VAT Amount</b>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col col-md-2 text-left" style="min-width: 105px">
                                                                    <input type="text" class="form-control form-control-sm tx-details-ex-amount" value="{{number_format($ex_amount,2, '.','')}}">
                                                                </div>
                                                                <div class="col col-md-2" style="min-width: 105px">
                                                                    <input type="text" class="form-control form-control-sm tx-details-vat" disabled value="{{number_format($vat_amount,2, '.','')}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>

                                    
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-sm btn-primary">Save Now</button>
                                            <button type="button" class="btn btn-sm btn-secondary mark_unreviewed_selected">Mark selected as Unreviewed</button>
                                            <button type="button" class="btn btn-sm btn-secondary mark_unreviewed_all">Mark all as Unreviewed</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>   
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Import Bank Statement File Help --}}
    <div class="csv_doc_modal modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Bank Statement File Help</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class=" text-danger">×</span>
                    </button>
                </div>


                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <p>Once you have downloaded your bank statement as a CSV file, open this file in Excel. Please make sure each column in your spreadsheet represents a single field (for example "Date"), and that each row represents a single record.</p>
                        </div>
                        <div class="col-md-12 mt-3">
                            <p>Rearrange the order of the columns in your source Excel file to match the following order. The names of your columns have to match those listed here.</p>

                            <ul class="list-star">
                                <li>Date (Your dates need to be formatted as either dd/mm/yyyy, mm/dd/yyyy or yyyy/mm/dd. Make sure that you select the correct Date Format used in your CSV file when importing your file)</li>
                                <li>Amount (Negative values will be imported as spent transactions. Positive values will be imported as received transactions)</li>
                                <li>Balance (Negative values will be imported as spent transactions. Positive values will be imported as received transactions)</li>
                                <li>Description (This is the description on your bank statement)</li>
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-sm btn-primary view_example">View an example</button>
                        </div>

                        <div class="col-md-12 mt-2">
                            <p>Follow these steps:</p>

                            <ul class="list-arrow">
                                <li>Select File; Save As.</li>
                                <li>Select a location for your file, give it a file name, and set Save as type to "CSV (Comma delimited)".</li>
                                <li>Click Save.</li>
                            </ul>

                            <p class="">If you receive a message warning that the file may contain features not compatible with CSV, click Yes to continue saving.</p>

                            <p class="mt-2"> Finally: Import your statement to Accounting </p>
                                
                            <p>From the Import Bank Statements screen in Accounting, click Choose File. Locate the file CSV file and click Open.</p>
                            <p> Click Import File </p>
                            
                        </div>
                    </div>

                    <div></div>
                        
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning btn-sm" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    {{-- CSV Import Example --}}
    <div class="view_example_modal modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CSV Import Example</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class=" text-danger">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>The CSV file should only have 4 columns: Date, Amount, Balance and Description. The first line must contain the column headings Date, Amount, Balance and Description. If any space start of theses name (like Date, Amount, Balance, Description) then clean those space, if you leave those empty space then your csv file not save. The rest of the lines will contain each bank statement line.</p>


                            <table style="width: 514px">
                                <tbody>
                                    <tr>
                                        <td class="style4">
                                            <b>Date</b>
                                        </td>
                                        <td class="style5">
                                            <b style="text-align: right">Amount</b>
                                        </td>
                                        <td class="style5">
                                            <b style="text-align: right">Balance</b>
                                        </td>
                                        <td class="style1">
                                            <b>Description</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="style4">
                                            <span>10/02/2012</span>
                                        </td>
                                        <td class="style5">
                                            <span style="text-align: right">-5235.94</span>
                                        </td>
                                        <td class="style5">
                                            <span style="text-align: right">9876543</span>
                                        </td>
                                        <td class="style1">
                                            Accounting Fees
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="style4">
                                            <span>12/02/2012</span>
                                        </td>
                                        <td class="style5">
                                            <span style="text-align: right">2000.21</span>
                                        </td>
                                        <td class="style5">
                                            <span style="text-align: right">876.54</span>
                                        </td>
                                        <td class="style1">
                                            Consulting Income
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="style4">
                                            <span>14/02/2012</span>
                                        </td>
                                        <td class="style5">
                                            <span style="text-align: right">-47.89</span>
                                        </td>
                                        <td class="style5">
                                            <span style="text-align: right">547.78</span>
                                        </td>
                                        <td class="style1">
                                            Bank Charges
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="style4">
                                            <span>16/02/2012</span>
                                        </td>
                                        <td class="style5">
                                            <span style="text-align: right">906.29</span>
                                        </td>
                                        <td class="style5">
                                            <span style="text-align: right">8906.29</span>
                                        </td>
                                        <td class="style1">
                                            Training Income
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div></div>
                        
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning btn-sm" data-dismiss="modal">Close</button>
                </div>


            </div>
        </div>

    </div> 
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            let form_new_trans = $('.form-save-newtrans').serialize();
            let form_new_reviewedtrans = $('.form-save-reviewedtrans').serialize();
            
            var content_data = $('.content_data_empty').html();
            var tx_details_empty = $('.tx_details_empty').html();

            $(document).on('click', '.show_tx_details', function(){
                let close_content_data = $(this).closest('.content_data');
                let tx_details = close_content_data.next('.tx_details');

                if(tx_details.hasClass('hide')){
                    tx_details.removeClass('hide');
                }else{
                    tx_details.addClass('hide');
                }    
            });
            $(document).on('change', 'select[name="vat[]"]', function(){

                let close_content_data = $(this).closest('.content_data');
                let amount = 0;

                if(close_content_data.find('input[name="spent[]"]').val() > 0){
                    amount = close_content_data.find('input[name="spent[]"]').val();
                }
                if(close_content_data.find('input[name="received[]"]').val() > 0){
                    amount = close_content_data.find('input[name="received[]"]').val();
                }
                let vat = $(this).find('option:selected').attr('amount');

                if(!vat > 0) vat = 0;
                
                let vat_amount = (vat/100)*amount;
                let ex_amount = amount - vat_amount;

                close_content_data.next('.tx_details').find('.tx-details-ex-amount').val(ex_amount.toFixed(2))
                close_content_data.next('.tx_details').find('.tx-details-vat').val(vat_amount.toFixed(2))
            });
            $(document).on('keypress keyup', 'input[name="spent[]"]', function(e){
                let close_content_data = $(this).closest('.content_data');
                let vat = close_content_data.find('select[name="vat[]"] option:selected').attr('amount');

                if(!vat > 0) vat = 0;

                let vat_amount = (vat/100)*this.value;
                let ex_amount = this.value - vat_amount;

                close_content_data.find('input[name="received[]"]').val('');
                
                close_content_data.next('.tx_details').find('.tx-details-ex-amount').val(ex_amount.toFixed(2))
                close_content_data.next('.tx_details').find('.tx-details-vat').val(vat_amount.toFixed(2))

            });
            $(document).on('keypress keyup', 'input[name="received[]"]', function(){
                let close_content_data = $(this).closest('.content_data');
                let vat = close_content_data.find('select[name="vat[]"] option:selected').attr('amount');

                if(!vat > 0) vat = 0;

                let vat_amount = (vat/100)*this.value;
                let ex_amount = this.value - vat_amount;
                
                if(this.value > 0){
                    close_content_data.find('input[name="spent[]"]').val('');
                    close_content_data.next('.tx_details').find('.tx-details-ex-amount').val(ex_amount.toFixed(2))
                    close_content_data.next('.tx_details').find('.tx-details-vat').val(vat_amount.toFixed(2))
                }
                
            });
            $(document).on('keyup','.tx-details-ex-amount', function(){
                let close_content_data = $(this).closest('.tx_details').prev();
                let spent = close_content_data.find('input[name="spent[]"]');
                let received = close_content_data.find('input[name="received[]"]');
                
                if(spent.val() > 0){
                    spent.val(this.value);
                }

                if(received.val() > 0){
                    received.val(this.value);
                }
            });
            $(document).on('click', '.delete_selected', function(){
                let trans_ids = [];
                let count = 0;
                $.each($('input.single_check'), function(index, item){
                    if($(item).is(':checked')){
                        let trans_id = $(item).attr('trans-id');
                        if(trans_id != undefined){
                            trans_ids.push(trans_id);
                            count++;
                        }
                        
                    }
                });

                Swal.fire({
                    title: 'Are you sure you want to continue?',
                    text: `You are about to delete ${count} transaction(s)`,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {                
                    if(result.value){
                        $.ajax({
                            url: "{{route('deleteManyBankTransaction')}}",
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                trans_ids
                            },
                            success: function(resp){
                                if(resp.success){
                                    $.each($('input.single_check'), function(index, item){
                                        if($(item).is(':checked')){
                                            let trans_id = $(item).attr('trans-id');
                                            if(trans_id != undefined){
                                                $(item).closest('.content_data').remove();
                                            }
                                            
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            });
            $(document).on('change', '.bank_account_select', function(){
                window.location.href = "?bank_id="+this.value;
            });

            $(document).on('click', '.mark_reviewed_selected', function(){
                if($('.form-save-newtrans') !== form_new_trans){
                    $.ajax({
                        url: $('.form-save-newtrans').attr('action'),
                        type: 'POST',
                        data: $('.form-save-newtrans').serialize()
                    });
                }

                let trans_ids = [];
                $.each($('input.single_check'), function(index, item){
                    if($(item).is(':checked')){
                        let trans_id = $(item).attr('trans-id');
                        if(trans_id != undefined){
                            trans_ids.push(trans_id);
                            
                        }
                        
                    }
                });

                $.ajax({
                    url: "{{route('reviewedSelectedTransactions')}}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        trans_ids
                    },
                    success: function(resp){
                        if(resp.success){
                            location.reload();
                        }
                    }
                });
                
            });
            $(document).on('click', '.mark_reviewed_all', function(){

                if($('.form-save-newtrans') !== form_new_trans){
                    $.ajax({
                        url: $('.form-save-newtrans').attr('action'),
                        type: 'POST',
                        data: $('.form-save-newtrans').serialize()
                    });
                }


                let bank_account_id = $('.bank_account_select').val();

                $.ajax({
                    url: "{{route('reviewedAllTransactions')}}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        bank_account_id
                    },
                    success: function(resp){
                        if(resp.success){
                            location.reload();
                        }
                    }
                });

            });

            $(document).on('click', '.mark_unreviewed_selected', function(){
                if($('.form-save-reviewedtrans') !== form_new_reviewedtrans){
                    $.ajax({
                        url: $('.form-save-reviewedtrans').attr('action'),
                        type: 'POST',
                        data: $('.form-save-reviewedtrans').serialize()
                    });
                }

                let trans_ids = [];
                
                $.each($('input.single_check'), function(index, item){
                    if($(item).is(':checked')){
                        let trans_id = $(item).attr('trans-id');
                        if(trans_id != undefined){
                            trans_ids.push(trans_id);
                            
                        }
                        
                    }
                });

                $.ajax({
                    url: "{{route('unreviewedSelectedTransactions')}}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        trans_ids
                    },
                    success: function(resp){
                        if(resp.success){
                            location.reload();
                        }
                    }
                });
                
            });
            $(document).on('click', '.mark_unreviewed_all', function(){
                if($('.form-save-reviewedtrans') !== form_new_reviewedtrans){
                    $.ajax({
                        url: $('.form-save-reviewedtrans').attr('action'),
                        type: 'POST',
                        data: $('.form-save-reviewedtrans').serialize()
                    });
                }

                let bank_account_id = $('.bank_account_select').val();

                $.ajax({
                    url: "{{route('unreviewedAllTransactions')}}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        bank_account_id
                    },
                    success: function(resp){
                        if(resp.success){
                            location.reload();
                        }
                    }
                });

            });

            $(document).on('click', '.single_check', function(){
                let count = 0;
                $.each($('input.single_check'), function(index, item){
                    let trans_id = $(item).attr('trans-id');
                    if($(item).is(":checked") && trans_id != undefined){
                        count++;
                    }
                });
                if(count > 0){
                    $('.delete_selected').prop('disabled', false);
                }else{
                    $('.delete_selected').prop('disabled', true);
                }
            });

            $(document).on('change', '.all_check',function(){
                if($(this).is(":checked")){
                    $(this).closest('table').find('.single_check').prop('checked', true);
                    $('.delete_selected').prop('disabled', false);
                }else{
                    $(this).closest('table').find('.single_check').prop('checked', false);
                    $('.delete_selected').prop('disabled', true);
                }
            });

            $.each($('.type_field'), async function(index, field){
                let value = this.value;
                let selection_id = $(this).data('selection');
                
                
                
                if(selection_id != undefined && selection_id != ""){
                    
                    let selectionField = $(this).closest('.content_data').find('.selection_field');
                    const selections = await $.ajax({
                    url: "{{route('bank_transaction_selection')}}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        type: value
                    }
                    });

                    if(selections.length != 0){
                        if(selections.grouped){
                            let group_options;

                            $.each(selections, function(index, group){
                                let option;

                                $.each(group.selections, function(i, opt){
                                    if(selection_id == opt.id){option += `<option value="${opt.id}" selected>${opt.name}</option>`;}
                                    else{option += `<option value="${opt.id}">${opt.name}</option>`;}
                                });
                                group_options += `
                                    <optgroup label="${group.name}">
                                        ${option}
                                    </optgroup>
                                `;
                            });
                            
                            selectionField.empty().append(group_options);
                        }else{
                            let options;
                            $.each(selections.options, function(index, opt){
                                if(selection_id==opt.id){options += `<option value="${opt.id}" selected>${opt.name}</option>`;}
                                else{options += `<option value="${opt.id}">${opt.name}</option>`;}
                            });
                            
                            selectionField.empty().append(options);
                        }
                    }else{
                        selectionField.empty().append('<option>None</option');
                    }
                }
            });
            $(document).on('change', '.type_field', async function(){
                let value = this.value;
                let selectionField = $(this).closest('.content_data').find('.selection_field');
                
                const selections = await $.ajax({
                   url: "{{route('bank_transaction_selection')}}",
                   type: 'POST',
                   data: {
                       _token: $('meta[name="csrf-token"]').attr('content'),
                       type: value
                   }
                });
                
                if(selections.length != 0){
                    if(selections.grouped){
                        let group_options;

                        $.each(selections, function(index, group){
                            let option;

                            $.each(group.selections, function(i, opt){
                                option += `<option value="${opt.id}">${opt.name}</option>`;
                            });
                            group_options += `
                                <optgroup label="${group.name}">
                                    ${option}
                                </optgroup>
                            `;
                        });
                        
                        selectionField.empty().append(group_options);
                    }else{
                        let options;
                        $.each(selections.options, function(index, opt){
                            options += `<option value="${opt.id}">${opt.name}</option>`;
                        });
                        
                        selectionField.empty().append(options);
                    }
                }else{
                    selectionField.empty().append('<option>None</option');
                }
                
                    
                
            });


            $(document).on('change', '.search', function() {

                var bank_id = $(this).val();


                $('.search_res').html("<td colspan='8' class='text-center'><h1 class='text-primary p-2'><i class='fa fa-spinner fa-spin'></i></h1></td>");

                $.ajax({

                    url: "{{route('searchBankTransaction')}}",

                    method: "GET",

                    data: {
                        bank_id: bank_id
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

            $(document).on('click', '.click_csv', function() {

                var $this = $('.csv_section');

                if ($this.hasClass('hidden')) {

                    $this.removeClass('hidden');

                } else {
                    $this.addClass('hidden');
                }
            });

            $(document).on('click', '.csv_doc', function() {

                $('.csv_doc_modal').modal();
            });

            $(document).on('click', '.view_example', function() {

                $('.view_example_modal').modal();
            });

            
            //$(".new_transaction_table,.reviewed_transaction_table").DataTable();
            
            $('.table').on('click', '.delete', function() {
                
                var this_data = $(this);
                var bank_id = $(this).val();
                    
                $.confirm({
                    
                    icon: 'fa fa-frown-o',
                    theme: 'modern',
                    closeIcon: true,
                    animation: 'scale',
                    type: 'red',
                    autoClose: 'cancel|10000',
                    escapeKey: 'cancel',
                    title: 'are you sure!',
                    content: 'If you delete this then it\'s not return!',
                    
                    buttons: {
                    
                        Delete: {
                    
                            btnClass: 'btn-red',
                        
                            action: function() {
                        
                                $.ajax({
                        
                                    url:"{{route('deleteBankTransaction')}}",
                                    
                                    method:"GET",
                                    
                                    data:{bank_id:bank_id},
                                    
                                    success: function(data) {
                        
                                        if(data == "1"){    
                                        
                                            this_data.parent().parent().fadeOut();
                                            success();
                                        
                                        } else {
                                        
                                            error();
                                        
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

            $(document).on('click', '.manual_add', function () {
                
                $('<tr class="tx_details hide">' + tx_details_empty + '</tr>').insertAfter($(this).closest('.content_data').next());
                $('<tr class="content_data">' + content_data + '</tr>').hide().insertAfter($(this).closest('.content_data').next()).fadeIn(600);
                setDatePicker();
            });


            $(document).on('click', '.manual_delete', function () {
                let trans_id = $(this).data('id');
                let content_data = $(this).closest('.content_data');
                let tx_details = content_data.next('.tx_details');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {                
                    if(result.value){
                        if(trans_id == undefined || trans_id == ''){
                            content_data.remove();
                            tx_details.remove();
                        }else{
                            //do ajax delete here
                            content_data.remove();
                            tx_details.remove();
                            $.ajax({
                                url: "{{route('deleteBankTransaction')}}",
                                type: 'POST',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    trans_id
                                }
                            })
                        }
                    }
                })
            });

            $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });

            $('.date_field').each(function (){
                $(this).datepicker({ dateFormat: 'yy-mm-dd' });
            });

        });
        
        function setDatePicker () {
            $('.manual_date').each(function (){
                $(this).datepicker({ dateFormat: 'yy-mm-dd' });
            });
        }

        function success () {

            toastr["success"]("Account Information Delete Successfully!")

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

            toastr["error"]("Sorry, Your request not match in our record.")

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