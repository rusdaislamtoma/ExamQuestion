@extends('layouts.backend.master')

@section('content')
<div class="card card-info card-outline">
    <form action="{{ route('admin.subject.question.store',$subject->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            
            @include('backend.subject_question._form')

            
            <div class="row" style="margin-top:10px;">
                <div class="col-md-2 offset-md-5">
                    <input type="submit" value="Save" class="btn btn-success pull-left">
                    <a href="{!! route('admin.subject.question.index',$subject->slug) !!}" class="btn btn-danger ml-2" onclick="return confirm('Are you sure?')">Cancel</a>
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
    @include('backend.subject_question._scripts')
@endpush