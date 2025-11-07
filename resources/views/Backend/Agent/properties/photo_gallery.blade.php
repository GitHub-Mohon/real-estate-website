
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
        <form action="{{route('agent_property_photo_gallery_store',$property->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="file" class="form-control" id="picture" name="photo" placeholder="Gallery Photo" required>
                </div>
            </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-small">Add Gallery</button><br>
                    </div>
                </div>
        </form>
            <div class="row mb-3">
                @if ($galleries == null)
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        Gallery Photo not found
                    </div>
                </div>
                @else
                <div class="row mb-3">
                    <div class="col-md-12">
                    <div class="alert alert-primary">
                        Existing Photos
                    </div>
                </div>
                @foreach ($galleries as $gallery)
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('uploads/properties/galleries/' .$gallery->photo.    ' ')}}" alt="not found" style="width: 250px; height: auto;">
                    <div>
                        <br>
                        <a href="{{route('agent_property_photo_gallery_delete',$gallery->id)}}" onclick="return confirm('Are you sure you want to delete this Photo?');"><button class="btn btn-action-delete "><i class="bi bi-trash-fill"></i></button></a>
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


