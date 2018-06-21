<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class System extends Model
{
    use SoftDeletes;
	//此为填充,表示哪些数据可添加到数据可
	protected $fillable = ['webname','copyright'];
	//时间戳化整型
	// protected $dateFormat = 'U';
	//表示这些字段存时间戳的
	protected $dates = ['created_at','updated_at','deleted_at'];
	/**
	 * 系统信息修改
	 * @return [type] [description]
	 */
    public function editinfo($data){
    	$rule = [
    		'webname' =>'required|max:50',
		    'copyright'=>'required',
    	];

    	$msg = [
    		'webname.required'=>'请填写网站名称',
    		'webname.max'=>'网站名称过长',
    		'copyright.required'=>'网站版权必填'
    	];
        $validator = Validator::make($data,$rule,$msg);
        if($validator->fails()){
            //验证失败
            $data = ['code'=>0,'msg'=>$validator->errors()->first()];
        }else{
            $cates = $this->find($data['id']);
            $cates->webname = $data['webname'];
            $cates->copyright = $data['copyright'];
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
