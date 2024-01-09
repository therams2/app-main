<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat_funcionarios extends Model
{
    use HasFactory;
    protected $table = 'cat_funcionarios';
    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'email',
        'direccion',
        'foto',
        'estatus',
        'funcionariop'
    ];

}
