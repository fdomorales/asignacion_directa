@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <span class="breadcrumb-item active">Periodos</span>
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
                    <h3 class="block-title text-uppercase">Periodos</h3>
                    <div class="block-options">
                        <!-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="fa fa-trash"></i>
                        </button> -->
                        <a href="{{route('crear_periodos')}}">
                        <button class="btn btn-primary">Nuevo</button></a>
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
                    <table class="table table-borderless table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th >Descripción</th>
                                <th>Fecha Inicio</th>
                                <th class="d-none d-sm-table-cell">Fecha Fin</th>
                                <th class="d-none d-sm-table-cell">Tipo Periodo</th>
                                <th class="text-right">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periodos as $periodo)
                            
                            <tr >  
                                <td>
                                    <a href="{{route('ver_periodo', ['id'=>$periodo->id])}}"> <span >{{$periodo->descripcion}}</span></a>
                                </td>
                                <td>
                                    <span >{{$periodo->fecha_inicio}}</span>
                                </td>
                                <td>
                                    <span >{{$periodo->fecha_fin}}</span>
                                </td>
                                <td>
                                    <span class="text-black">{{$periodo->tipo_periodos->nombre_tipo_periodo}}</span>
                                </td>
                                @switch($periodo->estado_periodos->id)
                                    @case("1")
                                    <td class="text-right">
                                        <span class="badge badge-success">{{$periodo->estado_periodos->nombre_estado}}</span>
                                    </td>
                                        @break
                                    @default
                                    <td class="text-right">
                                        <span class="badge badge-danger">{{$periodo->estado_periodos->nombre_estado}}</span>
                                    </td>
                                @endswitch
                                <td class="text-right">
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <a href="{{route('ver_periodo', ['id'=>$periodo->id])}}"><i class="fa fa-edit"></i></a>
                                        </button>
                                        <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-{{$periodo->id}}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Delete -->
                            <div class="modal fade p-0" id="Modal-{{$periodo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de desea eliminar el periodo {{$periodo->descripcion}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <form action="{{route('borrar_periodo', [$periodo->id])}}" method="POST">
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
            {{$periodos->links('pagination::bootstrap-5')}}
        </div>
        <!-- END Latest Orders -->
    </div>
    <!-- END More Data -->
@endsection