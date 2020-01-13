<div class="offset-md-3 col-md-6">
    <div class="form-group">
        <label>Select Role</label>
        <select name="role_id" class="form-control">
            <option selected disabled>-- Select Role --</option>
            @forelse($roles as $role)
            <option value="{{ $role->id }}">{{ $role->title }}</option>
            @empty
            @endforelse
            
        </select>
        <input type="hidden" name="id" value="{{ $id }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Status:</label>
        <input class="flat-green" type="radio" name="status" value="active" checked> Active
        <input class="flat-green" type="radio" name="status" value="inactive"> Inactive
    </div>

</div>
