<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'fernando',
            'email' => 'fmorales@sernatur.cl',
            'password' => bcrypt('1233'),
            'email_verified_at' => '2022-07-22 16:47:23'
        ])->assignRole('Admin');

        User::factory(4)->create()->each(function ($user) {
            $user->assignRole('Customer');
        });
    }
}
