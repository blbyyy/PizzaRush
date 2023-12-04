@include('layouts.main')
<style>
  body {
  		background: #FDFDFD;
			font-family: "Segoe WP","Segoe UI", Helvetica, Arial, sans-serif;
			text-align:center;
		}
		h1, h2 {
			color: #888;
			margin:0;
			font-weight:normal;
		}
		h1{ padding-top: 1.5em; padding-bottom: 2em; } 
		h2 {
			clear:both;
			color: #aaa;
			padding: 2em 0 0.3em
		}
		em {
			display: block;
			margin: .5em auto 2em;
			color: #bbb;
		}

		p, p a { 
			color: #aaa;
			text-decoration: none;
		}
		p a:hover,
		p a:focus {
			text-decoration: underline;
		}
		p + p { color: #bbb; margin-top: 2em;}
		.detail {position: absolute; text-align: right; right: 5px; bottom: 5px; width: 50%;}
		
		a[href*="intent"] {
			display:inline-block;
			margin-top: 0.4em;
		}

		/*  
		 * Rating styles
		 */
		.rating {
			width: 226px;
			margin: 0 auto 1em;
			font-size: 45px;
			overflow:hidden;
		}
.rating input {
  float: right;
  opacity: 0;
  position: absolute;
}
		.rating a,
    .rating label {
			float:right;
			color: #aaa;
			text-decoration: none;
			-webkit-transition: color .4s;
			-moz-transition: color .4s;
			-o-transition: color .4s;
			transition: color .4s;
		}
.rating label:hover ~ label,
.rating input:focus ~ label,
.rating label:hover,
		.rating a:hover,
		.rating a:hover ~ a,
		.rating a:focus,
		.rating a:focus ~ a		{
			color: orange;
			cursor: pointer;
		}
		.rating2 {
			direction: rtl;
		}
		.rating2 a {
			float:none
		}
</style>
<!DOCTYPE html>
<html lang="en">
  
  <body>

    <section class="home-slider owl-carousel img" style="background-image: url(images/bg_1.jpg);">
      <div class="slider-item" style="background-image: url(images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">About the Pizza</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span class="mr-2"><a href="{{ url('/pizzaindex') }}">Menu</a></span></p>
            </div>

          </div>
        </div>
      </div>
    </section>
    {{-- @if (isset($pizza)) --}}
    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ftco-animate">
            <h2 class="mb-3">{{$pizzass->name}}</h2>
            <p><img src="{{ asset('storage/'.$pizzass->image) }}" alt="" class="img-fluid"></p>
            @if (isset($pizza))
            @if($pizza->rating=='5')
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i> 
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i> 
                    @elseif($pizza->rating=='4')
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    @elseif($pizza->rating=='3')
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    @elseif($pizza->rating=='2')
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    @else
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
            @endif
            @else
            @endif
            <p>{{$pizzass->description}}</p>
            
            <div class="pt-5 mt-5">
              <h3 class="mb-5">Customer Ratings</h3>
              <ul class="comment-list">
                @foreach ($comments as $comment)
                <li class="comment">
                  <div class="vcard bio">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>{{ $comment->name }}</h3>
                    <div class="meta">{{ $comment->comment_date }}</div>
                    @if($comment->rating=='5')
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i> 
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i> 
                    @elseif($comment->rating=='4')
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    @elseif($comment->rating=='3')
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    @elseif($comment->rating=='2')
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    @else
                    <i class="fa fa-star" style="font-size:24px;color:yellow"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    <i class="fa fa-star" style="font-size:24px"></i>
                    @endif
                    <p>{{ $comment->comment }}</p>
                  </div>
                </li>
                @endforeach
              </ul>
              <!-- END comment-list -->
              @if(Auth::check())
              @if(Auth::user()->role == 'customer')
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Enter Your Ratings</h3>
                <form enctype="multipart/form-data" method="POST" action="{{url('customerrating')}}">
                  {{csrf_field()}}   
                  <input type="hidden" class="form-control " id="pizza_id" name="pizza_id" value="{{$pizzas}}" >
                  <div class="form-group">
                    <textarea id="comment" name="comment" cols="100" rows="5" class="form-control" placeholder="Leave a Message"></textarea>
                  </div>
                  <div class="rating">
                    <label for="5">☆</label><input name="rating" type="radio" id="5" value="5" required>
                    <label for="4">☆</label><input name="rating" type="radio" id="4" value="4">
                    <label for="3">☆</label><input name="rating" type="radio" id="3" value="3">
                    <label for="2">☆</label><input name="rating" type="radio" id="2" value="2">
                    <label for="1">☆</label><input name="rating" type="radio" id="1" value="1">
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-primary py-2 px-4">
                  </div>
                </form>
              </div>
              @endif
              @else
              @endif
            </div>

          </div> <!-- .col-md-8 -->
          <div class="col-md-4 sidebar ftco-animate">
            <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                	<div class="icon">
                  </div>
                </div>
              </form>
            </div>
            <div class="sidebar-box ftco-animate">
              <h3>Recent Blog</h3>
              <h4 >{{$pizzass->name}}</h4>
              <div class="block-21 mb-4 d-flex">
                <img src="{{ asset('storage/'.$pizzass->image) }}" alt="" class="blog-img mr-4">
                <div class="text">
                  <h4 class="heading"><a href="#">{{$pizzass->description}}</a></h4>
                  <h4 class="heading"><a>Pizza Price: ₱{{$pizzass->fee}}</a></h4>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span>{{$pizzass->created_at}}</a></div>
                  </div>
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