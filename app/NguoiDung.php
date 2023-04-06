<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NguoiDung extends Model
{
    protected $table = "nguoidung";

    protected $primaryKey = 'manguoidung';
    protected $guarded = [];
    // protected $fillable = [
    //     'tensanpham',
    // ];
    public $timestamps = false;
}