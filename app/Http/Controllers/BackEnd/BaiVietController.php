<?php

namespace App\Http\Controllers\BackEnd;

use App\BaiViet;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieude = 'Bài Viết';
        $baiviet = BaiViet::orderby('mabaiviet', 'desc')->get();

        return view('Admin.baiviet', compact('tieude', 'baiviet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tieude = 'Thêm Bài Viết';
        return view('Admin.baiviet_hanhdong', compact('tieude'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $baiviet = new BaiViet();
        $baiviet->manguoidung = Session::get('dangnhap')['manguoidung'];
        $baiviet->tieude = ucwords($request->tieude);
        $baiviet->mota = $request->mota;
        $baiviet->motangan = $request->motangan;
        $baiviet->ngaytao = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();

        $req_hinh = $request->file('hinh');
        if ($req_hinh) {
            $tenanh = uniqid() . '_' . time() . '.' . $req_hinh->getClientOriginalExtension();

            $doikichthuoc = Image::make($req_hinh->getRealPath());
            $doikichthuoc->resize(370, 210);
            $doikichthuoc->save(public_path('uploads/baiviet/' . $tenanh));
            $baiviet->hinh = $tenanh;
        }
        $baiviet->save();

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
            $baiviet = BaiViet::findOrfail($id);
            if ($baiviet) {
                return response()->json([
                    'status' => 200,
                    'data' => $baiviet,
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
        Session::put('baiviet_session', $id);
        $tieude = 'Sửa Bài Viết';
        $baiviet = BaiViet::find($id);

        return view('Admin.baiviet_hanhdong', compact('tieude', 'baiviet'));
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
        $baiviet = BaiViet::find($id);
        // $baiviet->manguoidung = 1;
        $baiviet->manguoidung = Session::get('dangnhap')['manguoidung'];
        $baiviet->tieude = ucwords($request->tieude);
        $baiviet->mota = $request->mota;
        $baiviet->motangan = $request->motangan;

        $req_hinh = $request->file('hinh');
        if ($req_hinh) {
            if (File::exists(public_path('uploads/baiviet/') . $baiviet->hinh)) {
                unlink(public_path('uploads/baiviet/') . $baiviet->hinh);
            }
            $tenanh = uniqid() . '_' . time() . '.' . $req_hinh->getClientOriginalExtension();

            $doikichthuoc = Image::make($req_hinh->getRealPath());
            $doikichthuoc->resize(370, 210);
            $doikichthuoc->save(public_path('uploads/baiviet/' . $tenanh));
            $baiviet->hinh = $tenanh;
        }
        $baiviet->save();

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
            $baiviet = BaiViet::findOrfail($id);
            if ($baiviet) {
                if (File::exists(public_path('uploads/baiviet/') . $baiviet->hinh)) {
                    unlink(public_path('uploads/baiviet/') . $baiviet->hinh);
                }
                $baiviet->delete();

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