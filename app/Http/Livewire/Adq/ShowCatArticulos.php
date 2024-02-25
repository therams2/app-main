<?php

namespace App\Http\Livewire\Adq;

use Livewire\Component;
use App\Models\adq\cat_articulos;
use App\Models\adq\cat_categorias;

class ShowCatArticulos extends Component
{
    // var de datos
    public $nombre;
    public $descripcion;
    public $cantidad;
    public $precio;
    public $code;
    public $costoIni;
    public $id_unidad_tipo;

    // var de configuracion
    public $isEdit; 
    public $idArticulo;
    public $id_categoria = -1;
    public $id_unidad_medida = -1;
    public $isDisabled;
    public $getCategorias = [];

    public $search; 
    public function render()
    {

        $articulos = cat_articulos::select() 
        ->where('nombre','like', '%'        . $this->search . '%')
        ->orwhere('descripcion','like', '%' . $this->search . '%')
        ->orwhere('cantidad','like', '%'    . $this->search . '%')
        ->orwhere('precio','like', '%'      . $this->search . '%')
        ->orwhere('costo_ini','like', '%'   . $this->search . '%')
        ->orwhere('code','like', '%'        . $this->search . '%')
        ->orderByDesc('id') 
        ->get(); 
        $getCategorias = cat_categorias::select()->get();
        
        return view('livewire.adq.show-cat-articulos', compact('articulos' ));
    }
    
 

    public function changeAction()
    {
        $this->cleanFields();
        $this->isEdit = false;
        $this->isDisabled = false;
        
    }

    public function save(){
        $arrayData = $this->validate(
            [
                'code'          => 'required',
                'nombre'        => 'required',
                'cantidad'      => 'required',
                'id_unidad_tipo'     => 'required',
                'precio'        => 'required',
                'descripcion'   => 'nullable',
            ],
            [
                'code.required'             => '* Requerido',
                'nombre.required'           => '* Requerido',
                'cantidad.required'         => '* Requerido',
                'id_unidad_tipo.required'        => '* Requerido',
                'precio.required'           => '* Requerido',
            ]
        ); 
       
       // $arrayData['costo_ini']         = $arrayData['costoIni']; 
        $arrayData['id_categoria']      =  $this->id_categoria;
        $arrayData['id_unidad_medida']  =  $this->id_unidad_medida;
       
      
        cat_articulos::create($arrayData);
        $this->cleanFields();
    }
    public function mount()
    { 
        $this->getCategorias = cat_categorias::all();
        
    }


    public function showEdit($id){
        $this->isEdit = true;
        $this->isDisabled = false;
        $this->idArticulo = $id;

        $articulo = cat_articulos::select('nombre','descripcion','cantidad','precio','code','costo_ini as costoIni', 'id_categoria','id_unidad_medida','id_unidad_tipo') 
        ->where('id', '=', $id)
        ->first();
       
        $this->nombre           =   $articulo->nombre;
        $this->descripcion      =   $articulo->descripcion;
        $this->cantidad         =   $articulo->cantidad;
        $this->precio           =   $articulo->precio;
        $this->code             =   $articulo->code;
        $this->costoIni         =   $articulo->costoIni;
        $this->id_categoria     =   $articulo->id_categoria;
        $this->id_unidad_medida =   $articulo->id_unidad_medida;
        $this->id_unidad_tipo        =   $articulo->id_unidad_tipo;
    }



    public function edit(){
        
        $arrayData = $this->validate(
            [
                'code'          => 'required',
                'nombre'        => 'required', 
                'cantidad'      => 'required',
                'id_unidad_tipo'     => 'required',
                'precio'        => 'required',
                'descripcion'   => 'nullable',
            ],
            [
                'code.required'             => '* Requerido',
                'nombre.required'           => '* Requerido',
                'cantidad.required'         => '* Requerido',
                'id_unidad_tipo.required'   => '* Requerido',
                'precio.required'           => '* Requerido',
            ]
        ); 
  
        //$arrayData['costo_ini']         =   $arrayData['costoIni']; 
        $arrayData['id_categoria']      =   $this->id_categoria; 
        $arrayData['id_unidad_medida']  =   $this->id_unidad_medida;      
       
        $articulo = cat_articulos::find($this->idArticulo);
        $articulo->update($arrayData);
    }
    
    public function view($id){
     
        $this->isDisabled = true;

        $articulo = cat_articulos::select('nombre','descripcion','cantidad','precio','code','costo_ini as costoIni', 'id_categoria','id_unidad_medida','id_unidad_tipo') 
        ->where('id', '=', $id)
        ->first();
       
        $this->nombre           =   $articulo->nombre;
        $this->descripcion      =   $articulo->descripcion;
        $this->cantidad         =   $articulo->cantidad;
        $this->precio           =   $articulo->precio;
        $this->code             =   $articulo->code;
        $this->costoIni         =   $articulo->costoIni;
        $this->id_categoria     =   $articulo->id_categoria;
        $this->id_unidad_medida      =   $articulo->id_unidad_medida;
        $this->id_unidad_tipo        =   $articulo->id_unidad_tipo;
    }

    public function assignId($id){
        $this->idArticulo = $id;
    }
    public function updateArrayItems(){
        $this->getCategorias = cat_categorias::all();
    }
    
    public function cleanFields(){
        $this->nombre               =   "";
        $this->descripcion          =   "";
        $this->cantidad             =   "";
        $this->precio               =   "";
        $this->code                 =   "";
        $this->costoIni             =   "";
        $this->id_categoria         =   -1;
        $this->id_unidad_medida     =   -1;
        $this->id_unidad_tipo            =   "1";
    }

    public function delete(){
        cat_articulos::where('id',$this->idArticulo)->delete();
    }

    
}
