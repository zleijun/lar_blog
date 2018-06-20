<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//默认页面
// Route::get('/', function () {
//     return view('welcome');
// });

//设置默认首页
Route::any('/','Admin\Index@login');

//后台分组 并且加 前缀amdin
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){

	//后台登录
	Route::match(['get','post'],'login_ins','Index@login');
	//管理员注册注册
	Route::match(['get','post'],'register','Index@userreg');
	//忘记密码
	Route::match(['get','post'],'forget','Index@forgets');
	//根据邮箱验证码重置密码
	Route::match(['get','post'],'updpwd','Index@updpwd');
	//后台退出
	Route::get('logOut', function () {
		session()->flush();
		return redirect('admin/login_ins');
	});

	//中间件 admin.login 验证用户是否登录，未登录则跳转到后台登录页
	Route::group(['middleware'=>'admin.check.login'],function(){
		//后台首页
		Route::match(['get','post'],'index','Home@index');
		//管理员列表
		Route::match(['get'],'adminlist','Admin@adminlist');
		//管理员添加
		Route::match(['get','post'],'addadmin','Admin@addadmin');
		//管理员编辑
		Route::match(['get','post'],'adminedit/{id?}','Admin@adminedit');
		//管理员删除
		Route::match(['post'],'admindel','Admin@admindel');
		//管理员禁用开启操作
		Route::match(['post'],'adminstatus','Admin@status');

		//会员列表
		Route::match(['get'],'memberlists','Member@mlists');
		//会员添加
		Route::match(['get','post'],'addmember','Member@addmember');
		//会员编辑
		Route::match(['get','post'],'memberedit/{id?}','Member@memberedit');
		//会员删除
		Route::match(['post'],'memberdel','Member@memberdel');
		//管理员禁用开启操作
		Route::match(['post'],'memberstatus','Member@memberstatus');

		//栏目列表
		Route::match(['get'],'coulmns','Coulmn@coulmns');
		//栏目添加
		Route::match(['get','post'],'addcoulmn','Coulmn@addcoulmn');
		//栏目修改
		Route::match(['get','post'],'cateedit/{id?}','Coulmn@cateedit');
		//栏目删除
		Route::match(['post'],'catedel','Coulmn@catedel');


		//栏目列表
		Route::match(['get'],'articles','Article@articles');
		//栏目添加
		Route::match(['get','post'],'addarticle','Article@addarticle');
		//栏目修改
		Route::match(['get','post'],'cateedit/{id?}','Article@articleedit');
		//栏目删除
		Route::match(['post'],'articledel','Article@articleel');
		//上下架修改
		Route::match(['post'],'articlestate','Article@artstatus');
		//是否推荐
		Route::match(['post'],'articletop','Article@articletop');

	});

	
});
