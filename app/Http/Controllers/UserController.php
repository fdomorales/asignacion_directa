<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.edit')->only('edit');
        $this->middleware('can:users.update')->only('update');

    }


    public function index()
    {
        //$usuarios = User::paginate(10);
        $usuarios = User::all();

        return view('users.index', ['users'=> $usuarios]);
    }


    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'email'=>'required|email|unique:users',
            'rol'=>'required'
        ]);

        DB::beginTransaction();

        try {
            $usuario = new User;
            $usuario->name = $request->nombre;
            $usuario->email = $request->email;
            $usuario->password = bcrypt('123456');
            $usuario->email_verified_at = date('Y-m-d H:i:s');
            $usuario->save();

            $usuario->assignRole($request->rol);

        } catch (\Exception $e) {
            DB::rollback();
			throw $e;
        }

        DB::commit();

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente');
    }


    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $role_user_id = $user->roles->pluck('id')->first();

        return view('users.edit', ['user'=>$user, 'roles'=> $roles, 'role_user_id'=>$role_user_id]);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->roles()->sync($request->role);
        return redirect()->route('usuarios.index')->with('success', 'Permiso asignado a usuario');
    }
    
}
