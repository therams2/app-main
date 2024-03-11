<?php

namespace App\Http\Livewire\Egre;

use Livewire\Component;
use App\Models\adq\cat_articulos;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ShowVentas extends Component
{
    use LivewireAlert;
    public $arrayDataCars = []; 
    public $generateid = 1; 
    public $additem ; 
    public $importe = 0; 
    public $cambio = 0; 
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
         $subtotal = 0;

         foreach ($this->arrayDataCars as $indice => $arrayDataCar){ 
            $subtotal    =   $subtotal + ($this->arrayDataCars[$indice]["cantidad"] * $this->arrayDataCars[$indice]["precio"]) ; 
         }
         $this->total =   $subtotal;
    } 
    public function realizarVenta(){
        if( $this->total >  $this->importe){
            $this->alert('warning', 'El importe es menor que el total', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
               ]);
            return;
        }
        $this->cambio = $this->importe - $this->total;
        $this->alert('success', 'Venta Realizada Correctamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
           ]);
        
    }
    public function limpiarTodo(){
         $this->arrayDataCars = []; 
         $this->generateid = 1; 
         $this->additem = ""; 
         $this->importe = 0; 
         $this->cambio  = 0; 
         $this->total   = 0 ; 
        
    }
} 