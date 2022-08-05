@extends('inicio')

@section('contenido')



    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div>
                @if ($regiones->count()>0)
                    @foreach ($regiones as $region)
                    {{$loop->first ? 'Regiones con convocatorias abiertas: ' : ''}}<strong>{{$region->nombre_region}}{{$loop->last ? '.' : ', '}}</strong>
                    @endforeach
                @else
                    no hay regiones con peridos de postulacion abiertos
                @endif
            </div>
            <div class="panel panel-default mt-20 ">

                <div class="panel-heading mb-15 ">Iniciar Sesión</div>

                <div class="panel-body">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="form-group justify-content-center">
                            <label for="email" class="col-md-4 control-label">Correo Electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"  name="email" :value="old('email')" required autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Clave</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input  id="remember_me" type="checkbox" name="remember"> Recordarme
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-4">
                                @if (Route::has('password.request'))
                                    <div class="checkbox">
                                        <a  href="{{ route('password.request') }}">Recuperar contraseña</a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @endsection
