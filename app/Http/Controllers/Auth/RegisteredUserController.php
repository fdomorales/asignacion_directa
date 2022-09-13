<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Organizacion;
use App\Models\Region;
use App\Models\Provincia;
use App\Models\Comuna;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $regiones = Region::with('provincia.comuna')->get();
        $provincias = Provincia::all();
        $comunas = Comuna::all();
        //return $regiones;
        //return view('auth.register');
        return view('login.register', ['regiones'=> $regiones, 'provincias'=>$provincias, 'comunas'=>$comunas]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono_organizacion' => ['required', 'digits:9'],
            'comuna' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::min(3)],
            /* min(8)
            ->mixedCase()
            ->letters()
            ->numbers()], */
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole('Cliente');
        $new_organization = new Organizacion;
        $new_organization->nombre_organizacion = $request->name;
        $new_organization->correo_organizacion = $request->email;
        $new_organization->telefono_organizacion = $request->telefono_organizacion;
        $new_organization->comuna_id = $request->comuna;
        $new_organization->user_id = $user->id;
        $new_organization->save();

        event(new Registered($user));

        Auth::login($user);

        //return redirect(RouteServiceProvider::HOME);
        return redirect('/');
    }
}
