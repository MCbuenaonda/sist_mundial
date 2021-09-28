<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mundial extends Model
{
    protected $fillable = [
        'pais_id', 'anio'
    ];

    public function pais() {
        return $this->belongsTo(Pais::class, 'pais_id', 'id');
    }

    public function partidos() {
        return $this->hasMany(Historia::class);
    }
}
