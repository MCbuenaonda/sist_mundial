<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    public function fases() {
        return $this->hasMany(GruposFase::class);
    }

    public function jornadas() {
        return $this->hasMany(JornadasGrupo::class);
    }

    public function partidos() {
        return $this->hasMany(Historia::class);
    }
}
