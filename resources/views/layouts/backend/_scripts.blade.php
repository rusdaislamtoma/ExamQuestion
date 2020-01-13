
<!-- jQuery -->
<script src="{{ asset('assets/js/backend/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/js/backend/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{-- <script>
  $.widget.bridge('uibutton', $.ui.button)
</script> --}}
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/js/backend/bootstrap.bundle.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('assets/js/backend/raphael-min.js') }}"></script>
<script src="{{ asset('assets/js/backend/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/js/backend/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('assets/js/backend/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/js/backend/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/js/backend/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/js/backend/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/backend/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('assets/js/backend/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('assets/js/backend/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('assets/js/backend/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/iCheck/icheck.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/js/backend/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/backend/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('assets/js/backend/dashboard.js') }}"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('assets/js/backend/demo.js') }}"></script> --}}
<script src="{{ asset('assets/js/backend/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/backend/dropify.min.js') }}"></script>
<script type="text/javascript">
	toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>
<script type="text/javascript">
    $('input[type="checkbox"].flat-green, input[type="radio"].flat-green').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass   : 'iradio_square-green'
  });
</script>
@stack('js')
@stack('customJs')
{!! Toastr::message() !!}