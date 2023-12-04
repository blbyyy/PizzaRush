@include('layouts.main')

@extends('layouts.app')

@section('content')

<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
</div>

<section class="ftco-section contact-section">
    <div class="container mt-5">
      <div class="row block-9">
                  <div class="col-md-4 contact-info ftco-animate">
                      <div class="row">
                          <div class="col-md-12 mb-4">
                <h2 class="h4">{{ __('You are logged in as ')  }}{{ Auth::user()->role }} {{ __('!')  }}</h2>
              </div>
                      </div>
                  </div>
                  <div class="col-md-1"></div>
      </div>
    </div>
  </section>

@include('layouts.footer')

@endsection
