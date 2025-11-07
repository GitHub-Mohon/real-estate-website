@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Edit Post</h4>
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
                <form action="{{route('admin_post_update',$singlePost->id)}}" method="post" enctype="multipart/form-data">
                    @csrf


                   <div class="col-md-12">
                    <div class="mb-3">
                            @if ($singlePost->featured_photo ==null)
                            Photo not found
                            @else
                            <img src="{{ asset('uploads/posts/' .$singlePost->featured_photo.    ' ')}}"     alt="not found" style="width: 250px; height: auto;">
                            @endif
                            <div id="emailHelp" class="form-text">Existing Photo</div><br>
                            <label for="picture" class="form-label">Change Hero Picture*</label>
                            <input type="file" class="form-control" id="picture" name="featured_photo" placeholder="post image">
                    </div>
                   </div>

                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Title*</label>
                        <input type="text" class="form-control" id="name" name="title" placeholder="Title" value="{{ old('title',$singlePost->title) }}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="summary" class="form-label">Summary*</label>
                        <textarea name="summary" id="summary" rows="3" class="form-control" placeholder="summary">{{ $singlePost->summary  }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description*</label>
                        <textarea name="description" id="description" rows="7" class="form-control" >{{ $singlePost->description }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <div class="col-md-6">
                            <label for="sub_title" class="form-label">Sub Title*</label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control" placeholder="Sub Title" value="{{ $singlePost->sub_title }}">
                        </div>
                        <div class="col-md-6">
                            @if ($singlePost->photo ==null)
                            Photo not found
                            @else
                            <img src="{{ asset('uploads/posts/' .$singlePost->photo.    ' ')}}"     alt="not found" style="width: 250px; height: auto;">
                            @endif
                            <div id="emailHelp" class="form-text">Existing Photo</div><br>
                            <label for="sid_photo" class="form-label">Change Side Picture*</label>
                            <input type="file" name="photo" id="photo" class="form-control" placeholder="Sub photo">
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="sub_summary" class="form-label">Sub Summary*</label>
                        <textarea name="sub_summary" id="sub_summary" class="form-control" rows="4" placeholder="Type your sub summary">{{ $singlePost->sub_summary  }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <div class="col-md-8">
                            <label for="sub_li" class="form-label">Sub List item*</label>
                            <textarea name="sub_li" id="sub_li" class="form-control" rows="4" placeholder="Type your sub components">{{ $singlePost->sub_li  }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="tags" class="form-label">Tags*</label>
                            <input type="text" name="tags" id="tags" class="form-control" placeholder="Tags" value="{{ $singlePost->tags }}">
                        </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Update Post</button>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
