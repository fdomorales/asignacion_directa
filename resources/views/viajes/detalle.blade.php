@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            @can('organizaciones.index')
                <a class="breadcrumb-item" href="">Organizaciones</a>
            @endcan
            <span class="breadcrumb-item active"></span>
        </nav>
    </div>
@endsection

@section('contenido')
    <!-- More Data -->
    <div class="row justify-content-center">
        <!-- Latest Orders -->
        <div class="col-12">
            <div class="block block-rounded block-bordered">
                <div class="block-header">
                    <h3 class="block-title text-uppercase">Datos del viaje:</h3>
                    {{-- <div class="block-options">
                        <a href="">
                        <button class="btn btn-primary">Editar</button></a>
                        </div> --}}
                </div>
                <div class="block-content p-5">
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
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Nombre Organización</label>
                            <input class="form-control  " disabled value="{{ $organizacion->nombre_organizacion }}">
                        </div>
                        {{-- <div class="form-group col-sm-6">
                                <label>Correo</label>
                                <input class="form-control  " disabled
                                    value="">
                            </div> --}}
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Origen</label>
                            <input class="form-control  " disabled value="{{ $viaje->origen_viaje }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Destino</label>
                            <input class="form-control  " disabled value="{{ $viaje->destino_viaje }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Fecha Inicio</label>
                            <input class="form-control  " disabled value="{{ $viaje->inicio_viaje }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Fecha Fin</label>
                            <input class="form-control  " disabled value="{{ $viaje->fin_viaje }}">
                        </div>
                    </div>


                    <table class="table table-borderless table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <h3 class="block-title text-uppercase">Pasajeros</h3>
                                <button type="button" class="btn-block-option" data-toggle="modal"
                                    data-target="#Modal-create">
                                    <i class="fa fa-plus-circle"></i>
                                </button>

                            </tr>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Contacto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasajeros as $pasajero)
                                <tr>
                                    <td>
                                        <span>{{ $pasajero->nombre_pasajero }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $pasajero->apellido_pasajero }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $pasajero->fecha_nacimiento_pasajero }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $pasajero->direccion_pasajero }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $pasajero->telefono_pasajero }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $pasajero->contacto_pasajero }}</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="block-options">
                                            {{-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                                <a href=""><i class="fa fa-edit"></i></a>
                                            </button> --}}
                                            <button type="button" class="btn-block-option" data-toggle="modal"
                                                data-target="#Modal-edit-{{ $pasajero->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn-block-option" data-toggle="modal"
                                                data-target="#Modal-delete-{{ $pasajero->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>


                                <!-- Modal Editar -->
                                <div class="modal fade p-0" id="Modal-edit-{{ $pasajero->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar datos</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('pasajero.update', ['pasajero'=>$pasajero->id]) }}" method="POST">
                                                @method('PATCH')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Nombre</label>
                                                        <input type="text" class="form-control" name="nombre_pasajero"
                                                            value="{{ $pasajero->nombre_pasajero }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Apellido</label>
                                                        <input type="text" class="form-control" name="apellido_pasajero"
                                                            value="{{ $pasajero->apellido_pasajero }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Fecha de
                                                            nacimiento</label>
                                                        <input type="date" class="form-control"
                                                            name="fecha_nacimiento_pasajero" value="{{$pasajero->fecha_nacimiento_pasajero}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Dirección</label>
                                                        <input type="text" class="form-control"
                                                            name="direccion_pasajero" value="{{ $pasajero->direccion_pasajero }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Teléfono</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">+56</span>
                                                            <input type="text" name="telefono_pasajero"
                                                                class="form-control" value="{{ $pasajero->telefono_pasajero }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Teléfono de
                                                            contacto</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">+56</span>
                                                            <input type="text" name="contacto_pasajero"
                                                                class="form-control" value="{{ $pasajero->contacto_pasajero }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->

                                <!-- Modal Delete -->
                                <div class="modal fade p-0" id="Modal-delete-{{ $pasajero->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de desea eliminar el pasajero {{$pasajero->nombre_pasajero}} {{$pasajero->apellido_pasajero}}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">No</button>
                                                <form action="{{route('pasajero.destroy', ['pasajero'=>$pasajero->id])}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Sí, eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            @endforeach

                            <!-- Modal create pasajero -->
                            <div class="modal fade p-0" id="Modal-create" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Agregar pasajero</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('pasajero.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="text" hidden name="viaje_id"
                                                    value="{{ $viaje->id }}">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Nombre</label>
                                                    <input type="text" class="form-control" name="nombre_pasajero"
                                                        value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Apellido</label>
                                                    <input type="text" class="form-control" name="apellido_pasajero"
                                                        value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Fecha de
                                                        nacimiento</label>
                                                    <input type="date" class="form-control"
                                                        name="fecha_nacimiento_pasajero" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Dirección</label>
                                                    <input type="text" class="form-control" name="direccion_pasajero"
                                                        value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Teléfono</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">+56</span>
                                                        <input type="text" name="telefono_pasajero"
                                                            class="form-control" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Teléfono de
                                                        contacto</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">+56</span>
                                                        <input type="text" name="contacto_pasajero"
                                                            class="form-control" value="">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Latest Orders -->
    </div>
@endsection
