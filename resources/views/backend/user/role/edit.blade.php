@extends(config('authorization.master_template'))
@section(config('authorization.content_area'))

<div class="card card-info card-outline">
    <form action="{{ route('role.update',$role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                @include('backend.user.role._form')
            </div>
            <div class="row">
                <div class="col-md-2 offset-md-5">
                    <input type="submit" name="Update" class="btn btn-success pull-right">
                    <a href="{!! route('role.index') !!}" class="btn btn-danger" onclick="return confirm('Are you sure to cancel?')">Cancel</a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection