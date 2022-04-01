<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Pais;
use stdClass;
use App\Mundial;
use App\FasesLog;
use App\Historia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Resources\MundialResources;

class PaisController extends Controller
{
    public $lib;

    public function __construct(){
        $this->middleware(['auth', 'verified']);
        $this->lib = new MundialResources;
    }

    public function index(Pais $pais) {
        $mundiales = Mundial::all();
        foreach ($mundiales as $mundial) {
            $mundial->logfases = FasesLog::where('mundial_id',$mundial->id)->where('pais_id',$pais->id)->get();
            if (count($mundial->logfases) == 0) {
                $mundial->logfases->historia = Historia::where('mundial_id',$mundial->id)
                ->where('tag','like','%'.$pais->siglas.'%')
                ->where('activo',1)
                ->orderBy('fecha')->get();
            }else{
                foreach ($mundial->logfases as $key => $fase) {
                    $fase->logfases = FasesLog::where('mundial_id',$mundial->id)
                    ->where('confederacion_id',$fase->confederacion_id)
                    ->where('grupo_id',$fase->grupo_id)
                    ->where('fase_id',$fase->fase_id)
                    ->orderBy('puntos','DESC')
                    ->orderBy('gf','DESC')
                    ->orderBy('gc','ASC')
                    ->get();

                    $fase->historia = Historia::where('mundial_id',$mundial->id)
                    ->where('confederacion_id',$fase->confederacion_id)
                    ->where('grupo_id',$fase->grupo_id)
                    ->where('fase_id',$fase->fase_id)
                    ->where('tag','like','%'.$pais->siglas.'%')
                    ->orderBy('fecha')->get();

                    foreach ($fase->historia as $item) {
                        $item->fecha = $this->lib->_parseFechaSmall($item->fecha);
                    }
                }
            }
        }

        $lugar = $this->lib->getPosicionRankin($pais);
        $goleador = $this->lib->getEstrella($pais);

        return view('pais.index', compact('pais','mundiales','lugar','goleador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function show(Pais $pais)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function edit(Pais $pais)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pais $pais)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pais $pais)
    {
        //
    }
}
