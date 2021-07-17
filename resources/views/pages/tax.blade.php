@extends('master')
@section('title')
    {{-- {{$title}} --}}
@endsection

@section('stylesheet')
    <style>
        
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
            <h3 class="content-header-title mb-0">Tax</h3>
            <div class="row breadcrumbs-top"></div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <a href="#" class="btn-icon btn btn-secondary btn-round btn-success add_modal btn-sm" data-toggle="modal" data-target="#xlarge"><i class="fa fa-product-hunt"></i> Add New</a>
            </div>
        </div>
    </div>

    <section id="">
        <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Acount List:</h4>
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
                            {{-- <div class=""> --}}
                                <table id="datatable" class="table  table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tax Name</th>
                                            <th>Tax Rate</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($taxs as $item)
                                            <tr>
                                                <td> {{$item->tax_name}} </td>
                                                <td> {{$item->tax_amount . '%'}} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                        
                                </table>
                            {{-- </div> --}}
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    
    {{-- Add item --}}
    <div class="modal fade add__modal" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header"> 
                    <h4 class="modal-title">Add Tax Rate </h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('savetax') }}" method="POST" enctype="multipart/form-data"> 

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
@section('script')

    <script>

        $(document).ready(function(){
            $(document).on('click', '.add_modal', function() {

                $('.add__modal').modal();

            });
        });
    </script>


@endsection


@push('script')
    <script>
        $(document).ready(function () { 
            $(".select2").select2();

            $("#datatable").DataTable();
        });
    
    </script>
@endpush