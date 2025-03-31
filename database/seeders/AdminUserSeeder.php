<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
       

        // Crear el usuario administrador
        $admin = User::create([
            'name' => 'Administrador',
            'apellido' => 'Sistema',
            'correo' => 'admin@example.com',
            'password' => Hash::make('password'),
            'cedula' => '00000000',
            'email' => 'admin',
        ]);

        // Asignar el rol de administrador
        $admin->assignRole('Administrador');
    }
}