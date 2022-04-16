<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inversion extends Model
{
    protected $fillable = [
        'pais_id','cuenta_id','inversion'
    ];

}
