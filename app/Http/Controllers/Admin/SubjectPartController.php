<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\SubjectPart;
use App\Subject;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Traits\SlugHelper;

class SubjectPartController extends Controller
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
        if($subject)
        {
            $data['page_title'] = 'Parts';
            $data['breadcrumb_parent'] = 'Subject';
            $data['parent_route'] = 'admin.grade.subject';
            $data['breadcrumb'] = 'Parts';
            $data['route_id'] = $subject->slug;
            $data['slug'] = $subject->slug;
            $data['subject_parts'] = SubjectPart::where('subject_id',$subject->id)->get();
            return view('backend.subject_part.index',$data);
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
        // return $subject;
        $data['subject'] = Subject::where('slug',$subject)->first();
        $data['page_title'] = 'Add part';
        $data['breadcrumb_parent'] = 'Part';
        $data['parent_route'] = 'admin.grade.subject';
        $data['route_id'] = $subject;
        $data['breadcrumb'] = 'Add part';
        return view('backend.subject_part.create',$data);
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
        ]);
        // return $request;
        $subject = Subject::where('slug',$slug)->first();
        $subject_part = new SubjectPart;
        $subject_part->subject_id = $subject->id;
        $subject_part->name = $request->name;
        $subject_part->slug = $this->str_slug($request->name);
        $subject_part->save();
        Toastr::success('Subject part information added successfully', 'Info added');
        return redirect()->route('admin.subject.part.index',$slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubjectPart  $subjectPart
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectPart $subjectPart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubjectPart  $subjectPart
     * @return \Illuminate\Http\Response
     */
    public function edit($subject, SubjectPart $subjectPart)
    {
        $data['subject'] = Subject::where('slug',$subject)->first();
        $data['page_title'] = 'Edit part';
        $data['breadcrumb_parent'] = 'Part';
        $data['parent_route'] = 'admin.grade.subject';
        $data['route_id'] = $subject;
        $data['subjectPart'] = $subjectPart;
        $data['breadcrumb'] = 'Edit';
        return view('backend.subject_part.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubjectPart  $subjectPart
     * @return \Illuminate\Http\Response
     */
    public function update($slug, SubjectPart $subjectPart, Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        // return $request;
        $subject = Subject::where('slug',$slug)->first();
        $subjectPart->subject_id = $subject->id;
        $subjectPart->name = $request->name;
        $subjectPart->slug = $this->str_slug($request->name);
        $subjectPart->save();
        Toastr::success('Subject part information updated successfully', 'Info updated');
        return redirect()->route('admin.subject.part.index',$slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubjectPart  $subjectPart
     * @return \Illuminate\Http\Response
     */
    public function destroy($subject, SubjectPart $subjectPart)
    {
        $subjectPart->delete();
        Toastr::success('Subject part deleted successfully', 'Deleted');
        return redirect()->route('admin.subject.part.index',$subject);
    }
}
