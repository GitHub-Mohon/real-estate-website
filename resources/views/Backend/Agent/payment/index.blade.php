@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Agent Payment</h1>
              <p class="mb-0">
                {{-- message --}}
                @include('backend.admin.alertsMessage')
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li class="current">Agent Payment</li>
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
        @if ($total_current_order > 0)

                <h5 class="mb-3">Current Plan</h5>
            <div class="current-plan-card mb-5" style="width: 300px;">
                <h2 class="text-dark">${{$current_order->package->price}}</h2>
                <p class="mb-0 text-secondary">{{$current_order->package->name}}</p>

                <p class="mb-0 text-secondary">
                ( {{$days_left}} days remaining )</p>
            </div>
        @else
            <div class="current-plan-card mb-5" style="width: 300px;">
                <p class="mb-0 text-secondary">You did not purchase any Plan yet!</p>
            </div>

        @endif
            @if (!empty($packages))

            <h5 class="mb-4">Upgrade Plan (Make Payment)</h5>
            <div class="row g-3 align-items-center" style="max-width: 600px;">

                <div class="col-auto">
                <form action="{{route('agent_stripe')}}" method="post">
                        @csrf
                    <select name="package_id" class="form-select">
                        <option selected disabled>Choose Plan</option>
                        @foreach ($packages as $package)
                        <option value="{{ $package->id }}">{{ $package->name }} (${{$package->price}})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-secondary py-2">Pay with Stripe</button>
                </div>
                </form>

                <div class="w-100"></div>
                <div class="col-auto">
                    <form action="" method="post">
                        @csrf
                    <select name="package_id" class="form-select">
                        <option selected disabled>Choose Plan</option>
                        @foreach ($packages as $package)
                        <option value="{{ $package->id }}">{{ $package->name }} (${{$package->price}})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <button type="button" class="btn btn-secondary py-2" >Pay with Card</button>
                </div>
                </form>


            </div>

            @endif
      </div>

    </div>
  </div>
  </main>



@endsection



