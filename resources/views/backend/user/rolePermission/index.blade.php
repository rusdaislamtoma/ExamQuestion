@extends(config('authorization.master_template'))
@section(config('authorization.content_area'))
<div class="row">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3" style="padding-top: 5px;padding-bottom: 5px;">
                        @if(canViewRoute('role_permission/{id}/create'))
                        <a href="{!! route('role_permission.create',$role_id) !!}" class="btn btn btn-block btn-outline-success">Add New Role Permission</a>
                        @endif
                    </div>
                    <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                        @if(canViewRoute('permission/create'))
                        <a href="{!! route('permission.create') !!}" class="btn btn btn-block btn-outline-success">Permission</a> 
                        @endif
                    </div>
                    <div class="col-md-1" style="padding-top: 5px;padding-bottom: 5px;">
                        @if(canViewRoute('role'))
                        <a href="{!! route('role.index') !!}" class="btn btn btn-block btn-outline-success">Role</a>
                        @endif
                    </div>
                    <div class="col-md-5" style="padding-top: 5px;padding-bottom: 5px;">
                        <form action="{{ route('role_permission.index',$role_id) }}" method="GET">
                            <input type="text" name="key" value="{{ \Illuminate\Support\Facades\Input::get('key') }}" class="form-control" placeholder="Enter a keyword">
                        </div>
                        <div class="col-md-1" style="padding-top: 5px;padding-bottom: 5px;">
                            <input type="submit" value="Search" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body table-responsive">
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
                        @foreach($roles as $role)
                        <tr>
                            <td>{!! $serial++ !!}</td>
                            <td>{!! $role->relPermission->title !!}</td>
                            <td>{!! $role->relPermission->route_name !!}</td>
                            <td>{!! $role->relPermission->route_uri !!}</td>
                            <td class="text-center">
                                @if($role->deleted_at != null)
                                @if(canViewRoute('role_permission/{id}/restore'))   
                                <a href="{!! route('role_permission.restore',$role->id) !!}" class="btn btn-primary" onclick="return confirm('Are you confirm to restore this Role Permission ?')" title="Restore">
                                    <i class="fa fa-recycle"></i>
                                </a>
                                @endif
                                @if(canViewRoute('role_permission/{id}/delete'))    
                                <a href="{!! route('role_permission.delete',$role->id) !!}" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Role Permission ?')" title="Delete">
                                    <i class="fa fa-eraser"></i>
                                </a>
                                @endif
                                @else
                                @if(canViewRoute('role_permission/{id}/trash')) 
                                <a href="{!! route('role_permission.trash',$role->id) !!}" class="btn btn-danger" onclick="return confirm('Are you confirm to make trash this Role Permission ?')" title="Trash">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$roles->render()}}
            </div>
        </div>
    </div>
</div>
<!-- /.box -->
@endsection
