<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(GradosSeeder::class);
        $this->call(SeccionesSeeder::class);
        $this->call(AnosEscolaresSeeder::class);
        $this->call(EscuelaSeeder::class);
        $this->call(AsignaturasSeeder::class);
        //$this->call(EstudianteSeeder::class);
        
    }
}
