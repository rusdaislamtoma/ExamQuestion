@extends('layouts.backend.master')

@section('content')
<div class="card card-info card-outline">
    <div class="card-header with-border">

    </div>
    <form action="{{ route('admin.grade.subject.update',[$slug,$subject->slug]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="row">
                @include('backend.subject._form')
            </div>
            <div class="row" style="margin-top:10px;">
                <div class="col-md-2 offset-md-5">
                    <input type="submit" value="Update" class="btn btn-success pull-left">
                    <a href="{!! route('admin.grade.subject',$slug) !!}" class="btn btn-danger ml-2"
                    onclick="return confirm('Are you sure to cancel?')">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.box -->
@endsection
@push('customJs')
<script>
    $('#imgupload').dropify();

    $(function () {
        $('.yes').on('change', function () {

            $('#change').append('<div id="removepass"><div class="form-group"><label>Password</label> <input type="password" name="password" minlength="6" required class="form-control"></div> ' +
                '<div class="form-group"><label>Confirm Password</label> <input type="password" name="password_confirmation" required  minlength="6" class="form-control"></div></div>')

        });
        $('.no').on('change', function () {

            $('#removepass').remove();
        });
    });

</script>
<!-- /.box -->
@endpush