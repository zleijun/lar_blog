<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class Article extends Model
{
    use SoftDeletes;
	//此为填充,表示哪些数据可添加到数据可
	protected $fillable = ['title','tags','member_id','cate_id','desc','content','is_top','status'];
	//时间戳化整型
	// protected $dateFormat = 'U';
	//表示这些字段存时间戳的
	protected $dates = ['created_at','updated_at','deleted_at'];

	/**
	 * 关联文章发布者信息
	 * @return [type] [description]
	 */
	public function members(){
		return $this->belongsTo('App\\Models\\Member','member_id','id');
	}

	/**
	 * 关联文章所属栏目
	 * @return [type] [description]
	 */
	public function cates(){
		return $this->belongsTo('App\\Models\\Cate','cate_id','id');
	}

	//文章添加处理
    public function register($data){
    	$rule = [
    		'username'=>'bail|required|unique:admins|max:50',
    		'password'=>'required',
    		'nickname'=>'required',
    		'email'=>'bail|required|email|unique:admins|max:50',
    		'compassword'=>'required|same:password'
    	];

    	$msg = [
    		'username.required'=>'请填写账户',
    		'username.unique'=>'账户已存在',
    		'username.max'=>'账户过长',
    		'password.required'=>'请填写密码',
    		'nickname.required'=>'请填写昵称',
    		'email.required'=>'请填写邮箱',
            'email.email'=>'邮箱格式不正确',
    		'email.unique'=>'邮箱已存在',
    		'email.max'=>'邮箱过长',
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

    //文章信息修改
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
