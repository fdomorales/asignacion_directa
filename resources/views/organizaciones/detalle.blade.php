@extends('layouts.app')

@section('breadcrumb')
    <div class="content">
        <nav class="migas">
            <a href="/">inicio / </a>
            @can('organizaciones.index')
                <a class="breadcrumb-item" href="{{ route('organizacion.index') }}">Organizaciones</a>
            @endcan
            <span  class="active">Mi perfil </span>
        </nav>
    </div>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-md-12">
            @csrf
            <!-- @error('descripcion')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror -->
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
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="sombra borde bg-white p-4 mb-4">
                <h4>Mi agrupación</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group col-sm-12">
                            <label>Nombre Organización</label>
                                <input class="form-control" disabled value="{{$organizacion->nombre_organizacion}}">
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Correo</label>
                            <input class="form-control" disabled value="{{$organizacion->correo_organizacion}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group col-sm-12">
                            <label>Teléfono</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">+56</span>
                                    <input type="text" name="telefono_organizacion" disabled class="form-control" value="{{$organizacion->telefono_organizacion}}">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Comuna</label>
                            <input class="form-control" disabled value="{{$organizacion->comuna->nombre_comuna}}">
                        </div>
                    </div>
                    <center class="mt-4 mb-4" ><a href="{{route('organizacion.edit', ['organizacion'=> $organizacion->id])}}"><button class="btn btn-verde">Editar perfil</button></a></center>

                    <div class="col-md-12">
                        <h4>Representantes</h4>

                        @if(!isset($representantes) || $representantes->count() < 2)
                            <center><a class="btn btn-verde" href="" data-toggle="modal" data-target="#Modal-create"><i class="fa fa-plus-circle"></i> Agregar representante </a></center>
                        @endif

                        <table class="table table-borderless table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th class="d-none d-sm-table-cell">Teléfono</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($representantes as $representante)
                                    <tr>
                                        <td><span>{{$representante->nombre_representante}}</span></td>
                                        <td><span>{{$representante->apellido_representante}}</span></td>
                                        <td><span>{{$representante->correo_representante}}</span></td>
                                        <td><span>{{$representante->telefono_representante}}</span></td>
                                        <td class="text-right">
                                            <div class="block-options">
                                                <button type="button" class="btn-block-option" id="edit-representante" data-toggle="modal" data-id-representante="{{ $representante->id }}" data-id-organizacion="{{ $organizacion->id }}"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn-block-option" id="delete-representante" data-toggle="modal" data-id-representante="{{ $representante->id }}" data-id-organizacion="{{ $organizacion->id }}"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- inicio modales --}}
    <!-- Modal Editar -->
    <div class="modal fade p-0" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="borde modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmEditRepresentante" action="" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="text" hidden name="organizacion_id" id="organizacion_id" value="">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre_representante" id="nombre_representante" value="">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Apellido</label>
                            <input type="text" class="form-control" name="apellido_representante" id="apellido_representante" value="">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Correo</label>
                            <input type="text" class="form-control" name="correo_representante" id="correo_representante" value="">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Teléfono</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" >+56</span>
                                <input type="text" name="telefono_representante" class="form-control" id="telefono_representante" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal Delete -->
    <div class="modal fade p-0" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <form id="frmDeleteRepresentante" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-rojo">Sí, eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal create representante -->
    <div class="modal fade p-0" id="Modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content borde">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar representante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  action="{{route('representante.store')}}" method="POST">
                        @csrf
                        <input type="text" hidden name="organizacion_id" value="{{$organizacion->id}}">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="recipient-name" class="col-form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre_representante" value="{{old('nombre_representante')}}">
                            </div>
                            <div class="col-md-12">
                                <label for="recipient-name" class="col-form-label">Apellido</label>
                                <input type="text" class="form-control" name="apellido_representante" value="{{old('apellido_representante')}}">
                            </div>
                            <div class="col-md-12">
                                <label for="message-text" class="col-form-label">Correo</label>
                                <input type="text" class="form-control" name="correo_representante" value="{{old('correo_representante')}}">
                            </div>
                            <div class="col-md-12">
                                <label for="message-text" class="col-form-label">Teléfono</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" >+56</span>
                                    <input type="text" name="telefono_representante"  class="form-control" value="{{old('telefono_representante')}}">
                                </div>
                            </div>
                        </div>
                        <center><button type="submit" class="btn btn-verde">Agregar</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', 'button[id="edit-representante"]', function(){
                var idRepresentante = $(this).attr('data-id-representante');
                var idOrganizacion = $(this).attr('data-id-organizacion');

                var $row = $(this).closest("tr");
                var nombre = $row.find("td:nth-child(1)").text();
                var apellido = $row.find("td:nth-child(2)").text();
                var correo = $row.find("td:nth-child(3)").text();
                var telefono = $row.find("td:nth-child(4)").text();

                $("#organizacion_id").val(idOrganizacion);

                $("#nombre_representante").val(nombre);
                $("#apellido_representante").val(apellido);
                $("#correo_representante").val(correo);
                $("#telefono_representante").val(telefono);

                $("#frmEditRepresentante").attr("action", "{{ url('representante') }}/" + idRepresentante);

                $('#ModalEdit').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
            });

            $('body').on('click', 'button[id="delete-representante"]', function() {
                var idRepresentante = $(this).attr('data-id-representante');
                var idOrganizacion = $(this).attr('data-id-organizacion');

                var $row = $(this).closest("tr");
                var nombre = $row.find("td:nth-child(1)").text();
                var apellido = $row.find("td:nth-child(2)").text();

                $('#ModalDelete .modal-body').html('¿Está seguro de desea eliminar el representante ' + nombre + ' ' + apellido + '?');

                $("#frmDeleteRepresentante").attr("action", "{{ url('representante') }}/" + idRepresentante);

                $('#ModalDelete').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
            });

            $('#ModalEdit').on('hidden.bs.modal', function() {
                //$('#modalRegistro .modal-body').html('');
            });

            $('#ModalDelete').on('hidden.bs.modal', function() {
                $('#ModalDelete .modal-body').html('');
            });
        });
    </script>
@endsection
