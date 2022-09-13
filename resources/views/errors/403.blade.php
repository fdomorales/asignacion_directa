@extends('layouts.app')

@section('contenido')
<div class="col-md-7 mx-auto">
    <div class="block block-rounded block-bordered p-4">
        <center><img class="mb-3" style="width: 50px;opacity: 0.8;" src="{{ asset('img/close.svg') }}"></center>
        <center><h4>403</h4></center>
           <p class="text-center">Lo sentimos, este contenido esta prohibido, debes acceder al sistema antes de ingresar a esta dirección, puedes volver a la página principal para encontrar lo que buscas</p>
            <center><a href="{{route('index')}}" class="btn btn-azul" href="">Ir al Inicio</a></center>
        </div>
</div>
@endsection

@section('css')
    <style>
        #main-container{
            background-image: url({{ asset('img/vacaciones.png') }});
            background-repeat: no-repeat;
            background-position-x: center;
            background-position-y: 101%;
        }
    </style>
@endsection
