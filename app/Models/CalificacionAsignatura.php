<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalificacionAsignatura extends Model
{
    protected $table = 'calificaciones_asignaturas';
    protected $fillable = [
        'boleta_id', 
        'asignatura_id', 
        'descripcion',
        'calificacion_literal',
        'calificacion_numerica',
    ];

    public function boleta()
    {
        return $this->belongsTo(Boleta::class);
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }
}