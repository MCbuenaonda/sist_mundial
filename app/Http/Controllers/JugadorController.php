<?php

namespace App\Http\Controllers;

use App\Jugador;
use App\Historia;
use App\LogJuego;
use Illuminate\Http\Request;
use App\Resources\MundialResources;

class JugadorController extends Controller
{

    public $lib;

    public function __construct(){
        $this->middleware(['auth', 'verified']);
        $this->lib = new MundialResources;
    }

    public function index(Jugador $jugador){
        $historia = $this->lib->getPartidosJugador($jugador);

        foreach ($historia as $game) {
            $game->juego = Historia::where('id',$game->historia_id)->first();
            $game->juego->fecha = $this->lib->_parseFechaSmall($game->juego->fecha);
            $game->acciones = LogJuego::where('historia_id',$game->historia_id)->where('jugador_id',$jugador->id)->orderBy('minuto')->get();
            foreach ($game->acciones as $item) {
                $item->accion->accion = str_replace("{name}", $jugador->nombre, $item->accion->accion);
            }
        }

        return view('jugador.index', compact('jugador','historia'));
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
     * @param  \App\Jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function show(Jugador $jugador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function edit(Jugador $jugador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jugador $jugador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jugador $jugador)
    {
        //
    }
}
