<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhuKien extends Model
{
    protected $table = "phukien";

    protected $primaryKey = 'maphukien';
    protected $guarded = [];
    public $timestamps = false;
}