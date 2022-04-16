<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    public function confederacion() {
        return $this->belongsTo(Confederacion::class, 'confederacion_id', 'id');
    }

    public function bolsa() {
        return $this->hasOne(Bolsa::class);
    }

    public function ciudades() {
        return $this->hasMany(Ciudad::class);
    }

    public function jugadores() {
        return $this->hasMany(Jugador::class);
    }

    public function mundiales() {
        return $this->hasMany(Mundial::class);
    }

    public function partidosL() {
        return $this->hasMany(Historia::class, 'pais_id_l', 'id');
    }

    public function partidosV() {
        return $this->hasMany(Historia::class, 'pais_id_v', 'id');
    }

    public function images() {
        return $this->hasOne(Image::class, 'pais_id', 'id');
    }

    public function cuentas() {
        return $this->hasMany(Inversion::class, 'pais_id', 'id');
    }
}
