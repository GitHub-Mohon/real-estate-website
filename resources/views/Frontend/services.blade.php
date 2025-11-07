@extends('frontend.layouts.master')

@section('main-content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Services</h1>
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
            <li class="current">Services</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Services Section -->
    <section class="real-estate-services-3 services section" id="services">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6 col-md-12">
            <div class="service-block" data-aos="fade-right" data-aos-delay="200">
              <div class="service-content">
                <div class="icon">
                  <i class="bi bi-house-door"></i>
                </div>
                <h3>Buy Your Dream Home</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation.</p>
                <div class="stats">
                  <div class="stat-item">
                    <span class="number">2,500+</span>
                    <span class="label">Properties Sold</span>
                  </div>
                  <div class="stat-item">
                    <span class="number">98%</span>
                    <span class="label">Client Satisfaction</span>
                  </div>
                </div>
                <a href="{{ route('services_details') }}" class="btn-service">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
              <div class="service-image">
                <img src="{{ asset('forntend/assets/img/real-estate/property-exterior-3.webp') }}" alt="Buy Property" class="img-fluid">
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-12">
            <div class="service-block" data-aos="fade-left" data-aos-delay="200">
              <div class="service-content">
                <div class="icon">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <h3>Sell Your Property</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis.</p>
                <div class="stats">
                  <div class="stat-item">
                    <span class="number">45</span>
                    <span class="label">Days Average Sale</span>
                  </div>
                  <div class="stat-item">
                    <span class="number">$2.5M+</span>
                    <span class="label">Highest Sale Price</span>
                  </div>
                </div>
                <a href="{{ route('services_details') }}" class="btn-service">Get Valuation <i class="bi bi-arrow-right"></i></a>
              </div>
              <div class="service-image">
                <img src="{{ asset('forntend/assets/img/real-estate/property-exterior-7.webp') }}" alt="Sell Property" class="img-fluid">
              </div>
            </div>
          </div>

        </div>

        <div class="row gy-4 mt-4">

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

          <div class="col-lg-4 col-md-6">
            <div class="service-card" data-aos="zoom-in" data-aos-delay="100">
              <div class="card-icon">
                <i class="bi bi-house-heart"></i>
              </div>
              <h4>{{ $package->name }}</h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.</p>
              <div class="feature-list">
                <div class="feature-item">
                  <i class="bi bi-check2"></i>
                  <span>{{$package->allowed_days}} Avilabile Days</span>
                </div>
                <div class="feature-item">
                  <i class="{{$allowed_properties_icon}}"></i>
                  <span>{{$allowed_properties_value}}  Properties</span>
                </div>
                <div class="feature-item">
                  <i class="{{$allowed_featured_icon}}"></i>
                  <span>{{$allowed_featured_value}}  Properties Featured</span>
                </div>
                <div class="feature-item">
                  <i class="{{$allowed_photo_icon}}"></i>
                  <span>{{$allowed_photo_value}}  Properties Photos</span>
                </div>
                <div class="feature-item">
                  <i class="{{$allowed_video_icon}}"></i>
                  <span>{{$allowed_video_value}}  Properties Videos</span>
                </div>
              </div>
              <a href="{{route('agent_payment')}}" class="service-link">Explore {{ $package->name }} <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        @endforeach
        </div>
        <nav class="mt-5" data-aos="fade-up" data-aos-delay="300">
              <ul class="pagination justify-content-center">
                <style>
                    p.small.text-muted {
                            display: none !important;
                    }
                </style>

                {{ $packages->links('pagination::bootstrap-4') }}

              </ul>
          </nav>

        <div class="cta-section" data-aos="fade-up" data-aos-delay="400">
          <div class="row align-items-center">
            <div class="col-lg-8">
              <h3>Ready to Take the Next Step?</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
              <a href="{{ route('services_details') }}" class="btn btn-cta">Get Free Consultation</a>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Services Section -->

  </main>

@endsection
