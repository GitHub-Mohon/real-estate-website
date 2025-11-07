  <footer id="footer" class="footer position-relative">

    <div class="container">
      <div class="row gy-5">

        <div class="col-lg-4">
          <div class="footer-content">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center mb-4">
              <span class="sitename">TheProperty</span>
            </a>
            <p class="mb-4">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae. Donec velit neque auctor sit amet aliquam vel ullamcorper sit amet ligula.</p>

            <div class="newsletter-form">
              <h5>Stay Updated</h5>
              <form action="{{ route('subscriber_send_email') }}" method="post">
                @csrf
                <div class="input-group">
                  <input type="email" name="email" class="form-control" required="" placeholder="Enter your email">
                  <button type="submit" class="btn-subscribe">
                    <i class="bi bi-send"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="footer-links">
            <h4>Company</h4>
            <ul>
              <li><a href="{{route('about')}}"><i class="bi bi-chevron-right"></i> About Page</a></li>
              <li><a href="{{ route('properties') }}"><i class="bi bi-chevron-right"></i> Properties Page</a></li>
              <li><a href="{{ route('agents') }}"><i class="bi bi-chevron-right"></i> Agents Page</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Blog Page</a></li>
              <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right"></i> Contact Page</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="footer-contact">
            <h4>Get in Touch</h4>
            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="contact-info">
                {{ $global_setting->footer_address }}
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-telephone"></i>
              </div>
              <div class="contact-info">
                <p>{{ $global_setting->phone_number }}</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="contact-info">
                <a href="mailto:{{ $global_setting->footer_email }}"><p>{{ $global_setting->footer_email }}</p></a>
              </div>
            </div>

            <div class="social-links">
              <a href="{{ $global_setting->facebook }}"><i class="bi bi-facebook"></i></a>
              <a href="{{ $global_setting->tweeter }}"><i class="bi bi-twitter-x"></i></a>
              <a href="{{ $global_setting->linkedin }}"><i class="bi bi-linkedin"></i></a>
              <a href="#"><i class="bi bi-youtube"></i></a>
              <a href="https://github.com/Github-Mohon"><i class="bi bi-github"></i></a>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="copyright">
              <p>©{{date('Y')}} <span>Copyright</span> <strong class="px-1 sitename">{{ $global_setting->copyright }}</strong> <span>All Rights Reserved</span></p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="footer-bottom-links">
              <a href="{{ route('privacy') }}">Privacy Policy</a>
              <a href="{{ route('terms') }}">Terms of Service</a>
              <a href="{{ route('privacy') }}">Cookie Policy</a>
            </div>
            <div class="credits">
              Designed & Developed by <a href="https://codehasbaker">CHB Developer</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
