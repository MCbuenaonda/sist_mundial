@extends('layouts.app')

@section('content')
    <div class="mx-5 justify-content-center">
        <h2 class="mt-2 main-title">{{$mundial->id}}ª Copa del Mundo - {{$mundial->pais->nombre}} {{$mundial->anio}}</h2>
        <hr>

        <section>
            <div class="clearfix container">
                @if($anterior)
                    <div class="text-center float-left">
                        <h2 class="bg-sky text-white">Partido anterior</h2>
                        <div class="clearfix">
                            <small class="float-left">Fase {{$anterior->fase_id}}</small>
                            <small class="float-right">Grupo {{$anterior->grupo->nombre}}</small>
                        </div>
                        <h5>{{$anterior->fecha}}</h5>
                        <h4>Estadio {{$anterior->ciudad->estadio}} {{$anterior->ciudad->nombre}}, {{$anterior->paisL->siglas}}</h4>
                        <h3>{{$anterior->paisL->nombre}} {{$anterior->gol_l}} - {{$anterior->gol_v}} {{$anterior->paisV->nombre}}</h3>
                    </div>
                @endif

                <div class="text-center float-right">
                    <h2 class="bg-sky text-white">Proximo partido</h2>
                    <div class="clearfix">
                        <small class="float-left">Fase {{$juego->fase_id}}</small>
                        <small class="float-right">Grupo {{$juego->grupo->nombre}}</small>
                    </div>
                    <h5>{{$juego->fecha}}</h5>
                    <h4>Estadio {{$juego->ciudad->estadio}} {{$juego->ciudad->nombre}}, {{$juego->paisL->siglas}}</h4>
                    <h3>{{$juego->paisL->nombre}} - {{$juego->paisV->nombre}}</h3>
                    <a href="{{ route('mundial.jugar', ['partido' => $juego->id]) }}" class="btn btn-success">Jugar</a>
                </div>
            </div>
        </section>

        <section>
            <div class="row mt-5">
                @foreach ($confederaciones as $confederacion)
                @php
                    $name = strtolower($confederacion->nombre);
                @endphp
                <div class="col-4">
                    <a href="{{ route( 'confederacion.index', ['confederacion' => $confederacion->id] ) }}">
                        <confederacion-card confederacion="{{$confederacion}}"></confederacion-card>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

