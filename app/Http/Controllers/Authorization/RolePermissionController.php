<?php
namespace App\Http\Controllers\Authorization;
use App\Http\Controllers\Controller;
use App\Permission;
use App\RolePermission;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class RolePermissionController extends Controller
{
    public function index(Request $request,$id)
    {
        $data['page_title'] = 'Permissions of the role';
        $data['breadcrumb'] = 'Permissions of the role';
        if(isset($request->key))
        {
            $permissions = Permission::select('id')->withTrashed()->where('route_uri','LIKE','%'.$request->key.'%')->orWhere('route_name','LIKE','%'.$request->key.'%')->get();
            $pers=[];
            if(count($permissions)>0) {
                foreach ($permissions as $permission) {
                    $pers[]=$permission->id;
                }
            }

        }
        $data['role_id']=$id;
        $role=New RolePermission();
        $data['title']="Manage Role Permission";
        if(isset($request->key))
        {
            $role = $role->whereIn('permission_id',$pers)->where('status','Active');
        }
        $role = $role->withTrashed()->where('role_id',$id)->paginate(10);
        $data['roles'] = $role;
        $serial = 1;
        if($role->currentPage()>1)
        {
            $serial=(($role->currentPage()-1)*$role->perPage())+1;
        }
        $data['serial']=$serial;
        return view('backend.user.rolePermission.index',$data);
    }

    public function create($id)
    {   
        $data['page_title'] = 'Add permission to the role';
        $data['breadcrumb_parent'] = 'Permissions of the role';
        $data['parent_route'] = 'role_permission.index';
        $data['route_id'] = $id;
        $data['breadcrumb'] = 'Create';
        $data['title']='Add Role Permission';
        $data['role_id']=$id;
        $role_permission=Permission::all();
        foreach ($role_permission as $roles)
            if(!RolePermission::where('permission_id',$roles->id)->where('role_id',$id)->withTrashed()->exists()){
                $route_list[]=$roles;
                $data['routes']=$route_list;
            }else{

                $data['alert']="No Route Exist !";

            }
            return view('backend.user.rolePermission.create',$data);
        }

        public function store(Request $request){
            DB::beginTransaction();
            try {
                $routes=$request->all();
                foreach ($routes['routes'] as $route => $value) {
                    $permission = new RolePermission();
                    $permission->permission_id=$route;
                    $permission->role_id=$request->role_id;
                    $permission->save();
                }
                DB::commit();
                Toastr::success('Permission for the role was granted.','Granted');
                return redirect()->route('role_permission.index',$request->role_id);
            }catch (\Exception $e)
            {
                DB::rollback();
                Toastr::error($e->getMessage(),'Warning');
                return redirect()->back();
            }
        }
        public function trash($id)
        {
            RolePermission::where('id',$id)->delete();
            Toastr::success('Role Permission Successfully Trashed','Trashed');
            return redirect()->back();
        }
        public function restore($id){
            RolePermission::withTrashed()->where('id',$id)->first()->restore();
            Toastr::success('Role Permission Successfully restored','Restored');
            return redirect()->back();
        }
        public function destroy($id)
        {
            RolePermission::withTrashed()->where('id',$id)->first()->forceDelete();
            Toastr::success('Role Permission Successfully Delete','Deleted');
            return redirect()->back();
        }
    }
