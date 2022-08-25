@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="javascript:void(0)">Inicio</a>
            <a class="breadcrumb-item" href="{{route('periodos')}}">Periodos</a>
            <span class="breadcrumb-item active">Editar periodo</span>
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
                    <h3 class="block-title text-uppercase">Actualizar Periodo</h3>
                </div>
                <div class="block-content p-5">
                <form action="{{route('actualizar_periodo', ['id' => $periodo->id])}}" method="POST">
                    @method('PATCH')
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
                    <div class="form-group">
                        <label >Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="{{$periodo->descripcion}}">
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Fecha inicio</label>
                            <input type="date" class="form-control bg-white " id="fecha_inicio" 
                            name="fecha_inicio" data-enable-time="true" data-time_24hr="true" value="{{$periodo->fecha_inicio}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Fecha fin</label>
                            <input type="date" class="form-control bg-white " id="fecha_fin" 
                            name="fecha_fin" data-enable-time="true" data-time_24hr="true" value="{{$periodo->fecha_fin}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Tipo Periodo</label>
                            <select class="form-select" name="tipo_periodos" id="tipo_periodos">
                                <option value="{{$periodo->tipo_periodos_id}}" selected  hidden>{{$periodo->nombre_tipo_periodo}}</option>
                                    @foreach ($tipo_periodo as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre_tipo_periodo}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Estado</label>
                            <select class="form-select" name="estado_nombre" >
                                <option value="{{$periodo->estado_periodos_id}}" selected  hidden>{{$periodo->nombre_estado}}</option>
                                    @foreach ($estado_periodo as $estado)
                                        <option value="{{$estado->id}}">{{$estado->nombre_estado}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="select_region" 
                             >
                            <label>Región</label>
                            
                            <select class="form-select" id="regiones" name="regiones[]" multiple  style="width: 100%">
                                
                                    @foreach ($regiones as $region)
                                        <option value="{{$region->id}}" 
                                            @foreach ($regiones_periodo as $region_periodo)
                                                @if ($region_periodo->id == $region->id)
                                                    selected
                                                @endif
                                                
                                            @endforeach
                                            >{{$region->nombre_region}}</option>
                                    @endforeach
                              </select>
                              <select hidden class="form-select" id="regiones_original" name="regiones_original[]" multiple="multiple"  style="width: 100%">
                                @foreach ($regiones as $region_)
                                    <option value="{{ $region_->id }}" >{{ $region_->nombre_region }}</option>
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
        const regiones_original = $("#regiones_original option");
        var checkbox = document.getElementById("check_regiones");
        function checkbox_changed(){
            if(checkbox.checked == true){
                var selectedItems = [];
                var allOptions = regiones;
                $("#regiones").html(regiones);
                selectedItems.splice(0,selectedItems.length);
                allOptions.each(function() {
                    selectedItems.push( $(this).val() );
                });
                $("#regiones").val(selectedItems).trigger("change"); 
                $("#regiones").html(allOptions);
            }else if(checkbox.checked == false){
                var selectedItems = [];
                var allOptions = regiones;
                selectedItems.splice(0,selectedItems.length);
                allOptions.each(function() {
                    selectedItems.push('');
                });
                $("#regiones").val(selectedItems).trigger("change"); 
                $("#regiones").val('').trigger("change"); 
                $("#regiones").html(regiones_original);
            }
        }

    </script>
@endsection