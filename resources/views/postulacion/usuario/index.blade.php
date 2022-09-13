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
    <div class="block-content p-5">
        @if (session('success'))
            <div class="col-md-8 mx-auto">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            
        @endif
        @if (session('fail'))
            <div class="col-md-8 mx-auto">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('fail')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-4">
            @if (isset($viaje) && !empty($viaje))
                <div class="col-md-12 mb-4">
                    <div class="sombra borde bg-white p-4 mb-4">
                        <div class="header-travel mb-4"><h4 class="p-0 m-0">Mi Viaje</h4></div>
                        <div class="row ticket">
                            <div class="col-md-6 text-center"><span style="font-size:12px;">ORIGEN</span><br><span style="font-size: 40px;font-weight: 100;">STG</span><br><b style="font-size: 12px;"></b><p style="line-height: 12px;text-transform: uppercase;"><b>San Pedro de Atacama</b></p></div>
                            <div class="col-md-6 text-center"><span style="font-size:12px;">DESTINO</span><br><span style="font-size: 40px;font-weight: 100;">CBO</span><br><b style="font-size: 12px;"></b><p style="line-height: 12px;text-transform: uppercase;"><b>{{$viaje->destino_viaje}}</b></p></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-5 col-sm-4 text-center"><p>Salida:<br><b>{{ date_format(date_create($viaje->inicio_viaje), 'd/m/Y') }}</b></p></div>
                            <div class="col-lg-2 p-0 col-sm-4 d-none d-sm-none d-md-block"> <center><img width="100%" src="{{ asset('img/bus.png') }}"></center></div>
                            <div class="col-lg-5 col-sm-4 text-center"><p>Pasajeros:<br><b>{{$numero_pasajeros}}/{{$postulacion->cupos}}</b></p></div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-12">
                <div class="sombra borde bg-white p-4 mb-4">
                    <h4>Mi agrupación</h4>
                    <p><b>Nombre</b><br>{{$organizacion->nombre_organizacion}} </p>
                    <p><b>Teléfono</b><br>{{$organizacion->telefono_organizacion}} </p>
                    <p><b>Correo electrónico</b><br>{{$organizacion->correo_organizacion}} </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="sombra borde bg-white p-4 mb-4">
                    @if (isset($postulacion))
                        <h4>Postulación</h4>
                        @switch($postulacion->estado_postulacion->id)
                            @case(2)
                                <div class="caja-aviso rounded mb-4"><p class="m-0">Felicidades, enviaste la postulación satisfactoriamente, nuestros equipos revisaran la información enviada para corroborar todos los datos, una vez finalizada la evaluación, se enviará un mail informativo para iniciar el proceso de inscripción del viaje. </p></div>
                                @break
                            @case(3)
                                <p>Su postulación fue rechazada, no podrá tomar viajes</p>
                                @break
                            @case(1)
                                <p>Su postulación fue aprobada, pronto le informaremos la fecha para tomar viajes.</p>
                                @break
                            @default
                        @endswitch

                        <h4>Detalles</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Fecha postulación</b><br>{{convert_date($organizacion->created_at)}} a las {{convert_time($organizacion->created_at)}}</p>
                            </div>
                            <div class="col-md-1">
                                <p class="text-center"><b>Cupos</b><br>{{$postulacion->cupos}} </p>
                            </div>
                            <div class="col-md-2">
                                <p class="text-center"><b>Estado</b><br>
                                    <span class="estado @switch($postulacion->estado_postulacion->id)
                                        @case(2) estado-pendiente @break
                                        @case(1) estado-aprobado @break
                                        @case(3) alert-danger @break
                                        @case(4) alert-primary @break
                                        @case(5) estado-aprobado @break
                                        @default
                                        @endswitch ">{{$postulacion->estado_postulacion->nombre_estado_postulacion}}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-3">
                                @if($postulacion->estado_postulacion_id == 2)
                                    <form action="{{route('postulacion.destroy', ['postulacion'=>$postulacion->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <center><button type="submit" class="btn btn-rojo"><i class="fa fa-trash"></i> Eliminar</button></center>
                                    </form>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <center><a class="btn btn-azul" href="{{route('descarga_postulacion',['id'=>$postulacion->id])}}"><i class="fa fa-download"></i> Descargar</a></center>
                            </div>
                            <div class="col-sm-12">
                                @if ($postulacion->estado_postulacion->id == 4)
                                    @if (!$viaje && @isset($viajes))
                                        <div class="caja-aviso mb-4">
                                            <p class="mb-0">Ya se te ha aprobado tu postulación y se ha asignado el cupo el cual solicitaste, a continuación podras continuar con el proceso de selección de viaje.</p>
                                        </div>

                                        <center><a  href="{{ route('viaje.index')}}">
                                            <button class="btn btn-azul mt-4">Elegir viaje</button>
                                        </a></center>
                                    @endif
                                    @if ($viaje)
                                        @if ($indicador == 1)
                                            <div class="col-12 text-center">
                                                <div class="btn-group">
                                                    <center><a class="btn btn-verde" href="{{route('viaje.show', ['viaje'=> $viaje->id])}}">Ver pasajeros</a></center>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-verde" data-toggle="modal" data-target="#finalizarModal">Finalizar postulación</button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="caja-aviso mb-4" style="width:100%;">
                                                <p class="mb-0">Ya tienes el viaje seleccionado, ahora solo falta cargar los pasajeros.</p>
                                            </div>

                                            <center><a class="btn btn-verde" href="{{route('viaje.show', ['viaje'=> $viaje->id])}}">Cargar pasajeros</a></center>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    @else
                        <h6 class="alert alert-warning">No hay postulaciones registradas</h6>
                    @endif

                    @if (!is_null($periodoActivoId))
                        <center><a href="{{ route('create_by_customer')}}">
                            <button class="btn btn-verde">Iniciar postulación</button></a>
                        </center>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row"></div>

    <div class="row justify-content-center">
        <!-- Latest Orders -->
        @if ($postulacion)
            <!-- Modal Finalizar -->
            <div class="modal fade" id="finalizarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Está seguro que desea terminar la carga de pasajeros y finalizar la postulación ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <form  action="{{ route('terminar_carga', ['id'=> $postulacion->id])}}" method="POST">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="btn btn-primary">Sí, terminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END  -->
        @endif
    </div>
    <!-- END More Data -->

    <script>
        $(function() {
            $( "form" ).submit(function() {
                $('#loader').show();
            });
        });
    </script>
@endsection
