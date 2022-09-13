<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::create(['name'=> 'Admin']);
        $role_customer = Role::create(['name'=> 'Cliente']);
        $role_viewer = Role::create(['name'=> 'Observador']);
        $role_editor = Role::create(['name' => 'Editor']);

        Permission::create(['name'=> 'periodos.index'])->assignRole($role_admin, $role_editor, $role_viewer);
        Permission::create(['name'=> 'periodos.create'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'periodos.store'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'periodos.show'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'periodos.update'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'periodos.destroy'])->assignRole($role_admin, $role_editor);

        
        Permission::create(['name'=> 'postulaciones.index'])->assignRole($role_admin, $role_editor, $role_viewer);
        Permission::create(['name'=> 'postulaciones.create'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'postulaciones.store'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'postulaciones.show'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'postulaciones.edit'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'postulaciones.update'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'postulaciones.destroy'])->assignRole($role_admin, $role_editor, $role_customer);
        Permission::create(['name'=> 'postulaciones.aceptaPostulacion'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'postulaciones.rechazaPostulacion'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'postulaciones.asignarViajesPostulacion'])->assignRole($role_admin, $role_editor);

        Permission::create(['name'=> 'postulaciones.index_customer'])->assignRole($role_customer);
        Permission::create(['name'=> 'postulaciones.create_by_customer'])->assignRole($role_customer);
        Permission::create(['name'=> 'postulaciones.store_by_customer'])->assignRole($role_customer);
        Permission::create(['name'=> 'postulaciones.show_by_customer'])->assignRole($role_customer);
        Permission::create(['name'=> 'postulaciones.update_by_customer'])->assignRole($role_customer);

        
        Permission::create(['name'=> 'organizaciones.index'])->assignRole($role_admin, $role_editor, $role_viewer);
        Permission::create(['name'=> 'organizaciones.show'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'organizaciones.show_customer'])->assignRole($role_customer);
        Permission::create(['name'=> 'organizaciones.edit'])->assignRole($role_admin, $role_editor, $role_customer);
        Permission::create(['name'=> 'organizaciones.update'])->assignRole($role_admin, $role_editor, $role_customer);
        Permission::create(['name'=> 'organizaciones.destroy'])->assignRole($role_admin, $role_editor);
        
        
        Permission::create(['name'=> 'calendarios.index'])->assignRole($role_admin, $role_editor, $role_viewer);
        Permission::create(['name'=> 'calendarios.create'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'calendarios.show'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'calendarios.update'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'calendarios.insertTravels'])->assignRole($role_admin, $role_editor);

        
        Permission::create(['name'=> 'comunas.index'])->assignRole($role_admin, $role_editor, $role_viewer);
        Permission::create(['name'=> 'comunas.store'])->assignRole($role_admin);
        Permission::create(['name'=> 'comunas.update'])->assignRole($role_admin);
        Permission::create(['name'=> 'comunas.destroy'])->assignRole($role_admin);
        
        
        Permission::create(['name'=> 'viajes.index'])->assignRole($role_admin, $role_editor, $role_viewer);
        Permission::create(['name'=> 'viajes.show'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'viajes.update'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'viajes.destroy'])->assignRole($role_admin, $role_editor);
        Permission::create(['name'=> 'viajes.set_assignment'])->assignRole($role_customer);


        Permission::create(['name'=> 'users.index'])->assignRole($role_admin);
        Permission::create(['name'=> 'users.edit'])->assignRole($role_admin);
        Permission::create(['name'=> 'users.update'])->assignRole($role_admin);

        

    }
}
