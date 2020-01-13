@extends('layouts.backend.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- /.card -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8" style="padding-top: 5px;padding-bottom: 5px;">

                    </div>
                    <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                        @if(canViewRoute('user.create','route'))
                            <a href="{{ route('admin.grade.index',$slug) }}" class="btn btn-block btn-outline-primary">
                                Back </a>
                        @endif

                    </div>
                    <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                     @if(canViewRoute('user.create','route'))  
                     <a href="{{ route('admin.grade.subject.create',$slug) }}" class="btn btn-block btn-outline-success">
                     Add New </a>
                     @endif
                 </div>
             </div>
             <!-- /.card-header -->
             <div class="card-body table-responsive">
                <div class="table-responsive">
                    <table id="subject_tatble" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code No</th>
                                <th>Chapters</th>
                                <th>MCQ Exam Time</th>
                                <th>Written Exam Time</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                            <tr>
                                <td>{!! $subject->name !!}</td>
                                <td>{!! $subject->code_no !!}</td>
                                <td>{!! $subject->number_of_chapters !!}</td>
                                <td>{!! $subject->mcq_time !!}</td>
                                <td>{!! $subject->written_time !!}</td>
                                <td class="text-center">
                                    <a href="{!! route('admin.make.question.index',$subject->slug) !!}" class="btn btn-sm btn-primary">
                                        <i class="icofont-paper" aria-hidden="true" title="Make Question"> Make MCQ Question</i>
                                    </a>
                                    <a href="{!! route('admin.subject.question.index',$subject->slug) !!}" class="btn btn-sm btn-primary">
                                        <i class="icofont-paper" aria-hidden="true" title="Add Question"> Add MCQ Question</i>
                                    </a>
                                    <a href="{!! route('admin.make.written_question.index',$subject->slug) !!}" class="btn btn-sm btn-primary mt-1">
                                        <i class="icofont-paper" aria-hidden="true" title="Make Written Question"> Make Written Question</i>
                                    </a>
                                    <a href="{!! route('admin.subject.written_question.index',$subject->slug) !!}" class="btn btn-sm btn-primary mt-1">
                                        <i class="icofont-paper" aria-hidden="true" title="Add Written Question"> Add Written Question</i>
                                    </a>
                                    {{-- <a href="{!! route('admin.subject.part.index',$subject->slug) !!}" class="btn btn-sm btn-primary">
                                        <i class="icofont-book" aria-hidden="true" title="Add part"> Add part</i>
                                    </a> --}}
                                    <a href="{!! route('admin.subject.section.index',$subject->slug) !!}" class="btn btn-sm btn-secondary mt-1">
                                        <i class="icofont-read-book" aria-hidden="true" title="Add section"> Add section</i>
                                        {{-- <i class="fa fa-plus-square-o" aria-hidden="true" title="Add section"></i> --}}
                                    </a>
                                    @if(canViewRoute('admin.grade.subject.edit','route'))
                                    <a href="{!! route('admin.grade.subject.edit',[$slug,$subject->slug]) !!}" class="btn btn-sm btn-info mt-1">
                                        <i class="fa fa-edit" title="Edit"></i>
                                    </a>
                                    @endif
                                    @if(canViewRoute('admin.grade.subject.destroy','route'))
                                    <a href="{!! route('admin.grade.subject.destroy',[$slug,$subject->slug]) !!}" class="btn btn-sm btn-danger mt-1"
                                        onclick="return confirm('Are you sure to delete this?\nYou will not be able to restore this.')"
                                        title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/backend/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/backend/sweetalert2.min.css')}}">
@endpush

@push('js')
<script type="text/javascript" src="{{asset('assets/js/backend/datatable/datatables.min.js')}}"></script>
<!-- DataTable buttons -->
<script src="{{asset('assets/js/backend/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/backend/datatable/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/js/backend/datatable/jszip.min.js')}}"></script>
<script src="{{asset('assets/js/backend/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/js/backend/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/js/backend/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/backend/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/backend/sweetalert2.all.min.js')}}"></script>
@endpush

@push('customJs')
<script>
    $('#subject_tatble').DataTable();
</script>
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
