@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            @can('organizacionrd.index')
            <a class="breadcrumb-item" href="{{ route('organizacion.index') }}">Organizaciones</a>
                
            @endcan
            <a class="breadcrumb-item" href="{{route('organizacion.show', ['organizacion'=> $organizacion->id])}}">{{$organizacion->nombre_organizacion}}</a>
            <span class="breadcrumb-item active">Editar</span>
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
                    <h3 class="block-title text-uppercase">Editar datos</h3>
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
                    <form action="{{route('organizacion.update', ['organizacion'=>$organizacion->id])}}" method="POST">
                        @method('PATCH')
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
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Nombre organización</label>
                                <input type="text" name="nombre_organizacion"  class="form-control" value="{{$organizacion->nombre_organizacion}}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Correo</label>
                                <input class="form-control bg-white " name="correo_organizacion"
                                    value="{{$organizacion->correo_organizacion}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Teléfono</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+56</span>
                                    <input type="text" name="telefono_organizacion"  class="form-control" value="{{$organizacion->telefono_organizacion}}">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Comuna</label>
                                <input class="form-control" disabled name="comuna_organizacion" 
                                    value="{{$organizacion->comuna->nombre_comuna}}">
                            </div>
                        </div>
                        <button  type="submit" class="btn btn-primary">Guardar cambios</button>


                        <table class="table table-borderless table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <h3 class="block-title text-uppercase">Representantes</h3>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th class="d-none d-sm-table-cell">Teléfono</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($representantes as $representante)
                                <tr >  
                                    <td>
                                        <span >{{$representante->nombre_representante}}</span>
                                    </td>
                                    <td>
                                        <span >{{$representante->correo_representante}}</span>
                                    </td>
                                    <td>
                                        <span >{{$representante->telefono_representante}}</span>
                                    </td>
                                </tr>
                                    
                                @endforeach
    
                                
    
                                
                                
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <!-- END Latest Orders -->
    </div>
@endsection
