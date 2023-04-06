<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuXuat extends Model
{
    protected $table = "chitietdonhang";

    protected $primaryKey = 'machitietdonhang';
    protected $guarded = [];
    public $timestamps = false;

    public function j_chitietphieu_sp()
    {
        return $this->belongsTo('App\SanPham', 'masanpham', 'masanpham');
    }

    public function chitietphieuToPX()
    {
        return $this->belongsTo('App\PhieuXuat', 'madonhang', 'madonhang');
    }
}