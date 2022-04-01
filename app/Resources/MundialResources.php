<?php

namespace App\Resources;

use App\Afc;
use App\Caf;
use App\Ofc;
use App\Fase;
use App\Pais;
use App\Uefa;
use stdClass;
use App\Fecha;
use App\Image;
use App\Ciudad;
use App\Jornada;
use App\Jugador;
use App\Mundial;
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
use App\Internacional;
use App\FasesConfederacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MundialResources {
    public $true = 1;
    public $false = 0;
    public $desc = 'DESC';
    public $asc = 'ASC';
    public $_activo = 'activo';
    public $_id = 'id';


    /**
     * crea el nuevo torneo mundial
     */
    public function createMundial() {
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

        $ind = $this->random(0, (count( $confederacion_temp->paises ) - 1));

        $info_mundial->create([
            'pais_id' => $confederacion_temp->paises[ $ind ]->id,
            'anio' => $anio,
            'activo' => 1
        ]);
    }

    /**
     * llena cada confederacion con sus respectivos paises
     */
    public function createConfederaciones() {
        $confederaciones = Confederacion::all();
        $confederacion = null;

        foreach ($confederaciones as $key => $conf) {

            $confederacion = $this->asignarConfederacion($conf->nombre);

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
    public function activarFase() {
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
    public function asignarFaseEnConfederaciones(){
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
    public function asignarGruposDeFase() {
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

            $confederacion = $this->asignarConfederacion($conf->nombre);

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
    public function crearFechas() {
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
    public function crearPartidos() {
        $mundial = Mundial::where('activo', 1)->first();
        $fases_confederacion = FasesConfederacion::where('activo', 1)->get();

        foreach ($fases_confederacion as $rel) {
            $grupos_fase = GruposFase::where(['confederacion_id' => $rel->confederacion_id, 'fase_id' => $rel->fase_id])->get();
            foreach ($grupos_fase as $rel_grupo) {
                $confederacion = $this->asignarConfederacion($rel_grupo->confederacion->nombre);
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
                    //$finalFecha = Carbon::createFromDate($fechaSeedX[0], $fechaSeedX[1], $fechaSeedX[2]);
                    $data = [
                        'mundial_id' => $mundial->id,
                        'confederacion_id' => $rel->confederacion_id,
                        'fase_id' => $rel->fase_id,
                        'jornada_id' => $jornada->jornada_id,
                        'grupo_id' => $rel_grupo->grupo->id,
                        'fecha' => $fecha->fecha
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

    /**
     * checa si quedan partidos activos segun la fase
     */
    public function checarGrupo($partido) {
        $check = Historia::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id, 'activo' => 0 ])->get();

        if (count($check) == 0) {
            $confederacion = $this->asignarConfederacion($partido->confederacion->nombre);

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
                if($partido->fase_id == 6) {
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
                if($partido->fase_id == 7) {
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

                if($partido->fase_id > 7) {
                    $grupos = GruposFase::where([ 'confederacion_id' => $partido->confederacion_id, 'fase_id' => $partido->fase_id ])->get();
                    $this->_eliminarUnEquipo($grupos, $confederacion);
                }
            }

            $this->_siguienteFase($partido->confederacion_id);
            $this->_asignarFaseEnConfederacion($partido->confederacion_id);
            $this->_asignarGruposDeSiguienteFase($partido->confederacion);
            $this->crearPartidos();
            //$this->_jugarPartidos();
        }
    }

     /**
     * actualiza la siguiente fsae
     */
    public function _siguienteFase($confederacionId) {
        $nextFase = FasesConfederacion::where(['confederacion_id' => $confederacionId, 'activo' => 0])->orderBy('fase_id', 'ASC')->first();

        if ($nextFase) {
            FasesConfederacion::where(['confederacion_id' => $confederacionId, 'fase_id' => $nextFase->fase_id])->update(['activo' => 1]);
        }else{
            //$this->_jugarPartidos();
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

        if ($fase) {
            $grupos_fases = GruposFase::where([ ['confederacion_id', $conf->id], ['fase_id', $fase->fase_id] ])->get();

            $confederacion = $this->asignarConfederacion($conf->nombre);

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
    }

    /**
     * asigna la nueva fase en la confederacion
     */
    protected function _asignarFaseEnConfederacion($confederacionId){
        $paises = null;
        $fase = FasesConfederacion::where(['confederacion_id' => $confederacionId, 'activo' => 1])->first();

        if ($fase) {
            $confederacion = $this->asignarConfederacion($fase->confederacion->nombre);

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
    }


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

    public function random($init, $end) {
        $listNumbers = range($init, $end);
        shuffle($listNumbers);

        return $listNumbers[0];
    }

    /**
     * Ajusta la fecha para el partido
     */
    public function _ajustarFecha($date) {
        $fechaDataX = explode('-', $date);
        $fechaSeedX = Carbon::createFromDate($fechaDataX[0], $fechaDataX[1], $fechaDataX[2]);

        if ($this->random(0, 1) == 0) {
            $fechaInfoX = $fechaSeedX->add($this->random(0, 7), 'day');
        } else {
            $fechaInfoX = $fechaSeedX->sub($this->random(0, 7), 'day');
        }

        $fechaLogX = explode(' ', $fechaInfoX);

        return $fechaLogX[0];
    }

    /**
     * Guarda el partido creado
     */
    public function _guardarPartido($data, $local, $visita) {

        Historia::create([
            'mundial_id' => $data['mundial_id'],
            'confederacion_id' => $data['confederacion_id'],
            'fase_id' => $data['fase_id'],
            'jornada_id' => $data['jornada_id'],
            'grupo_id' => $data['grupo_id'],
            'fecha' => $this->_ajustarFecha($data['fecha']),
            'pais_id_l' => $local->id,
            'pais_id_v' => $visita->id,
            'ciudad_id' => $this->_obtenerCiudad($local->id, $data['confederacion_id']),
            'tag' => $local->siglas.$visita->siglas,
        ]);
    }

    /**
     * Obtiene la ciudad para el partido
     */
    public function _obtenerCiudad($pais_id, $confederacion_id) {
        if ($confederacion_id == 8) {
            $mundial = Mundial::where('activo', 1)->first();
            $pais_id = $mundial->pais_id;
        }
        $ciudad = Ciudad::where('pais_id', $pais_id)->inRandomOrder()->first();
        return $ciudad->id;
    }

    /**
     * guarda la informacion de la fase ya finalizada
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

    public function _eliminarUnEquipo($grupos, $confederacion) {
        foreach ($grupos as $grupo) {
            $paises = $confederacion::where('grupo_id', $grupo->grupo_id)->orderBy('gf', 'DESC')->get();
            $this->_limpiarClasificado($confederacion, $paises[0]);

            $confederacion::where('pais_id', $paises[1]->pais_id)->delete();
        }
    }

    public function _limpiarClasificado($confederacion, $pais) {
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

    public function _limpiarClasificadoMundial($confederacion, $pais) {
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

    public function _limpiarClasificadoRepechaje($confederacion, $pais) {
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

    public function _parseFecha($fecha){
        $fechaTemp = explode('-', $fecha);
        $meses = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $newFecha = $fechaTemp[2].' de '.$meses[ (int)$fechaTemp[1] ].' de '.$fechaTemp[0];
        return $newFecha;
    }

    public function _parseFechaSmall($fecha){
        $fechaTemp = explode('-', $fecha);
        $meses = ['','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
        $newFecha = $fechaTemp[2].' '.$meses[ (int)$fechaTemp[1] ].' '.$fechaTemp[0];
        return $newFecha;
    }

    public function getJugador($log, $partido){
        if($log->posesion == 'L'){
            return Jugador::where('pais_id', $partido->pais_id_l)->whereNotIn('id', [$log->jugador_id])->inRandomOrder()->first();
        }else{
           return Jugador::where('pais_id', $partido->pais_id_v)->whereNotIn('id', [$log->jugador_id])->inRandomOrder()->first();
        }
    }

    public function setLogJuego($dataCreate, $accion_id, $jugador_id, $min, $posesion){
        $dataCreate['accion_id'] = $accion_id;
        $dataCreate['jugador_id'] = $jugador_id;
        $dataCreate['minuto'] = $min;
        $dataCreate['posesion'] = $posesion;
        return $dataCreate;
    }

    public function getGrupoPartido($juego){
        $grupo = null;
        switch ($juego->confederacion_id) {
            case 1:
                $grupo = Uefa::where('grupo_id', $juego->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                break;
            case 2:
                $grupo = Conmebol::where('grupo_id', $juego->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                break;
            case 3:
                $grupo = Concacaf::where('grupo_id', $juego->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                break;
            case 4:
                $grupo = Caf::where('grupo_id', $juego->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                break;
            case 5:
                $grupo = Ofc::where('grupo_id', $juego->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                break;
            case 6:
                $grupo = Afc::where('grupo_id', $juego->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                break;
            case 7:
                $grupo = Repechaje::where('grupo_id', $juego->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                break;
            default:
                $grupo = Internacional::where('grupo_id', $juego->grupo_id)->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
                break;
        }

        foreach ($grupo as $key => $value) {
            $value->grupo = $value->grupo;
            $value->pais = Pais::where('id', $value->pais_id)->first();
            $value->pais->images = $value->pais->images;
        }
        return $grupo;
    }

    public function getDataJugador(){
        $dataJugador = null;

        $jugadorTemp = DB::table('log_juegos')
             ->select('log_juegos.jugador_id', DB::raw('count(*) as goles'))
             ->join('jugadors', 'jugadors.id', '=', 'log_juegos.jugador_id')
             ->join('pais', 'pais.id', '=', 'jugadors.pais_id')
             ->where('log_juegos.gol', 1)
             ->groupBy('log_juegos.jugador_id')
             ->orderBy('goles', 'DESC')
             ->orderBy('pais.rankin', 'DESC')
             ->orderBy('pais.puntos', 'DESC')
             ->orderBy('pais.gf', 'DESC')
             ->orderBy('pais.gc', 'ASC')
             ->first();

        if($jugadorTemp){
            $jugador = Jugador::select('jugadors.nombre as nombre','pais.id as pais_id','goles','jugadors.posicion_id','jugadors.id')->where('jugadors.id', $jugadorTemp->jugador_id)->join('pais', 'pais.id', '=', 'jugadors.pais_id')->first();
            $dataJugador = new stdClass;
            $dataJugador->nombre = $jugador->nombre;
            $dataJugador->pais = Pais::where('id', $jugador->pais_id)->first();
            $dataJugador->pais->images = $dataJugador->pais->images;
            $dataJugador->goles = $jugadorTemp->goles;
            $dataJugador->posicion = Posicion::where('id', $jugador->posicion_id)->first();
            $dataJugador->jugador_id = $jugador->id;
        }

        return $dataJugador;
    }

    public function getAnterior($anterior){
        $logJuego = null;
        if ($anterior) {
            $logJuego = LogJuego::where('historia_id', $anterior->id)->where('gol', 1)->get();

            foreach ($logJuego as $key => $log) {
                $log->Jugador = Jugador::where('id', $log->jugador_id)->first();
            }
        }
        return $logJuego;
    }

    public function getTeamog(){
        $team = DB::table('log_juegos')
        ->join('acciones', 'acciones.id', '=', 'log_juegos.accion_id')
        ->join('jugadors', 'jugadors.id', '=', 'log_juegos.jugador_id')
        ->join('posicions', 'posicions.id', '=', 'jugadors.posicion_id')
        ->join('pais', 'pais.id', '=', 'jugadors.pais_id')
        ->select('jugadors.nombre','posicions.siglas as posicion','pais.nombre as pais',DB::raw('count(jugadors.nombre) as pts'),'jugadors.pais_id','jugadors.id as jugador_id')
        ->where('acciones.tipo_var', 'pos')
        ->groupBy('jugadors.nombre')->groupBy('posicions.siglas')->groupBy('pais.nombre')->groupBy('jugadors.pais_id')->groupBy('jugadors.id')
        ->orderBy('jugadors.posicion_id')
        ->orderBy('pts', 'DESC')
        ->get();

        $teamog = $team->groupBy('posicion');
        foreach ($teamog as $key => $value) {
            $value[0]->image = Image::where('pais_id', $value[0]->pais_id)->first();
            $value[0]->pais = Pais::where('id', $value[0]->pais_id)->first();
        }
        return $teamog;
    }

    public function getHistoria($juego){
        $historia = Historia::whereIn('tag', [$juego->paisL->siglas.$juego->paisV->siglas, $juego->paisV->siglas.$juego->paisL->siglas])->where('activo', 1)->orderBy('fecha', 'DESC')->get();
        foreach ($historia as $item) {
            $item->paisL = $item->paisL; //Pais::where('id', $item->pais_id_l)->first();
            $item->paisL->images = $item->paisL->images;
            $item->paisV = $item->paisV; //Pais::where('id', $item->pais_id_v)->first();
            $item->paisV->images = $item->paisV->images;
            $item->grupo = $item->grupo;
            $item->fecha = $this->_parseFechaSmall($item->fecha);
            $item->ciudad = $item->ciudad;
            $item->jornada = $item->jornada;
            $item->fase = $item->fase;
        }

        return $historia;
    }

    public function getJuegos(){
        $juegos = Historia::where('activo', 0)->orderBy('fecha', 'ASC')->orderBy('id', 'ASC')->get();
        foreach ($juegos as $key => $value) {
            $value->paisL = $value->paisL;
            $value->paisV = $value->paisV;
        }
        return $juegos;
    }

    public function getJuego(){
        $juego = Historia::where('activo', 0)->orderBy('fecha', 'ASC')->orderBy('id', 'ASC')->first();
        if (isset($juego->fecha)){
            $juego->fecha = $this->_parseFecha($juego->fecha);
            $juego->paisL = $juego->paisL;
            $juego->paisL->images = $juego->paisL->images;
            $juego->paisL->fase_id = Historia::select(DB::raw('max(fase_id) as max_fase'))->where('tag', 'like', '%'.$juego->paisL->siglas.'%')->first();
            $juego->paisL->fase = Fase::where('id', $juego->paisL->fase_id->max_fase)->first();
            $juego->paisV = $juego->paisV;
            $juego->paisV->images = $juego->paisV->images;
            $juego->paisV->fase_id = Historia::select(DB::raw('max(fase_id) as max_fase'))->where('tag', 'like', '%'.$juego->paisV->siglas.'%')->first();
            $juego->paisV->fase = Fase::where('id', $juego->paisV->fase_id->max_fase)->first();
            $juego->ciudad = Ciudad::where('id', $juego->ciudad_id)->first();
            $juego->jornada = $juego->jornada;
            $juego->fase = $juego->fase;
        }
        return $juego;
    }

    public function getPodio(){
        $podio = Pais::orderBy('rankin', 'DESC')->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->limit(3)->get();
        foreach ($podio as $key => $pod) {
            $pod->pais = Pais::where('id', $pod->id)->first();
            $pod->pais->images = $pod->pais->images;
        }
        return $podio;
    }

    public function getJuegoGlobal($grupo, $juego){
        $juegoGlobal = null;
        if (count($grupo) == 2 && $juego->confederacion_id <= 7 && $juego->jornada_id == 2) {
            $juegoGlobal = Historia::where('tag', $juego->PaisV->siglas.$juego->PaisL->siglas)->where('fase_id', $juego->fase_id)->first();
        }
        return $juegoGlobal;
    }

    public function getGame($partido){
        $game = $partido;
        $game->paisL = $partido->paisL;
        $game->paisV = $partido->paisV;
        $game->paisL->images = $partido->paisL->images;
        $game->paisV->images = $partido->paisV->images;
        $game->fecha = $this->_parseFecha($game->fecha);
        return $game;
    }

    public function getRelato($partido){
        $relato = DB::table('log_juegos')
            ->join('jugadors', 'jugadors.id', '=', 'log_juegos.jugador_id')
            ->join('pais', 'pais.id', '=', 'jugadors.pais_id')
            ->join('acciones', 'acciones.id', '=', 'log_juegos.accion_id')
            ->select('log_juegos.minuto', 'pais.nombre as pais', DB::raw('REPLACE(acciones.accion, "{name}", jugadors.nombre) as accion'), 'log_juegos.gol', 'log_juegos.posesion', 'acciones.grupo','jugadors.id as jugador_id')
            ->where('log_juegos.historia_id', $partido->id)
            ->orderBy('log_juegos.minuto', 'ASC')
            ->get();

        foreach ($relato as $linea) {
            $linea->pais = Pais::where('nombre', $linea->pais)->first();
            $linea->pais->images = Image::where('pais_id', $linea->pais->id)->first();
            $linea->pais->jugador = Jugador::where('id', $linea->jugador_id)->first();
            $linea->pais->jugador->posicion = $linea->pais->jugador->posicion;
        }
        return $relato;
    }

    public function getConfederaciones(){
        $confederaciones = Confederacion::get();
        foreach ($confederaciones as $key => $conf) {
            $time = Historia::where('confederacion_id', $conf->id)->where('activo', 0)->get();
            $conf->activo = count($time);
        }
        return $confederaciones;
    }

    public function getPosicionRankin($pais){
        $listado = Pais::orderBy('rankin', 'DESC')->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->orderBy('gc', 'ASC')->get();
        foreach ($listado as $key => $item) {
            if ($item->id == $pais->id) {
                $lugar = $key + 1;
                return $lugar;
            }
        }
    }

    public function getEstrella($pais){
        $jugador = DB::table('log_juegos')
        ->join('jugadors', 'jugadors.id', '=', 'log_juegos.jugador_id')
        ->join('pais', 'pais.id', '=', 'jugadors.pais_id')
        ->join('acciones', 'acciones.id', '=', 'log_juegos.accion_id')
        ->join('posicions', 'posicions.id', '=', 'jugadors.posicion_id')
        ->select(DB::raw('sum(log_juegos.gol) as goles'), 'jugadors.nombre','posicions.nombre as posicion',DB::raw('count(*) as pct'),'jugadors.id')
        ->where('pais.id', $pais->id)
        ->whereNotIn('acciones.grupo', ['G','C'])
        ->groupBy('log_juegos.jugador_id')->groupBy('jugadors.nombre')->groupBy('posicions.nombre')->groupBy('jugadors.id')
        ->orderBy('goles','DESC')
        ->orderBy('pct','DESC')
        ->first();

        return $jugador;
    }

    public function getPartidosJugador($jugador){
        $juegos = DB::table('log_juegos')
        /*->join('jugadors', 'jugadors.id', '=', 'log_juegos.jugador_id')
        ->join('pais', 'pais.id', '=', 'jugadors.pais_id')
        ->join('acciones', 'acciones.id', '=', 'log_juegos.accion_id')
        ->join('posicions', 'posicions.id', '=', 'jugadors.posicion_id')*/
        ->select('log_juegos.historia_id')
        ->where('log_juegos.jugador_id', $jugador->id)
        ->groupBy('log_juegos.historia_id')
        ->orderBy('log_juegos.historia_id')
        ->get();

        return $juegos;
    }
}
