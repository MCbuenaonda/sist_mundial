<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model {
    protected $fillable = ['tiempo_juego','tiempo_lapso','tiempo_siguiente'];
}
