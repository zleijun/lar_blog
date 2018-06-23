<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //若未登录 则跳转到登录页
        if(!session()->has('admin')){
            return redirect('admin/login_ins');
        }
        return $next($request);
    }
}
