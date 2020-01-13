@extends('layouts.backend.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- /.card -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                        @if(canViewRoute('user.create','route'))  
                        <a href="{{ route('user.create') }}" class="btn btn-block btn-outline-success">
                        Add New </a>
                        @endif
                    </div>
                    <div class="col-md-4" style="padding-top: 5px;padding-bottom: 5px;">

                    </div>
                    <div class="col-md-5" style="padding-top: 5px;padding-bottom: 5px;">
                        <form action="{{ route('user.index') }}" method="GET">
                            @csrf
                            <input type="text" name="key" value="{{ \Illuminate\Support\Facades\Input::get('key') }}" class="form-control" placeholder="Enter a name">
                        </div>
                        <div class="col-md-1" style="padding-top: 5px;padding-bottom: 5px;">
                            <input type="submit" value="Search" class="btn btn-primary">
                            
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <div class="table-responsive">
                    <table id="organogramTable" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 25%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{!! $serial++ !!}</td>
                                <td>{!! $user->name !!}</td>
                                <td>{!! $user->email !!}</td>
                                <td>
                                    @if($user->status === 'active')
                                    <span class="badge bg-success">
                                        {!! ucfirst($user->status) !!}
                                    </span>
                                    @else
                                    <span class="badge bg-warning">
                                        {!! ucfirst($user->status) !!}
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($user->deleted_at)
                                    @if(canViewRoute('user.restore','route'))
                                    <a href="{!! route('user.restore',$user->id) !!}" class="btn btn-primary" onclick="return confirm('Are you confirm to restore this User ?')" title="Restore">
                                        <i class="fa fa-recycle"></i>
                                    </a>
                                    @endif
                                    @if(canViewRoute('user.delete','route'))
                                    <a href="{!! route('user.delete',$user->id) !!}" class="btn btn-danger"
                                        onclick="return confirm('Are you confirm to delete this User ?')"
                                        title="Delete">
                                        <i class="fa fa-eraser"></i>
                                    </a>
                                    @endif
                                    @else
                                    @if(canViewRoute('role_user.index','route'))
                                    <a href="{!! route('role_user.index',$user->id) !!}" class="btn btn-success" title="Role User">Role User</a>
                                    @endif
                                    @if(canViewRoute('user.update','route'))  
                                    <a href="{!! route('edit_user.edit',$user->id) !!}" class="btn btn-info">
                                        <i class="fa fa-edit" title="Edit"></i>
                                    </a>
                                    @endif
                                    @if(canViewRoute('user.trash','route'))
                                    <a href="{!! route('user.trash',$user->id) !!}" class="btn btn-danger"
                                        onclick="return confirm('Are you confirm to make trash this User ?')"
                                        title="Trash">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{$users->render()}}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
@push('customJs')
<script>
    $(function () {
        $('#perPage').change(function () {
            var url = $(this).attr('url') + '/' + $(this).val();
            console.log(url);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {

                    location.reload();
                },
                error: function (error) {
                    alert('Sorry, Something went wrong ! Please try again after sometime.');
                }
            })
            console.log(url);
        });
    });
</script>
@endpush
