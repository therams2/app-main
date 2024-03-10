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
        if(count($this->arrayDataCars)==0){
            $this->arrayDataCars = $articulo;
        } else{
            $this->arrayDataCars =  $this->arrayDataCars->concat($articulo);
        }
        //dd($this->arrayDataCars);
    }
}
