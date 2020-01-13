@if ($errors->any())
<div class="col-md-12">
<div style="color: red;">**{{ implode('', $errors->all(':message')) }}</div>
</div>
@endif
<div class="col-md-6">
    <div class="col-md-10">
        <div class="form-group" >
            <label>Name: <span style="color:red">*</span></label>
            <input type="text" placeholder="Enter Name" value="{{ isset($user)?$user->name:old('name') }}" name="name" class="form-control" required >
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="col-md-10">
        <div class="form-group" >
            <label>Gender: </label>
            @if(isset($user))
            <select class="form-control" name="gender">
                <option disabled>Select Gender</option>
                <option {{ $user->gender == 1?'selected':'' }} value="1" >Male</option>
                <option {{ $user->gender == 2?'selected':'' }} value="2" >Female</option>
            </select>
            @else
            <select class="form-control" name="gender">
                <option selected disabled>Select Gender</option>
                <option value="1" >Male</option>
                <option value="2" >Female</option>
            </select>
            @endif
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="col-md-10">
        <div class="form-group" >
            <label>Email Address: <span style="color:red">*</span></label>
            <input type="email" placeholder="Email Address" name="email" value="{{ isset($user)?$user->email:old('email') }}" class="form-control" autocomplete="on" {{ isset($user)?'readonly':'required' }}>

        </div>
    </div>
</div>

<div class="col-md-6 " >
    <div class="col-md-10">
        <div class="form-group" >
            <label>Contact:</label>
            <input type="text" placeholder="Cell Phone" name="contact" value="{{ isset($user)?$user->contact:old('contact') }}" class="form-control">
        </div>
    </div>
</div>

<div class="col-md-6">
    @if(Auth::user()->type == 'Super Admin')
    <div class="col-md-10">
        <div class="form-group" >
            <label>Admin Type: <span style="color:red">*</span></label>
            @if(isset($user))
            <select class="form-control" name="adminType" required id="admin" >
                <option disabled>Select Admin Type</option>
                <option {{ $user->type === 'Super Admin'?'selected':'' }} value="Super Admin" >Super Admin</option>
                <option {{ $user->type === 'Admin'?'selected':'' }} value="Admin" >Admin</option>
            </select>
            @else
            <select class="form-control" name="adminType" required id="admin" >
                <option value="" selected disabled>Select Admin Type</option>
                <option value="Super Admin" >Super Admin</option>
                <option value="Admin" >Admin</option>
            </select>
            @endif
        </div>
    </div>
    @endif
</div>

<div class="col-md-6">
    @if(Auth::user()->type == 'Super Admin')
    <div class="col-md-10">
        <div class="form-group" >
            <span>Admin Status:<b style="color:red">*</b></span>
            @if(isset($user))
            <select class="form-control" name="status" required>
                <option disabled>Select Status</option>
                <option {{ $user->status === 'active'?'selected':'' }} value="active">Active</option>
                <option {{ $user->status === 'inactive'?'selected':'' }} value="inactive" >Inactive</option>
            </select>
            @else
            <select class="form-control" name="status" required>
                <option disabled>Select Status</option>
                <option  value="active" selected >Active</option>
                <option  value="inactive" >Inactive</option>
            </select>
            @endif
        </div>
    </div>
    @endif
</div>
<div class="col-md-12">
    <div class="form-group"></div>
    <input name="image" id="imgupload" type="file" data-default-file="{{ isset($user)?asset($user->image):'' }}" data-max-file-size="2M" class="form-control">
</div>