@extends('layouts.app')

@section('breadcrumb')
    <div class="content">
        <nav class="migas">
            <a href="/">inicio / </a>
            @unlessrole('Cliente')
                <a href="{{route('viaje.index')}}">Viajes /</a>
            @endunlessrole
            @role('Cliente')
                <a href="{{route('index_customer')}}">Postulación /</a>
            @endrole
            <span class="active">Datos viaje </span>
        </nav>
    </div>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <div class="sombra borde bg-white p-4 mb-4">
                <h4>Datos del Viaje</h4>
                <div class="block-content p-5">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Nombre Organización</label>
                            @if ($organizacion)
                                <input class="form-control  " disabled value="{{ $organizacion->nombre_organizacion }}">
                            @else
                                <input class="form-control  " disabled value="No Asignado">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Origen</label>
                            <input class="form-control  " disabled value="{{ $viaje->origen_viaje }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Destino</label>
                            <input class="form-control  " disabled value="{{ $viaje->destino_viaje }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Fecha Inicio</label>
                            <input class="form-control  " disabled value="{{ $viaje->inicio_viaje }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Fecha Fin</label>
                            <input class="form-control  " disabled value="{{ $viaje->fin_viaje }}">
                        </div>
                    </div>

                    <h4 class="mt-4">Pasajeros</h4>

                    @if ($organizacion && $viaje->postulacion->cupos < $viaje->pasajeros->count())
                        <center><a class="mt-4 mb-4 btn btn-verde" href="" data-toggle="modal" data-target="#Modal-create"><i class="fa fa-plus-circle"></i> Agregar pasajero</a></center>
                    @endif

                    @if($pasajeros->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-borderless  table-hover table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>RUT</th>
                                        <th>Nombre</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Sexo</th>
                                        <th>Documentos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pasajeros as $pasajero)
                                        <tr>
                                            <td><span>{{ $pasajero->rut_pasajero }} </span></td>
                                            <td><span>{{ $pasajero->nombre_pasajero }} {{ $pasajero->apellido_paterno_pasajero }} {{ $pasajero->apellido_materno_pasajero }}</span></td>
                                            <td><span>{{ $pasajero->fecha_nacimiento_pasajero }}</span></td>
                                            <td><span>{{ $pasajero->direccion_pasajero }}</span></td>
                                            <td><span>{{ $pasajero->telefono_pasajero }}</span></td>
                                            <td><span>{{ $pasajero->sexo_pasajero }}</span></td>
                                            <td>
                                                @if ($pasajero->nombre_doc_ci || $pasajero->nombre_doc_csh || $pasajero->nombre_doc_da)
                                                    <div class="row justify-content-center ">
                                                        <div class="col-9 col-lg-7  pt-5 text-right">
                                                            @if ($pasajero->token_doc_ci)
                                                                <a href="{{route('download_document', ['token'=> $pasajero->token_doc_ci,'doc'=>1])}}">{{ $pasajero->nombre_doc_ci }}</a>
                                                            @endif
                                                        </div>
                                                        <div class="col-2 col-sm-3">
                                                            @if ($pasajero->nombre_doc_ci)
                                                                <form action="{{ route('destroy_document', ['id'=>$pasajero->id, 'doc'=>1]) }}" method="POST">
                                                                    @method('PATCH')
                                                                    @csrf
                                                                    <button type="submit" class="btn-block-option"><i class="fa fa-trash-o"></i></button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center ">
                                                        <div class="col-9 col-lg-7  pt-5 text-right">
                                                            @if ($pasajero->token_doc_csh)
                                                                <a href="{{route('download_document', ['token'=> $pasajero->token_doc_csh,'doc'=>2])}}">{{ $pasajero->nombre_doc_csh }}</a>
                                                            @endif
                                                        </div>
                                                        <div class="col-2 col-sm-3">
                                                            @if ($pasajero->nombre_doc_csh)
                                                                <form action="{{ route('destroy_document', ['id'=>$pasajero->id, 'doc'=>2]) }}" method="POST">
                                                                    @method('PATCH')
                                                                    @csrf
                                                                    <button type="submit" class="btn-block-option"><i class="fa fa-trash-o"></i></button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center ">
                                                        <div class="col-9 col-lg-7  pt-5 text-right">
                                                            @if ($pasajero->token_doc_da)
                                                                <a href="{{route('download_document', ['token'=> $pasajero->token_doc_da,'doc'=>3])}}">{{ $pasajero->nombre_doc_da }}</a>
                                                            @endif
                                                        </div>
                                                        <div class="col-2 col-sm-3">
                                                            @if ($pasajero->nombre_doc_da)
                                                                <form action="{{ route('destroy_document', ['id'=>$pasajero->id, 'doc'=>3]) }}" method="POST">
                                                                    @method('PATCH')
                                                                    @csrf
                                                                    <button type="submit" class="btn-block-option"><i class="fa fa-trash-o"></i></button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @else
                                                    <span>(faltan documentos)</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($pasajero->nombre_doc_ci && $pasajero->nombre_doc_csh)
                                                    <i class="fa fa-check-circle " style="color: green;"></i>
                                                @else
                                                    <i class="fa fa-minus-circle "style="color: red;"></i>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <div class="block-options">
                                                    <button type="button" class="btn-block-option" data-toggle="modal" data-target="#Modal-edit-{{ $pasajero->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn-block-option" id="delete-pasajero" data-toggle="modal" data-id-pasajero="{{ $pasajero->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- // TODO: El modal no puede estar dentro de la tabla, ni tampoco se deben generar por cada registro... su uso debe ser dinamico --}}
                                        <!-- Modal Editar -->
                                        <div class="modal fade p-0" id="Modal-edit-{{ $pasajero->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar datos</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('pasajero.update', ['pasajero'=>$pasajero->id]) }}" method="POST" enctype="multipart/form-data">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class="row p-4">
                                                            <div class="col-md-6">
                                                                <label for="recipient-name" class="col-form-label">RUT</label>
                                                                <input type="text" class="form-control" name="rut_pasajero"
                                                                    value="{{ $pasajero->rut_pasajero }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="recipient-name" class="col-form-label">Nombres</label>
                                                                <input type="text" class="form-control" name="nombre_pasajero"
                                                                    value="{{ $pasajero->nombre_pasajero }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="recipient-name" class="col-form-label">Apellido paterno</label>
                                                                <input type="text" class="form-control" name="apellido_paterno_pasajero"
                                                                    value="{{ $pasajero->apellido_paterno_pasajero }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="recipient-name" class="col-form-label">Apellido materno</label>
                                                                <input type="text" class="form-control" name="apellido_materno_pasajero"
                                                                    value="{{ $pasajero->apellido_materno_pasajero }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="recipient-name" class="col-form-label">Fecha de
                                                                    nacimiento</label>
                                                                <input type="date" class="form-control"
                                                                    name="fecha_nacimiento_pasajero" value="{{$pasajero->fecha_nacimiento_pasajero}}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Sexo</label>
                                                                <select class="form-select" name="sexo_pasajero" id="">
                                                                    <option value="{{$pasajero->sexo_pasajero}}" selected  hidden>{{$pasajero->sexo_pasajero}}</option>
                                                                    <option value="Femenino">Femenino</option>
                                                                    <option value="Masculino">Masculino</option>
                                                                    <option value="sin_especificar">Sin especificar</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="message-text" class="col-form-label">Dirección</label>
                                                                <input type="text" class="form-control"
                                                                    name="direccion_pasajero" value="{{ $pasajero->direccion_pasajero }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="message-text" class="col-form-label">Teléfono</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">+56</span>
                                                                    <input type="text" name="telefono_pasajero"
                                                                        class="form-control" value="{{ $pasajero->telefono_pasajero }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label>Región</label>
                                                                <select class="form-select region" id="region" name="region" value="{{old('region')}}" >
                                                                    <option value="" selected disabled hidden>{{$pasajero->comuna->provincia->region->nombre_region}}</option>
                                                                    @foreach ($regiones as $region)
                                                                        <option value="{{ $region->id }}" >{{ $region->nombre_region }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Comuna</label>
                                                                <select class="form-select comuna" id="comuna" disabled name="comuna"  >
                                                                    <option value="{{$pasajero->comuna_id}}" selected  hidden>{{$pasajero->comuna->nombre_comuna}}</option>

                                                                </select>
                                                            </div>
                                                            @if (!$pasajero->nombre_doc_ci)
                                                            <div class="form-group ">
                                                                <label>Copia cédula identidad</label>
                                                                <input type="file" name="documento_ci"  class="form-control" >
                                                            </div>
                                                            @endif
                                                            @if (!$pasajero->nombre_doc_csh)
                                                            <div class="form-group ">
                                                                <label>Cartola registro social de hogares</label>
                                                                <input type="file" name="documento_csh"  class="form-control" >
                                                            </div>
                                                            @endif
                                                            @if (!$pasajero->nombre_doc_da)
                                                            <div class="form-group ">
                                                                <label>Credencial discapacidad (opcional)</label>
                                                                <input type="file" name="documento_da"  class="form-control" >
                                                            </div>
                                                            @endif
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-azul">Editar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                    @endforeach
                                </tbody>
                            </table>
                            <center><a class="btn btn-azul mt-4" href="{{route('download_list', ['id'=>$viaje->id])}}"><i class="fa fa-download"></i> Descargar Listado</a></center>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade p-0" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <form id="frmDeletePasajero" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-primary">Sí, eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal create pasajero -->
    <div class="modal fade p-0" id="Modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar pasajero</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pasajero.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row p-4">
                            <input type="text" hidden name="viaje_id" value="{{ $viaje->id }}">
                            <div class="col-md-6">
                                <label for="recipient-name" class="col-form-label">RUT</label>
                                <input type="text" class="form-control" name="rut_pasajero" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="recipient-name" class="col-form-label">Nombres</label>
                                <input type="text" class="form-control" name="nombre_pasajero" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="recipient-name" class="col-form-label">Apellido paterno</label>
                                <input type="text" class="form-control" name="apellido_paterno_pasajero" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="recipient-name" class="col-form-label">Apellido materno</label>
                                <input type="text" class="form-control" name="apellido_materno_pasajero" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="recipient-name" class="col-form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" name="fecha_nacimiento_pasajero" value="">
                            </div>
                            <div class="col-md-6">
                                <label>Sexo</label>
                                <select class="form-select" name="sexo_pasajero" id="">
                                    <option value="" selected disabled hidden></option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="sin_especificar">Sin especificar</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="message-text" class="col-form-label">Dirección</label>
                                <input type="text" class="form-control" name="direccion_pasajero" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="message-text" class="col-form-label">Teléfono</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">+56</span>
                                    <input type="text" name="telefono_pasajero" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Región</label>
                                <select class="form-select region" id="region" name="region" value="{{old('region')}}">
                                    <option value="" selected disabled hidden></option>
                                    @foreach ($regiones as $region)
                                        <option value="{{ $region->id }}" >{{ $region->nombre_region }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Comuna</label>
                                <select class="form-select comuna" id="comuna" disabled name="comuna">
                                    <option value="" selected disabled hidden></option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Copia cédula identidad</label>
                                <input type="file" name="documento_ci"  class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>Cartola registro social de hogares</label>
                                <input type="file" name="documento_csh" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>Credencial discapacidad (opcional)</label>
                                <input type="file" name="documento_da" class="form-control">
                            </div>

                            <center><button type="submit" class="btn btn-azul mt-4">Agregar</button></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <script>
        var listaregion = "";

        $(document).ready(function() {
            var regiones =  {!! json_encode($regiones->toArray()) !!};

            $('.region').change(function () {
                console.log(regiones);
                listaregion1 ="<option value='' selected disabled hidden></option>";
                var valorRegion = $(this).val();

                var x = regiones.map(region => {

                    if (region.id == valorRegion) {
                        var x = region.provincia.map( provincia => {
                            const opcion_vacia = '<option value="" selected disabled hidden></option>'
                            const comunas_region = provincia.comuna.map(comuna =>{
                                 return '<option value="' + comuna.id + '">' + comuna.nombre_comuna + '</option>';
                            });
                            listaregion = listaregion + comunas_region.join('');
                            return comunas_region.join('');
                        });

                        return x.join('');
                    }
                });

                $('.comuna').html(listaregion1 + x);
                $('.comuna').removeAttr("disabled");
            });

            $('body').on('click', 'button[id="delete-pasajero"]', function() {
                var idPasajero = $(this).attr('data-id-pasajero');

                var $row = $(this).closest("tr");
                var nombre = $row.find("td:nth-child(2)").text();

                $('#ModalDelete .modal-body').html('¿Está seguro de desea eliminar el pasajero ' + nombre + '?');

                $("#frmDeletePasajero").attr("action", "{{ url('pasajero') }}/" + idPasajero);

			    $('#ModalDelete').modal({
				    keyboard: false,
				    backdrop: 'static'
			    });
		    });

            $('#ModalDelete').on('hidden.bs.modal', function() {
			    $('#ModalDelete .modal-body').html('');
            });
        });
    </script>
@endsection
