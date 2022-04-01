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
                            <data-jugador datos="{{json_encode($dataJugador)}}"></data-jugador>
                        @endif
                    </div>

                    <div class="float-right">
                        <data-podio datapodio="{{$podio}}"></data-podio>
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
                                        <normal-body datajuego="{{json_encode($juego)}}" datamundial="{{json_encode($mundial)}}" datajuegoglobal="{{json_encode($juegoGlobal)}}" dataconfig="{{json_encode($config)}}"></normal-body>
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
                                        <juego-anterior dataanterior="{{json_encode($anterior)}}" datalogjuegos="{{json_encode($logJuego)}}"></juego-anterior>
                                    @endif
                                </div>

                                <div class="col-md-7">
                                    <calendario-view juegos="{{$juegos}}"></calendario-view>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- SECCION: DETALLES  -->
                    <div class="col-md-3 animate__animated animate__fadeIn">
                        @if ($campeon == null && $juego->fase_id < 8)
                            <grupo-index datagrupo="{{$grupo}}" datajuego="{{$juego}}" ></grupo-index>
                        @endif

                        <dream-team datateam="{{$teamog}}" ></dream-team>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


