<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\SlugHelper;
use Brian2694\Toastr\Facades\Toastr;
class SubjectController extends Controller
{
    use SlugHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $grade = Grade::where('slug',$slug)->first();
        if($grade)
        {
            $data['page_title'] = 'Subjects';
            $data['breadcrumb_parent'] = 'Class';
            $data['parent_route'] = 'admin.grade.index';
            $data['breadcrumb'] = 'Subjects';
            $data['slug'] = $slug;
            $data['subjects'] = Subject::where('grade_id',$grade->id)->get();
            return view('backend.subject.index',$data);
        }else{
            Toastr::warning('This class does not have any subject added.','No subject found');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $data['grade'] = Grade::where('slug',$slug)->first();
        $data['page_title'] = 'Add Subject';
        $data['breadcrumb_parent'] = 'Subject';
        $data['parent_route'] = 'admin.grade.subject';
        $data['route_id'] = $slug;
        $data['breadcrumb'] = 'Add Subject';
        return view('backend.subject.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$slug)
    {
        $request->validate([
            'name' => 'required',
            'number_of_chapters' => 'required|numeric',
            'code_no' => 'required',
            'mcq_time' => 'required',
            'written_time' => 'required',
        ]);
        // return $request;
        $grade = Grade::where('slug',$slug)->first();
        $subject = new Subject;
        $subject->grade_id = $grade->id;
        $subject->name = $request->name;
        $subject->slug = $this->str_slug($request->name);
        $subject->number_of_chapters = $request->number_of_chapters;
        $subject->code_no = $request->code_no;
        $subject->mcq_time = $request->mcq_time;
        $subject->written_time = $request->written_time;
        $subject->save();
        Toastr::success('Subject information added successfully', 'Info added');
        return redirect()->route('admin.grade.subject',$slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,Subject $subject)
    {
        $data['grade'] = Grade::where('slug',$slug)->first();
        $data['page_title'] = 'Edit Subject';
        $data['breadcrumb_parent'] = 'Subject';
        $data['parent_route'] = 'admin.grade.subject';
        $data['route_id'] = $slug;
        $data['breadcrumb'] = 'Edit Subject';
        $data['subject'] = $subject;
        $data['slug'] = $slug;
        return view('backend.subject.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update($slug, Subject $subject, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number_of_chapters' => 'required|numeric',
            'code_no' => 'required',
            'mcq_time' => 'required',
            'written_time' => 'required',
        ]);
        $grade = Grade::where('slug',$slug)->first();
        $subject->grade_id = $grade->id;
        $subject->name = $request->name;
        $subject->slug = $this->str_slug($request->name);
        $subject->number_of_chapters = $request->number_of_chapters;
        $subject->code_no = $request->code_no;
        $subject->mcq_time = $request->mcq_time;
        $subject->written_time = $request->written_time;
        $subject->save();
        Toastr::success('Subject information updated successfully', 'Info updated');
        return redirect()->route('admin.grade.subject',$slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, Subject $subject)
    {
        $subject->delete();
        Toastr::success('Subject deleted successfully', 'Deleted');
        return redirect()->route('admin.grade.subject',$slug);
    }
}
