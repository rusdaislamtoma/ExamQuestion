<div class="row">
    @if ($errors->any())
    <div class="col-md-12">
        <div style="color: red;"><ul><li>{{ implode('', $errors->all(':message')) }}</li></ul></div>
    </div>
    @endif
    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Subject: <span style="color:red">*</span></label>
                <input type="text" name="subject_name" placeholder="Enter subject name" value="{{ isset($subject)?$subject->name:'' }}" class="form-control border border-info" id="subject" required readonly>
            </div>
        </div>
    </div>
    @isset($subject_sections)
    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Subject's Section: <span style="color:red">*</span></label>
                <select class="form-control border border-info" name="subject_section_id" id="sectionId" required>
                    <option value="" disabled selected>Select Section</option>
                    @foreach($subject_sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @endisset
    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Chapter: <span style="color:red">*</span></label>
                <select class="form-control border border-info" name="chapter" id="chapterId" required>
                    <option value="" disabled selected>Select Chapter Name</option>
                    @foreach($chapters as $chapter)
                            <option value="{{ $chapter }}">{{ 'Chapter '. $chapter }}</option>
                    @endforeach
                </select>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Difficulty: <span style="color:red">*</span></label>
                <select class="form-control border border-info" name="difficulty" id="difficultyId" required>
                    <option value="" disabled selected>Select Difficulty</option>
                </select>

            </div>
        </div>
    </div>
</div>
{{-- <div class="row section">
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered question-row">
        <tr class="text-center">
           <th width="85%">Question</th>
           <th>Mark</th>
           <th>Add</th>
       </tr>

</table>
</div>
</div> --}}





