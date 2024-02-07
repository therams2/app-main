<?php

namespace App\Http\Livewire\Adq;

use Livewire\Component;
use App\Models\adq\cat_categorias;

class ShowCatCategorias extends Component
{
    public $nombre;
    public $descripcion;

   
    public function render()
    {
        $categorias =  cat_categorias::select()->get();
        return view('livewire.adq.show-cat-categorias', compact('categorias' ));
    }
    
    public function save(){
        $arrayData = $this->validate(
            [
                'nombre'        => 'required',
            ],
            [
                'nombre.required'           => '* Requerido',
            ]
        );
        $arrayData['descripcion'] =  $this->descripcion; 
        
        cat_categorias::create($arrayData);
        
        //ACTUALIZAMOS ARRAYS
        $this->getCategorias = cat_categorias::all();
    }
    
}
