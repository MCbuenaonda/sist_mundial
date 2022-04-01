<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FasesLog extends Model
{
    protected $fillable = [
        'mundial_id', 'confederacion_id', 'fase_id', 'grupo_id', 'pais_id', 'puntos', 'jj', 'jg', 'je', 'jp', 'gf', 'gc'
    ];

    public function pais() {
        return $this->belongsTo(Pais::class, 'pais_id', 'id');
    }

    public function fase() {
        return $this->belongsTo(Fase::class, 'fase_id', 'id');
    }

    public function grupo() {
        return $this->belongsTo(Grupo::class, 'grupo_id', 'id');
    }
}
