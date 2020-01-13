<?php

namespace App\Http\Controllers\Admin;
use App\MakeQuestion;
use App\Subject;
use App\WrittenQuestion;
use Illuminate\Http\Request;
use App\SubjectQuestion;
use App\SubjectSection;
use App\Http\Controllers\Controller;
use Session;
class SettingController extends Controller
{
    public function ajaxChapterLoadBySectionId($sectionId){
        $data['chapters'] = SubjectQuestion::where('subject_section_id',$sectionId)->distinct()->get(['chapter']);
        return view('backend.make_question.ajaxChapterLoadBySectionId',$data);
    }

    public function ajaxDifficultyLoadByChapterID($sectionId, $chapter_id){
        $data['difficultys'] = SubjectQuestion::where('chapter',$chapter_id)->where('subject_section_id',$sectionId)->distinct()->get(['difficulty']);
        return view('backend.make_question.ajaxDifficultyLoadByChapterID',$data);
    }
    public function ajaxQuestionLoad($sectionId,$chapterId,$difficulty){
        $questions = SubjectQuestion::where(['subject_section_id'=>$sectionId,'chapter'=>$chapterId,'difficulty'=>$difficulty])->get();
        return $questions;
    }


    ////////////////////////////////////////Make Written Question///////////////////////////
    public function ajaxChapterLoadBySectionIdforwritten($sectionId){
        $data['chapters'] = WrittenQuestion::where('subject_section_id',$sectionId)->distinct()->get(['chapter']);
        return view('backend.make_written_question.ajaxChapterLoadBySectionId',$data);
    }

    public function ajaxDifficultyLoadByChapterIDforwritten($sectionId, $chapter_id){
        $data['difficultys'] = WrittenQuestion::where('chapter',$chapter_id)->where('subject_section_id',$sectionId)->distinct()->get(['difficulty']);
        return view('backend.make_written_question.ajaxDifficultyLoadByChapterID',$data);
    }
    public function ajaxQuestionLoadforwritten($sectionId,$chapterId,$difficulty){
        $questions = WrittenQuestion::where(['subject_section_id'=>$sectionId,'chapter'=>$chapterId,'difficulty'=>$difficulty])->get();
        return $questions;
    }

//    public function add_to_queue(Request $request)
//    {
//        $question_id = $request->question_id;
//        $mark = $request->question_mark;
//        $question = SubjectQuestion::find($question_id);
//        if(!$question) {
//            abort(404);
//        }
//        $queue = session()->get('question_queue');
//        // if question is empty then this the first question
//        if(!$queue) {
//            $queue = [
//                $question_id => [
//                    "question_id" => $question->id,
//                    "subject_section_id" => $question->subject_section_id,
//                    "chapter" => $question->chapter,
//                    "question" => $question->question,
//                    "difficulty" => $question->difficulty,
//                ]
//            ];
//            session()->put('question_queue', $queue);
//            return redirect()->back()->with('success', 'Question added to queue!');
//        }
//        // if question not empty then check if this question exist
//        if(isset($queue[$question_id])) {
//            session()->put('question_queue', $queue);
//            return redirect()->back()->with('warning', 'Question is already in queue');
//        }
//        // if item not exist in question then add to question with quantity = 1
//        $queue[$question_id] = [
//            "question_id" => $question->id,
//            "subject_section_id" => $question->subject_section_id,
//            "chapter" => $question->chapter,
//
//            "question" => $question->question,
//            "difficulty" => $question->difficulty,
//        ];
//        session()->put('question_queue', $queue);
//        return redirect()->back()->with('success', 'Question added to queue');
//    }

}
