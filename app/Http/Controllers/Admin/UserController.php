<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendUserPassword;
use App\Unit;
use App\User;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Traits\SanitizationHelper;
use App\Traits\SlugHelper;
class UserController extends Controller
{
    use SanitizationHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Users';
        $data['breadcrumb'] = 'Users';

        $users = New User();
        $data['title'] = 'Manage User';
        if(isset($request->key)){
            $users = $users->withTrashed()->where('name','LIKE','%'.$request->key.'%');
        }
        $users = $users->withTrashed()->where('type','!=','user')
        ->orderBy('id', 'DESC')->paginate(10);
        $data['users'] = $users;

        $serial=1;
        if($users->currentPage()>1)
        {
            $serial=(($users->currentPage()-1)*$users->perPage())+1;
        }
        $data['serial']=$serial;
        return view('backend.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Create user';
        $data['breadcrumb_parent'] = 'Users';
        $data['parent_route'] = 'user.index';
        $data['breadcrumb'] = 'Create';
        return view('backend.user.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users|max:255',
            'status' => 'required',
            'adminType' => 'required',
            'contact' => 'numeric|nullable',
            'image' => 'image|nullable|max:2000',
        ]);
        $user = New User();
        $user->name = $this->sanitize($request->name);
        $user->type = $request->adminType;
        $user->email = $request->email;
        if($request->file('image')){
            $file = $request->file('image');
            $pre = substr(uniqid(), 7, 6);
            $file_name = $pre.'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = strtolower($file->getClientOriginalExtension());
            $file_full_name = $file_name . '.' . $ext;
            $upload_path = 'uploads/admins/';
            $file_url = $upload_path . $file_full_name;
            $file->move($upload_path, $file_full_name);
            $user->image = $file_url;
        }
        $user->contact = $request->contact;

        $data['password'] = rand(0000000, 9999999);
        $user->password = bcrypt($data['password']);
        $user->gender = $request->gender;
        $user->status = $request->status;
        
        $data['name']=$request->name;
        $data['loginUri']=env('APP_URL').'/login';
        $data['email']=$request->email;
        $data['massage']='Your account has been created for '.env('APP_NAME').'. Now you are an '.$request->adminType.'. Please secure your password and change your password ASAP as this is an auto generated password.';
        Mail::to($request->email)->send(new SendUserPassword($data));
        $user->save();
        Toastr::success('User has been created.<br> Password has been sent to the mail.','Created');
        return redirect()->route('user.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit user';
        $data['breadcrumb_parent'] = 'Users';
        $data['parent_route'] = 'user.index';
        $data['breadcrumb'] = 'Edit';
        $data['title'] = 'Edit User';
        $data['user'] = User::withTrashed()->where('id', $id)->first();
        return view('backend.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'adminType' => 'required',
            'contact' => 'numeric|nullable',
            'image' => 'image|nullable|size:2000',
        ]);
        $user = User::withTrashed()->where('id', $id)->first();
        $user->name = $request->name;
        $user->type = $request->adminType;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->gender = $request->gender;
        $user->status = $request->status;
        if($request->file('image')){
            $file = $request->file('image');
            $pre = substr(uniqid(), 7, 6);
            $file_name = $pre.'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = strtolower($file->getClientOriginalExtension());
            $file_full_name = $file_name . '.' . $ext;
            $upload_path = 'uploads/admins/';
            $file_url = $upload_path . $file_full_name;
            $file->move($upload_path, $file_full_name);
            $user->image = $file_url;
        }
        $user->contact = $request->contact;
        $user->save();
        Toastr::success('User details has been updated','Updated');
        return redirect()->route('user.index');
    }
    public function changeProfile(){
        $data['page_title'] = 'Edit profile';
        $data['breadcrumb'] = 'Edit profile';
        $data['user']=User::withTrashed()->where('id',Auth::user()->id)->first();
        return view('backend.user.changeProfile.changeProfile',$data);
    }
    public function updateProfile(Request $request){
     $request->validate([
         'name' => 'required',
         'password' => 'confirmed',
         'image' => 'nullable|image|size:2000'
     ]);
     $user = User::withTrashed()->where('id', Auth::user()->id)->first();
     $user->name = $request->name;
     if ($request->password) {
         $user->password = bcrypt($request->password);
     }
     if($request->file('image')){
        $file = $request->file('image');
        $pre = substr(uniqid(), 7, 6);
        $file_name = $pre.'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $ext = strtolower($file->getClientOriginalExtension());
        $file_full_name = $file_name . '.' . $ext;
        $upload_path = 'uploads/admins/';
        $file_url = $upload_path . $file_full_name;
        $file->move($upload_path, $file_full_name);
        $user->image = $file_url;
    }
    $user->save();
    Toastr::success('Profile update successfully','Updated');
    return redirect()->back();


}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $user = User::where('id',$id)->first();
        if($user->id == 1)
        {
            Toastr::info('This user can not be deleted','Warning');
            return redirect()->back();
            
        }else{
            $user->delete();
            Toastr::success('User successfully Trashed','Trashed');
            return redirect()->back();
        }
        
    }

    public function restore($id)
    {
        User::withTrashed()->where('id', $id)->first()->restore();
        Toastr::success('User successfully restored','title');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        if(\File::exists(public_path($user->image)))
        {
            \File::delete(public_path($user->image));
        }
        User::withTrashed()->where('id', $id)->first()->forceDelete();

        Toastr::success('User successfully deleted','Deleted');
        return redirect()->back();
    }
}
