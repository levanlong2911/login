<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUserVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::guard('web')->user()->email_verified){
            Auth::guard('web')->logout();
            return redirect()->route('user.login')->with('fail', 'Bạn cần xác nhận tài khoản đã đăng ký, chúng tôi đã gửi cho bạn một liên kết qua email của bạn để hoàn tất đăng ký.')->withInput();
        }
        return $next($request);
    }
}
