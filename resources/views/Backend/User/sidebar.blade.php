

<div class="col-md-3 col-lg-2 sidebar"  data-aos="fade-up" data-aos-delay="200">
        <a href="{{route('dashboard')}}" class=" {{Request::is('dashboard') ? 'active' : ''}}">Dashboard</a>
        <a href="{{route('message')}}" class=" {{Request::is('message/*') ? 'active' : ''}}">Massage</a>
        <a href="{{route('wishlist')}}" class=" {{Request::is('wishlist') ? 'active' : ''}}">Wishlist</a>
        <a href="{{route('profile')}}" class=" {{Request::is('profile') ? 'active' : ''}}">Edit Profile</a>
        <a href="{{route('logout')}}">Logout</a>
      </div>
