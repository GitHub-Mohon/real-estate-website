@extends('backend.admin.layouts')

@section('main-content')
     <div class="content ">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Subscribers</h4>
                <a href="{{ route('subscriber_export') }}" class="btn btn-primary btn-sm ms-auto">+ Export Subscriber as CSV</a>
                <a href="{{ route('admin_subscriber_create') }}" class="btn btn-primary btn-sm ms-auto">+ Add New Subscriber</a>
              </div>
              @include('backend.admin.alertsMessage')
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
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($subscribers->count() == 0)
                        <p class="badge badge-pending">No Data Available!</p>
                        @else
                            @foreach ($subscribers as $subscriber)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$subscriber->email}}</td>
                                    <td>@if ($subscriber->status == 1)
                                        <span class="badge badge-active py-2 px-3">Active</span>
                                    @else
                                        <span class="badge badge-pending py-2 px-3">Pending</span>
                                    @endif
                                    <a href="{{ route('subscriber_change_status',$subscriber->id) }}">Change</a>
                                    <td>
                                        <a href="{{route('admin_subscriber_destroy',$subscriber->id)}}" onclick="return confirm('Are you sure you want to delete this subscriber?');"><button class="btn btn-action-delete "><i class="bi bi-trash-fill"></i></button></a>
                                    </td>
                                </tr>
                            @endforeach
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


