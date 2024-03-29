@extends('layouts.app')

@section('breadcrumb')
    <div class="content">
        <nav class="migas">
            <a href="/">Inicio / </a>
            <span  class="active">Postulaciones </span>
        </nav>
    </div>
@endsection

@section('contenido')
    <div class="col-md-12">
        <div class="sombra borde bg-white p-4">
            <div class="block-header">
                <h4>Postulaciones</h4>
                <div class="block-options">
                    <a class="btn btn-azul" href="{{ route('descargar_postulaciones')}}">Descargar listado <i class="fa fa-download"></i></a>
                </div>
            </div>
            <div class="block-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('fail')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif
                <table id="tabla_postulaciones" class="table table-responsive-sm table-borderless table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Organización</th>
                            <th>Periodo</th>
                            <th class="d-none d-sm-table-cell">Cupos</th>
                            <th class="text-right">Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($postulaciones as $postulacion)
                            <tr>
                                <td><span>{{$postulacion->id}}</span></td>
                                <td><a href=""><span>{{$postulacion->organizacion->nombre_organizacion}}</span></a></td>
                                <td><span>{{$postulacion->periodo->descripcion}}</span></td>
                                <td><span>{{$postulacion->cupos}}</span></td>
                                <td class="text-right">
                                    <span class="badge @switch($postulacion->estado_postulacion_id)
                                        @case(2) badge-warning @break @case(1) badge-success @break @case(3) badge-danger @break @case(4) badge-primary @break @default badge-warning @endswitch ">
                                        {{$postulacion->estado_postulacion->nombre_estado_postulacion}}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <div class="block-options">
                                        @role('Admin')
                                            @if ($postulacion->periodo->calendario)
                                                @if ($postulacion->estado_postulacion_id == 1 && $postulacion->periodo->calendario->estado_calendario == 1)
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalConfirm-{{$postulacion->id}}">Asignar viajes</button>
                                                @endif
                                            @endif
                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                                <a href="{{route('postulacion.show',['postulacion'=>$postulacion->id])}}"><i class="fa fa-eye"></i></a>
                                            </button>
                                        @endrole
                                        <button type="button" class="btn-block-option" >
                                            <a href="{{route('descarga_postulacion',['id'=>$postulacion->id])}}"><i class="fa fa-download"></i></a>
                                        </button>
                                        @can('postulaciones.destroy')
                                            <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-{{$postulacion->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Delete -->
                            <div class="modal fade p-0" id="Modal-{{$postulacion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro de desea eliminar la postulación de la organización {{$postulacion->organizacion->nombre_organizacion}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <form action="{{route('postulacion.destroy', ['postulacion'=>$postulacion->id])}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Sí, eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->

                            <!-- Modal Asignar viajes -->
                            <div class="modal fade" id="ModalConfirm-{{$postulacion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#tabla_postulaciones').DataTable({
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
