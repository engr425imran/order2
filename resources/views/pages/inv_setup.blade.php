@php
    use \App\Http\Controllers\ProductController; 
    // if (isset(($last_inv))) {
    //     if (isset($inv)) {
        
    //         if ($inv->inv_code > $last_inv->invoice_code) {
            
    //             $last_number = $inv->inv_code;
    //         } else {
    //             if ( is_numeric($last_inv->invoice_code) ) {
    //                 $inv_sum = $last_inv->invoice_code + 1;
    //                 $last_number = $inv->inv_name.$inv_sum;
    //             } else {

    //             }
    //         }
    //     }else {
    //         $last_number = $inv_sum;
    //     }
        
    // } else {
        
    //     // if (isset($inv)) {
    //     //     $one = 1;
    //     //     $last_number = $inv->inv_name.$one; 
    //     // } else {
    //     //     $last_number = 1;
    //     // }
        
    // }




    //***************************** Other code start *****************************//
        // if (is_numeric($item['quantity']) && is_numeric($product['price'])) {

        //     $sub_total += ($item['quantity'] * $product['price']);

        // } else {

        // // do some error handling...

        // }
    //***************************** Other code End *****************************//
    
@endphp

@extends('master')
@section('title')
    {{-- {{$title}} --}}
@endsection
@section('stylesheet')

<style>
       

        #template-container input[type="radio"] {
             display: none;
        }
         #template-container input[type="radio"]:not(:disabled) ~ label {
             cursor: pointer;
        }
         #template-container input[type="radio"]:disabled ~ label {
             color: rgba(188, 194, 191, 1);
             border-color: rgba(188, 194, 191, 1);
             box-shadow: none;
             cursor: not-allowed;
        }
         #template-container label {
             height: 100%;
             display: block;
             background: white;
             border: 2px solid rgb(10 141 225);
             border-radius: 20px;
             padding: 1rem;
             margin-bottom: 1rem;
             text-align: center;
             box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);
             position: relative;
        }
         #template-container input[type="radio"]:checked + label {
             background: rgb(10 141 225);
             color: rgba(255, 255, 255, 1);
             box-shadow: 0px 0px 8px rgba(10, 141, 225, 0.75);
        }
         #template-container input[type="radio"]:checked + label::after {
             color: rgba(61, 63, 67, 1);
             font-family: FontAwesome;
             border: 2px solid rgba(10, 141, 225, 1);
             content: "\f00c";
             font-size: 24px;
             position: absolute;
             top: -25px;
             left: 50%;
             transform: translateX(-50%);
             height: 50px;
             width: 50px;
             line-height: 50px;
             text-align: center;
             border-radius: 50%;
             background: white;
             box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25);
        }
         #template-container input[type="radio"]#control_05:checked + label {
             background: red;
             border-color: red;
        }
        
       
 
        
    </style>
    
@endsection
@section('content')


    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0"></h3>
            <div class="row breadcrumbs-top"></div>
        </div>
    </div>


    <section>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-header ">

                        <h4 class="card-title">Invoice setup</h4>


                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            
                    </div>

                    <div class="card-content">
                        <div class="card-body card-dashboard pt-0">

                            <form action="{{ route('updateinv') }}" method="POST">
                                @csrf


                                
                                <div class="form-group">
                                
                                    <label for="inv_name">Invoice Name</label>

                                    <input type="text" name="inv_name" class="form-control form-control-sm" value="{{($inv) ? $inv->inv_name : ''}}">

                                    <input type="hidden" name="inv_id" value="{{($inv) ? $inv->inv_id : ''}}">
                                </div>
                                
                                <div class="form-group">
                                
                                    <label for="inv_name">Next Invoice Id</label>

                                    <input type="text" name="inv_code" class="form-control form-control-sm invoice_number" value="{{$last_number}}" autocomplete="off">
                                    <span class="emsg hidden text-danger">Please Try another number</span>

                                </div>
                                <div class="form-group">
                                    <label for="inv_name">Default Account</label>
                                    <select name="ac_type" class="form-control form-control-sm catch_account return_sell_acc">
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
                                            <option @if(isset($inv) and $ac->ac_id == $inv->default_account_type) selected @endif value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                            @endforeach
                                        </optgroup>
                                            
                                        <optgroup label="Equity">

                                            @foreach ($ac_type_2 as $ac)
                                            <option @if(isset($inv) and $ac->ac_id == $inv->default_account_type) selected @endif value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                            @endforeach
                                        </optgroup>

                                                                                        
                                        <optgroup label="Liability">

                                            @foreach ($ac_type_5 as $ac)
                                            <option @if(isset($inv) and $ac->ac_id == $inv->default_account_type) selected @endif value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                            @endforeach
                                        </optgroup>
                                            
                                        <optgroup label="Assets">

                                            @foreach ($ac_type_4 as $ac)
                                            <option @if(isset($inv) and $ac->ac_id == $inv->default_account_type) selected @endif value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                            @endforeach
                                        </optgroup>
                                        
                                        <optgroup label="Expense">

                                            @foreach ($ac_type_3 as $ac)
                                            <option @if(isset($inv) and $ac->ac_id == $inv->default_account_type) selected @endif value="{{$ac->ac_id}}">{{$ac->ac_number}} - {{$ac->ac_name}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="inv_name">Default Tax Rate</label>
                                    <select name="tax_account" class="form-control form-control-sm notax addtax return_sell_tax">
                                        <option value="0"  selected>Select a tax</option>
                                        <option value="addNewTax" class="add_more">&#43; Add New Tax</option>
                                        
                                        @foreach ($tax_rates as $tax_rates1)
                                            <option @if(isset($inv) and ($tax_rates1->tax_amount.'__'.$tax_rates1->tax_id) == $inv->default_tax_rate) selected @endif value="{{ $tax_rates1->tax_amount.'__'.$tax_rates1->tax_id }}">
                                                {{ $tax_rates1->tax_name.' ('.$tax_rates1->tax_amount.' %)' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inv_name">Default Tax Rate</label>
                                    <textarea class="form-control" name="note" rows="3">{{ $inv->note }}</textarea>
                                </div>
                                <div class="form-group text-center">

                                
                                    <button
                                        class="btn btn-blue btn-sm is_apply"
                                        type="submit">Apply
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-8">
                <div class="card">
                    <div class="card-header ">

                        <h4 class="card-title"> Invoice Name </h4>

                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            
                    </div>

                    <div class="card-content">
                        <div class="card-body card-dashboard pt-0">

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="fs-11">
                                        <th class="cw-45">Invoice Name</th>
                                        <th class="cw-45">Next Invoice Id</th>
                                        <th class="text-right">Updated By</th>
                                        <th class="text-right">Date</th>
                                        <th class="text-right">Time</th>
                                    </tr>
                                </thead>

                                <tbody class="">

                                    <tr class="b_color">
                                        <td><b>{{($inv) ? $inv->inv_name : ''}}</b></td>
                                        <td>{{($inv) ? $inv->inv_name.$last_number : ''}}</td>
                                        <td class="text-right">{{($inv) ? $inv->name : ''}}</td>
                                        <td class="text-right">{{($inv) ? $inv->updated_date : ''}}</td>
                                        <td class="text-right">{{($inv) ? $inv->updated_time : ''}}</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header ">

                        <h4 class="card-title"> Invoice Template </h4>

                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            
                    </div>
                    <div class="card-content" id="template-container">
                        <div class="card-body card-dashboard pt-0">
                            <form action="{{ route('updateinv') }}" method="POST">
                                @csrf
                                    <input type="hidden" name="inv_id" value="{{($inv) ? $inv->inv_id : ''}}">
                                    <h5 class="mb-2">Select Template</h5>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-4">
                                              <input type="radio" id="control_01" name="template" value="1" {{($inv and $inv->template == 1) ? 'checked' : ''}} >
                                              <label for="control_01">
                                                <h2>Template 1</h2>
                                                <img src="{{ url('public/img/template-1.png') }}" width="200" height="150">
                                              </label>
                                            </div>
                                            <div class="col-md-4">
                                              <input type="radio" id="control_02" name="template" value="2" {{($inv and $inv->template == 2) ? 'checked' : ''}} >
                                              <label for="control_02">
                                                <h2>Template 2</h2>
                                                <img src="{{ url('public/img/template-2.png') }}" width="200" height="150">
                                              </label>
                                            </div>
                                            <div class="col-md-4">
                                              <input type="radio" id="control_03" name="template" value="3" {{($inv and $inv->template == 3) ? 'checked' : ''}} >
                                              <label for="control_03">
                                                <h2>Template 3</h2>
                                                <img src="{{ url('public/img/template-3.png') }}" width="200" height="150">
                                              </label>
                                            </div>
                                        </div>
                                    </section>
                                    <button
                                        class="btn btn-blue btn-sm is_apply mt-5"
                                        type="submit">Save
                                    </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                @foreach ($tax_rates as $item)
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
@endsection

@push('script')

<script>

    $(document).ready(function () {
        
        var val = $('.invoice_number').val();
        
        $.ajax({

            url:"{{route('catch.invNumber')}}",

            method:"GET",

            data:{
                val:val
            },

            success: function(data) 
            {
                // console.log(data);
                if ( data == '1' ) {
                        
                    $('.emsg').removeClass('hidden');
                    $('.emsg').show();
                    $('.invoice_number').addClass('invalid');
                    $('.is_apply').prop('disabled', true);
                    
                } else if ( data == '2') {
                
                    $('.emsg').addClass('hidden');
                    $('.invoice_number').removeClass('invalid');
                    $('.is_apply').prop('disabled', false);
                }        
            }

        });

        $(document).on("keyup", '.invoice_number', function() {

            var val = $(this).val();

            $.ajax({

                url:"{{route('catch.invNumber')}}",

                method:"GET",

                data:{
                    val:val
                },

                success: function(data) 
                {
                    // console.log(data);
                    if ( data == '1' ) {
                            
                        $('.emsg').removeClass('hidden');
                        $('.emsg').show();
                        $('.invoice_number').addClass('invalid');
                        $('.is_apply').prop('disabled', true);
                        
                    } else if ( data == '2') {
                    
                        $('.emsg').addClass('hidden');
                        $('.invoice_number').removeClass('invalid');
                        $('.is_apply').prop('disabled', false);
                    }        
                }

            });

        });




    });

    $(document).ready(function() {

        // This function only for input type integer
        $(".invoice_number").inputFilter(function(value) {
             // Allow digits only, using a RegExp
            return /^\d*$/.test(value);
        });

        $(document).on('change', '.addtax', function() {

            var add_tax = $(this).val();

            if (add_tax == 'addNewTax') {
                $('.add_tax_modal').modal();
            }
        });

        $(document).on('change', '.catch_account', function() {

            var add_acount = $(this).val();

            if (add_acount == 'addAcount') {
                $('.add_acc_modal').modal();
            }
        });

        //****************************** Some importent validation check jquery Start ******************************// 
        

            // // This function only for Integer >= 0
            // $("#uintTextBox").inputFilter(function(value) {
            //     return /^\d*$/.test(value); 
            // });

            // // This function only for Integer >= 0 and <= 500
            // $("#intLimitTextBox").inputFilter(function(value) {
            //     return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500); 
            // });


            // // This function only for Float (use . or , as decimal separator)
            // $("#floatTextBox").inputFilter(function(value) {
            //     return /^-?\d*[.,]?\d*$/.test(value); 
            // });

            // // This function only for Currency (at most two decimal places)
            // $("#currencyTextBox").inputFilter(function(value) {
            //     return /^-?\d*[.,]?\d{0,2}$/.test(value); 
            // });

            // // This function only for A-Z only
            // $("#latinTextBox").inputFilter(function(value) {
            //     return /^[a-z]*$/i.test(value); 
            // });


            // // This function Hexadecimal
            // $("#hexTextBox").inputFilter(function(value) {
            //     return /^[0-9a-f]*$/i.test(value); 
            // });

        //****************************** Some importent validation check jquery End *******************************// 
    });




    // Restricts input for the set of matched elements to the given inputFilter function.
    (function($) {
        $.fn.inputFilter = function(inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = '';
                }
            });
        };
    }(jQuery));

</script>
    
@endpush