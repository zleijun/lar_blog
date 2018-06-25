<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use SoftDeletes;
	//此为填充,表示哪些数据可添加到数据可
	protected $fillable = ['username','password','nickname','email','deleted_at'];
	//时间戳化整型
	// protected $dateFormat = 'U';
	//表示这些字段存时间戳的
	protected $dates = ['created_at','updated_at','deleted_at'];

    /**
     * 管理员登录处理
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function login($data){
    	$rule = [
    		'username'=>'bail|required',
    		'password'=>'required'
    	];

    	$msg = [
    		'username.required'=>'请填写用户名',
    		'password.required'=>'请填写密码'
    	];

    	$validator = validator($data,$rule,$msg);
    	if($validator->fails()){
    		//验证失败
    		$data = ['code'=>0,'msg'=>$validator->errors()->first()];
    	}else{
    		//验证通过
	    	$result = $this->where($data)->first();
	    	if($result){
	    		if($result['status']){
	    			$sessionUser = [
	    				'id'=>$result['id'],
	    				'nickname'=>$result['nickname'],
	    				'is_super'=>$result['is_super'],
                        'email'=>$result['email']
	    			];
	    			session(['admin'=>$sessionUser]);

	    			$data = ['code'=>1];
	    		}else{
	    			$data = ['code'=>0,'msg'=>'账号被禁用'];
	    		}
	    	}else{
	    		$data = ['code'=>0,'msg'=>'用户名或者密码错误'];
	    	}
    	}

		return $data;    	
    }

    //管理员注册处理
    public function register($data){
    	$rule = [
    		'username'=>'bail|required|unique:admins|max:50',
    		'password'=>'required',
    		'nickname'=>'required',
    		'email'=>'bail|required|email|unique:admins|max:50',
    		'compassword'=>'required|same:password'
    	];

    	$msg = [
    		'username.required'=>'请填写用户名',
    		'username.unique'=>'用户名已存在',
    		'username.max'=>'用户名过长',
    		'password.required'=>'请填写密码',
    		'nickname.required'=>'请填写昵称',
    		'email.required'=>'请填写邮箱',
    		'email.unique'=>'邮箱已存在',
    		'email.max'=>'邮箱过长',
            'email.email'=>'邮箱格式不正确',
    		'compassword.required'=>'请填写确认密码',
    		'compassword.same'=>'两次密码不相同'
    	];

    	$validator = Validator::make($data,$rule,$msg);
    	if($validator->fails()){
    		//验证失败
    		$data = ['code'=>0,'msg'=>$validator->errors()->first()];
    	}else{
	    	//返回添加数据相应ID
	    	// unset($data['compassword']);
	    	// $result = $this->insertGetId($data);
	    	$result = $this->create($data);
	    	if($result){
    			$data = ['code'=>1];
	    	}else{
	    		$data = ['code'=>0,'msg'=>'请重试!'];
	    	}
    	}

		return $data;  
    }

    //发送邮箱验证码
    public function sendEmailCode($data){
        $rule = [
            'email'=>'bail|required|email|exists:admins'
        ];

        $msg = [
            'email.required'=>'请填写邮箱',
            'email.email'=>'邮箱格式不正确',
            'email.exists'=>'邮箱不存在!'
        ];

        $validator = Validator::make($data,$rule,$msg);

        if($validator->fails()){
            //验证失败
            $data = ['code'=>0,'msg'=>$validator->errors()->first()];
        }else{
            $code = mt_rand(100000,999999);
            $contend = '您的验证码是：'.$code;
            $title = 'laravel邮箱验证码练习';
            $result = phpEmail($data['email'],$contend,$title);
            if($result){
                session(['code'=>$code,'email'=>$data['email']]);
                $data = ['code'=>1];
            }else{
                $data = ['code'=>0,'msg'=>'请重试!'];
            }
        }
        return $data;
    }

    //验证邮箱验证码,并修改密码
    public function updatePwds($data){
        $rule = [
            'codes'=>'bail|required',
            'password'=>'required',
            'compassword'=>'required|same:password'
        ];
        $msg = [
            'codes.required'=>'请填写验证码',
            'password.required'=>'请填写密码',
            'compassword.required'=>'请填写确认密码',
            'compassword.same'=>'两次密码不相同'
        ];
        $validator = Validator::make($data,$rule,$msg);
        if($validator->fails()){
            //验证失败
            $data = ['code'=>0,'msg'=>$validator->errors()->first()];
        }else{
            if($data['codes'] == session('code')){
                $result = $this->where(['email'=>session('email')])->update(['password'=>$data['password']]);
                if($result){
                    request()->session()->flush();
                    $data = ['code'=>1,'msg'=>'重置成功!'];
                }else{
                    $data = ['code'=>0,'msg'=>'重置失败,请重试!'];
                }
            }else{
                $data = ['code'=>0,'msg'=>'验证码不正确！'];
            }
        }
        return $data;
    }

    //管理员信息修改
    public function editinfo($data){
        $rule = [
            'id'=>'required',
            'password'=>'required',
            'nickname'=>'required',
            'oldpwd'=>'required'
        ];

        $msg = [
            'id.required'=>'错误操作',
            'password.required'=>'请填写新密码',
            'nickname.required'=>'请填写昵称',
            'oldpwd.required'=>'请填写旧密码',
        ];
        $validator = Validator::make($data,$rule,$msg);
        if($validator->fails()){
            //验证失败
            $data = ['code'=>0,'msg'=>$validator->errors()->first()];
        }else{
            $userinfo = $this->find($data['id']);
            if($userinfo['password'] == $data['oldpwd']){
                $userinfo->password = $data['password'];
                $userinfo->nickname = $data['nickname'];
                $result = $userinfo->save();
                if($result){
                    $data = ['code'=>1,'msg'=>'修改成功!'];
                }else{
                    $data = ['code'=>0,'msg'=>'修改失败,请重试!'];
                }
            }else{
                $data = ['code'=>0,'msg'=>'原密码错误,请重新输入!'];
            }
        }
        return $data;
    }
}
