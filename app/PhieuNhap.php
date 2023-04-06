<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhieuNhap extends Model
{
    protected $table = "phieunhap";

    protected $primaryKey = 'maphieunhap';
    // protected $guarded = [];
    protected $fillable = [
        'manguoidung', 'ghichu', 'tongtien', 'congno', 'ngaytao',
    ];
    public $timestamps = false;

    public function j_nguoidung()
    {
        return $this->belongsTo('App\NguoiDung', 'manguoidung', 'manguoidung');
    }
}