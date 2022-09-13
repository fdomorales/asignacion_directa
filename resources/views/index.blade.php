@extends('layouts.app')

@section('contenido')
    {{-- //TODO: Revisar como se comporta este archivo cuando no existen periodos activos. --}}
    <div class="col-12 mb-4">
        <div class="sombra borde bg-white p-4 mb-4 mt-4">
            <center><h3>Bienvenido</h3></center>
            <div class="row">
                <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis maximus est. Duis vulputate justo id tristique malesuada. Nulla quis elit dignissim, congue quam nec, placerat purus. Aenean ac tempor erat, vitae finibus urna.</p>
                <div class="col-md-6 text-center">
                    @if($periodos->count() > 0)
                        <h4>Regiones con postulaciones abiertas</h4>
                        <p>
                            @foreach($periodos as $periodo)
                                @foreach($periodo->regiones_periodo as $region_periodo)
                                    {{ $region_periodo->region->nombre_region }}<br>
                                @endforeach

                                <p>Si eres de una de las regiones con postulación abierta, <b>inicia ahora</b> tu postulación de viajes de <b>Vacaciones Tercera Edad</b> de Sernatur para agrupaciones sociales del país.</p>
                                <p>El periodo se encuentra vigente desde el {{ convert_date($periodo->fecha_inicio) }} hasta el {{ convert_date($periodo->fecha_fin) }}</p>
                            @endforeach
                        </p>
                    @else
                        {{-- TODO: Revisar si es necesario agregar contenido cuando se cumpla esta condición --}}
                        <p class="text-justify">In et placerat nibh, eget gravida tellus. Ut nec maximus magna. Integer hendrerit nec augue non imperdiet. Quisque orci libero, tristique vel lacus non, fermentum accumsan elit. Cras lacinia in ligula placerat feugiat. Suspendisse gravida lacus ut lorem ornare, nec tincidunt risus efficitur. Vivamus at elit ultricies, tempus sem elementum, semper nulla. Vivamus mattis ligula id faucibus porta. Nam suscipit maximus dui sit amet fermentum. Ut vestibulum dapibus justo ut porttitor.</p>
                        <p class="text-justify">Morbi in interdum odio. Donec in faucibus justo. Aenean non pretium magna. Mauris ut eleifend enim, at tincidunt neque. Sed quis neque vel ex facilisis tempor sed at justo. Morbi sollicitudin elementum tincidunt. Praesent vel magna hendrerit, molestie ligula quis, vestibulum elit. Duis dolor metus, lobortis vel imperdiet vulputate, pretium at libero. Mauris eu sodales nisl. Vivamus ut ante elementum, rutrum erat non, pretium elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque sollicitudin mauris non rutrum sodales. Sed scelerisque enim magna, eget vulputate sapien dictum eu. Quisque consequat nec nisl nec egestas. Cras volutpat suscipit neque, ut aliquet nibh consectetur a.</p>
                    @endif

                    @if (auth()->user() && $periodos->count())
                        @role('Cliente')
                            @if (!is_null($periodoActivoId))
                                @if (!isset($postulacion->id))
                                    <a href="{{route('create_by_customer')}}"  class="btn btn-verde">Iniciar Postulación</a>
                                @else
                                    @switch($postulacion->estado_postulacion_id)
                                        @case(1)
                                        @case(2)
                                        @case(4)
                                            <a href="{{route('index_customer')}}"  class="btn btn-verde">Continuar Postulación</a>
                                            @break
                                        @case(3)
                                            {{-- //TODO: ¿Que hacer cuando se rechaza el viaje?(mensaje) --}}
                                            <p class="text-justify">In et placerat nibh, eget gravida tellus. Ut nec maximus magna. Integer hendrerit nec augue non imperdiet. Quisque orci libero, tristique vel lacus non, fermentum accumsan elit. Cras lacinia in ligula placerat feugiat. Suspendisse gravida lacus ut lorem ornare, nec tincidunt risus efficitur. Vivamus at elit ultricies, tempus sem elementum, semper nulla. Vivamus mattis ligula id faucibus porta. Nam suscipit maximus dui sit amet fermentum. Ut vestibulum dapibus justo ut porttitor.</p>
                                            <p class="text-justify">Morbi in interdum odio. Donec in faucibus justo. Aenean non pretium magna. Mauris ut eleifend enim, at tincidunt neque. Sed quis neque vel ex facilisis tempor sed at justo. Morbi sollicitudin elementum tincidunt. Praesent vel magna hendrerit, molestie ligula quis, vestibulum elit. Duis dolor metus, lobortis vel imperdiet vulputate, pretium at libero. Mauris eu sodales nisl. Vivamus ut ante elementum, rutrum erat non, pretium elit. Class aptent taciti sociosqu ad litora torquent.</p>
                                            @break
                                        @case(5)
                                            <a href="{{route('index_customer')}}"  class="btn btn-verde">Ver Postulación</a>
                                            @break
                                    @endswitch
                                @endif
                            @endif
                        @endrole
                    @endif
                </div>
                <div class="col-md-6 text-center">
                    <img class=" mx-auto" style="width: -webkit-fill-available; max-width: 400px;" src="https://www.sernatur.cl/wp-content/uploads/2022/09/terceraedad-caminando-459x305.png">
                </div>
            </div>
        </div>
    </div>
@endsection
