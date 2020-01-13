<div class="offset-md-3 col-md-6">
    <div class="form-group">
        <label>Role Name</label>
        <input type="text" value="{{ isset($role)?$role->title:old('title') }}" name="title" class="form-control">
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ isset($role)?$role->description:old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label>Status :</label>
        @if (isset($role))
        <input class="flat-green" type="radio" name="status" {{ $role->status == 'active'?'checked':'' }} class="minimal" value="active"> Active
        <input class="flat-green" type="radio" name="status" class="minimal" {{ $role->status == 'inactive'?'checked':'' }} value="inactive"> Inactive
        @else
        <input class="flat-green" type="radio" name="status" checked class="minimal" value="active"> Active
        <input class="flat-green" type="radio" name="status" class="minimal" value="inactive"> Inactive
        @endif
    </div>
</div>
