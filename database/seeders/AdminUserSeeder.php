<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrador',
            'apellido' => 'Sistema',
            'correo' => 'admin@example.com',
            'password' => Hash::make('password'),
            'cedula' => '00000000',
            'email' => 'admin',
        ]);
    }
}
