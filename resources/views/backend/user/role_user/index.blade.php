@extends(config('authorization.master_template'))
@section(config('authorization.content_area'))
<div class="row">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                        @if(canViewRoute('role_user/{id}/create')) 
                        <a href="{!! route('role_user.create',$id) !!}" class="btn btn-block btn-outline-success">Add New</a>
                        @endif
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-5" style="padding-top: 5px;padding-bottom: 5px;">

                    </div>
                    <div class="col-md-1" style="padding-top: 5px;padding-bottom: 5px;">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="organogramTable" class="table table-bordered table-striped">
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
                                <td>{!! $role->relRole->title !!}</td>
                                <td>{!! $role->relRole->description !!}</td>
                                <td>{!! ucfirst($role->status) !!}</td>
                                <td class="text-center">
                                    @if($role->status=='active') 
                                    <a href="{!! route('role_user.status',$role->id) !!}" class="btn btn-warning" title="Edit"> Inactive </a> 
                                    @else 
                                    <a href="{!! route('role_user.status',$role->id) !!}" class="btn btn-info" title="Edit"> Active </a>
                                     
                                    @endif
                                
                                @if($role->deleted_at)
                                @if(canViewRoute('role_user/{id}/restore'))
                                <a href="{!! route('role_user.restore',$role->id) !!}"
                                    class="btn btn-primary" onclick="return confirm('Are you confirm to restore this Role ?')" title="Restore">
                                    <i class="fa fa-recycle"></i>
                                </a>
                                @endif
                                @if(canViewRoute('role_user/{id}/delete'))
                                <a href="{!! route('role_user.delete',$role->id) !!}"
                                    class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Role ?')" title="Delete">
                                    <i class="fa fa-eraser"></i>
                                </a>
                                @endif
                                @else
                                @if(canViewRoute('role_user/{id}/trash'))
                                <a href="{!! route('role_user.delete',$role->id) !!}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this Role from this user?')" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
