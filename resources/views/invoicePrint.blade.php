<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>DH</title>
		<link rel="stylesheet" href="{{ asset('/css/stylesheet.css') }}"/>
    	<link rel="stylesheet" href="{{ asset('/css/b.css') }}"/>
	</head>
	<body>
		<div class="container-fluid invoice-container">
		<header>
			<div class="row align-items-center">
				<div class="col-sm-7 text-center text-sm-left mb-3 mb-sm-0">
					<img id="logo" style="width: 150px; height: 150px;" src="{{asset('/assets/logo/logo.png') }}" title="Koice" alt="DH" />
				</div>
				<div class="col-sm-5 text-center text-sm-right">
					<h4 class="text-7 mb-0">Invoice</h4>
				</div>
			</div>
			<hr>
		</header>
		
		<main>
			<div class="row">
				<div class="col-sm-6"><strong>Date:</strong> {{ date('Y-m-d') }}</div>
				<div class="col-sm-6 text-sm-right"> <strong>Invoice No:</strong> {{ $orders->id }}</div>
				
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-6 text-sm-right order-sm-1"> <strong>Pay To:</strong>
					<address>
						{{ $orders->cust_name }}<br>
						{{ $orders->cust_address }}
					</address>
				</div>
				<div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
					<address>
						Md.Admin<br />
						Dhaka<br />
						Shop #102<br />
						Dhaka
					</address>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h5 class="text-center" style="color: red">Don't Lose your Invoice. It Will need in future</h5>
				</div>
				<div class="card-body  px-2">
					<table class="table">
						<thead>
							<tr style="width: 100px">
								<th scope="col">#</th>
								<th scope="col">Item Number</th>
								<th scope="col">Item name</th>
								<th scope="col">Quantity</th>
								<th scope="col">Price</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach($ordersDetail as $orderDetail)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $orderDetail->item_number  }}</td>
								<td>{{ $orderDetail->item_name }}</td>
								<td>{{ $orderDetail->quantity }}</td>
								<td>{{ $orderDetail->price }}</td>
								<td>{{ $orderDetail->product_total }}</td>
							</tr>
						@endforeach
							<tr>
								<td colspan="6" class="bg-light-2 text-right"><strong>Sub Total : </strong></td>
								<td class="bg-light-2 text-right">{{ $orders->sub_total }}</td>
							</tr>
							<tr>
								<td colspan="6" class="bg-light-2 text-right"><strong>Discoutn Type : </strong><strong>Percentage Rate</strong></td>
								<td class="bg-light-2 text-right">{{ $orders->tax_rate }}</td>
							</tr>
							<tr>
								<td colspan="6" class="bg-light-2 text-right"><strong>Tax Total : </strong></td>
								<td class="bg-light-2 text-right">{{ $orders->tax_ammount }}</td>
							</tr>
							<tr>
								<td colspan="6" class="bg-light-2 text-right"><strong>Total : </strong></td>
								<td class="bg-light-2 text-right">{{ $orders->total }}</td>
							</tr>
							<tr>
								<td>Date:</td>
								<td colspan="3">{{ date('d-m-Y', strtotime($orders->created_at)) }}</td>
								<td colspan="2" class="bg-light-2 text-right"><strong>Paid : </strong></td>
								<td class="bg-light-2 text-right">{{ $orders->ammount_paid  }}</td>
							</tr>
							<tr>
								<td colspan="6" class="bg-light-2 text-right"><strong>Due : </strong></td>
								<td class="bg-light-2 text-right">{{ $orders->ammount_due }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</main>
		<footer class="text-center mt-4">
			<p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p>
			<div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a> <a href="" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-download"></i> Download</a> </div>
		</footer>
	</div>
	</body>
	<script type="text/javascript">
		// window.print()
	</script>
</html>
