@extends('frontend.layouts.master')

@section('main-content')
    <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">{{ $property->name }}</h1>
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
            <li class="current">Property Details</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

<!-- Property Details Section -->
    <section id="property-details" class="property-details section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-8">

            <!-- Property Gallery -->
            <div class="property-gallery" data-aos="fade-up" data-aos-delay="200">
              <div class="main-image-container image-zoom-container">
                <img id="main-product-image" src="{{ asset('uploads/properties/'.$property->featured_photo) }}" alt="Property Exterior" class="img-fluid main-property-image" data-zoom="{{ asset('uploads/properties/'.$property->featured_photo) }}">
                <div class="image-nav-buttons">
                  <button class="image-nav-btn prev-image" type="button">
                    <i class="bi bi-chevron-left"></i>
                  </button>
                  <button class="image-nav-btn next-image" type="button">
                    <i class="bi bi-chevron-right"></i>
                  </button>
                </div>
              </div>
              <div class="thumbnail-gallery thumbnail-list">
                @foreach ($galleries as $item)
                <div class="thumbnail-item" data-image="{{ asset('uploads/properties/galleries/'.$item->photo) }}">
                  <img src="{{ asset('uploads/properties/galleries/'.$item->photo) }}" alt="Front View" class="img-fluid">
                </div>
                @endforeach
              </div>
            </div><!-- End Property Gallery -->

            <!-- Property Description -->
            <div class="property-description" data-aos="fade-up" data-aos-delay="300">
              <h3>About This Property</h3>
              <p>{{ $property->description }}</p>
            </div><!-- End Property Description -->

            <!-- Amenities -->
            <div class="property-amenities" data-aos="fade-up" data-aos-delay="400">
              <h3>Amenities &amp; Features</h3>
              <div class="row">
                @foreach ($amenities as $amenity)
                <div class="col-md-6">
                  <ul class="features-list">
                    <li><i class="bi bi-check-circle"></i>{{ $amenity->name }}</li>
                  </ul>
                </div>
                @endforeach

              </div>
            </div><!-- End Amenities -->

            <!-- Map Section -->
            <div class="property-map" data-aos="fade-up" data-aos-delay="500">
              <h3>Location</h3>
              <div class="map-container">
                @if (!$property->map == null)
                    <iframe src="{{ $property->map }}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <div class="location-details">
                    <h4>Neighborhood Information</h4>
                    <p>Located in the heart of downtown, this property offers easy access to shopping, dining, and entertainment. Public transportation and major highways are just minutes away.</p>
              </div>
                @else
                    <p >No Map included!</p>
                @endif
              </div>

            </div><!-- End Map Section -->

          </div>

          <div class="col-lg-4">

            <!-- Property Overview -->
            <div class="property-overview" data-aos="fade-up" data-aos-delay="200">
              <div class="price-tag">${{ number_format($property->price,0,",") }}</div>
              <div class="property-status">For {{$property->purpose}}</div>

              <div class="property-address">
                <h4>{{$property->address}}</h4>
                <p>{{ $property->location->name }}</p>
              </div>

              <div class="property-stats">
                <div class="stat-item">
                  <i class="bi bi-house"></i>
                  <div>
                    <span class="value">{{ $property->bedroom }}</span>
                    <span class="label">Bedrooms</span>
                  </div>
                </div>
                <div class="stat-item">
                  <i class="bi bi-droplet"></i>
                  <div>
                    <span class="value">{{ $property->bathroom }}</span>
                    <span class="label">Bathrooms</span>
                  </div>
                </div>
                <div class="stat-item">
                  <i class="bi bi-rulers"></i>
                  <div>
                    <span class="value">{{ number_format($property->size,0,",") }}</span>
                    <span class="label">Sq Ft</span>
                  </div>
                </div>
                <div class="stat-item">
                  <i class="bi bi-tree"></i>
                  <div>
                    <span class="value">0.25</span>
                    <span class="label">Acre Lot</span>
                  </div>
                </div>
                <div class="stat-item">
                  <i class="bi bi-calendar"></i>
                  <div>
                    <span class="value">{{ $property->built_year }}</span>
                    <span class="label">Year Built</span>
                  </div>
                </div>
                <div class="stat-item">
                  <i class="bi bi-car-front"></i>
                  <div>
                    <span class="value">{{ $property->garage }}</span>
                    <span class="label">Garage</span>
                  </div>
                </div>
              </div>

              <!-- Agent Info -->
              <div class="agent-info">
                <div class="agent-avatar">
                  <img src="{{asset('uploads/agent/'.$property->agent->photo)}}" alt="Sarah Johnson" class="img-fluid">
                </div>
                <div class="agent-details">
                  <h4>{{ $property->agent->name }}</h4>
                  <p class="agent-title">{{ $property->agent->designation }}</p>
                  <p class="agent-phone"><i class="bi bi-telephone"></i>{{ $property->agent->phone }}</p>
                  <p class="agent-email"><i class="bi bi-envelope"></i>{{ $property->agent->email }}</p>
                </div>
              </div><!-- End Agent Info -->

              <!-- Contact Form -->
              <div class="contact-form">
                <h4>Schedule a Tour</h4>
                <form action="{{ route('agent_schedule_tour_form') }}" method="post">
                    @csrf
                  <div class="row">
                    <input type="hidden" name="agent_id" value="{{ $property->agent_id }}">
                    <div class="col-12 form-group">
                      <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                    </div>
                    <div class="col-12 form-group">
                      <input type="email" name="email" class="form-control" placeholder="Your Email" required="">
                    </div>
                    <div class="col-12 form-group">
                      <input type="tel" name="phone" class="form-control" placeholder="Your Phone">
                    </div>

                    <div class="col-12 form-group">
                      <input type="text" name="subject" class="form-control" placeholder="Schedule a Tour for date: " value="Schedule a Tour for date: ">
                    </div>

                    <div class="col-12 form-group">
                      <textarea class="form-control" name="message" rows="4" placeholder="Your Message"></textarea>
                    </div>
                    <div class="col-12 text-center">
                      <button type="submit" class="btn btn-primary">Schedule Tour</button>
                    </div>
                  </div>
                </form>
              </div><!-- End Contact Form -->

              <!-- Social Share -->

              @php
                $url = url('property/'.$property->slug);
                $photo = url('uploads/properties/'.$property->featured_photo);
                $title = urlencode($property->title);
                $encodedUrl = urlencode($url);
              @endphp
              <div class="social-share">
                <h5>Share This Property</h5>
                <div class="share-buttons">
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ $encodedUrl }}" class="share-btn facebook" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                  <a href="https://twitter.com/intent/tweet?url={{ $encodedUrl }}&text={{ $title }}" class="share-btn twitter" target="_blank" rel="noopener"><i class="bi bi-twitter"></i></a>
                  <a href="#" class="share-btn whatsapp"><i class="bi bi-whatsapp"></i></a>
                  <a href="mailto:?subject={{ $title }}&body=Check out this property: {{ $url }}" class="share-btn email" target="_blank" rel="noopener"><i class="bi bi-envelope"></i></a>
                  <a href="#" class="share-btn print"><i class="bi bi-printer"></i></a>
                </div>
              </div><!-- End Social Share -->

            </div><!-- End Property Overview -->

          </div>

        </div>

      </div>

    </section><!-- /Property Details Section -->


@endsection
