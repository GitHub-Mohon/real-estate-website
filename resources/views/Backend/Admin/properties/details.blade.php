@extends('backend.admin.layouts')

@section('main-content')
     <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Property Details - {{ $property->name }}</h4>
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
                    <tr>
                        <th>Featured Photo</th>
                        <td><img src="{{asset('uploads/properties/'. $property->featured_photo . ' ')}}" alt="No Picture" style="width: 200px; height: 150px;"></td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{ $property->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $property->slug }}</td>
                    </tr>
                    <tr>
                        <th>Agent</th>
                        <td>{{ $property->agent->name }}</td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>{{ $property->location->name }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{ $property->type->name }}</td>
                    </tr>
                    <tr>
                        <th>Amenities</th>
                        <td>
                            @foreach ($amenities as $amenity)
                                <span class="badge badge-active py-2 ">{{ $amenity->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ number_format($property->price,2,".",",") }}</td>
                    </tr>
                    <tr>
                        <th>Purpose</th>
                        <td>{{ $property->purpose }}</td>
                    </tr>
                    <tr>
                        <th>Bedroom(s)</th>
                        <td>{{ $property->bedroom }}</td>
                    </tr>
                    <tr>
                        <th>Bathroom(s)</th>
                        <td>{{ $property->bathroom }}</td>
                    </tr>
                    <tr>
                        <th>Size (SqFt)</th>
                        <td>{{ $property->size }} (SqFt)</td>
                    </tr>
                    <tr>
                        <th>Floor(s)</th>
                        <td>{{ $property->floor }}</td>
                    </tr>
                    <tr>
                        <th>Balcony(s)</th>
                        <td>{{ $property->balcony }}</td>
                    </tr>
                    <tr>
                        <th>Garage(s)</th>
                        <td>{{ $property->garage }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $property->address }}</td>
                    </tr>
                    <tr>
                        <th>Built in Year</th>
                        <td>{{ $property->built_year }}</td>
                    </tr>
                    <tr>
                        <th>Map</th>
                        <td><meta http-equiv="X-UA-Compatible" content="IE=7">Dhaka</td>
                    </tr>
                    <tr>
                        <th>Is Featured</th>
                        <td>@if ($property->is_featured == 1)
                            Yes
                        @else
                            No
                        @endif</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($property->status == 1)
                                Active
                            @else
                                Pending
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $property->description }}</td>
                    </tr>
                    <tr>
                        <th>Photo Gallery</th>
                        <td>
                            @foreach ($photo_galleries as $item)
                            <img src="{{ asset('uploads/properties/galleries/' .$item->photo.    ' ')}}" alt="not found" style="width: 250px; height: auto; padding-bottom: 4px;">
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Videos</th>
                        <td>
                            @foreach ($video_galleries as $item)
                            {{ $item->video }}
                            @endforeach
                        </td>
                    </tr>
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


