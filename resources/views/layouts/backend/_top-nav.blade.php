<nav class="main-header navbar navbar-expand border-bottom navbar-dark bg-info">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li>
  </ul>
  
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-user-o" aria-hidden="true"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="{{ route('profile') }}" class="dropdown-item">
          <span style="color:black;"><i class="fa fa-id-card" aria-hidden="true"></i> Profile</span>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <span style="color:black;"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fa fa-th-large"></i>
      </a>
    </li> --}}
  </ul>
</nav>