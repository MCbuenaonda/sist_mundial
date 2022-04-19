<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $fillable = [ 'user_id', 'disponible', 'invertido' ];

    public function inversiones() {
        return $this->hasMany(Inversion::class);
    }

}
