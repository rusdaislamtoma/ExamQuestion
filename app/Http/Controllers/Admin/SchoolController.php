<?php

namespace App\Http\Controllers\Admin;

use App\School;
use App\Traits\SlugHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Route;
use Session;

class SchoolController extends Controller
{
    use SlugHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'School';
        $data['breadcrumb'] = 'School';
        $data['school'] = School::first();
        $data['schools'] = School::orderBy('name','ASC')->get();
        return view('backend.school.index',$data);
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

        $school = new School();
        $school->name = $request->name;
        $school->slug = $this->str_slug($request->name);
        $school->save();
        Toastr::success('School information added successfully', 'Info added');
        return redirect()->route('admin.school.index');
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
        $school = School::where('id',$request->id)->first();
        return $school;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $school = School::where('id',$request->rank_id)->first();
        $route = Route::currentRouteName();
        Session::flash('edit_route', $route);
        $request->validate([
            'name' => 'required',
        ]);
        $school->name = $request->name;
        $school->slug = $this->str_slug($request->name);
        $school->save();
        Toastr::success('School details updated successfully', 'Updated');
        return redirect()->route('admin.school.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        School::findOrFail($id)->delete();
        Toastr::success('School deleted successfully', 'Deleted');
        return redirect()->route('admin.school.index');
    }
}
