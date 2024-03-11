<?php

namespace App\Http\Livewire\Egre;

use Livewire\Component;
use App\Models\adq\cat_articulos;
use Illuminate\Support\Facades\DB;
class ShowVentas extends Component
{
    public $arrayDataCars = []; 
    public $generateid = 1; 
    public $additem ; 
    public $importe ; 
    public $cambio ; 
    public $total = 0 ; 
    public function render()
    { 
        return view('livewire.egre.show-ventas');
    }

    public function addItemCar(){    
       // $articulo = DB::select('SELECT  nombre, code, descripcion,precio,id, '.\DB::raw( ($this->generateid  + 1 ).' as idcar')  .' FROM adq_cat_articulos WHERE code = ?', [$this->additem]); 
        
       

       $articulo = cat_articulos::select( 'nombre', 'code', 'descripcion', 'precio','id' )->where('code', $this->additem)->first();
        
       if( $articulo ){

        
        
        //obtenemos cantidad
         
        foreach ($this->arrayDataCars as $indice => $arrayDataCar){
            if($arrayDataCar["code"] == $this->additem){
                // Existe solo modificamos cantidad + 1
                $this->arrayDataCars[$indice]["cantidad"] = $arrayDataCar["cantidad"] + 1;
                $this->additem = "";
                $this->calcularTotal();
                return;
            }
        }


        $nuevaColeccion = collect([ 
                    'nombre'        =>  $articulo->nombre,
                    'code'          =>  $articulo->code,
                    'descripcion'   =>  $articulo->descripcion,
                    'precio'        =>  $articulo->precio,  
                    'cantidad'      =>  1,  
                    'id'            =>  $articulo->id,  
                    'idcar'         =>  $this->generateid
            ]);

            if(count($this->arrayDataCars) == 0){
                $this->arrayDataCars[] = $nuevaColeccion;
                $this->generateid++;
                $this->additem = "";
                $this->calcularTotal();
              } else{ 
               $this->arrayDataCars[] = $nuevaColeccion;
               $this->generateid++;
               $this->additem = "";
               $this->calcularTotal();
            }
        }
    }
    public function calcularTotal(){    
         
         foreach ($this->arrayDataCars as $indice => $arrayDataCar){
                $this->total    =  ($this->arrayDataCars[$indice]["cantidad"]*$this->arrayDataCars[$indice]["precio"]);
         }    
    } 
} 