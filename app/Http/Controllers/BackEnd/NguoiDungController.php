<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\NguoiDung;
use App\PhieuXuat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NguoiDungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieude = 'Người Dùng';
        $nguoidung = NguoiDung::orderby('manguoidung', 'desc')->get();
        return view('Admin.nguoidung', compact('tieude', 'nguoidung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nguoidung = new NguoiDung();
        $nguoidung->hoten = ucwords($request->hoTen);
        $nguoidung->sodienthoai = $request->soDienThoai;
        $nguoidung->diachi = $request->diaChi;
        $nguoidung->trangthai = 0;
        $nguoidung->loainguoidung = $request->loaiNguoiDung;
        $nguoidung->email = isset($request->email) ? $request->email : null;
        $nguoidung->password = isset($request->matKhau) ? md5($request->matKhau) : null;
        $nguoidung->ngaytao = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $nguoidung->save();

        return response()->json([
            'status' => 200,
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
        $nguoidung = NguoiDung::findOrfail($id);
        if ($nguoidung) {

            return response()->json([
                'status' => 200,
                'data' => $nguoidung,
            ]);
        } else {
            return response()->json([
                'status' => 404,
            ]);
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
        $nguoidung = NguoiDung::findOrfail($id);
        if ($nguoidung) {
            $phieuxuat = PhieuXuat::where('manguoidung', $nguoidung->manguoidung)->get();
            if ($nguoidung->trangthai == 0) {
                $nguoidung->trangthai = 1;
                if ($phieuxuat) {
                    foreach ($phieuxuat as $px) {
                        $px->tinhtranggiaohang = 2;
                        $px->save();
                    }
                }

            } else {
                $nguoidung->trangthai = 0;
                if ($phieuxuat) {
                    foreach ($phieuxuat as $px) {
                        $px->tinhtranggiaohang = 1;
                        $px->save();
                    }
                }
            }
            $nguoidung->save();

            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 404,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}