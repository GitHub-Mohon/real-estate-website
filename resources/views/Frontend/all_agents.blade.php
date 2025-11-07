@extends('frontend.layouts.master')

@section('main-content')
    <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Agents</h1>
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
            <li class="current">Agent</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

 <!-- Agents Section -->
    <section id="agents" class="agents section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="featured-agent">
              <div class="agent-image">
                <img src="{{ asset('uploads/agent/'.$first_agent->photo) }}" alt="Featured Agent" class="img-fluid">
                <div class="agent-badge">Top Seller</div>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
            <div class="featured-content">
              <h3>{{ $first_agent->name }}</h3>
              <span class="position">{{ $first_agent->designation }}</span>

              <div class="specialties">
                <span class="badge">Luxury Homes</span>
                <span class="badge">Investment Properties</span>
                <span class="badge">First-Time Buyers</span>
              </div>

              <blockquote>
                "{{ $first_agent->short_biography }}"
              </blockquote>

              <div class="stats">
                <div class="stat-item">
                  <span class="number">150+</span>
                  <span class="label">Properties Sold</span>
                </div>
                <div class="stat-item">
                  <span class="number">$45M</span>
                  <span class="label">Total Sales</span>
                </div>
                <div class="stat-item">
                  <span class="number">5</span>
                  <span class="label">Years Experience</span>
                </div>
              </div>

              <div class="contact-info">
                <div class="contact-item">
                  <i class="bi bi-telephone"></i>
                  <span>{{ $first_agent->phone }}</span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-envelope"></i>
                  <span>{{ $first_agent->email }}</span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-geo-alt"></i>
                  <span>{{ $first_agent->address }}, {{ $first_agent->city }}, {{ $first_agent->country }}</span>
                </div>
              </div>

              <div class="social-links">
                <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
              </div>

              <div class="cta-buttons">
                <a href="{{ route('agent_details',$first_agent->id) }}" class="btn btn-primary">View My Listings</a>
                <a href="{{ route('agent_details',$first_agent->id) }}" class="btn btn-outline">Schedule Consultation</a>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-12" data-aos="fade-up" data-aos-delay="300">
            <h4 class="section-subtitle">Our Expert Agents</h4>
            <p class="section-description">Meet our dedicated professionals who are committed to helping you find your perfect home or sell your property at the best value.</p>
          </div>
        </div>

        <div class="row gy-4">

          @foreach ($all_agent as $item)

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="agent-card">
              <div class="agent-photo">
                <img src="{{ asset('uploads/agent/'.$item->photo) }}" alt="Agent" class="img-fluid">
                <div class="agent-status verified">Verified</div>
                <div class="hover-overlay">
                  <div class="contact-actions">
                    <a href="{{ $item->phone }}" class="action-btn" title="Call"><i class="bi bi-telephone"></i></a>
                    <a href="{{ $item->email }}" class="action-btn" title="Email"><i class="bi bi-envelope"></i></a>
                    <a href="#" class="action-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                  </div>
                </div>
              </div>
              <div class="agent-info">
                <h5>{{ $item->name }}</h5>
                <span class="role">{{ $item->designation }}</span>
                <div class="location">
                  <i class="bi bi-geo-alt"></i>
                  <span>{{ $item->address }}</span>
                </div>
                <div class="languages">
                  <span class="lang-tag">English</span>
                  <span class="lang-tag">Spanish</span>
                </div>
                <a href="{{ route('agent_details',$item->id) }}" class="view-listings">View Listings</a>
              </div>
            </div>
          </div><!-- End Agent Card -->

          @endforeach

          <nav class="mt-5" data-aos="fade-up" data-aos-delay="300">
              <ul class="pagination justify-content-center">
                <style>
                    p.small.text-muted {
                            display: none !important;
                    }
                </style>

                {{ $all_agent->links('pagination::bootstrap-4') }}

              </ul>
            </nav>

        </div>

      </div>

    </section><!-- /Agents Section -->


  </main>

@endsection
