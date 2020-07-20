<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Cate;
use App\Models\Member;
use App\Models\Comment;
use DB;
class Index extends Controller
{
	/**
	 * 前台首页
	 * @return [type] [description]
	 */
    public function index(){
    	$where['status'] = '1';
    	$catename = [];
    	if(request('id') ){
    		$where['cate_id'] = request('id');
    		$catename = Cate::where(['id'=>request('id')])->value('catename');
    	}

    	//文章列表
    	$articleslist = Article::with('members:id,nickname')
                        ->orderBy('created_at','desc')
                        ->where($where)->paginate(10);
    	$viewData = [
    		'articlesl'=>$articleslist,
    		'catename'=>$catename
    	];

    	return view('home.index.index',$viewData);
    }

    /**
     * 文章详情
     * @return [type] [description]
     */
    public function artinfo(){
        $id = request('id');
        //自增
        Article::where(['id'=>$id])->increment('click');
        
    	$articlesinfos = Article::with('members:id,nickname','comments')->find($id);

    	$viewData = [
    		'articlesinfos'=>$articlesinfos,
    	];

    	return view('home.index.artinfo',$viewData);
    }

    /**
     * 用户注册
     * @return [type] [description]
     */
    public function userregister(){
    	if(request()->isMethod('post')){
    		$data = request()->only('username','password','nickname','email','compassword','verify');
    		$MemberModel = new Member();
    		$resule = $MemberModel->register($data);
    		if($resule['code']){
    			$msg = [
    				'code'=>1,
    				'msg'=>'注册成功',
    				'url'=>url('user_logins'),
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

    	return view('home.index.userregister');
    }

    /**
     * 用户登录
     * @return [type] [description]
     */
    public function user_logins(){
        if(request()->isMethod('post')){
            $data = [
                'username'=>request('username'),
                'password'=>request('password'),
                'verify'=>request('verify')
            ];
            $MemberModel = new Member();
            $resule = $MemberModel->login($data);
            if($resule['code']){
                $msg = [
                    'code'=>1,
                    'msg'=>'登录成功',
                    'url'=>url('index'),
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
        if(session()->has('home')){
            return redirect('index');
        }
    	return view('home.index.logins');
    }

    /**
     * 文章添加评论
     * @return [type] [description]
     */
    public function addcomments(){
        if(request()->isMethod('post')){
            $data = [
                'article_id'=>request('article_id'),
                'member_id'=>request('member_id'),
                'content'=>request('content'),
            ];
            $CommentModel = new Comment();
            $resule = $CommentModel->addComment($data);
            if($resule['code']){

                Article::where(['id'=>$data['article_id']])->increment('comm_num');
                $msg = [
                    'code'=>1,
                    'msg'=>'操作成功'
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

    /**
     * 导航上的搜索
     * @return [type] [description]
     */
    public function searchs(){
        $searchs = request('search');
        $where['status'] = '1';
        //文章列表
        $articleslist = Article::with('members:id,nickname')->orderBy('created_at','desc')->where($where)->where('title','like','%'.$searchs.'%')->paginate(10);
        
        $viewData = [
            'articlesl'=>$articleslist,
            'searchs'=>$searchs
        ];

        return view('home.index.searchs',$viewData);
    }
}
