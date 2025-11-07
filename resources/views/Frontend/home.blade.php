
@extends('frontend.layouts.master')


@section('main-content')
    <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="hero-content">
          <div class="row align-items-center">

            <div class="col-lg-6 hero-text" data-aos="fade-right" data-aos-delay="200">
              <div class="hero-badge">
                <i class="bi bi-star-fill"></i>
                <span>Premium Properties</span>
              </div>
              <h1>Discover Your Perfect Home in the Heart of the City</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Browse thousands of verified listings from trusted agents.</p>

              <div class="search-form" data-aos="fade-up" data-aos-delay="300">
                <form action="{{ route('properties') }}" method="get">
                  <div class="row g-3">
                    <div class="col-12">
                      <div class="form-floating">
                        <select class="form-select" id="property-type" name="location" >
                            <option value="">Location</option>
                            @foreach ($search_locations as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="location">Location</label>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <select class="form-select" id="property-type" name="type" >
                            <option value="">Property Type</option>
                            @foreach ($search_types as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="property-type">Property Type</label>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <select class="form-select" id="price-range" name="price_range" >
                          <option value="">Price Range</option>
                          <option value="0-200000">Under $200K</option>
                          <option value="200000-500000">$200K - $500K</option>
                          <option value="500000-800000">$500K - $800K</option>
                          <option value="800000-1200000">$800K - $1.2M</option>
                          <option value="1200000+">Above $1.2M</option>
                        </select>
                        <label for="price-range">Price Range</label>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <select class="form-select" id="bedrooms" name="bedrooms">
                          <option value="">Bedrooms</option>
                          <option value="1">1 Bedroom</option>
                          <option value="2">2 Bedrooms</option>
                          <option value="3">3 Bedrooms</option>
                          <option value="4">4 Bedrooms</option>
                        </select>
                        <label for="bedrooms">Bedrooms</label>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <select class="form-select" id="bathrooms" name="bathrooms">
                          <option value="">Bathrooms</option>
                          <option value="1">1 Bathroom</option>
                          <option value="2">2 Bathrooms</option>
                          <option value="3">3 Bathrooms</option>
                          <option value="4">4 Bathrooms</option>
                        </select>
                        <label for="bathrooms">Bathrooms</label>
                      </div>
                    </div>

                    <div class="col-12">
                      <button type="submit" class="btn btn-search w-100">
                        <i class="bi bi-search"></i>
                        Search Properties
                      </button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="hero-stats" data-aos="fade-up" data-aos-delay="400">
                <div class="row">
                  <div class="col-4">
                    <div class="stat-item">
                      <h3><span data-purecounter-start="0" data-purecounter-end="2847" data-purecounter-duration="1" class="purecounter"></span>+</h3>
                      <p>Properties Listed</p>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="stat-item">
                      <h3><span data-purecounter-start="0" data-purecounter-end="156" data-purecounter-duration="1" class="purecounter"></span>+</h3>
                      <p>Verified Agents</p>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="stat-item">
                      <h3><span data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="1" class="purecounter"></span>%</h3>
                      <p>Client Satisfaction</p>
                    </div>
                  </div>
                </div>
              </div>

            </div><!-- End Hero Text -->

            <div class="col-lg-6 hero-images" data-aos="fade-left" data-aos-delay="400">
              <div class="image-stack">
                <div class="main-image">
                  <img src="{{asset('forntend/assets/img/real-estate/property-exterior-3.webp')}}" alt="Luxury Property" class="img-fluid">
                  <div class="property-tag">
                    <span class="price">$850,000</span>
                    <span class="type">Featured</span>
                  </div>
                </div>

                <div class="secondary-image">
                  <img src="{{asset('forntend/assets/img/real-estate/property-interior-7.webp')}}" alt="Property Interior" class="img-fluid">
                </div>

                <div class="floating-card">
                  <div class="agent-info">
                    <img src="{{asset('forntend/assets/img/real-estate/agent-4.webp')}}" alt="Agent" class="agent-avatar">
                    <div class="agent-details">
                      <h5>Sarah Johnson</h5>
                      <p>Top Real Estate Agent</p>
                      <div class="rating">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <span>4.9 (127 reviews)</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Hero Images -->

          </div>
        </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- Home About Section -->
    <section id="home-about" class="home-about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center gy-5">

          <div class="col-lg-6 order-lg-2" data-aos="fade-left" data-aos-delay="200">
            <div class="image-section">
              <div class="main-image-wrapper">
                <img src="{{asset('forntend/assets/img/real-estate/property-exterior-7.webp')}}" alt="Premium Property" class="img-fluid main-image">
                <div class="floating-card">
                  <div class="card-content">
                    <div class="icon">
                      <i class="bi bi-award"></i>
                    </div>
                    <div class="text">
                      <span class="number"><span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1" class="purecounter"></span>+</span>
                      <span class="label">Awards Won</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="secondary-images">
                <div class="small-image">
                  <img src="{{asset('forntend/assets/img/real-estate/property-interior-8.webp')}}" alt="Interior Design" class="img-fluid">
                </div>
                <div class="small-image">
                  <img src="{{asset('forntend/assets/img/real-estate/agent-3.webp')}}" alt="Expert Agent" class="img-fluid">
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 order-lg-1" data-aos="fade-right" data-aos-delay="300">
            <div class="content-wrapper">
              <div class="section-badge">
                <i class="bi bi-buildings"></i>
                <span>Premium Real Estate</span>
              </div>

              <h2>Transforming Real Estate Dreams Into Reality</h2>

              <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore dolore magna aliqua. Enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.</p>

              <div class="stats-grid">
                <div class="stat-item" data-aos="zoom-in" data-aos-delay="400">
                  <div class="stat-number">
                    <span data-purecounter-start="0" data-purecounter-end="2800" data-purecounter-duration="2" class="purecounter"></span>+
                  </div>
                  <div class="stat-label">Properties Listed</div>
                </div>

                <div class="stat-item" data-aos="zoom-in" data-aos-delay="450">
                  <div class="stat-number">
                    <span data-purecounter-start="0" data-purecounter-end="95" data-purecounter-duration="1" class="purecounter"></span>%
                  </div>
                  <div class="stat-label">Success Rate</div>
                </div>

                <div class="stat-item" data-aos="zoom-in" data-aos-delay="500">
                  <div class="stat-number">
                    <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>/7
                  </div>
                  <div class="stat-label">Client Support</div>
                </div>
              </div>

              <div class="features-list">
                <div class="feature-item">
                  <i class="bi bi-check-circle"></i>
                  <span>Expert market analysis and pricing strategies</span>
                </div>
                <div class="feature-item">
                  <i class="bi bi-check-circle"></i>
                  <span>Personalized property matching services</span>
                </div>
                <div class="feature-item">
                  <i class="bi bi-check-circle"></i>
                  <span>Professional photography and virtual tours</span>
                </div>
              </div>

              <div class="cta-wrapper">
                <a href="{{route('about')}}" class="btn-primary">
                  <span>Learn More About Us</span>
                  <i class="bi bi-arrow-right-circle"></i>
                </a>
                <div class="contact-quick">
                  <i class="bi bi-headset"></i>
                  <div class="contact-text">
                    <span>Need assistance?</span>
                    <a href="tel:{{ $global_setting->assistance_number }}">{{ $global_setting->assistance_number }}</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Home About Section -->

    <!-- Featured Properties Section -->
    <section id="featured-properties" class="featured-properties section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Featured Properties</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="grid-featured" data-aos="zoom-in" data-aos-delay="150">

          <article class="highlight-card">
            <div class="media">
              <div class="badge-set">
                @if ($featured_property->is_featured == 1)
                    <span class="flag featured">Featured</span>
                @endif
                <span class="flag premium">Premium</span>
              </div>
              <a href="{{ route('property_details',$featured_property->slug) }}" class="image-link">
                <img src="{{asset('uploads/properties/'.$featured_property->featured_photo)}}" alt="Showcase Villa" class="img-fluid">
              </a>
              <div class="quick-specs">
                <span><i class="bi bi-door-open"></i> {{ $featured_property->bedroom }} Beds</span>
                <span><i class="bi bi-droplet"></i> {{ $featured_property->bathroom }} Baths</span>
                <span><i class="bi bi-aspect-ratio"></i> {{ number_format($featured_property->size,0,',') }} sq ft</span>
              </div>
            </div>
            <div class="content">
              <div class="top">
                <div>
                  <h3><a href="{{ route('property_details',$featured_property->slug) }}">{{ $featured_property->name }}</a></h3>
                  <div class="loc"><i class="bi bi-geo-alt-fill"></i>{{ $featured_property->address }}</div>
                </div>
                <div class="price">${{ number_format($featured_property->price,0,',') }}</div>
              </div>
              <p class="excerpt">Praesent commodo cursus magna, fusce dapibus tellus ac cursus commodo, vestibulum id ligula porta felis euismod semper.</p>
              <div class="cta">
                <a href="{{ route('property_details',$featured_property->slug) }}" class="btn-main">Arrange Visit</a>
                <a href="{{ route('property_details',$featured_property->slug) }}" class="btn-soft">More Photos</a>
                <div class="meta">
                  <span class="status for-sale">For {{ $featured_property->purpose }}</span>
                  <span class="listed">Listed {{ $featured_property->created_at->diffForHumans() }}</span>
                </div>
              </div>
            </div>
          </article><!-- End Highlight Card -->

          <div class="mini-list">
            @foreach ($side_properties as $item)

            <article class="mini-card" data-aos="fade-up" data-aos-delay="250">
              <a href="{{ route('property_details',$item->slug) }}" class="thumb">
                <img src="{{asset('forntend/assets/img/real-estate/property-exterior-3.webp')}}" alt="Suburban Home" class="img-fluid" loading="lazy">
                <span class="label new"><i class="bi bi-star-fill"></i> New</span>
              </a>
              <div class="mini-body">
                <h4><a href="{{ route('property_details',$item->slug) }}">{{ $item->name }}</a></h4>
                <div class="mini-loc"><i class="bi bi-geo"></i> {{ $item->address }}</div>
                <div class="mini-specs">
                  <span><i class="bi bi-door-open"></i> {{ $item->bedroom }}</span>
                  <span><i class="bi bi-droplet"></i> {{ $item->bathroom }}</span>
                  <span><i class="bi bi-rulers"></i> {{ number_format($item->size,0,",") }} sq ft</span>
                </div>
                <div class="mini-foot">
                  <div class="mini-price">${{ number_format($item->price,0,",") }}</div>
                  <a href="{{ route('property_details',$item->slug) }}" class="mini-btn">Details</a>
                </div>
              </div>
            </article><!-- End Mini Card -->

            @endforeach

          </div><!-- End Mini List -->

        </div>

        <div class="row gy-4 mt-4">

        @foreach ($properties as $item)

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <article class="stack-card">
              <figure class="stack-media">
                <img src="{{asset('uploads/properties/'.$item->featured_photo)}}" alt="Modern Facade" class="img-fluid" loading="lazy">
                <figcaption>
                    @if ($item->purpose == "Rent")
                        <span class="chip exclusive">For {{ $item->purpose }}</span>
                    @else
                        <span class="chip hot">For {{ $item->purpose }}</span>
                    @endif
                </figcaption>
              </figure>
              <div class="stack-body">
                <h5><a href="{{ route('property_details',$item->slug) }}">{{ $item->name }}</a></h5>
                <div class="stack-loc"><i class="bi bi-geo-alt"></i> {{ $item->address }}</div>
                <ul class="stack-specs">
                  <li><i class="bi bi-door-open"></i> {{ $item->bedroom }}</li>
                  <li><i class="bi bi-droplet"></i> {{ $item->bathroom }}</li>
                  <li><i class="bi bi-aspect-ratio"></i> {{ number_format($item->size,0,",") }} sq ft</li>
                </ul>
                <div class="stack-foot">
                  <span class="stack-price">${{ number_format($item->price,0,",") }}</span>
                  <a href="{{route('property_details',$item->slug)}}" class="stack-link">View</a>
                </div>
              </div>
            </article>
          </div>

        @endforeach

        </div>

      </div>

    </section><!-- /Featured Properties Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Featured Services</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 justify-content-center">

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="service-card">
              <div class="service-header">
                <div class="service-icon">
                  <i class="bi bi-search"></i>
                </div>
                <div class="service-number">01</div>
              </div>
              <div class="service-content">
                <h3><a href="{{route('properties')}}">Property Search</a></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed eiusmod tempor incididunt labore dolore magna</p>
                <ul class="service-features">
                  <li><i class="bi bi-check2"></i> Advanced Search Filters</li>
                  <li><i class="bi bi-check2"></i> 360° Virtual Tours</li>
                  <li><i class="bi bi-check2"></i> Real-time Updates</li>
                </ul>
              </div>
              <div class="service-action">
                <a href="{{route('properties')}}" class="service-btn">
                  <span>Explore Properties</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="service-card featured">
              <div class="service-header">
                <div class="service-icon">
                  <i class="bi bi-graph-up"></i>
                </div>
                <div class="service-number">02</div>
              </div>
              <div class="service-content">
                <h3><a href="{{route('services_details')}}l">Market Analysis</a></h3>
                <p>Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi aliquip commodo consequat duis aute</p>
                <ul class="service-features">
                  <li><i class="bi bi-check2"></i> Price Trend Reports</li>
                  <li><i class="bi bi-check2"></i> Investment Insights</li>
                  <li><i class="bi bi-check2"></i> Market Forecasting</li>
                </ul>
              </div>
              <div class="service-action">
                <a href="{{route('services_details')}}" class="service-btn">
                  <span>Get Analysis</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="service-card">
              <div class="service-header">
                <div class="service-icon">
                  <i class="bi bi-key"></i>
                </div>
                <div class="service-number">03</div>
              </div>
              <div class="service-content">
                <h3><a href="{{route('services_details')}}">Property Management</a></h3>
                <p>Excepteur sint occaecat cupidatat non proident sunt culpa qui officia deserunt mollit anim laborum sed</p>
                <ul class="service-features">
                  <li><i class="bi bi-check2"></i> Tenant Screening</li>
                  <li><i class="bi bi-check2"></i> Rental Collection</li>
                  <li><i class="bi bi-check2"></i> Maintenance Services</li>
                </ul>
              </div>
              <div class="service-action">
                <a href="{{route('services_details')}}" class="service-btn">
                  <span>Manage Now</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="500">
            <div class="service-card">
              <div class="service-header">
                <div class="service-icon">
                  <i class="bi bi-shield-check"></i>
                </div>
                <div class="service-number">04</div>
              </div>
              <div class="service-content">
                <h3><a href="{{route('services_details')}}">Legal Support</a></h3>
                <p>Sed ut perspiciatis unde omnis iste natus error voluptatem accusantium doloremque laudantium totam rem aperiam</p>
                <ul class="service-features">
                  <li><i class="bi bi-check2"></i> Contract Review</li>
                  <li><i class="bi bi-check2"></i> Title Verification</li>
                  <li><i class="bi bi-check2"></i> Legal Documentation</li>
                </ul>
              </div>
              <div class="service-action">
                <a href="{{route('services_details')}}" class="service-btn">
                  <span>Learn More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

        <div class="text-center" data-aos="fade-up" data-aos-delay="600">
          <a href="{{ route('services') }}" class="btn-all-services">
            <span>Discover All Our Services</span>
            <i class="bi bi-arrow-up-right"></i>
          </a>
        </div>

      </div>

    </section><!-- /Featured Services Section -->

    <!-- Featured Agents Section -->
    <section id="featured-agents" class="featured-agents section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Featured Agents</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5 justify-content-center">

         @foreach ($best3agent as $item)

          <div class="col-lg-6 col-xl-4" data-aos="fade-up" data-aos-delay="100">
            <div class="agent-card">
              <div class="agent-image">
                <img src="{{asset('uploads/agent/'.$item->photo)}}" alt="Top Agent" class="img-fluid">
                <div class="agent-overlay">
                  <div class="contact-buttons">
                    <a href="tel:+{{ $item->phone }}" class="btn-contact" title="Call Agent">
                      <i class="bi bi-telephone"></i>
                    </a>
                    <a href="mailto:{{ $item->email }}" class="btn-contact" title="Email Agent">
                      <i class="bi bi-envelope"></i>
                    </a>
                    <a href="#" class="btn-contact" title="WhatsApp">
                      <i class="bi bi-whatsapp"></i>
                    </a>
                  </div>
                </div>
                <div class="status-badge top-agent">Top Agent</div>
              </div>
              <div class="agent-info">
                <div class="agent-meta">
                  <h3 class="agent-name">{{ $item->name }}</h3>
                  <p class="agent-title">{{ $item->designation }}</p>
                </div>
                <div class="agent-stats">
                  <div class="stat-item">
                    <span class="stat-number">150+</span>
                    <span class="stat-label">Properties Sold</span>
                  </div>
                  <div class="stat-divider"></div>
                  <div class="stat-item">
                    <span class="stat-number">4.9</span>
                    <span class="stat-label">Rating</span>
                  </div>
                </div>
                <div class="location-tag">
                  <i class="bi bi-geo-alt"></i>
                  <span>{{ $item->city }}</span>
                </div>
                <div class="specialties">
                  <span class="specialty-tag">Waterfront</span>
                  <span class="specialty-tag">High-Rise</span>
                </div>
                <a href="{{ route('agent_details',$item->id) }}" class="profile-link">View Full Profile</a>
              </div>
            </div>
          </div><!-- End Agent Card -->

         @endforeach

        </div>

        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
          <a href="{{ route('agents') }}" class="explore-agents-btn">
            <span>Explore All Our Agents</span>
            <i class="bi bi-arrow-right-circle"></i>
          </a>
        </div>

      </div>

    </section><!-- /Featured Locations Section -->
    <!-- Featured Locations Section -->
    <section id="featured-agents" class="featured-agents section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Featured Locations</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5 justify-content-center">

         @foreach ($best3location as $item)

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

        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
          <a href="{{ route('locations') }}" class="explore-agents-btn">
            <span>Explore All Our Locations</span>
            <i class="bi bi-arrow-right-circle"></i>
          </a>
        </div>

      </div>

    </section><!-- /Featured Locations Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="testimonials-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "slidesPerView": 1,
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              }
            }
          </script>

          <div class="swiper-wrapper">
            @if ($testimonials->count() == 0)
                <p>No data available</p>
            @else
                @foreach ($testimonials as $testimonial)
                 <div class="swiper-slide">
                 <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-8">
                    <h2>{{ $testimonial->subject }}</h2>
                    {{ $testimonial->comments }}
                    <div class="profile d-flex align-items-center">
                      <img src="{{asset('uploads/testimonials/'.$testimonial->photo)}}" class="profile-img" alt="">
                      <div class="profile-info">
                        <h3>{{ $testimonial->name }}</h3>
                        <span>{{ $testimonial->designation }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="{{asset('uploads/testimonials/'.$testimonial->photo)}}" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
                </div>
                 </div><!-- End Testimonial Item -->
                @endforeach
            @endif
          </div>

          <div class="swiper-navigation w-100 d-flex align-items-center justify-content-center">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>

        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Why Us</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center gy-5">

          <div class="col-lg-5" data-aos="fade-right" data-aos-delay="200">
            <div class="image-showcase">
              <div class="main-image-wrapper">
                <img src="{{asset('forntend/assets/img/real-estate/property-exterior-3.webp')}}" alt="Premium Property" class="img-fluid main-image">
                <div class="image-overlay">
                  <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox">
                    <div class="overlay-content">
                      <i class="bi bi-play-circle-fill play-icon"></i>
                      <span>Watch Our Story</span>
                    </div>
                  </a>
                </div>
              </div>

              <div class="floating-stats">
                <div class="stat-badge">
                  <span class="stat-number">15+</span>
                  <span class="stat-text">Years Excellence</span>
                </div>
                <div class="stat-badge">
                  <span class="stat-number">3.2K</span>
                  <span class="stat-text">Happy Clients</span>
                </div>
              </div>

              <div class="experience-card">
                <div class="card-icon">
                  <i class="bi bi-gem"></i>
                </div>
                <div class="card-content">
                  <h5>Premier Service</h5>
                  <p>Luxury real estate expertise since 2009</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
            <div class="content-wrapper">
              <div class="section-badge">
                <i class="bi bi-star-fill me-2"></i>
                Why Elite Properties
              </div>

              <h2>Your Gateway to Exceptional Real Estate Experiences</h2>
              <p class="lead-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>

              <div class="benefits-grid">
                <div class="benefit-item" data-aos="fade-up" data-aos-delay="400">
                  <div class="benefit-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                  </div>
                  <div class="benefit-content">
                    <h4>Prime Locations</h4>
                    <p>Exclusive access to the most sought-after neighborhoods and emerging markets.</p>
                  </div>
                </div>

                <div class="benefit-item" data-aos="fade-up" data-aos-delay="450">
                  <div class="benefit-icon">
                    <i class="bi bi-shield-fill-check"></i>
                  </div>
                  <div class="benefit-content">
                    <h4>Guaranteed Results</h4>
                    <p>Our proven track record ensures successful transactions and satisfied clients.</p>
                  </div>
                </div>

                <div class="benefit-item" data-aos="fade-up" data-aos-delay="500">
                  <div class="benefit-icon">
                    <i class="bi bi-clock-fill"></i>
                  </div>
                  <div class="benefit-content">
                    <h4>Fast Processing</h4>
                    <p>Streamlined processes and expert negotiation to close deals efficiently.</p>
                  </div>
                </div>

                <div class="benefit-item" data-aos="fade-up" data-aos-delay="550">
                  <div class="benefit-icon">
                    <i class="bi bi-people-fill"></i>
                  </div>
                  <div class="benefit-content">
                    <h4>Expert Team</h4>
                    <p>Certified professionals with deep market knowledge and client dedication.</p>
                  </div>
                </div>
              </div>

              <div class="achievement-highlights" data-aos="fade-up" data-aos-delay="600">
                <div class="highlight-item">
                  <span class="highlight-number purecounter" data-purecounter-start="0" data-purecounter-end="94" data-purecounter-duration="2"></span>%
                  <span class="highlight-label">Success Rate</span>
                </div>
                <div class="highlight-divider"></div>
                <div class="highlight-item">
                  <span class="highlight-number purecounter" data-purecounter-start="0" data-purecounter-end="1800" data-purecounter-duration="2"></span>+
                  <span class="highlight-label">Properties Sold</span>
                </div>
                <div class="highlight-divider"></div>
                <div class="highlight-item">
                  <span class="highlight-number purecounter" data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="2"></span>/7
                  <span class="highlight-label">Support Available</span>
                </div>
              </div>

              <div class="action-buttons" data-aos="fade-up" data-aos-delay="650">
                <a href="{{ route('properties') }}" class="btn btn-primary">Explore Properties</a>
                <a href="{{ route('services_details') }}" class="btn btn-outline">Schedule Consultation</a>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Why Us Section -->

    <!-- Recent Blog Posts Section -->
    <section id="recent-blog-posts" class="recent-blog-posts section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Recent Blog Posts</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

        @if ($posts->count() == 0)
            <p>No post is available</p>
        @else
            @foreach ($posts as $post)
            <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="post-item position-relative h-100">

              <div class="post-img position-relative overflow-hidden">
                <img src="{{asset('uploads/posts/'.$post->featured_photo)}}" class="img-fluid" alt="">
                <span class="post-date">{{ $post->created_at->format('F j') }}</span>
              </div>

              <div class="post-content d-flex flex-column">
                <h3 class="post-title">{{ $post->title }}</h3>
                <a href="{{ route('blog_details',$post->slug) }}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
              </div>

            </div>
          </div><!-- End post item -->
            @endforeach
        @endif
        </div>

      </div>

    </section><!-- /Recent Blog Posts Section -->

    <!-- Call To Action Section -->
    <section class="call-to-action-2 call-to-action section light-background" id="call-to-action">
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">

            <div class="cta-content">
              <div class="section-badge">Your Property Journey Starts Here</div>
              <h2>Ready to Find Your Perfect Investment?</h2>
              <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Mauris viverra veniam sit amet lacus cursus. Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>

              <div class="benefits-list">
                <div class="benefit-item" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>Expert market analysis and insights</span>
                </div>
                <div class="benefit-item" data-aos="fade-up" data-aos-delay="350">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>Personalized property recommendations</span>
                </div>
                <div class="benefit-item" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>End-to-end transaction support</span>
                </div>
              </div>

              <div class="cta-actions">
                <a href="{{ route('services_details') }}" class="btn btn-primary">
                  <i class="bi bi-person-lines-fill"></i>
                  Get Free Consultation
                </a>
                <a href="{{ route('contact') }}" class="btn btn-secondary">
                  <i class="bi bi-telephone-fill"></i>
                  Call {{ $global_setting->consultation_number }}
                </a>
              </div>

            </div><!-- End CTA Content -->

          </div><!-- End Left Column -->

          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="250">

            <div class="cta-visual">
              <div class="main-image">
                <img src="{{asset('forntend/assets/img/real-estate/property-exterior-5.webp')}}" alt="Property Investment" class="img-fluid">
                <div class="overlay-badge">
                  <i class="bi bi-star-fill"></i>
                  <span>Trusted by 500+ Clients</span>
                </div>
              </div>

              <div class="floating-stats">
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="450">
                  <div class="stat-icon">
                    <i class="bi bi-house-heart-fill"></i>
                  </div>
                  <div class="stat-info">
                    <span class="stat-number">850+</span>
                    <span class="stat-label">Properties Sold</span>
                  </div>
                </div>

                <div class="stat-card" data-aos="zoom-in" data-aos-delay="500">
                  <div class="stat-icon">
                    <i class="bi bi-trophy-fill"></i>
                  </div>
                  <div class="stat-info">
                    <span class="stat-number">15</span>
                    <span class="stat-label">Years Experience</span>
                  </div>
                </div>
              </div>

            </div><!-- End CTA Visual -->

          </div><!-- End Right Column -->
        </div>

      </div>
    </section><!-- /Call To Action Section -->

  </main>
@endsection
