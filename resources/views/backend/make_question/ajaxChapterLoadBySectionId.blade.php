<div class="col-md-4">
    <div class="col-md-10">
        <div class="form-group" >
            <label>Chapter: <span style="color:red">*</span></label>
            <select class="form-control" name="chapter" id="chapterId" required>
                <option value="" disabled selected>Select Chapter Name</option>
                @foreach($chapters as $chapter)
                    <option value="{{ $chapter->chapter }}">{{ 'Chapter '. $chapter->chapter }}</option>
                @endforeach
            </select>

        </div>
    </div>
</div>