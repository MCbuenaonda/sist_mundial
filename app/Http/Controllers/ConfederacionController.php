<?php

namespace App\Http\Controllers;

use App\Pais;
use App\Uefa;
use App\Confederacion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Resources\MundialResources;

class ConfederacionController extends Controller
{
    public $lib;

    public function __construct(){
        $this->middleware(['auth', 'verified']);
        $this->lib = new MundialResources;
    }

    public function index(Confederacion $confederacion)
    {
        $conf = $this->lib->asignarConfederacion($confederacion->nombre);
        $confederacion->paisesFase = $conf::whereNotNull('fase_confederacion_id')->orderBy('grupo_id', 'ASC')->orderby('puntos', 'DESC')->orderby('gf', 'DESC')->orderby('gc', 'ASC')->get();
        $confederacion->paisRankinMundial = Pais::where('confederacion_id', $confederacion->id)->orderBy('rankin', 'DESC')->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->first();
        $confederacion->paisPuntosFase = $conf::whereNotNull('fase_confederacion_id')->orderBy('puntos', 'DESC')->orderBy('gf', 'DESC')->first();
        $confederacion->PaisMasGoles = $conf::whereNotNull('fase_confederacion_id')->orderBy('gf', 'DESC')->first();

        return view('confederacion.index', compact('confederacion'));
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
     * @param  \App\Confederacion  $confederacion
     * @return \Illuminate\Http\Response
     */
    public function show(Confederacion $confederacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Confederacion  $confederacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Confederacion $confederacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Confederacion  $confederacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Confederacion $confederacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Confederacion  $confederacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Confederacion $confederacion)
    {
        //
    }
}
