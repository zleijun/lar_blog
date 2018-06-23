<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Cate;
use App\Models\Member;
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

    	$articlesinfos = Article::with('members:id,nickname','comments')->find(request('id'));

    	$viewData = [
    		'articlesinfos'=>$articlesinfos,
    	];

    	return view('home.index.artinfo',$viewData);
    }

    /**
     * 用户注册
     * @return [type] [description]
     */
    public function userregister(){
    	if(request()->isMethod('post')){
    		$data = request()->only('username','password','nickname','email','compassword');
    		$MemberModel = new Member();
    		$resule = $MemberModel->register($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'注册成功',
    				'url'=>url('home/user_logins'),
    			];
    		}else{
    			$msg = [
    				'code'=>0,
    				'msg'=>$resule['msg'],
    				'url'=>'',
    			];
    		}

    		return $msg;
    	}

    	return view('home.index.userregister');
    }

    /**
     * 用户登录
     * @return [type] [description]
     */
    public function user_logins(){
    	return view('home.index.logins');
    }
}
