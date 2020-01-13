@extends('layouts.backend.master')

@section('content')
<div class="card card-info card-outline">
    <div class="card-header with-border">

    </div>
    <form action="{{ route('admin.make.written_question.update',[$subject->slug,$make_question->code_id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="row">
                @include('backend.make_written_question._form2')
            </div>
            <div class="row" style="margin-top:10px;margin-right: 120px">
                <div class="col-md-4 offset-md-5">
                    <input type="submit" value="Again Generate" class="btn btn-success pull-left">
                    <a href="{!! route('admin.make.written_question.index',$subject->slug) !!}" class="btn btn-danger ml-2"
                       onclick="return confirm('Are you sure to cancel?')">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.box -->
@endsection
@push('customJs')
    <script type="text/javascript">
        $('#imgupload').dropify();
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)){
                $(this).val('');
                return false;
            }
            return true;
        }
    </script>
    @include('backend.make_written_question._scripts')
@endpush