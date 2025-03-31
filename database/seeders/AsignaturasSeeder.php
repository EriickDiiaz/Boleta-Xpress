<?php

namespace Database\Seeders;

use App\Models\Asignatura;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsignaturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear asignaturas
        $asignaturas = [
            ['Lengua y Literatura', 'Lengua y Literatura'],
            ['Matemática', 'Matemática'],
            ['Ciencias Sociales', 'Ciencias Sociales'],
            ['Ciencias Naturales', 'Ciencias Naturales'],
            ['Educación Física', 'Educación Física'],
            ['Educación Artística', 'Educación Artística'],
        ];

        foreach ($asignaturas as $asignatura) {
            Asignatura::create([
                'nombre' => $asignatura[0],
                'descripcion' => $asignatura[1],
            ]);
        }
    }
}
