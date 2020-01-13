<?php

namespace App\Http\Controllers\Admin;
use App\Grade;
use App\Http\Controllers\Controller;
use App\Subject;
use App\SubjectPart;
use App\SubjectQuestion;
use App\SubjectSection;
use App\Traits\SlugHelper;
use App\WrittenQuestion;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class WrittenQuestionController extends Controller
{
    use SlugHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($subject)
    {
       // dd($subject);
        $subject = Subject::where('slug',$subject)->first();
        $data['grade']= Grade::where('id',$subject->grade_id)->first();
        if($subject)
        {
            $data['page_title'] = 'Add Written Question';
            $data['breadcrumb_parent'] = 'Subject';
            $data['parent_route'] = 'admin.grade.subject';
            $data['breadcrumb'] = 'Add Written Question';
            $data['route_id'] = $subject->grade->slug;
            $data['slug'] = $subject->slug;

            $data['subject_questions'] = WrittenQuestion::where('subject_id',$subject->id)->orderBy('id','DESC')->get();
            return view('backend.subject_written_question.index',$data);
        }else{
            Toastr::warning('This Subject does not have any question added.','No question found');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subject)
    {
        //dd('hello');
        $data['subject'] = Subject::where('slug',$subject)->first();
        $data['page_title'] = 'Add Written Question';
        $data['breadcrumb_parent'] = 'Written Question';
        $data['parent_route'] = 'admin.subject.question.index';
        $data['route_id'] = $subject;
        $data['breadcrumb'] = 'Add written question';
        $subject_sections = SubjectSection::where('subject_id',$data['subject']->id)->get();
        if(count($subject_sections)!=0){
            $data['subject_sections']=$subject_sections;
        }
        return view('backend.subject_written_question.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$slug)
    {
      //  dd($request->all());
        $request->validate([
            'chapter' => 'required',
            'question' => 'required',
            'difficulty'=>'required',
            'image'=>'mimes:png,jpeg,jpg,svg'

        ]);
        $subject = Subject::where('slug',$slug)->first();
        foreach ($request->question as $key=>$question){
            $test = 'option'.$key;
            $objects = $request->$test;
            $options = array_values(array_filter($objects));
            $mark = 'mark'.$key;
            $mark_object = $request->$mark;
            $marks = array_values(array_filter($mark_object));
            $images = 'image'.$key;
            $subject_question = new WrittenQuestion();
            $subject_question->subject_id = $subject->id;
            $subject_question->subject_section_id = $request->subject_section_id;
            $subject_question->chapter = $request->chapter;
            $subject_question->question = $question;
            $subject_question->option = json_encode($options);
            $subject_question->mark = json_encode($marks);
            $subject_question->difficulty = $request->difficulty;
            if($request->hasFile($images)){
                $image = $request->file($images);
                $imageName = uniqid().$image->getClientOriginalName();
                $image->move('uploads/written_questions_images',$imageName);
                $subject_question->image = 'uploads/written_questions_images/' .$imageName;
                $subject_question->save();
            }
            $subject_question->save();
        }

        Toastr::success('Subject written question added successfully', 'Info added');
        return redirect()->route('admin.subject.written_question.index',$slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubjectQuestion  $subjectQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectQuestion $subjectQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubjectQuestion  $subjectQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit($subject,SubjectQuestion $subjectQuestion,$id)
    {
        $data['subject'] = Subject::where('slug',$subject)->first();
        $data['page_title'] = 'Edit Written Question';
        $data['breadcrumb_parent'] = 'Question';
        $data['parent_route'] = 'admin.subject.question.index';
        $data['route_id'] = $subject;
        $data['subjectQuestion'] = $subjectQuestion;
        $data['breadcrumb'] = 'Edit Written Question';
        $subject_sections = SubjectSection::where('subject_id',$data['subject']->id)->get();
        if(count($subject_sections)!=0){
            $data['subject_sections']=$subject_sections;
        }
        $data['subjectQuestion'] = WrittenQuestion::where('id',$id)->first();
        $data['options'] = json_decode($data['subjectQuestion']->option);
        $data['marks'] = json_decode($data['subjectQuestion']->mark);
        //dd($data['subjectQuestion']);
        return view('backend.subject_written_question.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubjectQuestion  $subjectQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$slug,$id)
    {
        // dd($request->all());
        $request->validate([
            'chapter' => 'required',
            'question' => 'required',
            'difficulty'=>'required',
            'image'=>'mimes:png,jpeg,jpg,svg'

        ]);
        $subject = Subject::where('slug',$slug)->first();
        $subject_question = WrittenQuestion::where('id',$id)->first();
        $old_image = $subject_question->image;
       //  dd($subject_question);
        $subject_question->subject_id = $subject->id;
        $subject_question->subject_section_id = $request->subject_section_id;
        $subject_question->chapter = $request->chapter;
        $subject_question->question = $request->question;
        $subject_question->option = json_encode(array_values(array_filter($request->option)));
        $subject_question->mark = json_encode(array_values(array_filter($request->mark)));
        $subject_question->difficulty = $request->difficulty;
        if($request->hasFile('image')){
            if($old_image!=null){
                unlink($old_image);
            }
            $image = $request->file('image');
            $imageName = uniqid().$image->getClientOriginalName();
            $image->move('uploads/written_questions_images',$imageName);
            $subject_question->image = 'uploads/written_questions_images/' .$imageName;
            $subject_question->save();
        }
        $subject_question->save();
        Toastr::success('Subject written question Updated successfully', 'Info Updated');
        return redirect()->route('admin.subject.written_question.index',$slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubjectQuestion  $subjectQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($subject,$id)
    {
        WrittenQuestion::where('id',$id)->delete();
        Toastr::success('Subject written question deleted successfully', 'Deleted');
        return redirect()->route('admin.subject.written_question.index',$subject);
    }
}

