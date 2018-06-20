<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment as CommentModel;

class Comment extends Controller
{
	/**
	 * 评论列表
	 * @return [type] [description]
	 */
    public function commentlists(){

       	$commentslists = CommentModel::with('members:id,username','articles:id,title')->orderBy('created_at','desc')->paginate(15);
    	$viewData = [
    		'commentslists'=>$commentslists
    	];

    	return view('admin.comment.commentlists',$viewData);
    }

    /**
     * 评论删除
     * @return [type] [description]
     */
    public function commentdel(){
    	request()->isMethod('post')?true:exit;

    	$resule = CommentModel::find(request('id'));
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
}
