@extends('layouts.backend.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-1" style="padding-top: 5px;padding-bottom: 5px;">  

                    </div>
                    <div class="col-md-4" style="padding-top: 5px;padding-bottom: 5px;">

                    </div>
                    <div class="col-md-5" style="padding-top: 5px;padding-bottom: 5px;">

                    </div>
                    <div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
                        <div>
                            <a data-toggle="modal" data-target="#add-category" href="" class="btn btn-success add_new"><i style="font-size: 18px;" class="fa fa-plus-square-o"></i> Add New</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive m-t-40">
                    <table id="data_table_1" class="display nowrap table table-hover table-striped table-bordered text-center" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td class="text-center">
                                    <a id="{{$category->id}}" href="#" data-toggle="modal" data-target="#edit-category" class="btn btn-primary edit" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a onclick="destroyCategory({{ $category->id }})" href="#" class="btn btn-warning" title="Delete">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    <form id="delete-form-{{ $category->id }}" action="{{ route('admin.category.destroy',$category->id) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<!-- Create Modal -->
<div id="add-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-material m-t-40" action="{{route('admin.category.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    @if ($errors->any())
                    <ul style="list-style: none;">
                        @foreach($errors->all() as $error)
                        <li style="color: red">{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="form-group">
                        <input value="{{old('category_name')}}" name="category_name" class="form-control form-control-line" placeholder="Category Name" type="text" required>
                    </div>
                    <div class="form-group">
                        <input value="{{old('icon')}}" name="icon" class="form-control form-control-line" placeholder="Icon Class. ex: fas fa-archive(for FontAwesome Icons)" type="text" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Close</button>
                    <!-- <input type="submit" value="Update" class="btn btn-outline-success waves-effect waves-light"> -->
                    <button type="submit" class="btn btn-outline-success waves-effect waves-light">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Edit Modal -->
<div id="edit-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h4 class="modal-title header_edit"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="mdi mdi-close-box"></i>
                </button>
            </div> -->
            <form class="form-material m-t-40" action="{{route('admin.category.update')}}" method="POST">
                @csrf
                <div class="modal-body">
                    @if ($errors->any())
                    <ul style="list-style: none;">
                        @foreach($errors->all() as $error)
                        <li style="color: red">{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="form-group">
                        <label>Category Name:</label>
                        <input id="name" value="{{old('category_name')}}" name="category_name" class="form-control form-control-line" placeholder="Category Name" type="text" required>
                    </div>
                    <div class="form-group">
                        <label>Category Icon Class:</label>
                        <input id="icon" value="{{old('icon')}}" name="icon" class="form-control form-control-line" placeholder="Icon Class. ex: fas fa-archive(for FontAwesome Icons)" type="text" required>
                    </div>
                    <input type="hidden" name="category_id" id="category_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Close</button>
                    <!-- <input type="submit" value="Update" class="btn btn-outline-success waves-effect waves-light"> -->
                    <button type="submit" class="btn btn-outline-success waves-effect waves-light">Update</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/backend/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/backend/sweetalert2.min.css')}}">
@endpush

@push('customCss')
<style type="text/css">
    .customTD{
        white-space: nowrap;
    }
</style>
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
    $('#data_table_1').DataTable({
        // dom: 'Bfrtip',
        // buttons: [
        // 'copy', 'csv', 'excel', 'pdf', 'print'
        // ]
    });
    $(document).on('click','.edit',function(){
        var category_id = $(this).attr('id');
        var body = $(".body");
        $.ajax({
          type:'GET',
          url:"{{route('admin.category.edit')}}",
          data:{'id':category_id},
          success:function(data){
            $('#name').empty();
            $('#name').val(data.name);
            $('#icon').empty();
            $('#icon').val(data.icon_class);
            $('#category_id').empty();
            $('#category_id').val(data.id);
        }
    });
    });

    function destroyCategory(id) {
        swal({
          title: 'Are you sure?<br>You won\'t be able to revert this!',
          text: "Sub Categories under this will also be deleted.",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Delete!'
      }).then((result) => {
          if (result.value) {
            $('#delete-form-'+id).submit();
        }
    })
  }
</script>

@if($errors->any())
@if(Session::has('edit_route'))
<script>
    // alert('here');
    $(document).ready(function(){
        $('#edit-category').modal({show: true});
    });
</script>
@endif
@if(Session::has('create_route'))
<script>
    // alert('here');
    $(document).ready(function(){
        $('#add-category').modal({show: true});
    });
</script>
@endif
@endif
@endpush

