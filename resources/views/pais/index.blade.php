@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src=" {{$pais->images->escudo}}" alt="">
            </div>

            <div class="col-md-10">
                <h2 class="mt-2 main-title"> {{$pais->nombre}} </h2>
                <h5 class="text-sky">{{$pais->federacion}}</h5>
            </div>

        </div>

        <hr>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="card text-center conf-dark-mode">
                          <div class="card-body">
                            <h4 class="card-title"># Rankin Mundial</h4>
                            <h1 class="card-text text-sky">{{$lugar}}</h1>
                          </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-center conf-dark-mode">
                          <div class="card-body">
                            <h4 class="card-title">Mejor Jugador</h4>
                            <a href="{{route('jugador.index', $goleador->id)}}">
                                <p class="m-0 text-sky">{{$goleador->nombre}}</p>
                            </a>
                            <p class="m-0"><small class="text-gray">{{$goleador->posicion}} [{{$goleador->goles}} goles]</small></p>
                          </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-center conf-dark-mode">
                          <div class="card-body">
                            <h4 class="card-title">Mundiales</h4>
                          </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-center conf-dark-mode">
                          <div class="card-body">
                            <h4 class="card-title">Campeonatos</h4>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr>

        <h2 class="mt-5 text-sky">Historia</h2>

        <section>
            @foreach ($mundiales as $mundial)
                <div class="card text-white conf-dark-mode my-3">
                    <div class="card-body">
                        <h4 class="card-title">
                            <img src="{{$mundial->pais->images->bandera}}" alt="">
                            {{$mundial->pais->nombre}} {{$mundial->anio}}
                        </h4>


                        <hr>

                        @foreach ($mundial->logfases as $fase)
                            <p class="text-gray">{{$fase->fase->descripcion}}</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <table class="table table-sm">
                                        <thead class="text-orange">
                                            <th colspan="2">Grupo {{$fase->grupo->nombre}}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($fase->logfases as $k => $grupo)
                                                @php
                                                    {{ $class_text = ($grupo->pais->id == $pais->id) ? 'text-sky' : '';  }}
                                                    {{
                                                        $class_border = '';
                                                        if ($k == 0) {
                                                            $class_border = 'border-left border-success';
                                                        }

                                                        if (($k == 1)&&($grupo->confederacion_id == 1)&&($grupo->fase_id == 1)) {
                                                            $class_border = 'border-left border-warning';
                                                        }

                                                        if (($k == 1 || $k == 2 || $k == 3)&&($grupo->confederacion_id == 2)&&($grupo->fase_id == 1)) {
                                                            $class_border = 'border-left border-success';
                                                        }

                                                        if (($k == 4)&&($grupo->confederacion_id == 2)&&($grupo->fase_id == 1)) {
                                                            $class_border = 'border-left border-warning';
                                                        }

                                                        if (($k == 1 || $k == 2)&&($grupo->confederacion_id == 3)&&($grupo->fase_id == 3)) {
                                                            $class_border = 'border-left border-success';
                                                        }

                                                        if (($k == 3)&&($grupo->confederacion_id == 3)&&($grupo->fase_id == 3)) {
                                                            $class_border = 'border-left border-warning';
                                                        }

                                                        if (($k == 1)&&($grupo->confederacion_id == 5)&&($grupo->fase_id == 1)) {
                                                            $class_border = 'border-left border-success';
                                                        }

                                                        if (($k == 1)&&($grupo->confederacion_id == 6)&&($grupo->fase_id == 2 )) {
                                                            $class_border = 'border-left border-warning';
                                                        }

                                                        if (($k == 1)&&($grupo->confederacion_id == 6)&&($grupo->fase_id == 3)) {
                                                            $class_border = 'border-left border-success';
                                                        }

                                                        if (($k == 2)&&($grupo->confederacion_id == 6)&&($grupo->fase_id == 3)) {
                                                            $class_border = 'border-left border-warning';
                                                        }

                                                        if (($k == 1)&&($grupo->confederacion_id == 8)&&($grupo->fase_id == 7)) {
                                                            $class_border = 'border-left border-success';
                                                        }
                                                    }}
                                                @endphp
                                                <tr class="{{$class_border}}">
                                                    <td class="{{$class_text}}">
                                                        <img src="{{$grupo->pais->images->icono}}" alt="" style="width: 35px;">
                                                        {{$grupo->pais->nombre}}
                                                    </td>
                                                    <td class="{{$class_text}}">{{$grupo->puntos}} pts.</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-8 row">
                                    @foreach ($fase->historia as $juego)
                                        <div class="col-md-4 text-center text-gray p-2">
                                            <div class="card border border-dark">
                                                <div class="card-body p-0 bg-dark">
                                                    @php
                                                        {{ $class_text_l = ($juego->paisL->id == $pais->id) ? 'text-sky' : 'text-gray'; }}
                                                        {{ $class_text_v = ($juego->paisV->id == $pais->id) ? 'text-sky' : 'text-gray'; }}
                                                    @endphp
                                                    <p class="m-0 text-gray">
                                                        <span>{{$juego->ciudad->estadio}} {{$juego->ciudad->nombre}}</span>
                                                        <br>
                                                        <span><small class="text-gray">{{$juego->fecha}}</small></span>
                                                        <br>
                                                        <span class="{{$class_text_l}}">
                                                            {{$juego->paisL->siglas}}
                                                            <img src="{{$juego->paisL->images->icono}}" alt="" style="width: 35px;" data-toggle="tooltip" data-placement="top" title="{{$juego->paisL->nombre}}">
                                                            {{$juego->gol_l}}
                                                        </span>
                                                        -
                                                        <span class="{{$class_text_v}}">
                                                            {{$juego->gol_v}}
                                                            <img src="{{$juego->paisV->images->icono}}" alt="" style="width: 35px;" data-toggle="tooltip" data-placement="top" title="{{$juego->paisV->nombre}}">
                                                            {{$juego->paisV->siglas}}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </section>
    </div>
@endsection

