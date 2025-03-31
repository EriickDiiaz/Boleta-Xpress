<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnosEscolaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear años escolares
        $anosEscolares = [
            ['2022-2023', 'Octubre 2022', 'Julio 2023'],
            ['2023-2024', 'Octubre 2023', 'Julio 2024'],
            ['2024-2025', 'Octubre 2024', 'Julio 2025'],
            ['2025-2026', 'Octubre 2025', 'Julio 2026'],
        ];

        foreach ($anosEscolares as $anoEscolar) {
            AnoEscolar::create([
                'nombre' => $anoEscolar[0],
                'fecha_inicio' => $anoEscolar[1],
                'fecha_fin' => $anoEscolar[2],
            ]);
        }
    }
}
