<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hp',
        'es_primera_edicion',
        'expansion',
        'tipo',
        'rareza',
        'precio',
        'imagen_online',
    ];
}
