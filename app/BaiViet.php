<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $table = "baiviet";

    protected $primaryKey = 'mabaiviet';
    protected $guarded = [];
    // protected $fillable = [
    //     'tensanpham',
    // ];
    public $timestamps = false;

    public function BaivietToNguoidung()
    {
        return $this->belongsTo('App\Nguoidung', 'manguoidung', 'manguoidung');
    }
}