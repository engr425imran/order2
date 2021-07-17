@php
    use \App\Http\Controllers\AccountController;
@endphp

@extends('master')
@section('title')
    {{-- {{$title}} --}}
@endsection
@section('stylesheet')
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/css/datatables.min.css')}}"> --}}
    {{-- <link href="{{asset('public/css/bootstrap-fileupload.css')}}" rel="stylesheet" /> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .fs-11 th,
        .fs-11 td {
            font-size: 11.4px;
        }
        .modal-body.bg {
            background-color: #FBFBFB;
        }

        .invalid {
            border-color: #ff7588 !important;
        }

        .table th, .table td {
            padding: 0.75rem 1rem;
        }

        .fs-11 .cw-45 {
            width: 45% !important;
        }
        .budget-label{
            line-height: 2 !important;
        }
        .table-header-titles{
            margin-bottom: 0;
        }
    </style>
@endsection
@section('content')


    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Budget variance</h3>
            <div class="row breadcrumbs-top">
                
            </div>
        </div>
    </div>
    <section id="">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="row pt-2">
                                <div class="col-md-9"></div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm" name="daterange" value="{{$date_start}} - {{$date_end}}" />
                                </div>
                            </div>
                            <table class="table table-bordered table-header-titles mt-1">
                                <thead>
                                    <tr>
                                        <th width="30%"></th>
                                        <th width="17.5%" class="text-right">Budget</th>
                                        <th width="17.5%" class="text-right">Actual</th>
                                        <th width="17.5%" class="text-right">Difference</th>
                                        <th width="17.5%" class="text-right">Difference %</th>
                                    </tr>
                                </thead>
                            </table>
                            <table class="table table-bordered table-striped table-incoming">
                                <thead></thead>
                                <tbody></tbody>
                            </table>
                            
                            <table class="table table-bordered table-striped table-outgoing">
                                <thead></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(async function(){
        let getVarianceData = await $.ajax({
            url: "{{route('budget.getvariance')}}",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                date_range_start : null,
                date_range_end : null
            }
        });
        displayIncomming(getVarianceData.incoming);
        displayOutgoing(getVarianceData.outgoing);

        function displayIncomming(incoming){
            let tableIncomming = $('.table-incoming');
            let incomingTotalDif = incoming.total.actual-incoming.total.budget;
            let incomingTotalDifSign = '';
            let incomingTotalDifPercent = '';

            if(incomingTotalDif > 0) 
                incomingTotalDifSign = '+';
            
            incomingTotalDif = incomingTotalDifSign+incomingTotalDif.toFixed(2);

            if(incoming.total.budget != 0){
                if(incomingTotalDif < 0 && incomingTotalDif != 0) 
                    incomingTotalDifSign = '-';
                incomingTotalDifPercent = (incoming.total.actual/incoming.total.budget)*100;
                incomingTotalDifPercent = incomingTotalDifSign+incomingTotalDifPercent.toFixed(2)+'%';
            }else{
                incomingTotalDifPercent = '';
            }
           
            tableIncomming.find('thead').html(`
                <tr>
                    <th width="30%">Total cash incomming:</th>
                    <th width="17.5%" class="text-right">${incoming.total.budget}</th>
                    <th width="17.5%" class="text-right">${incoming.total.actual}</th>
                    <th width="17.5%" class="text-right">${incomingTotalDif}</th>
                    <th width="17.5%" class="text-right text-success">${incomingTotalDifPercent}</th>
                </tr>
            `);

            let tbodyContent = '';
            $.each(incoming.accounts, function(index, account){
                let ai_totaldif = account.actual-account.budget;
                let ai_totaldifsign = '';
                let ai_totaldifpercent = '';
                if(ai_totaldif > 0) 
                    ai_totaldifsign = '+';

                ai_totaldif = ai_totaldifsign+ai_totaldif.toFixed(2);

                if(account.budget != 0){
                    if(ai_totaldif < 0) 
                        ai_totaldifsign = '-';
                    ai_totaldifpercent = (account.actual/account.budget)*100;
                    ai_totaldifpercent = ai_totaldifsign+ai_totaldifpercent.toFixed(2)+'%';
                }else{
                    ai_totaldifpercent = '';
                }
                
                tbodyContent += `
                    <tr>
                        <td>${account.ac_name}</td>
                        <td class="text-right">${account.budget}</td>
                        <td class="text-right">${account.actual}</td>
                        <td class="text-right">${ai_totaldif}</td>
                        <td class="text-right text-success">${ai_totaldifpercent}</td>
                    </tr>
                `;
            });  

            tableIncomming.find('tbody').html(tbodyContent);
            
        }
        function displayOutgoing(outgoing){
            let tableOutgoing = $('.table-outgoing');
            let outgoingTotalDif = outgoing.total.actual-outgoing.total.budget;
            let outgoingTotalDifSign = '';
            let outgoingTotalDifPercent = '';

            outgoingTotalDif = outgoingTotalDifSign+outgoingTotalDif.toFixed(2);

            if(outgoingTotalDif > 0) 
                outgoingTotalDifSign = '+';
            
            if(outgoing.total.budget != 0){
                if(outgoingTotalDif < 0) 
                outgoingTotalDifSign = '-';
            
                outgoingTotalDifPercent = (outgoing.total.actual/outgoing.total.budget)*100;
                outgoingTotalDifPercent = outgoingTotalDifSign+outgoingTotalDifPercent.toFixed(2)+'%';
            }else{
                outgoingTotalDifPercent = '';
            }
            
            tableOutgoing.find('thead').html(`
                <tr>
                    <th width="30%">Total cash outgoing:</th>
                    <th width="17.5%" class="text-right">${outgoing.total.budget}</th>
                    <th width="17.5%" class="text-right">${outgoing.total.actual}</th>
                    <th width="17.5%" class="text-right">${outgoingTotalDif}</th>
                    <th width="17.5%" class="text-right text-danger">${outgoingTotalDifPercent}</th>
                </tr>
            `);

            let tbodyContent = '';
            $.each(outgoing.accounts, function(index, account){
                let ao_totaldif = account.actual-account.budget;
                let ao_totaldifsign = '';
                let ao_totaldifpercent = '';
                if(ao_totaldif > 0) 
                ao_totaldifsign = '+';
                
                ao_totaldif = ao_totaldifsign+ao_totaldif.toFixed(2);

                if(account.budget != 0){
                    ao_totaldifpercent = (account.actual/account.budget)*100;
                    if(ao_totaldif < 0) 
                    ao_totaldifsign = '-';
                    ao_totaldifpercent = ao_totaldifsign+ao_totaldifpercent.toFixed(2)+'%';
                }else{
                    ao_totaldifpercent = '';
                }
               
                tbodyContent += `
                    <tr>
                        <td>${account.ac_name}</td>
                        <td class="text-right">${account.budget}</td>
                        <td class="text-right">${account.actual}</td>
                        <td class="text-right">${ao_totaldif}</td>
                        <td class="text-right text-success">${ao_totaldifpercent}</td>
                    </tr>
                `;
            });  

            tableOutgoing.find('tbody').html(tbodyContent);
        }

        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        });
        $('input[name="daterange"]').on('apply.daterangepicker', async function(ev, picker) {
            let getVarianceData = await $.ajax({
                url: "{{route('budget.getvariance')}}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    date_range_start : picker.startDate.format('YYYY-MM-DD'),
                    date_range_end : picker.endDate.format('YYYY-MM-DD')
                }
            });
            displayIncomming(getVarianceData.incoming);
            displayOutgoing(getVarianceData.outgoing);
        });
    });
</script>
@endpush
