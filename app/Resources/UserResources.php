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
            $factorL = $bolsaL->cotiza + 10;
            $gananciaL = $bolsaL->precio * ($factorL / 100);
            $bolsaL->precio += ceil($gananciaL);
            $cotizaL = $bolsaL->cotiza + 1;

            $factorV = $bolsaV->cotiza + 10;
            $gananciaV = $bolsaV->precio * ($factorV / 100);
            $bolsaV->precio -= ceil($gananciaV);
            $cotizaV = $bolsaV->cotiza - 1;
            $cotizaV = ($cotizaV < 0) ? 0 : $cotizaV ;

            Bolsa::where('pais_id', $juego->pais_id_l)->update(['precio' => $bolsaL->precio,'cotiza' => $cotizaL]);
            Bolsa::where('pais_id', $juego->pais_id_v)->update(['precio' => $bolsaV->precio,'cotiza' => $cotizaV]);
        }

        if ($juego->gol_v > $juego->gol_l) {
            $factorL = $bolsaL->cotiza + 10;
            $gananciaL = $bolsaL->precio * ($factorL / 100);
            $bolsaL->precio -= ceil($gananciaL);
            $cotizaL = $bolsaL->cotiza - 1;
            $cotizaL = ($cotizaL < 0) ? 0 : $cotizaL ;

            $factorV = $bolsaV->cotiza + 10;
            $gananciaV = $bolsaV->precio * ($factorV / 100);
            $bolsaV->precio += ceil($gananciaV);
            $cotizaV = $bolsaV->cotiza + 1;

            $bolsaL->precio = ($bolsaL->precio < 100) ? 100 : $bolsaL->precio ;
            $bolsaV->precio = ($bolsaV->precio < 100) ? 100 : $bolsaV->precio ;
            Bolsa::where('pais_id', $juego->pais_id_l)->update(['precio' => $bolsaL->precio,'cotiza' => $cotizaL]);
            Bolsa::where('pais_id', $juego->pais_id_v)->update(['precio' => $bolsaV->precio,'cotiza' => $cotizaV]);
        }

        $paisL = Pais::find($juego->pais_id_l);
        $inversionesL = Inversion::where('pais_id', $juego->pais_id_l)->get();
        foreach ($inversionesL as $inversion) {
            $cuenta = Cuenta::where('id', $inversion->cuenta_id)->first();
            $factor = $inversion->factor + 10;
            $monto = $inversion->inversion * ($factor / 100);

            if ($juego->gol_l > $juego->gol_v) {
                $cuenta->disponible += $monto;
                $inversion->factor += 1;
                Cuenta::where('id', $inversion->cuenta_id)->update([ 'disponible' => $cuenta->disponible ]);
                Inversion::where('pais_id', $juego->pais_id_l)->update([ 'factor' => $inversion->factor ]);
                $this->createLogCuenta($cuenta, $monto, 0, 'Ganancias de '.$paisL->nombre);
            }

            if ($juego->gol_v > $juego->gol_l) {
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
            $factor = $inversion->factor + 10;
            $monto = $inversion->inversion * ($factor / 100);

            if ($juego->gol_v > $juego->gol_l) {
                $cuenta->disponible += $monto;
                $inversion->factor += 1;
                Cuenta::where('id', $inversion->cuenta_id)->update([ 'disponible' => $cuenta->disponible ]);
                Inversion::where('pais_id', $juego->pais_id_v)->update([ 'factor' => $inversion->factor ]);
                $this->createLogCuenta($cuenta, $monto, 0, 'Ganancias de '.$paisV->nombre);
            }

            if ($juego->gol_l > $juego->gol_v) {
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
}
