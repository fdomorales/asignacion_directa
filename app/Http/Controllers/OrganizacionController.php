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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizaciones = Organizacion::with([ 'comuna'])->paginate(15);
        //return $organizaciones;
        return view('organizaciones.index', ['organizaciones' => $organizaciones] );
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organizacion = Organizacion::with('comuna')->find($id);
        $representantes = Representante::all()->where('organizacion_id','=', $id);
        //return $organizacion;
        return view('organizaciones.detalle', ['organizacion' => $organizacion, 'representantes'=> $representantes] );
    }
    public function show_customer($id)
    {
        $user_id = Auth::id();
        $organizacion = Organizacion::with('comuna')->where('user_id', '=', $user_id)->first();
        $representantes = Representante::all()->where('organizacion_id','=', $organizacion->id);
        //return $representantes;
        return view('organizaciones.detalle', ['organizacion' => $organizacion, 'representantes'=> $representantes] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organizacion = Organizacion::find($id);
        $representantes = Representante::all()->where('organizacion_id','=', $id);

        return view('organizaciones.editar', ['organizacion' => $organizacion, 'representantes'=> $representantes] );
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
            'nombre_organizacion'=>'required|min:3',
            'correo_organizacion'=>'required|email',
            'telefono_organizacion'=>'required|digits:9'
        ]);
        $organizacion_editar = Organizacion::find($id);
        $organizacion_editar->nombre_organizacion = $request->nombre_organizacion;
        $organizacion_editar->correo_organizacion = $request->correo_organizacion;
        $organizacion_editar->telefono_organizacion = $request->telefono_organizacion;
        //$organizacion_editar->comuna_id = $request->comuna_id;
        $organizacion_editar->save();
        if(auth()->user()->hasRole('Customer')){
            return redirect()->route('show_customer', ['id'=>$id])->with('success', 'Organización actualizada');
        }else{
            return redirect()->route('organizacion.show', ['organizacion'=>$id])->with('success', 'Organización actualizada');
        }
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
            $organizacion_eliminar = Organizacion::find($id);
            $organizacion_eliminar->delete();
    
            return redirect()->route('organizacion.index')->with('success', 'Organización borrada');
    
        } catch (\Illuminate\Database\QueryException $e){
            //return $e->getMessage();
            return redirect()->back()->with('fail', 'No se puede eliminar la organizacion seleccionada');
        }

    }
    
}
