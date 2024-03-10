<?php

namespace App\Http\Livewire\Egre;

use Livewire\Component;
use App\Models\adq\cat_articulos;
class ShowVentas extends Component
{
    public $arrayDataCars = []; 
    public $additem ; 
    public function render()
    { 
        return view('livewire.egre.show-ventas');
    }

    public function addItemCar(){
         
        $articulo = cat_articulos::where('code', $this->additem)->get();
    
        if($articulo){
            $this->arrayDataCars = $articulo;
        }
         
    }
}
