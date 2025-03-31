<?php

namespace Database\Seeders;

use App\Models\Escuela;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear escuelas
        $escuelas = [
            ['U.E.P. Santo Niño de Atocha', 'PD14281520', '07', 'Maydelin Silva', 'Vianella Silva', 'Calle Lecumberry, Casa N°8', 'Cúa, Estado Bolivariano de Miranda', '04129382071 / 04141357174', 'snatocha1991@gmail.com','logos/lgHD5HbVi0Q7GOzw2kMajYDoQ5v0nvx0RygzqZaY.png'],
            ['U.E.P. Colegio Emilio Crespo', 'PD14281521', '07', 'Juana Perez', 'Maria Plaza', 'Calle Fátima, con Calle Bolívar', 'Cúa, Estado Bolivariano de Miranda', '02392121759', 'emiliocrespo@gmail.com', 'logos/UEPColegioEmilioCrespo.jpg'],
            ['U.E. Colegio Santos Luzardo', 'PD14281522', '07', 'Gabriela Fernández', 'Valentina Fernández', 'Av. Ppal de Sta. Rosa', 'Cúa, Estado Bolivariano de Miranda', '', 'losluzardos@gmail.com', 'logos/UEColegioSantosLuzardo.jpg'],
            ['C.P.E. Las Margaritas', 'PD14281523', '07', 'Eduard Diaz', 'Mia Valentina', 'Calle Principal de Lecumberry', 'Cúa, Estado Bolivariano de Miranda', '', '','logos/CPELasMargaritas.png'],
            ['U.E.P. Angel Custodio Serrano', 'PD14281524', '07', 'Alejandro Gaspe', 'Susana López', 'Av. Ppal de La Vega', 'Cúa, Estado Bolivariano de Miranda', '02392125555', '', 'logos/UEColegioSantosLuzardo.jpg'],            
        ];

        foreach ($escuelas as $escuela) {
            Escuela::create([
                'nombre' => $escuela[0],
                'dea' => $escuela[1],
                'territorial' => $escuela[2],
                'director' => $escuela[3],
                'subdirector' => $escuela[4],
                'direccion' => $escuela[5],
                'ciudad' => $escuela[6],
                'telefono' => $escuela[7],
                'correo' => $escuela[8],
                'logo' => $escuela[9],                
            ]);
        }
    }
}
