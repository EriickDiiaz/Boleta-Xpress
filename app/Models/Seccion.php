<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table = 'secciones';

    protected $fillable = ['nombre'];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}