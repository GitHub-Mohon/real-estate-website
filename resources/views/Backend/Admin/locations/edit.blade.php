@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Create Location</h4>
                <a href="{{ route('admin_location_index') }}" class="btn btn-primary btn-sm ms-auto"> <i class="bi bi-eye"></i> View All</a>
              </div>
            </div>
        </div>
    </div>
 </div>
  </div>
  <div class="content">
    <div class="row g-3">
      <div class="col-md-12">
        <div class="stat-card">
          <div class="card-body">
                <form action="{{route('admin_location_update',$singleLocation->id)}}" method="post" enctype="multipart/form-data">
                    @csrf


                   <div class="col-md-12">

                    @if ($singleLocation->photo ==null)
                    Photo not found
                    @else
                    <img src="{{ asset('uploads/locations/' .$singleLocation->photo.    ' ')}}" alt="not found" style="width: 250px; height: auto;">
                    @endif
                    <div id="emailHelp" class="form-text">Existing Photo</div><br>
                    <label for="picture" class="form-label">Change Location Picture*</label>
                    <input type="file" class="form-control" id="picture" name="photo" placeholder="location image">
                   </div>

                  <div class="col-md-12">
                  <div class="mb-6">
                    <label for="name" class="form-label">Location Name*</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="location name" value="{{$singleLocation->name}}">
                  </div>
                  <div class="mb-6">
                    <label for="slug" class="form-label">Slug*</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="location slug"  value="{{$singleLocation->slug}}">
                  </div>
                  </div>
                  <br>
                  <button type="submit" class="btn btn-primary">Updated Location</button>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
