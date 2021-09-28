<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    public function grupos() {
        return $this->hasMany(JornadasGrupo::class);
    }

    public function partidos() {
        return $this->hasMany(Historia::class);
    }
}
