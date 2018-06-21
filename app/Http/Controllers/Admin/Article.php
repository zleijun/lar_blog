<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Cate;
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

    //文章添加
    public function addarticle(){

    	if(request()->isMethod('post')){
    		$data = request()->only('title','tags','member_id','cate_id','desc','content');
    		$ArticleModel = new ArticleModel();
    		$resule = $ArticleModel->register($data);
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

        $memberlists = Member::all(['id','nickname']);
        $catelists = Cate::all(['id','catename']);
        $viewData = [
            'memberlists'=>$memberlists,
            'catelists'=>$catelists
        ];
    	return view('admin.article.addarticle',$viewData);
    }

    //文章编辑
    public function articleedit(){
    	
    	$ArticleModel = new ArticleModel();
    	if(request()->isMethod('post')){
    		$data = request()->only('id','title','tags','member_id','cate_id','desc','content');
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
        $memberlists = Member::all(['id','nickname']);
        $catelists = Cate::all(['id','catename']);
        $viewData = [
            'memberlists'=>$memberlists,
            'catelists'=>$catelists,
            'articleinfo'=>$result
        ];

    	return view('admin.article.articleedit',$viewData);
    }

    //删除文章
    public function articleel(){
    	request()->isMethod('post')?true:exit;

    	$resule = ArticleModel::with('comments')->find(request('id'));
        foreach ($resule->comments as $value) {
            $value->delete();
        }
    	$res = $resule->delete();
    	if($res){
			$msg = [
				'code'=>1,
				'msg'=>'删除成功',
			];
		}else{
			$msg = [
				'code'=>0,
				'msg'=>'删除失败',
			];
		}
		return $msg;
    }

    //上架下架|是否推荐操作
    public function artstatus(){
    	request()->isMethod('post')?true:exit;

    	$data =  request()->only(['id','status','is_top']);
    	$articleInfo = ArticleModel::find($data['id']);
        if(isset($data['status'])){
            $articleInfo->status = $data['status']?'0':'1';
        }elseif(isset($data['is_top'])){
            $articleInfo->is_top = $data['is_top']?'0':'1';
        }else{
            return ['code'=>0,'msg'=>'错误操作'];
        }
    	$result = $articleInfo->save();
    	if($result){
    		return ['code'=>1,'msg'=>'操作成功','url'=>url('admin/articles')];
    	}else{
    		return ['code'=>0,'msg'=>'修改失败'];
    	}
    }
}
