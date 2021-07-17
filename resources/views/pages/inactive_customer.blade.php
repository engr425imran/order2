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

        {{-- <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <!--<a class="btn-icon btn btn-secondary btn-round" ><i class="ft-bell"></i> </a>-->
                <a href="#" class="btn-icon btn btn-secondary btn-round btn-success" data-toggle="modal" data-target="#xlarge"><i class="fa fa-user"></i> New Customer</a>
            </div>
        </div> --}}
    </div>




    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer List:</h4>
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
                        <div class="card-body card-dashboard table-responsive">
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
                                    @foreach ($customers as $c)
                                        <tr>
                                            <td>{{$c->display_name}}</td>
                                            <td>{{$c->email}}</td>
                                            <td>{{$c->phone}}</td>
                                            <td>{{$c->mobile}}</td>
                                            <td>{{$c->c_street .', '. $c->c_state .', '. $c->c_postal .', '. $c->c_country }}</td>
                                            <td>{{$c->opening_balance}}</td>
                                            <td class="">                    
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
    </section>

    
@endsection

@section('script')


    <script>

        $(document).ready(function(){

            // ==================== Active customer function start ==================== //

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
            // ==================== Active customer function end ===================== // 

            $("#datatable").DataTable();
        });


    </script>


@endsection
