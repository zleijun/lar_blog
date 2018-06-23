<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cate;
use App\Models\System;
use App\Models\Article;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //前台导航
        $catalists = Cate::orderBy('sort')->get();
        //系统设置信息
        $systeminfo = System::first();
        //推荐文章
        $articleslist = Article::orderBy('created_at','desc')->where(['is_top'=>'1','status'=>'1'])->limit(5)->get();
        $viewDate = [
            'catalists'=>$catalists,
            'systeminfo'=>$systeminfo,
            'toparticles'=>$articleslist
        ];

        View::share($viewDate);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
