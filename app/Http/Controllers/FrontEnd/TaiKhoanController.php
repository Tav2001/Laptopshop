<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\NguoiDung;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TaiKhoanController extends Controller
{
    public function DanhSachTK()
    {
        $tieude = 'Đăng nhập - Đăng ký';
        return view('User.dangkydangnhap', compact('tieude'));
    }

    public function DangNhap(Request $request)
    {
        $kiemtra = NguoiDung::where([['email', $request->email_dn], ['password', md5($request->matkhau_dn)]])->first();
        if ($kiemtra) {
            if ($kiemtra->trangthai == 1) {

                return redirect()->back()->with('alert', 'Tài khoản bạn đã bị khóa');
            } else {
                Session::put('dangnhap', [
                    'manguoidung' => $kiemtra->manguoidung,
                    'hoten' => $kiemtra->hoten,
                    'sodienthoai' => $kiemtra->sodienthoai,
                    'diachi' => $kiemtra->diachi,
                    'loainguoidung' => $kiemtra->loainguoidung,
                    'email' => $kiemtra->email,
                ]);
                if ($kiemtra->loainguoidung == 2) {

                    return redirect()->route('tongquan.index');
                } else {
                    return redirect()->route('trangchu.index');
                }
            }
        } else {
            return redirect()->back()->withErrors('Tên đăng nhập hoặc mật khẩu không đúng!')->withInput();
        }
    }

    public function DangKy(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email_dk' => 'unique:nguoidung,email',
                'sdt_dk' => 'unique:nguoidung,sodienthoai',
                'nhaplaimatkhau_dk' => 'required|same:matkhau_dk',
            ],
            [
                'email.unique' => 'Email đã được sử dụng',
                'sdt_dk.unique' => 'Số điện thoại đã được sử dụng',
                'nhaplaimatkhau_dk.same' => 'Nhập lại mật khẩu không khớp',
            ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $nguoidung = new NguoiDung();
            $nguoidung->hoten = ucwords($request->hoten_dk);
            $nguoidung->sodienthoai = $request->sdt_dk;
            $nguoidung->trangthai = 0;
            $nguoidung->loainguoidung = 0;
            $nguoidung->email = $request->email_dk;
            $nguoidung->password = md5($request->matkhau_dk);
            $nguoidung->ngaytao = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
            $nguoidung->save();

            Session::put('dangnhap', [
                'manguoidung' => $nguoidung->manguoidung,
                'hoten' => $nguoidung->hoten,
                'sodienthoai' => $nguoidung->sodienthoai,
                'diachi' => $nguoidung->diachi,
                'loainguoidung' => $nguoidung->loainguoidung,
                'email' => $nguoidung->email,
            ]);

            return redirect()->route('trangchu.index');
        }
    }

    public function DangXuat()
    {
        // Session::flush();
        Session::forget('dangnhap');
        Session::forget('giamgia');

        return redirect()->route('danhsachtk');
    }
}