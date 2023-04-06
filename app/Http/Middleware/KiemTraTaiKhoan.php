<?php

namespace App\Http\Middleware;

use App\NguoiDung;
use Closure;
use Illuminate\Support\Facades\Session;

class KiemTraTaiKhoan
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
        if (!Session::has('dangnhap')) {
            return redirect()->route('danhsachtk');
        } else {
            $check = NguoiDung::find(Session::get('dangnhap')['manguoidung']);
            if ($check->loainguoidung == 2) {
                return $next($request);
            } else {
                // return $next($request);
                return redirect()->back();
            }
        }
    }
}