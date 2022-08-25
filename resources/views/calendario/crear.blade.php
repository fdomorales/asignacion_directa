@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <a class="breadcrumb-item" href="{{route('calendario.index')}}">Calendarios</a>
            <span class="breadcrumb-item active">Nuevo</span>
        </nav>
    </div>
@endsection

@section('contenido')
    <!-- More Data -->
    <div class="row justify-content-center">
        <!-- Latest Orders -->
        <div class="col-12 col-lg-10">
            <div class="block block-rounded block-bordered p-5">
                <div class="block-header">
                    <h3 class="block-title text-uppercase">Nuevo Calendario</h3>
                </div>
                <div class="block-content ">
                    <form action="{{route('insertar_excel')}}" method="POST" enctype="multipart/form-data">
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

                        <div class="row justify-content-center">
                            <div class="form-group col-sm-6">
                                <label>Periodo</label>
                                <select class="form-select" name="periodo" id="periodo">
                                    <option value="" selected disabled hidden></option>
                                    @foreach ($periodos as $periodo)
                                        <option value="{{ $periodo->id }}">{{ $periodo->descripcion }} - {{$periodo->fecha_inicio}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Documento</label>
                                <input type="file" name="documento_viajes"  class="form-control" >
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-5">Cargar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Latest Orders -->
    </div>
@endsection
