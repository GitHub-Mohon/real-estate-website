@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Agent Dashboard</h1>
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
            <li class="current">Agent Dashboard</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->


    <div class="container">
    <div class="row">

      <!-- Sidebar -->

      @include('backend.agent.sidebar.index')

            <!-- Main Content -->
      <div class="col-md-9 col-lg-10 p-4">
        <h5>Hello, {{Auth::guard('agent')->user()->name}}</h5>
        <p>See all the statistics at a glance:</p>

        <!-- Stat Cards -->
        <div class="row">
          <div class="col-md-4">
            <div class="stat-card bg-blue text-center">
              <h3>{{ number_format($active_property,0,",") }}</h3>
              <p>Active Properties</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card bg-pink text-center">
              <h3>{{ number_format($pending_property,0,",") }}</h3>
              <p>Pending Properties</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card bg-green text-center">
              <h3>{{ number_format($featured_property,0,",") }}</h3>
              <p>Featured Properties</p>
            </div>
          </div>
        </div>

        <!-- Recent Properties Table -->
        <h6 class="mt-4">Recent Properties</h6>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="table-light">
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Type</th>
                <th>Location</th>
                <th>Status</th>
                <th>Action</th>
                <th>Created Date</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($properties as $property)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('property_details',$property->slug) }}"><b>{{ $property->name }}</b></a></td>
                <td>{{ $property->type->name }}</td>
                <td>{{ $property->location->name }}</td>
                <td>
                    @if ($property->status == 1)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Pending</span>
                    @endif
                </td>
                <td class="action-btns">
                <a href="{{route('agent_property_edit',$property->id)}}">
                  <button class="btn btn-warning btn-sm">✏️</button>
                </a>
                <a ref="{{route('agent_property_destroy',$property->id)}}" onclick="return confirm('Are you sure you want to delete this property?');"></a>
                  <button class="btn btn-danger btn-sm">🗑️</button>
                </a>
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($property->created_at)->format('d-m-y') }}
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </div>
  </main>



@endsection


