@extends('frontend.layouts.master')

@section('main-content')
    <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Gate a Plan</h1>
              <p class="mb-0">
                for your marketing!
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 justify-content-center">





          @foreach ($packages as $package)


         @php
        if ($package->allowed_properties == 0) {
            $allowed_properties_icon = 'bi bi-x';
            $allowed_properties_value = 'No';
        } elseif ($package->allowed_properties == -1) {
            $allowed_properties_icon = 'bi bi-check2';
            $allowed_properties_value = 'Unlimited';
        } else {
            $allowed_properties_icon = 'bi bi-check2';
            $allowed_properties_value = $package->allowed_properties;
        }
        //
        if ($package->allowed_featured_properties == 0) {
            $allowed_featured_icon = 'bi bi-x';
            $allowed_featured_value = 'No';
        } elseif ($package->allowed_featured_properties == -1) {
            $allowed_featured_icon = 'bi bi-check2';
            $allowed_featured_value = 'Unlimited';
        } else {
            $allowed_featured_icon = 'bi bi-check2';
            $allowed_featured_value = $package->allowed_featured_properties;
        }

        //photo
        if ($package->allowed_photos == 0) {
            $allowed_photo_icon = 'bi bi-x';
            $allowed_photo_value = 'No';
        } elseif ($package->allowed_photos == -1) {
            $allowed_photo_icon = 'bi bi-check2';
            $allowed_photo_value = 'Unlimited';
        } else {
            $allowed_photo_icon = 'bi bi-check2';
            $allowed_photo_value = $package->allowed_photos;
        }
        //videos
        if ($package->allowed_videos == 0) {
            $allowed_video_icon = 'bi bi-x';
            $allowed_video_value = 'No';
        } elseif ($package->allowed_videos == -1) {
            $allowed_video_icon = 'bi bi-check2';
            $allowed_video_value = 'Unlimited';
        } else {
            $allowed_video_icon = 'bi bi-check2';
            $allowed_video_value = $package->allowed_videos;
        }
        @endphp


          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="500">
            <div class="service-card">
              <div class="service-header">
                <div class="service-icon">
                  <i class="bi bi-shield-check"></i>
                </div>
                <div class="service-number">#{{$package->id}}</div>
              </div>
              <div class="service-content">
                <h3><a href="service-details.html">{{$package->name}}</a></h3>
                <h4>${{$package->price}}</h4>
                <ul class="service-features">
                  <li><i class="bi bi-check2"></i>{{$package->allowed_days}} Avilabile Days</li>
                  <li><i class="{{$allowed_properties_icon}}"></i>{{$allowed_properties_value}}  Properties</li>
                  <li><i class="{{$allowed_featured_icon}}"></i>{{$allowed_featured_value}}  Properties Featured</li>
                  <li><i class="{{$allowed_photo_icon}}"></i>{{$allowed_photo_value}}  Properties Photos</li>
                  <li><i class="{{$allowed_video_icon}}"></i>{{$allowed_video_value}}  Properties Videos</li>
                </ul>
              </div>
              <div class="service-action">
                <a href="{{route('agent_payment')}}" class="service-btn">
                  <span>Gate Plan</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->

          @endforeach

        </div>

      </div>

    </section><!-- /Featured Services Section -->
        </div>
      </nav>
    </div><!-- End Page Title -->

  </main>

@endsection
