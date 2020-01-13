@extends('layouts.backend.master')

@section('content')
<div class="card card-info card-outline">
    <form action="{{ route('admin.grade.subject.store',$grade->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                @include('backend.subject._form')

            </div>
            <div class="row" style="margin-top:10px;">
                <div class="col-md-2 offset-md-5">
                    <input type="submit" value="Save" class="btn btn-success pull-left">
                    <a href="{!! route('admin.grade.subject',$grade->slug) !!}" class="btn btn-danger ml-2" onclick="return confirm('Are you sure?')">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('customJs')
<script type="text/javascript">
    $('#imgupload').dropify();
</script>
@endpush