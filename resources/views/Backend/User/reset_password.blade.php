@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Customer Reset Password</h1>
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
            <li class="current">Customer Reset Password</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="{{route('home')}}" class="text-nowrap logo-img text-center d-block py-2 w-100">
                  <img src="{{url('../assets/images/logos/seodashlogo.png')}}" alt="" style="width: 100px; height: auto;">
                </a>
                <p class="text-center">CHB- Developer</p>

                <form action="{{route('reset_password_submit',[$token,$email])}}" method="post">
                    @csrf
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="new password">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword2" placeholder="retype password">
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Reset Password</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
