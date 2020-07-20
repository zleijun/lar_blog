<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\helpers;
use App\Http\Controllers\Controller;
class Index extends Controller
{
    /**
     * 用户登录
     * @return array|\Illuminate\Contracts\View\Factory|RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login(){
    	if(request()->isMethod('post')){

    		//接收方式一
    		// $data = request()->only('username','password');
    		//接收方式二
    		$data = [
    			'username'=>request('username'),
    			'password'=>request('password')
    		];
    		$adminModel = new Admin();
    		$resule = $adminModel->login($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'登录成功',
    				'url'=>url('admin/index'),
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

        //如果已经登录了则跳转
        if(session()->has('admin')){
            return redirect('admin/index');
        }

    	return view('admin.index.login');
    }

    /**
     * 管理员注册
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userreg(){

    	if(request()->isMethod('post')){
    		$data = request()->only('username','password','nickname','email','compassword');
    		$adminModel = new Admin();
    		$resule = $adminModel->register($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'注册成功',
    				'url'=>url('admin/login_ins'),
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

    	return view('admin.index.userreg');
    }

    //忘记密码
    public function forgets(){

        if(request()->isMethod('post')){
            //获取验证码
            $data = request()->only('email');
            $resule = (new Admin)->sendEmailCode($data);
            if($resule['code']){
                $msg = [
                    'code'=>1,
                    'msg'=>'发送成功'
                ];
            }else{
                $msg = [
                    'code'=>0,
                    'msg'=>$resule['msg']
                ];
            }

            return $msg;
        }
    	return view('admin.index.forgets');
    }

    //根据邮箱验证码重置密码
    public function updpwd(){
        if(request()->isMethod('post')){
            $data = request()->only(['codes','password','compassword']);
            $resule = (new Admin)->updatePwds($data);
            if($resule['code']){
                $msg = [
                    'code'=>1,
                    'msg'=>'发送成功',
                    'url'=>url('admin/login_ins')
                ];
            }else{
                $msg = [
                    'code'=>0,
                    'msg'=>$resule['msg']
                ];
            }

            return $msg;
        }
    }
}
