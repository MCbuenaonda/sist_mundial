@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="main-title"> {{$cuenta->id}} </h2>
                <h2 class=""><small class="text-sky">{{$cuenta->disponible}}</small></h2>
                <h5 class="text-sky">{{$cuenta->invertido}}</h5>
            </div>

        </div>


        <hr>

        <h2 class="mt-5 text-sky">Historia</h2>

        <section>
            <cuenta-section cuenta="{{json_encode($cuenta)}}"></cuenta-section>
        </section>
    </div>
@endsection

