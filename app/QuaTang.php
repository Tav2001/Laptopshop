<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuaTang extends Model
{
    protected $table = "quatang";

    protected $primaryKey = 'maquatang';
    protected $guarded = [];
    // protected $fillable = [
    //     'tensanpham',
    // ];
    public $timestamps = false;
}