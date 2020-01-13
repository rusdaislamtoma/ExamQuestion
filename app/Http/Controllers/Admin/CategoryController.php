<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Route;
use Session;
class CategoryController extends Controller
{
    public function index()
    {
    	$data['page_title'] = 'Category';
        $data['breadcrumb'] = 'Category';
		$data['categories'] = Category::all();
		return view('backend.category.index',$data);
    }

    public function show(Request $request)
    {
    	
    }

    public function store(Request $request)
    {
    	$route = Route::currentRouteName();
    	Session::flash('create_route', $route);
    	$request->validate([
    		'category_name' => 'required',
    		'icon' => 'required',
    	]);
    	// return $request;

    	$category = new Category;
    	$category->name = $request->category_name;
    	$category->slug = str_slug($request->category_name);
    	$category->icon_class = $request->icon;
    	$category->save();
    	Toastr::success('Category Created successfully', 'Created');
        return redirect()->route('admin.category.index');

    }

    public function edit(Request $request)
    {
    	$category_details = Category::where('id',$request->id)->first();
    	return $category_details;
    }

    public function update(Request $request)
    {
    	$category = Category::where('id',$request->category_id)->first();
    	$route = Route::currentRouteName();
    	Session::flash('edit_route', $route);
    	$request->validate([
    		'category_name' => 'required',
    		'icon' => 'required',
    	]);
    	$category->name = $request->category_name;
    	$category->slug = str_slug($request->category_name);
    	$category->icon_class = $request->icon;
    	$category->save();
    	Toastr::success('Category updated successfully', 'Updated');
        return redirect()->route('admin.category.index');
    }

    public function destroy(Request $request,$id)
    {
        Category::findOrFail($id)->delete();
    	SubCategory::where('category_id',$id)->delete();
    	Toastr::success('Category deleted successfully', 'Deleted');
        return redirect()->route('admin.category.index');
    }
}
