@extends('layouts.backend.master')

@section('content')
<div class="card card-info card-outline">
    <form action="{{ route('admin.make.written_question.store',$subject->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            @include('backend.make_written_question._form')
            <div class="row" style="margin-top:10px;">
                <div class="col-md-2 offset-md-5">
                    <input type="submit" id="submit" value="Generate Question" class="btn btn-success">
                </div>
            </div>
            <div>
                <a href="{!! route('admin.make.written_question.index',$subject->slug) !!}" class="btn btn-primary ml-2" style="float: left;">Show Questions</a>
                <a href="{!! route('admin.make.written_question.index',$subject->slug) !!}" class="btn btn-danger ml-2" onclick="return confirm('Are you sure?')" style="float: left;">Cancel</a>
            </div>
        </div>
    </form>
</div>
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