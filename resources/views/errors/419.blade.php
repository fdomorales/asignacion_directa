@extends('layouts.app')

@section('contenido')
<div class="col-md-7 mx-auto">
    <div class="block block-rounded block-bordered p-4">
        <center><img class="mb-3" style="width: 50px;opacity: 0.8;" src="{{ asset('img/close.svg') }}"></center>
        <center><h4>Sesión expirada</h4></center>
           <p class="text-center">Lo sentimos, acabó el tiempo de tu sesión, puedes volver a ingresar para continuar lo que estabas realizando.</p>
            <center><a href="{{route('login')}}" class="btn btn-azul" href="">Iniciar sesión</a></center>
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
