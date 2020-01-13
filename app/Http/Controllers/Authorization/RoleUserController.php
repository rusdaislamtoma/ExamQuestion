<?php
namespace App\Http\Controllers\Authorization;
use App\Http\Controllers\Controller;
use App\Role;
use App\RoleUser;
use App\User;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Session;
class RoleUserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id )
    {
        $data['page_title'] = 'User Roles';
        $data['breadcrumb_parent'] = 'Users';
        $data['parent_route'] = 'user.index';
        $data['breadcrumb'] = 'User Roles';
        $role=New RoleUser();
        $data['title']='Manage Role User';
        $role = $role->where('user_id',$id)->orderBy('id','DESC')->get();
        $data['roles']=$role;
        $serial=1;
        $data['serial']=$serial;
        $data['id']=$id;
        return view('backend.user.role_user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['page_title'] = 'Assign Role';
        $data['breadcrumb_parent'] = 'Users';
        $data['parent_route'] = 'user.index';
        $data['breadcrumb'] = 'Assign Role';
        $data['roles'] = Role::where('status','active')->get();
        $data['id'] = $id;
        return view('backend.user.role_user.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'role_id' =>'required',
            'status' => 'required',
        ]);
        $user=New RoleUser();
        $user->role_id=$request->role_id;
        $user->user_id=$request->id;
        $user->status=$request->status;
        $user->save();
        Toastr::success('Role was successfully assigned to this user','Assigned');
        return redirect()->route('role_user.index',$request->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        RoleUser::findorfail($id)->delete();
        Toastr::success('User role successfully trashed','Trashed');
        return redirect()->back();
    }
    public function restore($id){
        $roleuser=RoleUser::withTrashed()->where('id',$id)->first();
        $userid=$roleuser->user_id;
        $roleuser->restore();
        Session::flash('message','Role User Successfully Restored.');
        return redirect()->route('role_user.index',$userid);
    }
    public function destroy($id){
        $roleuser = RoleUser::withTrashed()->where('id',$id)->first();
        $userid = $roleuser->user_id;
        $roleuser->forceDelete();
        Toastr::success('User role successfully deleted','Deleted');
        return redirect()->route('role_user.index',$userid);
    }

    /**
     * active inactive
     */
    public function status($id)
    {
        $roleuser = RoleUser::withTrashed()->where('id',$id)->first();

        if($roleuser->status=='active') {
            $roleuser->status = 'inactive';
        }
        else {
            $roleuser->status = 'active';
        }
        $roleuser->save();
        Toastr::success('Role User Successfully '.$roleuser->status,$roleuser->status);
        return redirect()->route('role_user.index',$roleuser->user_id);
    }

}
