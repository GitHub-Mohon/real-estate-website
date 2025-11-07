@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Customer Messages</h1>
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
            <li class="current">Customer Messages</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->


    <div class="container">
    <div class="row">

      <!-- Sidebar -->

      @include('backend.user.sidebar')

            <!-- Main Content -->
      <div class="col-md-9 col-lg-10 p-4"  data-aos="fade-up" data-aos-delay="200">
            <form action="{{route('message_store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                   <div class="col-md-12">
                    <div class="mb-3">
                        <label for="picture" class="form-label">Picture*</label>
                    <input type="file" class="form-control" id="picture" name="file">
                    </div>
                   </div>

                  <div class="col-md-12">
                  <div class="mb-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject*</label>
                        <input type="text" class="form-control" id="name" name="subject" value="{{ old('subject') }}">
                    </div>
                  </div>
                  <div class="mb-6">
                    <div class="mb-3">
                        <label for="body" class="form-label">Messages</label>
                        <textarea name="message_body" class="form-control" rows="5" id="body">{{ old('message_body') }}</textarea>
                    </div>
                  </div>
                  <div class="mb-6">
                    <div class="mb-3">
                        <label for="agent" class="form-label">Select Agent</label>
                        <select name="agent_id" id="agent"  class="form-control">
                            @foreach ($agents as $agent)
                                <option value="{{ $agent->id }}" class="form-control">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  </div>
                  <br>
                  <button type="submit" class="btn btn-primary">Send Messages</button>
                </form>
      </div>

    </div>
  </div>
  </main>


@endsection



