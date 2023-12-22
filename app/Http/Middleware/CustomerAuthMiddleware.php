<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CustomerAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('customer')->check()) {
            // Khách hàng đã đăng nhập, cho phép tiếp tục xử lý request
            return $next($request);
        } else {
            // Chưa đăng nhập, lưu đường dẫn trước đó vào session
            session(['redirect_back' => $request->fullUrl()]);

            // Chuyển hướng về trang đăng nhập khách hàng
            return redirect()->route('show.customer.login');
        }
    }
}

