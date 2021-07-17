@extends('master')
@section('title')
    {{$title}}
@endsection

@section('content')


    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">User Information</h3>
            <div class="row breadcrumbs-top"></div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            {{-- <div class="form-group">
                <a href="#" class="btn-icon btn btn-secondary btn-round btn-success add_modal btn-sm" data-toggle="modal" data-target="#xlarge"><i class="fa fa-product-hunt"></i> </a>
            </div> --}}
        </div>
    </div>

    <section id="">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User :</h4>
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
                            
                            <form action="{{route('updateUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="padding-15px background-white">
                                            <a href="#" class="d-block mb-2">
                                                <img class="user_profile_image" src="{{($user->image) ? asset($user->image) : asset('public/img/no_image.jpg')}}" alt="">
                                            </a>
                                            <input type="file" class="btn btn-sm " name="photo">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <label for="name"> <i class="ft-user mr-1"></i> User Name</label>
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                <input type="text" name="name" id="name" class="form-control form-control-sm" value="{{$user->name}}" placeholder="Name" required>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label for="email"> <i class="ft-mail mr-1"></i>Email</label>
                                                <input type="text" name="email" id="email" class="form-control form-control-sm" value="{{$user->email}}" placeholder="info@yourname.com">
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label for="phone"> <i class="ft-phone mr-1"></i> Phone</label>
                                                <input type="text" name="phone" id="phone" class="form-control form-control-sm" value="{{$user->phone}}" placeholder="002229456987">
                                            </div>

                                            
                                            <div class="col-md-12 mb-4">
                                                <label>
                                                    <i class="icon-lock margin-right-10px"></i> Password
                                                </label>
                                                <input type="password" class="form-control form-control-sm" name="password">
                                            </div>
                                        </div>
                                        <hr class="mt-3 mb-3">

                                        {{-- <a href="#" class="btn btn-md padding-lr-25px  text-white background-main-color btn-inline-block">Update Profile</a> --}}
                                        

                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary round btn-min-width" type="submit">Update Profile</button>
                                    </div>
                                </div>
                            </form>
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