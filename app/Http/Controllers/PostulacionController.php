<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;
use App\Models\Postulacion;
use App\Models\EstadoPostulacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PostulacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postulaciones = Postulacion::with(['estado_postulacion', 'region', 'organizacion', 'periodo'])->paginate(5); 
        /* $postulaciones = DB::table('postulaciones')
        ->join('estado_postulaciones','postulaciones.estado_postulacion_id', '=', 'estado_postulaciones.id')
        ->join('organizaciones', 'postulaciones.organizacion_id', '=', 'organizaciones.id')
        ->join('periodos', 'postulaciones.periodo_id','=', 'periodos.id')
        ->join('regiones', 'postulaciones.region_id', '=', 'regiones.id')
        ->select('postulaciones.*', 'estado_postulaciones.nombre_estado_postulacion', 'organizaciones.nombre_organizacion', 'periodos.descripcion','regiones.nombre_region')
        ->get(); */
        //return $postulaciones;
        return view('postulacion.index', ['postulaciones'=>$postulaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periodos = Periodo::with(['region'])->where('estado_periodos_id', 1)->get();
        //$periodos = Periodo::where('id', 1)->first()->region_id;
        //return $periodos;
        return view('postulacion.formulario',['periodos'=>$periodos]);
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
            'periodo'=>'required',
            'cupos'=>'required',
            'acepta_terminos_y_condiciones'=>'required',
            'documento'=> 'required'
        ]);
        $postulacion = new Postulacion;
        $postulacion->cupos = $request->cupos;
        $postulacion->recibe_info = $request->recibe_info;
        $postulacion->estado_postulacion_id = '2';
        //$postulacion->nombre_documento = $request->file('documento')->getClientOriginalName();
        //$periodo_region = Periodo::where('id', $request->periodo)->first()->region_id;
        //$postulacion->region_id = $periodo_region;

        $archivo = $request->file('documento')->store('files_');
        $nombre_documento = $request->file('documento')->getClientOriginalName();
        $postulacion->nombre_documento = $nombre_documento;
        $postulacion->ruta_documento = $archivo;

        $token = md5( Str::random( '100' ) . date( 'YmdHis-siHdmY' ) );
        $postulacion->token_documento = $token;
        $postulacion->hash_documento = bcrypt($token);

        
        $postulacion->comuna_id = 1;
        $postulacion->periodo_id = $request->periodo;
        $postulacion->organizacion_id = 1;
        $postulacion->save();
        //$request->documento->store('public/uploads/');

        return redirect()->route('postulacion.index')->with('success', 'Postulación correcta');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postulacion = Postulacion::with(['estado_postulacion', 'region', 'organizacion', 'periodo'])->find($id);
        
        $periodos = Periodo::all();
        $estado_postulacion = EstadoPostulacion::all();
        //return $postulacion;
        return view('postulacion.editar_formulario', ['postulacion'=>$postulacion,'periodos'=>$periodos, 'estado_postulacion'=>$estado_postulacion]);
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
        $postulacion_actualizada = Postulacion::find($id);
        $postulacion_actualizada->cupos = $request->cupos;
        $postulacion_actualizada->periodo_id = $request->periodo;
        $postulacion_actualizada->estado_postulacion_id = $request->estado_postulacion;
        $postulacion_actualizada->save();

        //return $postulacion_actualizada;
        return redirect()->route('postulacion.index')->with('success', 'Postulación actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postulacion_a_borrar = Postulacion::find($id);
        $postulacion_a_borrar->delete();

        return redirect()->route('postulacion.index')->with('success', 'Postulación borrada');
    }

    public function getDocument($token)
    {
        $postulacion = Postulacion::where('token_documento', $token)->first();
        if (Hash::check($token, $postulacion->hash_documento))
        {
            return Storage::download($postulacion->ruta_documento, $postulacion->nombre_documento);
        }
    }
}
