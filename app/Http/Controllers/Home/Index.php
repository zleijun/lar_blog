<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Index extends Controller
{
	/**
	 * 前台首页
	 * @return [type] [description]
	 */
    public function index(){
    	return view('home.index.index');
    }
}
