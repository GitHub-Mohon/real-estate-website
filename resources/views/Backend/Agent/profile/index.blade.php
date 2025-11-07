
@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Agent Edit Profile</h1>
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

      @include('backend.agent.sidebar.index')

      <!-- Main Content -->
      <div class="col-md-9 col-lg-10 p-4"  data-aos="fade-up" data-aos-delay="200">
        <div style="padding: 20px 0"></div>
        <form action="{{route('agent_profile_submit')}}" method="post" enctype="multipart/form-data">
                    @csrf
          <div class="row">

            <!-- Left Section -->
            <div class="col-md-4">
              @if (Auth::guard('agent')->user()->photo == null)
                    Photo not found
                    @else
                    <img src="{{ asset('uploads/agent/' .Auth::guard('agent')->user()->photo. ' ')}}" alt="not found" alt="Profile" class="profile-img">
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
                    <input type="text" class="form-control" id="name1" name="name" value="{{ Auth::guard('agent')->user()->name }}">
                </div>
                <div class="col-md-6">
                  <label for="disabledTextInput" class="form-label">Email</label>
                    <input type="email" id="disabledTextInput" class="form-control" disabled value="{{ Auth::guard(name: 'agent')->user()->email }}">
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
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" name="company"      placeholder="AB Real Estate Company" value="{{ Auth::guard('agent')->user()->company }}">
                    </div>
                    <div class="col-md-6">
                        <label for="designation" class="form-label">Designation</label>
                    <input type="text" class="form-control" name="designation" placeholder="Senior Officer" value="{{ Auth::guard('agent')->user()->designation }}" id="designation">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone"      placeholder="number" value="{{ Auth::guard('agent')->user()->phone }}">
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Address" value="{{ Auth::guard('agent')->user()->address }}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" name="country" placeholder="Country" value="{{ Auth::guard('agent')->user()->country }}">
                    </div>
                    <div class="col-md-6">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" name="state" placeholder="State" value="{{     Auth::guard('agent')->user()->state }}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" name="city" placeholder="City" value="{{ Auth::guard('agent')->user()->city }}">
                    </div>
                    <div class="col-md-6">
                        <label for="zip" class="form-label">Zip code</label>
                        <input type="text" class="form-control" name="zip" placeholder="Zip code" value="{{ Auth::guard('agent')->user()->zip }}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" class="form-control" name="website" placeholder="project.com" value="{{     Auth::guard('agent')->user()->website }}" id="website">
                    </div>
                    <div class="col-md-6">
                        <label for="Facebook" class="form-label">Facebook</label>
                        <input type="text" class="form-control" name="facebook" placeholder="Facebook Url" value="{{     Auth::guard('agent')->user()->facebook }}" id="Facebook">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="Twitter" class="form-label">Twitter</label>
                        <input type="text" class="form-control" name="twitter" placeholder="Twitter url" value="{{     Auth::guard('agent')->user()->twitter }}" id="Twitter">
                    </div>
                    <div class="col-md-6">
                        <label for="Linkedin" class="form-label">Linkedin</label>
                        <input type="text" class="form-control" name="linkedin" placeholder="linkedin.com" value="{{     Auth::guard('agent')->user()->linkedin }}" id="Linkedin">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row mb-3">
                        <div class="col-md-6">
                        <label for="instagram" class="form-label">Instagram</label>
                        <input type="text" class="form-control" name="instagram" placeholder="instagram Url" value="{{     Auth::guard('agent')->user()->instagram }}" id="instagram">
                    </div>
                    <div class="col-md-6">
                        <label for="whatsapp" class="form-label">Whatsapp</label>
                        <input type="text" class="form-control" name="whatsapp" placeholder="whatsapp number" value="{{     Auth::guard('agent')->user()->whatsapp }}" id="whatsapp">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                        <label for="short_biography" class="form-label">Short Biography</label>
                        <textarea class="form-control h_120" rows="4" name="short_biography" id="short_biography" placeholder="give about short Biography">{{ Auth::guard('agent')->user()->short_biography }}</textarea>
                </div>
            </div>
            <div class="col-md-12 pt-1">
                <div class="row">
                        <label for="bio" class="form-label">Biography</label>
                        <textarea class="form-control h_200" rows="7" name="biography" id="bio" placeholder="give your long Descriptions">{{ Auth::guard('agent')->user()->biography }}</textarea>
                </div>
            </div>
            <div class="col-md-12 pt-3">
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


