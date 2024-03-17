<?php

namespace App\Http\Livewire\Egre;

use Livewire\Component;
use App\Models\adq\cat_articulos;
use App\Models\egre\egre_ventas;
use App\Models\ing\ingventasdet;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Carbon;
class ShowVentas extends Component
{
    
    use WithPagination;
  
    // var de datos
  
    protected $paginationTheme = 'bootstrap';
    use LivewireAlert;
    protected $listeners = ['changeCantidad1' => 'changeCantidad'];
    public $arrayDataCars = []; 
    public $generateid = 1; 
    public $additem ; 
    public $importe; 
    public $cambio = 0; 
    public $total = 0 ; 
    public  $isArtPeso = false;
    public  $searchResults = [];
    public $producto;
    public $precio_kilo = 0;
    public $peso ;
    public $efectivo  ;
    
    public function render()
    {  
        $hoy = Carbon::today()->toDateString();
        
        $ventas = egre_ventas::select(
                'id',
                'totalventa',
                'importe',
                'cambio',
                'estatus',
                'created_at'
                ) 
                ->where('estatus','<>','POS')
            ->orderByDesc('id') 
            ->take(5)
            ->get();

            $pospuestos = egre_ventas::select(
                'id',
                'totalventa',
                'importe',
                'cambio',
                'estatus',
                'created_at'
                ) 
            ->where('estatus','=','POS')
            ->whereDate('created_at', $hoy) // Filtrar por la fecha de hoy
            ->orderByDesc('id') 
            ->paginate(5);
 
        return view('livewire.egre.show-ventas', compact('ventas', 'pospuestos'));
    }
    public function updatedproducto()
    {
        if($this->producto != '') {
            // An array of SearchResults
            $this->searchResults =  cat_articulos::select(
                'adq_cat_articulos.id',
                DB::raw('UPPER(adq_cat_articulos.nombre) AS nombre'),
                DB::raw('UPPER(adq_cat_articulos.descripcion) AS descripcion'),
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
   
    public function cargarventa($id){
 
       $ventas =  ingventasdet::select(
            'id',
            'idcatarticulos',
            'idcar',
            'idcatventas',
            'idunidadtipo',
            'idunidadmedida',
            'concepto',
            'code',
            'cantidad',
            'precio' )
            ->where('idcatventas','=', $id ) 
            ->orderByDesc('idcar') 
            ->get();

            $this->arrayDataCars = [];
 
            foreach ($ventas as $venta) { 
                $this-> generateid = $venta->idcar;

                if($venta->idunidadtipo == 2){
                    $nuevaColeccion = collect([ 
                        'nombre'        =>  $venta->concepto,
                        'code'          =>  $venta->code,
                        'descripcion'   =>  "",
                        'precio'        =>  $venta->precio,  
                        'cantidad'      =>  $venta->cantidad,  
                        'id'            =>  $venta->idcatarticulos,  
                        'idcar'         =>  $venta->idcar,
                        'idunidadtipo'  =>  $venta->idunidadtipo,
                        'subtotal'      =>  $venta->precio,
                        'idunidadmedida' => $venta->idunidadmedida
                        ]); 
                }else{
                    $nuevaColeccion = collect([ 
                        'nombre'        =>  $venta->concepto,
                        'code'          =>  $venta->code,
                        'descripcion'   =>  "",
                        'precio'        =>  $venta->precio,  
                        'cantidad'      =>  intval($venta->cantidad),  
                        'id'            =>  $venta->idcatarticulos,   //id producto
                        'idcar'         =>  $venta->idcar,
                        'idunidadtipo'  =>  $venta->idunidadtipo,
                        'subtotal'      =>  round($venta->cantidad * $venta->precio,2),
                        'idunidadmedida' => $venta->idunidadmedida
                        ]);
                       
                }
                $this->alert('success', 'Venta Cargada' , [
                    'position' => 'top-end',
                    'timer' => 8000,
                    'toast' => true,
                    'showConfirmButton' => false,
                    'onConfirmed' => '',
                   ]);
                   
               
               egre_ventas::where('id',$id)->delete();
               ingventasdet::where('idcatventas',$id)->delete();
               
                $this->arrayDataCars[] = $nuevaColeccion;
                $this-> generateid++;
                $this->calcularTotal();
            } 
    }
    public function posponer( ){
        if(count($this->arrayDataCars) == 0){
            return;
            }
        try {
            DB::beginTransaction(); 
               $egreVenta = new egre_ventas(); 
               $egreVenta->totalventa  =  $this->total; 
               $egreVenta->importe     =  0; 
               $egreVenta->cambio      =  0;  
               $egreVenta->estatus     = 'POS';  
               $egreVenta->save();
               // Obtener el ID con el que se generó
               $idGenerado = $egreVenta->id; 
               foreach ($this->arrayDataCars as $indice => $arrayDataCar){
                        $egreVenta = new ingventasdet();

                        
                        $egreVenta->idcar           = $this->arrayDataCars[$indice]["idcar"] ;
                        $egreVenta->idcatventas     = $idGenerado ;
                        $egreVenta->idcatarticulos  = $this->arrayDataCars[$indice]["id"] ;
                        $egreVenta->idunidadtipo    = $this->arrayDataCars[$indice]["idunidadtipo"] ;
                        $egreVenta->idunidadmedida  = $this->arrayDataCars[$indice]["idunidadmedida"] ;
                        $egreVenta->concepto        = $this->arrayDataCars[$indice]["nombre"].'/'.$this->arrayDataCars[$indice]["descripcion"];
                        $egreVenta->code            = $this->arrayDataCars[$indice]["code"] ; 
                        $egreVenta->cantidad        = $this->arrayDataCars[$indice]["cantidad"];
                        $egreVenta->precio          = $this->arrayDataCars[$indice]["precio"] ;
                        $egreVenta->save();
                }  
               $this->limpiarTodo();
               
              
                DB::commit();
                $this->alert('success', 'Venta Pospuesta', [
                    'position' => 'top-end',
                    'timer' => 9000,
                    'toast' => true,
                    'showConfirmButton' => false,
                    'onConfirmed' => '',
                   ]);
                $this->emit('f5'); 
                } catch (\Exception $e) {
                // En caso de error, realizar un rollback
                DB::rollBack();
                $this->alert('success', 'Existe un problema al posponer la venta' , [
                    'position' => 'top-end',
                    'timer' => 15000,
                    'toast' => true,
                    'showConfirmButton' => false,
                    'onConfirmed' => '',
                   ]);
            }
    }   
    
    public function changePeso(){

        if(!$this->peso > 0){
            $this->alert('warning', 'Introduce una cantidad en gramos', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
               ]);
               return;
        }
       
        
        $this->isArtPeso  = true;
        $this->addItemCar(); 
    }   
    public function addItemCar(){    
       // $articulo = DB::select('SELECT  nombre, code, descripcion,precio,id, '.\DB::raw( ($this->generateid  + 1 ).' as idcar')  .' FROM adq_cat_articulos WHERE code = ?', [$this->additem]); 
       
       $articulo = cat_articulos::select( 'nombre', 'code', 'descripcion', 'precio','id','id_unidad_tipo','precio_kilo','id_unidad_medida' )->where('code', $this->additem)->where('code','<>', '000001')->first();
       
       if( $articulo ){
       
            if(!$this->isArtPeso){    
                if($articulo->id_unidad_tipo == 2  ){ // activar cuando es por peso
                    
                $this->isArtPeso = true;
                $this->precio_kilo = $articulo->precio_kilo;
            
                $this->emit('mostrarModal'); 
                return;
                }
            }
        

            $this->emit('ocultarModal'); 
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
                    $this->peso = null;
                    $this->efectivo = null;
                    $this->calcularTotal();
                } else{ 
                $this->arrayDataCars[] = $nuevaColeccion;
                $this->generateid++;
                $this->additem = "";
                $this->peso = null;
                $this->efectivo = null;
                $this->calcularTotal();
                }
                $this->isArtPeso =false;    // Cambiar a falso?
        }else{
            $this->alert('info', 'Articulo no registrado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
               ]);
        }
       
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
        if(count($this->arrayDataCars) == 0){
            return;
            }
        try {
        DB::beginTransaction();
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
        
       
           $egreVenta = new egre_ventas(); 
           $egreVenta->totalventa  =  $this->total; 
           $egreVenta->importe     =  $this->importe; 
           $egreVenta->cambio      =  $this->cambio;  
           $egreVenta->estatus     = 'REAL';  
           $egreVenta->save();
           // Obtener el ID con el que se generó
           $idGenerado = $egreVenta->id; 
           foreach ($this->arrayDataCars as $indice => $arrayDataCar){
                    $egreVenta = new ingventasdet(); 
                    $egreVenta->idcar           = $this->arrayDataCars[$indice]["idcar"] ;
                    $egreVenta->idcatventas     = $idGenerado ;
                    $egreVenta->idcatarticulos  = $this->arrayDataCars[$indice]["id"] ;
                    $egreVenta->idunidadtipo    = $this->arrayDataCars[$indice]["idunidadtipo"] ;
                    $egreVenta->idunidadmedida  = $this->arrayDataCars[$indice]["idunidadmedida"] ;
                    $egreVenta->concepto        = $this->arrayDataCars[$indice]["nombre"].'/'.$this->arrayDataCars[$indice]["descripcion"];
                    $egreVenta->code            = $this->arrayDataCars[$indice]["code"] ;   
                    $egreVenta->cantidad        = $this->arrayDataCars[$indice]["idunidadtipo"] == 2 ? ($this->arrayDataCars[$indice]["cantidad"]/1000) : $this->arrayDataCars[$indice]["cantidad"];//convermios gramos a kilos  
                    $egreVenta->precio          = $this->arrayDataCars[$indice]["precio"] ;
                    

                    $articulo = cat_articulos::find($this->arrayDataCars[$indice]["id"] );
                    if($this->arrayDataCars[$indice]["idunidadtipo"] != 2 ){
                        $articulo->cantidad     =  $articulo->cantidad -  $this->arrayDataCars[$indice]["cantidad"]; 
                    }else{
                        $articulo->peso =  $articulo->peso -($this->arrayDataCars[$indice]["cantidad"]/1000); 
                    }
                        $egreVenta->save();
                        $articulo->save();
            }  
           $this->limpiarTodo();
          
            DB::commit();
            $this->alert('success', 'Venta Realizada <br> El cambio es:  $'.$this->cambio, [
                'position' => 'top-end',
                'timer' => 9000,
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
               ]);
            } catch (\Exception $e) {
            // En caso de error, realizar un rollback
            DB::rollBack();
            $this->alert('success', 'Existe un problema al realizar la venta:  $'.$this->cambio, [
                'position' => 'top-end',
                'timer' => 15000,
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
               ]);
            // Manejar el error como sea necesario
        }
    }
    public function limpiarTodo(){
        $this->arrayDataCars = []; 
        $this->generateid   = 1; 
        $this->additem      = ""; 
        $this->importe  =   null; 
        $this->peso     =   null;
        $this->efectivo =   null;
        $this->total    =   0 ; 
    }

    public function changeImporte($importe){
        $this->importe = $importe;
   }

    public function inputMoney(){
        $this->emit('mostrarModal2'); 
       
   }
   public function inputMoneyToCar(){
    if(!$this->efectivo > 0){
        $this->alert('warning', 'Introduce la cantidad del efectivo', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
           ]);
           return;
    }
    $this->emit('ocultarModal2');
        // Modifica cantidad   


        $nuevaColeccion = collect([ 
            'nombre'        =>  "OTROS",
            'code'          =>  "000001",
            'descripcion'   =>  "INGRESO DE EFECTIVO",
            'precio'        =>  $this->efectivo,
            'cantidad'      =>  1,  
            'id'            =>  1350,  
            'idcar'         =>  $this->generateid,
            'idunidadtipo'  =>  null,
            'subtotal'      =>  $this->efectivo,
            'idunidadmedida' => null
        ]);
      
           $this->arrayDataCars[] = $nuevaColeccion; 
           $this-> generateid++;
           $this->efectivo = null;

        $this->alert('success', 'Se ingreso efectivo al carrito de compras' , [
            'position' => 'top-end',
            'timer' => 8000,
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
           ]);
           $this->calcularTotal();
    }
    public function upItem($id){
        foreach ($this->arrayDataCars as $indice => $arrayDataCar){
            if($arrayDataCar["idcar"] == $id){
                $this->arrayDataCars[$indice]["cantidad"] = $arrayDataCar["cantidad"] + 1; 
                $this->arrayDataCars[$indice]["subtotal"] =  round(($this->arrayDataCars[$indice]["cantidad"] *  $this->arrayDataCars[$indice]["precio"]),2);    
                $this->calcularTotal(); 
            }
        }
       
   }
   public function downItem($id){
    foreach ($this->arrayDataCars as $indice => $arrayDataCar){
        if($arrayDataCar["idcar"] == $id){
            if( $this->arrayDataCars[$indice]["cantidad"] > 1 && $this->arrayDataCars[$indice]["idunidadtipo"] != 2){
                $this->arrayDataCars[$indice]["cantidad"] = $arrayDataCar["cantidad"] - 1; 
                $this->arrayDataCars[$indice]["subtotal"] =  round(($this->arrayDataCars[$indice]["cantidad"] *  $this->arrayDataCars[$indice]["precio"]),2);
                $this->calcularTotal(); 
            } 
        }
    }
       
   }
   
} 