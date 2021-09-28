<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posicion extends Model
{
    public function jugadores() {
        return $this->hasMany(Jugador::class);
    }
}
