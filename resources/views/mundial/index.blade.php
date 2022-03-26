@extends('layouts.app')

@section('content')
    <div class="mx-5 justify-content-center">
        <div class="row">
            <div class="col-md-8">
                <h3 class="mt-2 main-title">{{$mundial->id}}ª Copa del Mundo - {{$mundial->pais->nombre}} {{$mundial->anio}}</h3>
            </div>

            <div class="col-md-4">
                <div class="clearfix animate__animated animate__fadeIn">
                    <div class="float-left">
                        @if($dataJugador != null)
                            <table class="table table-bordered table-sm mb-0">
                                <tr class="conf-dark-mode text-center">
                                    <td colspan="2"> <strong class="text-sky">Maximo goleador</strong></td>
                                </tr>
                                <tr>
                                    <td class="conf-dark-mode">
                                        <img src="{{$dataJugador->pais->images->bandera}}" alt="">
                                    </td>
                                    <td>
                                        <table class="table table-bordered table-sm mb-0 conf-dark-mode">
                                            <tr>
                                                <td>
                                                    {{$dataJugador->nombre}}
                                                </td>
                                                <td>
                                                    {{$dataJugador->goles}} Goles
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{$dataJugador->posicion->nombre}}
                                                </td>
                                                <td>
                                                    {{$dataJugador->pais->nombre}}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        @endif
                    </div>

                    <div class="float-right">
                        <table style="width: 250px;">
                            @foreach ($podio as $key => $lugar)
                                @php
                                    $key ++
                                @endphp
                                <tr>
                                    <td> <strong> {{$key}}. </strong> <img src="{{$lugar->pais->images->icono}}" alt="" style="width: 35px;"> {{$lugar->nombre}}</td>
                                    <td>{{$lugar->pais->rankin}} pts</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div >
        </div>
        <hr>

        <section>
            <div class="">
                <div class="row">
                    <!-- SECCION: LISTA DE CONFEDERACIONES -->
                    <div class="col-md-2">
                        <div class="row">
                            @if ($campeon == null)
                                @foreach ($confederaciones as $confederacion)
                                    @php
                                        $name = strtolower($confederacion->nombre);
                                    @endphp

                                    @if ($juego->fase_id < 6 && $confederacion->id < 7)
                                        <div class="col-md-12 p-3 animate__animated animate__slideInLeft" style="height: 100px;">
                                            <a href="{{ route( 'confederacion.index', ['confederacion' => $confederacion->id] ) }}">
                                                <confederacion-card confederacion="{{$confederacion}}"></confederacion-card>
                                            </a>
                                        </div>
                                    @endif

                                    @if ($juego->fase_id >= 6 && $confederacion->id >= 7)
                                        <div class="col-md-12 p-3 animate__animated animate__slideInLeft" style="height: 100px;">
                                            <a href="{{ route( 'confederacion.index', ['confederacion' => $confederacion->id] ) }}">
                                                <confederacion-card confederacion="{{$confederacion}}"></confederacion-card>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- SECCION: JUEGO  -->
                    <div class="col-md-7">
                        <div class="row animate__animated animate__fadeIn">
                            <div class="col-md-12">

                                <div class="card shadow conf-dark-mode">
                                    @if ($campeon == null)
                                        <carousel-games partidos="{{$historia}}"></carousel-games>
                                    @endif

                                    @if ($campeon == null)
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5><small>{{$juego->fecha}}</small></h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4 class="card-title text-center">
                                                        Estadio {{$juego->ciudad->estadio}} {{$juego->ciudad->nombre}},
                                                        @if ($juego->confederacion_id < 8)
                                                            {{$juego->paisL->siglas}}
                                                        @else
                                                            {{$mundial->pais->siglas}}
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div class="col-md-3">
                                                    <h5 class="float-right"><small> {{$juego->jornada->nombre}}</small> </h5>
                                                </div>
                                            </div>

                                            <div class="row text-center">
                                                <div class="col-md-12">
                                                    <p class="m-0"># {{ $juego->tag }}</p>
                                                    <h5><small>{{$juego->fase->descripcion}}</small></h5>

                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <pais-modal juego="{{ $juego }}" pais="{{ $juego->paisL }}" images="{{ $juego->paisL->images }}"></pais-modal>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <h4 class="mt-5">VS</h4>
                                                            @if($juegoGlobal != null)
                                                                <p>({{$juegoGlobal->gol_v}} - {{$juegoGlobal->gol_l}})</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-5">
                                                            <pais-modal juego="{{ $juego }}" pais="{{ $juego->paisV }}" images="{{ $juego->paisV->images }}"></pais-modal>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 pt-5">
                                                    <auto-timer tipo="ini" config="{{$config}}" partido-id="{{$juego->id}}"></auto-timer>
                                                    <!--
                                                        <a href="{{ route('mundial.jugar', ['partido' => $juego->id]) }}" class="btn btn-primary btn-lg btn-block">Jugar</a>
                                                    -->
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-body text-center">
                                            <h1 class="text-sky mb-4">CAMPEON</h1>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <img src="{{$campeon->pais->images->escudo}}" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2 class="text-white my-4">{{$campeon->pais->nombre}}</h2>
                                                </div>
                                            </div>

                                            <a href="{{ route('mundial.index') }}" class="btn btn-primary btn-lg btn-block">Vamos al siguiente mundial!</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- SECCION: PARTIDOS ANTERIOR Y SIGUIENTE -->
                        <div class="row mt-2 text-center animate__animated animate__fadeIn">
                            @if ($campeon == null)
                                <div class="col-md-5">
                                    @if($anterior)
                                        <h4 class="text-sky">Partido anterior</h4>

                                        <div class="row">
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
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 clearfix">
                                                @foreach ($logJuego as $action)
                                                    @php
                                                        $float = ($action->posesion == 'L') ? 'float-left' : 'float-right' ;
                                                    @endphp

                                                    @if ($float == 'float-left')
                                                        <div class="{{$float}}">
                                                            <b>{{$action->minuto}}`</b>
                                                            <small> {{$action->jugador->nombre}} </small>
                                                        </div>
                                                        <br>
                                                    @else
                                                        <div class="{{$float}}">
                                                            <small> {{$action->jugador->nombre}} </small>
                                                            <b>{{$action->minuto}}`</b>
                                                        </div>
                                                        <br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-7">
                                    <h4 class="text-sky">Calendario de partidos</h4>
                                    <calendario-view juegos="{{$juegos}}"></calendario-view>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- SECCION: DETALLES  -->
                    <div class="col-md-3 animate__animated animate__fadeIn">
                        @if ($campeon == null && $juego->fase_id < 8)
                            <h4 class="text-sky">Grupo {{$grupo[0]->grupo->nombre}}</h4>

                            <table class="table table-hover table-sm">
                                <thead class="table-head conf-dark-mode">
                                    <tr>
                                        <th>Pais</th>
                                        <th>Pts</th>
                                        <th>JJ</th>
                                        <th>JG</th>
                                        <th>JE</th>
                                        <th>JP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupo as $data)
                                        @php
                                            $fondo = (($data->pais->nombre == $juego->paisL->nombre) || ($data->pais->nombre == $juego->paisV->nombre)) ? 'bg-success' : '';
                                        @endphp
                                        <tr class="{{$fondo}}">
                                            <td scope="row">
                                                <img src="{{$data->pais->images->icono}}" alt="" style="width: 35px;">
                                                {{$data->pais->nombre}}
                                            </td>
                                            <td class="font-weight-bold">{{$data->puntos}}</td>
                                            <td>{{$data->jj}}</td>
                                            <td>{{$data->jg}}</td>
                                            <td>{{$data->je}}</td>
                                            <td>{{$data->jp }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <hr>
                        @endif

                        <h5 class="text-sky">Dream Team</h5>
                        <div class="conf-dark-mode text-white p-2">
                            @foreach ($teamog as $jug)
                            <div class="row">
                                <div class="col-md-9" data-toggle="tooltip" data-placement="top" title="{{$jug[0]->pais->nombre}}">
                                    <img src="{{$jug[0]->image->bandera}}" alt="" style="width: 12%">
                                    {{$jug[0]->nombre}}
                                </div>
                                <div class="col-md-3">
                                    <span class="my-auto">{{$jug[0]->posicion}}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection


