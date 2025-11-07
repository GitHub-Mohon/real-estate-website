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
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="bg-light text-center">
                        <tr>
                            <th>SL</th>
                            <th>Subject</th>
                            <th>Agent</th>
                            <th>Go to Chat-Box?</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <a href="{{route('message_create')}}" class="btn btn-primary">New Messages</a>
                    <tbody>
                    @if ($messages->count() !== 0)
                            @foreach ($messages as $message)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$message->subject}}</td>
                            <td>{{$message->agent->name}}<br>
                                {{$message->agent->company}}
                            </td>
                            <td><a href="{{ route('message_chat',$message->id) }}" ><button class="btn btn-action-edit "><i class="bi bi-eye"> Go to live Chat</i></button></a></td>
                            {{-- <td><a href="{{route('message_chat',$message->id)}}" onclick="return confirm('Are you sure! you want to remove this wishlist?');"><button class="btn btn-action-delete "><i class="bi bi-trash-fill"> Remove?</i></button></a></td> --}}
                            </tr>
                    @endforeach
                    @else
                        <p><span class="badge badge-pending py-3 px-4">No Data have here!</span></p>
                    @endif

                    </tbody>
                </table>
            </div>
      </div>

    </div>
  </div>
  </main>



@endsection



