@extends('layouts.login')

@section('contenido')
    <div class="caja-contenedora">
        <div class="col-md-8 mx-auto caja-login sombra borde">
            <div class="row">
                <div class="col-md-6 foto-login borde-izq"></div>
                <div class="col-md-6 bg-white login-box borde-der">
                    <div class="col-md-8 mx-auto" style="margin-top: 55px;">
                        <h1><center><img meta="Vacaciones Tercera Edad Sernatur" class="logo" src="{{ asset('img/VTE-logo.png') }}"></center></h1>
                        <p class="text-center">Ingresa tu usuario y contraseña para acceder</p>
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <center>
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            @csrf
                            <input placeholder="E-mail" id="email" type="email" class="mb-4 input-login" name="email"  name="email" :value="old('email')" required autofocus>
                            <input placeholder="Contraseña" id="password" type="password" class="input-login" name="password" required autocomplete="current-password">
                                <label style="display:none;">
                                    <input  id="remember_me" type="checkbox" name="remember"> Recordarme
                                </label>
                                <div class="col-md-6 col-md-offset-4">
                                    @if (Route::has('password.request'))
                                        <a class="link-olvido"  href="{{ route('password.request') }}">Olvide contraseña</a>   
                                    @endif
                                </div>
                                    <button type="submit" class="btn btn-verde mx-auto mt-4">INGRESAR</button>
                            </form>
                        </center>
                        <div class="mt-4 mb-4 br"></div>
                        <p class="text-center" style="font-size:13px;">Si no estas registrado, puedes crear una cuenta aca</p>
                        <center><a href="{{route('register')}}" class="btn btn-azul mx-auto mt-3">REGÍSTRATE</a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>

                <!--@if ($regiones->count()>0)
                    @foreach ($regiones as $region)
                    {{$loop->first ? 'Regiones con convocatorias abiertas: ' : ''}}<strong>{{$region->nombre_region}}{{$loop->last ? '.' : ', '}}</strong>
                    @endforeach
                @else
                    no hay regiones con peridos de postulacion abiertos
                @endif -->

    @endsection

    
