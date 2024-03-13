<?php

namespace App\Models\ing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingventasdet extends Model
{
    use HasFactory;
    protected $table = 'ing_cat_ventas_det';
    protected $fillable = [
        'id',
        'idcatarticulos',
        'idcar',
        'idcatventas',
        'idunidadtipo',
        'idunidadmedida',
        'concepto',
        'code',
        'cantidad',
        'precio'
    ];
}
