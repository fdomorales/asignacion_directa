@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            @can('organizaciones.index')
            <a class="breadcrumb-item" href="{{ route('organizacion.index') }}">Organizaciones</a>
                
            @endcan
            <span class="breadcrumb-item active">{{$organizacion->nombre_organizacion}}</span>
        </nav>
    </div>
@endsection

@section('contenido')
    <!-- More Data -->
    <div class="row justify-content-center">
        <!-- Latest Orders -->
        <div class="col-lg-10">
            <div class="block block-rounded block-bordered">
                <div class="block-header">
                    <h3 class="block-title text-uppercase">Datos organización:</h3>
                     <div class="block-options">
                        <a href="{{route('organizacion.edit', ['organizacion'=> $organizacion->id])}}">
                        <button class="btn btn-primary">Editar</button></a>
                        </div>
                </div>
                <div class="block-content p-5">
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

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Nombre Organización</label>
                                <input class="form-control  " disabled
                                    value="{{$organizacion->nombre_organizacion}}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Correo</label>
                                <input class="form-control  " disabled
                                    value="{{$organizacion->correo_organizacion}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Teléfono</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+56</span>
                                    <input type="text" name="telefono_organizacion" disabled class="form-control" value="{{$organizacion->telefono_organizacion}}">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Comuna</label>
                                <input class="form-control  " disabled
                                    value="{{$organizacion->comuna->nombre_comuna}}">
                            </div>
                        </div>


                        <table class="table table-borderless table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <h3 class="block-title text-uppercase">Representantes</h3>
                                    <a href="" data-toggle="modal" data-target="#Modal-create"><i class="fa fa-plus-circle"></i> Agregar representante </a>

                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th class="d-none d-sm-table-cell">Teléfono</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($representantes as $representante)
                                <tr >  
                                    <td>
                                        <span >{{$representante->nombre_representante}}</span>
                                    </td>
                                    <td>
                                        <span >{{$representante->apellido_representante}}</span>
                                    </td>
                                    <td>
                                        <span >{{$representante->correo_representante}}</span>
                                    </td>
                                    <td>
                                        <span >{{$representante->telefono_representante}}</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-edit-{{$representante->id}}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-delete-{{$representante->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                 

                                <!-- Modal Editar -->
                                <div class="modal fade p-0" id="Modal-edit-{{$representante->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar datos</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form  action="{{route('representante.update', ['representante'=>$representante->id])}}" method="POST">
                                            @method('PATCH')
                                            @csrf
                                            <input type="text" hidden value="{{$representante->organizacion_id}}">
                                            <div class="modal-body">
                                                <input type="text" hidden name="organizacion_id" value="{{$organizacion->id}}">
                                              <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Nombre</label>
                                                <input type="text" class="form-control" name="nombre_representante" value="{{$representante->nombre_representante}}">
                                              </div>
                                              <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Apellido</label>
                                                <input type="text" class="form-control" name="apellido_representante" value="{{$representante->apellido_representante}}">
                                              </div>
                                              <div class="form-group">
                                                <label for="message-text" class="col-form-label">Correo</label>
                                                <input type="text" class="form-control" name="correo_representante" value="{{$representante->correo_representante}}">
                                              </div>
                                              <div class="form-group">
                                                <label for="message-text" class="col-form-label">Teléfono</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" >+56</span>
                                                    <input type="text" name="telefono_representante"  class="form-control" value="{{$representante->telefono_representante}}">
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                              </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->

                                <!-- Modal Delete -->
                                <div class="modal fade p-0" id="Modal-delete-{{$representante->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro de desea eliminar el representante {{$representante->nombre_representante}} {{$representante->apellido_representante}} ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <form action="{{route('representante.destroy', ['representante'=>$representante->id])}}" method="POST">
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
    
                               <!-- Modal create representante -->
                               <div class="modal fade p-0" id="Modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Agregar representante</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form  action="{{route('representante.store')}}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="text" hidden name="organizacion_id" value="{{$organizacion->id}}">
                                          <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Nombre</label>
                                            <input type="text" class="form-control" name="nombre_representante" value="{{old('nombre_representante')}}">
                                          </div>
                                          <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Apellido</label>
                                            <input type="text" class="form-control" name="apellido_representante" value="{{old('apellido_representante')}}">
                                          </div>
                                          <div class="form-group">
                                            <label for="message-text" class="col-form-label">Correo</label>
                                            <input type="text" class="form-control" name="correo_representante" value="{{old('correo_representante')}}">
                                          </div>
                                          <div class="form-group">
                                            <label for="message-text" class="col-form-label">Teléfono</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" >+56</span>
                                                <input type="text" name="telefono_representante"  class="form-control" value="{{old('telefono_representante')}}">
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
