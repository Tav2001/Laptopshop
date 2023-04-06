<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiamGia extends Model
{
    protected $table = "giamgia";

    protected $primaryKey = "idgiamgia";
    protected $guarded = [];
    public $timestamps = false;

    public function j_phieuxuat()
    {
        return $this->hasMany('App\PhieuXuat', 'magiamgia', 'idgiamgia');
    }
}