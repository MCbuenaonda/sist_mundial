<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FasesLog extends Model
{
    protected $fillable = [
        'mundial_id', 'confederacion_id', 'fase_id', 'grupo_id', 'pais_id', 'puntos', 'jj', 'jg', 'je', 'jp', 'gf', 'gc'
    ];
}
