<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repechaje extends Model
{
    protected $fillable = [
        'pais_id', 'fase_confederacion_id',
    ];

    public function pais() {
        return $this->belongsTo(Pais::class, 'pais_id', 'id');
    }
}
