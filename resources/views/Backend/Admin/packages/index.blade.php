@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Packages</h4>
                <a href="{{ route('admin_package_create') }}" class="btn btn-primary btn-sm ms-auto">+ Add New Packages</a>
              </div>
            </div>
        </div>
    </div>
 </div>
  </div>
  <div class="content">
    <div class="row g-3">
      <div class="col-md-12">
        <div class="stat-card">
          <div class="data-table-card">
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
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>SL <i class="bi bi-arrow-down-up"></i></th>
                                <th>Name <i class="bi bi-arrow-down-up"></i></th>
                                <th>Price <i class="bi bi-arrow-down-up"></i></th>
                                <th>Allowed Days <i class="bi bi-arrow-down-up"></i></th>
                                <th>Allowed Properties <i class="bi bi-arrow-down-up"></i></th>
                                <th>Allowed Featured Properties <i class="bi bi-arrow-down-up"></i></th>
                                <th>Allowed Photos <i class="bi bi-arrow-down-up"></i></th>
                                <th>Allowed Videos <i class="bi bi-arrow-down-up"></i></th>
                                <th>Status<i class="bi bi-arrow-down-up"></i></th>
                                <th>Action <i class="bi bi-arrow-down-up"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($packages))
                                @foreach ($packages as $package)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$package->name}}</td>
                                    <td>${{$package->price}}</td>
                                    <td>{{$package->allowed_days}}</td>
                                    <td>
                                        @if ($package->allowed_properties != -1)
                                            {{$package->allowed_properties}}
                                        @else
                                            Unlimited
                                        @endif
                                    </td>
                                    <td>
                                        @if ($package->allowed_featured_properties != -1)
                                            {{$package->allowed_featured_properties}}
                                        @else
                                            Unlimited
                                        @endif
                                    </td>
                                    <td>
                                        @if ($package->allowed_photos != -1)
                                            {{$package->allowed_photos}}
                                        @else
                                            Unlimited
                                        @endif
                                    </td>
                                    <td>
                                        @if ($package->allowed_videos != -1)
                                            {{$package->allowed_videos}}
                                        @else
                                            Unlimited
                                        @endif
                                    </td>
                                    <td>
                                        @if ($package->status == 1)
                                            Active
                                        @elseif($package->status == 0)
                                            Inactive
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin_package_edit',$package->id)}}">
                                            <button class="btn btn-action-edit btn-sm me-1"><i class="bi bi-pencil-square"></i></button>
                                        </a>
                                        <a href="{{route('admin_package_destroy',$package->id)}}" onclick="return confirm('Are you sure you want to delete this package?');"><button class="btn btn-action-delete btn-sm"><i class="bi bi-trash-fill"></i></button></a>
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
    </div>
  </div>
@endsection
