@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
  <div class="content">
    <div class="row g-1">
      <div class="col-md-12">
        <div class="stat-card">
          <div class="stat-text">
            <h3>Dashboard</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="row g-3">
      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon bg-blue">
            <i class="bi bi-box"></i>
          </div>
          <div class="stat-text">
            <h6>Total Packages</h6>
            <h3>{{ number_format($total_package,0,",") }}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon bg-red">
            <i class="bi bi-cart"></i>
          </div>
          <div class="stat-text">
            <h6>Total Orders</h6>
            <h3>{{ number_format($total_order,0,",") }}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon bg-orange">
            <i class="bi bi-people"></i>
          </div>
          <div class="stat-text">
            <h6>Total Customers</h6>
            <h3>{{ number_format($total_customer,0,",") }}</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon bg-blue">
            <i class="bi bi-house-gear"></i>
          </div>
          <div class="stat-text">
            <h6>Total Active Properties</h6>
            <h3>{{ number_format($total_property,0,",") }}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon bg-red">
            <i class="bi bi-house-gear"></i>
          </div>
          <div class="stat-text">
            <h6>Total Inactive Properties</h6>
            <h3>{{ number_format($inactive_property,0,",") }}</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon bg-orange">
            <i class="bi bi-people"></i>
          </div>
          <div class="stat-text">
            <h6>Total Agents</h6>
            <h3>{{ number_format($total_agent,0,",") }}</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
