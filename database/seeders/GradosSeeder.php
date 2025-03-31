<?php

namespace Database\Seeders;

use App\Models\Grado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear grados
        $grados = ['1er Grado', '2do Grado', '3er Grado', '4to Grado', '5to Grado', '6to Grado'];
        foreach ($grados as $nombreGrado) {
            Grado::create(['nombre' => $nombreGrado]);
        }
    }
}
