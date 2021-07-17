<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr" style="--vh:3.47px;">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Fieldm8 is Small Business Accounting.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="Cubeapps">
    <title>CubeApps | Invoice</title>
    <link rel="apple-touch-icon" href="{{asset('public/img/apple-icon-120.png')}}">    
    <link rel="shortcut icon" href="{{asset('public/img/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    {{--============================ ALL Css library Start ============================--}}
    
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/newbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/newbootstrap-extended.css')}}">    
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/components.css')}}">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>  
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  
    <style type="text/css">
    	.top-nav {
	    background-color: #fff;
	    display: flex;
	    padding: 10px 60px;
        position: fixed;
	    width: 100%;
	    top: 0;
	    box-shadow: 0px 0px 10px #bbbbbb;
	}
	.quote-total {
	    font-size: 32px;
	    font-weight: 500;
	    margin-bottom: 0px;
	    padding: 0px 13px;
	}
	.modal-body {
		text-align: center;
	}

	#preloader {
	  background: #fff;
      height: 100%;
      position: absolute;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  z-index: 99999999999;
	}

	.loader {
	  position: absolute;
      width: 3rem;
      height: 5rem;

	  top: 50%;
	  margin: 0 auto;
	  left: 0;
	  right: 0;
	  transform: translateY(-50%); }

	.circular {
	  animation: rotate 2s linear infinite;
	  height: 100%;
	  transform-origin: center center;
	  width: 100%;
	  position: absolute;
	  top: 0;
	  bottom: 0;
	  left: 0;
	  right: 0;
	  margin: auto; }

	.path {
	  stroke-dasharray: 1, 200;
	  stroke-dashoffset: 0;
	  animation: dash 1.5s ease-in-out infinite, color 6s ease-in-out infinite;
	  stroke-linecap: round; }

	@keyframes rotate {
	  100% {
	    transform: rotate(360deg); } }

	@keyframes dash {
	  0% {
	    stroke-dasharray: 1, 200;
	    stroke-dashoffset: 0; }
	  50% {
	    stroke-dasharray: 89, 200;
	    stroke-dashoffset: -3.5rem; }
	  100% {
	    stroke-dasharray: 89, 200;
	    stroke-dashoffset: -12.4rem; } }

	@keyframes color {
	  100%,
	  0% {
	    stroke: #d62d20; }
	  40% {
	    stroke: #0057e7; }
	  66% {
	    stroke: #008744; }
	  80%,
	  90% {
	    stroke: #ffa700; } }

	.progress-bar {
	  background-color: transparent; }

	.progress-bar-primary {
	  background-color: #7571f9; }

	.progress-bar-success {
	  background-color: #6fd96f; }

	.progress-bar-info {
	  background-color: #4d7cff; }

	.progress-bar-danger {
	  background-color: #ff5e5e; }

	.progress-bar-warning {
	  background-color: #f29d56; }

	.progress-bar-pink {
	  background-color: #e91e63; }

	.progress-bar.active,
	.progress.active .progress-bar {
	  animation: 2s linear 0s normal none infinite running progress-bar-stripes; }
	.download {
	    float: right;
	    text-align: right;
	    width: 100%;
	}
	.progress-vertical {
	  display: inline-block;
	  height: 250px;
	  margin-bottom: 0;
	  margin-right: 20px;
	  min-height: 250px;
	  position: relative; }

	.progress-vertical-bottom {
	  display: inline-block;
	  height: 250px;
	  margin-bottom: 0;
	  margin-right: 20px;
	  min-height: 250px;
	  position: relative;
	  transform: rotate(180deg); }

	.progress-animated {
	  animation-duration: 5s;
	  animation-name: myanimation;
	  transition: all 5s ease 0s; }

	@keyframes myanimation {
	  0% {
	    width: 0; } }

	@keyframes myanimation {
	  0% {
	    width: 0; } }

    </style>
</head>
<body>
	@php
	$token = \Request::get('token');
    $quote = App\Invoice::with('customer','invoice_items', 'invoice_items.accounts')->where('token', $token)->first();
    $customer = $quote->customer;
    $invoice_items = $quote->invoice_items;

    $quote->invoice_status = 'Opened';
    $quote->update();

	@endphp
	<div class="main-container">
		<div class="content">
			<div class="top-nav">
				<p class="quote-total">${{$quote->final_total??0.00}}</p>
				<!-- Button trigger modal -->
				@if(isset($quote) and $quote->status == 2)
					<div class="buttons" style="display: inline-flex;width: 100%;">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#approvequote">
						  Accept Quote
						</button>
						
						
						<button type="button" class="btn btn-default">
							Ask a Question
						</button>
					</div>
				@endif
				<div class="download">
					<button class="btn download-btn btn-success">Dowload</button>
				</div>
			</div>
		</div>
		<div id="invoice_box" style="max-width: 930px;margin: auto;padding: 30px;border: 1px solid #eee;font-size: 16px;line-height: 24px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial,sans-serif;background-color: #fff;margin: 75px auto;color: #555;">
			<div style="width: 100%;line-height: inherit;text-align: left;">
				<div class="title" style="padding: 5px;vertical-align: top;padding-bottom: 20px;font-size: 45px;line-height: 45px;color: #333;">
                   <img class="brand-logo" width="7%" style="background-color: #6d6d6d;" alt="Cubeapps" src="{{asset('public/img/stack-logo-light.png')}}">
                   <h2 class="brand-text" style="display: inline;padding-left: 10px;font-weight: 500;letter-spacing: 1px;">CubeApps</h2>
                </div>
				<div style="width: 100%; float: right;">
                    <div style="padding: 5px;vertical-align: top;text-align: right;padding-bottom: 20px;">
                        Invoice #: {{$quote->invoice_code}}<br>
                        Created Date: {{$quote->created_date}}<br>
                        Invoice Date: {{$quote->invoice_date}}<br>
                        Reference: {{$quote->reference}} <br>
                        Expiry Date: {{$quote->due_date}}
                    </div>
                </div>
                <div style="width: 100%">
                	<div style="padding: 5px;vertical-align: top;padding-bottom: 40px; width: 50%; float: left;">
	                 
	                  {{$customer->b_street}} {{$customer->b_city}}<br>
	                   {{$customer->b_country}} {{$customer->b_postal}}
	              	</div>
	              	<div style="padding: 5px;vertical-align: top;text-align: right;padding-bottom: 40px; float: right;">
	                  {{ $customer->display_name }}<br>
	                  {{ $customer->contact_person }}
	              	</div>
                </div>
                
			</div>
	        <table id="table" cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
	            
	            
	          
	            <tr class="heading">
	                <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
	                    Product
	                </td>
	                
	                <td style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
	                    Quantity
	                </td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
	                    Rate
	                </td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
	                    Disc %
	                </td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
	                    Account
	                </td>
	               
	                <td style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
	                    Tax Amount
	                </td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
	                    Amount
	                </td>
	            </tr>

		        @foreach($invoice_items as $key => $item)

		        <tr class="item">
	                <td style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee;">
	                    {{$item->product->item_name ?? ''}}
	                </td>
	                
	                <td style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee;">
	                    {{ $item->quantity ?? 0 }}
	                </td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee;">
	                    {{ $item->rate ?? 0.00 }}
	                </td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee;">
	                    {{ $item->discount ?? 0.00 }}
	                </td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee;">
	                    {{ $item->accounts->ac_name ?? '' }}
	                </td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee;">
	                    {{ $item->tax_amount ?? 0.00 }}
	                </td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee;">
	                    {{ $item->amount ?? 0.00 }}
	                </td>
	            </tr>
	            @endforeach
	        </table>
	        <table  cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
	        	
	            <tr class="total">
	                <td style="padding: 5px;vertical-align: top;"></td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;">
	                   Subtotal: R{{$quote->sub_total}}
	                </td>
	            </tr>
	           
	            @foreach($invoice_items as $key=> $value)
	            <tr class="total">
	                <td style="padding: 5px;vertical-align: top;"></td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;font-weight: bold;">
	                   {{$key+1}}. Tax {{round($value->tax_amount / $value->amount *  100)}}%: R{{$value->tax_amount}}
	                </td>
	            </tr>
	            @endforeach
	            <tr class="total">
	                <td style="padding: 5px;vertical-align: top;border-top: 2px solid #eee;"></td>
	                <td style="padding: 5px;vertical-align: top;text-align: right;border-top: 2px solid #eee;font-weight: bold;">
	                   Total: R{{$quote->final_total}}
	                </td>
	            </tr>
	        </table>
	    </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="approvequote" tabindex="-1" role="dialog" aria-labelledby="approvequotetitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-body">
	      			<!--*******************
				        Preloader start
				    ********************-->
				    <div id="preloader" style="display: none;">
				        <div class="loader">
				            <svg class="circular" viewBox="25 25 50 50">
				                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
				            </svg>
				        </div>
				    </div>
				    <!--*******************
				        Preloader end
				    ********************-->
	      	  		<h3>Confirm Invoice Acceptance</h3>
	      	  		<p>Changes cannot be made after acceptance. Accepted invocies cannot be cancelled</p>
	      	  		<form id="acceptance-quote-form">
						<input type="hidden" name="token" value="{{$token??''}}">
						
			        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        	<button type="button" class="btn btn-success quote-accept">Accept Invoice</button>
					</form>
	      		</div>
	    	</div>
	  	</div>
	</div>
	 <script src="{!!asset('public/js/sweet-alerts.min.js')!!}" type="text/javascript"></script>
	<script src="{{asset('public/js/vendors.min.js')}}"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
	<script>
		$('.quote-accept').click(function(){
			var formdata = $('#acceptance-quote-form');
			$('#preloader').show();
		    $.ajax({
		      url: "{{url('/cubebooks/invoice-status')}}",
		      type: "POST",
		      data: formdata.serialize(),
		      headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		      },
		      success: function(response) {
		      	$('#preloader').hide(); 
		        if (response.status == 1) {
		        	$('.modal-body').html(`<i class="ft-check" style="font-size: 65px; color: #16d39a; "></i><p data-dismiss="modal">`+response.message+`</p>`);
		        	$('.buttons').hide();
		        	setTimeout(function() {
		        		$('.modal').modal('toggle');
		        	}, 1000);
		       	}else{
		          swal(response.message, {
		            icon: "error",
		          })
		          .then((value) => {
		            location.reload();
		          });
		        }
		      },
		      error: function(XMLHttpRequest, textStatus, errorThrown) { 
		          $('#preloader').hide();
		          swal(XMLHttpRequest['responseText'], {
		            icon: "error",
		          });
		          console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
		      }
		    });
		});
	</script>
	<script>  
    (function () {  

        $('.download-btn').on('click', function () {  
            $('body').scrollTop(0);  
            createPDF();  
        });  
        //create pdf  
        function createPDF() {  

        	var inv_name = '{{$quote->invoice_code}}';
            var pdfname = inv_name+'-invoice.pdf';
            var HTML_Width = $("#invoice_box").width();
            var HTML_Height = $("#invoice_box").height();
            var top_left_margin = 10;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 4);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            html2canvas($("#invoice_box")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save(pdfname);
            });
        }  

    }());  
</script>  
</body>
</html>