<?php

namespace App\Http\Controllers;

use App\Configuracion;
use Illuminate\Http\Request;
use App\Http\Requests\ConfiguracionUpdate;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $conf = Configuracion::where('rol_id', 1)->first();
        $conf->tiempo_juego = $conf->tiempo_juego/1000;
        $conf->tiempo_lapso = $conf->tiempo_lapso/1000;
        $conf->tiempo_siguiente = $conf->tiempo_siguiente/1000;
        return view('configuracion.index', compact('conf'));
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
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function show(Configuracion $configuracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuracion $configuracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function update(ConfiguracionUpdate $request, Configuracion $configuracion) {
        $requestData = $request->validated();
        $requestData['tiempo_juego'] = $requestData['tiempo_juego'] * 1000;
        $requestData['tiempo_lapso'] = $requestData['tiempo_lapso'] * 1000;
        $requestData['tiempo_siguiente'] = $requestData['tiempo_siguiente'] * 1000;
        $configuracion->update($requestData);
        return redirect()->action([ConfiguracionController::class, 'index'])->with('status', 'Datos actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuracion $configuracion)
    {
        //
    }
}
