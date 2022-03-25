<?php

namespace App\Http\Controllers;

use App\Afc;
use App\Caf;
use App\Ofc;
use App\Pais;
use App\Uefa;
use stdClass;
use App\Fecha;
use App\Image;
use App\Biombo;
use App\Ciudad;
use App\Jugador;
use App\Mundial;
use App\Acciones;
use App\Concacaf;
use App\Conmebol;
use App\FasesLog;
use App\Historia;
use App\LogJuego;
use App\Posicion;
use App\DosEquipo;
use App\Repechaje;
use Carbon\Carbon;
use App\DiezEquipo;
use App\GruposFase;
use App\OchoEquipo;
use App\SeisEquipo;
use App\TresEquipo;
use App\CincoEquipo;
use App\FechaLimite;
use App\CuatroEquipo;
use App\Confederacion;
use App\Configuracion;
use App\Internacional;
use App\JornadasGrupo;
use App\FasesConfederacion;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Resources\MundialConstants;
use App\Resources\MundialResources;

class MundialController extends Controller
{
    public $const;

    public function __construct(){
        $this->const = new MundialConstants;
        $this->lib = new MundialResources;
        $this->middleware(['auth', 'verified']);
    }

    /*
    * Obtiene todos los datos que se mostraran en la vista principal y renderiza la vista principal
    */
    public function index() {
        $config = Configuracion::where('rol_id', 1)->first();
        $mundial = Mundial::where('activo', $this->const->true )->first();
        if (!$mundial) {
            $this->lib->createMundial();
            $this->lib->createConfederaciones();
            $this->lib->activarFase();
            $this->lib->asignarFaseEnConfederaciones();
            $this->lib->asignarGruposDeFase();
            $this->lib->crearFechas();
            $this->lib->crearPartidos();
            //$this->_jugarPartidos();
            $mundial = Mundial::where('activo', $this->const->true )->first();
        }

        $confederaciones = $this->lib->getconfederaciones();
        $juegos = $this->lib->getJuegos();

        if(count($juegos) == 0){
            $repechaje = FasesConfederacion::where(['confederacion_id' => 7, 'activo' => 0])->first();

            if ($repechaje) {
                $this->_crearRepechaje();
                $this->_activarFaseRepechaje();
                //$this->_asignarFaseEnConfederaciones();
                $this->lib->asignarFaseEnConfederaciones();
                $this->_asignarGruposDeFaseRepechaje();
                //$this->_crearPartidos();
                $this->lib->crearPartidos();
                //$this->_jugarPartidos();
            }else{
                $mundial = FasesConfederacion::where(['confederacion_id' => 8, 'activo' => 0])->first();
                if ($mundial) {
                    $this->_crearBiombos();
                    $this->_crearInternacionals();
                    $this->_activarFaseMundial();
                    //$this->_asignarFaseEnConfederaciones();
                    $this->lib->asignarFaseEnConfederaciones();
                    //$this->_crearPartidos();
                    $this->lib->crearPartidos();
                    //$this->_jugarPartidos();
                }else{
                    $campeon = Internacional::whereNull('posicion')->first();
                    Mundial::where('activo', 1)->update([ 'activo' => 0, 'campeon' => $campeon->pais_id]);
                    Uefa::truncate();
                    Conmebol::truncate();
                    Concacaf::truncate();
                    Caf::truncate();
                    Ofc::truncate();
                    Afc::truncate();
                    Repechaje::truncate();
                    Biombo::truncate();
                    Internacional::truncate();
                    FasesConfederacion::where('activo', 2)->update([ 'activo' => 0]);

                    $fechas_limit = FechaLimite::all();
                    foreach ($fechas_limit as $fecha) {
                        $newFecha = $this->_ajustarNuevaFecha($fecha->fecha);
                        FechaLimite::where('tipo', $fecha->tipo)->update([ 'fecha' => $newFecha ]);
                    }
                    echo 'Se acabo el mundial'; exit;
                }
            }
        }

        $juego = $this->lib->getJuego();
        $anterior = Historia::where('activo', 1)->orderBy('fecha', 'DESC')->orderBy('id', 'DESC')->first();
        $logJuego = $this->lib->getAnterior($anterior);
        $dataJugador = $this->lib->getDataJugador();
        $grupo = $this->lib->getGrupoPartido($juego);
        $podio = $this->lib->getPodio();
        $teamog = $this->lib->getTeamog();
        $historia = $this->lib->getHistoria($juego);
        $juegoGlobal = $this->lib->getJuegoGlobal($grupo, $juego);

        return view('mundial.index', compact('mundial','confederaciones','juego','anterior','grupo','juegos','logJuego','dataJugador','podio','juegoGlobal','config','teamog','historia'));
    }

    /*
    * Crea y muestra las acciones que pasan durante el partido
    */
    public function show(Historia $partido) {
        $config = Configuracion::where('rol_id', 1)->first();
        $partidoGlobal = null;
        $grupoGlobal = null;
        $grupo = $this->lib->getGrupoPartido($partido);
        $game = $this->lib->getGame($partido);

        if (count($grupo) == 2 && $partido->confederacion_id <= 7 && $partido->jornada_id == 2) {
            $partidoGlobal = Historia::where('tag', $partido->PaisV->siglas.$partido->PaisL->siglas)->first();
        }

        if (count($grupo) > 2 && $partido->confederacion_id <= 7) {
            $grupoGlobal = $grupo;
            foreach ($grupo as $val) {
                $grupoGlobal->pais = $val->pais;
            }
        }


        /* SECCION: creacion de logs adicionales */
        $powerL = 0;
        $powerV = 0;

        $listlog = LogJuego::where('historia_id', $partido->id)->get();

        $dataCreate = [
            'historia_id' => $partido->id,
            'minuto' => 0,
            'posesion' => '',
            'jugador_id' => 0,
            'gol' => 0,
            'accion_id' => 0
        ];

        foreach ($listlog as $key => $log) {
            $accion = null;
            $jugador = null;
            $jugador_id = null;
            $minuto = 0;
            $base = ($key*10) + 4;

            if ($log->minuto <= $base) {
                $minuto = $log->minuto - 1;
                $grupo_base = ($log->posesion == 'L') ? 'B' : 'A';
                $accion = Acciones::where('grupo', $grupo_base)->inRandomOrder()->first();
                $jugador = $this->lib->getJugador($log,$partido);

                if ($grupo_base == 'A') {
                    $powerL += -1;
                    $powerV += 2;
                } else {
                    $powerL += 1;
                    $powerV += -1;
                }

                $dataCreate = $this->lib->setLogJuego($dataCreate, $accion->id, $jugador->id, $minuto, $log->posesion);
                LogJuego::create($dataCreate);

                if ($log->gol == 1) {
                    $accion = Acciones::where('grupo', 'D')->inRandomOrder()->first();
                    if ($log->posesion == 'L') {
                        $powerL += 3;
                        $powerV += -1;
                    } else {
                        $powerL += -1;
                        $powerV += 3;
                    }
                    $jugador_id = $log->jugador_id;
                }else{
                    $accion = Acciones::where('grupo', 'C')->inRandomOrder()->first();
                    if ($log->posesion == 'L') {
                        $powerL += -1;
                        $powerV += 1;
                        $jugador_tmp = Jugador::where('pais_id', $partido->pais_id_l)->inRandomOrder()->first();
                    } else {
                        $powerL += 1;
                        $powerV += -1;
                        $jugador_tmp = Jugador::where('pais_id', $partido->pais_id_v)->inRandomOrder()->first();
                    }

                    $jugador_id = $jugador_tmp->id;
                }

                LogJuego::where('id', $log->id)->update([
                    'jugador_id' => $jugador_id,
                    'accion_id' => $accion->id
                ]);
            } else {
                $min_tmp = $log->minuto - ($this->lib->random(3, 4));
                $accion = Acciones::where('grupo', 'E')->inRandomOrder()->first();
                $jugador = $this->lib->getJugador($log,$partido);
                $dataCreate = $this->lib->setLogJuego($dataCreate, $accion->id, $jugador->id, $min_tmp, $log->posesion);
                LogJuego::create($dataCreate);

                $min_tmp = $min_tmp + ($this->lib->random(1, 2));
                $accion = Acciones::where('grupo', 'F')->inRandomOrder()->first();
                $jugador = $this->lib->getJugador($log,$partido);
                $dataCreate = $this->lib->setLogJuego($dataCreate, $accion->id, $jugador->id, $min_tmp, $log->posesion);
                LogJuego::create($dataCreate);

                if ($log->posesion == 'L') {
                    $powerL += 2;
                    $powerV += -2;
                } else {
                    $powerL += -2;
                    $powerV += 2;
                }

                if ($log->gol == 1) {
                    $accion = Acciones::where('grupo', 'D')->inRandomOrder()->first();
                    $jugador_id = $log->jugador_id;

                    if ($log->posesion == 'L') {
                        $powerL += 3;
                        $powerV += -1;
                    } else {
                        $powerL += -1;
                        $powerV += 3;
                    }
                }else{
                    $accion = Acciones::where('grupo', 'G')->inRandomOrder()->first();
                    if ($log->posesion == 'L') {
                        $powerL += -1;
                        $powerV += 2;
                        $jugador_tmp = Jugador::where('pais_id', $partido->pais_id_v)->inRandomOrder()->first();
                    } else {
                        $powerL += 2;
                        $powerV += -1;
                        $jugador_tmp = Jugador::where('pais_id', $partido->pais_id_l)->inRandomOrder()->first();
                    }

                    $jugador_id = $jugador_tmp->id;
                }

                LogJuego::where('id', $log->id)->update([
                    'jugador_id' => $jugador_id,
                    'accion_id' => $accion->id
                ]);
            }
        }

        $relato = $this->lib->getRelato($partido);
        $podL = Pais::where('id', $partido->pais_id_l)->first();
        $podV = Pais::where('id', $partido->pais_id_v)->first();
        $poderIniL = $podL->poder;
        $poderIniV = $podV->poder;
        $podL->poder = $powerL + $podL->poder;
        $podV->poder = $powerV + $podV->poder;
        Pais::where('id', $partido->pais_id_l)->update( ['poder' => $podL->poder] );
        Pais::where('id', $partido->pais_id_v)->update( ['poder' => $podV->poder] );
        $this->lib->checarGrupo($partido);

        return view('mundial.show', compact('relato','game','poderIniL','poderIniV','grupoGlobal','config'));
    }

    public function next(Historia $partido) {
        return redirect()->action('MundialController@index');
    }

    public function jugar(Historia $partido) {
        $juego = new StdClass;
        $juego->acciones = [];
        $juego->partido = $partido;
        $partidos = Historia::where('activo', 0)->orderBy('fecha', 'ASC')->get();

        if(count($partidos) == 0){
            echo 'Ya no hay partidos por jugar';
            exit;
        }

        $confederacion = $this->lib->asignarConfederacion($partido->confederacion->nombre);
        $local = $confederacion::where('pais_id', $partido->pais_id_l)->first();
        $visita = $confederacion::where('pais_id', $partido->pais_id_v)->first();
        $pl = Pais::where('id', $partido->pais_id_l)->first();
        $pv = Pais::where('id', $partido->pais_id_v)->first();
        $gol_l = 0;
        $gol_v = 0;

        for ($i=1; $i < 11; $i++) {
            $accion = new StdClass;
            $accion->gol = 0;
            $accion->jugador_id = 0;
            $accion->juego_id = $partido->id;

            $lov = $this->lib->random(0, 1);
            $tiro = $this->lib->random(0, 1);

            $min = 0;
            $max = 0;
            switch ($i) {
                case 1: $max = 9; $min = 1; break;
                case 2: $max = 10; $min = 19; break;
                case 3: $max = 20; $min = 29; break;
                case 4: $max = 30; $min = 39; break;
                case 5: $max = 40; $min = 49; break;
                case 6: $max = 50; $min = 59; break;
                case 7: $max = 60; $min = 69; break;
                case 8: $max = 70; $min = 79; break;
                case 9: $max = 80; $min = 89; break;
                case 10: $max = 90; $min = 95; break;
                default: break;
            }

            $minute = $this->lib->random($min, $max);

            $accion->minuto = $minute;

            if ($lov) {
                $accion->posesion = 'L';
                if ($tiro) {
                    $gol_l++;
                    $jugador = Jugador::where('pais_id', $partido->pais_id_l)->inRandomOrder()->first();
                    $accion->gol = 1;
                    $accion->jugador_id = $jugador->id;
                }
            } else {
                $accion->posesion = 'V';
                if ($tiro) {
                    $gol_v++;
                    $jugador = Jugador::where('pais_id', $partido->pais_id_v)->inRandomOrder()->first();
                    $accion->gol = 1;
                    $accion->jugador_id = $jugador->id;
                }
            }

            array_push($juego->acciones, $accion);
            //echo $i . '.- ' . $minute . '.'. $lov .'.'.$tiro.'<br>';
        }

        foreach ($juego->acciones as $accion) {
            LogJuego::create([
                'historia_id' => $accion->juego_id,
                'minuto' => $accion->minuto,
                'posesion' => $accion->posesion,
                'jugador_id' => $accion->jugador_id,
                'gol' => $accion->gol
            ]);
        }

        Historia::where('id', $partido->id)->update(['gol_l' => $gol_l, 'gol_v' => $gol_v, 'activo' => 1]);

        $puntosL = 1;
        $puntosV = 1;
        $rankinL = 0;
        $rankinV = 0;

        if ($gol_l > $gol_v) {
            $puntosL = 3;
            $puntosV = 0;
            $local->pais->rankin++;
            $visita->pais->rankin--;
            $local->pais->jg++;
            $visita->pais->jp++;
            $local->jg++;
            $visita->jp++;
        }
        if ($gol_l < $gol_v) {
            $puntosL = 0;
            $puntosV = 3;
            $local->pais->rankin--;
            $visita->pais->rankin++;
            $local->pais->jp++;
            $visita->pais->jg++;
            $local->jp++;
            $visita->jg++;
        }
        if ($gol_l == $gol_v) {
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
        $local->gf = $local->gf + $gol_l;
        $local->gc = $local->gc + $gol_v;
        $local->pais->gf = $gol_l + $local->pais->gf;
        $local->pais->gc = $gol_v + $local->pais->gc;

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
        $visita->gf = $visita->gf + $gol_v;
        $visita->gc = $visita->gc + $gol_l;
        $visita->pais->gf = $gol_v + $visita->pais->gf;
        $visita->pais->gc = $gol_l + $visita->pais->gc;

        $confederacion::where('pais_id', $partido->pais_id_v)->update([
            'puntos' => $visita->puntos,
            'jj' => $visita->jj,
            'jj' => $visita->jj,
            'jg' => $visita->jg,
            'je' => $visita->je,
            'jp' => $visita->jp,
            'gf' => $visita->gf,
            'gc' => $visita->gc
        ]);

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

        return redirect('mundial/'.$partido->id.'/detalle')->with('message', 'State saved correctly!!!');
    }

    /**
     * Juega los partidos
     */
    protected function _jugarPartidos() {
        $partidos = Historia::where('activo', 0)->orderBy('fecha', 'ASC')->get();

        if(count($partidos) == 0){
            $repechaje = FasesConfederacion::where(['confederacion_id' => 7, 'activo' => 0])->first();

            if ($repechaje) {
                $this->_crearRepechaje();
                $this->_activarFaseRepechaje();
                //$this->_asignarFaseEnConfederaciones();
                $this->_asignarGruposDeFaseRepechaje();
                $this->_crearPartidos();
                $this->_jugarPartidos();
            }else{
                $mundial = FasesConfederacion::where(['confederacion_id' => 8, 'activo' => 0])->first();
                if ($mundial) {
                    $this->_crearBiombos();
                    $this->_crearInternacionals();
                    $this->_activarFaseMundial();
                    //$this->_asignarFaseEnConfederaciones();
                    $this->_crearPartidos();
                    $this->_jugarPartidos();
                }else{
                    $campeon = Internacional::whereNull('posicion')->first();
                    Mundial::where('activo', 1)->update([ 'activo' => 0, 'campeon' => $campeon->pais_id]);
                    Uefa::truncate();
                    Conmebol::truncate();
                    Concacaf::truncate();
                    Caf::truncate();
                    Ofc::truncate();
                    Afc::truncate();
                    Repechaje::truncate();
                    Biombo::truncate();
                    Internacional::truncate();
                    FasesConfederacion::where('activo', 2)->update([ 'activo' => 0]);

                    $fechas_limit = FechaLimite::all();
                    foreach ($fechas_limit as $fecha) {
                        $newFecha = $this->_ajustarNuevaFecha($fecha->fecha);
                        FechaLimite::where('tipo', $fecha->tipo)->update([ 'fecha' => $newFecha ]);
                    }
                    echo 'Se acabo el mundial'; exit;
                }
            }
        }

        foreach ($partidos as $partido) {
            $juego = new StdClass;
            $juego->acciones = [];
            $juego->partido = $partido;

            $confederacion = $this->lib->asignarConfederacion($partido->confederacion->nombre);
            $local = $confederacion::where('pais_id', $partido->pais_id_l)->first();
            $visita = $confederacion::where('pais_id', $partido->pais_id_v)->first();
            $pl = Pais::where('id', $partido->pais_id_l)->first();
            $pv = Pais::where('id', $partido->pais_id_v)->first();
            $gol_l = $this->_random(0, 6);
            $gol_v = $this->_random(0, 6);

            for ($i=1; $i < 11; $i++) {
                $accion = new StdClass;
                $accion->gol = 0;
                $accion->jugador_id = 0;
                $accion->juego_id = $partido->id;

                $lov = $this->_random(0, 1);
                $tiro = $this->_random(0, 1);

                $min = 0;
                $max = 0;
                switch ($i) {
                    case 1: $max = 9; $min = 1; break;
                    case 2: $max = 10; $min = 19; break;
                    case 3: $max = 20; $min = 29; break;
                    case 4: $max = 30; $min = 39; break;
                    case 5: $max = 40; $min = 49; break;
                    case 6: $max = 50; $min = 59; break;
                    case 7: $max = 60; $min = 69; break;
                    case 8: $max = 70; $min = 79; break;
                    case 9: $max = 80; $min = 89; break;
                    case 10: $max = 90; $min = 95; break;
                    default: break;
                }

                $minute = $this->_random($min, $max);

                $accion->minuto = $minute;

                if ($lov) {
                    $accion->posesion = 'L';
                    if ($tiro) {
                        $gol_l++;
                        $jugador = Jugador::where('pais_id', $partido->pais_id_l)->inRandomOrder()->first();
                        $accion->gol = 1;
                        $accion->jugador_id = $jugador->id;
                    }
                } else {
                    $accion->posesion = 'V';
                    if ($tiro) {
                        $gol_v++;
                        $jugador = Jugador::where('pais_id', $partido->pais_id_v)->inRandomOrder()->first();
                        $accion->gol = 1;
                        $accion->jugador_id = $jugador->id;
                    }
                }

                array_push($juego->acciones, $accion);
                //echo $i . '.- ' . $minute . '.'. $lov .'.'.$tiro.'<br>';
            }

            foreach ($juego->acciones as $accion) {
                LogJuego::create([
                    'historia_id' => $accion->juego_id,
                    'minuto' => $accion->minuto,
                    'posesion' => $accion->posesion,
                    'jugador_id' => $accion->jugador_id,
                    'gol' => $accion->gol
                ]);
            }

            Historia::where('id', $partido->id)->update(['gol_l' => $gol_l, 'gol_v' => $gol_v, 'activo' => 1]);

            $puntosL = 1;
            $puntosV = 1;
            $rankinL = 0;
            $rankinV = 0;

            if ($gol_l > $gol_v) {
                $puntosL = 3;
                $puntosV = 0;
                $local->pais->rankin++;
                $visita->pais->rankin--;
                $local->pais->jg++;
                $visita->pais->jp++;
                $local->jg++;
                $visita->jp++;
            }
            if ($gol_l < $gol_v) {
                $puntosL = 0;
                $puntosV = 3;
                $local->pais->rankin--;
                $visita->pais->rankin++;
                $local->pais->jp++;
                $visita->pais->jg++;
                $local->jp++;
                $visita->jg++;
            }
            if ($gol_l == $gol_v) {
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
            $local->gf = $local->gf + $gol_l;
            $local->gc = $local->gc + $gol_v;
            $local->pais->gf = $gol_l + $local->pais->gf;
            $local->pais->gc = $gol_v + $local->pais->gc;

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
            $visita->gf = $visita->gf + $gol_v;
            $visita->gc = $visita->gc + $gol_l;
            $visita->pais->gf = $gol_v + $visita->pais->gf;
            $visita->pais->gc = $gol_l + $visita->pais->gc;

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

            $this->_checarGrupo($partido);
        }
    }

    /**
     * Se llenan y asignan los numeros de biombo a los paises clasificados al mundial
     */
    protected function _crearBiombos() {
        $uefa = Uefa::where('posicion', 1)->get();
        foreach ($uefa as $pais) {
            Biombo::create([ 'pais_id' => $pais->pais_id, 'confederacion_id' => 1, 'rankin' => $pais->pais->rankin ]);
        }

        $conmebol = Conmebol::where('posicion', 1)->get();
        foreach ($conmebol as $pais) {
            Biombo::create([ 'pais_id' => $pais->pais_id, 'confederacion_id' => 2, 'rankin' => $pais->pais->rankin ]);
        }

        $concacaf = Concacaf::where('posicion', 1)->get();
        foreach ($concacaf as $pais) {
            Biombo::create([ 'pais_id' => $pais->pais_id, 'confederacion_id' => 3, 'rankin' => $pais->pais->rankin ]);
        }

        $caf = Caf::where('posicion', 1)->get();
        foreach ($caf as $pais) {
            Biombo::create([ 'pais_id' => $pais->pais_id, 'confederacion_id' => 4, 'rankin' => $pais->pais->rankin ]);
        }

        $afc = Afc::where('posicion', 1)->get();
        foreach ($afc as $pais) {
            Biombo::create([ 'pais_id' => $pais->pais_id, 'confederacion_id' => 6, 'rankin' => $pais->pais->rankin ]);
        }

        $repechaje = Repechaje::where('posicion', 1)->get();
        foreach ($repechaje as $pais) {
            Biombo::create([ 'pais_id' => $pais->pais_id, 'confederacion_id' => $pais->pais->confederacion->id, 'rankin' => $pais->pais->rankin ]);
        }

        $mundial = Mundial::where('activo', 1)->first();
        $conf = null;
        $anfitrion = false;

        switch ($mundial->pais->confederacion->id) {
            case 1: $conf = $uefa; break;
            case 2: $conf = $conmebol; break;
            case 3: $conf = $concacaf; break;
            case 4: $conf = $caf; break;
            case 5: $conf = $repechaje; break;
            case 6: $conf = $afc; break;
            default: break;
        }

        foreach ($conf as $pais) {
            if ($pais->pais_id == $mundial->pais_id) {
                $anfitrion = true;
                break;
            }
        }

        if ($anfitrion) {
            $paises = Pais::where('confederacion_id', 5)->inRandomOrder()->get();
            foreach ($paises as $pais) {
                $pais_biombo = Biombo::where('pais_id', $pais->id)->first();
                if (!$pais_biombo) {
                    Biombo::create([ 'pais_id' => $pais->id, 'confederacion_id' => 5, 'rankin' => $pais->rankin ]);
                    break;
                }
            }
        }else{
            Biombo::create([ 'pais_id' => $mundial->pais_id, 'confederacion_id' => $mundial->pais->confederacion_id, 'rankin' => $mundial->pais->rankin ]);
        }


        $biombo1 = Biombo::orderBy('rankin', 'DESC')->limit(8)->get();
        foreach ($biombo1 as $pais) {
            Biombo::where('pais_id', $pais->pais_id)->update( ['biombo' => 1] );
        }

        for ($i=2; $i < 5; $i++) {
            $paises_biombos = Biombo::whereNull('biombo')->orderBy('confederacion_id', 'ASC')->limit(8)->get();
            foreach ($paises_biombos as $pais) {
                Biombo::where('pais_id', $pais->pais_id)->update( ['biombo' => $i] );
            }
        }
    }

    protected function _ajustarNuevaFecha($date) {
        $fechaData = explode('-', $date);
        $fechaSeed = Carbon::createFromDate($fechaData[0], $fechaData[1], $fechaData[2]);
        $fechaInfo = explode(' ', $fechaSeed->add(4, 'year'));
        return $fechaInfo[0];
    }

    protected function _crearRepechaje() {
        $paises = [];
        $paises[0] = Concacaf::where('posicion', 0)->first();
        $paises[1] = Conmebol::where('posicion', 0)->first();
        $paises[2] = Afc::where('posicion', 0)->first();
        $paises[3] = Ofc::where('posicion', 0)->first();

        foreach ($paises as $k => $pais) {
            Repechaje::create([ 'pais_id' => $pais->pais_id ]);
        }
    }

    protected function _crearInternacionals() {
        for ($i=1; $i < 5; $i++) {
            $indGrupo = 1;
            $paises = Biombo::where('biombo', $i)->inRandomOrder()->get();
            foreach ($paises as $pais) {
                Internacional::create([ 'pais_id' => $pais->pais_id, 'grupo_id' => $indGrupo ]);
                $indGrupo++;
            }
        }
    }

    protected function _activarFaseRepechaje() {
        $fase_activa = FasesConfederacion::where([ ['confederacion_id', 7], ['activo', 1] ])->get();
        if ( count($fase_activa) == 0) {
            FasesConfederacion::where(['confederacion_id' => 7, 'fase_id' => 1])->update(['activo' => 1]);
        }
    }

    protected function _activarFaseMundial() {
        $fase_activa = FasesConfederacion::where([ ['confederacion_id', 8], ['activo', 1] ])->get();
        if ( count($fase_activa) == 0) {
            FasesConfederacion::where(['confederacion_id' => 8, 'fase_id' => 1])->update(['activo' => 1]);
        }
    }

    protected function _asignarGruposDeFaseRepechaje() {
        $conf = Confederacion::where('id', 7)->first();
        $for_init = 0;
        $for_end = 0;
        $ind = 0;
        $pais_id = 0;
        $confederacion = null;
        $paises = null;
        $fase = FasesConfederacion::where('confederacion_id', $conf->id)->where('activo', 1)->first();
        $grupos_fases = GruposFase::where([ ['confederacion_id', $conf->id], ['fase_id', $fase->fase_id] ])->get();

        $confederacion = $this->lib->asignarConfederacion($conf->nombre);

        $paises = $confederacion::whereNull('grupo_id')->inRandomOrder()->get();

        foreach ($grupos_fases as $k => $grupo) {
            $for_end = $for_end + $grupo->equipos;

            for ($i=$for_init; $i < $for_end; $i++) {
                $pais_id = $paises[$ind]->pais_id;
                $confederacion::where('pais_id', $pais_id)->update(['grupo_id' => $grupo->grupo->id]);
                $ind++;
            }

            $for_init = $for_init + $grupo->equipos;
        }
    }

    /**
     * regeresa un numero aleatorio entre un rando dado : (0-100)
     */
    protected function _random($init, $end) {
        $listNumbers = range($init, $end);
        shuffle($listNumbers);

        return $listNumbers[0];
    }
}
