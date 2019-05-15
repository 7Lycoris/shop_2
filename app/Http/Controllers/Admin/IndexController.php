<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{	
	// 显示后台主页的方法
    public function index()
    {	
    	
    	// var_dump(session('uname'));
    	// var_dump($_SESSION);
    	return view('admin.index',[
    		'title'=>'后台主页',
    	]);
    }
}
