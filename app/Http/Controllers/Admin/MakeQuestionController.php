<?php

namespace App\Http\Controllers\Admin;
use App\Grade;
use App\Http\Controllers\Controller;
use App\MakeQuestion;
use App\School;
use App\Subject;
use App\SubjectPart;
use App\SubjectQuestion;
use App\SubjectSection;
use App\Traits\SlugHelper;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Session;

class MakeQuestionController extends Controller
{
    use SlugHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($subject)
    {
        $subject = Subject::where('slug',$subject)->first();
        $data['grade'] = Grade::where('id',$subject->grade_id)->first();
        if($subject)
        {
            $data['page_title'] = 'Make Question';
            $data['breadcrumb_parent'] = 'Subject';
            $data['parent_route'] = 'admin.grade.subject';
            $data['breadcrumb'] = 'Make Question';
            $data['route_id'] = $subject->grade->slug;
            $data['slug'] = $subject->slug;

            $data['subject_questions'] = MakeQuestion::where('subject_id',$subject->id)->get();
            $data['code'] = MakeQuestion::where('subject_id',$subject->id)->distinct()->get(['code_id']);
           // dd($data['code']);
            return view('backend.make_question.index',$data);
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
        $data['subject'] = Subject::where('slug',$subject)->first();
        $data['page_title'] = 'Make Question';
        $data['breadcrumb_parent'] = 'Question';
        $data['parent_route'] = 'admin.make.question.index';
        $data['route_id'] = $subject;
        $data['breadcrumb'] = 'Make question';
        $subject_sections = SubjectSection::where('subject_id',$data['subject']->id)->get();
        if(count($subject_sections)>0){
            $data['subject_sections']=$subject_sections;
        }
        $data['sections']=[];
        $data['chapters']=[];
        return view('backend.make_question.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$slug)
    {
       // dd($request->all());
        $request->validate([
            'subject_name'=>'required',
            'subject_section_id'=>'required',
            'chapter' => 'required',
            'difficulty'=>'required',
        ]);
        // return $request;
        $subject = Subject::where('slug',$slug)->first();
        $questions = SubjectQuestion::where(['subject_id'=>$subject['id'],
            'subject_section_id'=>$request->subject_section_id,
            'chapter'=>$request->chapter,'difficulty'=>$request->difficulty])->inRandomOrder()->limit(2)->get();
       // dd($questions);

        foreach ($questions as $question){
            $make_question = new MakeQuestion();
            $make_question->code_id = $question['subject_id'].'_'.$question['subject_section_id'].'_'.
                                      $question['chapter'].'_'.$question['difficulty'];
            $make_question->subject_id = $question['subject_id'];
            $make_question->subject_section_id = $question['subject_section_id'];
            $make_question->chapter = $question['chapter'];
            $make_question->difficulty = $question['difficulty'];
            $make_question->question = $question['question'];
            $make_question->image = $question['image'];
            $make_question->option = $question['option'];
            $make_question->mark = $question['mark'];
            $make_question->save();
        }
        Toastr::success('Question maked successfully', 'Info added');
        return redirect()->back();

    }

    public function edit($subject,SubjectQuestion $subjectQuestion,$code_id,$section_id)
    {
        $data['subject'] = Subject::where('slug',$subject)->first();
        $data['page_title'] = 'Again Generate';
        $data['breadcrumb_parent'] = 'Question';
        $data['parent_route'] = 'admin.subject.question.index';
        $data['route_id'] = $subject;
        $data['subjectQuestion'] = $subjectQuestion;
        $data['breadcrumb'] = 'Again Generate';
        $subject_section = SubjectSection::where('id',$section_id)->first();
        $data['subject_section']=$subject_section;
        $data['make_question']= MakeQuestion::where('code_id',$code_id)->first();
        return view('backend.make_question.edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$slug,$codeId)
    {
      // dd($request->all());
        $request->validate([
            'subject_name'=>'required',
            'subject_section_name'=>'required',
            'chapter' => 'required',
            'difficulty'=>'required',
        ]);

        $subject = Subject::where('slug',$slug)->first();
        $subject_section = SubjectSection::where('name',$request->subject_section_name)->first();

        $questions = SubjectQuestion::where(['subject_id'=>$subject['id'],
            'subject_section_id'=>$subject_section['id'],
            'chapter'=>$request->chapter,'difficulty'=>$request->difficulty])->inRandomOrder()->limit(2)->get();

        $make_question = MakeQuestion::where('code_id',$codeId)->get();
        foreach ($questions as $key=>$question){
         
                $make_question[$key]->code_id = $question['subject_id'] . '_' . $question['subject_section_id'] . '_' .
                    $question['chapter'] . '_' . $question['difficulty'];
            $make_question[$key]->subject_id = $question['subject_id'];
            $make_question[$key]->subject_section_id = $question['subject_section_id'];
            $make_question[$key]->chapter = $question['chapter'];
            $make_question[$key]->difficulty = $question['difficulty'];
            $make_question[$key]->question = $question['question'];
            $make_question->image = $question['image'];
            $make_question[$key]->option = $question['option'];
            $make_question[$key]->mark = $question['mark'];
            $make_question[$key]->save();

        }
        Toastr::success('Question again maked successfully', 'Info added');
        return redirect()->route('admin.make.question.index',$slug);

    }
    public function destroy($subject,$codeId)
    {
        MakeQuestion::where('code_id',$codeId)->delete();
        Toastr::success('Subject question deleted successfully', 'Deleted');
        return redirect()->route('admin.make.question.index',$subject);
    }


    public function print($slug){
        $data['subject'] = Subject::where('slug',$slug)->first();

        $data['grade'] = Grade::where('id',$data['subject']->grade_id)->first();
        // dd($data['grade']);

        $data['page_title'] = 'Print Question';
        $data['breadcrumb'] = 'Print Question';
        $questions= MakeQuestion::all();
        $data['questions'] = $questions;

        $data['marks'] = MakeQuestion::sum('mark');
        $data['school'] = School::first();
        return view('backend.make_question.print',$data);
    }



}
