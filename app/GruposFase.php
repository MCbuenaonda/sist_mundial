<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GruposFase extends Model
{
    public function confederacion(){
        return $this->belongsTo(Confederacion::class);
    }

    public function fase(){
        return $this->belongsTo(Fase::class);
    }

    public function grupo(){
        return $this->belongsTo(Grupo::class);
    }
}
