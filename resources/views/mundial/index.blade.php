@extends('layouts.app')

@section('content')
    <div class="mx-5 justify-content-center">
        <h2 class="mt-2 main-title">{{$mundial->id}}ª Copa del Mundo - {{$mundial->pais->nombre}} {{$mundial->anio}}</h2>
        <hr>

        <section>
            <div class="container">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <h5>{{$juego->fecha}}</h5>
                            </div>
                            <div class="col-md-8">
                                <h4 class="card-title text-center">Estadio {{$juego->ciudad->estadio}} {{$juego->ciudad->nombre}}, {{$juego->paisL->siglas}}</h4>
                            </div>
                            <div class="col-md-2">
                                <h5 class="float-right">Fase {{$juego->fase_id}}</h5>
                            </div>
                        </div>

                        <div class="row text-center">
                            <div class="col-md-12">
                                <p># {{ $juego->tag }}</p>
                                <div class="row">
                                    <div class="col-md-5">
                                        <pais-modal juego="{{ $juego }}" pais="{{ $juego->paisL }}" images="{{ $juego->paisL->images }}"></pais-modal>
                                    </div>
                                    <div class="col-md-2">
                                        <h4 class="mt-5">VS</h4>
                                    </div>
                                    <div class="col-md-5">
                                        <pais-modal juego="{{ $juego }}" pais="{{ $juego->paisV }}" images="{{ $juego->paisV->images }}"></pais-modal>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <h5 class="">Grupo {{$juego->grupo->nombre}}</h5>
                                <h5 class=""> <small>Jornada {{$juego->jornada_id}}</small> </h5>
                            </div>
                            <div class="col-md-12 pt-5">
                                <a href="{{ route('mundial.jugar', ['partido' => $juego->id]) }}" class="btn btn-success btn-lg btn-block">Jugar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix container mt-5">
                @if($anterior)
                    <div class="text-center float-left">
                        <h5 class="bg-sky text-white">Partido anterior</h5>

                        <div class="row text-center">
                            <div class="col-md-4">
                                <bandera-modal juego="{{ $anterior }}" pais="{{ $anterior->paisL }}" images="{{ $anterior->paisL->images }}"></bandera-modal>
                            </div>
                            <div class="col-md-4 pt-3">
                                <h3>{{$anterior->gol_l}} - {{$anterior->gol_v}}</h3>
                            </div>
                            <div class="col-md-4">
                                <bandera-modal juego="{{ $anterior }}" pais="{{ $anterior->paisV }}" images="{{ $anterior->paisV->images }}"></bandera-modal>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- <div class="text-center float-right">
                    <h2 class="bg-sky text-white">Proximo partido <small># {{ $juego->id }}</small></h2>
                    <div class="clearfix">
                        <small class="float-left">Fase {{$juego->fase_id}}</small>
                        <small class="float-right">Grupo {{$juego->grupo->nombre}}</small>
                    </div>
                    <h5>{{$juego->fecha}}</h5>
                    <h4>Estadio {{$juego->ciudad->estadio}} {{$juego->ciudad->nombre}}, {{$juego->paisL->siglas}}</h4>
                    <h3>{{$juego->paisL->nombre}} - {{$juego->paisV->nombre}}</h3>
                    <a href="{{ route('mundial.jugar', ['partido' => $juego->id]) }}" class="btn btn-success">Jugar</a>
                </div> --}}
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


