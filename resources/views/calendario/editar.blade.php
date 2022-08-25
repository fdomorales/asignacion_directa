@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <a class="breadcrumb-item" href="{{route('calendario.index')}}">Calendarios</a>
            <span class="breadcrumb-item active">Calendario {{$calendario->id}}</span>
        </nav>
    </div>
@endsection

@section('contenido')
    <!-- More Data -->
    <div class="row justify-content-center">
        <!-- Latest Orders -->
        <div class="col-12 col-lg-10">
            <div class="block block-rounded block-bordered p-5">
                <div class="block-header">
                    <h3 class="block-title text-uppercase">Calendario {{$calendario->periodo->descripcion}}</h3>
                    <div class="block-options">
                        @role('Admin')
                            <a href="" data-toggle="modal" data-target="#Modal-create-travel">Agregar viaje</a>
                        @endrole
                    </div>
                </div>
                <div class="block-content ">
                    <form action="{{route('calendario.update', ['calendario'=>$calendario->id])}}" method="POST" >
                        @method('PATCH')
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

                        <div class="row justify-content-center">
                            <div class="form-group col-sm-6">
                                <label>Periodo</label>
                                <input class="form-control" type="text" value="{{$calendario->periodo->descripcion}}" disabled>
                            </div>
                            <div class="form-group col-sm-6">
                            </div>
                        </div>
                        @if ($calendario->estado_calendario == 0)
                        <button type="submit" class="btn btn-primary mt-5">Procesar</button>
                        @endif
                    </form>
                </div>
                <table class="table table-borderless table-hover table-striped mb-0 mt-10">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th class="d-none d-sm-table-cell">Fecha de inicio</th>
                            <th class="d-none d-sm-table-cell">Fecha de término</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viajes_calendario as $viaje)
                        <tr>
                            <td>{{$viaje->id}}</td>
                            <td>{{$viaje->origen_viaje}}</td>
                            <td>{{$viaje->destino_viaje}}</td>
                            <td>{{$viaje->inicio_viaje}}</td>
                            <td>{{$viaje->fin_viaje}}</td>
                            <td class="text-right">
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-edit-{{$viaje->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-delete-{{$viaje->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Editar -->
                        <div class="modal fade p-0" id="Modal-edit-{{$viaje->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar datos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form  action="{{route('viaje.update', ['viaje'=>$viaje->id])}}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" hidden name="viaje_id" value="{{$viaje->id}}">
                                      <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Origen</label>
                                        <input type="text" class="form-control" name="origen" value="{{$viaje->origen_viaje}}">
                                      </div>
                                      <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Destino</label>
                                        <input type="text" class="form-control" name="destino" value="{{$viaje->destino_viaje}}">
                                      </div>
                                      <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Fecha Inicio</label>
                                        <input type="date" class="form-control bg-white " id="fecha_inicio" 
                                        name="fecha_inicio" data-enable-time="true" data-time_24hr="true" value="{{$viaje->inicio_viaje}}">
                                      </div>
                                      <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Fecha Término</label>
                                        <input type="date" class="form-control bg-white " id="fecha_fin" 
                                        name="fecha_fin" data-enable-time="true" data-time_24hr="true" value="{{$viaje->fin_viaje}}">
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
                        <div class="modal fade p-0" id="Modal-delete-{{$viaje->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de desea eliminar el viaje n° {{$viaje->id}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <form action="{{route('viaje.destroy', ['viaje'=>$viaje->id])}}" method="POST">
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
                       
                    </tbody>
                </table>
                <a class="" href="{{route('descargar_calendario', ['id'=>$calendario->id])}}"><i class="fa fa-download"></i> bajar excel</a>

                <!-- Modal create viaje -->
                <div class="modal fade  p-0" id="Modal-create-travel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar comuna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  action="{{route('viaje.store', ['calendario_id'=>$calendario->id])}}" method="POST">
                            @csrf
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Origen viaje</label>
                                <input type="text" class="form-control" name="origen_viaje" value="">
                              </div>
                              <div class="form-group">
                               <label for="recipient-name" class="col-form-label">Destino viaje</label>
                               <input type="text" class="form-control" name="destino_viaje" value="">
                             </div>
                             <div class="form-group">
                                 <label>Fecha inicio</label>
                                 <input type="date" class="form-control bg-white " id="fecha_inicio" name="fecha_inicio"
                                     value="" data-enable-time="true" data-time_24hr="true">
                             </div>
                             <div class="form-group">
                                 <label>Fecha fin</label>
                                 <input type="date" class="form-control bg-white " id="fecha_fin" name="fecha_fin"
                                     value="" data-enable-time="true" data-time_24hr="true">
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
            </div>
        </div>
    </div>
    <!-- END Latest Orders -->
    </div>
@endsection
