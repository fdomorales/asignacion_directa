<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Region;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //$regiones = Region::whereHas('periodo')->select('nombre_region')->get();
        $regiones = Region::join('periodo_region', 'regiones.id', '=', 'periodo_region.region_id')
        ->join('periodos', 'periodo_region.periodo_id', '=', 'periodos.id')
         ->where('periodos.fecha_inicio', '<',Carbon::now())
         ->where('periodos.fecha_fin', '>',Carbon::now())
         ->where('periodos.estado_periodos_id', '=', 1)
         ->distinct()
        ->get(['nombre_region']); 
        //return $regiones;
        //return view('auth.login');
        return view('login.index', ['regiones'=> $regiones]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
