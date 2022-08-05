@extends('inicio')

@section('breadcrumb')
    <div class="content">
        <nav class="breadcrumb mb-0">
            <a class="breadcrumb-item" href="/">Inicio</a>
            <span class="breadcrumb-item active">Postulaciones</span>
        </nav>
    </div>
@endsection

@section('contenido')
<div>
    <style>
        #loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0,0,0,0) url("img/loading_pacman.gif") no-repeat center center;
            z-index: 99999;
            
        }
        .loading {
            z-index: 20;
            position: absolute;
            top: 0;
            left:-5px;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .loading-content {
            position: absolute;
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            top: 40%;
            left:35%;
            animation: spin 2s linear infinite;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    
        <section id="loading">
            <div id="loading-content"></div>
        </section>
    
        <div>
            <div id='loader'></div>
        </div>
</div>
    <!-- More Data -->
    <div class="row justify-content-center">
        <!-- Latest Orders -->
        <div class="col-lg-10">
            <div class="block block-rounded block-bordered">
                <div class="block-header">
                    <h3 class="block-title text-uppercase">Postulaciones</h3>
                    <div class="block-options">
                        <!-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="fa fa-trash"></i>
                        </button> -->
                        @if (!isset($organizacion->postulacion[0]))
                        <a href="{{ route('create_by_customer')}}">
                            <button class="btn btn-primary">Nuevo</button></a>
                             
                        @endif
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
                    @if (@isset($postulacion))
                        
                    
                        <div class="row justify-content-center mb-10">
                            <div class="col-sm-8">
                              <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <h5 class="card-title">{{$organizacion->nombre_organizacion}}</h5>
                                            <p class="card-text">Fecha de creación: {{$organizacion->created_at}}</p>
                                            <p class="card-text">Cupos: {{$postulacion->cupos}} </p>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="mt-10">
                                                <p><strong class="alert 
                                                    @switch($postulacion->estado_postulacion->id)
                                                    @case(2) alert-warning @break
                                                    @case(1) alert-success @break
                                                    @case(3) alert-danger @break
                                                    @default
                                                    @endswitch ">{{$postulacion->estado_postulacion->nombre_estado_postulacion}}</strong>
                                                </p>
                                            </div>
                                            @if ($postulacion->estado_postulacion->id == 4 && !$viaje && @isset($viajes) )
                                            <a href="{{ route('viaje.index')}}">
                                                <button class="btn btn-primary">Elegir viaje</button>
                                            </a>
                                            @else
                                            <p>Debe esperar que se abran los cupos para tomar viajes</p>
                                            @endif
                                            @if (@isset($viaje))
                                                <p>Viaje seleccionado con fecha {{$viaje->inicio_viaje}} y destino {{$viaje->destino_viaje}}</p>
                                                <a href="{{route('viaje.show', ['viaje'=> $viaje->id])}}">Cargar pasajeros</a>
                                            @endif
                                        </div>
                                    </div>
                                  
                                  
                                  <a href="{{route('show_by_customer', ['id' => $postulacion->id])}}" class="">editar</a>
                                </div>
                                <button type="button" class="btn-block-option" >
                                    <a href="{{route('descarga_postulacion',['id'=>$postulacion->id])}}">Descargar<i class="fa fa-download"></i></a>
                                </button>
                              </div>
                            </div>
                          </div>
                    @else
                        <h6 class="alert alert-warning">No hay postulaciones registradas</h6>
                    @endif
                        

                    </div>
                </div>
            </div>
        </div>
        <!-- END Latest Orders -->
    </div>
    <!-- END More Data -->
    
    <script>
        $(function() {
            $( "form" ).submit(function() {
                $('#loader').show();
                /* document.querySelector('#loading').classList.add('loading');
                document.querySelector('#loading-content').classList.add('loading-content'); */
            });
        });
        </script>
@endsection