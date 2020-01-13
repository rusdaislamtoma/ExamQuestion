@if ($errors->any())
    <div class="col-md-12">
        <div style="color: red;"><ul><li>{{ implode('', $errors->all(':message')) }}</li></ul></div>
    </div>
@endif
<div class="col-md-4">
    <div class="col-md-12">
        <div class="form-group" >
            <label>Subject: <span style="color:red">*</span></label>
            <input type="text" placeholder="Enter subject name" value="{{ isset($subject)?$subject->name:'' }}" class="form-control border border-info" required readonly>
        </div>
    </div>
</div>
@isset($subject_sections)
    <div class="col-md-4">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Subject's Section: <span style="color:red">*</span></label>
                <select class="form-control border border-info" name="subject_section_id" required>
                    <option value="" disabled selected>Select Section</option>
                    @forelse($subject_sections as $subject_section)
                        @if($subjectQuestion)
                            <option value="{{ $subject_section->id }}"
                                    {{ $subject_section->id==$subjectQuestion->subject_section_id?'selected':'' }}>
                                {{ $subject_section->name }}</option>
                        @else
                            <option value="{{ $subject_section->id }}">{{ $subject_section->name }}</option>
                        @endif
                    @empty
                    @endforelse
                </select>

            </div>
        </div>
    </div>
@endisset
<div class="col-md-4">
    <div class="col-md-12">
        <div class="form-group" >
            <label>chapter: <span style="color:red">*</span></label>
            <select class="form-control border border-info" name="chapter" required>
                @php
                    $number_of_chapter = $subject->number_of_chapters;
                @endphp
                <option value=" ">Select Chapter Name</option>
                @if(isset($subjectQuestion))
                    @for($i=1;$i<=$number_of_chapter;$i++)
                        <option value="{{ $i }}" {{ $subjectQuestion->chapter==$i?'selected':'' }}>{{ 'Chapter '. $i }}</option>
                    @endfor
                @endif
            </select>

        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="col-md-12">
        <div class="form-group" >
            <label>Difficulty: <span style="color:red">*</span></label>
            <select class="form-control border border-info" name="difficulty" required>
                <option value="" disabled selected>Select Difficulty</option>
                <option value="Basic" {{isset($subjectQuestion) && $subjectQuestion->difficulty=='basic'?'selected':'' }}>Basic</option>
                <option value="Medium" {{isset($subjectQuestion) && $subjectQuestion->difficulty=='medium'?'selected':'' }}>Medium</option>
                <option value="Hard" {{isset($subjectQuestion) && $subjectQuestion->difficulty=='hard'?'selected':'' }}>Hard</option>
            </select>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="col-md-12">
        <div class="form-group" >
            <label>Question:<span style="color:red">*</span></label>
            <textarea  name="question" rows="2" cols="50" class="form-control border border-info" placeholder="Enter Question"
                       required>{{ isset($subjectQuestion)?$subjectQuestion->question:old('question') }}</textarea>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="col-md-12">
        <div class="form-group">
            <label>Image:</label>
            <div class="form-control border border-info" style="width:100%; height:30%">
                @if(isset($subjectQuestion))
                    <img id="imageId" style="width:20%; height:20%;clear: both;" src="{{ asset($subjectQuestion->image) }}" alt="">
                    <div style="margin-top: 5px;"><input id="fileId" type="file" name="image" onchange="readURL(this)"/></div>
                    <div class="mt-1"><img id="image" src=""/></div>
                @endif
            </div>
        </div>
    </div>
</div>
@php
$count = 0;
@endphp
@isset($options)
    @foreach($options as $key=>$option)
        <div class="col-md-3">
            <div class="col-md-12">
                <div class="form-group" >
                    <label>Option{{ $key+1 }}:</label>
                    <input type="text" value="{{  isset($subjectQuestion)?$option:old('option') }}" name="option[]" class="form-control border border-info" placeholder="Enter Option" >
                </div>
            </div>
        </div>
       @php $count++; @endphp
    @endforeach
@endisset
@if($count<4)
    @for($i=$count;$i<4;$i++)
        <div class="col-md-3">
            <div class="col-md-12">
            </div>
        </div>
    @endfor
@endif
@isset($marks)
    @foreach($marks as $key=>$mark)
<div class="col-md-3">
    <div class="col-md-12">
        <div class="form-group" >
            <label>Mark{{ $key+1 }}:</label>
            <input type="number" value="{{ isset($subjectQuestion)?$mark:old('mark') }}" name="mark[]"  step="0.01"  class="form-control border border-info" placeholder="Enter mark" >
        </div>
    </div>
</div>
    @endforeach
@endisset



