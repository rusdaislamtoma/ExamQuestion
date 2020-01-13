@extends(config('authorization.master_template'))
@section(config('authorization.content_area'))

<div class="card card-info card-outline">
    <form action="{{ route('role.store') }}" method="POST" >
        @csrf
        <div class="card-body">
            <div class="row">
                @include('backend.user.role._form')
            </div>
            <div class="row">
                <div class="col-md-2 offset-md-5">
                    <a href="{!! route('role.index') !!}" class="btn btn-danger" onclick="return confirm('Are you sure to cancel?')">Cancel</a>
                    <input type="submit" value="Save" class="btn btn-success pull-right">
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@push('customJs')

@endpush