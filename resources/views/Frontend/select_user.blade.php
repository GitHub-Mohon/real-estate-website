@extends('frontend.layouts.master')

@section('main-content')
    <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Select User Type</h1>
              <p class="mb-0">
                Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo
                odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum
                debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat
                ipsum dolorem.
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li class="current">Select User</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Contact 2 Section -->
    <section id="contact-2" class="contact-2 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Contact Info Boxes -->
        <div class="row gy-4 mb-5">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="contact-info-box">
              <div class="info-content">
                <h4>Agent Account</h4>
                <a href="{{route('agent_register')}}"><p>Agent Register</p></a>
                <a href="{{route('agent_login')}}"><p>Agent Login</p></a>
              </div>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="contact-info-box">
              <div class="info-content">
                <h4>Customer Account</h4>
                <a href="{{route('register')}}"><p>Customer Register</p></a>
                <a href="{{route('login')}}"><p>Customer Login</p></a>
              </div>
            </div>
          </div>

        </div>

      </div>


    </section>

  </main>

@endsection
