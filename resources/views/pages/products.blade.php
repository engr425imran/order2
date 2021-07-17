@php use \App\Http\Controllers\ProductController; @endphp

@extends('master')
@section('title')
    {{$title}}
@endsection
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/datatables.min.css')}}">
    <link href="{{asset('public/css/bootstrap-fileupload.css')}}" rel="stylesheet" />
    
    <style>

        .modal-body.bg {
            background-color: #FBFBFB;
        }

        #sizing-addon2 {
            padding: 5px;
        }

        .table th {
            font-size: 13px;
        }
        .table td {
            font-size: 11px;
        }
        
    
    </style>
@endsection
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Product & Services</h3>
            <div class="row breadcrumbs-top">
        
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <!--<a class="btn-icon btn btn-secondary btn-round" ><i class="ft-bell"></i> </a>-->
                <a href="#" class="btn-icon btn btn-sm btn-secondary btn-round btn-success add_modal" data-toggle="modal" data-target="#xlarge"><i class="fa fa-product-hunt"></i> Add New</a>
            </div>
        </div>
    </div>

    <section id="html5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product List:</h4>
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
                        <div class="card-body card-dashboard">
                            <table id="datatable1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Item Code</th>
                                        <th style="width: 40%">Item Name</th>
                                        <th>Cost Price</th>
                                        <th>Sale Price</th>                                        
                                        <th>Quantity</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{$item->item_code}}</td>
                                            <td>{{$item->item_name}}</td>
                                            <td>{{$item->p_unit_price}}</td>
                                            <td>{{$item->s_unit_price}}</td>
                                            <td></td>
                                            <td>
                                                <button
                                                    type="button" 
                                                    class="btn btn-primary btn-sm btn-round" 
                                                    onclick="window.location='{{ url('/cubebooks/info-product/'.$item->product_id) }}'"
                                                >
                                                <i class="ft-eye"></i>

                                                </button>
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


    {{-- Add item --}}
    <div class="modal fade add__modal" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header"> 
                    <h4 class="modal-title">New Item </h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('savepro') }}" method="POST" enctype="multipart/form-data"> 

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
                                        <input type="checkbox" class="custom-control-input purchase" checked name="purchase" value="1" id="customCheck2">
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
                                            {{-- @foreach ($accounts as $item)
                                                <option value="{{$item->ac_id}}">{{$item->ac_number}} - {{$item->ac_name}}</option>
                                            @endforeach --}}
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

@endsection
@section('script')
    <script src="{{asset('public/dt/datatable/datatables.min.js')}}"></script>

    <!--<script src="{{'public/dt/datatable/buttons.bootstrap4.min.js'}}"></script>-->
    <script type="text/javascript" src="{{asset('public/js/bootstrap-fileupload.js')}}"></script>


    
@endsection 

@push('script')
    {{-- Product function --}}
    <script>
        $(document).ready(function () { 

            $(document).on('click', '.add_modal', function() {                


                $('.add__modal').modal();
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

            $(document).on('click', '.edit_modal', function() {

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
                
                $('.edit__modal').modal();
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
            
            $(".select2").select2();

            $("#datatable1").DataTable();
        });
    
    </script>
@endpush


