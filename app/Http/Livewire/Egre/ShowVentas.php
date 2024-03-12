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
    public  $isArtPeso = false;
    public  $searchResults = [];
    public $producto;
    public $precio_kilo = 0;
    public $peso = 0;
    public function render()
    { 
        return view('livewire.egre.show-ventas');
    }
    public function updatedproducto()
    {
        if($this->producto != '') {
            // An array of SearchResults
            $this->searchResults =  cat_articulos::select(
                'adq_cat_articulos.id',
                'adq_cat_articulos.nombre',
                'adq_cat_articulos.descripcion',
                'adq_cat_articulos.code' )
            ->where('adq_cat_articulos.nombre','like', '%'        . $this->producto . '%')
            ->orwhere('adq_cat_articulos.descripcion','like', '%' . $this->producto . '%')
            ->orwhere('code','like', '%'        . $this->producto . '%')
            ->orderByDesc('id') 
            ->get();
            
        } else {
            $this->searchResults = [];
        }
    }

    public function delete($id ){
        foreach ($this->arrayDataCars as $indice => $arrayDataCar){
            if($arrayDataCar["idcar"] == $id){
                unset($this->arrayDataCars[$indice]);
                $this->calcularTotal();
          
                $this->alert('success', 'Eliminado correctamente', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'showConfirmButton' => false,
                    'onConfirmed' => '',
                   ]);
            }
        }
    }  



    public function changePeso(){
        $this->isArtPeso  = true;
        $this->addItemCar(); 
    }   
    public function addItemCar(){    
       // $articulo = DB::select('SELECT  nombre, code, descripcion,precio,id, '.\DB::raw( ($this->generateid  + 1 ).' as idcar')  .' FROM adq_cat_articulos WHERE code = ?', [$this->additem]); 
        
      

       $articulo = cat_articulos::select( 'nombre', 'code', 'descripcion', 'precio','id','id_unidad_tipo','precio_kilo','id_unidad_medida' )->where('code', $this->additem)->first();

       if( $articulo ){
        if(!$this->isArtPeso){    
            if($articulo->id_unidad_tipo == 2  ){ // activar cuando es por peso
            $this->isArtPeso = true;
            $this->precio_kilo = $articulo->precio_kilo;
            $this->emit('mostrarModal'); 
            return;
            }
        }

       $this->cambio  = 0;
       $this->producto  = "";
        
         
        

        if($articulo->id_unidad_tipo == 2  ){ 
            $nuevaColeccion = collect([ 
                'nombre'        =>  $articulo->nombre,
                'code'          =>  $articulo->code,
                'descripcion'   =>  $articulo->descripcion,
                'precio'        =>  round($this->precio_kilo * ($this->peso / 1000),2),
                'cantidad'      =>  $this->peso,  
                'id'            =>  $articulo->id,  
                'idcar'         =>  $this->generateid,
                'idunidadtipo'  =>  $articulo->id_unidad_tipo,  //dirige todo
                'subtotal'      =>  round($this->precio_kilo * ($this->peso / 1000),2),
                'idunidadmedida' => $articulo->id_unidad_medida
        ]);
        }else{
            
            // Modifica cantidad
            foreach ($this->arrayDataCars as $indice => $arrayDataCar){
                if($arrayDataCar["code"] == $this->additem){
                    // Existe solo modificamos cantidad + 1
                    $this->arrayDataCars[$indice]["cantidad"] = $arrayDataCar["cantidad"] + 1;

                    $this->arrayDataCars[$indice]["subtotal"] =  round(($this->arrayDataCars[$indice]["cantidad"] *  $this->arrayDataCars[$indice]["precio"]),2);
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
                'idcar'         =>  $this->generateid,
                'idunidadtipo'  =>  $articulo->id_unidad_tipo,
                'subtotal'      =>  round($articulo->precio,2),
                'idunidadmedida' => $articulo->id_unidad_medida
        ]);
        }
            if(count($this->arrayDataCars) == 0){
                $this->arrayDataCars[] = $nuevaColeccion;
                $this->generateid++;
                $this->additem = "";
                $this->peso = 0;
                $this->calcularTotal();
              } else{ 
               $this->arrayDataCars[] = $nuevaColeccion;
               $this->generateid++;
               $this->additem = "";
               $this->peso = 0;
               $this->calcularTotal();
            }
        }
        $this->isArtPeso =false;
    }
    public function calcularTotal()
    {
        $this->total = 0;
        if (count($this->arrayDataCars) > 0) {
            foreach ($this->arrayDataCars as $indice => $arrayDataCar) {
                $this->total = round($this->total + $this->arrayDataCars[$indice]["subtotal"], 2);
            }
        } else {
            $this->total = 0;
        }
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
        $this->alert('success', 'Venta Realizada Correctamente <br> El cambio es:  $'.$this->cambio, [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
           ]);
           $this->limpiarTodo();
    }
    public function limpiarTodo(){
         $this->arrayDataCars = []; 
         $this->generateid = 1; 
         $this->additem = ""; 
         $this->importe = 0; 
        // $this->cambio  = 0; 
         $this->total   = 0 ; 
        
    }
} 