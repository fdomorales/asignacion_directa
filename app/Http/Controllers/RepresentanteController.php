<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representante;

class RepresentanteController extends Controller
{

    public function store(Request $request)
    {
        $request -> validate([
            'nombre_representante'=>'required',
            'apellido_representante'=>'required',
            'correo_representante'=>'required|email',
            'telefono_representante'=>'required|digits:9'
        ]);
        $representante = new Representante;
        $representante->nombre_representante = $request->nombre_representante;
        $representante->apellido_representante = $request->apellido_representante;
        $representante->correo_representante = $request->correo_representante;
        $representante->telefono_representante = $request->telefono_representante;
        $representante->organizacion_id = $request->organizacion_id;
        $representante->save();

        //return redirect()->route('organizacion.show', ['organizacion'=>$request->organizacion_id]);
        return redirect()->back()->with('success', 'Representante agregado');
    }


    public function update(Request $request, $id)
    {
        $request -> validate([
            'nombre_representante'=>'required',
            'apellido_representante'=>'required',
            'correo_representante'=>'required|email',
            'telefono_representante'=>'required|digits:9'
        ]);
        $representante_editar = Representante::find($id);
        $representante_editar->nombre_representante = $request->nombre_representante;
        $representante_editar->apellido_representante = $request->apellido_representante;
        $representante_editar->correo_representante = $request->correo_representante;
        $representante_editar->telefono_representante = $request->telefono_representante;
        $representante_editar->save();
        
        //return redirect()->route('organizacion.show', ['organizacion'=>$request->organizacion_id])->with('success', 'Representante actualizado');
        return redirect()->back()->with('success', 'Representante actualizado');
    }

    
    public function destroy($id)
    {

        
        try {
            $representante_eliminar = Representante::find($id);
            $representante_eliminar->delete();
    
            //return redirect()->route('organizacion.show', ['organizacion'=>$representante_eliminar->organizacion_id])->with('success', 'Representante eliminado');
            return redirect()->back()->with('success', 'Representante eliminado');

        } catch (\Illuminate\Database\QueryException $e){
            //return $e->getMessage();
            return redirect()->back()->with('fail', 'No se puede eliminar el representante');
        }
    }
}
