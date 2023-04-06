<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieude = 'Slider';
        $sliders = Slider::orderby('maslider', 'desc')->get();

        return view('Admin.slider', compact('tieude', 'sliders'));
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
        // dd($request->all());
        $slider = new Slider();
        $slider->tieude1 = $request->tieude1;
        $slider->tieude2 = $request->tieude2;
        $slider->tieude3 = $request->tieude3;
        $slider->duongdan = $request->duongdan;

        $req_hinh = $request->file('hinh');
        if ($req_hinh) {
            $tenanh = uniqid() . '_' . time() . '.' . $req_hinh->getClientOriginalExtension();

            $doikichthuoc = Image::make($req_hinh->getRealPath());
            $doikichthuoc->resize(780, 480);
            $doikichthuoc->save(public_path('uploads/slider/' . $tenanh));
            $slider->hinh = $tenanh;
        }
        $slider->save();

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
        if (request()->ajax()) {
            $slider = Slider::findOrfail($id);
            if ($slider) {
                return response()->json([
                    'status' => 200,
                    'data' => $slider,
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
        $slider = Slider::find($id);
        if ($slider) {

            $slider->tieude1 = $request->tieude1;
            $slider->tieude2 = $request->tieude2;
            $slider->tieude3 = $request->tieude3;
            $slider->duongdan = $request->duongdan;

            $req_hinh = $request->file('hinh');
            if ($req_hinh) {
                if (File::exists(public_path('uploads/slider/') . $slider->hinh)) {
                    unlink(public_path('uploads/slider/') . $slider->hinh);
                }
                $tenanh = uniqid() . '_' . time() . '.' . $req_hinh->getClientOriginalExtension();

                $doikichthuoc = Image::make($req_hinh->getRealPath());
                $doikichthuoc->resize(780, 480);
                $doikichthuoc->save(public_path('uploads/slider/' . $tenanh));
                $slider->hinh = $tenanh;
            }
            $slider->save();

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
        if (request()->ajax()) {
            $slider = Slider::findOrfail($id);
            if ($slider) {
                if (File::exists(public_path('uploads/slider/') . $slider->hinh)) {
                    unlink(public_path('uploads/slider/') . $slider->hinh);
                }
                $slider->delete();

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