<?php

namespace App\Models\adq;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat_categorias extends Model
{
    use HasFactory;
    protected $table = 'adq_cat_categorias';
    protected $fillable = [
        'id',
        'descripcion',
        'nombre'
    ];
}
