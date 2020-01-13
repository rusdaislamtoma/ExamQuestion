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

    @isset($subject_section)
        <div class="col-md-3">
            <div class="col-md-12">
                <div class="form-group" >
                    <label>Section: <span style="color:red">*</span></label>
                    <input type="text" name="subject_section_name" value="{{ isset($subject_section)?$subject_section->name:'' }}" class="form-control border border-info" required readonly>
                </div>
            </div>
        </div>
    @endisset
    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Chapter: <span style="color:red">*</span></label>
                <input type="text" name="chapter" value="{{ isset($make_question)?$make_question->chapter:'' }}" class="form-control border border-info" required readonly>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Quality: <span style="color:red">*</span></label>
                <input type="text" name="difficulty" placeholder="Enter subject name" value="{{ isset($make_question)?$make_question->difficulty:'' }}" class="form-control border border-info" required readonly>
            </div>
        </div>
    </div>
</div>






