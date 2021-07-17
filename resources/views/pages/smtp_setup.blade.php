@extends('master')
@section('title')
    {{-- {{$title}} --}}
@endsection
@section('stylesheet')

    <style>

        .f_form {

            background-size: 100%;
            background-image: linear-gradient(#ffffff,#fafbfb 50px);
            border-bottom: 1px solid #dfe1e2;
        }

        .f_body {
            background: #fafbfb;
        }

        .fs-12 {
            font-size: 12px;
        }

        .btn-green {
            text-shadow: 0 1px rgba(0,0,0,0.1);
            background: linear-gradient(#7bd000, #6bb101);
            border: 1px solid #5cac00;
            padding: .45rem 2.9rem;
            font-size: .85rem;
            color: #fff;
        }

        .btn-green:hover {
            border-color: #519800;
            background: linear-gradient(#6fbc00,#5f9d01);
        }

        
    </style>
@endsection
@section('content')


    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0"></h3>
            <div class="row breadcrumbs-top">
                
            </div>
        </div>
        {{-- <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <a href="#" class="btn-icon btn btn-secondary btn-round btn-success add_modal btn-sm" data-toggle="modal" data-target="#xlarge">
                    <i class="fa fa-university"></i> Add Account</a>
            </div>
        </div> --}}
    </div>




    <section>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header f_form">

                        <h4 class="card-title">SMTP setup</h4>


                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            
                    </div>

                    <div class="card-content">

                        <form action="{{ route('update.smtp') }}" method="POST">
                                @csrf                        
                            <div class="card-body card-dashboard  f_body">

                                <div class="row">                                    
                                    <div class="form-group col-sm-4">
                                        <label for="smtp_host">SMTP Host *</label><br>
                                        <span class="dropdown">
                                            <button id="Vendor" class="btn btn-{{$smpt->is_smtp ?? '' == 1 ? 'primary':'danger'}} dropdown-toggle " type="button" data-toggle="dropdown">
                                                {{$smpt->is_smtp ??'' == 1 ? 'Activated':'Deactivated'}}
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{route('check-issmtp',1)}}">Active</a></li>
                                                <li><a href="{{route('check-issmtp',0)}}">Deactive</a></li>
                                            </ul>
                                        </span>

                                    
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="smtp_host">SMTP Host *</label>
                                        <input class="form-control form-control-sm" name="smtp_host" id="smtp_host" placeholder="SMTP Host" value="{{$smpt->smtp_host ?? ''}}" type="text">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="smtp_port">SMTP Port *</label>
                                        <input class="form-control form-control-sm" name="smtp_port" id="smtp_port" placeholder="SMTP Port" value="{{$smpt->smtp_port ?? ''}}" type="text">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="smtp_username">SMTP Username *</label>
                                        <input class="form-control form-control-sm" name="smtp_username" id="smtp_username" placeholder="SMTP Username" value="{{$smpt->smtp_username ?? ''}}" type="text">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="smtp_password">SMTP Password *</label>
                                        <input class="form-control form-control-sm" name="smtp_password" id="smtp_password" placeholder="SMTP Password" value="{{$smpt->smtp_password ?? ''}}" type="password">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="from_email">From Email *</label>
                                        <input class="form-control form-control-sm" name="from_email" id="from_email" placeholder="From Email" value="{{$smpt->from_email ?? ''}}" type="email">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="from_name">From Name *</label>
                                        <input class="form-control form-control-sm" name="from_name" id="from_name" placeholder="From Name" value="{{$smpt->from_name ?? ''}}" type="text">
                                    </div>
                                </div>


                                {{-- <div class="form-group text-center">
                                    <button
                                        class="btn btn-blue btn-md"
                                        type="submit">Apply
                                    </button>
                                </div> --}}
                            
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <button
                                        class="btn btn-green f-btn btn-sm"
                                        type="submit">Apply
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-8 col-md-8">
                <div class="card">
                    <div class="card-header ">

                        <h4 class="card-title">
                            Invoice Name
                        </h4>


                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            
                    </div>

                    <div class="card-content">
                        <div class="card-body card-dashboard pt-0">

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="fs-11">
                                        <th class="cw-45">Invoice Name</th>
                                        <th class="text-right">Updated By</th>
                                        <th class="text-right">Date</th>
                                        <th class="text-right">Time</th>
                                    </tr>
                                </thead>

                                <tbody class="search_res">

                                    <tr class="b_color">
                                        <td><b>{{$inv->inv_name}}</b></td>
                                        <td class="text-right">{{$inv->name}}</td>
                                        <td class="text-right">{{$inv->updated_date}}</td>
                                        <td class="text-right">{{$inv->updated_time}}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection