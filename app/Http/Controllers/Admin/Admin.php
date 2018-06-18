<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin as AdminModel;

class Admin extends Controller
{
    //管理员列表
    public function adminlist(){

    	$adminlists = AdminModel::orderBy('is_super','desc')->orderBy('status','desc')->paginate(10);
    	$viewData = [
    		'adminlists'=>$adminlists,
    		'title'=>'管理员列表'
    	];
    	return view('admin.admin.adminlist',$viewData);
    }

    //管理员禁用或开启操作
    public function status(){
    	request()->isMethod('post')?true:exit;

    	$data =  request()->only(['id','status']);
    	$adminInfo = AdminModel::find($data['id']);
    	$adminInfo->status = $data['status']?'0':'1';
    	$result = $adminInfo->save();
    	if($result){
    		return ['code'=>1,'msg'=>'操作成功','url'=>url('admin/adminlist')];
    	}else{
    		return ['code'=>0,'msg'=>'修改失败'];
    	}
    }

    //添加管理员
    public function addadmin(){

    	if(request()->isMethod('post')){
    		$data = request()->only('username','password','nickname','email','compassword');
    		$adminModel = new AdminModel();
    		$resule = $adminModel->register($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'注册成功',
    				'url'=>url('admin/adminlist'),
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
    	return view('admin.admin.addadmin');
    }

    //编辑管理员
    public function adminedit(){
    	
    	if(request()->isMethod('post')){
    		$data = request()->only('password','nickname','oldpwd','id');
    		$adminModel = new AdminModel();
    		$resule = $adminModel->editinfo($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'修改成功',
    				'url'=>url('admin/adminlist'),
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

    	$result = AdminModel::find(request('id'));

    	return view('admin.admin.edits',['admininfo'=>$result]);
    }

    //删除管理员
    public function admindel(){
    	request()->isMethod('post')?true:exit;

    	$resule = AdminModel::find(request('id'));
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
