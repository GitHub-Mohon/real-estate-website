@extends('frontend.layouts.master')

@section('main-content')

    <main class="main">
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Properties Management</h1>
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
            <li class="current">Properties</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->
<!-- Properties Section -->
    <section id="properties" class="properties section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">

          <div class="col-lg-8">

            <div class="properties-header mb-4">
              <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="view-toggle d-flex gap-2">
                  <button class="btn btn-outline-secondary btn-sm view-btn active" data-view="grid">
                    <i class="bi bi-grid-3x3-gap"></i> Grid
                  </button>
                  <button class="btn btn-outline-secondary btn-sm view-btn" data-view="list">
                    <i class="bi bi-list"></i> List
                  </button>
                </div>
                <div class="sort-dropdown">
                  <select class="form-select form-select-sm">
                    <option>Sort by: Newest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Most Viewed</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="properties-grid view-grid active" data-aos="fade-up" data-aos-delay="200">
              <div class="row g-4">

                @if($properties->count()==0)
                <p>Property Not Found</p>
                @else
                @foreach ($properties as $item)

                <div class="col-lg-6 col-md-6">
                  <div class="property-card">
                    <div class="property-image">
                      <img src="{{ asset('uploads/properties/'.$item->featured_photo) }}" alt="Modern Family Home" class="img-fluid">
                      <div class="property-badges">
                        <span class="badge featured">Featured</span>
                        <span class="badge for-sale">For {{ $item->purpose }}</span>
                      </div>
                      <div class="property-overlay">
                        @php
                            $inWishlist = collect($wishlists)->where('property_id', $item->id)->first();
                        @endphp

                        @if ($inWishlist)
                            <button class="favorite-btn">
                                <a href="{{ route('remove_wishlist', $inWishlist->id) }}">
                                    <i class="bi bi-heart-fill"></i>
                                </a>
                            </button>
                        @else
                            <button class="favorite-btn">
                                <a href="{{ route('add_wishlist', $item->id) }}">
                                    <i class="bi bi-heart"></i>
                                </a>
                            </button>
                        @endif

                        <button class="gallery-btn" data-count="12"><i class="bi bi-images"></i></button>
                      </div>
                    </div>
                    <div class="property-content">
                      <div class="property-price">${{ number_format($item->price,0,",") }}</div>
                      <a href="{{ route('property_details',$item->slug) }}">
                        <h4 class="property-title">{{ $item->name }}</h4>
                      </a>
                      <p class="property-location"><i class="bi bi-geo-alt"></i> 2847 Oak Street, Beverly Hills, CA 90210</p>
                      <div class="property-features">
                        <span><i class="bi bi-house"></i> {{ $item->bedroom }} Bed</span>
                        <span><i class="bi bi-water"></i> {{ $item->bathroom }} Bath</span>
                        <span><i class="bi bi-arrows-angle-expand"></i> {{ number_format($item->size, 0, ",") }} sqft</span>
                      </div>
                      <div class="property-agent">
                        <img src="{{ asset('uploads/agent/'.$item->agent->photo) }}" alt="Agent" class="agent-avatar">
                        <div class="agent-info">
                          <strong>{{ $item->agent->name }}</strong>
                          <div class="agent-contact">
                            <small><i class="bi bi-telephone"></i> {{ $item->agent->phone }}</small>
                          </div>
                        </div>
                      </div>
                      <a href="{{ route('property_details',$item->slug) }}" class="btn btn-primary w-100">View Details</a>
                    </div>
                  </div>
                </div><!-- End Property Item -->

                @endforeach
                @endif


              </div>
            </div>

            <div class="properties-list view-list" data-aos="fade-up" data-aos-delay="200">
            </div>

            <nav class="mt-5" data-aos="fade-up" data-aos-delay="300">
              <ul class="pagination justify-content-center">
                <style>
                    p.small.text-muted {
                            display: none !important;
                    }
                </style>

                {{ $properties->links('pagination::bootstrap-5') }}

              </ul>
            </nav>

          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">

            <div class="properties-sidebar">

              <div class="filter-widget">
                <h5 class="filter-title">Filter Properties</h5>
            <form action="{{ route('properties') }}" method="get">
                <div class="filter-section">
                  <label class="form-label">Property Title</label>
                  <input type="text" name="name" class="form-control" placeholder="Search your property title..." value="{{ $form_name }}" onchange="this.form.submit()">
                </div>
                <div class="filter-section">
                  <label class="form-label">Property Type</label>
                  <select name="type" class="form-select" onchange="this.form.submit()">
                    <option selected disabled>All Types</option>
                    @foreach ($types as $item)
                    <option value="{{ $item->id }}" @if ($item->id == $form_type) selected @endif>{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="filter-section">
                  <label class="form-label">Property Purpose</label>
                  <select name="purpose" class="form-select" onchange="this.form.submit()">
                    <option selected disabled>All Purpose</option>
                    <option value="Sale" {{ $form_purpose == "Sale" ? 'selected' : '' }}>For Sale</option>
                    <option value="Rent" {{ $form_purpose == "Rent" ? 'selected' : '' }}>For Rent</option>
                  </select>
                </div>

                <div class="filter-section">
                  <label class="form-label">Price Range</label>
                  <div class="row g-2">
                    <div class="col-6">
                      <input type="number" class="form-control" name="min_price" value="{{$form_min_price}}" placeholder="Min Price" onchange="this.form.submit()">
                    </div>
                    <div class="col-6">
                      <input type="number" class="form-control" name="max_price" value="{{$form_max_price}}" placeholder="Max Price" onchange="this.form.submit()">
                    </div>
                  </div>
                </div>

                <div class="filter-section">
                  <label class="form-label">Bedrooms</label>
                  <div class="bedroom-filter">
                    <button class="btn btn-outline-secondary btn-sm filter-btn active">Any</button>
                    <button class="btn btn-outline-secondary btn-sm filter-btn" value="1">1+</button>
                    <button class="btn btn-outline-secondary btn-sm filter-btn" value="2">2+</button>
                    <button class="btn btn-outline-secondary btn-sm filter-btn" value="3">3+</button>
                    <button class="btn btn-outline-secondary btn-sm filter-btn" value="4">4+</button>
                  </div>
                </div>

                <div class="filter-section">
                  <label class="form-label">Bathrooms</label>
                  <div class="bathroom-filter">
                    <button class="btn btn-outline-secondary btn-sm filter-btn active" >Any</button>
                    {{-- <input  class="btn btn-outline-secondary btn-sm filter-btn" value="1"> --}}
                    <button type="number" class="btn btn-outline-secondary btn-sm filter-btn" value="1">1+</button>
                    <button class="btn btn-outline-secondary btn-sm filter-btn" value="2">2+</button>
                    <button class="btn btn-outline-secondary btn-sm filter-btn" value="3">3+</button>
                    <button class="btn btn-outline-secondary btn-sm filter-btn" value="4">4+</button>
                  </div>
                </div>

                <div class="filter-section">
                  <div class="filter-section">
                  <label class="form-label">Location</label>
                  <select name="location" class="form-select" onchange="this.form.submit()">
                    <option selected disabled>All Location</option>
                    @foreach ($locations as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $form_location ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                </div>

                <div class="filter-section">
                  <label class="form-label">Features & Amenities</label>
                  <select name="amenity" class="form-select" onchange="this.form.submit()">
                    <option selected disabled>All Amenities</option>
                    @foreach ($amenities as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $form_amenity ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </form>
              </div>

              <div class="featured-properties mt-4">
                <h5>Featured Properties</h5>

                @foreach ($properties_side as $item)
                <div class="featured-item">
                  <div class="row g-3 align-items-center">
                    <div class="col-5">
                      <img src="{{ asset('uploads/properties/'.$item->featured_photo) }}" alt="Property" class="img-fluid rounded">
                    </div>
                    <div class="col-7">
                      <h6 class="mb-1">{{ $item->name }}</h6>
                      <p class="text-muted small mb-1">{{ $item->address }}</p>
                      <strong class="text-primary">${{ number_format($item->price,0,",") }}</strong>
                    </div>
                  </div>
                </div>
                @endforeach

              </div>

            </div>

          </div>

        </div>

      </div>

    </section><!-- /Properties Section -->


  </main>

@endsection
