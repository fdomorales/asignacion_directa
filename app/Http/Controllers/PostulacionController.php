<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;
use App\Models\Postulacion;
use App\Models\Organizacion;
use App\Models\Representante;
use App\Models\User;
use App\Models\Comuna;
use App\Models\EstadoPostulacion;
use App\Models\Viaje;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Exports\PostulacionExports;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostulacionAceptada;
use App\Mail\PostulacionRechazada;
use App\Mail\PostulacionConViaje;
use Excel;
use PDF;

class PostulacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:postulaciones.index')->only('index');
        $this->middleware('can:postulaciones.create')->only('create');
        $this->middleware('can:postulaciones.store')->only('store');
        $this->middleware('can:postulaciones.show')->only('show');
        $this->middleware('can:postulaciones.edit')->only('edit');
        $this->middleware('can:postulaciones.update')->only('update');
        $this->middleware('can:postulaciones.destroy')->only('destroy');
        $this->middleware('can:postulaciones.aceptaPostulacion')->only('aceptaPostulacion');
        $this->middleware('can:postulaciones.rechazaPostulacion')->only('rechazaPostulacion');
        $this->middleware('can:postulaciones.aceptaPostulacion')->only('aceptaPostulacion');
    }


    public function index()
    {
        $postulaciones = Postulacion::with(['estado_postulacion', 'region', 'organizacion', 'periodo.calendario', 'viaje'])->orderBy('created_at', 'asc')->get();
        return view('postulacion.index', ['postulaciones'=>$postulaciones]);
    }


    public function index_customer()
    {
        $organizacion = Organizacion::with(['postulacion.periodo.estado_periodos', 'postulacion.viaje'])->where('user_id', '=', auth()->user()->id)->first();
        // HACK: Se agrega "latest()" obtener la ultima postulación realizada
        $postulacion = Postulacion::with(['estado_postulacion', 'viaje'])->where('organizacion_id', '=', $organizacion->id)->latest()->first();

        $periodoActivoId = Periodo::getIdPeriodoActivo();

        // HACK: Se agrega "latest()" obtener el último viaje seleccionado
        $viajes = Viaje::latest()->first();

        $viaje = [];
        $numero_pasajeros = 0;
        $indicador = 0;
        if($postulacion){
            $viaje = Viaje::where('postulacion_id', '=', $postulacion->id)->with('pasajeros')->first();
            if($viaje){
                $numero_pasajeros = count($viaje->pasajeros);
                $indicador = $numero_pasajeros / 2; //agregar postulacion->cupos para hacer la división
            }
        }

        return view('postulacion.usuario.index', ['organizacion'=>$organizacion, 'postulacion'=> $postulacion, 'viaje'=> $viaje, 'viajes'=> $viajes, 'numero_pasajeros'=> $numero_pasajeros, 'indicador' => $indicador, 'periodoActivoId' => $periodoActivoId]);
    }


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


    public function create_by_customer()
    {
        if (is_null(Periodo::getIdPeriodoActivo())) {
            return view('errors.custom')->with('message', 'Lo sentimos. Aún no se encuentra habilitado el periodo de postulacón');
        }

        $user_id = Auth::id();
        $usuario = User::query()
            ->with('organizacion')
            ->find($user_id);

        $representantes = Representante::all()
            ->where('organizacion_id','=', $usuario->organizacion->id);

        $comuna_usuario = User::with('organizacion')->find($user_id)->organizacion->comuna_id;
        $region_usuario = Comuna::with('provincia')->find($comuna_usuario)->provincia->region_id;

        $periodo = Periodo::with(['region'])
            ->join('periodo_region', 'periodos.id', '=', 'periodo_region.periodo_id')
            ->where('region_id', $region_usuario)->where('estado_periodos_id', 1)
            ->first();

        return view('postulacion.usuario.formulario',['periodo'=>$periodo, 'usuario'=>$usuario, 'representantes'=> $representantes]);
    }


    public function store(Request $request)
    {
        $request -> validate([
            'periodo'=>'required',
            'cupos'=>'required',
            'acepta_terminos_y_condiciones'=>'required',
            'documento'=> 'required'
        ]);
        
        DB::beginTransaction();
        try {
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

            $cantidad_representantes = $usuario->organizacion->representante->count();
            if ($cantidad_representantes > 1){
                $postulacion->save();
                //return $postulacion;
                //cambiar el redirect del email
            }else{
                return redirect()->back()->with('fail', 'Debe agregar al menos 2 reprentantes');
            }

        } catch (\Exception $e) {
            DB::rollback();
			throw $e;
        }

        DB::commit();
        
        return redirect()->route('mailPostulacion',['postulacion'=> $postulacion->id,'email'=> $usuario->email]);
        
    }

    public function store_by_customer(Request $request)
    {
        if (is_null(Periodo::getIdPeriodoActivo())) {
            return view('errors.custom')->with('message', 'Lo sentimos. Aún no se encuentra habilitado el periodo de postulacón');
        }

        // TODO: Agregar DB::beginTransaction();
        $request -> validate([
            'periodo'=>'required',
            'cupos'=>'required',
            'acepta_terminos_y_condiciones'=>'required',
            'documento'=> 'required'
        ]);

        DB::beginTransaction();

        try{
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

            $cantidad_representantes = $usuario->organizacion->representante->count();
            if ($cantidad_representantes > 1){
                $postulacion->save();
            } else {
                return redirect()->back()->with('fail', 'Debe agregar al menos 2 reprentantes');
            }

        } catch (\Exception $e) {
            DB::rollback();
			throw $e;
        }

        DB::commit();
        
        return redirect()->route('mailPostulacion',['postulacion'=> $postulacion->id,'email'=> $usuario->email]);
        
    }


    public function show($id)
    {
        $postulacion = Postulacion::with(['estado_postulacion', 'region', 'organizacion', 'periodo', 'organizacion'])->find($id);

        $periodos = Periodo::all();
        $estado_postulacion = EstadoPostulacion::all();
        //return $postulacion;
        return view('postulacion.detalle', ['postulacion'=>$postulacion,'periodos'=>$periodos, 'estado_postulacion'=>$estado_postulacion]);
    }
    public function show_by_customer($id)
    {
        $postulacion = Postulacion::with(['estado_postulacion', 'region', 'organizacion', 'periodo', 'organizacion'])->find($id);

        $periodos = Periodo::all();
        $estado_postulacion = EstadoPostulacion::all();
        //return $postulacion;
        return view('postulacion.usuario.editar', ['postulacion'=>$postulacion,'periodos'=>$periodos, 'estado_postulacion'=>$estado_postulacion]);
    }


    public function edit($id)
    {

        $postulacion = Postulacion::with(['estado_postulacion', 'region', 'organizacion', 'periodo', 'organizacion'])->find($id);

        $periodos = Periodo::all();
        $estado_postulacion = EstadoPostulacion::all();
        //return $postulacion;
        return view('postulacion.editar_formulario', ['postulacion'=>$postulacion,'periodos'=>$periodos, 'estado_postulacion'=>$estado_postulacion]);
    }


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
    public function update_by_customer(Request $request, $id)
    {
        $postulacion_actualizada = Postulacion::find($id);
        $postulacion_actualizada->cupos = $request->cupos;
        $postulacion_actualizada->periodo_id = $request->periodo;
        $postulacion_actualizada->save();

        //return $postulacion_actualizada;
        return redirect()->route('index_customer')->with('success', 'Postulación actualizada');
    }


    public function destroy($id)
    {

        $postulacion_a_borrar = Postulacion::find($id);

        if(auth()->user()->hasRole('Cliente')){
            try {
                $postulacion_a_borrar->delete();

                return redirect()->back()->with('success', 'Postulación borrada');

            } catch (\Illuminate\Database\QueryException $e){
                //return $e->getMessage();
                return redirect()->back()->with('fail', 'No se puede eliminar la postulación');
            }
        }elseif(auth()->user()->hasRole('Admin')){
            try {
                $postulacion_a_borrar->delete();

                return redirect()->route('postulacion.index')->with('success', 'Postulación borrada');

            } catch (\Illuminate\Database\QueryException $e){
                //return $e->getMessage();
                return redirect()->back()->with('fail', 'No se puede eliminar la postulación');
            }
        }
    }


    public function getDocument($token)
    {
        $postulacion = Postulacion::where('token_documento', $token)->first();
        if (Hash::check($token, $postulacion->hash_documento))
        {
            return Storage::download($postulacion->ruta_documento, $postulacion->nombre_documento);
        }
    }


    public function terminarCarga ($id){
        $postulacion = Postulacion::find($id);
        $postulacion->estado_postulacion_id = 5;
        $postulacion->save();
        return redirect()->back();
    }


    public function aceptaPostulacion($id) {
        
        DB::beginTransaction();
        try{
            $postulacion_aprobar = Postulacion::has('periodo.calendario')->find($id);
            if (is_null($postulacion_aprobar)) return redirect()->route('postulacion.index')->with('fail', 'No existe un calendario cargado');
    
            $email_organizacion = Postulacion::join('organizaciones','postulaciones.organizacion_id', '=', 'organizaciones.id')
            ->select('organizaciones.correo_organizacion')->first()->correo_organizacion;
            $postulacion_aprobar->estado_postulacion_id = 1;
            $postulacion_aprobar->save();
    
            $correo = new PostulacionAceptada();
            Mail::to($email_organizacion)->send($correo);

        } catch (\Exception $e) {
            DB::rollback();
			throw $e;
        }
        
        DB::commit();

        //return redirect()->route('postulacion.index')->with('success', 'Postulación Aprobada');
        return redirect()->route('postulacion.index')->with('success', 'Postulación Aprobada');
    }


    public function rechazaPostulacion($id){

        DB::beginTransaction();

        try{
            $postulacion_rechazar = Postulacion::has('periodo.calendario')->find($id);
            if (is_null($postulacion_rechazar)) return redirect()->route('postulacion.index')->with('fail', 'No existe un calendario cargado');
    
            $email_organizacion = Postulacion::join('organizaciones','postulaciones.organizacion_id', '=', 'organizaciones.id')
            ->select('organizaciones.correo_organizacion')->first()->correo_organizacion;
            $postulacion_rechazar->estado_postulacion_id = 3;
            $postulacion_rechazar->save();
    
            $correo = new PostulacionRechazada();
            Mail::to($email_organizacion)->send($correo);
        } catch (\Exception $e) {
            DB::rollback();
			throw $e;
        }
        
        DB::commit();

        return redirect()->route('postulacion.index')->with('success', 'Postulación rechazada');
    }


    public function asignarViajesPostulacion($id){

        DB::beginTransaction();

        try{
            $estado_postulacion_asignado = 4;
    
            // Modificado por aiturra
            $postulacion = Postulacion::has('periodo.calendario')->find($id);
    
            $email_organizacion = Postulacion::join('organizaciones','postulaciones.organizacion_id', '=', 'organizaciones.id')
            ->select('organizaciones.correo_organizacion')->first()->correo_organizacion;
            $postulacion->estado_postulacion_id = $estado_postulacion_asignado;
            $postulacion->save();
    
            $correo = new PostulacionConViaje();
            Mail::to($email_organizacion)->send($correo);

        } catch (\Exception $e) {
            DB::rollback();
			throw $e;
        }
        
        DB::commit();

        return redirect()->route('postulacion.index')->with('success', 'Viajes disponibles para la organización');
    }


    public function downloadPostulaciones(){
        return Excel::download(new PostulacionExports(), 'postulaciones.xlsx');
    }
    

    public function downloadPDFPostulacion($id){
        $postulacion = Postulacion::find($id);
        $pdf = PDF::loadview('postulacion.usuario.pdf_postulacion', compact('postulacion'));

        return $pdf->download('postulacion.pdf');
    }
}
