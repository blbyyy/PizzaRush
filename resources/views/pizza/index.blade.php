@include('layouts.main')
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

  <body>
    <section class="home-slider owl-carousel img" style="background-image: url(images/bg_1.jpg);">
      <div class="slider-item" style="background-image: url(images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Our Menu</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Menu</span></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-menu">
    	<div class="container-fluid">
    		<div class="row d-md-flex">
	    		<div class="col-lg-4 ftco-animate img f-menu-img mb-5 mb-md-0" style="background-image: url(images/about.jpg);">
	    		</div>
	    		<div class="col-lg-8 ftco-animate p-md-5">
		    		<div class="row">
		          <div class="col-md-12 d-flex align-items-center">		            
		            <div class="tab-content ftco-animate" id="v-pills-tabContent">
		              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
		              	<div class="row">
							
						@foreach ($pizza as $pizza)
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
									  	<img src="{{ asset('storage/'.$pizza->image) }}" class="menu-img img mb-4">            				
									<div class="text">
		              					<h3><a href="#">{{ $pizza->name }}</a></h3>
		              					<p>{{ $pizza->description }}</p>
		              					<p class="price"><span>₱ {{ $pizza->fee }}</span></p>
										{{-- <p class="price"><span>₱ {{ $pizza->rating }}</span></p> --}}
										<p><a href="{{ route('pizza.addToCart', ['id'=>$pizza->id]) }}" class="btn btn-white btn-outline-white" role="button">Add to Cart</a></p>
		              				</div>
		              			</div>
		              		</div>
						@endforeach
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
    	</div>
    </section>  

  </body>
</html>
@include('layouts.footer')