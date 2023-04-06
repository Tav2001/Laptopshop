<?php

namespace App\Http\Controllers\BackEnd;

use App\ChiTietPhieuXuat;
use App\Http\Controllers\Controller;
use App\NguoiDung;
use App\PhieuXuat;
use App\SanPham;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieude = 'Đơn Hàng';
        $donhang = PhieuXuat::orderby('madonhang', 'desc')->get();
        return view('Admin.donhang', compact('tieude', 'donhang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tieude = 'Thêm Đơn Hàng';
        $nguoidung = NguoiDung::orderby('manguoidung', 'desc')->get();
        $sanpham = SanPham::orderby('masanpham', 'desc')->get();
        return view('Admin.donhang_hanhdong', compact('tieude', 'nguoidung', 'sanpham'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $manguoidung = explode('|', $request->thongTinNguoiDung);

        $donhang = new PhieuXuat();
        if (isset($request->thongTinNguoiNhanKhac)) {

            $donhang->hotennguoinhan = $request->hoTenNguoiNhan;
            $donhang->sodienthoainguoinhan = $request->soDienThoaiNguoiNhan;
            $donhang->diachinguoinhan = $request->diaChiNguoiNhan;

        } else {
            $nguoidung = NguoiDung::find(trim($manguoidung[0], 'ND'));

            $donhang->hotennguoinhan = $nguoidung->hoten;
            $donhang->sodienthoainguoinhan = $nguoidung->sodienthoai;
            $donhang->diachinguoinhan = $nguoidung->diachi;
        }

        $donhang->manguoidung = trim($manguoidung[0], 'ND');
        $donhang->magiamgia = null;
        $donhang->ghichu = $request->ghiChu;
        $donhang->tongtien = $request->tongTien;
        $donhang->tinhtranggiaohang = $request->tinhTrangGiaoHang;
        $donhang->hinhthucthanhtoan = $request->hinhThucThanhToan;
        $donhang->congno = ($request->tongTien) - floatval(preg_replace('/[^\d.]/', '', $request->daThanhToan));
        $donhang->ngaytao = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $donhang->save();

        foreach ($request->chiTietDonhang as $key => $ch) {
            $masanpham = explode('|', $ch);

            $chitiet = new ChiTietPhieuXuat();
            $chitiet->madonhang = $donhang->madonhang;
            $chitiet->masanpham = trim($masanpham[0], 'SP');
            $chitiet->baohanh = $request->baoHanh[$key];
            $chitiet->soluong = $request->soLuong[$key];
            $chitiet->dongia = floatval(preg_replace('/[^\d.]/', '', $request->donGia[$key]));
            $chitiet->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (request()->ajax()) {
            $donhang = PhieuXuat::findOrfail($id);
            if ($donhang) {
                return response()->json([
                    'status' => 200,
                    'data' => $donhang,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                ]);
            }
        }
        $loai = 'DH';
        $tieude = 'THANH TOÁN';
        $tieude1 = 'thanh toán';
        $phieupdf = PhieuXuat::find($id);
        $chitietphieu = ChiTietPhieuXuat::where('madonhang', $id)->get();
        $pdf = Pdf::loadView('Admin.pdf', compact('loai', 'tieude', 'tieude1', 'phieupdf', 'chitietphieu'));
        return $pdf->stream('DH' . $phieupdf->madonhang . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Session::put('donhang_session', $id);
        $tieude = 'Chi Tiết Đơn Hàng';
        $nguoidung = NguoiDung::orderby('manguoidung', 'desc')->get();
        $sanpham = SanPham::orderby('masanpham', 'desc')->get();

        $donhang = PhieuXuat::find($id);
        $chitietdonhang = ChiTietPhieuXuat::where('madonhang', $id)->get();

        return view('Admin.donhang_hanhdong', compact('tieude', 'nguoidung', 'sanpham', 'donhang', 'chitietdonhang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $manguoidung = explode('|', $request->thongTinNguoiDung);

        $donhang = PhieuXuat::find($id);
        if (isset($request->thongTinNguoiNhanKhac)) {

            $donhang->hotennguoinhan = $request->hoTenNguoiNhan;
            $donhang->sodienthoainguoinhan = $request->soDienThoaiNguoiNhan;
            $donhang->diachinguoinhan = $request->diaChiNguoiNhan;

        } else {
            $nguoidung = NguoiDung::find(trim($manguoidung[0], 'ND'));

            $donhang->hotennguoinhan = $nguoidung->hoten;
            $donhang->sodienthoainguoinhan = $nguoidung->sodienthoai;
            $donhang->diachinguoinhan = $nguoidung->diachi;
        }

        $donhang->manguoidung = trim($manguoidung[0], 'ND');
        $donhang->magiamgia = null;
        $donhang->ghichu = $request->ghiChu;
        $donhang->tongtien = $request->tongTien;
        $donhang->tinhtranggiaohang = $request->tinhTrangGiaoHang;
        $donhang->hinhthucthanhtoan = $request->hinhThucThanhToan;
        $donhang->congno = ($request->tongTien) - floatval(preg_replace('/[^\d.]/', '', $request->daThanhToan));
        $donhang->ngaytao = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $donhang->save();

        $chitietdonhang = ChiTietPhieuXuat::where('madonhang', $id)->get();
        foreach ($chitietdonhang as $ct) {
            $ct->delete();
        }

        foreach ($request->chiTietDonhang as $key => $ch) {
            $masanpham = explode('|', $ch);

            $chitiet = new ChiTietPhieuXuat();
            $chitiet->madonhang = $donhang->madonhang;
            $chitiet->masanpham = trim($masanpham[0], 'SP');
            $chitiet->baohanh = $request->baoHanh[$key];
            $chitiet->soluong = $request->soLuong[$key];
            $chitiet->dongia = floatval(preg_replace('/[^\d.]/', '', $request->donGia[$key]));
            $chitiet->save();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            $donhang = PhieuXuat::findOrfail($id);
            if ($donhang) {
                $donhang->delete();

                return response()->json([
                    'status' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                ]);
            }
        }
    }
}