@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Create Subscriber</h4>
                <a href="{{ route('admin_subscriber_index') }}" class="btn btn-primary btn-sm ms-auto"> <i class="bi bi-eye"></i> View All</a>
              </div>
              @include('backend.admin.alertsMessage')
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
                <form action="{{route('admin_subscriber_store')}}" method="post" >
                    @csrf

                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="email" class="form-label">Subscriber*</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="subscriber email" value="{{ old('email') }}">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Add Subscriber</button>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
