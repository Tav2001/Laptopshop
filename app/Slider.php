<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = "slider";

    protected $primaryKey = 'maslider';
    protected $guarded = [];
    // protected $fillable = [
    //     'tensanpham',
    // ];
    public $timestamps = false;
}