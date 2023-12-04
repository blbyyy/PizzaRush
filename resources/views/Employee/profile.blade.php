@include('layouts.main')
<style>
    /* Importing fonts from Google */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

/* Reseting */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* body {
    min-height: 100vh;
    background: linear-gradient(to bottom, #000428, #004683);
} */

/* .container {
    margin-top: 100px;
} */

.container .row .col-lg-4 {
    display: flex;
    justify-content: center;
}

.card {
    position: relative;
    padding: 0;
    margin: 0 !important;
    border-radius: 20px;
    overflow: hidden;
    max-width: 280px;
    max-height: 340px;
    cursor: pointer;
    border: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);

}

.card .card-image {
    width: 100%;
    max-height: 340px;
}

.card .card-image img {
    width: 100%;
    max-height: 340px;
    object-fit: cover;
}

.card .card-content {
    position: absolute;
    bottom: -180px;
    color: #fff;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(15px);
    min-height: 140px;
    width: 100%;
    transition: bottom .4s ease-in;
    box-shadow: 0 -10px 10px rgba(255, 255, 255, 0.1);
    border-top: 1px solid rgba(255, 255, 255, 0.2);
}

.card:hover .card-content {
    bottom: 0px;
}

.card:hover .card-content h4,
.card:hover .card-content h5 {
    transform: translateY(10px);
    opacity: 1;
}

.card .card-content h4,
.card .card-content h5 {
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 3px;
    text-align: center;
    transition: 0.8s;
    font-weight: 500;
    opacity: 0;
    transform: translateY(-40px);
    transition-delay: 0.2s;
}

.card .card-content h5 {
    transition: 0.5s;
    font-weight: 200;
    font-size: 0.8rem;
    letter-spacing: 2px;
}

.card .card-content .social-icons {
    list-style: none;
    padding: 0;
}


.card .card-content .social-icons li {
    margin: 10px;
    transition: 0.5s;
    transition-delay: calc(0.15s * var(--i));
    transform: translateY(50px);
}


.card:hover .card-content .social-icons li {
    transform: translateY(20px);
}

.card .card-content .social-icons li a {
    color: #fff;
}

.card .card-content .social-icons li a span {
    font-size: 1.3rem;
}

.button {
  display: inline-block;
  padding: 3px 13px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: rgb(45, 209, 238);
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: rgb(45, 209, 238)}

.button:active {
  background-color: rgb(45, 209, 238);
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

@media(max-width: 991.5px) {
    .container {
        margin-top: 20px;
    }

    .container .row .col-lg-4 {
        margin: 20px 0px;
    }
}
</style>


<div class="container">   
    <div class="col d-flex justify-content-center"> 
        <div class="col-lg-4">
            <div class="card p-0">
                <div class="card-image">
                    <img src="{{ asset('storage/'.$employee->image) }}"
                        alt="">
                </div>
                <div class="card-content d-flex flex-column align-items-center">
                    <h4 class="pt-2"> {{$employee->name}}</h4>
                    <h5> {{$employee->user->role}}</h5>
                    {{-- <h5> {{$employee->id}}</h5> --}}
                    <h4 class="pt-2">.</h4>
                    <h5>.</h5>

                    <a href="{{ route('employee.editprofile', $employee->id) }}" class="button">Edit Profile</a>

                    <ul class="social-icons d-flex justify-content-center">
                        <li style="--i:1">
                            <a href="#">
                                <span class="fab fa-facebook"></span>
                            </a>
                        </li>
                        <li style="--i:2">
                            <a href="#">
                                <span class="fab fa-twitter"></span>
                            </a>
                        </li>
                        <li style="--i:3">
                            <a href="#">
                                <span class="fab fa-instagram"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')