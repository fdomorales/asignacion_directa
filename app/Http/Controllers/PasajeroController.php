<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasajero;

class PasajeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nombre_pasajero'=>'required|min:3',
            'apellido_pasajero'=>'required|min:3',
            'fecha_nacimiento_pasajero'=>'required|date|before:today',
            'direccion_pasajero'=>'required',
            'telefono_pasajero'=>'required|digits:9',
            'contacto_pasajero'=>'required|digits:9'
        ]);
        $pasajero = new Pasajero;
        $pasajero->nombre_pasajero = $request->nombre_pasajero;
        $pasajero->apellido_pasajero = $request->apellido_pasajero;
        $pasajero->fecha_nacimiento_pasajero = $request->fecha_nacimiento_pasajero;
        $pasajero->direccion_pasajero = $request->direccion_pasajero;
        $pasajero->telefono_pasajero = $request->telefono_pasajero;
        $pasajero->contacto_pasajero = $request->contacto_pasajero;
        $pasajero->viaje_id = $request->viaje_id;
        $pasajero->save();

        return redirect()->back()->with('success', 'Pasajero Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request -> validate([
            'nombre_pasajero'=>'required|min:3',
            'apellido_pasajero'=>'required|min:3',
            'fecha_nacimiento_pasajero'=>'required|date|before:today',
            'direccion_pasajero'=>'required',
            'telefono_pasajero'=>'required|digits:9',
            'contacto_pasajero'=>'required|digits:9'
        ]);
        $pasajero = Pasajero::find($id);
        $pasajero->nombre_pasajero = $request->nombre_pasajero;
        $pasajero->apellido_pasajero = $request->apellido_pasajero;
        $pasajero->fecha_nacimiento_pasajero = $request->fecha_nacimiento_pasajero;
        $pasajero->direccion_pasajero = $request->direccion_pasajero;
        $pasajero->telefono_pasajero = $request->telefono_pasajero;
        $pasajero->contacto_pasajero = $request->contacto_pasajero;
        $pasajero->save();

        return redirect()->back()->with('success', 'Datos de pasajero actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasajero_a_eliminar = Pasajero::find($id);
        $pasajero_a_eliminar->delete();

        return redirect()->back()->with('success', 'Pasajero Eliminado');
    }
}
