<?php

namespace App\Http\Controllers\FrontEnd;

use App\ChiTietPhieuXuat;
use App\Http\Controllers\Controller;
use App\LienHe;
use App\NguoiDung;
use App\PhieuXuat;
use App\SanPham;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TrangChuController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $sanpham_moi = SanPham::orderby('masanpham', 'desc')->get();
        $sanpham_cao = SanPham::orderby('giaban', 'desc')->get();
        $sanpham_thap = SanPham::orderby('giaban', 'asc')->get();
        $laptop = SanPham::whereNotNull('malaptop')->orderby('masanpham', 'desc')->get();
        $phukien = SanPham::whereNotNull('maphukien')->orderby('masanpham', 'desc')->get();

        return view('User.index', compact('sliders', 'sanpham_moi', 'sanpham_cao', 'sanpham_thap', 'laptop', 'phukien'));
    }

    public function TaiKhoan(Request $request)
    {
        if ($request->doiMatKhau || $request->doiThongTin) {
            $nguoidung = NguoiDung::find(Session::get('dangnhap')['manguoidung']);
            if ($request->doiThongTin) {
                $nguoidung->hoten = ucwords($request->hoTen);
                $nguoidung->sodienthoai = $request->soDienThoai;
                $nguoidung->diachi = $request->diaChi;
                $nguoidung->save();

                Session::put('dangnhap.hoten', $nguoidung->hoten);
                Session::put('dangnhap.sodienthoai', $nguoidung->sodienthoai);
                Session::put('dangnhap.diachi', $nguoidung->diachi);

                return redirect()->back()->with('alert', 'Thành công');
            } else {
                if ($nguoidung->password == md5($request->matKhauCu)) {
                    $validator = Validator::make($request->all(),
                        [
                            'nhapLaiMatKhauMoi' => 'same:matKhauMoi',
                        ],
                        [
                            'nhapLaiMatKhauMoi.same' => 'Nhập lại mật khẩu không khớp',
                        ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    } else {
                        $nguoidung->password = md5($request->matKhauMoi);
                        $nguoidung->save();

                        return redirect()->back()->with('alert', 'Thành công');
                    }
                } else {
                    return redirect()->back()->with('alert', 'Nhập mật khẩu cũ không chính xác');
                }
            }
        }

        $donhang = PhieuXuat::where('manguoidung', Session::get('dangnhap')['manguoidung'])->get();
        $tieude = 'Tài Khoản';
        return view('User.thongtintaikhoan', compact('tieude', 'donhang'));
    }

    public function ChiTietDH($id)
    {
        $chiTietDH = ChiTietPhieuXuat::where('madonhang', $id)->get();
        $thongTinDH = PhieuXuat::find($id);

        $tieude = 'Tài Khoản';
        return view('User.thongtintaikhoan', compact('tieude', 'chiTietDH', 'id', 'thongTinDH'));
    }

    public function LienHe(Request $request)
    {
        if ($request->guilienhe) {
            $lienhe = new LienHe();
            $lienhe->hoten = ucwords($request->hoten);
            $lienhe->sdt = $request->sdt;
            $lienhe->email = $request->email;
            $lienhe->noidung = $request->noidung;
            $lienhe->trangthai = 0;
            $lienhe->ngaytao = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
            $lienhe->save();

            return redirect()->back()->with('alert', 'Gửi thành công, sẽ có nhân viên liên hệ bạn trong 24h tới!');
        }
        $tieude = 'Liên Hệ';
        return view('User.lienhe', compact('tieude'));
    }

    public function XemNhanh()
    {
        $sanpham = SanPham::join('hangsanxuat as h', 'h.mahang', 'sanpham.mahang')->where('masanpham', request()->id)->first();
        $hinh = explode('|', $sanpham->j_hinh->hinh);
        $descSP = substr($sanpham->mota, 0, 45);
        $descSPLen = strlen($sanpham->mota) > 45 ? '...' : '';

        return response()->json([
            'sanpham' => $sanpham,
            'descSP' => $descSP,
            'descSPLen' => $descSPLen,
            'hinh' => $hinh,
        ]);

    }
}