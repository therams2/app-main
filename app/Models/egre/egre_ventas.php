<?php

namespace App\Models\egre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class egre_ventas extends Model
{
    use HasFactory;
    protected $table = 'ing_cat_ventas';
    protected $fillable = [
        'id',
        'totalventa',
        'importe',
        'cambio',
        'estatus'
    ];
}
