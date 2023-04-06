<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\NSX;
use Illuminate\Http\Request;

class HangSanXuatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieude = 'Hãng Sản Xuất';
        $sanpham = NSX::orderby('loaihang', 'asc')->get();
        return view('Admin.hangsanxuat', compact('tieude', 'sanpham'));
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
        $hangsx = new NSX();
        $hangsx->tenhang = strtoupper($request->tenHang);
        $hangsx->loaihang = $request->loaiHang;
        $hangsx->save();

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
        $sanpham = NSX::findOrfail($id);
        if ($sanpham) {
            return response()->json([
                'status' => 200,
                'data' => $sanpham,
                'sosanpahm' => count($sanpham->j_sanpham),
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Không Tìm Thấy Sản Phẩm',
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
        // $hangsx = NSX::findOrfail($id);
        // if ($hangsx) {
        //     $hangsx->tenhang = strtoupper($request->tenHang);
        //     $hangsx->loaihang = $request->loaiHang;
        //     $hangsx->save();

        //     return response()->json([
        //         'status' => 200,
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => 404,
        //     ]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sanpham = NSX::findOrfail($id);
        if ($sanpham) {
            $sanpham->delete();

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