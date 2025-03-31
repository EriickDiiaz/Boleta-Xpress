<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'grado_id'];

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class);
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }
}