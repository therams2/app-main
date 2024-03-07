<?php

namespace App\Http\Livewire\Adq;

use Livewire\Component;
use App\Models\adq\cat_articulos;
use App\Models\adq\cat_ingreso_inv;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowCatIngresoInv extends Component
{
    use LivewireAlert;
    public $idcatarticulos;
    public $concepto;
    public $code;
    public $cantidadnuevo;
    public $precionuevo;
    public $pesonuevo;
    public $costonuevo; // tanto para producto por cantidad y kilo
    public $preciokilonuevo;
    public $search;

    public $disableItems = false;

    public function render()
    {

       
        $ingresosInv = cat_ingreso_inv::select(
                    'adq_cat_ingreso_invs.id',
                    'adq_cat_ingreso_invs.cantidadnuevo',
                    'adq_cat_ingreso_invs.pesonuevo',
                    'adq_cat_ingreso_invs.estatus',
                    'adq_cat_ingreso_invs.costonuevo',
                    'adq_cat_ingreso_invs.preciokilonuevo',
                    'adq_cat_ingreso_invs.precionuevo',
                    'aca.nombre',
                    'aca.code',
                    'aca.descripcion',
                    )
        ->leftjoin('adq_cat_articulos as aca', 'aca.id', '=', 'adq_cat_ingreso_invs.idcatarticulos')
        ->where('aca.nombre','like', '%'        . $this->search . '%')
        ->orwhere('aca.descripcion','like', '%' . $this->search . '%')
        ->orwhere('aca.code','like', '%'        . $this->search . '%')
        ->orderByDesc('adq_cat_ingreso_invs.id') 
        ->get();
        
           
        return view('livewire.adq.show-cat-ingreso-inv', compact('ingresosInv' ));
    }

    public function save(){
        $arrayData = $this->validate(
            [
                'code'            => 'nullable',
                'cantidadnuevo'   => 'nullable',
                'precionuevo'     => 'nullable',
                'pesonuevo'       => 'nullable', 
                'costonuevo'      => 'nullable',
                'preciokilonuevo' => 'nullable'
            ],
            [
                'code.required'           => '* Requerido' 
            ]
        ); 
        $arrayData['estatus']                =  'PTE';
        $arrayData['idcatarticulos']         =  $this->idcatarticulos;
      
        cat_ingreso_inv::create($arrayData);

        //cat_articulos::create($arrayData);

        $this->cleanItems();
        $this->alert('success', 'Nuevo lote de articulos generado', [
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
                $this->disableItems     = false;
            }
            $this->idcatarticulos   = $articulo->id;
            $this->concepto         = $articulo->nombre.' '.$articulo->descripcion;
           
        }
    }
    public function onclickModal()
    {
        $this->cleanItems();
        $this->code         = null;
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
