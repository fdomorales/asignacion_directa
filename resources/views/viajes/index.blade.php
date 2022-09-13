@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <span class="breadcrumb-item active">Viajes</span>
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
                    <h3 class="block-title text-uppercase">Viajes</h3>
                    <div class="block-options">
                        <a href="{{ route('descargar_pasajeros')}}">
                            Descargar listado pasajeros <i class="fa fa-download"></i>
                        </a><br>
                        <a href="{{ route('descargar_viajes')}}">
                            Descargar listado viajes <i class="fa fa-download"></i>
                        </a>
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
                    @if (session('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('fail')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table id="tabla_viajes" class="table table-responsive-sm table-borderless table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th class="">Periodo</th>
                                <th class="">Organización</th>
                                <th class="">Pasajeros</th>
                                @role('Admin')<th></th>@endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viajes as $viaje)
                            
                            <tr>
                                <td><span>{{$viaje->id}}</span></td>  
                                <td><span>{{$viaje->origen_viaje}}</span></td>
                                <td><span>{{$viaje->destino_viaje}}</span></td>
                                <td><span>{{$viaje->calendarios->periodo->descripcion}}</span></td>
                                <td>
                                    @if ($viaje->postulacion->organizacion)
                                        {{$viaje->postulacion->organizacion->nombre_organizacion}}
                                    @else
                                        no asignado
                                    @endif
                                </td>
                                <td>
                                    @if ($viaje->postulacion->organizacion)
                                        {{$viaje->pasajeros->count()}} / {{$viaje->postulacion->cupos}}
                                    @else
                                        -
                                    @endif
                                </td>
                                @role('Admin')
                                    <td class="text-right">
                                        <div class="block-options">
                                            {{-- <button type="button" class="btn-block-option" >
                                                <a href=""><i class="fa fa-download"></i></a>
                                            </button> --}}
                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                                <a href="{{route('viaje.show', ['viaje'=> $viaje->id])}}"><i class="fa fa-eye"></i></a>
                                            </button>

                                            <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-{{$viaje->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>    
                                        </div>
                                    </td>
                                @endrole
                            </tr>

                            <!-- Modal Delete -->
                            <div class="modal fade p-0" id="Modal-{{$viaje->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                </div>
            </div>
            {{$viajes->links('pagination::bootstrap-5')}}
        </div>
        <!-- END Latest Orders -->
    </div>
    <script>
        $(document).ready(function () {
            $('#tabla_viajes').DataTable({
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
    <!-- END More Data -->
@endsection