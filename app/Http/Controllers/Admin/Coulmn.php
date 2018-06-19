<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate;

class Coulmn extends Controller
{
    //栏目列表
    public function coulmns(){
    	$cataModel = new Cate();
    	$catelists = Cate::orderBy('sort','asc')->paginate(15);
    	$viewData = [
    		'catelists'=>$catelists
    	];

    	return view('admin.coulmn.coulmns',$viewData);
    }

    /**
     * 栏目添加
     * @return [type] [description]
     */
    public function addcoulmn(){
    	if(request()->isMethod('post')){
    		$data = request()->only('catename','sort');
    		$CateModel = new Cate();
    		$resule = $CateModel->register($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'添加成功',
    				'url'=>url('admin/coulmns'),
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

    	return view('admin.coulmn.addcoulmn');
    }

    //栏目编辑
    public function cateedit(){
    	if(request()->isMethod('post')){
    		$data = request()->only('catename','sort','id');
    		$CateModel = new Cate();
    		$resule = $CateModel->editinfo($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'修改成功',
    				'url'=>url('admin/coulmns'),
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

    	$result = Cate::find(request('id'));
    	return view('admin.coulmn.coulmnedit',['coulmninfo'=>$result]);
    }

    //删除栏目
    public function catedel(){
    	request()->isMethod('post')?true:exit;

    	$resule = Cate::find(request('id'));
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
}
