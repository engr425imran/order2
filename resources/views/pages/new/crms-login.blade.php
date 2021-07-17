<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="CubeApps is Small Business Accounting.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="Cubeapps">
    <title>Cubeapps | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{asset('public/img/apple-icon-120.png')}}">    
    <link rel="shortcut icon" href="{{asset('public/img/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('public/css/newbootstrap.css')}}">
    <style type="text/css">
    	body{
    		background-color: #fff;
    	}
    	.crm-container h5{
    		font-weight: 600;
    	}
    	.crms-container {
		    margin: 13%;
		}
    </style>
</head>
<body>
	<div class="main-container">
		<div class="container">
			<div class="crms-container">
				<div class="row">
					<div class="col-md-4">
						<div class="crm-container">
							<img src="{{ url('public/new/images/crm-logo.jpg') }}" / width="100" height="100">
							<h5>CRM Plus</h5>
							<p>Undefined customer experience platform</p>
							<a href="#">Learn more</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>