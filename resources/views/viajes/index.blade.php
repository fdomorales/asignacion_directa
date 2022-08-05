@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <span class="breadcrumb-item active">Asignación</span>
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
                    <h3 class="block-title text-uppercase">Viajes Disponibles</h3>
                    <div class="block-options">
                        <!-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="fa fa-trash"></i>
                        </button> -->
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
                                <th>Origen</th>
                                <th>Destino</th>
                                <th class="d-none d-sm-table-cell">Fecha de inicio</th>
                                <th class="d-none d-sm-table-cell">Fecha de término</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viajes as $viaje)
                                <tr>
                                    <td>{{$viaje->id}}</td>
                                    <td>{{$viaje->origen_viaje}}</td>
                                    <td>{{$viaje->destino_viaje}}</td>
                                    <td>{{$viaje->inicio_viaje}}</td>
                                    <td>{{$viaje->fin_viaje}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#elegirModal-{{$viaje->id}}">
                                        Elegir
                                      </button>
                                    </td>
                                </tr>
                                <!-- Modal Elegir -->
                                <div class="modal fade" id="elegirModal-{{$viaje->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                Desea elegir el viaje con destino {{$viaje->destino_viaje}}, en la fecha {{$viaje->inicio_viaje}} ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <form  action="{{route('set_assignment', ['id'=>$viaje->id])}}" method="POST">
                                                    @method('PATCH')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Sí, elegir</button>
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
        <!-- END Latest Orders -->
    </div>
    <!-- END More Data -->
@endsection