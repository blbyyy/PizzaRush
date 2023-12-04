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
            	<h1 class="mb-3 mt-5 bread">What's new in our shop</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>What's New</span></p>
            </div>

          </div>
        </div>
      </div>
      
    </section>
    

    <section class="ftco-section">
      <div class="container">

        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">What's New</h2>
            <p>There's always something new in our shop, whether it's a fresh batch of baked goods, a new seasonal menu item, or a limited edition product that you won't find anywhere else.</p>
          </div>
        </div>

        <div class="row d-flex">
          @foreach($announce as $announcement)
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry align-self-stretch">
                <img src="{{ asset('storage/'.$announcement->image) }}" width="350" height="250" >
              <div class="text py-4 d-block">
                <h3 class="heading mt-2">{{ $announcement->title }}</h3>
                <p>{{$announcement->info}}</p>
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