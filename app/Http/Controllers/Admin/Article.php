<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article as ArticleModel;

class Article extends Controller
{
    //会员列表
    public function articles(){
    	$articlelists = ArticleModel::with('members:id,username','cates:id,catename')->orderBy('is_top','desc')->orderBy('status','desc')->orderBy('created_at','desc')->paginate(10);

    	$viewData = [
    		'articleslists'=>$articlelists
    	];

    	return view('admin.article.articles',$viewData);
    }

    //添加会员
    public function addarticle(){

    	if(request()->isMethod('post')){
    		$data = request()->only('title','tags','nickname','email','compassword');
    		$MemberModel = new MemberModel();
    		$resule = $MemberModel->register($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'添加成功',
    				'url'=>url('admin/articles'),
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

    	return view('admin.article.addarticle');
    }

    //会员编辑
    public function articleedit(){
    	
    	$ArticleModel = new ArticleModel();
    	if(request()->isMethod('post')){
    		$data = request()->only('password','nickname','oldpwd','id');
    		$resule = $ArticleModel->editinfo($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'修改成功',
    				'url'=>url('admin/articles'),
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

    	$result = $ArticleModel->find(request('id'));

    	return view('admin.article.articleedit',['memberinfo'=>$result]);
    }

    //删除会员
    public function articleel(){
    	request()->isMethod('post')?true:exit;

    	$resule = MemberModel::find(request('id'));
    	$resule->delete();
    	if($resule){
			$msg = [
				'code'=>1,
				'msg'=>'修改成功',
			];
		}else{
			$msg = [
				'code'=>0,
				'msg'=>'删除失败',
			];
		}
		return $msg;
    }

    //会员禁用或开启操作
    public function artstatus(){
    	request()->isMethod('post')?true:exit;

    	$data =  request()->only(['id','status']);
    	$memberInfo = MemberModel::find($data['id']);
    	$memberInfo->status = $data['status']?'0':'1';
    	$result = $memberInfo->save();
    	if($result){
    		return ['code'=>1,'msg'=>'操作成功','url'=>url('admin/memberlists')];
    	}else{
    		return ['code'=>0,'msg'=>'修改失败'];
    	}
    }
}
