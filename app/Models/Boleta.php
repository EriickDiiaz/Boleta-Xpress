<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    protected $fillable = [
        'estudiante_id',
        'escuela_id',
        'grado_id',
        'seccion_id',
        'ano_escolar_id',
        'momento',
        'tipo_boleta',
        'proyecto',
        'observaciones',
        'calificacion_general',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class);
    }

    public function anoEscolar()
    {
        return $this->belongsTo(AnoEscolar::class);
    }

    public function calificacionesAsignaturas()
    {
        return $this->hasMany(CalificacionAsignatura::class);
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class);
    }
}