@include('layouts.main')
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>

    <section class="home-slider owl-carousel img" style="background-image: url(images/bg_1.jpg);">

      <div class="slider-item" style="background-image: url(images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">About</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>About</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>
    
    <section class="ftco-about d-md-flex">
    	<div class="one-half img" style="background-image: url(images/about.jpg);"></div>
    	<div class="one-half ftco-animate">
        <div class="heading-section ftco-animate ">
          <h2 class="mb-4">Welcome to <span class="flaticon-pizza">PizzaRush</span> Restaurant</h2>
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
            <h2 class="mb-4">Our Staff</h2>
            <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
            <p class="mt-5">Allow us to introduce our friendly and knowledgeable staff, who are always ready to assist you with any questions or recommendations to make your shopping experience a pleasant one.</p>
          </div>
        </div>
        <div class="row">
          @foreach($employee as $employees)
          <div class="col-lg-3 d-flex mb-sm-4 ftco-animate">
              <div class="staff">
                <div class="img mb-3"><img src="{{ asset('storage/'.$employees->image) }}" class="menu-img img mb-3"></div>
                <div class="info text-center">
                  <h3><a href="teacher-single.html">{{ $employees->name }}</a></h3>
                  <span class="position">{{ $employees->role }}</span>
                  <div class="text">
                    <p>{{ $employees->email }}</p>
                  </div>
                </div>
              </div>
          </div>
        	@endforeach
        </div>
      </div>
    </section>
  
  </body>
</html>
@include('layouts.footer')