<aside class="main-sidebar elevation-2 sidebar-dark-info">
  <!-- Brand Logo -->
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <img src="{{ asset('default_rss/images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ isset(Auth::user()->image)?asset(Auth::user()->image):'/default_rss/images/user.jpg' }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ isset(Auth::user()->name)?Auth::user()->name:'User' }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        {{-- Dashboard --}}
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('dashboard')?'active':'' }} ">
            <i class="nav-icon fa fa-dashboard"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        {{-- Dashboard end --}}

        {{-- User Control --}}
        @if(Request::is('permission*') || Request::is('role*') || Request::is('role_user*') || Request::is('role_permission*') || Request::is('user*'))
        @php($user_nav = true)
        @endif
        <li class="nav-item has-treeview {{ isset($user_nav)?'menu-open':'' }}">
          <a href="#" class="nav-link {{ isset($user_nav)?'active':'' }}">
            <i class="fa fa-users" aria-hidden="true"></i>
            <p>
              Manage Users
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('user*')?'active':'' }}">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('role.index') }}" class="nav-link {{ Request::is('role*')?'active':'' }}">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Roles</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('permission.index') }}" class="nav-link {{ Request::is('permission*')?'active':'' }}">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Permissions</p>
              </a>
            </li>
            
          </ul>
        </li>
        {{-- User Control end --}}

        {{-- Category nav --}}
        {{-- <li class="nav-item">
          <a href="{{ route('admin.category.index') }}" class="nav-link {{ Request::is('categories*')?'active':'' }}">
            <i class="fa fa-list" aria-hidden="true"></i>
            <p>Category</p>
          </a>
        </li> --}}
          {{-- Category nav end --}}

        {{-- School nav --}}
        <li class="nav-item">
          <a href="{{ route('admin.school.index') }}" class="nav-link {{ Request::is('school*')?'active':'' }}">
            <i class="fa fa-university" aria-hidden="true"></i>
            <p>Manage School</p>
          </a>
        </li>
        {{-- School nav end --}}

        {{-- class nav --}}
        <li class="nav-item">
          <a href="{{ route('admin.grade.index') }}" class="nav-link {{ Request::is('grade*')?'active':'' }}">
            <i class="fa fa-university" aria-hidden="true"></i>
            <p>Manage Classes</p>
          </a>
        </li>
        {{-- class nav end --}}


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>