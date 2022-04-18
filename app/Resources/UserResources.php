<?php

namespace App\Resources;

use App\Pais;
use App\Bolsa;
use App\Cuenta;
use App\Historia;
use App\Inversion;
use App\LogCuenta;

class UserResources {

    public function getCuenta($id){
        $cuenta = Cuenta::where('user_id', $id)->first();
        if ($cuenta == null) {
            $this->createCuenta($id);
            $cuenta = Cuenta::where('user_id', $id)->first();
        }
        return $cuenta;
    }

    public function createCuenta($id){
        Cuenta::create([
            'user_id' => $id,
            'disponible' => 100,
            'invertido' => 0
        ]);
        $cuenta = Cuenta::where('user_id', $id)->first();

        $this->createLogCuenta($cuenta, 100, 0, 'Apertura de cuenta');
    }

    public function createLogCuenta($cuenta, $deposito, $retiro, $motivo){
        LogCuenta::create([
            'cuenta_id' => $cuenta->id,
            'deposito' => $deposito,
            'retiro' => $retiro,
            'motivo' => $motivo
        ]);
    }

    public function updateInversion($juego_id){
        $juego = Historia::find($juego_id);
        $bolsaL = Bolsa::where('pais_id', $juego->pais_id_l)->first();
        $bolsaV = Bolsa::where('pais_id', $juego->pais_id_v)->first();

        /** Actualiza su estatus en la bolsa */
        if ($juego->gol_l > $juego->gol_v) {
            $bolsaL->precio = $this->_getPrecio($bolsaL->cotiza);
            $cotizaL = $bolsaL->cotiza + 1;

            $bolsaV->precio = $this->_getPrecio($bolsaV->cotiza);
            $cotizaV = $bolsaV->cotiza - 1;
            $cotizaV = ($cotizaV < 0) ? 0 : $cotizaV ;

            Bolsa::where('pais_id', $juego->pais_id_l)->update(['precio' => $bolsaL->precio,'cotiza' => $cotizaL]);
            Bolsa::where('pais_id', $juego->pais_id_v)->update(['precio' => $bolsaV->precio,'cotiza' => $cotizaV]);
        }

        if ($juego->gol_v > $juego->gol_l) {
            $bolsaL->precio = $this->_getPrecio($bolsaL->cotiza);
            $cotizaL = $bolsaL->cotiza - 1;
            $cotizaL = ($cotizaL < 0) ? 0 : $cotizaL ;

            $bolsaV->precio = $this->_getPrecio($bolsaV->cotiza);
            $cotizaV = $bolsaV->cotiza + 1;

            Bolsa::where('pais_id', $juego->pais_id_l)->update(['precio' => $bolsaL->precio,'cotiza' => $cotizaL]);
            Bolsa::where('pais_id', $juego->pais_id_v)->update(['precio' => $bolsaV->precio,'cotiza' => $cotizaV]);
        }

        $paisL = Pais::find($juego->pais_id_l);
        $inversionesL = Inversion::where('pais_id', $juego->pais_id_l)->get();
        foreach ($inversionesL as $inversion) {
            $cuenta = Cuenta::where('id', $inversion->cuenta_id)->first();
            $monto = 0;

            /** Cuando gana */
            if ($juego->gol_l > $juego->gol_v) {
                $monto = $this->_getGanacia($inversion->factor);
                $cuenta->disponible += $monto;
                $inversion->factor += 1;
                Cuenta::where('id', $inversion->cuenta_id)->update([ 'disponible' => $cuenta->disponible ]);
                Inversion::where('pais_id', $juego->pais_id_l)->update([ 'factor' => $inversion->factor ]);
                $this->createLogCuenta($cuenta, $monto, 0, 'Ganancias de '.$paisL->nombre);
            }

            /** Cuando pierde */
            if ($juego->gol_v > $juego->gol_l) {
                $monto = $this->_getPerdida($inversion->factor);
                $cuenta->invertido -= $monto;
                $inversion->inversion -= $monto;
                $inversion->factor -= 1;
                $inversion->factor = ($inversion->factor < 0) ? 0 : $inversion->factor ;
                Inversion::where('pais_id', $juego->pais_id_l)->update([ 'inversion' => $inversion->inversion, 'factor' => $inversion->factor ]);
                Cuenta::where('id', $inversion->cuenta_id)->update([ 'invertido' => $cuenta->invertido ]);
                $this->createLogCuenta($cuenta, 0, $monto, 'Perdidas de '.$paisL->nombre);
            }
        }

        $paisV = Pais::find($juego->pais_id_v);
        $inversionesV = Inversion::where('pais_id', $juego->pais_id_v)->get();
        foreach ($inversionesV as $inversion) {
            $cuenta = Cuenta::where('id', $inversion->cuenta_id)->first();
            $monto = 0;

            if ($juego->gol_v > $juego->gol_l) {
                $monto = $this->_getGanacia($inversion->factor);
                $cuenta->disponible += $monto;
                $inversion->factor += 1;
                Cuenta::where('id', $inversion->cuenta_id)->update([ 'disponible' => $cuenta->disponible ]);
                Inversion::where('pais_id', $juego->pais_id_v)->update([ 'factor' => $inversion->factor ]);
                $this->createLogCuenta($cuenta, $monto, 0, 'Ganancias de '.$paisV->nombre);
            }

            if ($juego->gol_l > $juego->gol_v) {
                $monto = $this->_getPerdida($inversion->factor);
                $cuenta->invertido -= $monto;
                $inversion->inversion -= $monto;
                $inversion->factor -= 1;
                $inversion->factor = ($inversion->factor < 0) ? 0 : $inversion->factor ;
                Inversion::where('pais_id', $juego->pais_id_v)->update([ 'inversion' => $inversion->inversion, 'factor' => $inversion->factor ]);
                Cuenta::where('id', $inversion->cuenta_id)->update([ 'invertido' => $cuenta->invertido ]);
                $this->createLogCuenta($cuenta, 0, $monto, 'Perdidas de '.$paisV->nombre);
            }
        }
    }

    public function _getPrecio($cotiza){
        $precio = 100;
        if ($cotiza == 2 || $cotiza == 3) { $precio = 110; }
        if ($cotiza == 4) { $precio = 120; }
        if ($cotiza == 5) { $precio = 130; }
        if ($cotiza == 6) { $precio = 150; }
        if ($cotiza == 7) { $precio = 170; }
        if ($cotiza == 8) { $precio = 200; }
        if ($cotiza == 9) { $precio = 300; }
        if ($cotiza >= 10) { $precio = 500; }
        return $precio;
    }

    public function _getGanacia($factor){
        $monto = 10;
        if ($factor == 1) { $monto = 20; }
        if ($factor == 2) { $monto = 40; }
        if ($factor == 3) { $monto = 50; }
        if ($factor == 4) { $monto = 60; }
        if ($factor == 5) { $monto = 70; }
        if ($factor == 6) { $monto = 80; }
        if ($factor == 7) { $monto = 90; }
        if ($factor == 8) { $monto = 100; }
        if ($factor == 9) { $monto = 120; }
        if ($factor >= 10) { $monto = 150; }
        return $monto;
    }

    public function _getPerdida($factor){
        $monto = 10;
        if ($factor == 2 || $factor == 3) { $monto = 20; }
        if ($factor == 4) { $monto = 30; }
        if ($factor == 5) { $monto = 40; }
        if ($factor == 6) { $monto = 60; }
        if ($factor == 7) { $monto = 80; }
        if ($factor == 8) { $monto = 90; }
        if ($factor == 9) { $monto = 100; }
        if ($factor >= 10) { $monto = 120; }
        return $monto;
    }
}
