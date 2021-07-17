@extends('master')
@section('title')
    {{$item_name}}
@endsection
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/datatables.min.css')}}">
    <!--<link rel="stylesheet" type="text/css" href="{{'public/css/buttons.dataTables.min.css'}}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{'public/css/buttons.bootstrap4.min.css'}}">-->
    <link href="{{asset('public/css/bootstrap-fileupload.css')}}" rel="stylesheet" />
    
    <style>

        .modal-body.bg {
            background-color: #FBFBFB;
        }

        #sizing-addon2 {
            padding: 5px;
        }

        .table th {
            font-weight: 400;
            width: 25%;
        }

        .table th, .table td {
            padding: 0.55rem 0rem;
            border-top: 1px solid #dbd7d7
        }
    
    </style>
@endsection
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{$item_name}}</h3>
            <div class="row breadcrumbs-top">
        
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <!--<a class="btn-icon btn btn-secondary btn-round" ><i class="ft-bell"></i> </a>-->
                {{-- <a href="#" class="btn-icon btn btn-secondary btn-round btn-success add_modal" data-toggle="modal" data-target="#xlarge"><i class="fa fa-product-hunt"></i> Add New</a> --}}
            </div>
        </div>
    </div>


    <section id="html5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$item_name}}</h4>
                        <P class="text-muted">{{$item_code}}</P>

                        {{-- <a href="#"  data-toggle="modal" data-target="#xlarge" ></a>   --}}
                        <button 
                            class="btn-icon btn btn-secondary btn-round btn-success edit_modal pull-right btn-sm" 
                            prduct_id="{{$p_info->product_id}}"
                            ><i class="fa fa-product-hunt"></i> Edit Item
                        </button>
                
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

                            @if ($p_info->p_unit_price !='')

                            <table id="" class="table p_details">
                                <p><b>Purchase</b></p>

                                <tr>
                                    <th>Unit Price</th>
                                    <td>{{ $p_info->p_unit_price }}</td>
                                </tr>
                                <tr>
                                    <th>Account</th>
                                    <td>{{($p_info->ac_name) ? $p_info->ac_name : ''}}</td>
                                </tr>
                                <tr>
                                    <th>Tax Rate</th>
                                    <td>{{ $p_info->tax_name . ' (' . $p_info->tax_amount . ' %)' }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{$p_info->p_description}}</td>
                                </tr>
                            </table>

                            @endif

                            @if ($p_info->s_unit_price !='' )
                                
                            

                            <table class="table">

                                <br>

                                <p><b>Sales</b></p>

                                <tr>
                                    <th>Unit Price</th>
                                    <td>{{ $p_info->s_unit_price }}</td>
                                </tr>
                                <tr>
                                    <th>Account</th>
                                    <td>{{($s_account->ac_name ? $s_account->ac_name : '')}}</td>
                                </tr>
                                <tr>
                                    <th>Tax Rate</th>
                                    <td>{{ $s_tax_rate->tax_name . ' (' . $s_tax_rate->tax_amount . ' %)'}}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{$p_info->s_description}}</td>
                                </tr>

                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Edit item --}}
    <div class="modal fade edit__modal" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header"> 
                    <h4 class="modal-title">Edit Item </h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('updatepro') }}" method="POST" enctype="multipart/form-data"> 

                    @csrf

                    
                    <div class="modal-body bg">

                        <span class="throw_pro"></span>
                       
                    </div>
                    

                    <div class="modal-footer">
                        <button class="btn btn-outline-success btn-sm" type="submit"> Save
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

                var prduct_id = $(this).attr('prduct_id');

                $.ajax({

                    url:"{{route('catchproinfo')}}",

                    method:"GET",

                    data:{prduct_id:prduct_id},

                    success: function(data)
                    {
                        $('.throw_pro').html(data);

                        var purchase_c = $(".purchase_c").val();
                        var sell_c = $(".sell_c").val();
                        var track_c = $(".track_c").val();
                        
                        if ( purchase_c == 0 ) {
                            $(".h_element_p").hide();
                        }
                        
                        if ( sell_c == 0 ) {
                            $(".h_element_s").hide();
                        }

                        if ( track_c == 0 ) {
                            $(".h_element_t").hide();
                        }

                        if ( track_c == 1 ) {
                            $(".purchase").prop("disabled", true);
                            $(".sell").prop("disabled", true);
                        }
                    }
                });
                
                $('.edit__modal').modal();
            });

            
            $(document).on('click', '.purchase',function() {
                if($(this).is(":checked")) {
                    $(".purchase").val(1);
                    $(".h_element_p").show(400);
                } else {
                    $(".purchase").val(0);
                    $(".h_element_p").hide(300);
                }
            });

            $(document).on('click', '.sell', function() {
                if($(this).is(":checked")) {
                    $(".sell").val(1);
                    $(".h_element_s").show(400);
                } else {
                    $(".sell").val(0);
                    $(".h_element_s").hide(300);
                }
            });

            // $(".h_element_t").hide();
            $(document).on('click', '.track', function() {
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
    
    </script>
@endpush
