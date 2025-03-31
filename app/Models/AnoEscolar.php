<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class AnoEscolar extends Model
{
    protected $table = 'anos_escolares';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
    ];
}