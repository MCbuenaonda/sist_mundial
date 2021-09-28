<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    public function posicion() {
        return $this->belongsTo(Posicion::class);
    }

    public function pais() {
        return $this->belongsTo(Pais::class);
    }
}
