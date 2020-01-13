<?php

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Role;
use App\RolePermission;
use App\RoleUser;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Session;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Roles';
        $data['breadcrumb'] = 'Roles';
        $roles=New Role();
        $data['title']='Manage Role';
        if(isset($request->key)){
            $roles=$roles->withTrashed()->where('title','LIKE','%'.$request->key.'%');
        }

        $roles = $roles->withTrashed()->orderBy('id','ASC')->paginate(5);
        if(isset($request->search))
        {
            $render['search']=$request->search;
            $roles=$roles->appends($render);
        }
        $data['roles']=$roles;
        $serial=1;
        if($roles->currentPage()>1)
        {
            $serial=(($roles->currentPage()-1)*$roles->perPage())+1;
        }
        $data['serial']=$serial;
        return view('backend.user.role.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Create Role';
        $data['breadcrumb_parent'] = 'Role';
        $data['parent_route'] = 'role.index';
        $data['breadcrumb'] = 'Create';
        $data['title']='Add Role';
        return view('backend.user.role.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $role=New Role();
        $role->title=$request->title;
        $role->description=$request->description;
        $role->status=$request->status;
        $role->save();
        Toastr::success('Role added successfully','Added');
        return redirect()->route('role.index');

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Role';
        $data['breadcrumb_parent'] = 'Role';
        $data['parent_route'] = 'role.index';
        $data['breadcrumb'] = 'Edit';
        $data['role'] = Role::withTrashed()->where('id',$id)->first();
        return view('backend.user.role.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',

        ]);
        $user = Role::withTrashed()->where('id',$id)->first();
        $user->title = $request->title;
        $user->description = $request->description;
        $user->status = $request->status;
        $user->save();
        Toastr::success('Role updated successfully','Updated');
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        RoleUser::where('role_id',$id)->delete();
        RolePermission::where('role_id',$id)->delete();
        Role::findorfail($id)->delete();
        Toastr::success('Role Successfully Trashed','Trashed');
        return redirect()->back();
    }

    public function restore($id){
        RoleUser::where('role_id',$id)->restore();
        RolePermission::where('role_id',$id)->restore();
        Role::withTrashed()->where('id',$id)->first()->restore();
        Toastr::success('Role Successfully Restored','Restored');
        return redirect()->route('role.index');
    }
    public function destroy($id){
        RoleUser::where('role_id',$id)->forceDelete();
        RolePermission::where('role_id',$id)->forceDelete();
        Role::withTrashed()->where('id',$id)->first()->forceDelete();
        Toastr::success('Role Successfully Deleted','Deleted');
        return redirect()->route('role.index');
    }
}
