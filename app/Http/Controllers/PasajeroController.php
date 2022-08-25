<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasajero;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Exports\PasajerosExport;
use Excel;

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
        //return $request;
        $request -> validate([
            'rut_pasajero'=>'required',
            'nombre_pasajero'=>'required|min:3',
            'apellido_paterno_pasajero'=>'required|min:3',
            'apellido_materno_pasajero'=>'required|min:3',
            'fecha_nacimiento_pasajero'=>'required|date|before:today',
            'sexo_pasajero'=>'required',
            'direccion_pasajero'=>'required',
            'telefono_pasajero'=>'digits:9',
            'comuna'=>'required',
            
        ]);
        $pasajero = new Pasajero;
        $pasajero->rut_pasajero = $request->rut_pasajero;
        $pasajero->nombre_pasajero = $request->nombre_pasajero;
        $pasajero->apellido_paterno_pasajero = $request->apellido_paterno_pasajero;
        $pasajero->apellido_materno_pasajero = $request->apellido_materno_pasajero;
        $pasajero->fecha_nacimiento_pasajero = $request->fecha_nacimiento_pasajero;
        $pasajero->sexo_pasajero = $request->sexo_pasajero;
        $pasajero->direccion_pasajero = $request->direccion_pasajero;
        $pasajero->telefono_pasajero = $request->telefono_pasajero;
        //$pasajero->contacto_pasajero = $request->contacto_pasajero;
        $pasajero->comuna_id = $request->comuna;

        if($request->file('documento_ci')){
            $archivo_ci = $request->file('documento_ci')->store('docs_pasajeros');
            $nombre_documento_ci = $request->file('documento_ci')->getClientOriginalName();
            $pasajero->nombre_doc_ci = $nombre_documento_ci;
            $pasajero->ruta_doc_ci = $archivo_ci;
            $token_ci = md5( Str::random( '100' ) . date( 'YmdHis-siHdmY' ) );
            $pasajero->token_doc_ci = $token_ci;
            $pasajero->hash_doc_ci = bcrypt($token_ci);
        }
        if($request->file('documento_csh')){
            $archivo_csh = $request->file('documento_csh')->store('docs_pasajeros');
            $nombre_documento_csh = $request->file('documento_csh')->getClientOriginalName();
            $pasajero->nombre_doc_csh = $nombre_documento_csh;
            $pasajero->ruta_doc_csh = $archivo_csh;
            $token_csh = md5( Str::random( '100' ) . date( 'YmdHis-siHdmY' ) );
            $pasajero->token_doc_csh = $token_csh;
            $pasajero->hash_doc_csh = bcrypt($token_csh);
        }
        if($request->file('documento_da')){
            $archivo_da = $request->file('documento_da')->store('docs_pasajeros');
            $nombre_documento_da = $request->file('documento_da')->getClientOriginalName();
            $pasajero->nombre_doc_da = $nombre_documento_da;
            $pasajero->ruta_doc_da = $archivo_da;
            $token_da = md5( Str::random( '100' ) . date( 'YmdHis-siHdmY' ) );
            $pasajero->token_doc_da = $token_da;
            $pasajero->hash_doc_da = bcrypt($token_da);
        }

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
            'rut_pasajero'=>'required',
            'nombre_pasajero'=>'required|min:3',
            'apellido_paterno_pasajero'=>'required|min:3',
            'apellido_materno_pasajero'=>'required|min:3',
            'fecha_nacimiento_pasajero'=>'required|date|before:today',
            'sexo_pasajero'=>'required',
            'direccion_pasajero'=>'required',
            'telefono_pasajero'=>'digits:9',
        ]);
        $pasajero = Pasajero::find($id);
        $pasajero->rut_pasajero = $request->rut_pasajero;
        $pasajero->nombre_pasajero = $request->nombre_pasajero;
        $pasajero->apellido_paterno_pasajero = $request->apellido_paterno_pasajero;
        $pasajero->apellido_materno_pasajero = $request->apellido_materno_pasajero;
        $pasajero->fecha_nacimiento_pasajero = $request->fecha_nacimiento_pasajero;
        $pasajero->sexo_pasajero = $request->sexo_pasajero;
        $pasajero->direccion_pasajero = $request->direccion_pasajero;
        $pasajero->telefono_pasajero = $request->telefono_pasajero;
        //$pasajero->contacto_pasajero = $request->contacto_pasajero;
        if($request->comuna){
            $pasajero->comuna_id = $request->comuna;
        }
        if($request->file('documento_ci')){
            $archivo_ci = $request->file('documento_ci')->store('docs_pasajeros');
            $nombre_documento_ci = $request->file('documento_ci')->getClientOriginalName();
            $pasajero->nombre_doc_ci = $nombre_documento_ci;
            $pasajero->ruta_doc_ci = $archivo_ci;
            $token_ci = md5( Str::random( '100' ) . date( 'YmdHis-siHdmY' ) );
            $pasajero->token_doc_ci = $token_ci;
            $pasajero->hash_doc_ci = bcrypt($token_ci);
        }
        if($request->file('documento_csh')){
            $archivo_csh = $request->file('documento_csh')->store('docs_pasajeros');
            $nombre_documento_csh = $request->file('documento_csh')->getClientOriginalName();
            $pasajero->nombre_doc_csh = $nombre_documento_csh;
            $pasajero->ruta_doc_csh = $archivo_csh;
            $token_csh = md5( Str::random( '100' ) . date( 'YmdHis-siHdmY' ) );
            $pasajero->token_doc_csh = $token_csh;
            $pasajero->hash_doc_csh = bcrypt($token_csh);
        }
        if($request->file('documento_da')){
            $archivo_da = $request->file('documento_da')->store('docs_pasajeros');
            $nombre_documento_da = $request->file('documento_da')->getClientOriginalName();
            $pasajero->nombre_doc_da = $nombre_documento_da;
            $pasajero->ruta_doc_da = $archivo_da;
            $token_da = md5( Str::random( '100' ) . date( 'YmdHis-siHdmY' ) );
            $pasajero->token_doc_da = $token_da;
            $pasajero->hash_doc_da = bcrypt($token_da);
        }
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

        try {
            $pasajero_a_eliminar = Pasajero::find($id);
            $pasajero_a_eliminar->delete();
    
            return redirect()->back()->with('success', 'Pasajero Eliminado');

        } catch (\Illuminate\Database\QueryException $e){
            //return $e->getMessage();
            return redirect()->back()->with('fail', 'No se puede eliminar el pasajero');
        }
    }

    public function destroy_document($id, $doc)
    {
        $pasajero = Pasajero::find($id);
        switch($doc){
            case(1):
                $pasajero->nombre_doc_ci = null;
                $pasajero->ruta_doc_ci = null;
                $pasajero->token_doc_ci = null;
                $pasajero->hash_doc_ci = null;
                $pasajero->save();
                return redirect()->back()->with('success', 'Documento eliminado');
            case(2):
                $pasajero->nombre_doc_csh = null;
                $pasajero->ruta_doc_csh = null;
                $pasajero->token_doc_csh = null;
                $pasajero->hash_doc_csh = null;
                $pasajero->save();
                return redirect()->back()->with('success', 'Documento eliminado');
            case(3):
                $pasajero->nombre_doc_da = null;
                $pasajero->ruta_doc_da = null;
                $pasajero->token_doc_da = null;
                $pasajero->hash_doc_da = null;
                $pasajero->save();
                return redirect()->back()->with('success', 'Documento eliminado');
        }
    }

    public function download_document($token, $doc)
    {
        switch($doc){
            case(1):
                $pasajero = Pasajero::where('token_doc_ci', $token)->first();
                if (Hash::check($token, $pasajero->hash_doc_ci))
                {
                    return Storage::download($pasajero->ruta_doc_ci, $pasajero->nombre_doc_ci);
                }
            case(2):
                $pasajero = Pasajero::where('token_doc_csh', $token)->first();
                if (Hash::check($token, $pasajero->hash_doc_csh))
                {
                    return Storage::download($pasajero->ruta_doc_csh, $pasajero->nombre_doc_csh);
                }
            case(3):
                $pasajero = Pasajero::where('token_doc_da', $token)->first();
                if (Hash::check($token, $pasajero->hash_doc_da))
                {
                    return Storage::download($pasajero->ruta_doc_da, $pasajero->nombre_doc_da);
                }
        }

    }

    public function download_list($id){
        return Excel::download(new PasajerosExport($id), 'users.xlsx');
    }

}
