<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confederacion extends Model
{

    public function paises() {
        return $this->hasMany(Pais::class);
    }

    public function fases() {
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

    // public function getRouteKeyName() {
    //     return 'region';
    // }


}
