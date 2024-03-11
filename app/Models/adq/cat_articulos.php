<?php

namespace App\Models\adq;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat_articulos extends Model
{
    use HasFactory;
    protected $table = 'adq_cat_articulos';
    protected $fillable = [
        'id',
        'code',
        'descripcion',
        'precio',
        'peso',
        'nombre',
        'cantidad',
        'costo_ini',
        'id_categoria',
        'id_unidad_medida',
        'id_unidad_tipo',
        'precio_kilo',
        'idcar'
    ];
}
