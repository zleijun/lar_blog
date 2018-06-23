<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cate;
use App\Models\System;
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

        $viewDate = [
            'catalists'=>$catalists,
            'systeminfo'=>$systeminfo
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
