<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class KiemTraDangNhap
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
        if (Session::has('dangnhap')) {

            return redirect()->route('trangchu.index');

        }
        return $next($request);
    }
}