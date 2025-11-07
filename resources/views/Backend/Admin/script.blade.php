
  <!-- Vendor JS Files -->
  <script src="{{asset('forntend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('forntend/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('forntend/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('forntend/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('forntend/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('forntend/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('forntend/assets/vendor/drift-zoom/Drift.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{asset('forntend/assets/js/main.js')}}"></script>

  <!-- iziToast JS -->
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>



<script>
    @if(Session::has('success'))
        iziToast.success({
            message: "{{ Session::get('success') }}",
            position: 'topRight'
        });
    @endif

    @if(Session::has('error'))
        iziToast.error({
            message: "{{ Session::get('error') }}",
            position: 'topRight'
        });
    @endif

    @if(Session::has('warning'))
        iziToast.warning({
            message: "{{ Session::get('warning') }}",
            position: 'topRight'
        });
    @endif

    @if(Session::has('info'))
        iziToast.info({
            message: "{{ Session::get('info') }}",
            position: 'topRight'
        });
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error )
            iziToast.error({
            message: "{{ $error }}",
            position: 'topRight'
            });
        @endforeach
    @endif
</script>
