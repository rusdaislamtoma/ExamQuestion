<!DOCTYPE html>
<html>
@include('layouts.backend._head')
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Top Navbar -->
    @include('layouts.backend._top-nav')
    <!-- Top Navbar end-->

    <!-- Side navbar -->
    @include('layouts.backend._left-nav')
    <!-- Side navbar end-->

    <div class="content-wrapper">
      <!-- Breadcrumb -->
      @if(isset($page_title))
      @include('layouts.backend._breadcrumb')
      @endif
      <!-- Breadcrumb end -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          @yield('content')

        </div>
      </section>
      <!-- Main content end -->
    </div>
    {{-- Footer --}}
    @include('layouts.backend._footer')
    {{-- Footer end --}}

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  {{-- All scripts --}}
  @include('layouts.backend._scripts')
  @include('layouts.backend._error-message')
  {{-- All scripts end --}}
</body>
</html>
