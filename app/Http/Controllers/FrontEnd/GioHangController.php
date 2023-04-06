<?php

namespace App\Http\Controllers\FrontEnd;

use App\GiamGia;
use App\Http\Controllers\Controller;
use App\SanPham;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GioHangController extends Controller
{
    public function DanhSachGH()
    {
        $tieude = 'Giỏ Hàng';
        return view('User.giohang', compact('tieude'));
    }

    public function ThemGH(Request $request)
    {
        $id = $request->id;

        if ($request->soluong == '') {
            $soluong = 1;
        } else {
            $soluong = $request->soluong;
        }
        $sanpham = SanPham::find($id);
        if ($sanpham->giaban > 0) {
            $hinh = explode('|', $sanpham->j_hinh->hinh);

            if ($sanpham->giakhuyenmai > 0) {
                $giatien = $sanpham->giakhuyenmai;
            } else {
                $giatien = $sanpham->giaban;
            }
            $data['id'] = $sanpham->masanpham;
            $data['qty'] = $soluong;
            $data['name'] = $sanpham->tensanpham;
            $data['price'] = $giatien;
            $data['weight'] = $sanpham->baohanh;
            $data['options']['image'] = $hinh[0];
            if ($sanpham->maquatang != null) {

                $masp = explode(',', $sanpham->j_quatang->masanpham);
                foreach ($masp as $msp) {
                    $gift[] = SanPham::find($msp);
                }
                $data['options']['gift'] = $gift;
            }
            Cart::add($data);

            $status = 200;
        } else {
            $status = 404;
        }
        // Cart::destroy();

        return response()->json([
            'status' => $status,
        ]);
    }

    public function CapNhatGH(Request $request)
    {
        Cart::update($request->rowid, $request->soluong);
    }

    public function XoaGH($id)
    {
        Cart::update($id, 0);
        // Cart::remove($id);
        if (Cart::content()->count() == 0) {
            Session::forget('coupon');
        }

        return redirect()->back();
    }

    public function ThemMGG(Request $request)
    {
        $magiamgia = $request->magiamgia;
        $ngayhientai = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if (Cart::content()->count() > 0) {
            $giamgia = GiamGia::where('magiamgia', $magiamgia)->first();
            if ($giamgia) {
                if ($ngayhientai >= $giamgia->ngaybatdau && $ngayhientai <= $giamgia->ngayketthuc) {
                    Session::put('giamgia', [
                        'id' => $giamgia->idgiamgia,
                        'magiamgia' => $giamgia->magiamgia,
                        'sotiengiam' => $giamgia->sotiengiam,
                    ]);
                    return redirect()->back()->with('alert', 'Thành công');
                } else {
                    return redirect()->back()->with('alert', 'Mã giảm giá đã hết hạn!');
                }
            } else {
                return redirect()->back()->with('alert', 'Mã giảm giá không tồn tại!');
            }
        } else {
            return redirect()->back()->with('alert', 'Vui lòng thêm sản phảm vào giỏ hàng');
        }
    }
}