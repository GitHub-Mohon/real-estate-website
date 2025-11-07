{{-- <base href="{{asset('forntend')}}/"> --}}
  <!-- Favicons -->
  <link href="{{asset('uploads/setting/'.$global_setting->favicon)}}" rel="icon">
  <link href="{{asset('uploads/setting/'.$global_setting->favicon)}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('forntend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('forntend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('forntend/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('forntend/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('forntend/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{asset('forntend/assets/vendor/drift-zoom/drift-basic.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('forntend/assets/css/main.css')}}" rel="stylesheet">

  <!-- iziToast CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

  <style>
    body {
      background-color: #fff;
    }
    .sidebar {
      background: #F7F7F7;
      border-right: 1px solid #ddd;
      min-height: 100vh;
      padding: 20px;
    }
    .sidebar a {
      display: block;
      padding: 10px 20px;
      color: #000;
      text-decoration: none;
      font-size: medium;
    }
    .sidebar a.active{
      background: #1f6d6e;
      color: #fff;
    }
    .sidebar a:hover {
      background: #1f6d6e;
      color: #fff;
    }
    .profile-img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .stat-card {
      padding: 20px;
      border-radius: 8px;
      color: #000;
      margin-bottom: 20px;
    }
    .stat-card h3 {
      font-weight: bold;
    }
    .bg-blue { background-color: #cfe2ff; }
    .bg-pink { background-color: #f8d7da; }
    .bg-green { background-color: #d1e7dd; }
    .action-btns .btn {
      margin-right: 5px;
    }

    /* Style for the Current Plan section */
        .current-plan-card {
            background-color: #e0f7fa; /* Light blue background */
            padding: 15px;
            border-radius: .3rem;
        }
        .current-plan-card h2 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .badge-active {
            background-color: #28a745; /* Green for Active */
        }
        .badge-pending {
            background-color: #ffc107; /* Yellow/Orange for Pending */
            color: #343a40; /* Dark text for visibility */
        }

  </style>
