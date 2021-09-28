<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $fillable = [
        'mundial_id','confederacion_id','fase_id','jornada_id','grupo_id','pais_id_l','pais_id_v','ciudad_id','fecha','tag'
    ];

    public function mundial() {
        return $this->belongsTo(Mundial::class);
    }

    public function confederacion() {
        return $this->belongsTo(Confederacion::class);
    }

    public function fase() {
        return $this->belongsTo(Fase::class);
    }

    public function jornada() {
        return $this->belongsTo(Jornada::class);
    }

    public function grupo() {
        return $this->belongsTo(Grupo::class);
    }

    public function paisL() {
        return $this->belongsTo(Pais::class, 'pais_id_l', 'id');
    }

    public function paisV() {
        return $this->belongsTo(Pais::class, 'pais_id_v', 'id');
    }

    public function Ciudad() {
        return $this->belongsTo(Ciudad::class);
    }
}
