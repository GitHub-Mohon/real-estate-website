<!-- Sidebar -->
<style>

.sidebar {
  height: 100vh; /* Full height of viewport */
  overflow-y: auto; /* Enable vertical scrollbar if needed */
  overflow-x: hidden; /* Disable horizontal scroll */
}

  .sidebar-menu {
    list-style: none;
    padding-left: 0;
  }

  .sidebar-menu li {
    position: relative;
  }

  .sidebar-menu li a {
    display: block;
    padding: 10px 15px;
    color: #333;
    text-decoration: none;
  }

  .sidebar-menu li a:hover {
    background-color: #f0f0f0;
  }

  .submenu {
    list-style: none;
    padding-left: 20px;
    display: none;
  }

  .dropdown:hover .submenu {
    display: block;
  }

  .submenu li a {
    padding: 8px 15px;
    background-color: #f9f9f9;
  }

  .submenu li a:hover {
    background-color: #ddd;
  }
</style>

  <div class="sidebar">
<h4>Admin Panel</h4>

    <ul class="sidebar-menu">
  <li>
    <a href="{{route('admin_dashboard')}}" class=" {{Request::is('admin/dashboard') ? 'active' : ''}}"><i class="bi bi-speedometer2"></i> Dashboard</a>
  </li>
  <li>
    <a href="{{route('admin_setting')}}" class=" {{Request::is('admin/setting') ? 'active' : ''}}"><i class="bi bi-gear"></i> Settings</a>
  </li>
  <li>
    <a href="{{route('admin_package_index')}}" class=" {{Request::is('admin/package/*') ? 'active' : ''}}"><i class="bi bi-box"></i> Package</a>
  </li>
  <li>
    <a href="{{route('admin_order_index')}}" class=" {{Request::is('admin/order') || Request::is('admin/invoice/*') ? 'active' : ''}}"><i class="bi bi-cart"></i> Orders</a>
  </li>


    <li>
        <a href="{{route('admin_location_index')}}" class=" {{Request::is('admin/location/*') ? 'active' : ''}}"><i class="bi bi-geo-alt"></i> Locations</a>
    </li>
    <li>
        <a href="{{route('admin_type_index')}}" class=" {{Request::is('admin/type/*') ? 'active' : ''}}"><i class="bi bi-tags"></i> Types</a>
    </li>
    <li>
        <a href="{{route('admin_amenity_index')}}" class=" {{Request::is('admin/amenity/*') ? 'active' : ''}}"><i class="bi bi-building"></i> Amenities</a>
    </li>
    <li>
    <a href="{{route('admin_property_index')}}" class=" {{Request::is('admin/property/*') ? 'active' : ''}}"><i class="bi bi-house-gear"></i> Properties</a>
    </li>

<li>
    <a href="{{route('admin_agent_index')}}" class=" {{Request::is('admin/agent/*') ? 'active' : ''}}"><i class="bi bi-people"></i> Agents</a>
</li>
<li>
    <a href="{{route('admin_customer_index')}}" class=" {{Request::is('admin/customer/*') ? 'active' : ''}}"><i class="bi bi-people"></i> Customers</a>
</li>
<li>
    <a href="{{route('admin_testimonial_index')}}" class=" {{Request::is('admin/testimonial/*') ? 'active' : ''}}"><i class="bi bi-chat"></i> Testimonials</a>
</li>
<li>
    <a href="{{route('admin_post_index')}}" class=" {{Request::is('admin/post/*') ? 'active' : ''}}"><i class="bi bi-pencil"></i> Blog Posts</a>
</li>
<li>
    <a href="{{route('admin_subscriber_index')}}" class=" {{Request::is('admin/subscriber/*') ? 'active' : ''}}"><i class="bi bi-bell"></i> Subscribers</a>
</li>
<li>
    <a href="{{route('admin_profile')}}" class=" {{Request::is('admin/profile') ? 'active' : ''}}"><i class="bi bi-person"></i> Edit Profile</a>
</li>
<li>
    <a href="{{route('admin_logout')}}"><i class="bi bi-box-arrow-right"></i> Logout</a>
</li>



  <!-- Add more menu items here -->
</ul>

  </div>
