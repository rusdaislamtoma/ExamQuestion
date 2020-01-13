@extends('layouts.backend.master')

@section('content')
<div class="card card-info card-outline">
    <div class="card-header">
    </div>
    <div class="card-body">
        {{-- <div class="col-md-5">
            <div class="image" >
                @if(Auth::user()->image!=null)
                <img src="{{config('jobnresume_config.asset_url').Auth::user()->image}}" class="img-rounded " alt="User Image" style="width:100%;">
                @endif
                @if(Auth::user()->image==null)
                <img src="{{asset('assets/admin/img/user_logo.jpg')}}" class="img-rounded " alt="User Image" style="width:100%;">
                @endif
            </div>
            <div class="name" style="margin-top:10px;">

                <p> <b>Name:</b> {!! $user->name !!}</p>


            </div>
            <div class="email">

                <p><b>Email:</b> {!! $user->email !!}</p>

            </div>

        </div> --}}
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('update.profile',$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('backend.user.changeProfile._form')

                <div class="row">
                    <div class="col-md-2 offset-md-5">
                        <input type="submit" value="Update" class="btn btn-success pull-right">
                        <a href="{!! route('admin.dashboard') !!}" class="btn btn-danger"
                        onclick="return confirm('Are you sure to cancel?')">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.box -->
@endsection
@push('customJs')
<script>
    $('#imgupload').dropify();
    $(function () {
        $('.yes').on('change', function () {

            $('#change').append('<div id="removepass"><div class="form-group"><label>Password</label> <input type="password" name="password" required class="form-control"></div> ' +
                '<div class="form-group"><label>Confirm Password</label> <input type="password" name="password_confirmation" required  class="form-control"></div></div>')

        });
        $('.no').on('change', function () {

            $('#removepass').remove();
        });
    });

</script>
<!-- /.box -->
@endpush