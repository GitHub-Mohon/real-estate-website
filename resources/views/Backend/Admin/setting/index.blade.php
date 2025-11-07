@extends('backend.admin.layouts')

@section('main-content')
    <!-- Content -->
 <div class="content">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                <h4 class="mb-1">Settings</h4>
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
          <div class="card-body">
                <form action="{{route('admin_setting_update',$setting->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                   <div class="col-md-12">
                    <div class="mb-3">
                        @if ($setting->logo ==null)
                        Logo not found
                        @else
                        <img src="{{ asset('uploads/setting/' .$setting->logo.    ' ')}}" alt="not found" style="width: 120px; height: auto;">
                        @endif
                        <div id="emailHelp" class="form-text">Existing Logo</div><br>
                        <label for="picture" class="form-label">Change Logo*</label>
                        <input type="file" class="form-control" id="picture" name="logo" placeholder="logo image">
                    </div>
                    <div class="mb-3">
                        @if ($setting->favicon ==null)
                        Favicon not found
                        @else
                        <img src="{{ asset('uploads/setting/' .$setting->favicon.    ' ')}}" alt="not found" style="width: 80px; height: 50px;">
                        @endif
                        <div id="emailHelp" class="form-text">Existing Favicon</div><br>
                        <label for="fave" class="form-label">Change Favicon*</label>
                        <input type="file" class="form-control" id="fave" name="favicon" placeholder="favicon image">
                    </div>
                   </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                        @if ($setting->banner ==null)
                        Banner not found
                        @else
                        <img src="{{ asset('uploads/setting/' .$setting->banner.    ' ')}}" alt="not found" style="width: 80px; height: 50px;">
                        @endif
                        <div id="emailHelp" class="form-text">Existing Banner</div><br>
                        <label for="banner" class="form-label">Change Banner*</label>
                        <input type="file" class="form-control" id="banner" name="banner" placeholder="banner image">
                    </div>
                  </div>
                  <div class="col-md-12">
                  <div class="mb-3">
                    <label for="assistance_number" class="form-label">Assistance Number*</label>
                    <input type="text" class="form-control" id="assistance_number" name="assistance_number" placeholder="assistance number" value="{{$setting->assistance_number}}">
                  </div>
                  <div class="mb-3">
                    <label for="consultation_number" class="form-label">Consultation Number*</label>
                    <input type="text" class="form-control" id="consultation_number" name="consultation_number" placeholder="consultation number" value="{{$setting->consultation_number}}">
                  </div>
                  </div>
                  <div class="col-md-12">
                  <div class="mb-3">
                    <label for="footer_address" class="form-label">Footer Address*</label>
                    <input type="text" class="form-control" id="footer_address" name="footer_address" placeholder="footer address" value="{{$setting->footer_address}}">
                  </div>
                  <div class="mb-3">
                    <label for="footer_email" class="form-label">Consultation Number*</label>
                    <input type="text" class="form-control" id="footer_email" name="footer_email" placeholder="footer email" value="{{$setting->footer_email}}">
                  </div>
                  </div>
                  <div class="col-md-12">
                  <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone number*</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="phone number" value="{{$setting->phone_number}}">
                  </div>
                  <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook*</label>
                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="facebook" value="{{$setting->facebook}}">
                  </div>
                  </div>
                  <div class="col-md-12">
                  <div class="mb-3">
                    <label for="tweeter" class="form-label">Twitter-X*</label>
                    <input type="text" class="form-control" id="tweeter" name="tweeter" placeholder="tweeter" value="{{$setting->tweeter}}">
                  </div>
                  <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram*</label>
                    <input type="text" class="form-control" id="instagrams" name="instagram" placeholder="instagram" value="{{$setting->instagram}}">
                  </div>
                  </div>
                  <div class="col-md-12">
                  <div class="mb-3">
                    <label for="linkedin" class="form-label">Linkedin*</label>
                    <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="linkedin" value="{{$setting->linkedin}}">
                  </div>
                  <div class="mb-3">
                    <label for="copyright" class="form-label">Copyright*</label>
                    <input type="text" class="form-control" id="copyright" name="copyright" placeholder="copyright" value="{{$setting->copyright}}">
                  </div>
                  </div>
                  <br>
                  <button type="submit" class="btn btn-primary">Save Change</button>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
