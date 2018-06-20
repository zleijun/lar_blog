<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
}
