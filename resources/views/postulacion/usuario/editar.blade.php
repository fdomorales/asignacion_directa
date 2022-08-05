@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <a class="breadcrumb-item" href="{{route('postulacion.index')}}">Postulaciones</a>
            <a class="breadcrumb-item" href="{{route('postulacion.show', ['postulacion'=>$postulacion->id])}}">Formulario</a>
            <span class="breadcrumb-item active">Editar</span>
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
                    <h3 class="block-title text-uppercase">Actualizar Postulación</h3>
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
                    <form action="{{route('edit_by_customer', ['id'=>$postulacion->id])}}" method="POST">
                        @method('PATCH')
                        @csrf
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
                                <input type="text" name="nombre_organizacion" disabled class="form-control" value="{{$postulacion->organizacion->nombre_organizacion}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Teléfono de contacto</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+56</span>
                                    <input type="text" name="telefono_organizacion" disabled class="form-control" value="{{$postulacion->organizacion->telefono_organizacion}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Correo</label>
                                <input type="text" name="correo_organizacion" disabled class="form-control" value="{{$postulacion->organizacion->correo_organizacion}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Periodo</label>
                                <select class="form-select" name="periodo" >
                                    <option value="{{$postulacion->periodo_id}}" selected  hidden>{{$postulacion->periodo->descripcion}} / {{$postulacion->periodo->fecha_inicio}}</option>
                                    @foreach ($periodos as $periodo)
                                        <option value="{{$periodo->id}}">{{$periodo->descripcion}} / {{$periodo->fecha_inicio}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Cupos</label>
                                <select class="form-select" name="cupos">
                                    <option value="{{$postulacion->cupos}}" selected  hidden>{{$postulacion->cupos}}</option>
                                    <option value="20">20</option>
                                    <option value="40">40</option>
                                </select>
                            </div>
                        </div>
                        

                        <button type="submit" class="btn btn-primary mt-5">Guardar</button>
                    </form>
                    <div class="my-10">
                        <label >Documento adjunto</label>
                        <a  href="{{route('postulacion_documento', $postulacion->token_documento)}}"  target="_blank">{{$postulacion->nombre_documento}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Latest Orders -->
    </div>
@endsection
