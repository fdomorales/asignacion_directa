@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <a class="breadcrumb-item" href="{{route('usuarios.index')}}">Usuarios</a>
            <span class="breadcrumb-item active">{{$user->name}}</span>
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
                    <h3 class="block-title text-uppercase">Permisos usuario: {{$user->name}}</h3>
                    <div class="block-options">
                        
                    </div>
                </div>
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
                    <table class="table table-borderless table-hover table-striped mb-0">
                        <div class="row justify-content-center">
                            <div class="form-group col-sm-6">
                                <p>{{$user->email}}</p>
                            </div>
                        </div>
                            <form action="{{route('usuarios.update', ['usuario'=>$user->id])}}" method="POST">
                            @method('PATCH')
                            @csrf
                                <div class="row justify-content-center">
                                    <div class="form-group col-sm-6">
                                        <label>Permiso</label>
                                        <select class="form-select" name="role" id="role">
                                            <option value="{{$role_user_id}}" selected  hidden>{{$user->getRoleNames()->first()}}</option>
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
        
                                        </select>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="form-group col-sm-6">
                                        <button type="submit" class="btn btn-primary">Asignar Permiso</button>
                                    </div>
                                </div>
                            </form>
                            
                    </table>
                </div>
            </div>
        </div>
        <!-- END Latest Orders -->
    </div>
    <!-- END More Data -->
@endsection