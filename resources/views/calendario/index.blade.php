@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <span class="breadcrumb-item active">Calendarios</span>
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
                    <h3 class="block-title text-uppercase">Calendarios</h3>
                    <div class="block-options">
                        @role('Admin')
                            <a href="{{route('calendario.create')}}">
                            <button class="btn btn-primary">Nuevo</button></a>
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
                    <table id="tabla_calendarios" class="table table-responsive-sm table-borderless table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Periodo calendario</th>
                                <th>Fecha creación</th>
                                <th class="">Estado</th>
                                @role('Admin')
                                    <th></th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calendarios as $calendario)
                            
                            <tr >
                                <td>
                                     <span >{{$calendario->id}}</a>
                                </td>
                                <td>
                                    <a href=""> <span >{{$calendario->periodo->descripcion}}</span></a>
                                </td>
                                <td>
                                    <span >{{convert_date($calendario->created_at)}} a las {{convert_time($calendario->created_at)}}</span>
                                </td>
                                <td>
                                    @if ($calendario->estado_calendario == 0)
                                    <span class=" badge badge-warning">Cargado</span>
                                    @else
                                    <span class=" badge badge-success">Procesado</span>
                                    @endif
                                </td>
                                @role('Admin')
                                    <td>
                                        <a href="{{route('calendario.show',['calendario'=>$calendario->id])}}">ver</a>
                                    </td>
                                @endrole
                            </tr>

                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- {{$calendarios->links('pagination::bootstrap-5')}} --}}
        </div>
        <!-- END Latest Orders -->
    </div>
    <!-- END More Data -->

    
    <script>
        $(document).ready(function () {
            $('#tabla_calendarios').DataTable({
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