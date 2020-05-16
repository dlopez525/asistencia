<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'lastname' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('secret'),
            'role_id' => 1,
        ]);
    }
}
