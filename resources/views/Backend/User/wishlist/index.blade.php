@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Wishlist</h1>
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
            <li class="current">Wishlist</li>
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
                    <thead class="bg-light">
                        <tr>
                            <th>SL</th>
                            <th>Photo</th>
                            <th>Property</th>
                            <th>Property Price</th>
                            <th>Property Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($wishlists->count() !== 0)
                            @foreach ($wishlists as $wishlist)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img src="{{asset('uploads/properties/'. $wishlist->property->featured_photo . ' ')}}" alt="No Picture" style="width: 150px; height: 100px;"></td>
                            <td>{{$wishlist->property->name}}</td>
                            <td>${{number_format($wishlist->property->price,0,",")}}</td>
                            <td><a href="{{ route('property_details',$wishlist->property->slug) }}" ><button class="btn btn-action-edit "><i class="bi bi-eye"> Details?</i></button></a></td>
                            <td><a href="{{route('remove_wishlist',$wishlist->id)}}" onclick="return confirm('Are you sure! you want to remove this wishlist?');"><button class="btn btn-action-delete "><i class="bi bi-trash-fill"> Remove?</i></button></a></td>
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



