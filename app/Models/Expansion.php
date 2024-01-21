<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expansion extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_expansion',
        'es_primera_edicion',
    ];
}
