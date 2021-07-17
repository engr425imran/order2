@extends('master')
@section('title')
    {{$title}}
@endsection
@section('stylesheet')

@endsection
@section('content')


    {{-- <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Add Bank Category</h3>
            <div class="row breadcrumbs-top">
                
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <a href="#" class="btn-icon btn btn-secondary btn-round btn-success add_modal btn-sm" data-toggle="modal" data-target="#xlarge">
                    <i class="fa fa-university"></i> Add Bank Category</a>
            </div>
        </div>
    </div> --}}






    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="card-title mb-0"><i class="fa fa-bank"></i> Bank Category </h6>
                <button type="button" class="btn btn-sm btn-success ml-auto" data-toggle="modal" data-target="#defaultModal">
                    <i class="mdi mdi-plus"></i>Create New
                </button>
            </div>
            <div class="row">
                <div class="col-12">

                    <table id="datatable1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 90%">Category Name</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($bank_categorys as $item)
                                <tr>
                                    <td>{{$item->cat_name}}</td>
                                    <td>
                                        <button 
                                            type="button" 
                                            class="btn btn-icons btn-rounded btn-success edit"
                                            b_c_id="{{$item->b_c_id}}"
                                            cat_name="{{$item->cat_name}}"
                                        >
                                            <i class="mdi mdi-pen"></i>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('saveBankCat') }}" method="POST" enctype="multipart/form-data"> 

                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bank Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class=" text-danger">×</span>
                        </button>
                    </div>




                    <div class="modal-body">
                            
                        <div class="form-group">
                            <label for="cat_name">Category Name :</label>
                            <input type="text" class="form-control form-control-sm" id="cat_name" name="cat_name" placeholder="Category Name" required>
                        </div>
                        
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('updateBankCat') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bank Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-danger">×</span>
                        </button>
                    </div>
                    

                    <div class="modal-body">

                        <input type="hidden" class="b_c_id" name="b_c_id">
                            
                        <div class="form-group">
                            <label for="cat_name">Category Name :</label>
                            <input type="text" class="form-control form-control-sm cat_name" id="cat_name" name="cat_name" placeholder="Category Name" required>
                        </div>
                        
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success btn-sm" type="submit"> Update</button>
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

                var b_c_id = $(this).attr('b_c_id');
                var cat_name = $(this).attr('cat_name');


                $('.b_c_id').val(b_c_id);
                $('.cat_name').val(cat_name);
                
                $('.edit__modal').modal();
            });
            
            $("#datatable1").DataTable();

        });
    
    </script>
@endpush