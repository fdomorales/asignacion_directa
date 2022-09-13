@extends('layouts.app')

@section('contenido')
<div class="col-md-7 mx-auto">
    <div class="block block-rounded block-bordered p-4">
        <center><img class="mb-3" style="width: 50px;opacity: 0.8;" src="{{ asset('img/close.svg') }}"></center>
        <center><h4>No hemos encontrado lo que buscas</h4></center>
           <p class="text-center">Lo sentimos, la página a la cual accediste ya no esta operativa o no tienes acceso a ella, puedes volver a la pagina principal para encontrar lo que buscas</p>
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
