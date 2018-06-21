<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;

class Member extends Controller
{
    //会员列表
    public function mlists(){
    	
    	$memberlists = MemberModel::orderBy('created_at','desc')->orderBy('status','desc')->paginate(10);
    	$viewData = [
    		'memberlists'=>$memberlists
    	];

    	return view('admin.member.mlists',$viewData);
    }

    //添加会员
    public function addmember(){

    	if(request()->isMethod('post')){
    		$data = request()->only('username','password','nickname','email','compassword');
    		$MemberModel = new MemberModel();
    		$resule = $MemberModel->register($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'添加成功',
    				'url'=>url('admin/memberlists'),
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

    	return view('admin.member.addmember');
    }

    //会员编辑
    public function memberedit(){

    	if(request()->isMethod('post')){
    		$data = request()->only('password','nickname','oldpwd','id');
    		$MemberModel = new MemberModel();
    		$resule = $MemberModel->editinfo($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'修改成功',
    				'url'=>url('admin/memberlists'),
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

    	$result = MemberModel::find(request('id'));

    	return view('admin.member.memberedit',['memberinfo'=>$result]);
    }

    //删除会员
    public function memberdel(){
    	request()->isMethod('post')?true:exit;

    	$resule = MemberModel::with('articles','comments')->find(request('id'));
        foreach ($resule->articles as $vo) {
            $vo->delete();
        }
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

    //会员禁用或开启操作
    public function memberstatus(){
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
