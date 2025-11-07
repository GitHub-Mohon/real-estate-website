<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>

  <link rel="shortcut icon" type="image/png" href="{{url('../assets/images/logos/seodashlogo.png')}}" />
@include('frontend.layouts.style')
@include('backend.admin.customCSS')
</head>
<body>

    @include('backend.admin.sidebar')



 <!-- Topbar -->
  <div class="topbar">
    <h5 class="m-0"></h5>
    <div>
      <a href="{{route('home')}}" class="btn btn-warning btn-sm" style="color: #fff"><strong>Front End</strong></a>
      <a href="javascript:void(0)"><img src="{{ asset('uploads/admin/' .Auth::guard('admin')->user()->photo.    ' ')}}" class="rounded-circle ms-2" alt="profile"  width="35" height="35"></a>
    </div>
  </div>

  @yield('main-content')


@include('backend.admin.script')

</body>
</html>
