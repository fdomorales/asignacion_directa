@extends('layouts.app')

@section('breadcrumb')
    <div class="content">
        <nav class="migas">
            <a href="/">inicio / </a>
            <a  href="{{route('index_customer')}}">Postulaciones / </a>
            <span class="active">Nueva postulación</span>
        </nav>
    </div>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-md-4">
            <div class="sombra borde bg-white p-4 mb-4">
                <h4><i class="fa fa-users"></i> Mi agrupación</h4>
                <p><b>Nombre</b><br>{{ $usuario->organizacion->nombre_organizacion }}</p>
                <p><b>Teléfono</b><br>{{ $usuario->organizacion->telefono_organizacion }}</p>
                <p><b>Correo electrónico</b><br>{{ $usuario->organizacion->correo_organizacion }}</p>
            </div>
        </div>

        <div class="col-md-8">
            <div class="sombra borde bg-white p-4 mb-4">
                <h4>Representantes</h4>
                @if(!isset($representantes) || $representantes->count() == 0)
                    <div class="aviso-azul p-3"><p class="mb-0">No tienes ningún representante agregado, para iniciar una nueva postulación, deberas incorporar a lo menos 2 representantes mínimos para tu agrupación.</p></div>
                @endif
                <form action="{{route('store_by_customer')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @error('descripcion')
                        <h6 class="alert alert-danger">{{ $message }}</h6>
                    @enderror
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
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('fail'))
                        <br>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{session('fail')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(!isset($representantes) || $representantes->count() < 2)
                        <center><a class="btn btn-verde mt-4" href="" data-toggle="modal" data-target="#Modal-create"><i class="fa fa-plus-circle"></i> Agregar representante </a></center>
                    @endif

                    @if(!isset($representantes) || $representantes->count() > 0)
                        {{-- table representantes --}}
                        <table class="mt-4 table table-borderless table-hover table-responsive-sm table-responsive-md table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th class="d-none d-sm-table-cell">Teléfono</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($representantes as $representante)
                                    <tr>
                                        <td><span>{{ $representante->nombre_representante }}</span></td>
                                        <td><span>{{ $representante->apellido_representante }}</span></td>
                                        <td><span>{{ $representante->correo_representante }}</span></td>
                                        <td class=""><span>{{ $representante->telefono_representante }}</span></td>
                                        <td class="text-right">
                                            <div class="block-options">
                                                <button type="button" class="btn-block-option" id="edit-representante" data-toggle="modal" data-id-representante="{{ $representante->id }}" data-id-organizacion="{{ $usuario->organizacion->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn-block-option" id="delete-representante" data-toggle="modal" data-id-representante="{{ $representante->id }}" data-id-organizacion="{{ $usuario->organizacion->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- end table representantes --}}
                    @endif

                    <h4 class="mt-4">Periodo</h4>
                    @if (isset($periodo))
                        <p>{{$periodo->descripcion}} - {{ convert_date($periodo->fecha_inicio) }} - {{ convert_date($periodo->fecha_fin) }}</p>
                        <input type="text" name="periodo" hidden  value="{{$periodo->id}}">

                        <h4 class="mt-4">Cupos</h4>
                        <select class="form-select" name="cupos" id="">
                            <option value="" selected disabled hidden></option>
                            <option value="20">20</option>
                            <option value="40">40</option>
                        </select>

                        <h4 class="mt-4">Documento</h4>
                        <input type="file" name="documento"  class="form-control" >

                        <div class="container py-5 my-5">
                            <div class="row py-5 my-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1"  name="acepta_terminos_y_condiciones">
                                    <span>Acepta terminos y condiciones <a href="#" data-toggle="modal" data-target="#Modal-tyc">(ver aquí)</a></span>
                                </div>
                            </div>
                            <div class="row py-5 my-5">
                                <div class="form-check">
                                    <input type='hidden' value='0' name='recibe_info'>
                                    <input class="form-check-input" type="checkbox" value="1" name="recibe_info">
                                        <span>Desea recibir info por correo</span>
                                </div>
                            </div>
                        </div>

                        <center><button type="submit" class="btn btn-azul mt-5">Enviar postulación</button></center>
                    @else
                    <div class="caja-aviso">
                        <center><p class="m-0">En estos momentos no hay periodos disponibles para tu región.</p></center>
                    </div>
                    @endif

                </form>
            </div>
            <!-- Fin caja de contenido -->
        </div>
    </div>

    {{-- inicio modales --}}
    <!-- Modal Editar -->
    <div class="modal fade p-0" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="borde modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmEditRepresentante" action="" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="text" hidden name="organizacion_id" id="organizacion_id" value="">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre_representante" id="nombre_representante" value="">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Apellido</label>
                            <input type="text" class="form-control" name="apellido_representante" id="apellido_representante" value="">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Correo</label>
                            <input type="text" class="form-control" name="correo_representante" id="correo_representante" value="">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Teléfono</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" >+56</span>
                                <input type="text" name="telefono_representante" class="form-control" id="telefono_representante" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

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
                    <form id="frmDeleteRepresentante" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-rojo">Sí, eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal create representante -->
    <div class="modal fade p-0" id="Modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content borde">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar representante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form  action="{{route('representante.store')}}" method="POST">
                        @csrf
                        <input type="text" hidden name="organizacion_id" value="{{$usuario->organizacion->id}}">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="recipient-name" class="col-form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre_representante" value="{{old('nombre_representante')}}">
                            </div>
                            <div class="col-md-12">
                                <label for="recipient-name" class="col-form-label">Apellido</label>
                                <input type="text" class="form-control" name="apellido_representante" value="{{old('apellido_representante')}}">
                            </div>
                            <div class="col-md-12">
                                <label for="message-text" class="col-form-label">Correo</label>
                                <input type="text" class="form-control" name="correo_representante" value="{{old('correo_representante')}}">
                            </div>
                            <div class="col-md-12">
                                <label for="message-text" class="col-form-label">Teléfono</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" >+56</span>
                                    <input type="text" name="telefono_representante"  class="form-control" value="{{old('telefono_representante')}}">
                                </div>
                            </div>
                        </div>
                        <center><button type="submit" class="btn btn-verde">Agregar</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal términos y condiciones -->
    <div class="modal fade" id="Modal-tyc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Términos y condiciones</h5>
                    <button  type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    {{-- fin modales --}}

    <script type="text/javascript">
	    $(document).ready(function() {
		    $('body').on('click', 'button[id="edit-representante"]', function(){
                var idRepresentante = $(this).attr('data-id-representante');
                var idOrganizacion = $(this).attr('data-id-organizacion');

			    var $row = $(this).closest("tr");
                var nombre = $row.find("td:nth-child(1)").text();
                var apellido = $row.find("td:nth-child(2)").text();
                var correo = $row.find("td:nth-child(3)").text();
                var telefono = $row.find("td:nth-child(4)").text();

                $("#organizacion_id").val(idOrganizacion);

                $("#nombre_representante").val(nombre);
                $("#apellido_representante").val(apellido);
                $("#correo_representante").val(correo);
                $("#telefono_representante").val(telefono);

                $("#frmEditRepresentante").attr("action", "{{ url('representante') }}/" + idRepresentante);

			    $('#ModalEdit').modal({
				    keyboard: false,
				    backdrop: 'static'
			    });
		    });

            $('body').on('click', 'button[id="delete-representante"]', function() {
                var idRepresentante = $(this).attr('data-id-representante');
                var idOrganizacion = $(this).attr('data-id-organizacion');

                var $row = $(this).closest("tr");
                var nombre = $row.find("td:nth-child(1)").text();
                var apellido = $row.find("td:nth-child(2)").text();

                $('#ModalDelete .modal-body').html('¿Está seguro de desea eliminar el representante ' + nombre + ' ' + apellido + '?');

                $("#frmDeleteRepresentante").attr("action", "{{ url('representante') }}/" + idRepresentante);

			    $('#ModalDelete').modal({
				    keyboard: false,
				    backdrop: 'static'
			    });
		    });

		    $('#ModalEdit').on('hidden.bs.modal', function() {
			    //$('#modalRegistro .modal-body').html('');
            });

            $('#ModalDelete').on('hidden.bs.modal', function() {
			    $('#ModalDelete .modal-body').html('');
            });
        });
    </script>
@endsection
