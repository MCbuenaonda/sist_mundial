@extends('layouts.app')

@section('content')
    <div class="mx-5 justify-content-center">
        <div class="row">
            <div class="col-md-4">
                <p style="margin: 0; font-size: 16px;"><b>{{$game->fecha}}</b></p>
            </div>
            <div class="col-md-4 text-center">
                <p style="margin: 0; font-size: 18px;">
                    Estadio {{$game->ciudad->estadio}} {{$game->ciudad->nombre}},
                    @if ($game->confederacion_id < 8)
                        {{$game->paisL->nombre}}
                    @else
                        {{$mundial->pais->nombre}}
                    @endif
                </p>
            </div>
            <div class="col-md-4 text-right">
                <p style="margin: 0; font-size: 16px;">{{$game->fase->descripcion}}</p>
                <p style="margin: 0; font-size: 16px;">{{$game->jornada->nombre}}</p>
            </div>
        </div>
        <hr>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <acciones-list relato="{{$relato}}" game="{{$game}}" poderl="{{$poderIniL}}" poderv="{{$poderIniV}}" grupo="{{$grupoGlobal}}" config="{{$config}}"></acciones-list>

            <div class="row">
                <div class="col-md-12">
                    <!--
                        <auto-timer tipo="fin" config="{{$config}}" partido-id="{{$game->id}}"></auto-timer>
                        <a href="{{ route('mundial.next', $game) }}" class="btn btn-dark btn-block">Continuar</a>
                    -->
                </div>
            </div>
        </div>
        <div class="col-md-1">
        </div>
    </div>

@endsection
