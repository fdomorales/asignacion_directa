<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Region;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Jumbojett\OpenIDConnectClient;

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
        $request -> validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        list($usuario, $dominio) = explode('@', $request->email);

        $user = User::whereNotNull('email_verified_at')
			->where('email',$request->email)
			->first();

        if(is_null($user)) {
            return redirect('/login');
        }

        if($dominio == 'sernatur.cl') {
            $oidc = new OpenIDConnectClient('https://sso.sernatur.cl/auth/realms/asignacion-directa', 'asignacion-directa', 'fddfa932-bc95-4c81-8815-5a94b4fc722d');
			$oidc->providerConfigParam(array('token_endpoint' => 'https://sso.sernatur.cl/auth/realms/asignacion-directa/protocol/openid-connect/token'));
            $oidc->addScope('openid');

            //Add username and password
            $oidc->addAuthParam(array('username' => $request->email));
            $oidc->addAuthParam(array('password' => $request->password));

            //Perform the auth and return the token (to validate check if the access_token property is there and a valid JWT) :
            $token = json_decode(json_encode($oidc->requestResourceOwnerToken(TRUE)), TRUE);

            if ( array_key_exists('access_token', $token)) {
				Auth::login($user);
                $request->session()->regenerate();
            } else {
                return back()
                    ->withErrors(['email' => 'Estas credenciales no coinciden con nuestros registros.'])
                    ->onlyInput('email');
            }

        } else {
            $request->authenticate();
            $request->session()->regenerate();
        }

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
