<?php

namespace App\Http\Controllers;

use App\Pais;
use App\Mundial;
use App\Historia;
use App\LogJuego;
use App\Confederacion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Resources\MundialResources;
use App\Http\Controllers\MundialController;

class ApiController extends Controller {

    public function __construct(){
        $this->lib = new MundialResources;
    }

    // confederaciones
    public function confederaciones() {
        $confederaciones = Confederacion::all();
        return response()->json($confederaciones);
    }

        // confederaciones
    public function confederacion(Confederacion $confederacion) {
        //$paises = Pais::where('confederacion_id', $confederacion->id)->with('confederacion')->get();
        $confederacion->paises = $confederacion->paises;
        return response()->json($confederacion);
    }

    public function pais(Pais $pais) {
        $pais->confederacion = $pais->confederacion;
        return response()->json($pais);
    }

    public function mundial($activo) {
        $mundial = Mundial::where('activo', $activo)->first();
        $mundial->pais = $mundial->pais;
        return response()->json($mundial);
    }

    public function juego(String $word) {
        $word = Str::upper($word);
        $juegos = Historia::where('activo', 0)->where('tag', 'like', '%' . $word . '%')->orderBy('fecha', 'ASC')->orderBy('id', 'ASC')->get();
        $juegos = $this->_addDetails($juegos);
        //$anterior = Historia::where('activo', 1)->orderBy('fecha', 'DESC')->orderBy('id', 'DESC')->first();
        return response()->json($juegos);
    }

    public function juegos() {
        $juegos = Historia::where('activo', 0)->orderBy('fecha', 'ASC')->orderBy('id', 'ASC')->limit(100)->get();
        $juegos = $this->_addDetails($juegos);
        return response()->json($juegos);
    }

    public function store(Request $request) {
        foreach ($request['acciones'] as $accion) {
            LogJuego::create([
                'historia_id' => $accion['juego_id'],
                'minuto' => $accion['minuto'],
                'posesion' => $accion['posesion'],
                'jugador_id' => $accion['jugador'],
                'gol' => $accion['gol']
            ]);
        }

        Historia::where('id', $request['partido']['id'])->update([
            'gol_l' => $request['partido']['gol_l'],
            'gol_v' => $request['partido']['gol_v'],
            'activo' => 1
        ]);

        $partido = Historia::where('id', $request['partido']['id'])->first();

        $this->_guardarJuego($partido);
        // $mundial = Mundial::where('activo', $activo)->first();
        // $mundial->pais = $mundial->pais;
        return response()->json($request);
    }




    private function _guardarJuego(Historia $partido) {
        $confederacion = $this->lib->asignarConfederacion($partido->confederacion->nombre);
        $local = $confederacion::where('pais_id', $partido->pais_id_l)->first();
        $visita = $confederacion::where('pais_id', $partido->pais_id_v)->first();
        $controller = new MundialController;
        // $pl = Pais::where('id', $partido->pais_id_l)->first();
        // $pv = Pais::where('id', $partido->pais_id_v)->first();
        // $gol_l = $this->_random(0, 6);
        // $gol_v = $this->_random(0, 6);
        //Historia::where('id', $partido->id)->update(['gol_l' => $gol_l, 'gol_v' => $gol_v, 'activo' => 1]);

        $puntosL = 1;
        $puntosV = 1;
        $rankinL = 0;
        $rankinV = 0;

        if ($partido->gol_l > $partido->gol_v) {
            $puntosL = 3;
            $puntosV = 0;
            $local->pais->rankin++;
            $visita->pais->rankin--;
            $local->pais->jg++;
            $visita->pais->jp++;
            $local->jg++;
            $visita->jp++;
        }
        if ($partido->gol_l < $partido->gol_v) {
            $puntosL = 0;
            $puntosV = 3;
            $local->pais->rankin--;
            $visita->pais->rankin++;
            $local->pais->jp++;
            $visita->pais->jg++;
            $local->jp++;
            $visita->jg++;
        }
        if ($partido->gol_l == $partido->gol_v) {
            $local->pais->je++;
            $visita->pais->je++;
            $local->je++;
            $visita->je++;
        }


        $local->pais->jj++;
        $visita->pais->jj++;

        $local->puntos = $local->puntos + $puntosL;
        $local->pais->puntos = $local->pais->puntos + $puntosL;
        $local->jj = $local->jj + 1;
        $local->gf = $local->gf + $partido->gol_l;
        $local->gc = $local->gc + $partido->gol_v;
        $local->pais->gf = $partido->gol_l + $local->pais->gf;
        $local->pais->gc = $partido->gol_v + $local->pais->gc;

        $confederacion::where('pais_id', $partido->pais_id_l)->update([
            'puntos' => $local->puntos,
            'jj' => $local->jj,
            'jg' => $local->jg,
            'je' => $local->je,
            'jp' => $local->jp,
            'gf' => $local->gf,
            'gc' => $local->gc]);

        Pais::where('id', $partido->pais_id_l)->update([
            'rankin' => $local->pais->rankin,
            'puntos' => $local->pais->puntos ,
            'jj' => $local->pais->jj,
            'jg' => $local->pais->jg,
            'je' => $local->pais->je,
            'jp' => $local->pais->jp,
            'gf' => $local->pais->gf,
            'gc' => $local->pais->gc]);

        $visita->puntos = $visita->puntos + $puntosV;
        $visita->pais->puntos = $visita->pais->puntos + $puntosV;
        $visita->jj = $visita->jj + 1;
        $visita->gf = $visita->gf + $partido->gol_v;
        $visita->gc = $visita->gc + $partido->gol_l;
        $visita->pais->gf = $partido->gol_v + $visita->pais->gf;
        $visita->pais->gc = $partido->gol_l + $visita->pais->gc;

        $confederacion::where('pais_id', $partido->pais_id_v)->update([
            'puntos' => $visita->puntos,
            'jj' => $visita->jj,
            'jj' => $visita->jj,
            'jg' => $visita->jg,
            'je' => $visita->je,
            'jp' => $visita->jp,
            'gf' => $visita->gf,
            'gc' => $visita->gc]);

        Pais::where('id', $partido->pais_id_v)->update([
            'rankin' => $visita->pais->rankin,
            'puntos' => $visita->pais->puntos ,
            'jj' => $visita->pais->jj,
            'jg' => $visita->pais->jg,
            'je' => $visita->pais->je,
            'jp' => $visita->pais->jp,
            'gf' => $visita->pais->gf,
            'gc' => $visita->pais->gc
        ]);

        $controller->checarGrupo($partido);
    }

    private function _addDetails($juegos) {
        foreach ($juegos as $key => $juego) {
            $juego->confederacion = $juego->confederacion;
            $juego->fase = $juego->fase;
            $juego->jornada = $juego->jornada;
            $juego->grupo = $juego->grupo;
            $juego->paisL = $juego->paisL;
            $juego->paisL->jugadores = $juego->paisL->jugadores;
            $juego->paisV = $juego->paisV;
            $juego->paisV->jugadores = $juego->paisV->jugadores;
            $juego->Ciudad = $juego->Ciudad;
        }

        return $juegos;
    }

}
