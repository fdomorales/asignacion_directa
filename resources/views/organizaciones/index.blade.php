@extends('layouts.app')

@section('breadcrumb')
    <div class="content">
        <nav class="migas">
            <a href="/">Inicio / </a>
            <span class="active">Organizaciones</span>
        </nav>
    </div>
@endsection

@section('contenido')
    <div class="col-md-12">
        <div class="sombra borde bg-white">
            <div class="block-header">
                <h4>Organizaciones</h4>
            </div>
            <div class="block-content">
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

                <table id="tabla_organizaciones" class="table table-responsive-sm table-borderless table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th >Nombre</th>
                            <th>Correo</th>
                            <th class="">Teléfono</th>
                            <th class="">Comuna</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($organizaciones as $organizacion)
                            <tr>
                                <td><a href="{{route('organizacion.show', ['organizacion'=>$organizacion->id])}}"> <span >{{$organizacion->nombre_organizacion}}</span></a></td>
                                <td><span>{{$organizacion->correo_organizacion}}</span></td>
                                <td><span>{{$organizacion->telefono_organizacion}}</span></td>
                                <td><span class="text-black">{{$organizacion->comuna->nombre_comuna}}</span></td>
                            </tr>

                            <!-- Modal Delete -->
                            <div class="modal fade p-0" id="Modal-" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro de desea eliminar la organización {{$organizacion->nombre_organizacion}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <form action="{{route('organizacion.destroy', ['organizacion'=>$organizacion->id])}}" method="POST">
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
    </div>

    <script>
        $(document).ready(function () {
            $('#tabla_organizaciones').DataTable({
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
