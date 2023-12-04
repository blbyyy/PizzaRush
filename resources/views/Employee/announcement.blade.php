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
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>

        <div class="row d-flex">
          @foreach($announcement as $announcement)
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

    <section class="ftco-section contact-section">
      <div class="container mt-5">
        <div class="row block-5">

          <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
              <h2 class="mb-4">Create Post</h2>
            </div>
          </div>
					
					<div class="col-md-1"></div>

          <div class="col-md-6 ftco-animate">
            <form enctype="multipart/form-data" method="POST" action="{{url('announcementcreate')}}">
              {{csrf_field()}}   
            	<div class="row">
            		<div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" class="form-control" id="title" name="title" placeholder="Post Title">
	                </div>
                </div>
              </div>

              <div class="form-group">
                <textarea id="info" name="info" cols="100" rows="5" class="form-control" placeholder="Post Desription"></textarea>
              </div>

              <div class="form-group">
                <label for="image" class="control-label" id="limage">Post Image:</label>
                <input type="file" class="form-control" id="image" name="image">
              </div>

              <div class="form-group">
                <input type="submit" value="Post" class="btn btn-primary py-2 px-4">
              </div>
            </form>
          </div>
        </form>

        </div>
      </div>
    </section>


 

  </body>
</html>
@include('layouts.footer')