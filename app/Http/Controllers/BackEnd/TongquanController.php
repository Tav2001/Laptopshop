<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\LienHe;
use App\NguoiDung;
use App\PhieuXuat;
use App\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TongquanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            Carbon::setLocale('vi');
            $dautuannay = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->toDateString();
            $cuoituannay = Carbon::now('Asia/Ho_Chi_Minh')->endOfWeek()->toDateString();

            $dautuatruoc = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->subWeeks(1)->toDateString();
            $cuoituatruoc = Carbon::now('Asia/Ho_Chi_Minh')->endOfWeek()->subWeeks(1)->toDateString();

            if (request()->hanhdong == 'tuannay') {
                $dulieu = PhieuXuat::select('ngaytao')->whereBetween('ngaytao', [$dautuannay, $cuoituannay])->orderBy('ngaytao', 'ASC')->distinct()->get();
            } else {
                $dulieu = PhieuXuat::select('ngaytao')->whereBetween('ngaytao', [$dautuatruoc, $cuoituatruoc])->orderBy('ngaytao', 'ASC')->distinct()->get();
            }

            if (count($dulieu) > 0) {

                foreach ($dulieu as $val) {
                    $chart_data[] = array(
                        'songay' => Carbon::parse($val->ngaytao)->dayOfWeek,
                        'ngaytao' => Carbon::parse($val->ngaytao)->isoFormat('dddd'),
                        'tongtien' => PhieuXuat::where('ngaytao', $val->ngaytao)->sum('tongtien'),
                    );
                    $arr[] = $val->ngaytao;
                }
                if (request()->hanhdong == 'tuannay') {
                    $t2 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek();
                    $t3 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->addDays(1);
                    $t4 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->addDays(2);
                    $t5 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->addDays(3);
                    $t6 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->addDays(4);
                    $t7 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->addDays(5);
                    $cn = Carbon::now('Asia/Ho_Chi_Minh')->endOfWeek();
                } else {
                    $t2 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->subWeeks(1);
                    $t3 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->subWeeks(1)->addDays(1);
                    $t4 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->subWeeks(1)->addDays(2);
                    $t5 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->subWeeks(1)->addDays(3);
                    $t6 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->subWeeks(1)->addDays(4);
                    $t7 = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->subWeeks(1)->addDays(5);
                    $cn = Carbon::now('Asia/Ho_Chi_Minh')->endOfWeek()->subWeeks(1);
                }

                if (!in_array($t2->toDateString(), $arr)) {
                    array_push($chart_data, [
                        'songay' => $t2->dayOfWeek,
                        'ngaytao' => $t2->isoFormat('dddd'),
                        'tongtien' => 0,
                    ]);
                }
                if (!in_array($t3->toDateString(), $arr)) {
                    array_push($chart_data, [
                        'songay' => $t3->dayOfWeek,
                        'ngaytao' => $t3->isoFormat('dddd'),
                        'tongtien' => 0,
                    ]);
                }
                if (!in_array($t4->toDateString(), $arr)) {
                    array_push($chart_data, [
                        'songay' => $t4->dayOfWeek,
                        'ngaytao' => $t4->isoFormat('dddd'),
                        'tongtien' => 0,
                    ]);
                }
                if (!in_array($t5->toDateString(), $arr)) {
                    array_push($chart_data, [
                        'songay' => $t5->dayOfWeek,
                        'ngaytao' => $t5->isoFormat('dddd'),
                        'tongtien' => 0,
                    ]);
                }
                if (!in_array($t6->toDateString(), $arr)) {
                    array_push($chart_data, [
                        'songay' => $t6->dayOfWeek,
                        'ngaytao' => $t6->isoFormat('dddd'),
                        'tongtien' => 0,
                    ]);
                }
                if (!in_array($t7->toDateString(), $arr)) {
                    array_push($chart_data, [
                        'songay' => $t7->dayOfWeek,
                        'ngaytao' => $t7->isoFormat('dddd'),
                        'tongtien' => 0,
                    ]);
                }
                if (!in_array($cn->toDateString(), $arr)) {
                    array_push($chart_data, [
                        'songay' => $cn->dayOfWeek,
                        'ngaytao' => $cn->isoFormat('dddd'),
                        'tongtien' => 0,
                    ]);
                }
                foreach ($chart_data as $key => $row) {
                    $count[$key] = $row['songay'];
                }
                array_multisort($count, SORT_ASC, $chart_data);

            } else {
                for ($i = 0; $i < 7; $i++) {

                    $chart_data[] = array(
                        'ngaytao' => request()->hanhdong == 'tuannay' ? Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->addDays($i)->isoFormat('dddd') : Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->subWeeks(1)->addDays($i)->isoFormat('dddd'),
                        'tongtien' => 0,
                    );
                }
            }

            return response()->json($chart_data);
        }

        $laptop = SanPham::whereNotNull('malaptop')->count();
        $phukien = SanPham::whereNull('malaptop')->count();
        $donhang = PhieuXuat::count();
        $nguoidung = NguoiDung::count();
        $lienhe = LienHe::orderby('maLH', 'desc')->get();

        return view('Admin.tongquan', compact('laptop', 'phukien', 'donhang', 'nguoidung', 'lienhe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lienhe = LienHe::all();
        foreach ($lienhe as $lh) {
            $lh->trangthai = 1;
            $lh->save();
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lienhe = LienHe::find($id);
        if ($lienhe->trangthai == 0) {
            $lienhe->trangthai = 1;
        } else {
            $lienhe->trangthai = 0;
        }
        $lienhe->save();

        return redirect()->back();
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
        //
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