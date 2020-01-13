<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ isset($page_title)?$page_title:'Page Title' }}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            @if(isset($route_id))
            <a href="{{ isset($parent_route)?route($parent_route,$route_id):'#' }}">{{ isset($breadcrumb_parent)?$breadcrumb_parent:'' }}</a>
            @else
            <a href="{{ isset($parent_route)?route($parent_route):'#' }}">{{ isset($breadcrumb_parent)?$breadcrumb_parent:'' }}</a>
            @endif
          </li>
          <li class="breadcrumb-item active">{{ isset($breadcrumb)?$breadcrumb:'' }}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>