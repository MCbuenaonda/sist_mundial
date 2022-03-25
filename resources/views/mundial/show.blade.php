@extends('layouts.app')

@section('content')
    <div class="mx-5 justify-content-center">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <p style="margin: 0; font-size: 18px;"><b>{{$game->fecha}}</b></p>
                <p style="margin: 0; font-size: 17px;">Estadio {{$game->ciudad->estadio}} {{$game->ciudad->nombre}}, {{$game->paisL->nombre}}</p>
                <p style="margin: 0; font-size: 16px;">{{$game->fase->descripcion}}</p>
            </div>
            <div class="col-md-2"></div>
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
