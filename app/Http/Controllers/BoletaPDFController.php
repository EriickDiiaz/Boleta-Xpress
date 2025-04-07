<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class BoletaPDFController extends Controller
{
    public function generarPDF($estudiante, Boleta $boleta)
{
    $escuela = $boleta->estudiante->escuela;
    
    // Inicializar variable para el logo
    $logoEscuelaBase64 = '';
    
    // Intentar cargar el logo solo si existe
    if ($escuela->logo && Storage::disk('public')->exists($escuela->logo)) {
        try {
            // Obtener la ruta completa del logo de la escuela
            $logoEscuelaPath = Storage::disk('public')->path($escuela->logo);
            
            // Convertir la imagen a base64 si el archivo existe
            if (file_exists($logoEscuelaPath)) {
                $logoEscuelaBase64 = base64_encode(file_get_contents($logoEscuelaPath));
            }
        } catch (\Exception $e) {
            // Si hay un error, simplemente continuar sin el logo
            //Log::error('Error al cargar el logo: ' . $e->getMessage());
        }
    }

    $data = [
        'boleta' => $boleta,
        'escuela' => $escuela,
        'logoEscuelaBase64' => $logoEscuelaBase64,
    ];
    
    $pdf = Pdf::loadView('boletas.pdf', $data);
    $pdf->setPaper('letter', 'portrait');
    $pdf->setOptions([
        'dpi' => 150,
        'defaultFont' => 'Calibri',
        'isRemoteEnabled' => true,
        'isHtml5ParserEnabled' => true,
        'chroot' => [public_path(), storage_path('app/public')],
    ]);

    return $pdf->stream('boleta.pdf');
}
}