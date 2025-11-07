@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Update Customer Profile</h4>
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
                <form action="{{route('admin_customer_update',$singleCustomer->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                  <div class="mb-3">
                    @if ($singleCustomer->photo ==null)
                    Photo not found
                    @else
                    <img src="{{ asset('uploads/user/'. $singleCustomer->photo.    ' ')}}" alt="not found" style="width: 250px; height: auto;">
                    @endif
                    <div id="emailHelp" class="form-text">Existing Photo</div><br>
                  <div class="mb-3">
                    <label for="file" class="form-label">Change Photo</label>
                    <input type="file" class="form-control" id="file" name="photo" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="name1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name1" name="name" value="{{old('name',$singleCustomer->name)}}" placeholder= "Emily">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email',$singleCustomer->email)}}" placeholder= "customer@example.com">
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
                        <option value="0" {{$singleCustomer->status == 0 ? 'selected' : ''}}>Pending</option>
                        <option value="1" {{$singleCustomer->status == 1 ? 'selected' : ''}}>Active</option>
                        <option value="2" {{$singleCustomer->status == 2 ? 'selected' : ''}}>Suspended</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Update Customer</button>
                </form><br>
              </div>
            </div>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
