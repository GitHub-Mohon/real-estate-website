
@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Property Galleries</h1>
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
            <li class="current">Property Galleries</li>
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
        <div style="padding: 20px 0"></div>
        <form action="{{route('agent_property_video_gallery_store',$property->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
            <div class="row mb-3">
                <div class="col-md-8">
                    <input type="text" class="form-control" name="video" placeholder="Youtube video id" required>
                </div>
            </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-small">Add Video</button><br>
                    </div>
                </div>
        </form>
            <div class="row mb-3">
                @if ($videos == null)
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        Video not found
                    </div>
                </div>
                @else
                <div class="row mb-3">
                    <div class="col-md-12">
                    <div class="alert alert-primary">
                        Existing Videos
                    </div>
                </div>
                @foreach ($videos as $video)
                </div>
                <div class="col-md-4 mb-3">
                    <a href="https://www.youtube.com/watch?v={{ $video->video }}" class="glightbox">
                    <div class="overlay-content">
                      <i class="bi bi-play-circle-fill play-icon"></i>
                      <span>Watch Our Story</span>
                    </div>
                  </a>
                    <br>
                    <a href="{{route('agent_property_video_gallery_delete',$video->id)}}" onclick="return confirm('Are you sure you want to delete this Video?');"><button class="btn btn-action-delete "><i class="bi bi-trash-fill"></i></button></a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
  </main>



@endsection


