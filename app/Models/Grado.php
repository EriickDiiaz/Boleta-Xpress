<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}