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
        <div class="col-lg-10">
            <div class="block block-rounded block-bordered">
                <div class="block-header">
                    <h3 class="block-title text-uppercase">Calendarios</h3>
                    <div class="block-options">
                        <!-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="fa fa-trash"></i>
                        </button> -->
                        <a href="{{route('calendario.create')}}">
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
                                <th>#</th>
                                <th>Periodo calendario</th>
                                <th>Fecha creación</th>
                                <th class="d-none d-sm-table-cell">Estado</th>
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
                                    <span >{{$calendario->created_at}}</span>
                                </td>
                                <td>
                                    @if ($calendario->estado_calendario == 1)
                                    <span class=" badge badge-warning">Cargado</span>
                                    @else
                                    <span class=" badge badge-success">Procesado</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('calendario.show',['calendario'=>$calendario->id])}}">ver</a>
                                </td>
                            </tr>

                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- {{$periodos->links('pagination::bootstrap-5')}} --}}
        </div>
        <!-- END Latest Orders -->
    </div>
    <!-- END More Data -->
@endsection