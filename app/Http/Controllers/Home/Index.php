<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Cate;
use DB;
class Index extends Controller
{
	/**
	 * 前台首页
	 * @return [type] [description]
	 */
    public function index(){

    	$where['status'] = '1';
    	$catename = [];
    	if(request('id') ){
    		$where['cate_id'] = request('id');
    		$catename = Cate::where(['id'=>request('id')])->value('catename');
    	}

    	//文章列表
    	$articleslist = Article::with('members:id,nickname')->orderBy('created_at','desc')->where($where)->paginate(15);
    	$viewData = [
    		'articlesl'=>$articleslist,
    		'catename'=>$catename
    	];

    	return view('home.index.index',$viewData);
    }

    /**
     * 文章详情
     * @return [type] [description]
     */
    public function artinfo(){
    	return view('home.index.artinfo');
    }
}
