@if ($errors->any())
<div class="col-md-12">
<div style="color: red;"><ul><li>{{ implode('', $errors->all(':message')) }}</li></ul></div>
</div>
@endif
<div class="col-md-12" style="margin-left: 250px">
    <div class="col-md-6">
        <div class="form-group" >
            <label>Subject: <span style="color:red">*</span></label>
            <input type="text" placeholder="Enter subject name" value="{{ isset($subject)?$subject->name:'' }}" class="form-control border border-info" required readonly>
        </div>
    </div>
</div>

<div class="col-md-12" style="margin-left: 250px">
    <div class="col-md-6">
        <div class="form-group" >
            <label>Section: <span style="color:red">*</span></label>
            <input type="text" placeholder="Enter subject section name" value="{{ isset($subjectSection)?$subjectSection->name:old('name') }}" name="name" class="form-control border border-info" required >
        </div>
    </div>
</div>

