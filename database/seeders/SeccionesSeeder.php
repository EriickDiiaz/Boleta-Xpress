<?php

namespace Database\Seeders;

use App\Models\Seccion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear secciones
        $secciones = ['A', 'B', 'C', 'D', 'E'];
        foreach ($secciones as $nombreSeccion) {
            Seccion::create(['nombre' => $nombreSeccion]);
        }
    }
}
