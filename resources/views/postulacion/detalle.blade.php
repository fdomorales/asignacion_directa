@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <a class="breadcrumb-item" href="{{ route('postulacion.index') }}">Postulaciones</a>
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
                    <h3 class="block-title text-uppercase">Actualizar Postulación</h3>
                    <div class="block-options">
                        <a href="{{ route('postulacion.edit', ['postulacion' => $postulacion->id]) }}">
                            <button class="btn btn-primary">Editar</button></a>
                    </div>
                </div>
                <div class="block-content ">
                    <form>
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
                                <input type="text" name="nombre_organizacion" disabled class="form-control"
                                    value="{{ $postulacion->organizacion->nombre_organizacion }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Teléfono de contacto</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+56</span>
                                    <input type="text" name="telefono_organizacion" disabled class="form-control"
                                        value="{{ $postulacion->organizacion->telefono_organizacion }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Correo</label>
                                <input type="text" name="correo_organizacion" disabled class="form-control"
                                    value="{{ $postulacion->organizacion->correo_organizacion }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Periodo</label>
                                <input type="text" name="correo_organizacion" disabled class="form-control"
                                    value="{{ $postulacion->periodo->descripcion }} / {{ $postulacion->periodo->fecha_inicio }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ">
                                <label>Cupos</label>
                                <input type="text" name="correo_organizacion" disabled class="form-control"
                                    value="{{ $postulacion->cupos }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group ">
                                <label>Estado</label>
                                <input type="text" name="correo_organizacion" disabled class="form-control"
                                    value="{{ $postulacion->estado_postulacion->nombre_estado_postulacion }}">
                            </div>
                        </div>

                    </form>
                    <div class="my-10">
                        <label>Documento adjunto</label>
                        <a href="{{ route('postulacion_documento', $postulacion->token_documento) }}"
                            target="_blank">{{ $postulacion->nombre_documento }}</a>
                    </div>
                </div>
                @if ($postulacion->estado_postulacion->id == 1)
                <div class="block-header">
                    <div class="block-options">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalConfirm">Asignar viajes</button>
                    </div>
                </div>
                @else
                <div class="block-header">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalDecline">Rechazar postulación</button>
                    <div class="block-options">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAcept">Aceptar postulación</button>
                    </div>
                </div>
                    
                @endif

                <!-- Modal Aceptar -->
                <div class="modal fade" id="ModalAcept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Está seguro que desea aceptar la postulación de la organizacion {{$postulacion->organizacion->nombre_organizacion}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <form action="{{route('aceptar_postulacion', ['id'=> $postulacion->id])}}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Sí, aceptar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Asignar viajes -->
                <div class="modal fade" id="ModalConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Está seguro que desea permitir tomar viajes a la organización {{$postulacion->organizacion->nombre_organizacion}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <form action="{{route('asigna_viajes_postulacion', ['id'=> $postulacion->id])}}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Sí, aceptar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Rechazar -->
                <div class="modal fade" id="ModalDecline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Está seguro que desea rechazar la postulación de la organizacion {{$postulacion->organizacion->nombre_organizacion}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <form action="{{route('rechazar_postulacion', ['id'=> $postulacion->id])}}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Sí</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Latest Orders -->
    </div>
@endsection
