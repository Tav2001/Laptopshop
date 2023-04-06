<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LienHe extends Model
{
    protected $table = "lienhe";

    protected $primaryKey = 'maLH';
    protected $guarded = [];
    public $timestamps = false;
}