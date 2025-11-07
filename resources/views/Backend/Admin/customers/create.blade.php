@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Create Customer Profile</h4>
                <a href="{{ route('admin_customer_index') }}" class="btn btn-primary btn-sm ms-auto"> <i class="bi bi-eye"></i> View All</a>
                @include('backend.admin.alertsMessage')
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
              <div class="card-body"><br>
                <form action="{{route('admin_customer_store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                  <div class="mb-3">
                    <label for="file" class="form-label">Upload Photo</label>
                    <input type="file" class="form-control" id="file" name="photo" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="name1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name1" name="name" value="{{old('name')}}" placeholder= "Emily">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder= "customer@example.com">
                  </div>
                  <div class="mb-3">
                    <label for="pass1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass1" name="password" value="{{old('password')}}" placeholder="Password">
                  </div>
                  <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Retype" value="{{old('confirm_password')}}">
                  </div>
                  <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="0">Pending</option>
                        <option value="1">Active</option>
                        <option value="2">Suspended</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Create Customer</button>
                </form><br>
              </div>
            </div>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
