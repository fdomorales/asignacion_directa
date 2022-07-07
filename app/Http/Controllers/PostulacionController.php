<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;
use App\Models\Postulacion;
use App\Models\Organizacion;
use App\Models\Representante;
use App\Models\User;
use App\Models\Region;
use App\Models\EstadoPostulacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Exports\PostulacionExports;
use Excel;

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
        $user_id =  Auth::id();
        $usuario = User::with('organizacion')->find($user_id);
        $representantes = Representante::all()->where('organizacion_id','=', $usuario->organizacion->id);

        $comuna_usuario = User::with('organizacion')->find($user_id)->organizacion->comuna_id;

        $periodo = Periodo::with(['region'])
        ->join('periodo_region', 'periodos.id', '=', 'periodo_region.periodo_id')
        ->where('region_id', $comuna_usuario)->where('estado_periodos_id', 1)
        ->first();
        //return $periodos;
        return view('postulacion.formulario',['periodo'=>$periodo, 'usuario'=>$usuario, 'representantes'=> $representantes]);
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
        $estado_postulacion = 2;
        
        $user_id =  Auth::id();
        $usuario = User::with('organizacion')->find($user_id);
        $comuna_usuario = User::with('organizacion')->find($user_id)->organizacion->comuna_id;
        $region_usuario = DB::table('regiones')->join('provincias', 'regiones.id','=', 'provincias.region_id')
        ->join('comunas', 'provincias.id','=', 'comunas.provincia_id')
        ->where('comunas.id','=',$comuna_usuario)->select('regiones.id')->first()->id;
        $periodo = Periodo::with(['region'])
        ->join('periodo_region', 'periodos.id', '=', 'periodo_region.periodo_id')
        ->where('region_id', $region_usuario)->where('estado_periodos_id', 1)
        ->select('periodos.*')
        ->first();

        $postulacion = new Postulacion;
        $postulacion->cupos = $request->cupos;
        $postulacion->recibe_info = $request->recibe_info;
        $postulacion->estado_postulacion_id = $estado_postulacion;

        $archivo = $request->file('documento')->store('files_');
        $nombre_documento = $request->file('documento')->getClientOriginalName();
        $postulacion->nombre_documento = $nombre_documento;
        $postulacion->ruta_documento = $archivo;

        $token = md5( Str::random( '100' ) . date( 'YmdHis-siHdmY' ) );
        $postulacion->token_documento = $token;
        $postulacion->hash_documento = bcrypt($token);
        
        $postulacion->comuna_id = $comuna_usuario;
        $postulacion->periodo_id = $periodo->id;
        $postulacion->organizacion_id = $usuario->organizacion->id;
        $postulacion->save();
        //return $postulacion;
        //return redirect()->route('postulacion.index')->with('success', 'Postulación correcta');
        return redirect()->route('mailPostulacion',['postulacion'=> $postulacion->id,'email'=> $usuario->email]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postulacion = Postulacion::with(['estado_postulacion', 'region', 'organizacion', 'periodo', 'organizacion'])->find($id);
        
        $periodos = Periodo::all();
        $estado_postulacion = EstadoPostulacion::all();
        //return $postulacion;
        return view('postulacion.detalle', ['postulacion'=>$postulacion,'periodos'=>$periodos, 'estado_postulacion'=>$estado_postulacion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $postulacion = Postulacion::with(['estado_postulacion', 'region', 'organizacion', 'periodo', 'organizacion'])->find($id);
        
        $periodos = Periodo::all();
        $estado_postulacion = EstadoPostulacion::all();
        //return $postulacion;
        return view('postulacion.editar_formulario', ['postulacion'=>$postulacion,'periodos'=>$periodos, 'estado_postulacion'=>$estado_postulacion]);
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
            'nombre_organizacion'=> 'required|max:50',
            'telefono_organizacion'=> 'required|digits:9',
            'correo_organizacion'=> 'required|email'
        ]);
        $postulacion_actualizada = Postulacion::find($id);
        $organizacion =  Organizacion::find($postulacion_actualizada->organizacion_id);

        $organizacion->nombre_organizacion = $request->nombre_organizacion;
        $organizacion->correo_organizacion = $request->correo_organizacion;
        $organizacion->telefono_organizacion = $request->telefono_organizacion;
        $organizacion->comuna_id = '1';
        $organizacion->save();

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

    public function aceptaPostulacion($id){
        $postulacion_aprobar = Postulacion::find($id);
        $postulacion_aprobar->estado_postulacion_id = 1;
        $postulacion_aprobar->save();

        return redirect()->route('postulacion.index')->with('success', 'Postulación Aprobada');
    }
    public function rechazaPostulacion($id){
        $postulacion_rechazar = Postulacion::find($id);
        $postulacion_rechazar->estado_postulacion_id = 3;
        $postulacion_rechazar->save();

        return redirect()->route('postulacion.index')->with('success', 'Postulación rechazada');
    }

    public function downloadPostulacion($id){
        return Excel::download(new PostulacionExports($id), 'postulacion.xlsx');
    }
}
