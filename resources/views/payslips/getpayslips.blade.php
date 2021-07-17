@extends('layouts.layouts')
@section('content')
<style>
    thead {
        color: aliceblue;
    }
</style>
@include('includes.header')
<div class="container mt-5">
    <h2>Pay periods</h2>
    @can('Will Generate Payslips', Model::class)        
        <table class="table table-stripped">
            <thead class="bg-primary">
                <tr>
                    <th>Pay Period Cycle *</th>
                    <th>Employee Name</th>   
                    <th>Description</th>
                    <th>Action</th>
                    <th><a href="{{url('/pays/create')}}" class="btn btn-success"> + Add</a></th> 
                </tr>
            </thead>
            @if(count($payslips))
                <tbody>
                    @foreach ($payslips as $item)
                    @php
                      $user = App\Models\User::find($item->employee_id);    
                    @endphp
                    <tr>
                        <td>{{ $item->type}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td> {{ $item->firstPeriodEndDate }}</td>
                        <td>{{ $item->lastDayMonth }}</td>
                    </tr>
                    @endforeach
                
                @else 
                <tr><td colspan="1"></td>
                    <td>No Records</td></tr>
                </tbody>    
            @endif

        @endcan
        
        
    </table>
    
   
</div>

@endsection
