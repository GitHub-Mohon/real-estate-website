@extends('backend.admin.layouts')

@section('main-content')
 <div class="content ">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                    <h4 class="mb-1">Invoice No: {{$order->invoice_no}}</h4>
                </div>
            </div>
        </div>
    </div>
 </div>
 <div class="content" id="print_invoice">
    <div class="row g-3">
        <div class="col-md-12">
            <div>
                <img src="{{asset('assets/images/logos/seodashlogo.png')}}" style="width: 80px; height: 80px;" alt="no logo">
            </div>

            <div style="text-align-last: right">
                    <h2>Invoice</h2>
                    <p>Invoice No: {{$order->invoice_no}}</p>
                    <p>Date: {{$order->purchase_date}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-12">
            <div style="padding: 10px 0px; text-align: left;">
                <h4>Invoice To:</h4>
                <p>{{$order->agent->name}}</p>
                <p>Email: {{$order->agent->email}}</p>
                <p>Phone: {{$order->agent->phone}}</p>
                <p>{{$order->agent->address}},</p>
                <p>{{$order->agent->city}}, {{$order->agent->state}}, {{$order->agent->country}}, {{$order->agent->zip}}</p>
            </div>
            <div class="text-end"  style="padding: 10px 0; text-align: right;">
                <h4>Invoice From:</h4>
                <p>CHB Real Estate Laravel</p>
                <p>Email: {{$admin_data->email}}</p>
                <p>Phone: 215-899-5780</p>
                <p>3145 Glen Falls Road, Bensalem, PA 19020</p>
            </div>
        </div>
    </div>
    <div class="row">
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






