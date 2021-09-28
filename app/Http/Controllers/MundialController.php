<?php

namespace App\Http\Controllers;

use App\Afc;
use App\Caf;
use App\Ofc;
use App\Pais;
use App\Uefa;
use App\Fecha;
use App\Biombo;
use App\Ciudad;
use App\Mundial;
use App\Concacaf;
use App\Conmebol;
use App\FasesLog;
use App\Historia;
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
use App\Internacional;
use App\JornadasGrupo;
use App\FasesConfederacion;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
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

    public function index() {
        $mundial = Mundial::where('activo', $this->const->true )->first();

        if (!$mundial) {
            $this->_createMundial();
            $this->_createConfederaciones();
            $this->_activarFase();
            $this->_asignarFaseEnConfederaciones();
            $this->_asignarGruposDeFase();
            $this->_crearFechas();
            $this->_crearPartidos();
            //$this->_jugarPartidos();
            $mundial = Mundial::where('activo', $this->const->true )->first();
        }

        $confederaciones = Confederacion::where('principal', $this->const->true)->get();
        $juego = Historia::where('activo', 0)->orderBy('fecha', 'ASC')->orderBy('id', 'ASC')->first();
        $anterior = Historia::where('activo', 1)->orderBy('fecha', 'DESC')->orderBy('id', 'DESC')->first();

        return view('mundial.index', compact('mundial','confederaciones','juego','anterior'));
    }

    /*
    - - - - FUNCIONES CRUD - - - - - -
    public function create() {}
    public function store(Request $request) {}
    public function show(Mundial $mundial) {}
    public function edit(Mundial $mundial) {}
    public function update(Request $request, Mundial $mundial) {}
    public function destroy(Mundial $mundial) {}
    */

    /**
     * crea el nuevo torneo mundial
     */
    protected function _createMundial() {
        $mundial = Mundial::orderBy('id', 'DESC')->get();
        $info_mundial = new Mundial;
        $confederacion = Confederacion::all();
        $confederacion_temp = '';
        $pais_id = 0;

        if (count($mundial) == 0) {
            $confederacion_temp = $confederacion[0];
            $anio = 1900;
        }else{
            $confederacionId = ($mundial[0]->pais->confederacion_id == 6) ? 0 : $mundial[0]->pais->confederacion_id ;
            $confederacion_temp = $confederacion[ $confederacionId ];
            $anio = $mundial[0]->anio + 4;
        }

        $ind = $this->_random(0, (count( $confederacion_temp->paises ) - 1));

        $info_mundial->create([
            'pais_id' => $confederacion_temp->paises[ $ind ]->id,
            'anio' => $anio,
            'activo' => 1
        ]);
    }

    /**
     * llena cada confederacion con sus respectivos paises
     */
    protected function _createConfederaciones() {
        $confederaciones = Confederacion::all();
        $confederacion = null;

        foreach ($confederaciones as $key => $conf) {

            $confederacion = $this->lib->asignarConfederacion($conf->nombre);

            foreach ($conf->paises as $k => $pais) {
                $confederacion->create([
                    'pais_id' => $pais->id,
                ]);
            }

        }
    }

    /**
     * Activa la fase por primera vez a todas las confederaciones
     */
    protected function _activarFase() {
        $confederaciones = Confederacion::where('principal', 1)->get();

        foreach ($confederaciones as $key => $conf) {
            $fase_activa = FasesConfederacion::where([ ['confederacion_id', $conf->id], ['activo', 1], ])->get();
            if ( count($fase_activa) == 0) {
                FasesConfederacion::where(['confederacion_id' => $conf->id, 'fase_id' => 1])->update(['activo' => 1]);
            }
        }
    }

    /**
     * Asigan el Id de la Fase-Confederacion activo a todos los equipos de la confederacion
     */
    protected function _asignarFaseEnConfederaciones(){
        $fases_activas = FasesConfederacion::where('activo', 1)->get();

        foreach ($fases_activas as $key => $fase) {
            $confederacion = null;
            $paises = null;

            switch ($fase->confederacion->nombre) {
                case 'UEFA':
                    $confederacion = new Uefa;
                    $paises = Pais::where('confederacion_id', $fase->confederacion->id)->inRandomOrder()->get();
                    break;
                case 'CONMEBOL':
                    $confederacion = new Conmebol;
                    $paises = Pais::where('confederacion_id', $fase->confederacion->id)->inRandomOrder()->get();
                    break;
                case 'CONCACAF':
                    $confederacion = new Concacaf;
                    $paises = Pais::where('confederacion_id', $fase->confederacion->id)->orderBy('rankin', 'ASC')->limit(30)->get();
                    break;
                case 'CAF':
                    $confederacion = new Caf;
                    $paises = Pais::where('confederacion_id', $fase->confederacion->id)->orderBy('rankin', 'ASC')->limit(28)->get();
                    break;
                case 'OFC':
                    $confederacion = new Ofc;
                    $paises = Pais::where('confederacion_id', $fase->confederacion->id)->inRandomOrder()->get();
                    break;
                case 'AFC':
                    $confederacion = new Afc;
                    $paises = Pais::where('confederacion_id', $fase->confederacion->id)->orderBy('rankin', 'ASC')->limit(12)->get();
                    break;
                case 'REPECHAJE':
                    $confederacion = new Repechaje;
                    $paises = Repechaje::inRandomOrder()->get();
                    break;
                case 'MUNDIAL':
                    $confederacion = new Internacional;
                    $paises = Internacional::all();
                    break;
                default:
                    break;
            }

            foreach ($paises as $pais) {
                if ($fase->confederacion->nombre == 'REPECHAJE' || $fase->confederacion->nombre == 'MUNDIAL') {
                    $confederacion::where('pais_id', $pais->pais_id)->update(['fase_confederacion_id' => $fase->id]);
                }else{
                    $confederacion::where('pais_id', $pais->id)->update(['fase_confederacion_id' => $fase->id]);
                }
            }

        }
    }

     /**
     * Asigna el grupo correspondiente a cada equipo de la confederacion
     */
    protected function _asignarGruposDeFase() {
        $confederaciones = Confederacion::where('principal', 1)->get();
        foreach ($confederaciones as $key => $conf) {
            $for_init = 0;
            $for_end = 0;
            $ind = 0;
            $pais_id = 0;
            $confederacion = null;
            $paises = null;
            $fase = FasesConfederacion::where('confederacion_id', $conf->id)->where('activo', 1)->first();
            $grupos_fases = GruposFase::where([ ['confederacion_id', $conf->id], ['fase_id', $fase->fase_id] ])->get();

            $confederacion = $this->lib->asignarConfederacion($conf->nombre);

            $paises = $confederacion::where('fase_confederacion_id', '<>', null)->inRandomOrder()->get();

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
    }

    /**
     * Crea las fechas para cada una de las jornadas de las eliminatorias
     */
    protected function _crearFechas() {
        $confederaciones = Confederacion::all();

        foreach ($confederaciones as $conf) {
            $tipo = 'A';
            if ($conf->id == 7){ $tipo = 'B'; }
            if ($conf->id == 8){ $tipo = 'C'; }
            $fecha_limite = FechaLimite::where('tipo', $tipo)->first();
            $rango_dias = 0;
            $confId = 0;

            switch ($conf->nombre) {
                case 'UEFA':
                    $rango_dias = 82;
                    break;
                case 'CONMEBOL':
                    $rango_dias = 63;
                    break;
                case 'CONCACAF':
                    $rango_dias = 42;
                    break;
                case 'CAF':
                    $rango_dias = 119;
                    break;
                case 'OFC':
                    $rango_dias = 82;
                    break;
                case 'AFC':
                    $rango_dias = 46;
                    break;
                case 'REPECHAJE':
                    $rango_dias = 15;
                    break;
                case 'MUNDIAL':
                    $rango_dias = 12;
                    break;
                default:
                    break;
            }

            $jornadas = Fecha::where('confederacion_id', $conf->id)->get();
            $fechaData = explode('-', $fecha_limite->fecha);
            $fechaSeed = Carbon::createFromDate($fechaData[0], $fechaData[1], $fechaData[2]);
            $fechaInfo = $fechaSeed;

            foreach ($jornadas as $k => $jornada) {
                if ($confId != $conf->id) {
                    $confId = $conf->id;
                }else{
                    $fechaInfo = $fechaInfo->add($rango_dias, 'day');
                }

                $fechaLog = explode(' ', $fechaInfo);
                $fechaTemp = explode('-', $fechaLog[0]);

                Fecha::where('confederacion_id', $conf->id)->where('jornada_id', $jornada->jornada_id)->where('fase_id', $jornada->fase_id)->update(['fecha' => Carbon::createFromDate($fechaTemp[0], $fechaTemp[1], $fechaTemp[2])]);
            }

        }

    }

    /**
     * Crea los partidos de cada confederacion
     */
    protected function _crearPartidos() {
        $mundial = Mundial::where('activo', 1)->first();
        $fases_confederacion = FasesConfederacion::where('activo', 1)->get();

        foreach ($fases_confederacion as $rel) {
            $grupos_fase = GruposFase::where(['confederacion_id' => $rel->confederacion_id, 'fase_id' => $rel->fase_id])->get();
            foreach ($grupos_fase as $rel_grupo) {
                $confederacion = $this->lib->asignarConfederacion($rel_grupo->confederacion->nombre);
                $paises = $confederacion::where('grupo_id', $rel_grupo->grupo->id)->inRandomOrder()->get();

                $tabla_jornadas = null;

                switch ($rel_grupo->equipos) {
                    case '2':
                        $tabla_jornadas = DosEquipo::all();
                        break;
                    case '3':
                        $tabla_jornadas = TresEquipo::all();
                        break;
                    case '4':
                        $tabla_jornadas = CuatroEquipo::all();
                        break;
                    case '5':
                        $tabla_jornadas = CincoEquipo::all();
                        break;
                    case '6':
                        $tabla_jornadas = SeisEquipo::all();
                        break;
                    case '8':
                        $tabla_jornadas = OchoEquipo::all();
                        break;
                    case '10':
                        $tabla_jornadas = DiezEquipo::all();
                        break;
                    default:
                        # code...
                        break;
                }

                foreach ($tabla_jornadas as $jornada) {
                    $fecha = Fecha::where(['confederacion_id' => $rel->confederacion_id, 'fase_id' => $rel->fase_id, 'jornada_id' => $jornada->jornada_id])->first();

                    $data = [
                        'mundial_id' => $mundial->id,
                        'confederacion_id' => $rel->confederacion_id,
                        'fase_id' => $rel->fase_id,
                        'jornada_id' => $jornada->jornada_id,
                        'grupo_id' => $rel_grupo->grupo->id,
                        'fecha' => $this->_ajustarFecha($fecha->fecha)
                    ];

                    if ($rel_grupo->equipos == 2 || $rel_grupo->equipos == 3) {
                        $local = $paises[$jornada->pos1]->pais;
                        $visita = $paises[$jornada->pos2]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        if ($jornada->jornada_id == 1 && $rel->confederacion_id == 8) {
                            break;
                        }

                    }

                    if ($rel_grupo->equipos == 4 || $rel_grupo->equipos == 5) {
                        $local = $paises[$jornada->pos1]->pais;
                        $visita = $paises[$jornada->pos2]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        $local = $paises[$jornada->pos3]->pais;
                        $visita = $paises[$jornada->pos4]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        if ($jornada->jornada_id == 3 && $rel->confederacion_id == 8) {
                            break;
                        }

                    }

                    if ($rel_grupo->equipos == 6) {
                        $local = $paises[$jornada->pos1]->pais;
                        $visita = $paises[$jornada->pos2]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        $local = $paises[$jornada->pos3]->pais;
                        $visita = $paises[$jornada->pos4]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        $local = $paises[$jornada->pos5]->pais;
                        $visita = $paises[$jornada->pos6]->pais;
                        $this->_guardarPartido($data, $local, $visita);
                    }

                    if ($rel_grupo->equipos == 8) {
                        $local = $paises[$jornada->pos1]->pais;
                        $visita = $paises[$jornada->pos2]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        $local = $paises[$jornada->pos3]->pais;
                        $visita = $paises[$jornada->pos4]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        $local = $paises[$jornada->pos5]->pais;
                        $visita = $paises[$jornada->pos6]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        $local = $paises[$jornada->pos7]->pais;
                        $visita = $paises[$jornada->pos8]->pais;
                        $this->_guardarPartido($data, $local, $visita);
                    }

                    if ($rel_grupo->equipos == 10) {
                        $local = $paises[$jornada->pos1]->pais;
                        $visita = $paises[$jornada->pos2]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        $local = $paises[$jornada->pos3]->pais;
                        $visita = $paises[$jornada->pos4]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        $local = $paises[$jornada->pos5]->pais;
                        $visita = $paises[$jornada->pos6]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        $local = $paises[$jornada->pos7]->pais;
                        $visita = $paises[$jornada->pos8]->pais;
                        $this->_guardarPartido($data, $local, $visita);

                        $local = $paises[$jornada->pos9]->pais;
                        $visita = $paises[$jornada->pos10]->pais;
                        $this->_guardarPartido($data, $local, $visita);
                    }

                }

            }

            FasesConfederacion::where(['confederacion_id' => $rel->confederacion_id, 'fase_id' => $rel->fase_id])->update(['activo' => 2]);
        }

    }


    public function jugar(Historia $partido) {
        // $partidos = Historia::where('activo', 0)->orderBy('fecha', 'ASC')->get();

        // if(count($partidos) == 0){
        //     $repechaje = FasesConfederacion::where(['confederacion_id' => 7, 'activo' => 0])->first();

        //     if ($repechaje) {
        //         $this->_crearRepechaje();
        //         $this->_activarFaseRepechaje();
        //         $this->_asignarFaseEnConfederaciones();
        //         $this->_asignarGruposDeFaseRepechaje();
        //         $this->_crearPartidos();
        //         $this->_jugarPartidos();
        //     }else{
        //         $mundial = FasesConfederacion::where(['confederacion_id' => 8, 'activo' => 0])->first();
        //         if ($mundial) {
        //             $this->_crearBiombos();
        //             $this->_crearInternacionals();
        //             $this->_activarFaseMundial();
        //             $this->_asignarFaseEnConfederaciones();
        //             $this->_crearPartidos();
        //             $this->_jugarPartidos();
        //         }else{
        //             $campeon = Internacional::whereNull('posicion')->first();
        //             Mundial::where('activo', 1)->update([ 'activo' => 0, 'campeon' => $campeon->pais_id]);
        //             Uefa::truncate();
        //             Conmebol::truncate();
        //             Concacaf::truncate();
        //             Caf::truncate();
        //             Ofc::truncate();
        //             Afc::truncate();
        //             Repechaje::truncate();
        //             Biombo::truncate();
        //             Internacional::truncate();
        //             FasesConfederacion::where('activo', 2)->update([ 'activo' => 0]);

        //             $fechas_limit = FechaLimite::all();
        //             foreach ($fechas_limit as $fecha) {
        //                 $newFecha = $this->_ajustarNuevaFecha($fecha->fecha);
        //                 FechaLimite::where('tipo', $fecha->tipo)->update([ 'fecha' => $newFecha ]);
        //             }
        //             echo 'Se acabo el mundial'; exit;
        //         }
        //     }
        // }

        $confederacion = $this->lib->asignarConfederacion($partido->confederacion->nombre);
        $local = $confederacion::where('pais_id', $partido->pais_id_l)->first();
        $visita = $confederacion::where('pais_id', $partido->pais_id_v)->first();
        $pl = Pais::where('id', $partido->pais_id_l)->first();
        $pv = Pais::where('id', $partido->pais_id_v)->first();
        $gol_l = $this->_random(0, 6);
        $gol_v = $this->_random(0, 6);
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

        return redirect()->action('MundialController@index');
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
                $this->_asignarFaseEnConfederaciones();
                $this->_asignarGruposDeFaseRepechaje();
                $this->_crearPartidos();
                $this->_jugarPartidos();
            }else{
                $mundial = FasesConfederacion::where(['confederacion_id' => 8, 'activo' => 0])->first();
                if ($mundial) {
                    $this->_crearBiombos();
                    $this->_crearInternacionals();
                    $this->_activarFaseMundial();
                    $this->_asignarFaseEnConfederaciones();
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

            $confederacion = $this->lib->asignarConfederacion($partido->confederacion->nombre);
            $local = $confederacion::where('pais_id', $partido->pais_id_l)->first();
            $visita = $confederacion::where('pais_id', $partido->pais_id_v)->first();
            $pl = Pais::where('id', $partido->pais_id_l)->first();
            $pv = Pais::where('id', $partido->pais_id_v)->first();
            $gol_l = $this->_random(0, 6);
            $gol_v = $this->_random(0, 6);
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

    /**
     * checa si quedan partidos activos segun la fase
     */
    protected function _checarGrupo($partido) {
        $check = Historia::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id, 'activo' => 0 ])->get();

        if (count($check) == 0) {
            $confederacion = $this->lib->asignarConfederacion($partido->confederacion->nombre);

            $this->_guardarFaseConfederacion($confederacion, $partido->confederacion->id, $partido->fase_id);

            if($partido->confederacion_id == 4 || $partido->confederacion_id == 6) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $this->_eliminarUnEquipo($grupos, $confederacion);
                }
            }

            if($partido->confederacion_id == 1 || $partido->confederacion_id == 5) {
                if($partido->fase_id == 2) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $this->_eliminarUnEquipo($grupos, $confederacion);
                }
            }

            if($partido->confederacion_id == 3) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificado($confederacion, $paises[0]);

                        $limit = count($paises);

                        for ($i=1; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }
                }

                if($partido->fase_id == 2){
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $this->_eliminarUnEquipo($grupos, $confederacion);
                }

                if($partido->fase_id == 3){
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[1]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[2]);
                        $this->_limpiarClasificadoRepechaje($confederacion, $paises[3]);

                        $limit = count($paises);

                        for ($i=4; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }
                }
            }

            if($partido->confederacion_id == 6) {
                if($partido->fase_id == 2) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $subs = [];
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificado($confederacion, $paises[0]);

                        $limit = count($paises);

                        for ($i=1; $i < $limit ; $i++) {
                            if ($i == 1) {
                                $subs[$paises[$i]->pais_id] = $paises[$i]->puntos;
                            }else{
                                $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                            }
                        }
                    }

                    arsort($subs);

                    $indSubs = 0;
                    foreach ($subs as $key => $value) {
                        $pais = $confederacion::where('pais_id', $key)->first();

                        if ($indSubs < 4) {
                            $this->_limpiarClasificado($confederacion, $pais);
                        }else{
                            $confederacion::where('pais_id', $pais->pais_id)->delete();
                        }
                        $indSubs++;
                    }
                }

                if($partido->fase_id == 3) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();

                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[1]);
                        $this->_limpiarClasificado($confederacion, $paises[2]);

                        $limit = count($paises);

                        for ($i=3; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }

                }

                if($partido->fase_id == 4) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
                        $this->_limpiarClasificadoRepechaje($confederacion, $paises[0]);
                        $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
                    }
                }
            }

            if($partido->confederacion_id == 5) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $subs = [];
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificado($confederacion, $paises[0]);
                        $this->_limpiarClasificado($confederacion, $paises[1]);

                        $limit = count($paises);

                        for ($i=2; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }
                }

                if($partido->fase_id == 3) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
                        $this->_limpiarClasificadoRepechaje($confederacion, $paises[0]);
                        $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
                    }
                }
            }

            if($partido->confederacion_id == 1) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $subs = [];
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $this->_limpiarClasificado($confederacion, $paises[1]);

                        $limit = count($paises);

                        for ($i=2; $i < $limit ; $i++) {
                            if ($i == 2) {
                                $subs[$paises[$i]->pais_id] = $paises[$i]->puntos;
                            }else{
                                $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                            }
                        }
                    }


                    arsort($subs);

                    $indSubs = 0;
                    foreach ($subs as $key => $value) {
                        $pais = $confederacion::where('pais_id', $key)->first();

                        if ($indSubs < 2) {
                            $this->_limpiarClasificado($confederacion, $pais);
                        }else{
                            $confederacion::where('pais_id', $pais->pais_id)->delete();
                        }
                        $indSubs++;
                    }

                }

                if($partido->fase_id == 3) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
                    }
                }
            }

            if($partido->confederacion_id == 4) {
                if($partido->fase_id == 2) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();

                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificado($confederacion, $paises[0]);

                        $limit = count($paises);

                        for ($i=1; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }
                }

                if($partido->fase_id == 3) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
                    }
                }
            }

            if($partido->confederacion_id == 2) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[1]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[2]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[3]);
                        $this->_limpiarClasificadoRepechaje($confederacion, $paises[4]);

                        $limit = count($paises);

                        for ($i=5; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }
                }
            }

            if($partido->confederacion_id == 7) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
                    }
                }
            }

            if($partido->confederacion_id == 8) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificado($confederacion, $paises[0]);
                        $this->_limpiarClasificado($confederacion, $paises[1]);
                        $confederacion::where('pais_id', $paises[2]->pais_id)->delete();
                        $confederacion::where('pais_id', $paises[3]->pais_id)->delete();
                    }
                }

                if($partido->fase_id > 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $this->_eliminarUnEquipo($grupos, $confederacion);
                }
            }

            $this->_siguienteFase($partido->confederacion_id);
            $this->_asignarFaseEnConfederacion($partido->confederacion_id);
            $this->_asignarGruposDeSiguienteFase($partido->confederacion);
            $this->_crearPartidos();
            //$this->_jugarPartidos();
            return redirect()->action('MundialController@index');
        }
    }

    public function checarGrupo($partido) {
        $check = Historia::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id, 'activo' => 0 ])->get();

        if (count($check) == 0) {
            $confederacion = $this->lib->asignarConfederacion($partido->confederacion->nombre);

            $this->_guardarFaseConfederacion($confederacion, $partido->confederacion->id, $partido->fase_id);

            if($partido->confederacion_id == 4 || $partido->confederacion_id == 6) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $this->_eliminarUnEquipo($grupos, $confederacion);
                }
            }

            if($partido->confederacion_id == 1 || $partido->confederacion_id == 5) {
                if($partido->fase_id == 2) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $this->_eliminarUnEquipo($grupos, $confederacion);
                }
            }

            if($partido->confederacion_id == 3) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificado($confederacion, $paises[0]);

                        $limit = count($paises);

                        for ($i=1; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }
                }

                if($partido->fase_id == 2){
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $this->_eliminarUnEquipo($grupos, $confederacion);
                }

                if($partido->fase_id == 3){
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[1]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[2]);
                        $this->_limpiarClasificadoRepechaje($confederacion, $paises[3]);

                        $limit = count($paises);

                        for ($i=4; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }
                }
            }

            if($partido->confederacion_id == 6) {
                if($partido->fase_id == 2) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $subs = [];
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificado($confederacion, $paises[0]);

                        $limit = count($paises);

                        for ($i=1; $i < $limit ; $i++) {
                            if ($i == 1) {
                                $subs[$paises[$i]->pais_id] = $paises[$i]->puntos;
                            }else{
                                $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                            }
                        }
                    }

                    arsort($subs);

                    $indSubs = 0;
                    foreach ($subs as $key => $value) {
                        $pais = $confederacion::where('pais_id', $key)->first();

                        if ($indSubs < 4) {
                            $this->_limpiarClasificado($confederacion, $pais);
                        }else{
                            $confederacion::where('pais_id', $pais->pais_id)->delete();
                        }
                        $indSubs++;
                    }
                }

                if($partido->fase_id == 3) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();

                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[1]);
                        $this->_limpiarClasificado($confederacion, $paises[2]);

                        $limit = count($paises);

                        for ($i=3; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }

                }

                if($partido->fase_id == 4) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
                        $this->_limpiarClasificadoRepechaje($confederacion, $paises[0]);
                        $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
                    }
                }
            }

            if($partido->confederacion_id == 5) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $subs = [];
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificado($confederacion, $paises[0]);
                        $this->_limpiarClasificado($confederacion, $paises[1]);

                        $limit = count($paises);

                        for ($i=2; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }
                }

                if($partido->fase_id == 3) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
                        $this->_limpiarClasificadoRepechaje($confederacion, $paises[0]);
                        $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
                    }
                }
            }

            if($partido->confederacion_id == 1) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $subs = [];
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $this->_limpiarClasificado($confederacion, $paises[1]);

                        $limit = count($paises);

                        for ($i=2; $i < $limit ; $i++) {
                            if ($i == 2) {
                                $subs[$paises[$i]->pais_id] = $paises[$i]->puntos;
                            }else{
                                $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                            }
                        }
                    }


                    arsort($subs);

                    $indSubs = 0;
                    foreach ($subs as $key => $value) {
                        $pais = $confederacion::where('pais_id', $key)->first();

                        if ($indSubs < 2) {
                            $this->_limpiarClasificado($confederacion, $pais);
                        }else{
                            $confederacion::where('pais_id', $pais->pais_id)->delete();
                        }
                        $indSubs++;
                    }

                }

                if($partido->fase_id == 3) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
                    }
                }
            }

            if($partido->confederacion_id == 4) {
                if($partido->fase_id == 2) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();

                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificado($confederacion, $paises[0]);

                        $limit = count($paises);

                        for ($i=1; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }
                }

                if($partido->fase_id == 3) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
                    }
                }
            }

            if($partido->confederacion_id == 2) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[1]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[2]);
                        $this->_limpiarClasificadoMundial($confederacion, $paises[3]);
                        $this->_limpiarClasificadoRepechaje($confederacion, $paises[4]);

                        $limit = count($paises);

                        for ($i=5; $i < $limit ; $i++) {
                            $confederacion::where('pais_id', $paises[$i]->pais_id)->delete();
                        }
                    }
                }
            }

            if($partido->confederacion_id == 7) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
                        $this->_limpiarClasificadoMundial($confederacion, $paises[0]);
                        $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
                    }
                }
            }

            if($partido->confederacion_id == 8) {
                if($partido->fase_id == 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $paises = null;

                    foreach ($grupos as $grupo) {
                        $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                        $this->_limpiarClasificado($confederacion, $paises[0]);
                        $this->_limpiarClasificado($confederacion, $paises[1]);
                        $confederacion::where('pais_id', $paises[2]->pais_id)->delete();
                        $confederacion::where('pais_id', $paises[3]->pais_id)->delete();
                    }
                }

                if($partido->fase_id > 1) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $this->_eliminarUnEquipo($grupos, $confederacion);
                }
            }

            $this->_siguienteFase($partido->confederacion_id);
            $this->_asignarFaseEnConfederacion($partido->confederacion_id);
            $this->_asignarGruposDeSiguienteFase($partido->confederacion);
            $this->_crearPartidos();
            //$this->_jugarPartidos();
            // return redirect()->action('MundialController@index');
        }
    }

    /**
     *
     */
    public function _guardarFaseConfederacion($confederacion, $confederacionId, $faseId) {
        $mundial = Mundial::where('activo', 1)->first();

        $paises_grupo = $confederacion::whereNotNull('fase_confederacion_id')->whereNotNull('grupo_id')->get();

        foreach ($paises_grupo as $key => $data) {
            FasesLog::create([
                'mundial_id' => $mundial->id,
                'confederacion_id' => $confederacionId,
                'fase_id' => $faseId,
                'grupo_id' => $data->grupo_id,
                'pais_id' => $data->pais_id,
                'puntos' => $data->puntos,
                'jj' => $data->jj,
                'jg' => $data->jg,
                'je' => $data->je,
                'jp' => $data->jp,
                'gf' => $data->gf,
                'gc' => $data->gc
            ]);
        }
    }

    /**
     * asigna la nueva fase en la confederacion
     */
    protected function _asignarFaseEnConfederacion($confederacionId){
        $fase = FasesConfederacion::where(['confederacion_id' => $confederacionId, 'activo' => 1])->first();
        $confederacion = $this->lib->asignarConfederacion($fase->confederacion->nombre);
        $paises = null;

        switch ($fase->confederacion->nombre) {
            case 'UEFA':
                if ($fase->fase_id == 2 || $fase->fase_id == 3) {
                    $paises = Uefa::whereNull('posicion')->inRandomOrder()->get();
                }
                break;
            case 'CONCACAF':
                if ($fase->fase_id == 2) {
                    $paises = Concacaf::where('posicion', 2)->inRandomOrder()->limit(6)->get();
                }
                if ($fase->fase_id == 3) {
                    $paises = Concacaf::inRandomOrder()->get();
                }
                break;
            case 'CAF':
                $paises = Caf::inRandomOrder()->get();
                break;
            case 'OFC':
                $paises = Ofc::inRandomOrder()->get();
                break;
            case 'AFC':
                if ($fase->fase_id == 4) {
                    $paises = Afc::whereNull('posicion')->inRandomOrder()->get();
                }else{
                    $paises = Afc::inRandomOrder()->get();
                }
                break;
            case 'MUNDIAL':
                $paises = Internacional::inRandomOrder()->get();
                break;
            default:
                break;
        }

        foreach ($paises as $pais) {
            $confederacion::where('pais_id', $pais->pais_id)->update(['fase_confederacion_id' => $fase->id, 'posicion' => NULL]);
        }
    }

    /**
     * Asigna el grupo de la siguiente fase
     */
    protected function _asignarGruposDeSiguienteFase($conf) {
        $for_init = 0;
        $for_end = 0;
        $ind = 0;
        $pais_id = 0;
        $confederacion = null;
        $paises = null;
        $fase = FasesConfederacion::where('confederacion_id', $conf->id)->where('activo', 1)->first();
        $grupos_fases = GruposFase::where([ ['confederacion_id', $conf->id], ['fase_id', $fase->fase_id] ])->get();

        $confederacion = $this->lib->asignarConfederacion($conf->nombre);

        if ($conf->id == 1) {
            if($fase->fase_id == 2 || $fase->fase_id == 3){
                $paises = $confederacion::whereNull('posicion')->inRandomOrder()->get();
            }
        }

        if ($conf->id == 4 || $conf->id == 5 || $conf->id == 6) {
            if($fase->fase_id == 2){
                $paises = $confederacion::inRandomOrder()->get();
            }
        }


        if ($conf->id == 4 || $conf->id == 5 || $conf->id == 6) {
            if($fase->fase_id == 3){
                $paises = $confederacion::inRandomOrder()->get();
            }
        }

        if ($conf->id == 3) {
            if($fase->fase_id == 2){
                $paises = $confederacion::whereNotNull('fase_confederacion_id')->get();
            }

            if($fase->fase_id == 3){
                $paises = $confederacion::inRandomOrder()->get();
            }
        }

        if ($conf->id == 6) {
            if($fase->fase_id == 4){
                $paises = $confederacion::whereNull('posicion')->inRandomOrder()->get();
            }
        }

        if ($conf->id == 8) {
            if($fase->fase_id > 1){
                $paises = $confederacion::inRandomOrder()->get();
            }
        }


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
     * actualiza la siguiente fsae
     */
    protected function _siguienteFase($confederacionId) {
        $nextFase = FasesConfederacion::where(['confederacion_id' => $confederacionId, 'activo' => 0])->orderBy('fase_id', 'ASC')->first();

        if ($nextFase) {
            FasesConfederacion::where(['confederacion_id' => $confederacionId, 'fase_id' => $nextFase->fase_id])->update(['activo' => 1]);
        }else{
            $this->_jugarPartidos();
        }
    }


    /**
     * Guarda el partido creado
     */
    protected function _guardarPartido($data, $local, $visita) {
        Historia::create([
            'mundial_id' => $data['mundial_id'],
            'confederacion_id' => $data['confederacion_id'],
            'fase_id' => $data['fase_id'],
            'jornada_id' => $data['jornada_id'],
            'grupo_id' => $data['grupo_id'],
            'fecha' => $data['fecha'],
            'pais_id_l' => $local->id,
            'pais_id_v' => $visita->id,
            'ciudad_id' => $this->_obtenerCiudad($local->id),
            'tag' => $local->siglas.$visita->siglas,
        ]);
    }

    /**
     * Ajusta la fecha para el partido
     */
    protected function _ajustarFecha($date) {
        $fechaData = explode('-', $date);
        $fechaSeed = Carbon::createFromDate($fechaData[0], $fechaData[1], $fechaData[2]);

        if ($this->_random(0, 1) == 0) {
            $fechaInfo = explode(' ', $fechaSeed->add($this->_random(0, 7), 'day'));
        } else {
            $fechaInfo = explode(' ', $fechaSeed->sub($this->_random(0, 7), 'day'));
        }
        return $fechaInfo[0];
    }


    protected function _ajustarNuevaFecha($date) {
        $fechaData = explode('-', $date);
        $fechaSeed = Carbon::createFromDate($fechaData[0], $fechaData[1], $fechaData[2]);
        $fechaInfo = explode(' ', $fechaSeed->add(4, 'year'));
        return $fechaInfo[0];
    }

    /**
     * Obtiene la ciudad para el partido
     */
    protected function _obtenerCiudad($pais_id) {
        $ciudad = Ciudad::where('pais_id', $pais_id)->inRandomOrder()->first();
        return $ciudad->id;
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

    protected function _limpiarClasificado($confederacion, $pais) {
        $confederacion::where('pais_id', $pais->pais_id)->update([
            'fase_confederacion_id' => null,
            'grupo_id' => null,
            'puntos' => 0,
            'jj' => 0,
            'jg' => 0,
            'je' => 0,
            'jp' => 0,
            'gf' => 0,
            'gc' => 0,
            'posicion' => ($pais->pais->confederacion->id == 3) ? '2' : NULL
        ]);
    }

    protected function _limpiarClasificadoMundial($confederacion, $pais) {
        $confederacion::where('pais_id', $pais->pais_id)->update([
            'fase_confederacion_id' => null,
            'grupo_id' => null,
            'puntos' => 0,
            'jj' => 0,
            'jg' => 0,
            'je' => 0,
            'jp' => 0,
            'gf' => 0,
            'gc' => 0,
            'posicion' => 1
        ]);
    }

    protected function _limpiarClasificadoRepechaje($confederacion, $pais) {
        $confederacion::where('pais_id', $pais->pais_id)->update([
            'fase_confederacion_id' => null,
            'grupo_id' => null,
            'puntos' => 0,
            'jj' => 0,
            'jg' => 0,
            'je' => 0,
            'jp' => 0,
            'gf' => 0,
            'gc' => 0,
            'posicion' => 0
        ]);
    }

    protected function _eliminarUnEquipo($grupos, $confederacion) {
        foreach ($grupos as $grupo) {
            $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
            $this->_limpiarClasificado($confederacion, $paises[0]);

            $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
        }
    }
}
