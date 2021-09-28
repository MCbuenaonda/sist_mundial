<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biombo extends Model
{
    protected $fillable = [
        'pais_id', 'confederacion_id','rankin'
    ];
}
