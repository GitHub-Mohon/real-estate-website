@extends('frontend.layouts.master')

@section('main-content')
    <main>
        <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Property Locations</h1>
              <p class="mb-0">

              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Property Locations</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

        {{-- !-- Featured Locations Section --> --}}
    <section id="featured-agents" class="featured-agents section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Featured Locations</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5 justify-content-center">

         @foreach ($locations as $item)

          <div class="col-lg-6 col-xl-4" data-aos="fade-up" data-aos-delay="100">
            <div class="agent-card">
              <div class="agent-image">
                <img src="{{asset('uploads/locations/'.$item->photo)}}" alt="Top Agent" class="img-fluid">
              </div>
              <div class="agent-info">
                <div class="agent-stats">
                  <div class="stat-item">
                    <span class="stat-number">{{ $item->name }}</span>
                    <span class="stat-label"><i class="bi bi-geo-alt"></i> Location</span>
                  </div>
                  <div class="stat-divider"></div>
                  <div class="stat-item">
                    <span class="stat-number">{{ $item->total_properties }}</span>
                    <span class="stat-label">Total Properties</span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Agent Card -->

         @endforeach

        </div>

        <nav class="mt-5" data-aos="fade-up" data-aos-delay="300">
              <ul class="pagination justify-content-center">
                <style>
                    p.small.text-muted {
                            display: none !important;
                    }
                </style>

                {{ $locations->links('pagination::bootstrap-4') }}

              </ul>
            </nav>
        </div>

      </div>

    </section><!-- /Featured Locations Section -->

    </main>
@endsection
