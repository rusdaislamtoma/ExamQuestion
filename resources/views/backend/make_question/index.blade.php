@extends('layouts.backend.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- /.card -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6" style="padding-top: 5px;padding-bottom: 5px;">

                    </div>
                    <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                        @if(canViewRoute('user.create','route'))
                            <a href="{{ route('admin.grade.subject',$grade->slug) }}" class="btn btn-block btn-outline-primary">
                                Back </a>
                        @endif

                    </div>
                    <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                        @if(canViewRoute('user.create','route'))
                            <a href="{{ route('admin.make.question.create',$slug) }}" class="btn btn-block btn-outline-success">
                                Make Question </a>
                        @endif

                    </div>
                    <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                     @if(canViewRoute('user.create','route'))  
                     <a href="{{ route('admin.print.question',$slug) }}" class="btn btn-block btn-outline-success">
                     Print Question </a>
                     @endif
                    </div>
                 </div>
             </div>
             <!-- /.card-header -->
             <div class="card-body table-responsive">
                <div class="table-responsive">
                    <table id="subject_tatble" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Section</th>
                                <th>Chapter</th>
                                <th>Question</th>
                                <th>Image</th>
                                <th>option</th>
                                <th>Mark</th>
                                <th>Difficulty</th>
                                <th>Code</th>
                                <th class="text-center" style="width: 25%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subject_questions as $subject_question)
                            <tr>
                                @php
                                   $subject = App\Subject::find($subject_question->subject_id);
                                   $section = App\SubjectSection::find($subject_question->subject_section_id);
                                @endphp

                                <td>{!! $subject->name !!}</td>
                                <td>{{isset($section->name)?$section->name:''}}</td>
                                <td>{{ $subject_question->chapter }}</td>
                                <td>{{ $subject_question->question }}</td>
                                <td style="width:50%; height:10%;" ><img style="width:50%; height:10%;" src="{{ asset($subject_question->image) }}" alt=""></td>
                                <td>{{ $subject_question->option }}</td>
                                <td>{{ $subject_question->mark }}</td>
                                <td>{{ $subject_question->difficulty }}</td>
                                <td>{{ $subject_question->code_id }}</td>
                                <td class="text-center">
                                    @if(canViewRoute('admin.make.question.again','route'))
                                    <a href="{!! route('admin.make.question.again',[$slug,$subject_question->code_id,$subject_question->subject_section_id]) !!}"
                                       class="btn btn-sm btn-info">
                                        <i class="fa fa-edit" title="Edit">Again Generate</i>
                                    </a>
                                    @endif
                                    @if(canViewRoute('admin.make.question.destroy','route'))
                                    <a href="{!! route('admin.make.question.destroy',[$slug,$subject_question->code_id]) !!}" class="btn btn-sm btn-danger"
                                       style="margin-top: 10px" onclick="return confirm('Are you sure to delete this?\nYou will not be able to restore this.')"
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
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

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
