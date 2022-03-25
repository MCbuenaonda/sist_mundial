@extends('layouts.app')

@section('content')
    <div class="mx-5 justify-content-center">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mt-2 main-title">Configuración</h3>
            </div>
        </div>
        <hr>

        <section>
            <div class="row my-5 py-5">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card conf-dark-mode">
                        <div class="card-body">
                            <div class="m-5">
                                <form method="POST" action="{{ route('configuracion.update', $conf->id) }}">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-group row">
                                        <label for="tiempo_juego" class="col-md-6 col-form-label text-right">
                                            <h4>Tiempo de inicio de juego</h4>
                                        </label>
                                        <div class="col-md-2">
                                            <input type="number" min="5" class="form-control" name="tiempo_juego" id="tiempo_juego" placeholder="" value="{{ old('tiempo_juego', $conf->tiempo_juego) }}">
                                        </div>
                                        <label class="col-md-4 col-form-label">
                                            <h4>seg.</h4>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tiempo_lapso" class="col-md-6 col-form-label text-right">
                                            <h4>Tiempo entre accion de juego</h4>
                                        </label>
                                        <div class="col-md-2">
                                            <input type="number" min="1" class="form-control" name="tiempo_lapso" id="tiempo_lapso" placeholder="" value="{{ old('tiempo_lapso', $conf->tiempo_lapso) }}">
                                        </div>
                                        <label class="col-md-4 col-form-label">
                                            <h4>seg.</h4>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tiempo_siguiente" class="col-md-6 col-form-label text-right">
                                            <h4>Tiempo para el siguiente juego</h4>
                                        </label>
                                        <div class="col-md-2">
                                            <input type="number" min="3" class="form-control" name="tiempo_siguiente" id="tiempo_siguiente" placeholder="" value="{{ old('tiempo_siguiente', $conf->tiempo_siguiente) }}">
                                        </div>
                                        <label class="col-md-4 col-form-label">
                                            <h4>seg.</h4>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-dark btn-block btn-lg">Guardar configuración</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </section>
    </div>
@endsection


