<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'escuela_id',
        'grado_id',
        'seccion_id',
        'nombres',
        'apellidos',
        'genero',
        'cedula',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'direccion',
        'telefono',
        'correo',
        'nombre_representante',
        'cedula_representante',
        'telefono_representante',
        'correo_representante',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'datetime',
    ];

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

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class);
    }

    // Agregar esta nueva relación
    public function boletas()
    {
        return $this->hasMany(Boleta::class);
    }
}