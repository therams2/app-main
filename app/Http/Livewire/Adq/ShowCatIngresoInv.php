<?php

namespace App\Http\Livewire\Adq;

use Livewire\Component;
use App\Models\adq\cat_articulos;
use App\Models\adq\cat_ingreso_inv;
class ShowCatIngresoInv extends Component
{
    public $concepto;
    public $code;
    public $cantidadnuevo;
    public $precionuevo;
    public $pesonuevo;
    public $costonuevo; // tanto para producto por cantidad y kilo
    public $preciokilonuevo;

    public $disableItems = false;

    public function render()
    {
        return view('livewire.adq.show-cat-ingreso-inv');
    }

    public function save(){
        $arrayData = $this->validate(
            [
                'code'           => 'nullable',
                'cantidadnuevo'  => 'nullable',
                'precionuevo'    => 'nullable',
                'pesonuevo'      => 'nullable', 
                'costonuevo'     => 'nullable',
                'costokilonuevo' => 'nullable'
            ],
            [
                'code.required'           => '* Requerido' 
            ]
        ); 
         
       
        cat_ingreso_inv::create($arrayData);

        //cat_articulos::create($arrayData);

        $this->cleanFields();
        $this->alert('success', 'Articulo agregado correctamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
           ]);

    }
    public function updatedcode(){
        $this->cleanItems();
        $articulo = cat_articulos::where('code', $this->code)->first();
    
        if($articulo){
            if($articulo->id_unidad_tipo == 2 ){
                $this->disableItems = true;
             
                $this->preciokilonuevo  = $articulo->precio_kilo;
            }else{
                $this->precionuevo      = $articulo->precio;
                $this->disableItems = false;
            }
    
            $this->concepto = $articulo->nombre.' '.$articulo->descripcion;
           
        }
    }

    public function cleanItems(){
            $this->concepto         = null;
            $this->cantidadnuevo    = 0;
            $this->precionuevo      = 0;
            $this->pesonuevo        = 0;
            $this->costonuevo       = 0;
            $this->preciokilonuevo  = 0;
    }

}
