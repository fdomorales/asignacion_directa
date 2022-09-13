@extends('layouts.app')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="javascript:void(0)">Inicio</a>
            <a class="breadcrumb-item" href="{{ route('periodos') }}">Periodos</a>
            <span class="breadcrumb-item active">Nuevo periodo</span>
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
                </div>
                <div class="block-content p-5">
                    <form action="{{ route('periodos') }}" method="POST">
                        @csrf
                        <!-- @error('descripcion')
                            <h6 class="alert alert-danger">{{ $message }}</h6>
                        @enderror -->
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

                        <div class="form-group">
                            <label>Descripción</label>
                            <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}">
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Fecha inicio</label>
                                <input type="datetime-local" class="form-control bg-white " id="fecha_inicio" name="fecha_inicio"
                                    value="{{ old('fecha_inicio') }}" data-enable-time="true" data-time_24hr="true">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Fecha fin</label>
                                <input type="datetime-local" class="form-control bg-white " id="fecha_fin" name="fecha_fin"
                                    value="{{ old('fecha_fin') }}" data-enable-time="true" data-time_24hr="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Tipo de periodo</label>
                                <select class="form-select" name="tipo_periodos" id="tipo_periodos">
                                    <option value="" selected disabled hidden></option>
                                    @foreach ($tipo_periodo as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nombre_tipo_periodo }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Estado</label>
                                <select class="form-select" name="estado_nombre">
                                    <option value="" selected disabled hidden></option>
                                    @foreach ($estado_periodo as $estado)
                                        <option value="{{ $estado->id }}">{{ $estado->nombre_estado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6"   id="select_region" >
                                <label for="">Región</label><br>
                                <select class="form-select" id="regiones" name="regiones[]" multiple="multiple"  style="width: 100%">
                                    @foreach ($regiones as $region)
                                        <option value="{{ $region->id }}" >{{ $region->nombre_region }}</option>
                                    @endforeach
                                </select>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="check_regiones" onchange="checkbox_changed()">
                                    <label class="form-check-label" for="flexCheckDefault">
                                      Seleccionar todas las regiones
                                    </label>
                                  </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- END Latest Orders -->
    </div>
    <script type="text/javascript">
        $('#regiones').select2();
        const regiones = $("#regiones option");
        var selectedItems = [];
        var allOptions = regiones;
        var checkbox = document.getElementById("check_regiones");
        function checkbox_changed(){
            if(checkbox.checked == true){
                $("#regiones").html(regiones);
                selectedItems.splice(0,selectedItems.length);
                allOptions.each(function() {
                    selectedItems.push( $(this).val() );
                });
                $("#regiones").val(selectedItems).trigger("change"); 
                $("#regiones").html(allOptions);
            }else if(checkbox.checked == false){
                selectedItems.splice(0,selectedItems.length);
                allOptions.each(function() {
                    selectedItems.push('');
                });
                $("#regiones").val(selectedItems).trigger("change"); 
                $("#regiones").val('').trigger("change"); 
                $("#regiones").html(regiones);
            }
        }

    </script>
@endsection
