@extends('master')
@section('title')
    {{-- {{$title}} --}}
@endsection
@section('stylesheet')
<style type="text/css">
	.section-container a {
	    font-size: 16px;
	}
	.content-header-title {
	    font-weight: 500;
	}
	.section-container h3 {
	    font-size: 20px;
	    font-weight: 500;
	}
	.form-inline .form-control{
		width: 100%;
	}
	.form-inline label{
		justify-content: left;
	}
	.form-inline{
		width: 96%;
    	margin: auto;
	}
	.from,.to {
	    width: 50%;
	}
	.to {
	    float: right;
	}
	.from{
	    float: left;
	}
	.btn-container .dropdown {
	    margin-right: 15px;
	}
	.btn-container {
	    width: 100%;
	    margin: 60px 0px;
	    display: flex;
	    justify-content: center;
	}
	.filter-bar {
	    padding: 20px 2px;
	    background-color: #ffffff;
	    box-shadow: 0px 0px 20px -6px #cac8c8;
	    border-radius: 10px;
	}
	.select2-container--default .select2-selection--single {
	    width: 100% !important;
	}
	
	.hide{
		display: none !important;
	}
	#loader img {
        left: 50%;
        top: 50%;
        position: absolute;
        width: 30px;
    }
    #loader {
        height: 100%;
        width: 100%;
        position: absolute;
        background-color: #fafafa94;
    }
	@media screen and (max-width: 767px){
		.form-control.date {
		     width: 100%; 
		}
		.content-wrapper {
		    padding: 0;
		}
		.content-header-title {
		    font-size: 25px;
		}
		.form-inline label {
		    margin-top: 20px;
		}
		.customer-statement{
			margin: 0px;
			padding: 27px;
		}
	}
</style>
@endsection

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h1 class="content-header-title mb-0">Customer Statements</h1>
        <div class="row breadcrumbs-top"></div>
    </div>
</div>
<div class="content">
	<div class="container">
		
		<div class="main-container">
			<div class="filter-bar">
				<div class="row">
					<form class="form-inline" id="statement_form" onsubmit="return false;">
						@csrf
						<div class="col-md-3">
							<label>Customer</label>
							<select class="form-control" id="customer" name="customer" required>
								<option value="">Select Customer</option>
								@foreach ($customers as $customer)
									<option value="{{$customer->cust_id}}">{{$customer->display_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-3">
							<label>Type</label>
							<select class="form-control" name="type">
								<option value="1" selected>Account Activity</option>
							</select>
						</div>
						<div class="col-md-4">
							<div class="from">
								<label>From</label>
								<input type="date" name="from" class="form-control date-from date" id="from" placeholder="From" required />
							</div>
							<div class="to">
								<label>To</label>
								<input type="date" name="to" id="to" class="form-control date-to date" placeholder="To" required />
							</div>
						</div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-outline-primary btn-rounded mt-1 create-statement-btn">Create Statement</button>
						</div>
					</form>
				</div>
			</div>
			<div class="action-btn-container">
				<div class="btn-container">
					<!-- <div class="dropdown">
						<button class="btn btn-outline-secondary btn-rounded dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    More Action
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						    <a class="dropdown-item" href="#">Print</a>
						    <a class="dropdown-item" href="#">Preview as Customer</a>
						    <a class="dropdown-item" href="#">Get sharable link</a>
						</div>
					</div> -->
					<button class="btn btn-primary btn-rounded hide pdf-btn" onclick="genPDF()">Export PDF</button>
				</div>
			</div>
			<div id="loader" class="hide"><img src="{{url('public/img/loader.gif')}}"></div>
			<div id="statement_template_ajax"></div>

		</div>
	</div>
</div>

@endsection
@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script>

function genPDF()
{
	$('.customer-statement').css({'border-top':'unset', 'box-shadow': 'unset'});
	var HTML_Width = $(".customer-statement").width();
    var HTML_Height = $(".customer-statement").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($(".customer-statement")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        var from = $('#from').val();
        var to = $('#to').val();

        pdf.save("statement."+from.replaceAll('-', '.')+'|'+to.replaceAll('-','.')+".pdf");
        $('.customer-statement').css({'border-top':'9px solid', 'box-shadow': '0px 0px 20px -6px #cac8c8'});
    });

}

</script>

<script>
	$('.create-statement-btn').on('click', function(){
		var customer = $('#customer').val();
		var from = $('#from').val();
		var to = $('#to').val();
		$('#loader').removeClass('hide');
		if (customer && from && to) {
			$.ajax({
	            url:"{{route('customer.statment.create')}}",
	            method:"POST",
	            data:$('#statement_form').serialize(),
	            success: function(data)
	            {
	            	$('.pdf-btn').removeClass('hide');
	            	$('#statement_template_ajax').html(data);
	                $('#loader').addClass('hide');
	            },
	            error: function(e){
	                $('#loader').addClass('hide');
	                alert(e);
	            }
	        });
		}
	});
</script>
@stop