@extends(config('authorization.master_template'))
@section(config('authorization.content_area'))
<div class="row">
    <div class="col-md-12">
        <div class="card card-info card-outline">
          <div class="card-header">
            <div class="row">
                <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                    @if(canViewRoute('role.create','route'))  
                    <a href="{!! route('role.create') !!}" class="btn btn-block btn-outline-success">
                        Add New
                    </a>
                    @endif
                </div>
                <div class="col-md-4 hidden-sm hidden-xs"></div>
                <div class="col-md-5" style="padding-top: 5px;padding-bottom: 5px;">
                    <form action="{{ route('role.index') }}" method="GET">
                        <input type="text" name="key" value="{{ \Illuminate\Support\Facades\Input::get('key') }}" class="form-control" placeholder="Enter role name" autocomplete="off">
                    </div>
                    <div class="col-md-1" style="padding-top: 5px;padding-bottom: 5px;">
                        <input type="submit" value="Search" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="organogramTable" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Role</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 25%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{!! $serial++ !!}</td>
                            <td>{!! $role->title !!}</td>
                            <td>{!! $role->description !!}</td>
                            <td>
                                @if($role->status === 'active')
                                <span class="badge bg-success">
                                    {!! ucfirst($role->status) !!}
                                </span>
                                @else
                                <span class="badge bg-warning">
                                    {!! ucfirst($role->status) !!}
                                </span>
                                @endif
                            </td>
                            <td class="text-center">

                                @if($role->deleted_at != null)
                                @if(canViewRoute('role/{id}/restore'))   
                                <a href="{!! route('role.restore',$role->id) !!}" class="btn btn-primary" onclick="return confirm('Are you confirm to restore this Role ?')" title="Restore">
                                    <i class="fa fa-recycle"></i>
                                </a>
                                @endif
                                @if(canViewRoute('role/{id}/delete'))   
                                <a href="{!! route('role.delete',$role->id) !!}" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Role ?')" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endif
                                @else
                                @if(canViewRoute('role_permission/{id}'))
                                <a href="{!! route('role_permission.index',$role->id) !!}" class="btn btn-info" title="Permission"> Permissions
                                </a>
                                @endif
                                @if(canViewRoute('role/{id}/edit'))  
                                <a href="{!! route('role.edit',$role->id) !!}" class="btn btn-info" title="Edit">
                                    <i class="fa fa-edit" title="Edit"></i>
                                </a>
                                @endif
                                @if(canViewRoute('role/{id}/trash'))
                                <a href="{!! route('role.trash',$role->id) !!}" class="btn btn-danger" onclick="return confirm('Are you confirm to make trash this Role ?')" title="Trash">
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
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
