@extends('master')
@section('title')
    {{-- {{$title}} --}}
@endsection
@section('stylesheet')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

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

        .mb-8px {
            margin-bottom: 8px !important;
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

        .f-btn {
            background-color: #fafafa;
            border-radius: 3px;
            border-style: solid;
            border-width: 1px;
            box-shadow: rgba(255,255,255,0.3) 0 0 0 1px inset;
            box-sizing: border-box;
            cursor: pointer;
            float: left;
            font-size: 12px;
            font-weight: bold;
            margin: 0 10px 15px 0;
            padding: 6px 12px;
            position: relative;
            text-align: center;
            -webkit-transition: opacity .2s ease-out;
            transition: opacity .2s ease-out;
            white-space: nowrap;
            -moz-user-select: -moz-none;
            -ms-user-select: none;
            -webkit-user-select: none;
            user-select: none;
        }
        
    </style>

@endsection
@section('content')


    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0"></h3>
            <div class="row breadcrumbs-top">
                {{-- Organisation details --}}
            </div>
        </div>
        {{-- <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <a href="#" class="btn-icon btn btn-secondary btn-round btn-success add_modal btn-sm" data-toggle="modal" data-target="#xlarge">
                    <i class="fa fa-university"></i> Add Account</a>
            </div>
        </div> --}}
    </div>



<form action="{{ route('updateComSetup') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <section>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header f_form">
                        <h4 class="card-title">Basic Information</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body card-dashboard f_body">
                            <div class="form-group row mb-8px">
                                <label for="display_name" class="col-sm-2 col-form-label fs-12 pb-0"><b>Display Name</b></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="display_name" id="display_name" value="{{($com) ? $com->display_name : ''}}" placeholder="Display name">

                                    <input type="hidden" name="com_id" value="{{($com) ? $com->com_id : ''}}" >
                                </div>
                            </div>

                            <div class="form-group row mb-8px">
                                <label for="trading_name" class="col-sm-2 col-form-label fs-12 pb-0"><b>Legal / Trading name</b></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="trading_name" id="trading_name" placeholder="Legal / Trading name" value="{{($com) ? $com->trading_name : ''}}">
                                </div>
                            </div>   
                            <div class="form-group row mb-8px">
                                <label for="trading_name" class="col-sm-2 col-form-label fs-12 pb-0"><b>VAT No</b></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="vat_no" id="trading_name" placeholder="Company VAT No" value="{{($com) ? $com->vat_no : ''}}">
                                </div>
                            </div>                               

                            <div class="form-group row mb-8px">
                                <label for="com_logo" class="col-sm-2 col-form-label fs-12 pb-0"><b>Logo</b></label>
                                <div class="col-sm-4">
                                    <input type="file" class="form-control form-control-sm" name="com_logo" id="com_logo">
                                </div>
                            </div>

                            <div class="form-group row mb-8px">
                                <label for="business_line" class="col-sm-2 col-form-label fs-12 pb-0"><b>What is your line of business?</b></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="business_line" id="business_line" placeholder="What is your line of business?" value="{{($com) ? $com->business_line : ''}}">
                                </div>
                            </div>

                            <div class="form-group row mb-8px">
                                <label for="organisation_type" class="col-sm-2 col-form-label fs-12 pb-0"><b>Organisation type</b></label>
                                <div class="col-sm-4">
                                    <select name="organisation_type" id="organisation_type" class="select2 form-control form-control-sm">
                                        <option value="{{($com) ? $com->organisation_type : ''}}">{{($com) ? $com->organisation_type : '--Select Organisation Type--'}}</option>
                                        <option value="Charity">Charity</option>
                                        <option value="Club of Society">Club of Society</option>
                                        <option value="Company">Company</option>
                                        <option value="Partnership">Partnership</option>
                                        <option value="Person">Person</option>
                                        <option value="Sole Trade">Sole Trade</option>
                                        <option value="Trust">Trust</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-8px">
                                <label for="business_reg_number" class="col-sm-2 col-form-label fs-12 pb-0"><b>Business Registration Number</b></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="business_reg_number" id="business_line" placeholder="Business Registration Number" value="{{($com) ? $com->business_reg_number : ''}}">
                                </div>
                            </div>
                            
                            <div class="form-group row mb-8px">
                                <label for="organisation_description" class="col-sm-2 col-form-label fs-12"><b>Organisation description</b></label>
                                <div class="col-sm-4">

                                    <textarea name="organisation_description" class="form-control form-control-sm" id="organisation_description" rows="3" placeholder="Organisation description">{{($com) ? $com->organisation_description :''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header f_form">
                        <h4 class="card-title">Contact Details</h4>            
                    </div>

                    <div class="card-content">
                        <div class="card-body card-dashboard f_body">
                            
                            <div class="form-group row mb-8px">
                                <label for="postal_address" class="col-sm-2 col-form-label fs-12"><b>Postal address</b></label>
                                <div class="col-sm-4">

                                    <textarea name="postal_address" id="postal_address" rows="3" class="form-control form-control-sm" placeholder="Postal Address">{{($com) ? $com->postal_address : ''}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-8px">
                                <label class="col-sm-2 col-form-label fs-12"></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="postal_city" placeholder="Postal City" value="{{($com) ? $com->postal_city : ''}}">
                                </div>
                            </div>
                            <div class="form-group row mb-8px">
                                <label class="col-sm-2 col-form-label fs-12"></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-sm" name="postal_stase" placeholder="Postal State" value="{{($com) ? $com->postal_stase : ''}}">
                                </div>
                                <div class="col-sm-1 pl-0">
                                    <input type="text" class="form-control form-control-sm" name="postal_code" placeholder="Postal Code" value="{{($com) ? $com->postal_code : ''}}">
                                </div>
                            </div>

                            <div class="form-group row mb-8px">
                                <label for="business_line" class="col-sm-2 col-form-label fs-12"><b></b></label>
                                <div class="col-sm-4">

                                    <select name="postal_country" id="postal_country" class="selectpicker form-control form-control-sm" data-live-search="true">
                                        <option value="{{($com) ? $com->postal_country : ''}}">{{($pc) ? $pc->name : '--Select Postal Country--'}}</option>
                                        @foreach ($countries1 as $c1)
                                            <option value="{{$c1->id}}">{{$c1->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="business_line" class="col-sm-2 col-form-label fs-12"><b></b></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="postal_attention" placeholder="Postal Attention" value="{{($com) ? $com->postal_attention : ''}}">
                                </div>
                            </div>

                            <br>
                            <hr>

                            <div class="form-group row mb-8px">
                                <label for="phy_address" class="col-sm-2 col-form-label fs-12"><b>Physical Address</b></label>
                                <div class="col-sm-4">
                                    <textarea name="phy_address" id="phy_address" rows="3" class="form-control form-control-sm" placeholder="Physical Address">{{($com) ?$com->phy_address : ''}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-8px">
                                <label class="col-sm-2 col-form-label fs-12"></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="phy_city" placeholder="Physical City" value="{{($com) ? $com->phy_city : ''}}">
                                </div>
                            </div>
                            <div class="form-group row mb-8px">
                                <label class="col-sm-2 col-form-label fs-12"></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-sm" name="phy_stase" placeholder="Physical State" value="{{($com) ? $com->phy_stase : ''}}">
                                </div>
                                <div class="col-sm-1 pl-0">
                                    <input type="text" class="form-control form-control-sm" name="phy_code" placeholder="Physical Code" value="{{($com) ? $com->phy_code : ''}}">
                                </div>
                            </div>

                            <div class="form-group row mb-8px">
                                <label for="business_line" class="col-sm-2 col-form-label fs-12"><b></b></label>
                                <div class="col-sm-4">

                                    <select name="phy_country" id="postal_country" class="selectpicker form-control form-control-sm" data-live-search="true">
                                        <option value="{{($com) ? $com->phy_country : ''}}">{{($ps) ? $ps->name : '--Select Postal Country--'}}</option>
                                        @foreach ($countries as $c)
                                            <option value="{{$c->name}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="business_line" class="col-sm-2 col-form-label fs-12"><b></b></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="phy_attention" placeholder="Physical Attention" value="{{($com) ?$com->phy_attention : ''}}">
                                </div>
                            </div>

                            <br>
                            <hr>

                            <div class="form-group row mb-8px">
                                <label for="telephone" class="col-sm-2 col-form-label fs-12"><b>Telephone</b></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="telephone" placeholder="Telephone" value="{{($com) ? $com->telephone : ''}}">
                                </div>
                            </div>

                            <div class="form-group row mb-8px">
                                <label for="com_email" class="col-sm-2 col-form-label fs-12"><b>Email</b></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="com_email" placeholder="Email" value="{{($com) ? $com->com_email : ''}}">
                                </div>
                            </div>

                            <div class="form-group row mb-8px">
                                <label for="com_website" class="col-sm-2 col-form-label fs-12"><b>Web Site</b></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="com_website" placeholder="Web Site" value="{{($com) ? $com->com_website : ''}}">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="text-right">
                                <button
                                    class="btn btn-green f-btn btn-sm"
                                    type="submit">Apply
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection


@push('script')

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function () {

        // Select 2 is select picker.
        $(".select2").select2();

        $(".selectpicker").selectpicker();
    });
</script>
    
@endpush