<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuNhap extends Model
{
    protected $table = "chitietphieunhap";

    protected $primaryKey = 'machitietphieunhap';
    protected $guarded = [];
    public $timestamps = false;

    public function j_chitietphieu_sp()
    {
        return $this->belongsTo('App\SanPham', 'masanpham', 'masanpham');
    }
}