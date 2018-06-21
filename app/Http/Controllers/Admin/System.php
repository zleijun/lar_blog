<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\System as SystemModel;
class System extends Controller
{
	/**
	 * 系统设置查看
	 * @return [type] [description]
	 */
    public function systeminfo(){

    	if(request()->isMethod('post')){
    		$data = request()->only('id','webname','copyright');
    		$SystemModel = new SystemModel();
    		$resule = $SystemModel->editinfo($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'修改成功',
    				'url'=>url('admin/systeminfo'),
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

    	$systeminfo = SystemModel::first();
    	$viewData = [
    		'systeminfo'=>$systeminfo
    	];

    	return view('admin.system.systeminfo',$viewData);
    }
}
