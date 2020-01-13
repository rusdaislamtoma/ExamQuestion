<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public function index()
	{
		$data['page_title'] = 'Dashboard';
		$data['breadcrumb'] = 'Dashboard';
		return view('backend.dashboard',$data);
	}
}
