<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    protected $fillable = [
        'fecha', 'confederacion_id', 'fase_id', 'jornada_id'
    ];

}
