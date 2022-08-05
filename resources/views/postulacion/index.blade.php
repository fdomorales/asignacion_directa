@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <span class="breadcrumb-item active">Postulaciones</span>
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
                    <h3 class="block-title text-uppercase">Postulaciones</h3>
                    <div class="block-options">
                        <!-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="fa fa-trash"></i>
                        </button> -->
                        @role('Customer')
                        <a href="{{ route('postulacion.create')}}">
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
                    @if (session('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('fail')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table table-borderless table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Organización</th>
                                <th>Periodo</th>
                                <th class="d-none d-sm-table-cell">Cupos</th>
                                <th class="text-right">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postulaciones as $postulacion)
                            
                            <tr >
                                <td><span>{{$postulacion->id}}</span></td>  
                                <td>
                                    <a href=""> <span >{{$postulacion->organizacion->nombre_organizacion}}</span></a>
                                </td>
                                <td>
                                    <span >{{$postulacion->periodo->descripcion}}</span>
                                </td>
                                <td>
                                    <span >{{$postulacion->cupos}}</span>
                                </td>
                                    <td class="text-right">
                                        <span class="badge @switch($postulacion->estado_postulacion_id)
                                            @case(2) badge-warning @break @case(1) badge-success @break @case(3) badge-danger @break @case(4) badge-primary @break @default badge-warning @endswitch ">
                                            {{$postulacion->estado_postulacion->nombre_estado_postulacion}}
                                        </span>
                                    </td>
                                <td class="text-right">
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" >
                                            <a href="{{route('descarga_postulacion',['id'=>$postulacion->id])}}"><i class="fa fa-download"></i></a>
                                        </button>
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <a href="{{route('postulacion.show',['postulacion'=>$postulacion->id])}}"><i class="fa fa-eye"></i></a>
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
                                <div class="modal-dialog" role="document">
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
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
            {{$postulaciones->links('pagination::bootstrap-5')}}
        </div>
        <!-- END Latest Orders -->
    </div>
    <!-- END More Data -->
@endsection