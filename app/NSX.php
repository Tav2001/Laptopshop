<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NSX extends Model
{
    protected $table = "hangsanxuat";

    protected $primaryKey = 'mahang';
    protected $guarded = [];
    // protected $fillable = [
    //     'tensanpham',
    // ];
    public $timestamps = false;

    public function j_sanpham()
    {
        return $this->hasMany('App\SanPham', 'mahang', 'mahang');
    }
}