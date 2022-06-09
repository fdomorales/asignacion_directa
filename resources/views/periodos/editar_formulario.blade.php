@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="javascript:void(0)">Inicio</a>
            <a class="breadcrumb-item" href="{{route('periodos')}}">Periodos</a>
            <span class="breadcrumb-item active">Formulario</span>
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
                    <!-- <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div> -->
                </div>
                <div class="block-content p-5">
                <form action="{{route('actualizar_periodo', ['id' => $periodo->id])}}" method="POST">
                    @method('PATCH')
                    @csrf
                    {{-- <!-- @error('descripcion')
                        <h6 class="alert alert-danger">{{$message}}</h6>
                    @enderror --> --}}
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
                            @if ($periodo->tipo_periodos_id == 1)
                                style="display: none"
                            @else
                            style="display: block"
                            @endif >
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
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- END Latest Orders -->
    </div>
    <script>
        const select_tipo = document.getElementById("tipo_periodos");
        const select_region = document.getElementById("select_region");
        select_tipo.addEventListener("change", function() {
        if (this.value === "1") {
            select_region.style.display = "none";
        }
        else {
            select_region.style.display = "block";
        }
        });

    </script>
    <script type="text/javascript">
        $('#regiones').select2();
    </script>
@endsection