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
        }
    </style>
@endsection
@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="card-title mb-0"><i class="fa fa-bank"></i> Bank List </h6>
                <button type="button" class="btn btn-sm btn-success ml-auto" data-toggle="modal" data-target="#defaultModal">
                    <i class="mdi mdi-plus"></i>Add a Bank or Credit Card
                </button>
            </div>
            <div class="row">
                <div class="col-12">

                    <table id="datatable1" class="table table-bordered table-striped table-responsive">
                        <thead>
                            <tr>
                                <th class="width-20">Name</th>
                                <th>Bank Name</th>
                                <th>Account Number</th>
                                <th>Branch Name</th>
                                <th>Branch Code</th>
                                <th>Balance</th>
                                <th>Active</th>
                                <th>Default</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($bank_accounts as $item)
                                <tr>
                                    <td>{{$item->b_account_name}}</td>
                                    <td>{{$item->bank_name}}</td>
                                    <td>{{$item->account_number}}</td>
                                    <td>{{$item->brance_name}}</td>
                                    <td>{{$item->branch_code}}</td>
                                    <td>{{$item->opening_balance}}</td>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" disabled {{ ($item->b_active == 1) ? 'checked' : '' }}>
                                            {{ ($item->b_active == 1) ? 'Active' : 'Deactive' }}
                                            <i class="input-helper"></i></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" disabled {{ ($item->b_default == 1) ? 'checked' : '' }}>
                                            {{ ($item->b_default == 1) ? 'Yes' : 'No' }}
                                            <i class="input-helper"></i></label>
                                        </div>
                                    </td>
                                    <td class="text-right px_5">
                                        <button 
                                            type="button" 
                                            class="btn btn-icons btn-rounded btn-success edit"
                                            b_a_id="{{$item->b_a_id}}"
                                            >
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button 
                                            type="button" 
                                            class="btn btn-icons btn-rounded btn-danger delete"
                                            value="{{$item->b_a_id}}"
                                            >
                                            <i class="mdi mdi-trash-can"></i>
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






    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('saveBank') }}" method="POST" enctype="multipart/form-data"> 

                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Bank Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class=" text-danger">×</span>
                        </button>
                    </div>




                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label pr-0 text-right">Bank Account Name 	</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="b_account_name" placeholder="Bank Account Name" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label pr-0 text-right">Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm" name="cat_id">
                                            <option value="">(None)</option>
                                            @foreach ($bank_categorys as $item)
                                                <option value="{{$item->b_c_id}}">{{$item->cat_name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row mb-1">

                                    <div class="form-check form-check-flat mt-0 ml-5">
                                        <label class="form-check-label">
                                        <input type="hidden" name="b_active" value="0">
                                        <input type="hidden" name="b_default" value="0">
                                        <input type="checkbox" class="form-check-input active" value="1" name="b_active" checked>
                                        Active
                                        <i class="input-helper"></i></label>
                                    </div>              
                                </div>
                                <div class="form-group row mb-1">

                                    <div class="form-check form-check-flat mt-0 ml-5">
                                        <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input default" value="0" name="b_default">
                                        Default
                                        <i class="input-helper"></i></label>
                                    </div>              
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label pr-0 text-right">Default Payment Method </label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm" name="payment_method" >
                                            <option value="1">Cash</option>
                                            <option value="2">Cheque</option>
                                            <option value="3">Credit Card</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label pr-0 text-right">Bank Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="bank_name" placeholder="Bank Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label pr-0 text-right">Opening Balance</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control form-control-sm" name="opening_balance" placeholder="Opening Balance" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label pr-0 text-right">Account Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" name="account_number" placeholder="Account Number" required>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label pr-0 text-right">Opening Balance as At</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm datepicker" name="ob_as_at" placeholder="Opening Balance as At" required>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label pr-0 text-right">Branch Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="brance_name" placeholder="Branch Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label pr-0 text-right">Branch Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="branch_code" placeholder="Branch Code">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label pr-0 text-right">Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" class="form-control form-control-sm" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label pr-0 text-right">Notes</label>
                                    <div class="col-sm-9">
                                        <textarea name="notes" class="form-control form-control-sm" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div></div>
                            
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success btn-sm" type="submit"> Save Now !</button>
                        <button type="button" class="btn btn-outline-warning btn-sm" data-dismiss="modal">Close</button>
                    </div>


                </form>

            </div>
        </div>

    </div>

    <div class="modal fade edit__modal" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('updateBank') }}" method="POST" enctype="multipart/form-data"> 

                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Bank Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class=" text-danger">×</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <span class="throw_bankinfo"></span>
                            
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success btn-sm" type="submit"> Update Now !</button>
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

            $(document).on('click', '.edit', function() {

                var b_a_id = $(this).attr('b_a_id');


                $.ajax({

                    url:"{{route('catchBankInfo')}}",

                    method:"GET",

                    data:{b_a_id:b_a_id},

                    success: function(data)
                    {
                        $('.throw_bankinfo').html(data);
                        $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
                    }
                });
                
                
                $('.edit__modal').modal();
            });



            $(document).on('click', '.active', function() {
                if($(this).is(":checked")) {
                    $(".active").val(1);
                } else {
                    $(".active").val(0);
                }
            });

            $(document).on('click', '.default', function() {
                if($(this).is(":checked")) {
                    $(".default").val(1);
                } else {
                    $(".default").val(0);
                }
            });

            
            $("#datatable1").DataTable();
            $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });


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
                    content: 'If you delete this then all transaction will be deleted!',
                    
                    buttons: {
                    
                        Delete: {
                    
                            btnClass: 'btn-red',
                        
                            action: function() {
                        
                                $.ajax({
                        
                                    url:"{{route('deleteBank')}}",
                                    
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

        });

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