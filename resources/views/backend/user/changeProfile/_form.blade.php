

<h4 class="text-center">Update Information</h4>
<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
</div>
{{-- <div class="form-group">
    <label>Email</label>
    <input type="email" name="email" value="{{ $user->email }}" class="form-control">
</div> --}}
<div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" autocomplete="off">
</div>
<div class="form-group">
    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control">
</div>


<div class="form-group">
    <input name="image" id="imgupload" data-default-file="{{ isset($user)?asset($user->image):'' }}" data-max-file-size="2M" type="file" class="form-control">
</div>
</div>
