<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogCuenta extends Model
{
    protected $fillable = [ 'cuenta_id','deposito','retiro','motivo' ];
}
