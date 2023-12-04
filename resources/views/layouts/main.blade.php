<!DOCTYPE html>
<style>

</style>
<html lang="en">
  <head>
    <title>Pizza - RUSH</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search.css">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

  </head>
  <body>

  	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
		      <a class="navbar-brand" href="index.html"><span class="flaticon-pizza-1 mr-1"></span>Pizza<br><small>Rush</small></a>
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="oi oi-menu"></span> Menu
		      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">

            @if(Auth::check())
            @if(Auth::user()->role == 'admin')
	          <li class="nav-item"><a href="{{ url('pizzarush') }}" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="{{ url('pizzacustomersearchs') }}" class="nav-link">Transaction History</a></li>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Menu
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a href="{{ url('announcements') }}" style="color:#ffa500" class="dropdown-item">Announcement</a>
              <a href="{{ url('customerss') }}" style="color:#ffa500" class="dropdown-item">Customers</a>
              <a href="{{ url('employeess') }}" style="color:#ffa500" class="dropdown-item">Employees</a>
              <a href="{{ url('pizzass') }}" style="color:#ffa500" class="dropdown-item">Pizzas</a>
              <a href="{{ url('pizzacrust') }}" style="color:#ffa500" class="dropdown-item">PizzaCrust</a>
              <a href="{{ url('pizzatoppings') }}" style="color:#ffa500" class="dropdown-item">PizzaToppings</a>
              <a href="{{ url('vouchers') }}" style="color:#ffa500" class="dropdown-item">Vouchers</a>
              </div>
            </li>
            <li style="margin-right: 350px" class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Charts 
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a href="{{ url('pizzachart') }}" style="color:#ffa500" class="dropdown-item">Pizza Best Seller</a>
                <a href="{{ url('orderedpizza') }}" style="color:#ffa500" class="dropdown-item">Pizza Sold Count w/ Specific Date</a>
                <a href="{{ url('pizzasales') }}" style="color:#ffa500" class="dropdown-item">Pizza Sales w/ Specific Date</a>
              </div>
            </li>
            @endif
            @endif

            @if(Auth::check())
            @if(Auth::user()->role == 'employee')
	          <li class="nav-item"><a href="{{ url('pizzarush') }}" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="{{ url('pizzacustomersearchs') }}" class="nav-link">Transaction History</a></li>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Menu
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a href="{{ url('announcements') }}" style="color:#ffa500" class="dropdown-item">Announcement</a>
              <a href="{{ url('customerss') }}" style="color:#ffa500" class="dropdown-item">Customers</a>
              <a href="{{ url('employeess') }}" style="color:#ffa500" class="dropdown-item">Employees</a>
              <a href="{{ url('pizzass') }}" style="color:#ffa500" class="dropdown-item">Pizzas</a>
              <a href="{{ url('pizzacrust') }}" style="color:#ffa500" class="dropdown-item">PizzaCrust</a>
              <a href="{{ url('pizzatoppings') }}" style="color:#ffa500" class="dropdown-item">PizzaToppings</a>
              <a href="{{ url('vouchers') }}" style="color:#ffa500" class="dropdown-item">Vouchers</a>
              </div>
            </li>
            <li style="margin-right: 350px" class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Charts 
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a href="{{ url('pizzachart') }}" style="color:#ffa500" class="dropdown-item">Pizza Best Seller</a>
              <a href="{{ url('crustchart') }}" style="color:#ffa500" class="dropdown-item">Pizza Crust Most Used</a>
              <a href="{{ url('toppingschart') }}" style="color:#ffa500" class="dropdown-item">Pizza Toppings Most Used</a>
              <a href="{{ url('orderedpizza') }}" style="color:#ffa500" class="dropdown-item">Pizza Sold Count w/ Specific Date</a>
              <a href="{{ url('pizzasales') }}" style="color:#ffa500" class="dropdown-item">Pizza Sales w/ Specific Date</a>
              </div>
            </li>
            @endif
            @endif

            @if(Auth::check())
            @if(Auth::user()->role == 'customer')
	          <li class="nav-item"><a href="{{ url('pizzarush') }}" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="{{ url('/announcementss') }}" class="nav-link">What's New</a></li>
              <li class="nav-item"><a href="{{ url('/pizzaindex') }}" class="nav-link">Menu</a></li>
              <li class="nav-item"><a href="{{ url('/custompizza') }}" class="nav-link">Customize Pizza</a></li>
              <li style="margin-right: 120px" class="nav-item"><a href="{{ url('/voucherss') }}" class="nav-link">Voucher(s)</a></li>
              
            @endif
            @endif

            @guest
              <li class="nav-item"><a href="{{ url('pizzarush') }}" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="{{ url('/announcementss') }}" class="nav-link">What's New</a></li>
              <li class="nav-item"><a href="{{ url('/services') }}" class="nav-link">Services</a></li>
              <li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">About Us</a></li>
              <li style="margin-right: 300px" class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact Us</a></li>
              
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            
                        @else
                        @if(Auth::check())
                        @if(Auth::user()->role == 'customer')
                        <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              My Orders
                          </a>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                          <a href="{{ route('pizza.shoppingCart') }}" style="color:#ffa500" class="dropdown-item">Pizza Meals</a>
                          <a href="{{ route('custompizza.shoppingCart') }}" style="color:#ffa500" class="dropdown-item">Customize Pizza</a>
                          </div>
                        </li>
                        @endif
                        @endif
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->email }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                  @if(Auth::check())
                                  @if(Auth::user()->role == 'employee')
                                    <a href="{{ route('employees.show',Auth::id()) }}" style="color:#ffa500" class="dropdown-item">View Profile</a>
                                  @endif
                                  @endif

                                  @if(Auth::check())
                                  @if(Auth::user()->role == 'customer')
                                    <a href="{{ route('customers.show',Auth::id()) }}" style="color:#ffa500" class="dropdown-item">Edit Profile</a>
                                    <a href="{{ url('voucherlist') }}" style="color:#ffa500" class="dropdown-item">My Vouchers</a>

                                  @endif
                                  @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                        </li>
                        @endguest
@if(Auth::check())
@if(Auth::user()->role == 'customer')
    
@endif
@endif
	        </ul>
	      </div>
		  </div>
	  </nav>

  <script src="jss/jquery.min.js"></script>
  <script src="jss/jquery-migrate-3.0.1.min.js"></script>
  <script src="jss/popper.min.js"></script>
  <script src="jss/bootstrap.min.js"></script>
  <script src="jss/jquery.easing.1.3.js"></script>
  <script src="jss/jquery.waypoints.min.js"></script>
  <script src="jss/jquery.stellar.min.js"></script>
  <script src="jss/owl.carousel.min.js"></script>
  <script src="jss/jquery.magnific-popup.min.js"></script>
  <script src="jss/aos.js"></script>
  <script src="jss/jquery.animateNumber.min.js"></script>
  <script src="jss/bootstrap-datepicker.js"></script>
  <script src="jss/jquery.timepicker.min.js"></script>
  <script src="jss/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="jss/google-map.js"></script>
  <script src="jss/main.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
  <script src="path/to/chartjs/dist/Chart.js"></script>

  </body>
</html>