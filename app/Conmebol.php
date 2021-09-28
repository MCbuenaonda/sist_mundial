<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conmebol extends Model
{
    protected $fillable = [
        'pais_id', 'fase_confederacion_id',
    ];

    public function pais() {
        return $this->belongsTo(Pais::class, 'pais_id', 'id');
    }
    public function grupo() {
        return $this->belongsTo(Grupo::class, 'grupo_id', 'id');
    }
    public function faseConfederacion() {
        return $this->belongsTo(FasesConfederacion::class, 'fase_confederacion_id', 'id');
    }
}
