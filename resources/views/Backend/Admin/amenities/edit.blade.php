@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Update Amenity</h4>
                <a href="{{ route('admin_amenity_index') }}" class="btn btn-primary btn-sm ms-auto"> <i class="bi bi-eye"></i> View All</a>
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
                <form action="{{route('admin_amenity_update',$singleAmenity->id)}}" method="post">
                    @csrf

                  <div class="mb-6">
                    <label for="name" class="form-label">Name*</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Amenity name" value="{{$singleAmenity->name}}">
                  </div>
                  <div class="mb-6">
                    <label for="slug" class="form-label">Slug*</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Amenity Slug" value="{{$singleAmenity->slug}}">
                  </div><br>

                  <button type="submit" class="btn btn-primary">Update Amenity</button>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
