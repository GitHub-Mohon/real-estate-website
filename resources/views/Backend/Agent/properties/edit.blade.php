
@extends('frontend.layouts.master')

@section('main-content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Updated Property</h1>
              <p class="mb-0">
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li class="current">Updated Property</li>
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
        <div style="padding: 20px 0"></div>
        <form action="{{route('agent_property_update',$singleProperty->id)}}" method="post" enctype="multipart/form-data">
                    @csrf


            <div class="row mb-3">
                <div class="col-md-4">
                    @if ($singleProperty->featured_photo ==null)
                    Photo not found
                    @else
                    <img src="{{ asset('uploads/properties/' .$singleProperty->featured_photo.    ' ')}}" alt="not found" style="width: 250px; height: auto;">
                    @endif
                    <div id="emailHelp" class="form-text">Existing Photo</div><br>
                    <label for="picture" class="form-label">Change Featured Photo <span style="color: red">*</span></label>
                    <input type="file" class="form-control" id="picture" name="photo" placeholder="Featured Photo">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                  <label for="title" class="form-label">Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" id="title" name="name" value="{{old('name',$singleProperty->name)}}" placeholder="Title">
                </div>
                <div class="col-md-4">
                  <label for="slug" class="form-label">Slug <span style="color: red">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug',$singleProperty->slug)}}" placeholder="slug-tag">
                </div>
                <div class="col-md-4">
                  <label for="price" class="form-label">Price <span style="color: red">*</span></label>
                    <input type="number" class="form-control" id="price" name="price" value="{{old('price',$singleProperty->price)}}" placeholder="$015" min="0">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                  <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control editor" id="description" cols="30" rows="10">{{old('description',$singleProperty->description)}}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                  <label for="location" class="form-label">Location <span style="color: red">*</span></label>
                  <select name="location_id" class="form-control" id="location">
                        <option selected disabled>Select Location</option>
                    @foreach ($locations as $location)
                        <option value="{{$location->id}}" {{ $location->id == $singleProperty->location_id ? 'selected' : '' }}>{{old('name',$location->name)}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="type" class="form-label">Type <span style="color: red">*</span></label>
                  <select name="type_id" class="form-control" id="type">
                    <option selected disabled>Select Type</option>
                    @foreach ($types as $type)
                        <option value="{{$type->id}}" {{ $type->id == $singleProperty->type_id ? 'selected' : '' }}>{{old('name',$type->name)}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="purpose" class="form-label">Purpose <span style="color: red">*</span></label>
                  <select name="purpose" class="form-control" id="purpose">
                    <option selected disabled>Select Purpose</option>
                    <option value="Rent" {{ $singleProperty->purpose == "Rent" ? 'selected' : '' }}>For Rent</option>
                    <option value="Sale" {{ $singleProperty->purpose == "Sale" ? 'selected' : '' }}>For Sale</option>
                  </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="bedroom" class="form-label">Bedroom <span style="color: red">*</span></label>
                    <input type="number" class="form-control" id="bedroom" name="bedroom" value="{{old('bedroom', $singleProperty->bedroom)}}" placeholder="00" min="0">
                </div>
                <div class="col-md-4">
                    <label for="bathroom" class="form-label">Bathroom <span style="color: red">*</span></label>
                    <input type="number" class="form-control" id="bathroom"  name="bathroom" value="{{old('bathroom', $singleProperty->bathroom)}}" placeholder="00" min="0">
                </div>
                <div class="col-md-4">
                    <label for="size" class="form-label">Size (SqFt) <span style="color: red">*</span></label>
                    <input type="number" class="form-control" id="size" name="size" value="{{old('size', $singleProperty->size)}}" placeholder="(SqFt)" min="0">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="floor" class="form-label">Floor <span style="color: red">*</span></label>
                    <input type="number" class="form-control" id="floor" name="floor" value="{{old('floor', $singleProperty->floor)}}" placeholder="0" min="0">
                </div>
                <div class="col-md-4">
                    <label for="balcony" class="form-label">Balcony <span style="color: red">*</span></label>
                    <input type="number" class="form-control" id="balcony" name="balcony" value="{{old('balcony', $singleProperty->balcony)}}" placeholder="0" min="0">
                </div>
                <div class="col-md-4">
                    <label for="garage" class="form-label">Garage <span style="color: red">*</span></label>
                    <input type="number" class="form-control" id="size" name="garage" value="{{old('garage', $singleProperty->garage)}}" placeholder="0" min="0">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{old('address', $singleProperty->address)}}" placeholder="Address" min="0">
                </div>
                <div class="col-md-4">
                    <label for="built_year" class="form-label">Built Year <span style="color: red">*</span></label>
                    <input type="number" class="form-control" id="built_year" name="built_year" value="{{old('built_year', $singleProperty->built_year)}}" placeholder="2000" min="1900"max="{{date('Y')}}">
                </div>
                <div class="col-md-4">
                    <label for="is_featured" class="form-label">Is Featured <span style="color: red">*</span></label>
                    <select name="is_featured" class="form-control" id="is_featured">
                        <option value="1" {{ $singleProperty->is_featured == '1' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $singleProperty->is_featured == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                  <label for="map" class="form-label">Location Map</label>
                    <textarea name="map" class="form-control" id="map" cols="20" rows="8">{{old('map', $singleProperty->map)}}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                  <label for="" class="form-label">Amenities</label>
                  <div class="row">
                    @foreach ($amenities as $amenity)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input name="amenity[]" class="form-check-input" type="checkbox" value="{{ $amenity->id }}" {{ in_array($amenity->id, $existing_amenities) ? 'checked' : '' }} id="amn{{$loop->iteration}}">
                            <label class="form-check-label" for="amn{{$loop->iteration}}">{{ $amenity->name }}</label>
                        </div>
                    </div>
                    @endforeach
                  </div>

                </div>
            </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Updated Property</button>
                    </div>
                </div>
          </div>
        </form>
      </div>

    </div>
  </div>
  </main>



@endsection


