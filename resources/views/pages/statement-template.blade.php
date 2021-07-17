<style type="text/css">
	.title {
	    text-align: right;
	}
	.customer-statement {
	    padding: 40px;
	    background-color: #fff;
	    box-shadow: 0px 0px 20px -6px #cac8c8;
	    border-radius: 10px;
	    margin: 50px;
	    border-top: 9px solid;
	}
	.title p {
	    font-size: 18px;
	    padding-right: 20px;
	}
	.blue-color{
		background-color: #d4dde3;
	}
	.balance-summary .table th, .balance-summary .table td {
	    text-align: right;
	    border-bottom: unset;
    	border-top: unset;
    	font-size: 15px;
	}
	.company p {
	    font-size: 16px;
	}
	.billing-address p {
	    font-size: 17px;
	}
	.customer-statement-result .table thead th, .customer-statement-result .table tbody td{
		border-top: unset;
	    font-size: 15px;
		padding: 15px;
	}
	.customer-statement-result table thead th:nth-child(3), .customer-statement-result table thead th:nth-child(4),
	.customer-statement-result table tbody td:nth-child(3), .customer-statement-result table tbody td:nth-child(4) {
		text-align: right;
	}
	.customer-statement-result table tbody tr:first-child,.customer-statement-result table tbody tr:last-child {
	    font-weight: 600;
	    background-color: #f3f3f3;
	}
</style>
<div class="customer-statement">
	<div class="statement-container">
		<div class="header">
			<div class="row">
				<div class="col-md-6">
					<div class="company">
						<h5 class="company-name">{{$company->trading_name??''}}</h5>
						<p class="company-address">{{$company->phy_address.', '. $company->phy_city .', '. $company->phy_stase. ', ' . $company->phy_country??''}}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="title">
						<h3>Statement of Account</h3>
						<p>Account Activity</p>
					</div>
				</div>
			</div>
		</div>
		<div class="currency-section-header mt-3">
			<div class="row">
				<div class="col-md-6">
					<div class="billing-address">
						<h5>Bill To</h5>
						<p class="mb-0"><b>{{$customer->display_name}}</b></p>
						<p>{{ $customer->c_street.' '.$customer->c_city. ' '.$customer->c_postal.' '.$customer->c_country }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="balance-summary">
						<table class="table">
							<thead>
								<tr>
									<td>From</td>
									<td>{{$from_date}}</td>
								</tr>
								<tr>
									<td>To</td>
									<td>{{$to_date}}</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Opening balance on {{$from_date}} (RAND)</td>
									<td>R{{ number_format($opening_balance,2 ) }}</td>
								</tr>
								<tr>
									<td>Invoiced</td>
									<td>R{{ number_format($invoiced, 2) }}</td>
								</tr>
								<tr>
									<td>Paid</td>
									<td>R{{ number_format($paid, 2) }}</td>
								</tr>
								<tr>
									<td>Refunded</td>
									<td>R0.00</td>
								</tr>
								<tr class="blue-color">
									<td>Closing Balance on {{$to_date}} (RAND)</td>
									<td>R{{number_format($opening_balance + $invoiced - $paid ,2)}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="customer-statement-result mt-3">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Date</th>
						<th>Item</th>
						<th>Amount</th>
						<th>Balance</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{$from_date}}</td>
						<td>Opening balance</td>
						<td>R{{number_format($opening_balance, 2) }}</td>
						<td>R{{number_format($opening_balance, 2) }}</td>
					</tr>
					@php
						$invoice_counter = $payment_counter = 0;
						$counter1 = count($invoices);
						$counter2 = count($payments);
						$balance = $opening_balance;

					@endphp
					
					@for ($i = 0; $i < $counter1+ $counter2 ; $i++)
						@if($invoice_counter+1 > $counter1 and $payment_counter+1 > $counter2)
							@php break; @endphp

						@elseif($invoice_counter+1 > $counter1 and $payment_counter+1 <= $counter2)
						
							<tr>
								<td>{{$payments[$payment_counter]->pay_date}}</td>
								<td>
									<div>
										Payment made for
										<a href="{{ url('/cubebooks/view-invoice',$payments[$payment_counter]->invoice_id) }}">Invoice # {{$payments[$payment_counter]->invoice_code}}</a><br>
									</div>
								</td>
								<td>(R{{number_format($payments[$payment_counter]->amount, 2) }})</td>
								<td>R{{ number_format($balance - $payments[$payment_counter]->amount, 2) }}</td>
							</tr>
							@php
								$balance = $balance - $payments[$payment_counter]->amount;
							@endphp
							@php
								$payment_counter++;
							@endphp
						@elseif ($invoice_counter+1 <= $counter1 and $payment_counter+1 > $counter2)
							<tr>
								<td>{{ $invoices[$invoice_counter]->invoice_date }}</td>
								<td>
									<div>
										Due {{ $invoices[$invoice_counter]->due_date }}
										<a href="{{ url('view-invoice',$invoices[$invoice_counter]->invoice_id) }}">Invoice # {{ $invoices[$invoice_counter]->invoice_code }}</a><br>
									</div>
								</td>
								<td>R{{ number_format($invoices[$invoice_counter]->final_total, 2) }}</td>
								<td>R{{ number_format( $balance + $invoices[$invoice_counter]->final_total, 2) }}</td>
							</tr>
							@php
								$balance = $balance + $invoices[$invoice_counter]->final_total;
							@endphp
							@php
								$invoice_counter++;
							@endphp
							
						@elseif ($invoice_counter+1 <= $counter1 and $payment_counter+1 <= $counter2)
						
							@if($invoices[$invoice_counter]->invoice_date > 	$payments[$payment_counter]->pay_date)
								<tr>
									<td>{{$payments[$payment_counter]->pay_date}}</td>
									<td>
										<div>
											Payment made for
											<a href="{{ url('/cubebooks/view-invoice',$payments[$payment_counter]->invoice_id) }}">Invoice # {{$payments[$payment_counter]->invoice_code}}</a><br>
										</div>
									</td>
									<td>(R{{ number_format($payments[$payment_counter]->amount , 2 ) }})</td>
									<td>R{{ number_format($balance - $payments[$payment_counter]->amount , 2) }}</td>
								</tr>
								@php
									$balance = $balance - $payments[$payment_counter]->amount;
								@endphp
								@php
									$payment_counter++;
								@endphp
							@elseif($payments[$payment_counter]->pay_date > $invoices[$invoice_counter]->invoice_date )
								<tr>
									<td>{{ $invoices[$invoice_counter]->invoice_date }}</td>
									<td>
										<div>
											Due {{ $invoices[$invoice_counter]->due_date }}
											<a href="{{ url('/cubebooks/view-invoice',$invoices[$invoice_counter]->invoice_id) }}">Invoice # {{ $invoices[$invoice_counter]->invoice_code }}</a><br>
										</div>
									</td>
									<td>R{{ number_format( $invoices[$invoice_counter]->final_total , 2 ) }}</td>
									<td>R{{ number_format( $balance + $invoices[$invoice_counter]->final_total, 2 ) }}</td>
								</tr>
								@php
									$balance = $balance + $invoices[$invoice_counter]->final_total;
								@endphp

								@php
									$invoice_counter++;
								@endphp
							@else

								<tr>
									<td>{{ $invoices[$invoice_counter]->invoice_date }}</td>
									<td>
										<div>
											Due {{ $invoices[$invoice_counter]->due_date }}
											<a href="{{ url('/cubebooks/view-invoice',$invoices[$invoice_counter]->invoice_id) }}">Invoice # {{ $invoices[$invoice_counter]->invoice_code }}</a><br>
										</div>
									</td>
									<td>R{{ number_format( $invoices[$invoice_counter]->final_total , 2 ) }}</td>
									<td>R{{ number_format( $balance + $invoices[$invoice_counter]->final_total , 2 ) }}</td>
								</tr>
								@php
									$balance = $balance + $invoices[$invoice_counter]->final_total;
								@endphp
								<tr>
									<td>{{$payments[$payment_counter]->pay_date}}</td>
									<td>
										<div>
											Payment made for
											<a href="{{ url('/cubebooks/view-invoice',$payments[$payment_counter]->invoice_id) }}">Invoice # {{$payments[$payment_counter]->invoice_code}}</a><br>
										</div>
									</td>
									<td>(R{{ number_format( $payments[$payment_counter]->amount , 2 ) }})</td>
									<td>R{{ number_format( $balance - $payments[$payment_counter]->amount , 2)}}</td>
								</tr>
								@php
									$balance = $balance - $payments[$payment_counter]->amount;
								@endphp
								@php
									$payment_counter++;
									$invoice_counter++;
								@endphp
							@endif
						@endif
					@endfor
					<tr>
						<td>{{$to_date}}</td>
						<td>Closing balance</td>
						<td>R{{ number_format($opening_balance + $invoiced - $paid ,2) }}</td>
						<td>R{{ number_format($opening_balance + $invoiced - $paid , 2) }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>