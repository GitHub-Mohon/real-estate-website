<div class="col-md-3 col-lg-2 sidebar"  data-aos="fade-up" data-aos-delay="200">
        <a href="{{route('agent_dashboard')}}" class=" {{Request::is('agent/dashboard') ? 'active' : ''}}">Dashboard</a>
        <a href="{{route('agent_payment')}}" class=" {{Request::is('agent/payment') ? 'active' : ''}}">Make Payment</a>
        <a href="{{route('agent_order')}}"  class=" {{Request::is('agent/order') ? 'active' : ''}}">Orders</a>
        <a href="{{route('agent_property_create')}}" class=" {{Request::is('agent/property/create') ? 'active' : ''}}">Add Property</a>
        <a href="{{route('agent_property_index')}}" class=" {{Request::is('agent/property/index') || Request::is('agent/property/edit/*') || Request::is('agent/property/delete/*')|| Request::is('agent/property/photo-gallery/*') || Request::is('agent/property/video-gallery/*') ? 'active' : ''}}">All Property</a>
        <a href="{{route('agent_message')}}" class=" {{Request::is('agent/message/*') ? 'active' : ''}}">Massage</a>
        <a href="{{route('agent_profile')}}" class=" {{Request::is('agent/profile') ? 'active' : ''}}">Edit Profile</a>
        <a href="{{route('agent_logout')}}">Logout</a>
      </div>
