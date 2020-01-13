<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\SubjectPart;
use App\SubjectSection;
use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Traits\SlugHelper;

class SubjectSectionController extends Controller
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
        $data['grade']=Grade::where('id',$subject->grade_id)->first();

        if($subject)
        {
            $data['page_title'] = 'Section';
            $data['breadcrumb_parent'] = 'Subject';
            $data['parent_route'] = 'admin.grade.subject';
            $data['breadcrumb'] = 'Section';
            $data['route_id'] = $subject->slug;
            $data['slug'] = $subject->slug;
            $data['subject_sections'] = SubjectSection::where('subject_id',$subject->id)->get();
            return view('backend.subject_section.index',$data);
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
    public function create($subject)
    {
        $data['subject'] = Subject::where('slug',$subject)->first();
        $data['page_title'] = 'Add Section';
        $data['breadcrumb_parent'] = 'Section';
        $data['parent_route'] = 'admin.grade.subject';
        $data['route_id'] = $subject;
        $data['breadcrumb'] = 'Add Section';
        $data['subject_parts'] = SubjectPart::where('subject_id',$data['subject']->id)->get();
        return view('backend.subject_section.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
        ]);
        // return $request;
        $subject = Subject::where('slug',$slug)->first();
        $subject_section = new SubjectSection;
        $subject_section->subject_id = $subject->id;
        $subject_section->name = $request->name;
        $subject_section->slug = $this->str_slug($request->name);
        $subject_section->save();
        Toastr::success('Subject section information added successfully', 'Info added');
        return redirect()->route('admin.subject.section.index',$slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubjectSection  $subjectSection
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectSection $subjectSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubjectSection  $subjectSection
     * @return \Illuminate\Http\Response
     */
    public function edit($subject, SubjectSection $subjectSection,$id)
    {
        $data['subject'] = Subject::where('slug',$subject)->first();
        $data['page_title'] = 'Edit Section';
        $data['breadcrumb_parent'] = 'Section';
        $data['parent_route'] = 'admin.grade.subject';
        $data['route_id'] = $subject;
        $data['subjectSection'] = $subjectSection;
        $data['breadcrumb'] = 'Edit Section';
        $data['subject_parts'] = SubjectPart::where('subject_id',$data['subject']->id)->get();
       // dd($data['subject_parts']);
        $data['section'] = SubjectSection::where(['subject_id'=>$data['subject']->id,'id'=>$id])->first();
        //dd($data['section']);
        return view('backend.subject_section.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubjectSection  $subjectSection
     * @return \Illuminate\Http\Response
     */
    public function update($slug, SubjectSection $subjectSection, Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        // return $request;
        $subject = Subject::where('slug',$slug)->first();
        $subjectSection = SubjectSection::where('id',$id)->first();
        $subjectSection->subject_id = $subject->id;
        $subjectSection->name = $request->name;
        $subjectSection->slug = $this->str_slug($request->name);
        $subjectSection->save();
        Toastr::success('Subject section information updated successfully', 'Info updated');
        return redirect()->route('admin.subject.section.index',$slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubjectSection  $subjectSection
     * @return \Illuminate\Http\Response
     */
    public function destroy($subject, SubjectSection $subjectSection)
    {
        $subjectSection->delete();
        Toastr::success('Subject section deleted successfully', 'Deleted');
        return redirect()->route('admin.subject.section.index',$subject);
    }
}
