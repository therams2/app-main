<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat_nombramientos extends Model
{
    use HasFactory;
    
    protected $table = 'cat_nombramientos';
    protected $fillable = [
        'idfuncionarioe',
        'idfuncionarios',
        'idorganigrama',
        'experencia',
     
    
        'estatusfs',
        'estatusfe',
        'observaciones',
        'categoria',
     
        'fecha_alta',
        'fecha_baja',
        'profesion',
        'nivelacademico',
        'gradoacademico',
   
        'sueldoneto',

        'doc_academico',
        'doc_cv',
        'doc_ine',
        'doc_nombramiento',
        'doc_acuse',
        'doc_protesta',
        'doc_renuncia',
        'doc_formato',

        'idmunicipio',
    ];
}
