<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Periodo;
use App\Models\Postulacion;

class HomeController extends Controller
{
    public function __construct()
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user() && !auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        $periodos = Periodo::query()
            ->with('regiones_periodo.region')
            ->where('fecha_fin', '>=', date('Y-m-d'))
            ->get();

        $periodoActivoId = null;
        if (auth()->user()) {
            if (auth()->user()->hasRole('Cliente')) $periodoActivoId = Periodo::getIdPeriodoActivo();
        }

        $postulacion = null;
        if(auth()->user()) {
            if (auth()->user()->hasRole('Cliente')) {
                $postulacion = Postulacion::query()
                    ->with('periodo.regiones_periodo.region')
                    ->whereHas('periodo', function ($q) {
                        $q->where('fecha_fin', '>=', date('Y-m-d'));
                    })
                    ->whereHas('organizacion', function($q) {
                        $q->where('user_id', auth()->user()->id);
                    })
                    ->first();
            }
        }

        return view('index', compact('periodos', 'postulacion', 'periodoActivoId'));
    }
}
