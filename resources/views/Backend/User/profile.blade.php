
@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Customer Edit Profile</h1>
              <p class="mb-0">
                {{-- message --}}
                @include('backend.admin.alertsMessage')
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li class="current">Edit Profile</li>
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
        <div style="padding: 20px 0"></div>
        <form action="{{route('profile_submit')}}" method="post" enctype="multipart/form-data">
                    @csrf
          <div class="row">

            <!-- Left Section -->
            <div class="col-md-4">
              @if (Auth::guard('web')->user()->photo ==null)
                    Photo not found
                    @else
                    <img src="{{ asset('uploads/user/' .Auth::guard('web')->user()->photo. ' ')}}" alt="not found" alt="Profile" class="profile-img">
                    @endif
              <div class="mb-3">
                <label for="formFile" class="form-label">Change Photo</label>
                <input class="form-control" type="file" id="formFile" name="photo">
              </div>
            </div>

            <!-- Right Section -->
            <div class="col-md-8">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="name1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name1" name="name" value="{{ Auth::guard('web')->user()->name }}">
                </div>
                <div class="col-md-6">
                  <label for="disabledTextInput" class="form-label">Email</label>
                    <input type="email" id="disabledTextInput" class="form-control" disabled value="{{ Auth::guard(name: 'web')->user()->email }}">
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="pass1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass1" name="password" placeholder="Password">
                </div>
                <div class="col-md-6">
                  <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Retype">
                </div>
              </div>
            </div>

            <div class="con-md-12">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" id="phone" name="phone"      placeholder="number" value="{{ Auth::guard('web')->user()->phone }}">
                    </div>
                    <div class="col-md-4">
                        <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Address" value="{{ Auth::guard('web')->user()->address }}">
                    </div>
                    <div class="col-md-4">
                        <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" name="country" placeholder="Country" value="{{ Auth::guard('web')->user()->country }}">
                    </div>
                </div>
            </div>
            <div class="con-md-12">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" name="state" placeholder="State" value="{{     Auth::guard('web')->user()->state }}">
                    </div>
                    <div class="col-md-4">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" name="city" placeholder="City" value="{{     Auth::guard('web')->user()->city }}">
                    </div>
                    <div class="col-md-4">
                        <label for="zip" class="form-label">Zip code</label>
                        <input type="text" class="form-control" name="zip" placeholder="Zip code" value="{{     Auth::guard('web')->user()->zip }}">
                    </div>
                </div>
            </div>
            <div class="con-md-12">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </div>
                </div>
            </div>

          </div>
        </form>
      </div>

    </div>
  </div>
  </main>



@endsection


