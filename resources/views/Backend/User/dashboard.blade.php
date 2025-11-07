@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Customer Dashboard</h1>
              <p class="mb-0">

              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li class="current">Customer Dashboard</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->


    <div class="container">
    <div class="row">

      <!-- Sidebar -->

      @include('backend.user.sidebar')

            <!-- Main Content -->
      <div class="col-md-9 col-lg-10 p-4"  data-aos="fade-up" data-aos-delay="200">
        <h5>Hello, {{Auth::guard('web')->user()->name}}</h5>
        <p>See all the statistics at a glance:</p>

        <!-- Stat Cards -->
        <div class="row">
          <div class="col-md-4">
            <div class="stat-card bg-blue text-center">
              <h3>{{ $total_message }}</h3>
              <p>Messages</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card bg-green text-center">
              <h3>{{ $total_wishlist }}</h3>
              <p>Wishlists</p>
            </div>
          </div>
      </div>

    </div>
  </div>
  </main>



@endsection


