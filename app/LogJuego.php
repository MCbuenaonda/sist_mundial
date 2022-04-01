<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogJuego extends Model
{
    protected $fillable = [
        'historia_id','minuto','posesion','jugador_id','accion_id','gol'
    ];

    public function jugador() {
        return $this->belongsTo(Jugador::class);
    }

    public function accion() {
        return $this->belongsTo(Acciones::class, 'accion_id', 'id');
    }
}
