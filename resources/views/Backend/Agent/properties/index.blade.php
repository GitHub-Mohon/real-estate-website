@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Agent Properties</h1>
              <p class="mb-0">
                {{-- message --}}
                @include('backend.admin.alertsMessage')
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li class="current">Agent Properties</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->


    <div class="container">
    <div class="row">

      <!-- Sidebar -->

      @include('backend.agent.sidebar.index')

            <!-- Main Content -->
      <div class="col-md-9 col-lg-10 p-4"  data-aos="fade-up" data-aos-delay="200">
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>SL</th>
                            <th>Featured Photo</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Purpose</th>
                            <th>Status</th>
                            <th>Option</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($properties))
                            @foreach ($properties as $property)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img src="{{asset('uploads/properties/'. $property->featured_photo . ' ')}}" alt="No Picture" style="width: 100px; height: 80px;"></td>
                            <td>{{$property->name}}</td>
                            <td>{{$property->type->name}}</td>
                            <td>{{$property->location->name}}</td>
                            <td>{{$property->purpose}}</td>
                            <td>@if ($property->status == 1)
                                    <span class="badge badge-active py-2 px-2">Active</span>
                                @else
                                    <span class="badge badge-pending py-2 px-2">Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('agent_property_photo_gallery',$property->id)}}">
                                    <button class="btn btn-action-edit me-1"><i class="bi bi-eye"></i>Photo Gallery</button>
                                </a>
                                <a href="{{route('agent_property_video_gallery',$property->id)}}"><button class="btn btn-action-delete "><i class="bi bi-eye"></i>Video Gallery</button></a>
                            </td>
                            <td>
                                <a href="{{route('agent_property_edit',$property->id)}}">
                                    <button class="btn btn-action-edit me-1"><i class="bi bi-pencil-square"></i></button>
                                </a>
                                <a href="{{route('agent_property_destroy',$property->id)}}" onclick="return confirm('Are you sure you want to delete this property?');"><button class="btn btn-action-delete "><i class="bi bi-trash-fill"></i></button></a>
                            </td>
                            </tr>
                        @endforeach
                        @else
                            <td>
                                <span class="badge badge-pending py-3 px-4">No Data have here!</span>
                            </td>
                        @endif

                    </tbody>
                </table>
            </div>
      </div>

    </div>
  </div>
  </main>



@endsection



