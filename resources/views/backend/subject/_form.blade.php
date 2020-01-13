@if ($errors->any())
<div class="col-md-12">
<div style="color: red;"><ul><li>{{ implode('', $errors->all(':message')) }}</li></ul></div>
</div>
@endif
<div class="col-md-4">
    <div class="col-md-12">
        <div class="form-group" >
            <label>Class: <span style="color:red">*</span></label>
            <input type="text" placeholder="Enter subject name" value="{{ isset($grade)?$grade->name:'' }}" class="form-control border border-info" required readonly>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="col-md-12">
        <div class="form-group" >
            <label>Name: <span style="color:red">*</span></label>
            <input type="text" placeholder="Enter subject name" value="{{ isset($subject)?$subject->name:old('name') }}" name="name" class="form-control border border-info" required >
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="col-md-12">
        <div class="form-group" >
            <label>Code No: <span style="color:red">*</span></label>
            <input type="text" placeholder="Enter subject Code No." value="{{ isset($subject)?$subject->code_no:old('code_no') }}" name="code_no" class="form-control border border-info" required >
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="col-md-12">
        <div class="form-group" >
            <label>Number of chapters: <span style="color:red">*</span></label>
            <input type="text" placeholder="Number of chapters" name="number_of_chapters" value="{{ isset($subject)?$subject->number_of_chapters:old('number_of_chapters') }}" class="form-control border border-info" required>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="col-md-12">
        <div class="form-group" >
            <label>MCQ Exam Time: <span style="color:red">*</span></label>
            <input type="number" placeholder="Enter MCQ Exam Time" name="mcq_time" step="0.01" value="{{ isset($subject)?$subject->mcq_time:old('mcq_time') }}" class="form-control border border-info" required>

        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="col-md-12">
        <div class="form-group" >
            <label>Written Exam Time: <span style="color:red">*</span></label>
            <input type="number" placeholder="Enter Written Exam Time" name="written_time" step="0.01"  value="{{ isset($subject)?$subject->written_time:old('written_time') }}" class="form-control border border-info" required>
        </div>
    </div>
</div>

