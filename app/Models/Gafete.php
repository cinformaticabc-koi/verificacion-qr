<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gafete extends Model
{
    protected $fillable = [
        'token',
        'nombre',
        'apellido',
        'cedula',
        'telefono',
        'supervisor',
        'municipio',
        'estado',
        'fecha_expiracion'
    ];
    
    protected $casts = [
    'fecha_expiracion' => 'datetime',
];
}