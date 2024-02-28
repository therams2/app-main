<?php

namespace App\Http\Livewire\Adq;

use Livewire\Component;
use App\Models\adq\cat_articulos;
use App\Models\adq\cat_categorias;
use Livewire\WithPagination;
class ShowCatArticulos extends Component
{
    use WithPagination;
    // var de datos
    public $nombre;
    protected $paginationTheme = 'bootstrap';
    public $descripcion;
    public $cantidad;
    public $precio;
    public $code;
    public $costoIni;
    public $idunidadtipo        = 1;
    public $peso;
    // var de configuracion
    public $isEdit; 
    public $idArticulo;
    public $id_categoria        = 1 ;
    public $id_unidad_medida    = 0 ;
    public $isDisabled;
    public $isEneableItems = false;
    public $getCategorias = [];

    public $search; 
 
    public function render()
    {

        
        $articulos = cat_articulos::select(
                        'adq_cat_articulos.id',
                        'adq_cat_articulos.nombre',
                        'adq_cat_articulos.descripcion',
                        'adq_cat_articulos.cantidad',
                        'adq_cat_articulos.id_unidad_tipo as idunidadtipo',
                        'adq_cat_articulos.precio',
                        'adq_cat_articulos.code',
                        'adq_cat_articulos.peso',
                        'adq_cat_articulos.costo_ini',
                        'adq_cat_articulos.id_unidad_medida',
                        'acc.nombre as nombre_cat',
                        'acc.id as id_cat')
        ->leftjoin('adq_cat_categorias as acc', 'acc.id', '=', 'adq_cat_articulos.id')
        ->where('adq_cat_articulos.nombre','like', '%'        . $this->search . '%')
        ->orwhere('adq_cat_articulos.descripcion','like', '%' . $this->search . '%')
        ->orwhere('cantidad','like', '%'    . $this->search . '%')
        ->orwhere('precio','like', '%'      . $this->search . '%')
        ->orwhere('costo_ini','like', '%'   . $this->search . '%')
        ->orwhere('code','like', '%'        . $this->search . '%')
        ->orderByDesc('id') 
        ->paginate(15);
        $getCategorias = cat_categorias::select()->get();
        
        return view('livewire.adq.show-cat-articulos', compact('articulos' ));
    }
     
    public function updatedidunidadtipo()
    {
        if($this->idunidadtipo == 2){
            $this->isEneableItems = true;
            $this->cantidad             =   0;
            $this->precio               =   0;
           
        }else{
        $this->isEneableItems = false;
            $this->cantidad             =   null;
            $this->precio               =   null;
            $this->peso                 =   null;
            $this->costoIni             =   null;
        }
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
                'code'          => 'nullable',
                'nombre'        => 'required',
                'cantidad'      => 'required',
                'idunidadtipo'  => 'required',
                'precio'        => 'nullable', 
                'descripcion'   => 'nullable',
                'peso'          => 'nullable',
                'costoIni'      => 'nullable',
            ],
            [
               
                'nombre.required'           => '* Requerido',
                'cantidad.required'         => '* Requerido',
                'idunidadtipo.required'     => '* Requerido',
              
            ]
        ); 
       
        $arrayData['costo_ini']         =  $arrayData['costoIni'];
        $arrayData['id_categoria']      =  $this->id_categoria;
        $arrayData['id_unidad_medida']  =  $this->id_unidad_medida;
        $arrayData['id_unidad_tipo']    =  $this->idunidadtipo;
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

        $articulo = cat_articulos::select('nombre','descripcion','cantidad','peso','precio','code','costo_ini as costoIni', 'id_categoria','id_unidad_medida','id_unidad_tipo') 
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
        $this->idunidadtipo     =   $articulo->id_unidad_tipo;
        $this->peso             =   $articulo->peso;

        if($this->idunidadtipo == 2){
            $this->isEneableItems = true;}
            else{
            $this->isEneableItems = false;
        }
    }



    public function edit(){
        
        $arrayData = $this->validate(
            [
                'code'          => 'nullable',
                'nombre'        => 'required',
                'cantidad'      => 'required',
                'idunidadtipo'  => 'required',
                'precio'        => 'nullable',
                'descripcion'   => 'nullable',
                'peso'          => 'nullable',
                'costoIni'      => 'nullable',
            ],
            [
               
                'nombre.required'           => '* Requerido',
                'cantidad.required'         => '* Requerido',
                'idunidadtipo.required'     => '* Requerido',
            ]
        ); 
  
       
        $arrayData['costo_ini']         = $arrayData['costoIni']; 
        $arrayData['id_categoria']      =  $this->id_categoria;
        $arrayData['id_unidad_medida']  =  $this->id_unidad_medida;
        $arrayData['id_unidad_tipo']    =  $this->idunidadtipo;
        $articulo = cat_articulos::find($this->idArticulo);
        $articulo->update($arrayData);
    }
    
    public function view($id){
     
        $this->isDisabled = true;

        $articulo = cat_articulos::select('nombre','descripcion','cantidad','peso','precio','code','costo_ini as costoIni', 'id_categoria','id_unidad_medida','id_unidad_tipo') 
        ->where('id', '=', $id)
        ->first();
       
        $this->nombre           =   $articulo->nombre;
        $this->descripcion      =   $articulo->descripcion;
        $this->cantidad         =   $articulo->cantidad;
        $this->precio           =   $articulo->precio;
        $this->peso             =   $articulo->peso;
        $this->code             =   $articulo->code;
        $this->costoIni         =   $articulo->costoIni;
        $this->id_categoria     =   $articulo->id_categoria;
        $this->id_unidad_medida =   $articulo->id_unidad_medida;
        $this->idunidadtipo     =   $articulo->idunidadtipo;
    }

    public function assignId($id){
        $this->idArticulo = $id;
    }
    public function updateArrayItems(){
        $this->getCategorias = cat_categorias::all();
    }
    
    public function cleanFields(){
        $this->nombre               =    "";
        $this->descripcion          =    "";
        $this->cantidad             =    "";
        $this->precio               =    "";
        $this->peso                 =    null;
        $this->code                 =    "";
        $this->costoIni             =    null;
        $this->id_categoria         =    1;
        $this->id_unidad_medida     =    0;
        $this->idunidadtipo         =    1;
        $this->isEneableItems       =    false;


    }

    public function delete(){
        cat_articulos::where('id',$this->idArticulo)->delete();
    }

    
}
