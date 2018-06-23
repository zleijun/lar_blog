<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class Comment extends Model
{
    use SoftDeletes;
	//此为填充,表示哪些数据可添加到数据可
	protected $fillable = ['content','article_id','member_id'];
	//时间戳化整型
	// protected $dateFormat = 'U';
	//表示这些字段存时间戳的
	protected $dates = ['created_at','updated_at','deleted_at'];

	/**
	 * 关联到发布人表
	 * @return [type] [description]
	 */
	public function members(){
		return $this->belongsTo('App\\Models\\Member','member_id','id');
	}

	/**
	 * 关联到文章表
	 * @return [type] [description]
	 */
	public function articles(){
		return $this->belongsTo('App\\Models\\Article','article_id','id');
	}

	/**
	 * 添加评论
	 * @param [type] $data [description]
	 */
	public function addComment($data){
    	$rule = [
    		'article_id'=>'bail|required',
    		'member_id'=>'bail|required',
    		'content'=>'required|max:100',
    	];

    	$msg = [
    		'article_id.required'=>'错误操作',
    		'content.required'=>'请填写内容',
    		'content.max'=>'评论过长',
    		'member_id.required'=>'错误操作',
    	];

    	$validator = Validator::make($data,$rule,$msg);
    	if($validator->fails()){
    		//验证失败
    		$data = ['code'=>0,'msg'=>$validator->errors()->first()];
    	}else{
	    	$result = $this->create($data);
	    	if($result){
    			$data = ['code'=>1];
	    	}else{
	    		$data = ['code'=>0,'msg'=>'请重试!'];
	    	}
    	}

		return $data;  
    }
}
