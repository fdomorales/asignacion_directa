@extends('inicio')

@section('contenido')
        <div class="row justify-content-center">
            <!-- Latest Orders -->
            <div class="col-lg-10">
                <div class="block block-rounded block-bordered">
                    <div class="block-header">
                        <h3 class="block-title text-uppercase">Registro</h3>
                        <!-- <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option">
                                    <i class="si si-wrench"></i>
                                </button>
                            </div> -->
                    </div>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div class="block-content p-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>Nombre Organización</label>
                                    <input type="text"  class="form-control" name="name" value="{{old('name')}}" required autofocus >
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Correo Organización</label>
                                    <input id="email" type="email" class="form-control" name="email"  value="{{old('email')}}" required >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>Teléfono organización</label>
                                    <div class="input-group">
                                        <span class="input-group-text" >+56</span>
                                        <input type="text" name="telefono_organizacion"  class="form-control" value="{{ old('telefono_organizacion') }}">
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Región</label>
                                    <select class="form-select" id="region" name="region" value={{old('region')}} >
                                        <option value="" selected disabled hidden></option>
                                        @foreach ($regiones as $region)
                                            <option value="{{ $region->id }}" >{{ $region->nombre_region }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Comuna</label>
                                    <select class="form-select" id="comuna" disabled name="comuna"  >
                                        <option value="" selected disabled hidden></option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="password">Contraseña</label>
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="password">Repetir Contraseña</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required >
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <a  href="{{ route('login') }}">Ya estoy registrado</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Latest Orders -->
        </div>

        <script>
            $(document).ready(function () 
            {
                var regiones =  {!! json_encode($regiones->toArray()) !!};

                $('#region').change(function () {
                    var valorRegion = $(this).val();
                    regiones.map(region => {
                        if (region.id == valorRegion) {
                            region.provincia.map( provincia => {
                                const opcion_vacia = '<option value="" selected disabled hidden></option>'
                                const comunas_region = provincia.comuna.map(comuna =>{
                                     return '<option value="' + comuna.id + '">' + comuna.nombre_comuna + '</option>';
                                });
                                const opciones = opcion_vacia + comunas_region
                                $('#comuna').html(opciones);
                            })
                        }
                        
                    });
                    $('#comuna').removeAttr("disabled");
                });

            });
        </script>
    @endsection
