<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hinh extends Model
{
    protected $table = "thuvienhinh";

    protected $primaryKey = 'mathuvienhinh';
    protected $guarded = [];
    // protected $fillable = [
    //     'tensanpham',
    // ];
    public $timestamps = false;
}