@extends('master')
@section('title')
    {{$title}}
@endsection
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/datatables.min.css')}}">
    <link href="{{asset('public/css/bootstrap-fileupload.css')}}" rel="stylesheet" />
@endsection

@section('content')

    <section id="basic-tabs-components">
        <div class="row match-height">

            <div class="col-xl-12 col-lg-12">
                <div class="card" style="">
                    <div class="card-header">
                        <h4 class="card-title">Top Border Tabs</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            
                            <ul class="nav nav-tabs nav-top-border no-hover-bg" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11" href="#tab11" role="tab" aria-selected="true">Tax Setup</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab12" data-toggle="tab" aria-controls="tab12" href="#tab12" role="tab" aria-selected="false">Invoice Start</a>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="nav-link" id="base-tab13" data-toggle="tab" aria-controls="tab13" href="#tab13" role="tab" aria-selected="false">Tab 3</a>
                                </li>-->
                            
                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div class="tab-pane active" id="tab11" role="tabpanel" aria-labelledby="base-tab11">

                                    <form method="post" id="upTax">  
                                        {{csrf_field()}}                             
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tax in Percentage (%)</label>
                                                    <input type="number" name="tax" id="tax" value="{{$setups->tax}}" placeholder="Enter tax in percentage" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <input type="submit" class="btn btn-outline-primary btn-md" value="Update">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="tab-pane" id="tab12" role="tabpanel" aria-labelledby="base-tab12">
                                    <div class="tab-pane" id="tab11" role="tabpanel" aria-labelledby="base-tab11">
                                        <form method="post" id="upInv">                                        
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Invoice start from</label>
                                                        <input type="number" name="invoice_start" id="invoice_start" value="{{$setups->invoice_start}}" class="form-control" placeholder="Enter invoice number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <button type="submit" class="btn btn-outline-primary btn-md">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                            {{csrf_field()}}
                                        </form>    
                                    </div>
                                </div>
                                <!--<div class="tab-pane" id="tab13" role="tabpanel" aria-labelledby="base-tab13">
                                    <p>Biscuit ice cream halvah candy canes bear claw ice cream cake chocolate bar donut. Toffee cotton candy liquorice. Oat cake lemon drops gingerbread dessert caramels. Sweet dessert jujubes powder sweet sesame snaps.</p>
                                </div>-->
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

    <!--<script src="{{'public/dt/datatable/buttons.bootstrap4.min.js'}}"></script>-->
    <script type="text/javascript" src="{{asset('public/js/bootstrap-fileupload.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#set').addClass('active');
            $('#tx').addClass('active');

        });
        $("#upInv").on('submit',function(event)
        {  
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('up.invstrt')}}",
                data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                invoice_start: $('#invoice_start').val()
                },
                success: function(data){
                    console.log("okay");
                    toastr[data.type](data.message);
                }
            });
        });
        $("#upTax").on('submit',function(event)
        {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('up.tax')}}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    tax: $('#tax').val()
                },
                success: function(data){
                    console.log("okay");
                    toastr[data.type](data.message);
                }
            });
        });
    </script>
@endsection
