@extends('partials.master')
@section('title')
    Pizza Rush Cart
@endsection
@section('content')
<br>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins'}
body{background:#edf2f9}
.content{
  margin: auto;
  padding: 15px;
  max-width: 800px;
  text-align: center;
}
.dpx{
  display:flex;
  align-items:center;
  justify-content:space-around;
}
h1{
  font-size:28px;
  line-height:28px;
  margin-bottom:15px;
}
label{
  display:block;
  line-height:40px;
}
.option-input {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
  position: relative;
  top: 13.33333px;
  right: 0;
  bottom: 0;
  left: 0;
  height: 40px;
  width: 40px;
  transition: all 0.15s ease-out 0s;
  background: #cbd1d8;
  border: none;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  margin-right: 0.5rem;
  outline: none;
  position: relative;
  z-index: 1000;
}
.option-input:hover {
  background: #9faab7;
}
.option-input:checked {
  background: #40e0d0;
}
.option-input:checked::before {
  width: 40px;
  height: 40px;
  display:flex;
  content: '\f00c';
  font-size: 25px;
  font-weight:bold;
  position: absolute;
  align-items:center;
  justify-content:center;
  font-family:'Font Awesome 5 Free';
}
.option-input:checked::after {
  -webkit-animation: click-wave 0.65s;
  -moz-animation: click-wave 0.65s;
  animation: click-wave 0.65s;
  background: #40e0d0;
  content: '';
  display: block;
  position: relative;
  z-index: 100;
}
.option-input.radio {
  border-radius: 50%;
}
.option-input.radio::after {
  border-radius: 50%;
}

@keyframes click-wave {
  0% {
    height: 40px;
    width: 40px;
    opacity: 0.35;
    position: relative;
  }
  100% {
    height: 200px;
    width: 200px;
    margin-left: -80px;
    margin-top: -80px;
    opacity: 0;
  }
}
</style>
<div class="container" align="center">
	<div class="row">
            @if(Session::has('custompizzacart'))
			
			<div class="panel-title">
				<div class="row">
					<div class="col-xs-3">
						<a href="{{url('custompizza')}}">
						<button type="button" class="btn btn-primary btn-sm btn-block">
							<h4>Add more</h4>
						</button>
					</a>
					</div>
				</div>
			</div>
			<hr>

			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
                        <div class="panel-title">
                            <div class="row">
                                <h3>List of Toppings that you choose</h3>
							</div>
                        </div>
					</div>
				</div>
				
                @foreach($items as $item)
				<div class="panel-body">
					<hr>
					<div class="row">
						<div class="col-xs-3"><img src="{{ asset('storage/'.$item['item']['img_path']) }}" width="200" height="100" >
						</div>
						<div class="col-xs-4">
							<h3 class="product-name">{{ $item['item']['name'] }}</h3>
						</div>
						<div class="col-xs-4">
							<div class="col-xs-6 text-right">
								<h3>₱ {{ $item['price'] }}<span class="text-muted"></span></h3>
							</div>
							{{-- <div class="col-xs-4">
								<input type="text" class="form-control input-sm" value="{{ $item['qty'] }}">
							</div> --}}
							<br>
							<div class="col-xs-6">
								<a href="{{ route('custompizza.remove',['id'=>$item['item']['id']]) }}">
                                    <button type="button" class="btn btn-link btn-xs">
										<span class="glyphicon glyphicon-trash"></span>
									</button>
								</a>	
							</div>
						</div>
						
					</div>
				</div>
				<hr>
				@endforeach

			<div class="panel panel-info">
				
				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<h3>Choose your prefer pizza crust</h3>
						</div>
					</div>
				</div>

				
				<form method="get" action="{{url('custompizzacheckout')}}" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="panel-body">
					<div class="row">
				@foreach($pizzacrust as $crust)
				<div class="col-xs-6">
					<div class='card'>
						<h3>{{$crust->name}} (₱ {{$crust->fee}})</h3>
						<img src="{{ asset('storage/'.$crust->image) }}"width="200" height="100">
						<br>
						<h5>{{$crust->description}}</h5>
						<input type="radio" class="option-input radio" id="pizzacrust" name="pizzacrust" value="{{$crust->id}}" />
						<hr>
					</div>
				</div>
				@endforeach
					</div>
				</div>
				<hr>

			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<h3>Your Available Voucher(s)</h3>
						</div>
					</div>
				</div>

		<hr>
		<div class="panel-body">
			<div class="row">
				@foreach($vouchers as $voucher)
				@if($totalPrice > $maxprice) 
				@if($voucher->limit <= $maxprice )
				<div class="col-xs-6">
					<div class='card'>
						<label for="discount" class="control-label"><h3>{{$voucher->name}}</h3></label>
						<img src="{{ asset('storage/'.$voucher->image) }}"width="200" height="100">
						<br>
						<input type="radio" class="option-input radio" id="discount" name="discount" value="{{$voucher->value}}" />
						<hr>
					</div>
				</div>
				@else
				@endif

				@elseif($totalPrice < $minprice)
				@if($voucher->limit <= $minprice)
				<div class="col-xs-6">
					<div class='card'>
						<label for="discount" class="control-label"><h3>{{$voucher->name}}</h3></label>
						<img src="{{ asset('storage/'.$voucher->image) }}"width="200" height="100">
						<br>
						<input type="radio" class="option-input radio" id="discount" name="discount" value="{{$voucher->value}}" />
						<hr>
					</div>
				</div>
				@else
				@endif
				@elseif($totalPrice <= 999)
				@if($voucher->limit <= $minprice)
				<div class="col-xs-6">
					<div class='card'>
						<label for="discount" class="control-label"><h3>{{$voucher->name}}</h3></label>
						<img src="{{ asset('storage/'.$voucher->image) }}"width="200" height="100">
						<br>
						<input type="radio" class="option-input radio" id="discount" name="discount" value="{{$voucher->value}}" />
						<hr>
					</div>
				</div>
				@else
				@endif
				@endif
				@endforeach
			</div>
		</div>
		<hr>
				<div class="panel-footer">
					<div class="row text-center">
						<div class="col-xs-3">
								<a>
									<button type="submit" class="btn btn-success btn-block">
										<h5>Checkout</h5>
									</button>
								</a>
						</div>
							
					</div>
				</div>
			</form>
		</div>

				<div class="panel-footer">
					<div class="row text-center">
						<div class="col-xs-11">
							<h3 class="text-right"><strong>Total: ₱ {{ $totalPrice }}</strong></h3>
						</div>
					</div>
				</div>
				
			</div>
		
            @else
            <div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<div class="col-xs-6">
								<h5><span class="glyphicon glyphicon-shopping-cart"></span> Your Cart</h5>
							</div>
							<div class="col-xs-6">
                                <a href="{{url('custompizza')}}">
								<button type="button" class="btn btn-primary btn-sm btn-block">
									<span class="glyphicon glyphicon-share-alt"></span> Go to menu
								</button>
                            </a>
							</div>
						</div>
					</div>
				</div>

				<div class="panel-body">
					<h2>Your cart is empty</h2>
				</div>
               
				<div class="panel-footer">
					
				</div>
			</div>
            @endif
		</div>
	</div>

{{-- <div class="container" align="center">
	<div class="row">
		<div class="panel panel-info">
	
		<div class="panel-heading">
			<div class="panel-title">
				<div class="row">
					<h3>Your Available Vouchers</h3>
				</div>
			</div>
		</div>
		@foreach($vouchers as $voucher)
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-2">
					<label for="discount" class="control-label">{{$voucher->title}}</label>
					
					<input type="checkbox" class="option-input checkbox" id="discount" name="discount" value="{{$voucher->value}}"/>
				</div>
			</div>
		</div>
		@endforeach
	
		<div class="panel-footer">
			<div class="row text-center">
				
			</div>
		</div>
	
	</div>
	</div>
	</div> --}}
	
@endsection