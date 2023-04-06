<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DanhGiaSao extends Model
{
    protected $table = "danhgiasao";

    protected $primaryKey = "maDG";
    protected $guarded = [];
    public $timestamps = false;

    public function saoToNguoidung()
    {
        return $this->hasMany('App\NguoiDung', 'manguoidung ', 'manguoidung ');
    }
}