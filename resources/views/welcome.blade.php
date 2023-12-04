@include('layouts.main')
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Pizza - Free Bootstrap 4 Template by Colorlib</title>
  </head>
  <body>
  	
    <section class="home-slider owl-carousel img" style="background-image: url(images/bg_1.jpg);">
	@foreach($bestseller as $pizzass)
      <div class="slider-item">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center" data-scrollax-parent="true">

            <div class="col-md-6 col-sm-12 ftco-animate">
            	<span class="subheading">Best Seller Pizza</span>
              <h1 class="mb-4">{{ $pizzass->name }}</h1>
			  <p>
				@if (isset($pizzass))	
						 @if($pizzass->rating=='5')
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i> 
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i> 
					  @elseif($pizzass->rating=='4')
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  @elseif($pizzass->rating=='3')
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  @elseif($pizzass->rating=='2')
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  @elseif($pizzass->rating=='1')
					  <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  @else
					  <i class="fa fa-star" style="font-size:24px"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
					  <i class="fa fa-star" style="font-size:24px"></i>
				@endif
				@else
				@endif
				</p>
              <p class="mb-4 mb-md-5">{{ $pizzass->description }}</p>
              <p>
				<a href="{{ url('pizzaindex') }}" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> 
				<a href="{{ route('pizza.addToCart', ['id'=>$pizzass->id]) }}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a>
			  </p>
            </div>
            <div class="col-md-6 ftco-animate">
				<img src="{{ asset('storage/'.$pizzass->image) }}" class="menu-img img mb-6">
            </div>
          </div>
        </div>
      </div>
	  @endforeach
    </section>

	<section class="ftco-intro">
    	<div class="container-wrap">
    		<div class="wrap d-md-flex">
	    		<div class="info">
	    			<div class="row no-gutters">
	    				<div class="col-md-4 d-flex ftco-animate">
	    					<div class="icon"><span class="icon-phone"></span></div>
	    					<div class="text">
	    						<h3>000 (123) 456 7890</h3>
	    						<p>A small pizza shop named Pizza Rush</p>
	    					</div>
	    				</div>
	    				<div class="col-md-4 d-flex ftco-animate">
	    					<div class="icon"><span class="icon-my_location"></span></div>
	    					<div class="text">
	    						<h3>198 West 21th Street</h3>
	    						<p>Suite 721 Philippines 10016</p>
	    					</div>
	    				</div>
	    				<div class="col-md-4 d-flex ftco-animate">
	    					<div class="icon"><span class="icon-clock-o"></span></div>
	    					<div class="text">
	    						<h3>Open Monday-Friday</h3>
	    						<p>8:00am - 10:00pm</p>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="social d-md-flex pl-md-5 p-4 align-items-center">
	    			<ul class="social-icon">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
	    		</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-about d-md-flex">
    	<div class="one-half img" style="background-image: url(images/about.jpg);"></div>
    	<div class="one-half ftco-animate">
        <div class="heading-section ftco-animate ">
          <h2 class="mb-4">Welcome to <span class="flaticon-pizza">PizzaRush</span> A Restaurant</h2>
        </div>
        <div>
			<p>where we pride ourselves on serving the best quality pizza in town, made with the freshest and finest ingredients available. From the moment you step inside, you'll be greeted with a warm smile and invited to take a seat in our inviting and comfortable dining area.</p>
			<p>Our menu features a wide selection of classic and specialty pizzas, with something to satisfy every craving and taste bud. Whether you prefer a simple Margherita pizza or something a little more adventurous, like our bacon and egg pizza, we've got you covered.</p>
  			</div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">Hot Pizza Meals</h2>
			<p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
            <p>Indulge in our mouthwatering pizza hot meals that are sure to satisfy your cravings and warm your soul.</p>
          </div>
        </div>
    	</div>
    	<div class="container-wrap">
    		<div class="row no-gutters d-flex">
				@foreach($pizza as $pizzas)
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="services-wrap d-flex">
    					<img src="{{ asset('storage/'.$pizzas->image) }}"width="350" height="250">
    					<div class="text p-4">
    						<h3>{{ $pizzas->name }}</h3>
    						<p>{{ $pizzas->description }}</p>
    						<a href="{{ route('pizzas.show', $pizzas->id) }}"><button class="btn btn-white btn-outline-white">Read More</button></a>
						</div>
						<br>
    				</div>
    			</div>
				@endforeach
    		</div>
    	</div>

    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3 mt-5 pt-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">Our Menu Pricing</h2>
            <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
            <p class="mt-5">Introducing new pizza menu pricing requires careful consideration of market trends, ingredient costs, and consumer demand to ensure that it is both competitive and profitable.</p>
          </div>
        </div>
        <div class="row">
        	<div class="row justify-content-center mb-5 pb-3 mt-5 pt-5">
				@foreach($pizza as $pizzasss)
        		<div class="pricing-entry d-flex ftco-animate">
        			<img src="{{ asset('storage/'.$pizzasss->image) }}" class="img">
					<div class="desc pl-3">
	        			<div class="d-flex text align-items-center">
	        				<h3><span>{{ $pizzasss->name }}</span></h3>
	        				<span class="price">₱ {{ $pizzasss->fee }}</span>
	        			</div>
	        			<div class="d-block">
	        				<p>{{ $pizzasss->description }}</p>
	        			</div>
	        		</div>
        		</div>
				@endforeach
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
		          <div class="col-md-12 nav-link-wrap mb-5">
		            <div class="nav ftco-animate nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		              <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Pizza</a>

		              <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Crust</a>

		              <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Toppings</a>
		            </div>
		          </div>
		          <div class="col-md-12 d-flex align-items-center">
		            
		            <div class="tab-content ftco-animate" id="v-pills-tabContent">

		              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
		              	<div class="row">
							@foreach($pizza as $pizza4)
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
									<<img src="{{ asset('storage/'.$pizza4->image) }}" class="menu-img img mb-4">
		              				<div class="text">
		              					<h3><a href="#">{{ $pizza4->name }}</a></h3>
		              					<p>{{ $pizza4->description }}</p>
		              					<p class="price"><span>₱ {{ $pizza4->fee }}</span></p>
		              				</div>
		              			</div>
		              		</div>
							  @endforeach
		              	</div>
		              </div>

		              <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
		                <div class="row">
							@foreach($crust as $crusts)
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				<<img src="{{ asset('storage/'.$crusts->image) }}" class="menu-img img mb-4">
		              				<div class="text">
		              					<h3><a href="#">{{ $crusts->name }}</a></h3>
		              					<p>{{ $crusts->description }}</p>
		              					<p class="price"><span>₱ {{ $crusts->fee }}</span></p>
		              				</div>
		              			</div>
		              		</div>
							@endforeach
		              	</div>
		              </div>

		              <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
		                <div class="row">
							@foreach($toppings as $topping)
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
									<img src="{{ asset('storage/'.$topping->img_path) }}" class="menu-img img mb-4">
		              				<div class="text">
		              					<h3><a href="#">{{ $topping->name }}</a></h3>
		              					<p>{{ $topping->description }}</p>
		              					<p class="price"><span>₱ {{ $topping->fee }}</span></p>
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
		    </div>
    	</div>
    </section>

	<section class="ftco-gallery">
    	<div class="container-wrap">
    		<div class="row no-gutters">
					<div class="col-md-3 ftco-animate">
						<a href="#" class="gallery img d-flex align-items-center" style="background-image: url(images/gallery-1.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-search"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-3 ftco-animate">
						<a href="#" class="gallery img d-flex align-items-center" style="background-image: url(images/gallery-2.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-search"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-3 ftco-animate">
						<a href="#" class="gallery img d-flex align-items-center" style="background-image: url(images/gallery-3.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-search"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-3 ftco-animate">
						<a href="#" class="gallery img d-flex align-items-center" style="background-image: url(images/gallery-4.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-search"></span>
    					</div>
						</a>
					</div>
        </div>
    	</div>
    </section>
  
  </body>
</html>
@include('layouts.footer')