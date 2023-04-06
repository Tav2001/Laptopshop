<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = "sanpham";

    protected $primaryKey = 'masanpham';
    protected $guarded = [];
    // protected $fillable = [
    //     'tensanpham',
    //     'baohanh',
    //     'mota',
    //     'soluong',
    //     'gianhap',
    //     'giaban',
    //     'giakhuyenmai',
    //     'mathuvienhinh',
    //     'mahang',
    //     'maquatang',
    //     'malaptop',
    //     'maphukien',
    //     'loaisanpham',
    //     'ngaytao',
    // ];
    public $timestamps = false;

    public function j_laptop()
    {
        return $this->belongsTo('App\Laptop', 'malaptop', 'malaptop');
    }
    public function j_phukien()
    {
        return $this->belongsTo('App\PhuKien', 'maphukien', 'maphukien');
    }
    public function j_quatang()
    {
        return $this->belongsTo('App\QuaTang', 'maquatang', 'maquatang');
    }
    public function j_hinh()
    {
        return $this->belongsTo('App\Hinh', 'mathuvienhinh', 'mathuvienhinh');
    }
    public function j_nsx()
    {
        return $this->belongsTo('App\NSX', 'mahang', 'mahang');
    }
    public function sanPhamToDanhGia()
    {
        return $this->hasMany('App\DanhGiaSao', 'masanpham', 'masanpham');
    }
}