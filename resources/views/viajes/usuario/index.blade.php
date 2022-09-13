@extends('layouts.app')

@section('breadcrumb')
    <div class="content">
        <nav class="migas">
            <a href="/">inicio / </a>
            <a href="{{route('index_customer')}}">Postulaciones /</a>
            <span  class="active">Selección de viaje </span>
        </nav>
    </div>
@endsection

@section('contenido')
    <div class="col-12">
        <div class="sombra borde bg-white p-4 mb-4">
            <h4>Selección de viaje</h4>
            <p>A continuación tendrás el listado de los viajes disponibles para tu agrupación, recueda que solo podrás seleccionar <b>un viaje</b> </p>
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

                @if ($viajes)
                    <table class="table table-responsive-sm table-borderless table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha de término</th>
                                <th>Periodo</th>
                                <th>Copago</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viajes as $viaje)
                                @if (!$viaje->viaje_asignado)
                                    <tr>
                                        <td>{{$viaje->id}}</td>
                                        <td>{{$viaje->origen_viaje}}</td>
                                        <td>{{$viaje->destino_viaje}}</td>
                                        <td>{{ date_format(date_create($viaje->inicio_viaje), 'd-m-Y') }}</td>
                                        <td>{{ date_format(date_create($viaje->fin_viaje), 'd-m-Y')}}</td>
                                        <td>{{$viaje->periodo_viaje}}</td>
                                        <td>${{ number_format($viaje->copago_viaje, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($has_viaje )
                                                <center>
                                                    <button type="button" class="btn btn-azul" data-toggle="modal" id="elegir-viaje" data-id-viaje="{{ $viaje->id }}">
                                                        <i class="fa fa-check"></i> Seleccionar
                                                    </button>
                                                </center>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach 
                        </tbody>
                    </table>
                @else
                    <h6>Aún no se publican viajes</h6>
                @endif
            </div>
        </div>
    </div>
        
    <!-- Modal Elegir -->
    <div class="modal fade" id="ModalElegir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Confirmación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rojo" data-dismiss="modal">No</button>
                    <form id="frmElegirViaje" action="" method="POST">
                        @method('PATCH')
                        @csrf
                        <button type="submit" class="btn btn-azul">Seleccionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modal Elegir -->
    <script type="text/javascript">
	    $(document).ready(function() {
		    $('body').on('click', 'button[id="elegir-viaje"]', function(){
                var idViaje = $(this).attr('data-id-viaje');

			    var $row = $(this).closest("tr");
                var destino = $row.find("td:nth-child(3)").text();
                var fecha = $row.find("td:nth-child(4)").text();

                $('#ModalElegir .modal-body').html('<p class="text-center"><b>¿Estas seguro de selección de este viaje?</b></p><center><img class="mb-2" style="opacity: 0.8;" src="{{ asset('img/maleta.svg') }}" width="30px" height="30px" alt=""></center><p class="text-center">Destino: <b>' + destino + '</b><br>Fecha de viaje: <b>' + fecha + '<b></p>');

                $("#frmElegirViaje").attr("action", "{{ url('viaje/asignar') }}/" + idViaje);

			    $('#ModalElegir').modal({
				    keyboard: false,
				    backdrop: 'static'
			    });
		    });

            $('#ModalElegir').on('hidden.bs.modal', function() {
			    $('#ModalElegir .modal-body').html('');
            });
        });
    </script>
@endsection