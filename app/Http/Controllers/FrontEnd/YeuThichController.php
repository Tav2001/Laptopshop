<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class YeuThichController extends Controller
{
    public function DanhSachYeuThich(Request $request)
    {
        $tieude = 'Yêu Thích';
        return view('User.yeuthich', compact('tieude'));
    }

    public function ThemYeuThich(Request $request)
    {
        $action = 'add';
        $sanpham = SanPham::find($request->id);
        $hinh = explode('|', $sanpham->j_hinh->hinh);
        if (!Session::has('yeuthich')) {
            $yeuthich[$request->id] = [
                'masanpham' => $request->id,
                'tensanpham' => $sanpham->tensanpham,
                'giasanpham' => $sanpham->giakhuyenmai > 0 ? $sanpham->giakhuyenmai : $sanpham->giaban,
                'hinh' => $hinh[0],
            ];
        } else {
            $yeuthich = Session::get('yeuthich');
            if (array_key_exists($request->id, $yeuthich)) {
                $action = 'del';
                unset($yeuthich[$request->id]);
            } else {
                $yeuthich[$request->id] = [
                    'masanpham' => $request->id,
                    'tensanpham' => $sanpham->tensanpham,
                    'giasanpham' => $sanpham->giakhuyenmai > 0 ? $sanpham->giakhuyenmai : $sanpham->giaban,
                    'hinh' => $hinh[0],
                ];
            }
        }

        Session::put('yeuthich', $yeuthich);

        return response()->json([
            'action' => $action,
        ]);
    }
}