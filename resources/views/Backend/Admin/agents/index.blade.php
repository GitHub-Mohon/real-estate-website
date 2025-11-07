@extends('backend.admin.layouts')

@section('main-content')
     <div class="content ">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Agents</h4>
                <a href="{{ route('admin_agent_create') }}" class="btn btn-primary btn-sm ms-auto">+ Add New Agent</a>
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
                            <th>Photo</th>
                            <th>Name </th>
                            <th>Email </th>
                            <th>Status </th>
                            <th>Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($agents))
                                @foreach ($agents as $agent)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>@if ($agent->photo)
                                        <img src="{{asset('uploads/agent/'. $agent->photo . ' ')}}" alt="No Picture" style="width: 100px; height: 80px;"></td>
                                    @else
                                        <i class="bi bi-person" style="font-size:60px; color:#1F6D6E"></i>
                                    @endif
                                    <td>{{$agent->name}}</td>
                                    <td>{{$agent->email}}</td>
                                    <td>
                                        @if ($agent->status == 1)
                                            <span class="badge bg-success py-2 px-2">Active</span>
                                        @elseif ($agent->status == 2)
                                            <span class="badge bg-danger py-2 px-2">Suspended</span>
                                        @else
                                            <span class="badge bg-warning py-2 px-2">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin_agent_edit',$agent->id)}}">
                                            <button class="btn btn-action-edit me-1"><i class="bi bi-pencil-square"></i></button>
                                        </a>
                                        <a href="{{route('admin_agent_destroy',$agent->id)}}" onclick="return confirm('Are you sure you want to delete this agent?');"><button class="btn btn-action-delete "><i class="bi bi-trash-fill"></i></button></a>
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


