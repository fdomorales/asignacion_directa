@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <a class="breadcrumb-item" href="{{route('index_customer')}}">Postulaciones</a>
            <span class="breadcrumb-item active">Formulario</span>
        </nav>
    </div>
@endsection

@section('contenido')
    <!-- More Data -->
    <div class="row justify-content-center">
        <!-- Latest Orders -->
        <div class="col-12 col-sm-7">
            <div class="block block-rounded block-bordered p-5">
                <div class="block-header">
                    <h3 class="block-title text-uppercase">Nueva Postulación</h3>
                </div>
                <div class="block-content ">
                    <form action="{{route('store_by_customer')}}" method="POST" enctype="multipart/form-data">
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
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if (session('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('fail')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                <div class="input-group">
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
                        <hr>
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <table class="table table-borderless table-hover table-responsive-sm table-responsive-md table-striped mb-0">
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
        
                                    {{-- table representantes --}}
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
                                            <td class="">
                                                <span >{{$representante->telefono_representante}}</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="block-options">
                                                    {{-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                                        <a href=""><i class="fa fa-edit"></i></a>
                                                    </button> --}}
                                                    <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-edit-{{$representante->id}}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-delete-{{$representante->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
            
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        
                        <hr>
                        {{-- end table representantes --}}

                        @if (isset($periodo))
                        <div class="row">
                            <div class="form-group ">
                                <label>Periodo</label>
                                <input type="text" disabled class="form-control" value="{{$periodo->descripcion}} / {{$periodo->fecha_inicio}} - {{$periodo->fecha_fin}}">
                                <input type="text" name="periodo" hidden  value="{{$periodo->id}}">
                                {{-- <select class="form-select" name="periodo" >
                                    <option value="" selected disabled hidden></option>
                                        <option value="{{$periodo->id}}">{{$periodo->descripcion}} / {{$periodo->fecha_inicio}}</option>
                                </select> --}}
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
                                    <input class="form-check-input" type="checkbox" value="1"  name="acepta_terminos_y_condiciones">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Acepta terminos y condiciones <a href="#" data-toggle="modal" data-target="#Modal-tyc">(ver aquí)</a>
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

                    {{-- inicio modales --}}
                    @foreach ($representantes as $representante)
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
                                        <input type="text" hidden name="organizacion_id" value="{{$usuario->organizacion->id}}">
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
                                    <input type="text" hidden name="organizacion_id" value="{{$usuario->organizacion->id}}">
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
                    <div class="modal fade" id="Modal-tyc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Términos y condiciones</h5>
                              <button  type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    {{-- fin modales --}}
                </div>
            </div>
        </div>
    </div>
    <!-- END Latest Orders -->
    </div>
@endsection
