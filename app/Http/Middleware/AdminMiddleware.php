<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illiminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //未ログインならログインページへ
        if(!Auth::check()) {
            return redirect()->route('login');
        }

        //ログイン済かつadminユーザーならOK
        if(Auth::user()->role === 'admin' ){
            return $next($request);
        }

        //一般ユーザーならマイページへ
        return redirect()->route('user.mypage');

    }
}
