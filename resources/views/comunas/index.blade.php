@extends('inicio')


@section('css')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <span class="breadcrumb-item active">Comunas</span>
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
                    <h3 class="block-title text-uppercase">Comunas</h3>
                    <div class="block-options">
                        @role('Admin')
                            <a href="" data-toggle="modal" data-target="#Modal-create">Agregar comuna</a>
                        @endrole
                    </div>
                </div>
                <div class="block-content p-5">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table id="tabla_comunas" class="table table-responsive-sm table-borderless table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Alias</th>
                                <th class="">Provincia</th>
                                <th class="text-right">Región</th>
                                @role('Admin')
                                <th class=""></th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comunas as $comuna)
                            <tr >
                                <td><span>{{$comuna->id}}</span></td>  
                                <td><span>{{$comuna->codigo_comuna}}</span></td>  
                                <td>
                                    <span >{{$comuna->nombre_comuna}}</span>
                                </td>
                                <td>
                                    <span >{{$comuna->alias_comuna}}</span>
                                </td>
                                <td>
                                    <span >{{$comuna->provincia->nombre_provincia}}</span>
                                </td>
                                <td class="text-right">
                                    <span>{{$comuna->provincia->region->nombre_region}}</span>
                                </td>
                                @role('Admin')
                                <td class="text-right">
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-edit-{{$comuna->id}}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-delete-{{$comuna->id}}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                @endrole
                            </tr>

                            
                                <!-- Modal Editar -->
                                <div class="modal fade p-0" id="Modal-edit-{{$comuna->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar datos</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form  action="{{route('comunas.update', ['comuna'=> $comuna->id])}}" method="POST">
                                            @method('PATCH')
                                            @csrf
                                            <div class="modal-body">
                                              <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Nombre</label>
                                                <input type="text" class="form-control" name="nombre_comuna" value="{{$comuna->nombre_comuna}}">
                                              </div>
                                              <div class="form-group">
                                               <label for="recipient-name" class="col-form-label">Alias</label>
                                               <input type="text" class="form-control" name="alias_comuna" value="{{$comuna->alias_comuna}}">
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
                            <div class="modal fade p-0" id="Modal-delete-{{$comuna->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de desea eliminar la comuna {{$comuna->nombre_comuna}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <form action="{{route('comunas.destroy', ['comuna'=>$comuna->id])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->    
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                    <!-- Modal create comuna -->
                    <div class="modal fade  p-0" id="Modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                         <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Agregar comuna</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <form  action="{{route('comunas.store')}}" method="POST">
                             @csrf
                             <div class="modal-body">
                               <div class="form-group">
                                 <label for="recipient-name" class="col-form-label">Nombre</label>
                                 <input type="text" class="form-control" name="nombre_comuna" value="{{old('nombre_comuna')}}">
                               </div>
                               <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Alias</label>
                                <input type="text" class="form-control" name="alias_comuna" value="{{old('alias_comuna')}}">
                              </div>
                              <div class="form-group">
                                  <label>Provincia</label>
                              <select class="form-select" name="provincia">
                                  <option value="" selected disabled hidden></option>
                                  @foreach ($provincias as $provincia)
                                      <option value="{{ $provincia->id }}">{{ $provincia->nombre_provincia }}</option>
                                  @endforeach
                              </select>
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
            {{-- {{$comunas->links('pagination::bootstrap-5')}} --}}
        </div>
        <!-- END Latest Orders -->
    </div>
    <!-- END More Data -->

    
    <script>
        $(document).ready(function () {
            $('#tabla_comunas').DataTable({
                responsive: true, 
                autoWidth: false,
                language:{
                    "decimal":        "",
                    "emptyTable":     "Sin datos",
                    "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered":   "(Filtrado de _MAX_ registros totales)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Mostrar _MENU_ registros",
                    "loadingRecords": "Loading...",
                    "processing":     "",
                    "search":         "Buscar:",
                    "zeroRecords":    "No se encontraron registros para la búsqueda",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Último",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                }
            });
        });
    </script>
@endsection