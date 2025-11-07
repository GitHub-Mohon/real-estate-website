{{-- <h4> Admin Reset Password</h4>

@if ($errors->any())
    @foreach ($errors->all() as $error )
        <div style="color:red">
            {{$error}}
        </div>
    @endforeach
@endif

@if (session('success'))
    {{session('success')}}
@endif
@if (session('error'))
    {{session('error')}}
@endif

<form action="{{route('admin_reset_password_submit',[$token,$email])}}" method="post">
    @csrf
    <div>
        <label for="pass">New Password</label>
        <input type="password" id="pass" name="password" placeholder="enter your New password">
    </div>
    <div>
        <label for="repass">Retype Password</label>
        <input type="password" id="repass" name="confirm_password" placeholder="retype password">
    </div>
    <input type="submit" value="login">

</form>


 --}}
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Reset Password</title>
  <link rel="shortcut icon" type="image/png" href="{{url('../assets/images/logos/seodashlogo.png')}}" />
  <link rel="stylesheet" href="{{url('../assets/css/styles.min.css')}}" />
</head>

<body>
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
                {{-- message --}}
                @include('backend.admin.alertsMessage')

                <form action="{{route('admin_reset_password_submit',[$token,$email])}}" method="post">
                    @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="new password">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword2" placeholder="retype password">
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Sign In</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>

