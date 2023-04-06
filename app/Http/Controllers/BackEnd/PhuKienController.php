<?php

namespace App\Http\Controllers\BackEnd;

use App\Hinh;
use App\Http\Controllers\Controller;
use App\NSX;
use App\PhuKien;
use App\QuaTang;
use App\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PhuKienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieude = 'Phụ Kiện';
        $sanpham = SanPham::where('loaisanpham', 1)->orderby('masanpham', 'desc')->get();
        $hangnsx = NSX::where('loaihang', 1)->orderby('mahang', 'desc')->get();
        $phukien = PhuKien::orderby('maphukien', 'desc')->get();
        return view('Admin.phukien', compact('tieude', 'sanpham', 'hangnsx', 'phukien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $giaban = floatval(preg_replace('/[^\d.]/', '', request()->giaBan));
        $giakhuyenmai = floatval(preg_replace('/[^\d.]/', '', request()->giaKhuyenMai));

        $sanham = SanPham::findOrfail(request()->masanpham);
        if ($sanham) {
            $sanham->giaban = $giaban;
            $sanham->giakhuyenmai = request()->checked == 0 ? $giakhuyenmai : 0;
            $sanham->save();

            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Không Tìm Thấy Sản Phẩm',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phukien = new PhuKien();
        $phukien->tenphukien = $request->tenSanPham;
        $phukien->loaiphukien = $request->tenLoaiPhuKien;
        $phukien->save();

        if ($request->quaTang) {
            $quatang = new QuaTang();
            $quatang->tensanpham = $request->tenSanPham;
            $quatang->masanpham = $request->quaTang;
            $quatang->save();
        }

        $hinh = new Hinh();
        $hinh->tensanpham = $request->tenSanPham;
        $req_hinh = $request->file('hinhSanPham');
        if ($req_hinh) {
            $arr = [];
            foreach ($req_hinh as $anh) {
                $tenanh = uniqid() . '_' . time() . '.' . $anh->getClientOriginalExtension();

                $doikichthuoc = Image::make($anh->getRealPath());
                $doikichthuoc->resize(300, 300);
                $doikichthuoc->save(public_path('uploads/sanpham/' . $tenanh));
                $arr[] = $tenanh;
            }
            $hinh->hinh = implode("|", $arr);
        }
        $hinh->save();

        $sanpham = new SanPham();
        $sanpham->tensanpham = $request->tenSanPham;
        $sanpham->baohanh = $request->baoHanh;
        $sanpham->mota = $request->moTa;
        $sanpham->soluong = 0;
        $sanpham->gianhap = 0;
        $sanpham->giaban = 0;
        $sanpham->giakhuyenmai = 0;
        $sanpham->mathuvienhinh = $hinh->mathuvienhinh;
        $sanpham->mahang = $request->hangSanXuat;
        $sanpham->maquatang = isset($quatang) ? $quatang->maquatang : null;
        $sanpham->malaptop = null;
        $sanpham->maphukien = $phukien->maphukien;
        $sanpham->loaisanpham = 1;
        $sanpham->ngaytao = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $sanpham->save();

        return response()->json([
            'status' => 200,
            'message' => 'Add Successfully',
        ]);
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
            $sanpham = SanPham::findOrfail($id);
            if ($sanpham) {
                return response()->json([
                    'status' => 200,
                    'data' => $sanpham,
                    'phukien' => $sanpham->j_phukien,
                    'quatang' => isset($sanpham->j_quatang) ? explode(',', $sanpham->j_quatang->masanpham) : '',
                    'hinhanh' => explode('|', $sanpham->j_hinh->hinh),
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                ]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $sanpham = SanPham::findOrfail($id);

        $phukien = PhuKien::find($sanpham->maphukien);
        $phukien->tenphukien = $request->tenSanPham;
        $phukien->loaiphukien = $request->tenLoaiPhuKien;
        $phukien->save();

        $quatang = QuaTang::find($sanpham->maquatang);
        if ($request->quaTang) {
            $quatang->tensanpham = $request->tenSanPham;
            $quatang->masanpham = $request->quaTang;
            $quatang->save();
        } else {
            if (isset($quatang)) {

                $quatang->delete();
            }
        }

        $hinh = Hinh::find($sanpham->mathuvienhinh);
        $hinh->tensanpham = $request->tenSanPham;
        $req_hinh = $request->file('hinhSanPham');
        if ($req_hinh) {
            $anh = explode("|", $hinh->hinh);

            for ($i = 0; $i < count($anh); $i++) {
                if (File::exists(public_path('uploads/sanpham/') . $anh[$i])) {
                    unlink(public_path('uploads/sanpham/') . $anh[$i]);
                }
            }
            $arr = [];
            foreach ($req_hinh as $anh) {
                $tenanh = uniqid() . '_' . time() . '.' . $anh->getClientOriginalExtension();

                $doikichthuoc = Image::make($anh->getRealPath());
                $doikichthuoc->resize(300, 300);
                $doikichthuoc->save(public_path('uploads/sanpham/' . $tenanh));
                $arr[] = $tenanh;
            }
            $hinh->hinh = implode("|", $arr);
        }
        $hinh->save();

        $sanpham->tensanpham = $request->tenSanPham;
        $sanpham->baohanh = $request->baoHanh;
        $sanpham->mota = $request->moTa;
        $sanpham->soluong = 0;
        $sanpham->gianhap = 0;
        $sanpham->giaban = 0;
        $sanpham->giakhuyenmai = 0;
        $sanpham->mathuvienhinh = $hinh->mathuvienhinh;
        $sanpham->mahang = $request->hangSanXuat;
        $sanpham->maquatang = isset($quatang) ? $quatang->maquatang : null;
        $sanpham->malaptop = null;
        $sanpham->maphukien = $phukien->maphukien;
        $sanpham->loaisanpham = 1;
        $sanpham->save();

        return response()->json([
            'status' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sanpham = SanPham::findOrfail($id);
        if ($sanpham) {
            $sanpham->j_phukien->delete();
            $sanpham->j_quatang->delete();
            $hinh = explode("|", $sanpham->j_hinh->hinh);

            for ($i = 0; $i < count($hinh); $i++) {
                if (File::exists(public_path('uploads/sanpham/') . $hinh[$i])) {
                    unlink(public_path('uploads/sanpham/') . $hinh[$i]);
                }
            }
            $sanpham->j_hinh->delete();
            $sanpham->delete();

            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Không Tìm Thấy Sản Phẩm',
            ]);
        }
    }
}