<div class="col-md-3">
    <div class="col-md-12">
        <div class="form-group" >
            <label>Difficulty: <span style="color:red">*</span></label>
            <select class="form-control" name="difficulty" id="difficultyId" required>
                <option value="" disabled selected>Select Difficulty</option>
                @foreach($difficultys as $difficulty)
                    <option value="{{ $difficulty->difficulty }}">{{ $difficulty->difficulty }}</option>
                @endforeach
            </select>

        </div>
    </div>
</div>
