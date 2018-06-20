<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
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
    		'title'=>'bail|required|unique:articles|max:50',
    		'tags'=>'required',
    		'member_id'=>'required',
    		'cate_id'=>'required',
            'desc'=>'required',
            'content'=>'required'
    	];

    	$msg = [
    		'title.required'=>'请填写标题',
            'title.unique'=>'标题已存在',
            'title.max'=>'标题过长',
    		'tags.unique'=>'请填写标签',
    		'member_id.required'=>'请选择发布人',
    		'cate_id.required'=>'请选择栏目',
            'desc.required'=>'请填写文章概要',
            'content.required'=>'请填写内容'
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
            // 'title'=>'bail|required|unique:articles|max:50',
            'title'=>[
                'bail','required','max:50',
                Rule::unique('articles')->ignore($data['id']),
            ],
            'tags'=>'required',
            'member_id'=>'required',
            'cate_id'=>'required',
            'desc'=>'required',
            'content'=>'required'
        ];

        $msg = [
            'title.required'=>'请填写标题',
            'title.unique'=>'标题已存在',
            'title.max'=>'标题过长',
            'tags.unique'=>'请填写标签',
            'member_id.required'=>'请选择发布人',
            'cate_id.required'=>'请选择栏目',
            'desc.required'=>'请填写文章概要',
            'content.required'=>'请填写内容'
        ];
        $validator = Validator::make($data,$rule,$msg);
        if($validator->fails()){
            //验证失败
            $data = ['code'=>0,'msg'=>$validator->errors()->first()];
        }else{
            $articlesModel = $this->find($data['id']);
            $articlesModel->title = $data['title'];
            $articlesModel->tags = $data['tags'];
            $articlesModel->member_id = $data['member_id'];
            $articlesModel->cate_id = $data['cate_id'];
            $articlesModel->desc = $data['desc'];
            $articlesModel->content = $data['content'];
            $result = $articlesModel->save();
            if($result){
                $data = ['code'=>1,'msg'=>'修改成功!'];
            }else{
                $data = ['code'=>0,'msg'=>'修改失败,请重试!'];
            }
        }
        return $data;
    }


}
