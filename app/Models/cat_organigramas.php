<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat_organigramas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'idparent',
        'iddependencia',
        'orden',
        'nivel',
        'estatus'
    ];

    public function getChildren($data, $line)
    {
        $children = [];
        foreach ($data as $line1) {
            if ($line['id'] == $line1['idparent']) {
                $children = array_merge($children, [ array_merge($line1, ['submenu' => $this->getChildren($data, $line1) ]) ]);
            }
        }
        return $children;
    }

   

}
