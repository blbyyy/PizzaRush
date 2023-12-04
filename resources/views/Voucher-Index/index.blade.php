@include('layouts.main')

  <head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>

  <style>
button {
  display: inline-block;
  padding: 3px 13px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: rgb(238, 77, 45);
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: rgb(238, 77, 45)}

.button:active {
  background-color: rgb(238, 77, 45);
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
/* Custom style to set icon size */
.alert i[class^="bi-"]{
  font-size: 1.5em;
  line-height: 1;
}
</style>

<body>

    <section class="home-slider owl-carousel img" style="background-image: url(images/bg_1.jpg);">
      <div class="slider-item" style="background-image: url(images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Vouchers</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Vouchers</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">Our Vouchers</h2>
            <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
            
            <div>
              <br />
              @if ( Session::has('success'))
                <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                  <i class="bi-check-circle-fill"></i>
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  <p>{{ Session::get('success') }}</p>
                </div><br />
               @endif
            </div>
          </div>
        </div>
        <div class="row">

     
@foreach($vouchers as $voucher)
@if($voucher->status == 'Available')
<div class="col-lg-3 d-flex mb-sm-4 ftco-animate">
<form enctype="multipart/form-data" method="POST" action="{{url('claim')}}">
  {{csrf_field()}}
        		<div class="staff">
              <img src="{{ asset('storage/'.$voucher->image) }}" class="d-block w-100"  >
              <textarea hidden="hidden" id="voucher_id" name="voucher_id" class="title">{{ $voucher->id }}</textarea>
      				<div class="info text-center">
      					<h3>{{ $voucher->name }}</h3>
      					<span class="position">{{ $voucher->description }}</span>
      					<div class="text">
	        				<button type="submit" class="btn btn-white btn-outline-white">Claim</button>
	        			</div>
      				</div>
        		</div>
</form>
</div>
@else
<div class="col-lg-3 d-flex mb-sm-4 ftco-animate">
  <form enctype="multipart/form-data" method="POST" action="{{url('claim')}}">
    {{csrf_field()}}
              <div class="staff">
                <img src="{{ asset('storage/'.$voucher->image) }}" class="d-block w-100"  >
                <textarea hidden="hidden" id="voucher_id" name="voucher_id" class="title">{{ $voucher->id }}</textarea>
                <div class="info text-center">
                  <h3>{{ $voucher->name }}</h3>
                  <span class="position">{{ $voucher->description }}</span>
                  <div class="text">
                    <button disabled type="submit" class="btn btn-white btn-outline-white">Not Available</button>
                  </div>
                </div>
              </div>
  </form>
  </div>
@endif
@endforeach

        </div>
      </div>
    </section>

</body>

@include('layouts.footer')