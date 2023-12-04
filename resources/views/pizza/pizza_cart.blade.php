@extends('partials.master')
@section('title')
    Pizza Rush Cart
@endsection
@section('content')
<br>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family: 'Segoe UI'}
body{background:#0f65dd}

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
            @if(Session::has('cart'))
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<div class="col-xs-3">
                                <a href="{{url('pizzaindex')}}">
								<button type="button" class="btn btn-primary btn-sm btn-block">
									<h4>Add More</h4>
								</button>
                            </a>
							</div>
						</div>
					</div>
				</div>
			
                @foreach($items as $item)
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-2"><img src="{{ asset('storage/'.$item['item']['image']) }}" class="d-block w-100" width="100" height="100" >
						</div>
						<div class="col-xs-4">
							<h3 class="product-name"><strong>{{ $item['item']['name'] }}</strong></h3>
						</div>
						<div class="col-xs-6">
							<div class="col-xs-6 text-right">
								<h4><strong>{{ $item['price'] }} Php<span class="text-muted"></span></strong></h4>
							</div>
							<div class="col-xs-4">
								<input type="number" class="form-control input-sm" value="{{ $item['qty'] }}">
							</div>
							<div class="col-xs-2">
								<a href="{{ route('pizza.remove',['id'=>$item['item']['id']]) }}">
                                    <button type="button" class="btn btn-link btn-xs">
									<span class="glyphicon glyphicon-trash"> </span>
								    </button>
                                </a>
							</div>
						</div>
					</div>
				</div>
				@endforeach

			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<h3>How many slice do you prefer on your pizza?</h3>
						</div>
					</div>
				</div>

				
				<form method="get" action="{{url('pizzacheckout')}}" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="panel-body">
					<div class="row">

						<div class="col-xs-2">
							<div class='card'>
								<h3>4 slice</h3>
								<br>
								<input type="radio" class="option-input radio" id="cut_type" name="cut_type" value="4 slice"/>
								<hr>
							</div>
						</div>

						<div class="col-xs-2">
							<div class='card'>
								<h3>6 slice</h3>
								<br>
								<input type="radio" class="option-input radio" id="cut_type" name="cut_type" value="6 slice"/>
								<hr>
							</div>
						</div>

						<div class="col-xs-2">
							<div class='card'>
								<h3>8 slice</h3>
								<br>
								<input type="radio" class="option-input radio" id="cut_type" name="cut_type" value="8 slice"/>
								<hr>
							</div>
						</div>

						<div class="col-xs-2">
							<div class='card'>
								<h3>12 slice</h3>
								<br>
								<input type="radio" class="option-input radio" id="cut_type" name="cut_type" value="12 slice"/>
								<hr>
							</div>
						</div>

						<div class="col-xs-2">
							<div class='card'>
								<h3>18 slice</h3>
								<br>
								<input type="radio" class="option-input radio" id="cut_type" name="cut_type" value="18 slice"/>
								<hr>
							</div>
						</div>

						<div class="col-xs-2">
							<div class='card'>
								<h3>20 slice</h3>
								<br>
								<input type="radio" class="option-input radio" id="cut_type" name="cut_type" value="20 slice"/>
								<hr>
							</div>
						</div>

					</div>
				</div>
				<hr>

			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<h3>Select Voucher</h3>
						</div>
					</div>
				</div>

		
		<div class="panel-body">

			<div class="row">
				@foreach($vouchers as $voucher)
				
				@if($voucher->status == 'Not Use')
				@if($totalPrice > $maxprice) 
				@if($voucher->limit <= $maxprice )
				<div class="col-xs-6">
					<div class='card'>
						<label for="discount" class="control-label"><h3>{{$voucher->name}}</h3></label>
						<img src="{{ asset('storage/'.$voucher->image) }}"width="200" height="100">
						<br>
						<input type="hidden" class="option-input radio" id="voucher_id" name="voucher_id" value="{{$voucher->id}}" />
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
						<input type="hidden" class="option-input radio" id="voucher_id" name="voucher_id" value="{{$voucher->id}}" />
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
						<input type="hidden" class="option-input radio" id="voucher_id" name="voucher_id" value="{{$voucher->id}}" />
						<input type="radio" class="option-input radio" id="discount" name="discount" value="{{$voucher->value}}" />
						<hr>
					</div>
				</div>
				@else
				@endif

				@endif

				@else
				@if($totalPrice > $maxprice) 
				@if($voucher->limit <= $maxprice )
				<div class="col-xs-6">
					<div class='card'>
						<label for="discount" class="control-label"><h3>{{$voucher->name}}</h3></label>
						<p>This voucher is already used</p>
						<img src="{{ asset('storage/'.$voucher->image) }}"width="200" height="100">
						<br>
						<input type="hidden" class="option-input radio" id="voucher_id" name="voucher_id" value="{{$voucher->id}}" />
						<input disabled type="radio" class="option-input radio" id="discount" name="discount" value="{{$voucher->value}}" />
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
						<p>This voucher is already used</p>
						<img src="{{ asset('storage/'.$voucher->image) }}"width="200" height="100">
						<br>
						<input type="hidden" class="option-input radio" id="voucher_id" name="voucher_id" value="{{$voucher->id}}" />
						<input disabled type="radio" class="option-input radio" id="discount" name="discount" value="{{$voucher->value}}" />
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
						<p>This voucher is already used</p>
						<img src="{{ asset('storage/'.$voucher->image) }}"width="200" height="100">
						<br>
						<input type="hidden" class="option-input radio" id="voucher_id" name="voucher_id" value="{{$voucher->id}}" />
						<input disabled type="radio" class="option-input radio" id="discount" name="discount" value="{{$voucher->value}}" />
						<hr>
					</div>
				</div>
				@else
				@endif

				@endif
				@endif
				@endforeach
				
			</div>
		</div>
			</div>

				<div class="panel-footer">
					<div class="row text-left">
						<div class="col-xs-2">
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
						<div class="col-xs-11" id="tp">
							<h3 class="text-right"><strong>Total: {{ $totalPrice }} php</strong></h3>
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
                                <a href="{{url('pizzaindex')}}">
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
	
@endsection
