<?php

namespace App\Resources;

use App\Afc;
use App\Caf;
use App\Ofc;
use App\Uefa;
use App\Concacaf;
use App\Conmebol;
use App\Repechaje;
use App\Internacional;
use Illuminate\Http\Request;

class MundialResources {
    public $true = 1;
    public $false = 0;
    public $desc = 'DESC';
    public $asc = 'ASC';
    public $_activo = 'activo';
    public $_id = 'id';


    public function asignarConfederacion($confederacion_nombre) {
        $conf = null;

        switch ($confederacion_nombre) {
            case 'UEFA':
                $conf = new Uefa;
                break;
            case 'CONMEBOL':
                $conf = new Conmebol;
                break;
            case 'CONCACAF':
                $conf = new Concacaf;
                break;
            case 'CAF':
                $conf = new Caf;
                break;
            case 'OFC':
                $conf = new Ofc;
                break;
            case 'AFC':
                $conf = new Afc;
                break;
            case 'REPECHAJE':
                $conf = new Repechaje;
                break;
            case 'MUNDIAL':
                $conf = new Internacional;
                break;
            default:
                break;
        }

        return $conf;
    }
}
