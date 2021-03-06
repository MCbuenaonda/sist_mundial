@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mt-2 main-title">{{$confederacion->nombre}}</h2>
        @if ($confederacion->id < 7)
            <hr>
            <section>
                <div class="row mt-5">
                    <div class="col-md-4">
                        <div class="card country {{ strtolower($confederacion->paisRankinMundial->siglas) }}">
                            <div class="card-body text-white animate__animated animate__fadeIn">
                            <h2 class="card-title">{{$confederacion->paisRankinMundial->nombre}}</h2>
                            </div>
                        </div>
                        <p class="conf-stats">Mejor posicion rankin mundial</p>
                    </div>
                    <div class="col-md-4">
                        <div class="card country {{ strtolower($confederacion->paisPuntosFase->siglas) }}">
                            <div class="card-body text-white animate__animated animate__fadeIn">
                            <h2 class="card-title">{{$confederacion->paisPuntosFase->nombre}}</h2>
                            </div>
                        </div>
                        <p class="conf-stats">Mejor desempeño confederacion</p>
                    </div>
                    <div class="col-md-4">
                        <div class="card country {{ strtolower($confederacion->PaisMasGoles->siglas) }}">
                            <div class="card-body text-white animate__animated animate__fadeIn">
                            <h2 class="card-title">{{$confederacion->PaisMasGoles->nombre}}</h2>
                            <h2><small>{{$confederacion->PaisMasGoles->gf}} Goles</small></h2>
                            </div>
                        </div>
                        <p class="conf-stats">Mas goleador</p>
                    </div>
                </div>
            </section>
        @endif

        <hr class="hr-game">

        <section>
            @if (isset($confederacion->paisesFase[0]->faseConfederacion->fase))
                <h2 class="text-sky mt-5">Proximos partidos</h2>
                <carousel-games partidos="{{ $partidos }}"></carousel-games>
            @endif
        </section>


        <section>
            @php $grupoId = 0; @endphp

            @if (isset($confederacion->paisesFase[0]->faseConfederacion->fase))
                <h2 class="text-sky mt-5">{{$confederacion->paisesFase[0]->faseConfederacion->fase->nombre}}</h2>
                <hr>
                @foreach ($confederacion->paisesFase as $key => $data)

                    @if ($data->grupo_id != $grupoId)
                        @if ($key > 0)
                                </tbody>
                            </table>
                        @endif

                        <h4 class="mt-5">Grupo {{$data->grupo->nombre}}</h4>

                        <table class="table table-hover table-sm">
                            <thead class="table-head">
                                <tr>
                                    <th>Pais</th>
                                    <th>Puntos</th>
                                    <th>JJ</th>
                                    <th>JG</th>
                                    <th>JE</th>
                                    <th>JP</th>
                                    <th>GF</th>
                                    <th>GC</th>
                                </tr>
                            </thead>
                            <tbody>

                        @php $grupoId = $data->grupo_id @endphp
                    @endif

                    <tr>
                        <td scope="row">
                            <img src="{{$data->pais->images->icono}}" alt="" style="width: 35px;">
                            {{$data->pais->nombre}}
                        </td>
                        <td>{{$data->puntos}}</td>
                        <td>{{$data->jj}}</td>
                        <td>{{$data->jg}}</td>
                        <td>{{$data->je}}</td>
                        <td>{{$data->jp }}</td>
                        <td>{{$data->gf}}</td>
                        <td>{{$data->gc}}</td>
                    </tr>
                    {{-- {{$data}} --}}

                    @if( (count($confederacion->paisesFase) - 1) == $key)
                            </tbody>
                        </table>
                    @endif
                @endforeach
            @else
                <h2 class="text-sky mt-5">Tabla de clasificacion</h2>

                <ul class="list-group">
                    @foreach ($confederacion->paisesFase as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center conf-dark-mode">
                            <h4>
                                <img src="{{$item->pais->images->icono}}" alt="" style="width: 35px;"> {{$item->pais->nombre}}
                            </h4>
                            @if ($item->posicion == 1)
                                <span class="badge badge-success badge-pill">
                                    <p class="m-1">CLASIFICADO</p>
                                </span>
                            @else
                                <span class="badge badge-warning badge-pill">
                                    <p class="m-1 text-dark">REPECHAJE</p>
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif


        </section>

        <section>
            <h3 class="text-sky mt-5">Paises pertenecientes a la confederacion</h3>
            <hr>

            <div class="row my-5">
                @foreach ($confederacion->paises as $pais)
                    <div class="col-3">
                        <a href="{{ route( 'pais.index', ['pais' => $pais] ) }}">
                            <div class="animate__animated animate__fadeIn card text-left mb-5 shadow card-pais text-center">
                                <img class="card-img-sm" src="{{$pais->images->bandera}}" alt="Card image cap">
                                <div class="animate__animated animate__fadeIn label-pais">
                                    <h3 class="font-weight-bold">{{ $pais->nombre }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

