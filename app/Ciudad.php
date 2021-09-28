<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public function pais() {
        return $this->belongsTo(Pais::class, 'pais_id', 'id');
    }

    public function partidos() {
        return $this->hasMany(Historia::class);
    }
}
