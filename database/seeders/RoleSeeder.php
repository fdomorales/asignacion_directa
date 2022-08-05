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
        $role_customer = Role::create(['name'=> 'Customer']);

        Permission::create(['name'=> 'periodos.index'])->assignRole($role_admin);
        Permission::create(['name'=> 'periodos.create'])->assignRole($role_admin);
        Permission::create(['name'=> 'periodos.edit'])->assignRole($role_admin);
        Permission::create(['name'=> 'periodos.destroy'])->assignRole($role_admin);

        Permission::create(['name'=> 'postulaciones.index'])->assignRole($role_admin);
        Permission::create(['name'=> 'postulaciones.create'])->assignRole($role_admin);
        Permission::create(['name'=> 'postulaciones.edit'])->assignRole($role_admin);
        Permission::create(['name'=> 'postulaciones.destroy'])->assignRole($role_admin);

        Permission::create(['name'=> 'organizaciones.index'])->assignRole($role_admin);
        Permission::create(['name'=> 'organizaciones.create'])->assignRole($role_admin, $role_customer);
        Permission::create(['name'=> 'organizaciones.edit'])->assignRole($role_admin, $role_customer);
        Permission::create(['name'=> 'organizaciones.destroy'])->assignRole($role_admin);

        Permission::create(['name'=> 'comunas.index'])->assignRole($role_admin);
        Permission::create(['name'=> 'comunas.create'])->assignRole($role_admin);
        Permission::create(['name'=> 'comunas.edit'])->assignRole($role_admin);
        Permission::create(['name'=> 'comunas.destroy'])->assignRole($role_admin);

        Permission::create(['name'=> 'calendarios.index'])->assignRole($role_admin);
        Permission::create(['name'=> 'calendarios.create'])->assignRole($role_admin);
        Permission::create(['name'=> 'calendarios.edit'])->assignRole($role_admin);
        Permission::create(['name'=> 'calendarios.destroy'])->assignRole($role_admin);

    }
}
