@extends('backend.admin.layouts')

@section('main-content')
     <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Orders</h4>
              </div>
            </div>
        </div>
    </div>
 </div>
  <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        Show
                        <select class="form-select form-select-sm mx-2" style="width: auto;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        entries
                    </div>
                    <div class="input-group" style="width: 200px;">
                        <span class="input-group-text p-1 border-0 bg-white" id="search-addon">Search:</span>
                        <input type="search" class="form-control form-control-sm" placeholder="" aria-label="Search" aria-describedby="search-addon">
                    </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>SL</th>
                            <th>Invoice No</th>
                            <th>Agent info</th>
                            <th>Plan Name</th>
                            <th>Price</th>
                            <th>Payment Date</th>
                            <th>Expire Date</th>
                            <th>
                                Payment Method & Transaction Id
                            </th>
                            <th>Status</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($orders))
                            @foreach ($orders as $order)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$order->invoice_no}}</td>
                            <td><strong>{{$order->agent->name}}</strong><br>
                                {{$order->agent->email}}
                            </td>
                            <td>{{$order->package->name}}
                                <br>@if ($order->currently_active == 1)
                                    <span class="badge badge-active py-1 px-1">Active</span>
                                @endif
                            </td>
                            <td><strong>${{$order->paid_amount}}</strong></td>
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
                            <td><a href="{{route('admin_order_invoice',$order->id)}}">
                                <button class="btn btn-small btn-outline-primary">
                                <i class="bi bi-printer"></i>
                            </button></a></td>
                            </tr>
                        @endforeach
                        @else
                            <td>
                                <span class="badge badge-pending py-3 px-4">No Data have here!</span>
                            </td>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Showing 1 to 3 of 3 entries
                    </div>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
        </div>
    </div>
 </div>
@endsection


