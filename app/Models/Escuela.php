<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'dea',
        'territorial',
        'director',
        'subdirector',
        'direccion',
        'ciudad',
        'telefono',
        'correo',
        'logo',
    ];

    public function getLogoUrlAttribute()
    {
        return $this->logo
            ? asset('storage/' . $this->logo)
            : asset('img/default-school.png');
    }
}