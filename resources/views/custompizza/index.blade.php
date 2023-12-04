@include('layouts.main')
<!DOCTYPE html>
<html lang="en">
  <body>
	
    <section class="home-slider owl-carousel img" style="background-image: url(images/bg_1.jpg);">
      <div class="slider-item" style="background-image: url(images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Customize A Pizza</h1>
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
                      @foreach ($toppings as $pizzatoppings)
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				{{-- <a href="#" class="menu-img img mb-4" style="background-image: url(images/pizza-1.jpg);"></a> --}}
									      <a href="{{ route('pizzas.show', $pizzatoppings->id) }}"> <img src="{{ asset('storage/'.$pizzatoppings->img_path) }}" class="menu-img img mb-4"> </a>		              				
                        <div class="text">
		              					<h3><a href="#">{{ $pizzatoppings->name }}</a></h3>
		              					<p>{{ $pizzatoppings->description }}</p>
		              					<p class="price"><span>₱ {{ $pizzatoppings->fee }}</span></p>
		              					{{-- <p><a href="#" class="btn btn-white btn-outline-white">Add to cart</a></p> --}}
										        <p><a href="{{ route('custompizza.addToCart', ['id'=>$pizzatoppings->id]) }}" class="btn btn-white btn-outline-white" role="button">Add to Cart</a></p>
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