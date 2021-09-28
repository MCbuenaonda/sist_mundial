<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    public function confederaciones() {
        return $this->hasMany(FasesConfederacion::class);
    }

    public function grupos() {
        return $this->hasMany(GruposFase::class);
    }

    public function jornadas() {
        return $this->hasMany(JornadasGrupo::class);
    }

    public function partidos() {
        return $this->hasMany(Historia::class);
    }
}
