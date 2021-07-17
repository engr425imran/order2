@extends('layouts.layouts')
@section('content')
<style>
        form{
            border: 1px solid seagreen;
        }
</style>
  @include('includes.header')
 
    <div class="container mt-5">
        <h3 class="">Create Pay slips for Employee</h3>
        <div class="row mt-5">
            <div class="col-md-5 offset-3 ">
                
                <h4>Here IS the List Of All Register Employee</h4>
                <form action="{{url('/pays')}}" method="post" class="form">
                    @csrf
                    <div class="form-group">
                        <label for="payPeriodCycle" > &nbsp Pay Period Cycle *</label><br>
                        <select name="paycycletype" id="" class="from-control">
                            <option value="monthly" class="from-control">Monthly</option>
                            <option value="weekly" class="from-control">Weekly</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="employee" > &nbsp Select Employee *</label><br>
                      @foreach ($users as $item)
                      <select name="employee" id="" class="from-control">
                          <option value="{{$item->id}}" class="from-control">{{$item->name}}</option>
                          @endforeach
                      </select>
                  </div>
                    <div class="form-group">
                        <label for="name" > &nbsp Name (optional)</label><br>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name (optional)">
                    </div>
                    
                    <div class="form-group">
                        <label for="firstPeriodEndDate" > &nbsp First Period End Date *</label><br>
                        <input type="date" name="firstPeriodEndDate" id="firstPeriodEndDate" class="form-control" placholder="DD MM YYYY">
                    </div>
                    <div class="form-group">
                        <label for="lastDayMonth" > &nbsp Last Day of Month *</label><br>
                        <input type="number" min="1" max="31" name="lastDayMonth" id="lastDayMonth" class="form-control" placholder="DD MM YYYY">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                    </div>
                    
                   <div class="mt-3">
                    <center> <button type="submit" class="btn btn-success"> Save</button>
                    <a href="{{url('/pays')}}" class="btn btn-danger">Cancel</a>
                   </div>
                </form>

            </div>

        </div>
    </div>
@endsection