<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LapTop extends Model
{
    protected $table = "laptop";

    protected $primaryKey = 'malaptop';
    protected $guarded = [];
    // protected $fillable = [
    //     'tensanpham',
    // ];
    public $timestamps = false;
}