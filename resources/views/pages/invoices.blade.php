@php
    use \App\Http\Controllers\InvoiceController;

    $invName = $inv->inv_name;
@endphp

@extends('master')
@section('title')
    {{$title}}
@endsection
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/datatables.min.css')}}">
    <link href="{{asset('public/css/bootstrap-fileupload.css')}}" rel="stylesheet" />
    
@endsection
@section('content')

    <style>
        .rdonly{
            background-color: #ffffff;
        }
        
        .modal.left .modal-dialog {
            position: fixed;
            margin: auto;
            /*width: 320px;*/
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal.left .modal-content {
            height: 100%;
            overflow-y: auto;
            width: 500px;
        }

        .modal.left .modal-body {
            padding: 15px 15px 80px;
        }

        .modal.left.fade .modal-dialog {
            right: -320px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }

        .modal.left.fade.show .modal-dialog {
            right: 0;
        }

        /* ----- MODAL STYLE ----- */
        .modal-content {
            border-radius: 0;
            border: none;
        }

        .modal-header {
            border-bottom-color: #eeeeee;
            background-color: #fafafa;
        }
        .modal.left.fade.show {
            z-index: 99999999999999;
            background-color: rgba(0, 0, 0, 0.7098039215686275);
        }


        /*.modal-content {
            width: 100vw;
        }*/
        .modal-dialog.modal-xl {
            margin: 0px!Important;
            padding: 0px!important;
            width: 100%;
        }
        .table td {
            font-size: 11px;
        }
        
        .table th {
            font-size: 13px;
        }
    </style>

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Invoice List</h3>
            <div class="row breadcrumbs-top">       
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <a href="{{ route('add.invoice') }}" class="btn-icon btn btn-secondary btn-round btn-success"><i class="fa fa-product-hunt"></i> Add New</a>
            </div>
        </div>
    </div>

    @php 
        $get_inv_1 = InvoiceController::get_invoice(1);
        $get_inv_2 = InvoiceController::get_invoice(2);
        $get_inv_3 = InvoiceController::get_invoice(3);

        $invoice_paid_count = 0;
        foreach($get_inv_3 as $invoice){
            $paid = DB::table('inv_payment_details')->where('inv_id', $invoice->invoice_id)->sum('amount');
            if($invoice->final_total - $paid == 0){
                $invoice_paid_count++;
            }
        }
        

    @endphp


    <section id="html5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">Invoice List:</h4>

                        <ul class="nav mt-3 mb-3 nav nav-pills nav-pills-cust nav-pills-icons" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" href="#all" role="tablist" data-toggle="tab"><i class="fa fa-money" aria-hidden="true"></i>All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#draft" role="tab" data-toggle="tab"><i class="fa fa-money" aria-hidden="true"></i>Draft ({{count($get_inv_1)}})</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#a_approval" role="tablist" data-toggle="tab"><i class="fa fa-money" aria-hidden="true"></i>Awaiting Approval ({{count($get_inv_2)}})</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#a_payment" role="tab" data-toggle="tab"><i class="fa fa-money" aria-hidden="true"></i>Awaiting Payment ({{count($get_inv_3) - $invoice_paid_count }})</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#paid" role="tab" data-toggle="tab"><i class="fa fa-money" aria-hidden="true"></i>Paid ({{ $invoice_paid_count }})</a>
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
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard pt-0">
                            <div class="tab-content clearfix">
                                <button class="btn btn-outline-success btn-collect d-none">Collect</button>
                                <div role="tabpanel" id="all" class="tab-pane active show col-xl-12 col-lg-12 px-0">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="check_all" id="check_all_checkbox">
                                                        <label class="custom-control-label" for="check_all_checkbox"></label>
                                                    </div>
                                                </th>
                                                <th>Invoice</th>
                                                <th>Ref</th>
                                                <th>To</th>
                                                <th>Date</th>
                                                <th>Due Date</th>
                                                <th>Due</th>
                                                <th>Paid</th>
                                                <th>Invoice Status</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $counter = 0; @endphp
                                            @foreach ($invoices as $item)
                                                @php
                                                    $paid = DB::table('inv_payment_details')->where('inv_id', $item->invoice_id)->sum('amount');

                                                    $due = ($item->final_total - $paid);

                                                    $counter++;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="checkboxes" id="checkbox_invoice_{{ $counter }}"  data-id="{{ $item->invoice_id }}">
                                                            <label class="custom-control-label" for="checkbox_invoice_{{ $counter }}"></label>
                                                        </div>
                                                    </td>
                                                    <td>{{$invName.$item->invoice_code}}</td>
                                                    <td>{{$item->reference}}</td>
                                                    <td>{{$item->display_name}}</td>
                                                    <td>{{$item->invoice_date}}</td>
                                                    <td>{{$item->due_date}}</td>
                                                    <td>{{$due}}</td>
                                                    <td>{{$paid}}</td>
                                                    <td>
                                                        @if($item->invoice_status == 'Printed')
                                                            <span class="badge badge-primary">{{$item->invoice_status}}</span>
                                                        @elseif($item->invoice_status == 'Opened')
                                                            <span class="badge badge-success">{{$item->invoice_status}}</span>
                                                        @elseif($item->invoice_status == 'Sent')
                                                            <span class="badge badge-info">{{$item->invoice_status}}</span>
                                                        @endif
                                                    </td>
                                                    <td>

                                                        @if ($due==0)
                                                            <span class="badge badge-pill badge-success">Paid</span>
                                                        @elseif ($item->status == 1)
                                                            <span class="badge badge-pill badge-secondary">Draft</span>
                                                        @elseif ($item->status == 2)
                                                            <span class="badge badge-pill badge-warning">Awaiting Approval</span>
                                                        @else 
                                                            <span class="badge badge-pill badge-danger">Awaiting Payment</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if ($item->status == 1 || $item->status == 2)
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-primary btn-sm btn-round"
                                                                onclick="window.location='{{ url('/cubebooks/edit-invoice/'.$item->invoice_id) }}'"
                                                                >
                                                                <i class="ft-edit-2"></i>                                                
                                                            </button>
                                                        @endif

                                                        @if ($item->status == 3)
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-warning btn-sm btn-round"
                                                                onclick="window.location='{{ url('/cubebooks/view-invoice/'.$item->invoice_id) }}'"
                                                                >
                                                                <i class="feather icon-eye"></i>                                                
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                
                                <div role="tabpanel" id="draft" class="tab-pane col-xl-12 col-lg-12 px-0">
                                    <table id="datatable2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Invoice</th>
                                                <th>To</th>
                                                <th>Date</th>
                                                <th>Due Date</th>
                                                <th>Due</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($get_inv_1 as $item)
                                                @php
                                                    $paid = DB::table('inv_payment_details')->where('inv_id', $item->invoice_id)->sum('amount');

                                                    $due = ($item->final_total - $paid);
                                                @endphp
                                                <tr>
                                                    <td>{{$invName.$item->invoice_code}}</td>
                                                    <td>{{$item->display_name}}</td>
                                                    <td>{{$item->invoice_date}}</td>
                                                    <td>{{$item->due_date}}</td>
                                                    <td>{{$due}}</td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <span class="badge badge-pill badge-secondary">Draft</span>
                                                        @endif
                                                        @if ($item->status == 2)
                                                            <span class="badge badge-pill badge-warning">Awaiting Approval</span>
                                                        @endif
                                                        @if ($item->status == 3)
                                                            <span class="badge badge-pill badge-danger">Awaiting Payment</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 1 || $item->status == 2)
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-primary btn-sm btn-round"
                                                                onclick="window.location='{{ url('/cubebooks/edit-invoice/'.$item->invoice_id) }}'"
                                                                >
                                                                <i class="ft-edit-2"></i>                                                
                                                            </button>
                                                        @endif

                                                        @if ($item->status == 3)
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-warning btn-sm btn-round"
                                                                onclick="window.location='{{ url('/cubebooks/view-invoice/'.$item->invoice_id) }}'"
                                                                >
                                                                <i class="feather icon-eye"></i>                                                
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                
                                <div role="tabpanel" id="a_approval" class="tab-pane col-xl-12 col-lg-12 px-0">
                                    <table id="datatable3" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Invoice</th>
                                                <th>To</th>
                                                <th>Date</th>
                                                <th>Due Date</th>
                                                <th>Due</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($get_inv_2 as $item)
                                                @php
                                                    $paid = DB::table('inv_payment_details')->where('inv_id', $item->invoice_id)->sum('amount');

                                                    $due = ($item->final_total - $paid);
                                                @endphp
                                                <tr>
                                                    <td>{{$invName.$item->invoice_code}}</td>
                                                    <td>{{$item->display_name}}</td>
                                                    <td>{{$item->invoice_date}}</td>
                                                    <td>{{$item->due_date}}</td>
                                                    <td>{{$due}}</td>
                                                    <td>
                                                        @if ($item->status == 2)
                                                            <span class="badge badge-pill badge-warning">Awaiting Approval</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 1 || $item->status == 2)
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-primary btn-sm btn-round"
                                                                onclick="window.location='{{ url('/cubebooks/edit-invoice/'.$item->invoice_id) }}'"
                                                                >
                                                                <i class="ft-edit-2"></i>                                                
                                                            </button>
                                                        @endif

                                                        @if ($item->status == 3)
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-warning btn-sm btn-round"
                                                                onclick="window.location='{{ url('/cubebooks/view-invoice/'.$item->invoice_id) }}'"
                                                                >
                                                                <i class="feather icon-eye"></i>                                                
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                
                                <div role="tabpanel" id="a_payment" class="tab-pane col-xl-12 col-lg-12 px-0">
                                    <table id="datatable4" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Invoice</th>
                                                <th>To</th>
                                                <th>Date</th>
                                                <th>Due Date</th>
                                                <th>Paid</th>
                                                <th>Due</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($get_inv_3 as $item)
                                                @php
                                                    $paid = DB::table('inv_payment_details')->where('inv_id', $item->invoice_id)->sum('amount');

                                                    $due = ($item->final_total - $paid);
                                                @endphp

                                                @if ($due != 0)
                                                <tr>
                                                    <td>{{$invName.$item->invoice_code}}</td>
                                                    <td>{{$item->display_name}}</td>
                                                    <td>{{$item->invoice_date}}</td>
                                                    <td>{{$item->due_date}}</td>
                                                    <td>{{$paid}}</td>
                                                    <td>{{$due}}</td>
                                                    <td>
                                                        @if ($item->status == 3)
                                                            <span class="badge badge-pill badge-danger">Awaiting Payment</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 1 || $item->status == 2)
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-primary btn-sm btn-round"
                                                                onclick="window.location='{{ url('/cubebooks/edit-invoice/'.$item->invoice_id) }}'"
                                                                >
                                                                <i class="ft-edit-2"></i>                                                
                                                            </button>
                                                        @endif

                                                        @if ($item->status == 3)
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-warning btn-sm btn-round"
                                                                onclick="window.location='{{ url('/cubebooks/view-invoice/'.$item->invoice_id) }}'"
                                                                >
                                                                <i class="feather icon-eye"></i>                                                
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div role="tabpanel" id="paid" class="tab-pane col-xl-12 col-lg-12 px-0">
                                    <table id="datatable5" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Invoice</th>
                                                <th>To</th>
                                                <th>Date</th>
                                                <th>Due Date</th>
                                                <th>paid</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoices as $item)
                                                @php
                                                    $paid = DB::table('inv_payment_details')->where('inv_id', $item->invoice_id)->sum('amount');

                                                    $due = ($item->final_total - $paid);
                                                @endphp

                                                @if ($due ==0)
                                                    <tr>
                                                        <td>{{$invName.$item->invoice_code}}</td>
                                                        <td>{{$item->display_name}}</td>
                                                        <td>{{$item->invoice_date}}</td>
                                                        <td>{{$item->due_date}}</td>
                                                        <td>{{$paid}}</td>
                                                        <td>
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-warning btn-sm btn-round"
                                                                onclick="window.location='{{ url('/cubebooks/view-invoice/'.$item->invoice_id) }}'"
                                                                >
                                                                <i class="feather icon-eye"></i>                                                
                                                            </button>
                                                        </td>
                                                        
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

    <script src="{{asset('public/dt/datatable/datatables.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/bootstrap-fileupload.js')}}"></script>
    <script src="{{ asset('public/js/wizard-steps.js') }}"></script>
    <script>

        $(document).ready(function () {

            $("#datatable").DataTable();
            $("#datatable2").DataTable();
            $("#datatable3").DataTable();
            $("#datatable4").DataTable();
            $("#datatable5").DataTable();


            $('#check_all_checkbox').on('change', function(){
                if($(this).is(':checked')){
                    $('input[name=checkboxes]').prop('checked', true);
                    $('.btn-collect').removeClass('d-none');
                }else{
                    $('input[name=checkboxes]').prop('checked', false);
                    $('.btn-collect').addClass('d-none');
                }
            });

            $('input[name=checkboxes]').on('change', function(){
               if($('input[name=checkboxes]').is(':checked')){
                   $('.btn-collect').removeClass('d-none');
               }else{
                   $('.btn-collect').addClass('d-none');
               }
                
            });

            $('.btn-collect').on('click', function(){
                let id_array = [];
                $.each($('input[name=checkboxes]:checked'), function(){
                    id_array.push($(this).data('id'));
                });

                let ids = id_array.join(',');
                let url = "{{ route('emailschedules.create', ':ids') }}";
                url = url.replace(':ids', ids);
                location.href = url;
                
            });
        });

    </script>
@endsection
