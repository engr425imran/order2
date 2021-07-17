<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <!-- Styles -->
   <style>
    ul {
        list-style: none;
    }
   </style>
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('includes.header')
    <div class="container mt-5">
        <div class="row ">
            <div class="col-md-6 mb-3 ">
            <button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#box">employee</button>
                <ul id="box" class="collapse">
                    <li>link 1</li>
                    <li>link 2</li>
                    <li>link 2</li>
                </ul>
            </div>
            <div class="col-md-6 ">
            <button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#payroll">payroll</button>
                <ul id="payroll" class="collapse">
                    <li>Pay Types</li>
                    <li>Pank Transfer setup</li>
                    <li>Pay Points</li>
                    <li>Payroll Calculations</li>
                    <li>Payslip Setup</li>
                    <li><a href="{{url('pays')}}">Pay period</a></li>
                    <li>Empolyee take on total</li>
                </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
            <button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#locations">Locations</button>
                <ul id="locations" class="collapse">
                    <li>link 1</li>
                    <li>link 2</li>
                    <li>link 2</li>
                </ul>
            </div>
            <div class="col-md-6 ">
            <button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#timeoff">time offs</button>
                <ul id="timeoff" class="collapse">
                    <li>link 1</li>
                </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
            <button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accounting">accouting</button>
                <ul id="accounting" class="collapse">
                    <li>link 1</li>
                    <li>link 2</li>
                    <li>link 2</li>
                </ul>
            </div>
            
        </div>
        
        
    
    </div>
   
    
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>