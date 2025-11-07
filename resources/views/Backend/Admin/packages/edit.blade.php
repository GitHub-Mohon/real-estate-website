@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Update Package</h4>
                <a href="{{ route('admin_package_index') }}" class="btn btn-primary btn-sm ms-auto"> <i class="bi bi-eye"></i> View All</a>
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
                <form action="{{route('admin_package_update',$singlePackage->id)}}" method="post">
                    @csrf

                  <div class="mb-6">
                    <label for="name" class="form-label">Name*</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="package name" value="{{$singlePackage->name}}">
                  </div>
                  <div class="mb-6">
                    <label for="price" class="form-label">Price*</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="$"  value="{{$singlePackage->price}}">
                  </div>
                  <div class="mb-6">
                    <label for="allowed_days" class="form-label">Allowed Days*</label>
                    <input type="number" class="form-control" id="allowed_days" name="allowed_days" placeholder="10 days" value="{{$singlePackage->allowed_days}}">
                    <span>-1 means Unlimate</span>
                  </div>
                  <div class="mb-6">
                    <label for="allowed_properties" class="form-label">Allowed Properties*</label>
                    <input type="number" class="form-control" id="allowed_properties" name="allowed_properties" placeholder="15 properties"  value="{{$singlePackage->allowed_properties}}">
                  </div>

                  <div class="mb-3">
                    <label for="allowed_featured_properties" class="form-label">Allowed Featured Properties</label>
                    <input type="number" class="form-control" id="allowed_featured_properties" name="allowed_featured_properties" placeholder="10 featured properties"  value="{{$singlePackage->allowed_featured_properties}}">
                  </div>
                  <div class="mb-3">
                    <label for="allowed_photos" class="form-label">Allowed Photos</label>
                    <input type="number" class="form-control" id="allowed_photos" name="allowed_photos" placeholder="10 allowed photos" value="{{$singlePackage->allowed_photos}}">
                  </div>
                  <div class="mb-3">
                    <label for="allowed_videos" class="form-label">Allowed Videos</label>
                    <input type="number" class="form-control" id="allowed_videos" name="allowed_videos" placeholder="10 allowed videos" value="{{$singlePackage->allowed_videos}}">
                  </div>
                  <button type="submit" class="btn btn-primary">Update Package</button>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
