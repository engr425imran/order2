@extends('master')
@section('title')
    {{$title}}
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
    </style>
@endsection

@section('content')

    <div class="content-header row">

        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Customers</h3>
            <div class="row breadcrumbs-top">
        
            </div>
        </div>

        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <!--<a class="btn-icon btn btn-secondary btn-round" ><i class="ft-bell"></i> </a>-->
                <a href="#" class="btn-icon btn btn-secondary btn-round btn-success" data-toggle="modal" data-target="#xlarge"><i class="fa fa-user"></i> New Customer</a>
            </div>
        </div>
    </div>

    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer List:</h4>

                        <ul class="mt-3 nav nav-pills nav-pills-cust nav-pills-icons" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" href="#all_customers" role="tablist" data-toggle="tab"><i class="fa fa-university" aria-hidden="true"></i>All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#active_customers" role="tab" data-toggle="tab"><i class="fa fa-university" aria-hidden="true"></i>Active</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#inactive_customers" role="tablist" data-toggle="tab"><i class="fa fa-university" aria-hidden="true"></i>Inactive</a>
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
                                <div role="tabpanel" id="all_customer" class="tab-pane active show col-xl-12 col-lg-12 px-0">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Open Balance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all as $c)
                                                <tr>
                                                    <td>{{$c->display_name}}</td>
                                                    <td>{{$c->email}}</td>
                                                    <td>{{$c->phone}}</td>
                                                    <td>{{$c->mobile}}</td>
                                                    <td>{{$c->c_street .', '. $c->c_state .', '. $c->c_postal .', '. $c->c_country }}</td>
                                                    <td>{{$c->opening_balance}}</td>
                                                    <td class="pr-0">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-primary btn-sm btn-round edit_modal"
                                                            customer_id="{{$c->cust_id}}"
                                                            >
                                                            <i class="ft-edit-2 fs-15"></i>                                                
                                                        </button>
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-danger btn-sm btn-round inactive"
                                                            value="{{$c->cust_id}}"
                                                            >
                                                            <i class="ft ft-user-x fs-15"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" id="active_customers" class="tab-pane col-xl-12 col-lg-12 px-0">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Open Balance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($active as $c)
                                                <tr>
                                                    <td>{{$c->display_name}}</td>
                                                    <td>{{$c->email}}</td>
                                                    <td>{{$c->phone}}</td>
                                                    <td>{{$c->mobile}}</td>
                                                    <td>{{$c->c_street .', '. $c->c_state .', '. $c->c_postal .', '. $c->c_country }}</td>
                                                    <td>{{$c->opening_balance}}</td>
                                                    <td class="pr-0">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-primary btn-sm btn-round edit_modal"
                                                            customer_id="{{$c->cust_id}}"
                                                            >
                                                            <i class="ft-edit-2 fs-15"></i>                                                
                                                        </button>
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-danger btn-sm btn-round inactive"
                                                            value="{{$c->cust_id}}"
                                                            >
                                                            <i class="ft ft-user-x fs-15"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> 
                                <div role="tabpanel" id="inactive_customers" class="tab-pane col-xl-12 col-lg-12 px-0">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Open Balance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inactive as $c)
                                                <tr>
                                                    <td>{{$c->display_name}}</td>
                                                    <td>{{$c->email}}</td>
                                                    <td>{{$c->phone}}</td>
                                                    <td>{{$c->mobile}}</td>
                                                    <td>{{$c->c_street .', '. $c->c_state .', '. $c->c_postal .', '. $c->c_country }}</td>
                                                    <td>{{$c->opening_balance}}</td>
                                                    <td class="pr-0">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-success btn-sm btn-round active"
                                                            value="{{$c->cust_id}}"
                                                            >
                                                            <i class=" ft ft-user-check fs-15"></i> 
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
            </div>
        </div>
    </section>


    
    <div class="modal fade text-left addModel" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
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

    
    <div class="modal fade text-left edit__modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <label class="modal-title text-text-bold-600 text-center" id="myModalLabel33">Edit Customer Info</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                              
                </div>

                <form action="{{ route('updateCustomer') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="throw_customerinfo"></div>
                   
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="close">
                        <input type="submit" class="btn btn-outline-primary btn-md" id="" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade text-left delModel" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600 text-center" id="myModalLabel33">Customer Info</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                              
                </div>
                <form action="#" method="post" id="addCustForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Are You sure want to delete <b><span class="custName" style="color:red;"></span></b> ?</label>
                                </div>
                            </div>
                                <input type="hidden" id="custID" class="form-control">
                        </div>
                        {{csrf_field()}}                            
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="close">
                        <input type="button" class="btn btn-outline-danger btn-md" id="delcust" value="Delete">
                    </div>
                </form>                                 
            </div>
        </div>
    </div>
    
@endsection

@section('script')

    {{-- <script type="text/javascript" src="{{asset('public/dt/datatable/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/bootstrap-fileupload.js')}}"></script> --}}

    <script>
        $(document).on('change','#shipadd', function (){
            if ($(this).is(':checked')){
                $('#c_street').val($('#b_street').val());
                $('#c_city').val($('#b_city').val());
                $('#c_state').val($('#b_state').val());
                $('#c_postal').val($('#b_postal').val());
                $('#c_country').val($('#b_country').val());
            }else{
                $('#c_street').val('');
                $('#c_city').val('');
                $('#c_state').val('');
                $('#c_postal').val('');
                $('#c_country').val('');
            }
        });
        $(document).on('change','#shipadd_edit', function (){
            if ($(this).is(':checked')){
                $('#c_street_edit').val($('#b_street_edit').val());
                $('#c_city_edit').val($('#b_city_edit').val());
                $('#c_state_edit').val($('#b_state_edit').val());
                $('#c_postal_edit').val($('#b_postal_edit').val());
                $('#c_country_edit').val($('#b_country_edit').val());
            }else{
                $('#c_street_edit').val('');
                $('#c_city_edit').val('');
                $('#c_state_edit').val('');
                $('#c_postal_edit').val('');
                $('#c_country_edit').val('');
            }
        });
        $(document).ready(function(){
            $('#pmenu').addClass('active');
            $('#cst').addClass('active');

            $(".edit_modal").on('click', function() {

                var c_id = $(this).attr('customer_id');

                $.ajax({

                    url:"{{route('catch.customerInfo')}}",

                    method:"GET",

                    data:{c_id:c_id},

                    success: function(data)
                    {
                        $('.throw_customerinfo').html(data);
                    }
                });

                $('.edit__modal').modal();

            });

            $('.table').on('click', '.inactive', function() {
                
                var this_data = $(this);
                var cust_id = $(this).val();
                    
                $.confirm({
                    
                    icon: 'fa fa-smile-o',
                    theme: 'modern',
                    closeIcon: true,
                    animation: 'scale',
                    type: 'red',
                    autoClose: 'cancel|10000',
                    escapeKey: 'cancel',
                    
                    buttons: {
                    
                        Inactive: {
                    
                            btnClass: 'btn-red',
                        
                            action: function() {
                        
                                $.ajax({
                        
                                    url:"{{route('inactive.customer')}}",
                                    
                                    method:"GET",
                                    
                                    data:{cust_id:cust_id},
                                    
                                    success: function(data) {
                        
                                        if(data == "1"){    
                                        
                                            this_data.parent().parent().fadeOut();
                                        
                                        } else {
                                        
                                            console.log(data);
                                        
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

            $('.table').on('click', '.active', function() {
                var this_data = $(this);
                var cust_id = $(this).val();
                    
                $.confirm({
                    
                    icon: 'fa fa-smile-o',
                    theme: 'modern',
                    closeIcon: true,
                    animation: 'scale',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    escapeKey: 'cancel',
                    
                    buttons: {
                    
                        Active: {
                    
                            btnClass: 'btn-success',
                        
                            action: function() {
                        
                                $.ajax({
                        
                                    url:"{{route('active.customer')}}",
                                    
                                    method:"GET",
                                    
                                    data:{cust_id:cust_id},
                                    
                                    success: function(data) {
                        
                                        if(data == "1"){
                                        
                                            this_data.parent().parent().fadeOut();
                                        
                                        } else {
                                        
                                            console.log(data);
                                        
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
            $("#datatable").DataTable();
        });
    </script>


@endsection
