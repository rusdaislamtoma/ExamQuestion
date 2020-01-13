<?php

namespace App\Http\Controllers\Admin;
use App\Grade;
use App\Http\Controllers\Controller;
use App\Traits\SlugHelper;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Route;
use Session;

class GradeController extends Controller
{
    use SlugHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Class';
        $data['breadcrumb'] = 'Class';
        $data['grades'] = Grade::orderBy('name','ASC')->get();
        return view('backend.grade.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $route = Route::currentRouteName();
        Session::flash('create_route', $route);
        $request->validate([
            'name' => 'required',
        ]);
        // return $request;

        $grade = new Grade;
        $grade->name = $request->name;
        $grade->slug = $this->str_slug($request->name);
        $grade->save();
        Toastr::success('Grade information added successfully', 'Info added');
        return redirect()->route('admin.grade.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $grade = Grade::where('id',$request->id)->first();
        return $grade;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $grade = Grade::where('id',$request->rank_id)->first();
        $route = Route::currentRouteName();
        Session::flash('edit_route', $route);
        $request->validate([
            'name' => 'required',
        ]);
        $grade->name = $request->name;
        $grade->slug = $this->str_slug($request->name);
        $grade->save();
        Toastr::success('Grade details updated successfully', 'Updated');
        return redirect()->route('admin.grade.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subjects = Subject::where('grade_id',$id)->get();
        if($subjects){
            foreach($subjects as $subject)
            {
                $subject->delete();
            }
        }
        Grade::findOrFail($id)->delete();
        Toastr::success('Rank deleted successfully', 'Deleted');
        return redirect()->route('admin.grade.index');
    }
}
