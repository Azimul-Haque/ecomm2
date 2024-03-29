@extends('layouts.index')

@section('title', 'Login')

@section('css')

@endsection

@section('content')
  <!-- head section -->
  <section class="content-top-margin page-title page-title-small bg-gray">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                  <!-- page title -->
                  <h1 class="black-text">Login</h1>
                  <!-- end page title -->
              </div>
              <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                  <!-- breadcrumb -->
                  <ul>
                      <li><a href="#">Home</a></li>
                      <li>Login</li>
                  </ul>
                  <!-- end breadcrumb -->
              </div>
          </div>
      </div>
  </section>
  <!-- end head section -->

  <!-- content section -->
  <section class="content-section padding-three">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="login-box">
              <h1 style="text-align: center">Login</h1>
              <form action="{{ route('user.login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="phoneoremail">Email or Phone Number</label>
                  <input class="form-control" type="text" id="phoneoremail" name="phoneoremail">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input class="form-control" type="password" id="password" name="password">
                </div>
                <button type="submit" class="highlight-button btn btn-small no-margin pull-right checkout-btn xs-width-100 xs-text-center">Login</button>
              </form>
              <p><a href="{{ route('user.register') }}">Register</a> | <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}">Forgot password?</a></p>
            </div>
          </div>
        </div>
      </div>
  </section>
  <!-- end content section -->
@endsection

@section('js')
  
@endsection