<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role' => 'Administrador'
        ]);
        Role::create([
            'role' => 'Profesor'
        ]);
        Role::create([
            'role' => 'Secretaria'
        ]);
    }
}
