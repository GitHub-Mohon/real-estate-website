@extends('frontend.layouts.master')

@section('main-content')

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Invoice No: {{$order->invoice_no}}</h1>
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
            <li class="current">Agent Invoice</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->


    <div class="container">
    <div class="row">

      <!-- Sidebar -->

      @include('backend.agent.sidebar.index')

            <!-- Main Content -->
      <div class="col-md-9 col-lg-10 p-4" id="print_invoice" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
        <div class="row">
            <div class="col-md-6 invoice-header">
                <img src="{{asset('assets/images/logos/seodashlogo.png')}}" style="width: 80px; height: 80px;" alt="no logo">
            </div>
            <div class="col-md-6 invoice-header" style="text-align: right;">
                    <h2>Invoice</h2>
                    <p>Invoice No: {{$order->invoice_no}}</p>
                    <p>Date: {{$order->purchase_date}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6" style="padding: 10px 0px;">
                <h4>Invoice To:</h4>
                <p>{{$order->agent->name}}</p>
                <p>Email: {{$order->agent->email}}</p>
                <p>Phone: {{$order->agent->phone}}</p>
                <p>{{$order->agent->address}},</p>
                <p>{{$order->agent->city}}, {{$order->agent->state}}, {{$order->agent->country}}, {{$order->agent->zip}}</p>
            </div>
            <div class="col-md-6 text-end"  style="padding: 10px 0;">
                <h4>Invoice From:</h4>
                <p>CHB Real Estate Laravel</p>
                <p>Email: {{$admin_data->email}}</p>
                <p>Phone: 215-899-5780</p>
                <p>3145 Glen Falls Road, Bensalem, PA 19020</p>
            </div>
        </div>

        <div class="invoice-details">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Package Name</th>
                        <th>Package Price</th>
                        <th>Purchase Date</th>
                        <th>Expire Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{$order->package->name}}</td>
                        <td>${{$order->paid_amount}}</td>
                        <td>{{$order->purchase_date}}</td>
                        <td>{{$order->expire_date}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="invoice-footer">
            <p>Payment Method: {{$order->payment_method}}</p>
            <h3>Total: ${{$order->paid_amount}}</h3><br>
            <button onclick="printInvoice();" class="btn btn-primary">Print Invoice</button>
        </div>
        </div>
      </div>
    </div>
  </div>
  </main>

<script>
        function printInvoice() {
            let body = document.body.innerHTML;
            let data = document.getElementById('print_invoice').innerHTML;
            document.body.innerHTML = data;
            window.print();
            document.body.innerHTML = body;
        }

    </script>

@endsection



