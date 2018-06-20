<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator;
class Cate extends Model
{
    use SoftDeletes;
	//此为填充,表示哪些数据可添加到数据可
	protected $fillable = ['catename','sort'];
	//时间戳化整型
	// protected $dateFormat = 'U';
	//表示这些字段存时间戳的
	protected $dates = ['created_at','updated_at','deleted_at'];

    /**
     * 关联文章表，当删除栏目时删除文章
     * @return [type] [description]
     */
    public function articles(){
        return $this->hasMany('App\\Models\\Article','cate_id','id');
    }

	//栏目添加处理
    public function register($data){
    	$rule = [
    		'catename'=>'bail|required|unique:cates|max:50',
    		'sort'=>'required|numeric|unique:cates',
    	];

    	$msg = [
    		'catename.required'=>'请填写栏目名称',
    		'catename.unique'=>'栏目已存在',
    		'catename.max'=>'账户过长',
    		'sort.required'=>'请填写昵称',
    		'sort.numeric'=>'序号必须是数字',
    		'sort.unique'=>'该序号已存在'
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

    //栏目信息修改
    public function editinfo($data){
    	// $rule = [
    	// 	'catename'=>'bail|required|unique:cates|max:50',
    	// 	'sort'=>'required|numeric',
    	// ];

    	$rule = [
    		'catename' => [
		        'required',
		        Rule::unique('cates')->ignore($data['id']),
		    ],
		    'sort'=>'required|numeric',
    	];

    	$msg = [
    		'catename.required'=>'请填写栏目名称',
    		'catename.unique'=>'账户已存在',
    		'catename.max'=>'账户过长',
    		'sort.required'=>'请填写昵称',
    		'sort.numeric'=>'序号必须是数字',
    	];
        $validator = Validator::make($data,$rule,$msg);
        if($validator->fails()){
            //验证失败
            $data = ['code'=>0,'msg'=>$validator->errors()->first()];
        }else{
            $cates = $this->find($data['id']);
            $cates->catename = $data['catename'];
            $cates->sort = $data['sort'];
            $result = $cates->save();
            if($result){
                $data = ['code'=>1,'msg'=>'修改成功!'];
            }else{
                $data = ['code'=>0,'msg'=>'修改失败,请重试!'];
            }
        }
        return $data;
    }

}
