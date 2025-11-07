@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Agent Orders</h1>
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
            <li class="current">Agent Order</li>
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
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>SL</th>
                            <th>Invoice No</th>
                            <th>Plan Name</th>
                            <th>Price</th>
                            <th>Payment Date</th>
                            <th>Expire Date</th>
                            <th>
                                Payment Method & Transaction Id
                            </th>
                            <th>Status</th>
                            <th>Print Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orders->count() !== 0)
                            @foreach ($orders as $order)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$order->invoice_no}}</td>
                            <td>{{$order->package->name}}
                                <br>@if ($order->currently_active == 1)
                                    <span class="badge badge-active py-1 px-1">Active</span>
                                @endif
                            </td>
                            <td>${{$order->paid_amount}}</td>
                            <td>{{$order->purchase_date}}</td>
                            <td>{{$order->expire_date}}</td>
                            <td style="word-wrap: break-word; word-break: break-all;">
                                {{$order->payment_method}}<br>
                                {{$order->transaction_id}}
                            </td>
                            <td>
                                @if ($order->status == 'Completed')
                                    <span class="badge badge-active py-2 px-3">{{$order->status}}</span>
                                @else
                                    <span class="badge badge-pending py-2 px-3">Pending</span>
                                @endif
                            </td>
                            <td><a href="{{route('agent_invoice',$order->id)}}">
                                <button class="btn btn-small btn-outline-primary">
                                <i class="bi bi-printer"></i>
                            </button></a></td>
                            </tr>
                        @endforeach


                    </tbody>
                       @else
                       <p><span class="badge badge-pending py-3 px-4">No Data have here!</span></p>

                        @endif
                </table>
            </div>
      </div>

    </div>
  </div>
  </main>



@endsection



