@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Create Post</h4>
                <a href="{{ route('admin_post_index') }}" class="btn btn-primary btn-sm ms-auto"> <i class="bi bi-eye"></i> View All</a>
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
                <form action="{{route('admin_post_store')}}" method="post" enctype="multipart/form-data">
                    @csrf


                   <div class="col-md-12">
                    <div class="mb-3">
                        <label for="picture" class="form-label">Hero Picture*</label>
                        <input type="file" class="form-control" id="picture" name="featured_photo" placeholder="post image">
                    </div>
                   </div>

                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Title*</label>
                        <input type="text" class="form-control" id="name" name="title" placeholder="Title" value="{{ old('title') }}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="summary" class="form-label">Summary*</label>
                        <textarea name="summary" id="summary" rows="3" class="form-control" placeholder="summary">{{ old('summary') }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description*</label>
                        <textarea name="description" id="description" rows="7" class="form-control" >{{ old('description') }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <div class="col-md-6">
                            <label for="sub_title" class="form-label">Sub Title*</label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control" placeholder="Sub Title">
                        </div>
                        <div class="col-md-6">
                            <label for="photo" class="form-label">Side Photo*</label>
                            <input type="file" name="photo" id="photo" class="form-control" placeholder="Sub photo">
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="sub_summary" class="form-label">Sub Summary*</label>
                        <textarea name="sub_summary" id="sub_summary" class="form-control" rows="4" placeholder="Type your sub summary">{{ old('sub_summary') }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <div class="col-md-8">
                            <label for="sub_li" class="form-label">Sub List item*</label>
                            <textarea name="sub_li" id="sub_li" class="form-control" rows="4" placeholder="Type your sub components">{{ old('sub_li') }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="tags" class="form-label">Tags*</label>
                            <input type="text" name="tags" id="tags" class="form-control" placeholder="Tags">
                        </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Add Post</button>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
