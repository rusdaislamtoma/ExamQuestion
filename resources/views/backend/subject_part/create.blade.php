@extends('layouts.backend.master')

@section('content')
<div class="card card-info card-outline">
    <form action="{{ route('admin.subject.part.store',$subject->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                @include('backend.subject_part._form')

            </div>
            <div class="row" style="margin-top:10px;">
                <div class="col-md-2 offset-md-5">
                    <input type="submit" value="Save" class="btn btn-success pull-right">
                    <a href="{!! route('admin.subject.part.index',$subject->slug) !!}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Cancel</a>
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