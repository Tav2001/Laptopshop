<?php

namespace App\Http\Controllers\FrontEnd;

use App\BaiViet;
use App\Http\Controllers\Controller;

class BaiVietUController extends Controller
{
    public function BaiViet()
    {
        $tieude = 'Bài Viết';
        $baiviet = BaiViet::orderby('mabaiviet', 'desc')->paginate(6);
        return view('User.baiviet', compact('tieude', 'baiviet'));
    }

    public function ChiTietBaiViet($id)
    {
        $baiviet = BaiViet::find($id);
        $tieude = $baiviet->tieude;
        return view('User.chitietbaiviet', compact('tieude', 'baiviet'));
    }
}