<?php

namespace App\Http\Controllers;
use App\Models\Organizacion;
use App\Models\Representante;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class OrganizacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:organizaciones.index')->only('index');
        $this->middleware('can:organizaciones.show')->only('show');
        $this->middleware('can:organizaciones.edit')->only('edit');
        $this->middleware('can:organizaciones.update')->only('update');
        $this->middleware('can:organizaciones.destroy')->only('destroy');
    }


    public function index()
    {
        $organizaciones = Organizacion::with([ 'comuna'])->paginate(15);
        //return $organizaciones;
        return view('organizaciones.index', ['organizaciones' => $organizaciones] );
    }


    public function show($id)
    {
        $organizacion = Organizacion::with('comuna')->find($id);
        $representantes = Representante::all()->where('organizacion_id','=', $id);
        //return $organizacion;
        return view('organizaciones.detalle', ['organizacion' => $organizacion, 'representantes'=> $representantes] );
    }


    public function show_customer($id)
    {
        $organizacion = Organizacion::with('comuna')->where('user_id', '=', auth()->user()->id)->first();
        $representantes = Representante::all()->where('organizacion_id','=', $organizacion->id);

        return view('organizaciones.detalle', ['organizacion' => $organizacion, 'representantes'=> $representantes] );
    }


    public function edit($id)
    {
        // TODO: Verificar que la validación sea la correcta y apropiada. Revisar las restricciones que deben tener los roles observador y editor
        $organizacion = Organizacion::findOrFail($id);

        if (auth()->user()->hasRole('Cliente') && $organizacion->user_id != auth()->user()->id) abort(403);

        $representantes = Representante::all()->where('organizacion_id','=', $id);

        return view('organizaciones.editar', ['organizacion' => $organizacion, 'representantes'=> $representantes] );
    }


    public function update(Request $request, $id)
    {
        // TODO: Verificar que la validación sea la correcta y apropiada. Revisar las restricciones que deben tener los roles observador y editor
        $organizacion_editar = Organizacion::findOrFail($id);

        if(auth()->user()->hasRole('Cliente') && $organizacion_editar->user_id != auth()->user()->id) abort(403);

        $request -> validate([
            'nombre_organizacion'=>'required|min:3',
            'correo_organizacion'=>'required|email',
            'telefono_organizacion'=>'required|digits:9'
        ]);

        $organizacion_editar->nombre_organizacion = $request->nombre_organizacion;
        $organizacion_editar->correo_organizacion = $request->correo_organizacion;
        $organizacion_editar->telefono_organizacion = $request->telefono_organizacion;
        //$organizacion_editar->comuna_id = $request->comuna_id;
        $organizacion_editar->save();
        if(auth()->user()->hasRole('Cliente')) {
            return redirect()->route('show_customer', ['id'=>$id])->with('success', 'Organización actualizada');
        }else{
            return redirect()->route('organizacion.show', ['organizacion'=>$id])->with('success', 'Organización actualizada');
        }
    }

    
    public function destroy($id)
    {
        // TODO: No se deberían eliminar las organiazaciones, sólo deshabilitar.
        try {
            $organizacion_eliminar = Organizacion::find($id);
            $organizacion_eliminar->delete();

            return redirect()->route('organizacion.index')->with('success', 'Organización borrada');

        } catch (\Illuminate\Database\QueryException $e){
            //return $e->getMessage();
            return redirect()->back()->with('fail', 'No se puede eliminar la organizacion seleccionada');
        }

    }

}
