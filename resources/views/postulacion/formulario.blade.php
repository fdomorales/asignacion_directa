@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <a class="breadcrumb-item" href="{{route('postulacion.index')}}">Postulaciones</a>
            <span class="breadcrumb-item active">Formulario</span>
        </nav>
    </div>
@endsection

@section('contenido')
    <!-- More Data -->
    <div class="row justify-content-center">
        <!-- Latest Orders -->
        <div class="col-7">
            <div class="block block-rounded block-bordered p-5">
                <div class="block-header">
                    <h3 class="block-title text-uppercase">Nueva Postulación</h3>
                    <!-- <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                    <button type="button" class="btn-block-option">
                                        <i class="si si-wrench"></i>
                                    </button>
                                </div> -->
                </div>
                <div class="block-content ">
                    <form action="{{route('postulacion.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @error('descripcion')
                            <h6 class="alert alert-danger">{{ $message }}</h6>
                        @enderror
                        @if ($errors->any())
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="form-group ">
                                <label>Nombre organización</label>
                                <input type="text" name="nombre_organizacion" disabled class="form-control" value="{{ $usuario->organizacion->nombre_organizacion }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Teléfono de contacto</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+56</span>
                                    <input type="text" name="telefono_organizacion" disabled class="form-control" value="{{ $usuario->organizacion->telefono_organizacion }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Correo</label>
                                <input type="text" name="correo_organizacion" disabled class="form-control" value="{{ $usuario->organizacion->correo_organizacion }}">
                            </div>
                        </div>
                        @if (isset($periodo))
                        <div class="row">
                            <div class="form-group ">
                                <label>Periodo</label>
                                <select class="form-select" name="periodo" >
                                    <option value="" selected disabled hidden></option>
                                        <option value="{{$periodo->id}}">{{$periodo->descripcion}} / {{$periodo->fecha_inicio}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Cupos</label>
                                <select class="form-select" name="cupos" id="">
                                    <option value="" selected disabled hidden></option>
                                    <option value="20">20</option>
                                    <option value="40">40</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Documento</label>
                                <input type="file" name="documento"  class="form-control" >
                            </div>
                        </div>
                        <div class="container py-5 my-5">

                            <div class="row py-5 my-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" required name="acepta_terminos_y_condiciones">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Acepta terminos y condiciones
                                    </label>
                                </div>
                            </div>
                            <div class="row py-5 my-5">
                                <div class="form-check">
                                    <input type='hidden' value='0' name='recibe_info'>
                                    <input class="form-check-input" type="checkbox" value="1" name="recibe_info">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Desea recibir info por correo
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-5">Guardar</button>
                        @else
                        <h5 class="alert alert-warning">En este momento no hay periodos disponibles para su región</h5>
                        @endif
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Latest Orders -->
    </div>
@endsection
