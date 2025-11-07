@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Edit Profile</h4>
              </div>
            </div>
        </div>
    </div>
 </div>
  </div>
  <div class="content">
    <div class="row g-3">
      <div class="col-md-12">
        <div class="stat-card">
          <div class="card-body">
                <div class="card">
              <div class="card-body">
                <form action="{{route('admin_profile_submit')}}" method="post" enctype="multipart/form-data">
                    @csrf

                  <div class="mb-3">
                    @if (Auth::guard('admin')->user()->photo ==null)
                    Photo not found
                    @else
                    <img src="{{ asset('uploads/admin/' .Auth::guard('admin')->user()->photo.    ' ')}}" alt="not found" style="width: 250px; height: auto;">
                    @endif
                    <div id="emailHelp" class="form-text">Existing Photo</div><br>
                  <div class="mb-3">
                    <label for="file" class="form-label">Change Photo</label>
                    <input type="file" class="form-control" id="file" name="photo" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="name1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name1" name="name" value="{{ Auth::guard('admin')->user()->name }}">
                  </div>
                  <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Email</label>
                    <input type="email" id="disabledTextInput" class="form-control" disabled value="{{ Auth::guard('admin')->user()->email }}">
                  </div>
                  <div class="mb-3">
                    <label for="pass1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass1" name="password" placeholder="Password">
                  </div>
                  <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Retype">
                  </div>
                  <button type="submit" class="btn btn-primary">Save Change</button>
                </form>
              </div>
            </div>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
