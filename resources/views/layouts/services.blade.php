@include('layouts.main')
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Pizza - Free Bootstrap 4 Template by Colorlib</title>
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
            	<h1 class="mb-3 mt-5 bread">Services</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Services</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>
    

    <section class="ftco-section ftco-services">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">Our Services</h2>
            <p>Experience the best of all worlds with our services that offer healthy food options, customizable pizzas, and original recipes.</p>
          </div>
        </div>
    		<div class="row">
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-5">
              	<span class="flaticon-diet"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Healthy Foods</h3>
                <p>Eating healthy foods is essential for maintaining a strong and vibrant body.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-5">
              	<span class="flaticon-bicycle"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Customize a Pizza</h3>
                <p>"Create the pizza of your dreams with our customizable options!"</p>
              </div>
            </div>      
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-5"><span class="flaticon-pizza-1"></span></div>
              <div class="media-body">
                <h3 class="heading">Original Recipes</h3>
                <p>Savor the delicious flavors of our dishes that are crafted using our secret original recipes!</p>
              </div>
            </div>    
          </div>
        </div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">Hot Meals</h2>
            <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
            <p class="mt-5">Indulge in our mouthwatering pizza hot meals that are sure to satisfy your cravings and warm your soul.</p>
          </div>
        </div>
        
    		<div class="row">
                @foreach($pizza as $pizzas)
    		    <div class="col-md-3 text-center ftco-animate">
      			<div class="menu-wrap">
                    <img src="{{ asset('storage/'.$pizzas->image) }}"class="menu-img img mb-4">
      				<div class="text">
      					<h3><a href="#">{{ $pizzas->name }}</a></h3>
      					<p>{{ $pizzas->description }}</p>
      				</div>
      			</div>
      		    </div>
                @endforeach 
    		</div>
            
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">Customize a Pizza</h2>
            <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
            <p class="mt-5">Unleash your creativity and build the pizza of your dreams with our wide selection of toppings and crust options to customize your perfect pizza.</p>
          </div>
        </div>
        <br>
        <div style="text-align: center">
        <h2 class="mb-4">Pizza Crust</h2>
        </div>
        <div class="row">
            @foreach($crust as $crusts)
            <div class="col-md-3 text-center ftco-animate">
              <div class="menu-wrap">
                <img src="{{ asset('storage/'.$crusts->image) }}"class="menu-img img mb-4">
                  <div class="text">
                      <h3><a href="#">{{ $crusts->name }}</a></h3>
                      <p>{{ $crusts->description }}</p>
                  </div>
              </div>
              </div>
            @endforeach 
        </div>
        <br>
        <div style="text-align: center">
            <h2 class="mb-4">Pizza Toppings</h2>
            </div>
        <div class="row">
            @foreach($toppings as $topping)
            <div class="col-md-3 text-center ftco-animate">
              <div class="menu-wrap">
                <img src="{{ asset('storage/'.$topping->img_path) }}"class="menu-img img mb-4">
                  <div class="text">
                      <h3><a href="#">{{ $topping->name }}</a></h3>
                      <p>{{ $topping->description }}</p>
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