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
                            <a href="{{ route('admin.grade.subject',$grade->slug) }}" class="btn btn-block btn-outline-primary">
                                Back </a>
                        @endif

                    </div>
                    <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                     @if(canViewRoute('user.create','route'))  
                     <a href="{{ route('admin.subject.section.create',$slug) }}" class="btn btn-block btn-outline-success">
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
                                <th>Subject</th>
                                <th class="text-center" style="width: 25%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subject_sections as $subject_section)
                            <tr>
                                <td>{!! $subject_section->name !!}</td>
                                @php
                                  $subject = App\Subject::find($subject_section->subject_id);
                                @endphp
                                <td>{!! isset($subject)?$subject->name:'' !!}</td>
                                <td class="text-center">
                                    @if(canViewRoute('admin.subject.section.edit','route'))
                                    <a href="{!! route('admin.subject.section.edit',[$slug,$subject_section->slug,$subject_section->id]) !!}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit" title="Edit"></i>
                                    </a>
                                    @endif
                                    @if(canViewRoute('admin.subject.section.destroy','route'))
                                    <a href="{!! route('admin.subject.section.destroy',[$slug,$subject_section->slug]) !!}" class="btn btn-sm btn-danger"
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
