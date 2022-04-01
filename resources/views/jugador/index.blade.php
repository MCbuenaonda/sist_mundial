@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="{{route('pais.index', $jugador->pais->id)}}">
                    <img src="{{$jugador->pais->images->icono}}" alt="" style="width: 100%;">
                </a>
            </div>

            <div class="col-md-10">
                <h2 class="main-title"> {{$jugador->nombre}} </h2>
                <h2 class=""><small class="text-sky">{{$jugador->pais->nombre}}</small></h2>
                <h5 class="text-sky">{{$jugador->posicion->nombre}}</h5>
            </div>

        </div>


        <hr>

        <h2 class="mt-5 text-sky">Historia</h2>

        <section>
            <div class="row">
                @foreach ($historia as $game)
                <div class="col-md-6">
                    <div class="card conf-dark-mode my-2">
                        <div class="card-body">
                            <div class="text-center">
                                <p class="m-0 text-sky">{{$game->juego->fecha}}</p>
                                <h4 class="card-title m-0">
                                    <span class="text-gray">{{$game->juego->paisL->siglas}}</span>
                                    <img src="{{$game->juego->paisL->images->bandera}}" alt="" style="width: 10%;">
                                    {{$game->juego->gol_l}} - {{$game->juego->gol_v}}
                                    <img src="{{$game->juego->paisV->images->bandera}}" alt="" style="width: 10%;">
                                    <span class="text-gray">{{$game->juego->paisV->siglas}}</span>
                                </h4>
                            </div>
                            <hr>
                            @foreach ($game->acciones as $item)
                                @php
                                $class_text = ($item->accion->grupo == 'D') ? 'text-orange' : 'text-white' ;
                                @endphp

                                <p class="m-0 card-text"><span class="{{$class_text}}">{{$item->minuto}}' {{$item->accion->accion}}</span></p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

