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
    public $dataItemSelected;
    public $idItemSelected;
    public $idUnidadMedida;
    public $labelUnidadMedida = "";

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
                    'aca.id_unidad_medida',
                    'aca.code',
                    'aca.descripcion',
                    'aca.id as idarticulo'
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
    public function aprobado(){
        
         
            // Encuentra el modelo CatArticulo por su ID
            $catArticulo = cat_articulos::findOrFail($this->dataItemSelected["idarticulo"]);

            // Actualiza el campo cantidad con el valor recibido

            if($catArticulo->id_unidad_tipo == 2){
                $catArticulo->precio_kilo   =   $this->dataItemSelected["preciokilonuevo"];
                $catArticulo->costo_ini     =   $catArticulo->costo_ini     +  $this->dataItemSelected["costonuevo"];
                $catArticulo->peso          =   $catArticulo->peso          +  $this->dataItemSelected["pesonuevo"];

            }else{
                $catArticulo->cantidad      = $catArticulo->cantidad        +  $this->dataItemSelected["cantidadnuevo"];
                $catArticulo->precio        = $this->dataItemSelected["precionuevo"];
            }
           
            $catArticulo->save();

            $catInv = cat_ingreso_inv::findOrFail($this->dataItemSelected["id"]);
            $catInv->estatus = "APB";
            $catInv->save();

            $this->alert('success', 'Tu inventario ha sido actualizado correctamente.', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
               ]);
    }

    public function loadSelectedItem($data){
         
        $this->dataItemSelected = $data;
    }
    public function updatedcode(){
        $this->cleanItems();
        $articulo = cat_articulos::where('code', $this->code)->first();
    
        if($articulo){
            if($articulo->id_unidad_tipo == 2 ){
                $this->disableItems = true;
             
                $this->preciokilonuevo  = $articulo->precio_kilo;
                $this->concepto         = $articulo->nombre.' '.$articulo->descripcion.'' .($articulo->id_unidad_medida == 1 ? "KG":"GR");
                $this->labelUnidadMedida      =  ($articulo->id_unidad_medida == 1 ? "EN KG":"EN GR");

            }else{
                $this->labelUnidadMedida      = "";

                $this->precionuevo      = $articulo->precio;
                $this->disableItems     = false;
                $this->concepto         = $articulo->nombre.' '.$articulo->descripcion;

            }
            $this->idcatarticulos   = $articulo->id;
           
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
    public function itemSelected($id){
        $this->idItemSelected = $id;
    }
    public function cancelar(){
        
        $catInv = cat_ingreso_inv::findOrFail($this->idItemSelected);
        $catInv->estatus = "CAN";
        $catInv->save();
        $this->alert('success', 'Lote de articulos cancelado', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
           ]);

    }

}
