<?php

namespace App\Http\Controllers\BackEnd;

use App\ChiTietPhieuNhap;
use App\Http\Controllers\Controller;
use App\NguoiDung;
use App\NSX;
use App\PhieuNhap;
use App\SanPham;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PhieuNhapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieude = 'Phiếu Nhập';
        $phieunhap = PhieuNhap::orderby('maphieunhap', 'desc')->get();

        return view('Admin.phieunhap', compact('tieude', 'phieunhap'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tieude = 'Thêm Phiếu Nhập';
        $nguoidung = NguoiDung::orderby('manguoidung', 'desc')->get();
        $sanpham = SanPham::orderby('masanpham', 'desc')->get();
        $hangnsx_lap = NSX::where('loaihang', 0)->orderby('mahang', 'desc')->get();
        $hangnsx = NSX::where('loaihang', 1)->orderby('mahang', 'desc')->get();
        $phukien = SanPham::whereNotNull('maphukien')->orderby('masanpham', 'desc')->get();

        return view('Admin.phieunhap_hanhdong', compact('tieude', 'nguoidung', 'sanpham', 'hangnsx', 'phukien', 'hangnsx_lap'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nguoidung = explode('|', $request->thongTinNguoiDung);

        $phieunhap = new PhieuNhap();
        $phieunhap->manguoidung = trim($nguoidung[0], 'ND');
        $phieunhap->ghichu = $request->ghiChu;
        $phieunhap->tongtien = $request->tongTien;
        $phieunhap->congno = ($request->tongTien) - floatval(preg_replace('/[^\d.]/', '', $request->daThanhToan));
        $phieunhap->ngaytao = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $phieunhap->save();

        foreach ($request->chiTietPhieuNhap as $key => $ch) {
            $masanpham = explode('|', $ch);

            $chitiet = new ChiTietPhieuNhap();
            $chitiet->maphieunhap = $phieunhap->maphieunhap;
            $chitiet->masanpham = trim($masanpham[0], 'SP');
            $chitiet->soluong = $request->soLuong[$key];
            $chitiet->dongia = floatval(preg_replace('/[^\d.]/', '', $request->donGia[$key]));
            $chitiet->save();

            $sanpham = SanPham::find(trim($masanpham[0], 'SP'));
            $sanpham->soluong = $request->soLuong[$key];
            $sanpham->gianhap = floatval(preg_replace('/[^\d.]/', '', $request->donGia[$key]));
            $sanpham->save();
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
            $phieunhap = PhieuNhap::findOrfail($id);
            if ($phieunhap) {
                return response()->json([
                    'status' => 200,
                    'data' => $phieunhap,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                ]);
            }
        }

        $loai = 'PN';
        $tieude = 'NHẬP HÀNG';
        $tieude1 = 'phiếu nhập';
        $phieupdf = PhieuNhap::find($id);
        $chitietphieu = ChiTietPhieuNhap::where('maphieunhap', $id)->get();
        $pdf = Pdf::loadView('Admin.pdf', compact('loai', 'tieude', 'tieude1', 'phieupdf', 'chitietphieu'));
        return $pdf->stream('PN' . $phieupdf->maphieunhap . '.pdf');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Session::put('phieunhap_session', $id);
        $tieude = 'Chi Tiết Phiếu Nhập';
        $nguoidung = NguoiDung::orderby('manguoidung', 'desc')->get();
        $sanpham = SanPham::orderby('masanpham', 'desc')->get();

        $phieunhap = PhieuNhap::find($id);
        $chitietphieunhap = ChiTietPhieuNhap::where('maphieunhap', $id)->get();

        $hangnsx_lap = NSX::where('loaihang', 0)->orderby('mahang', 'desc')->get();
        $hangnsx = NSX::where('loaihang', 1)->orderby('mahang', 'desc')->get();
        $phukien = SanPham::whereNotNull('maphukien')->orderby('masanpham', 'desc')->get();

        return view('Admin.phieunhap_hanhdong', compact('tieude', 'nguoidung', 'sanpham', 'phieunhap', 'chitietphieunhap', 'hangnsx_lap', 'hangnsx', 'phukien'));
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
        $nguoidung = explode('|', $request->thongTinNguoiDung);

        $phieunhap = PhieuNhap::find($id);
        $phieunhap->manguoidung = trim($nguoidung[0], 'ND');
        $phieunhap->ghichu = $request->ghiChu;
        $phieunhap->tongtien = $request->tongTien;
        $phieunhap->congno = ($request->tongTien) - floatval(preg_replace('/[^\d.]/', '', $request->daThanhToan));
        $phieunhap->save();

        $chitietphieunhap = ChiTietPhieuNhap::where('maphieunhap', $id)->get();
        foreach ($chitietphieunhap as $ct) {
            $ct->j_chitietphieu_sp->soluong = 0;
            $ct->j_chitietphieu_sp->gianhap = 0;
            $ct->j_chitietphieu_sp->save();

            $ct->delete();
        }
        foreach ($request->chiTietPhieuNhap as $key => $ch) {
            $masanpham = explode('|', $ch);

            $chitiet = new ChiTietPhieuNhap();
            $chitiet->maphieunhap = $phieunhap->maphieunhap;
            $chitiet->masanpham = trim($masanpham[0], 'SP');
            $chitiet->soluong = $request->soLuong[$key];
            $chitiet->dongia = floatval(preg_replace('/[^\d.]/', '', $request->donGia[$key]));
            $chitiet->save();

            $sanpham = SanPham::find(trim($masanpham[0], 'SP'));
            $sanpham->soluong = $request->soLuong[$key];
            $sanpham->gianhap = floatval(preg_replace('/[^\d.]/', '', $request->donGia[$key]));
            $sanpham->save();
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
            $phieunhap = PhieuNhap::findOrfail($id);
            if ($phieunhap) {
                $phieunhap->delete();

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