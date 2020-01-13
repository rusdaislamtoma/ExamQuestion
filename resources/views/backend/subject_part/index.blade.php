@extends('layouts.backend.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- /.card -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5" style="padding-top: 5px;padding-bottom: 5px;">

                    </div>
                    <div class="col-md-4" style="padding-top: 5px;padding-bottom: 5px;">

                    </div>
                    <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                     @if(canViewRoute('user.create','route'))  
                     <a href="{{ route('admin.subject.part.create',$slug) }}" class="btn btn-block btn-outline-success">
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
                            @foreach($subject_parts as $subject_part)
                            <tr>
                                <td>{!! $subject_part->name !!}</td>
                                @php
                                $subject = App\Subject::find($subject_part->subject_id);   
                                @endphp
                                <td>{!! $subject->name !!}</td>
                                <td class="text-center">
                                    @if(canViewRoute('admin.subject.part.edit','route'))
                                    <a href="{!! route('admin.subject.part.edit',[$slug,$subject_part->slug]) !!}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit" title="Edit"></i>
                                    </a>
                                    @endif
                                    @if(canViewRoute('admin.subject.part.destroy','route'))
                                    <a href="{!! route('admin.subject.part.destroy',[$slug,$subject_part->slug]) !!}" class="btn btn-sm btn-danger"
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
