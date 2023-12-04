<style>
    body{margin-top:20px;
background:#eee;
}

/*Invoice*/
.invoice .top-left {
    font-size:65px;
	color:#3ba0ff;
}

.invoice .top-right {
	text-align:right;
	padding-right:20px;
}

.invoice .table-row {
	margin-left:-15px;
	margin-right:-15px;
	margin-top:25px;
}

.invoice .payment-info {
	font-weight:500;
}

.invoice .table-row .table>thead {
	border-top:1px solid #ddd;
}

.invoice .table-row .table>thead>tr>th {
	border-bottom:none;
}

.invoice .table>tbody>tr>td {
	padding:8px 20px;
}

.invoice .invoice-total {
	margin-right:-10px;
	font-size:16px;
}

.invoice .last-row {
	border-bottom:1px solid #ddd;
}

.invoice-ribbon {
	width:85px;
	height:88px;
	overflow:hidden;
	position:absolute;
	top:-1px;
	right:14px;
}

.ribbon-inner {
	text-align:center;
	-webkit-transform:rotate(45deg);
	-moz-transform:rotate(45deg);
	-ms-transform:rotate(45deg);
	-o-transform:rotate(45deg);
	position:relative;
	padding:7px 0;
	left:-5px;
	top:11px;
	width:120px;
	background-color:#66c591;
	font-size:15px;
	color:#fff;
}

.ribbon-inner:before,.ribbon-inner:after {
	content:"";
	position:absolute;
}

.ribbon-inner:before {
	left:0;
}

.ribbon-inner:after {
	right:0;
}

@media(max-width:575px) {
	.invoice .top-left,.invoice .top-right,.invoice .payment-details {
		text-align:center;
	}

	.invoice .from,.invoice .to,.invoice .payment-details {
		float:none;
		width:100%;
		text-align:center;
		margin-bottom:25px;
	}

	.invoice p.lead,.invoice .from p.lead,.invoice .to p.lead,.invoice .payment-details p.lead {
		font-size:22px;
	}

	.invoice .btn {
		margin-top:10px;
	}
}

@media print {
	.invoice {
		width:900px;
		height:800px;
	}
}
</style>   

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets bootdeys">
<div class="row">
  <div class="col-sm-12">
	  	<div class="panel panel-default invoice" id="invoice">
		  <div class="panel-body">
			<div class="invoice-ribbon"><div class="ribbon-inner">PAID</div></div>
		    <div class="row">

				<div class="col-sm-6 top-left">
					<i class="fa fa-pizza-slice"></i>
				</div>

				<div class="col-sm-6 top-center">
						<h3 class="text-left">ORDER SUMMARY</h3>
						<span class="text-left">{{$data['ordered_date']}}</span>
			    </div>

			</div>
			<hr>
			<div class="row">

				<div class="col-xs-4 from">
					<p class="lead marginbottom">To : {{$data['name']}}</p>
					<p>Address: {{$data['address']}}</p>
					<p>Gender: {{$data['gender']}}</p>
					<p>Phone: {{$data['phone']}}</p>
					<p>Email: {{$data['email']}}</p>
				</div>

			</div>

			<div class="row table-row">
				<table class="table table-striped">
			      <thead>
			        <tr>
			          <th class="text-right" style="width:25%">#</th>
			          <th class="text-right" style="width:25%">Item</th>
			          <th class="text-right" style="width:25%">Quantity</th>
			          <th class="text-right" style="width:25%">Item Price</th>
			        </tr>
			      </thead>
			      <tbody>
                    @foreach($data['pizza'] as $pizza)
			        <tr>
			          <td class="text-right" class="col-xs-2" >{{$pizza->id}}</td>
			          <td class="text-right" class="col-xs-2" >{{$pizza->name}}</td>
			          <td class="text-right" class="col-xs-2" >{{$pizza->quantity}}</td>
			          <td class="text-right"  class="col-xs-2">{{$pizza->fee}} Php</td>
			        </tr>
                    @endforeach
			       </tbody>
			    </table>
			</div>

			<div class="row">
			<div class="col-xs-6 margintop">
				<p class="lead marginbottom">THANK YOU!</p>

				<button class="btn btn-success" id="invoice-print"><i class="fa fa-print"></i> Print Invoice</button>
				<button class="btn btn-danger"><i class="fa fa-envelope-o"></i> Mail Invoice</button>
			</div>
			<div class="col-xs-6 text-right pull-right invoice-total">
					  <p>Subtotal : {{$data['sub_total']}} Php</p>
			          <p>Discount : {{$data['discount']}} Php</p>
			          <p>Total : {{$data['grand_price']}} Php</p>
			</div>
			</div>

		  </div>
		</div>
	</div>
</div>
</div>