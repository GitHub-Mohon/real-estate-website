@extends('backend.admin.layouts')

@section('main-content')
     <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Properties</h4>
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
                            <th>Featured Photo</th>
                            <th>Title</th>
                            <th>Agent</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Purpose</th>
                            <th>Featured?</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($properties))
                                @foreach ($properties as $property)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><img src="{{asset('uploads/properties/'. $property->featured_photo . ' ')}}" alt="No Picture" style="width: 100px; height: 80px;"></td>
                                    <td>{{$property->name}}</td>
                                    <td>{{$property->agent->name}}</td>
                                    <td>{{$property->location->name}}</td>
                                    <td>{{$property->type->name}}</td>
                                    <td>For {{$property->purpose}}</td>
                                    <td>@if ($property->is_featured == 1)
                                        Yes
                                    @else
                                        No
                                    @endif</td>
                                    <td>${{number_format($property->price,2,".", ",")}}</td>
                                    <td>@if ($property->status == 1)
                                        <span class="badge badge-active py-2 px-3">Active</span>
                                    @else
                                        <span class="badge badge-pending py-2 px-3">Pending</span>
                                    @endif
                                    <div><a href="{{ route('admin_property_change_status',$property->id) }}">Change</a></div>
                                </td>
                                    <td>
                                        <a href="{{route('admin_property_details',$property->id)}}">
                                            <button class="btn btn-action-edit me-1"><i class="bi bi-eye"></i></button>
                                        </a>
                                        <a href="{{route('admin_property_destroy',$property->id)}}" onclick="return confirm('Are you sure you want to delete this property?');"><button class="btn btn-action-delete "><i class="bi bi-trash-fill"></i></button></a>
                                    </td>
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


