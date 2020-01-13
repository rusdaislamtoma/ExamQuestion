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
                <input type="text" placeholder="Enter subject name" value="{{ isset($subject)?$subject->name:'' }}" class="form-control border border-info" required readonly>
            </div>
        </div>
    </div>
{{-- @isset($subject_parts)
    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Subject's Part: <span style="color:red">*</span></label>
                <select class="form-control" name="subject_part_id" required>
                    <option value="" disabled selected>Select Part</option>
                    @forelse($subject_parts as $subject_part)
                        <option value="{{ $subject_part->id }}">{{ $subject_part->name }}</option>
                    @empty
                    @endforelse
                </select>

            </div>
        </div>
    </div>
    @endisset --}}
    @isset($subject_sections)
    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Subject's Section: <span style="color:red">*</span></label>
                <select class="form-control border border-info" name="subject_section_id" required>
                    <option value="" disabled selected>Select Section</option>
                    @forelse($subject_sections as $subject_section)
                    <option value="{{ $subject_section->id }}">{{ $subject_section->name }}</option>
                    @empty
                    @endforelse
                </select>

            </div>
        </div>
    </div>
    @endisset
    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Chapter: <span style="color:red">*</span></label>
                <select class="form-control border border-info" name="chapter" required>
                    @php
                    $number_of_chapter = $subject->number_of_chapters;
                    @endphp
                    <option value="" disabled selected>Select Chapter Name</option>
                    @for($i=1;$i<=$number_of_chapter;$i++)
                    <option value="{{ $i }}">{{ 'Chapter '. $i }}</option>
                    @endfor
                </select>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Difficulty: <span style="color:red">*</span></label>
                <select class="form-control border border-info" name="difficulty" required>
                    <option value="" disabled selected>Select Difficulty</option>
                    <option value="basic">Basic</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>
                </select>

            </div>
        </div>
    </div>

    <br/>
    <div class="col-md-12">
        <div class="col-md-2">
            <div class="form-group" >
                <a href="#" class="btn btn-block btn-outline-success form-control" id="add_new_question">
                New Question Field</a>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Question:<span style="color:red">*</span></label>
                <textarea  name="question[]" rows="2" cols="50" class="form-control border border-info" placeholder="Enter Question" required></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group">
                <label>Image:</label>
                <input id="fileId" type="file" name="image0" class="form-control border border-info"/>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Option 1:</label>
                <input type="text" value="" name="option0[]" class="form-control border border-info" placeholder="Enter Option" >
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Option 2:</label>
                <input type="text" value="" name="option0[]" class="form-control border border-info" placeholder="Enter Option" >
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="col-md-12">
        </div>
    </div>

    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Option 3:</label>
                <input type="text" value="" name="option0[]" class="form-control border border-info" placeholder="Enter Option" >
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Option 4:</label>
                <input type="text" value="" name="option0[]" class="form-control border border-info" placeholder="Enter Option" >
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="col-md-12">
            <div class="form-group" >
                <label>Marks: <span style="color:red">*</span></label>
                <input type="number" value="" step="0.01" name="mark[]" class="form-control border border-info" placeholder="Enter mark" required >
            </div>
        </div>
    </div>

    <div class="col-md-12" id="question">

    </div>

</div>