@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <a class="breadcrumb-item" href="">Postulaciones</a>
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
                    <h3 class="block-title text-uppercase">Nueva Postulación</h3>
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
                <form action="" method="POST">
                    @csrf
                    <!-- @error('descripcion')
                        <h6 class="alert alert-danger">{{$message}}</h6>
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
                        <label >Descripción</label>
                        <input type="text" name="descripcion"  class="form-control" value="{{old('descripcion')}}" >
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Fecha inicio</label>
                            <input type="date" class="form-control bg-white " id="fecha_inicio" name="fecha_inicio" value="{{old('fecha_inicio')}}" data-enable-time="true" data-time_24hr="true" >
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Fecha fin</label>
                            <input type="date" class="form-control bg-white " id="fecha_fin" name="fecha_fin" value="{{old('fecha_fin')}}" data-enable-time="true" data-time_24hr="true" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Región</label>
                            <select class="form-select" name="region" >
                                <option  value="" selected disabled hidden></option>
                                    
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Estado</label>
                            <select class="form-select" name="estado_nombre" >
                                <option value="" selected disabled hidden></option>
                                    
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Tipo </label>
                            <select class="form-select" name="tipo_periodos" >
                                <option value="" selected disabled hidden></option>
                                    
                                    
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
@endsection