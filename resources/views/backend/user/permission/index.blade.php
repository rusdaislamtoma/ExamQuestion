@extends(config('authorization.master_template'))
@section(config('authorization.content_area'))
<div class="row">
    <div class="col-md-12">
        <div class="card card-info card-outline">
          <div class="card-header">
            <div class="row">
                <div class="col-md-3" style="padding-top: 5px;padding-bottom: 5px;">
                    @if(canViewRoute('permission/create'))
                    <a href="{!! route('permission.create') !!}" class="btn btn-block btn-outline-success">Add New Permissions</a>
                    @endif
                </div>
                <div class="col-md-1" style="padding-top: 5px;padding-bottom: 5px;">
                    @if(canViewRoute('role'))
                    <a href="{!! route('role.index') !!}" class="btn btn-block btn-outline-success">Role</a>
                    @endif
                </div>
                <div class="col-md-4 hidden-xs hidden-sm"></div>
                <div class="col-md-3" style="padding-top: 5px;padding-bottom: 5px;">
                    <form action="{{ route('permission.index') }}" method="GET">
                        <input type="text" name="key" value="{{ \Illuminate\Support\Facades\Input::get('key') }}" class="form-control" placeholder="Enter a keyword">
                    </div>

                    <div class="col-md-1" style="padding-top: 5px;padding-bottom: 5px;">
                        <input type="submit" value="Search" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="organogramTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Name</th>
                            <th>URI</th>
                            <th class="text-center" style="width: 25%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td>{!! $serial++ !!}</td>
                            <td>{!! $permission->title !!}</td>
                            <td>{!! $permission->route_name !!}</td>
                            <td>{!! $permission->route_uri !!}</td>
                            <td class="text-center">
                                @if($permission->deleted_at != null)
                                @if(canViewRoute('permission/restore/{id}'))  
                                <a href="{!! route('permission.restore',$permission->id) !!}" class="btn btn-primary" onclick="return confirm('Are you sure to restore this Permission ?')" title="Restore">
                                    <i class="fa fa-recycle"></i>
                                </a>
                                @endif
                                @if(canViewRoute('permission/destroy/{id}'))  
                                <a href="{!! route('permission.destroy',$permission->id) !!}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this Permission ?')" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endif
                                @else
                                @if(canViewRoute('permission/trash/{id}'))
                                <a href="{!! route('permission.trash',$permission->id) !!}" class="btn btn-danger" onclick="return confirm('Are you confirm to make trash this Permission ?')" title="Trash">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endif
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$permissions->render()}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div>
@endsection
