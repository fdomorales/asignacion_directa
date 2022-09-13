@extends('layouts.app')

@section('contenido')
    <div class="col-12 mb-4">
        <div class="sombra borde bg-white p-4 mb-4">
            <h4>Registro</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis et rhoncus felis. Nulla id ex at metus pharetra tincidunt. Aenean rutrum semper nisi, et feugiat massa condimentum eu. Sed sit amet nunc in justo bibendum luctus id ac metus. Donec viverra nulla vitae ligula fermentum, non scelerisque libero commodo. Sed eleifend mi id tortor elementum molestie. Cras in dolor eu urna tempor aliquet. Fusce eleifend, dolor et interdum vestibulum, diam magna lacinia tellus, eget finibus erat eros at nulla.</p>
            <p>Integer interdum volutpat sapien porttitor auctor. Aenean non risus id purus dictum faucibus at id arcu. Duis condimentum orci lectus, eget accumsan libero ullamcorper sit amet. Duis tristique a est quis ornare. Proin auctor fringilla porta. Quisque vitae nibh scelerisque, scelerisque risus sit amet, accumsan lacus. Fusce sed cursus libero, et luctus lorem. Phasellus felis leo, finibus blandit enim nec, fringilla vehicula urna. Duis eu nulla mollis, molestie ligula vitae, vulputate nisi. Praesent fermentum magna sit amet velit tristique interdum. Praesent ornare turpis nec justo efficitur, sit amet interdum mi maximus. Vestibulum at venenatis eros. Mauris dictum sollicitudin arcu, sed sollicitudin sapien aliquet ac.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Nombre Organización</label>
                        <input type="text"  class="form-control" name="name" value="{{old('name')}}" required autofocus>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Correo Organización</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{old('email')}}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>Teléfono organización</label>
                        <div class="input-group">
                            <span class="input-group-text" >+56</span>
                            <input type="text" name="telefono_organizacion" class="form-control" value="{{ old('telefono_organizacion') }}">
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Región</label>
                        <select class="form-select" id="region" name="region" value="{{old('region')}}">
                            <option value="" selected disabled hidden></option>
                            @foreach ($regiones as $region)
                                <option value="{{ $region->id }}" >{{ $region->nombre_region }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Comuna</label>
                        <select class="form-select" id="comuna" disabled name="comuna">
                            <option value="" selected disabled hidden></option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="password">Repetir Contraseña</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-verde">Registrarse</button>
            </form>
        </div>
    </div>
    <script>
        var listaregion = "";

        $(document).ready(function () {
            var regiones =  {!! json_encode($regiones->toArray()) !!};

            $('#region').change(function () {
                listaregion1 ="<option value='' selected disabled hidden></option>";
                var valorRegion = $(this).val();

                var x = regiones.map(region => {

                    if (region.id == valorRegion) {
                        var x = region.provincia.map( provincia => {
                            const opcion_vacia = '<option value="" selected disabled hidden></option>'
                            const comunas_region = provincia.comuna.map(comuna =>{
                                    return '<option value="' + comuna.id + '">' + comuna.nombre_comuna + '</option>';
                            });
                            listaregion = listaregion + comunas_region.join('');
                            return comunas_region.join('');
                        });

                        return x.join('');
                    }
                });

                $('#comuna').html(listaregion1 + x);
                $('#comuna').removeAttr("disabled");
            });

        });
    </script>
@endsection
