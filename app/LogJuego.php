<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogJuego extends Model
{
    protected $fillable = [
        'historia_id','minuto','posesion','jugador_id','gol'
    ];
}
