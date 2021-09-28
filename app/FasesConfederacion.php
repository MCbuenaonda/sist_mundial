<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FasesConfederacion extends Model
{
    public function confederacion(){
        return $this->belongsTo(Confederacion::class);
    }

    public function fase(){
        return $this->belongsTo(Fase::class);
    }
}
