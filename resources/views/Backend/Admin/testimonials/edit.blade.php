@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Create Testimonial</h4>
                <a href="{{ route('admin_testimonial_index') }}" class="btn btn-primary btn-sm ms-auto"> <i class="bi bi-eye"></i> View All</a>
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
                <form action="{{route('admin_testimonial_update',$singleTestimonial->id)}}" method="post" enctype="multipart/form-data">
                    @csrf


                   <div class="col-md-12">
                    <div class="mb-3">
                        @if ($singleTestimonial->photo ==null)
                        Photo not found
                        @else
                        <img src="{{ asset('uploads/testimonials/' .$singleTestimonial->photo.    ' ')}}" alt="not found" style="width: 250px; height: auto;">
                        @endif
                        <div id="emailHelp" class="form-text">Existing Photo</div><br>
                        <label for="picture" class="form-label">Change Testimonial Picture*</label>
                        <input type="file" class="form-control" id="picture" name="photo" placeholder="testimonial image">
                        </div>
                   </div>

                  <div class="col-md-12">
                    <div class="mb-3">
                        <div class="mb-6">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name',$singleTestimonial->name) }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="mb-6">
                            <label for="designation" class="form-label">Designation*</label>
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="designation" value="{{ old('designation',$singleTestimonial->designation) }}">
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject*</label>
                        <input type="text" class="form-control" id="subject" value="{{ old('subject',$singleTestimonial->subject) }}" name="subject" placeholder="testimonial subject">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comments*</label>
                        <textarea name="comments" id="comment" class="form-control" rows="7" placeholder="Type your comments">{{ old('comments',$singleTestimonial->comments) }}</textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Updated Testimonial</button>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
