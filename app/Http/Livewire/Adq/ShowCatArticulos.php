<?php

namespace App\Http\Livewire\Adq;

use Livewire\Component;
use App\Models\adq\cat_articulos;
use App\Models\adq\cat_categorias;
use App\Models\adq\cat_indices_categorias;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowCatArticulos extends Component
{
    use WithPagination;
    use LivewireAlert;
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
    public $precio_kilo;
    public $generacode = false;
    // var de configuracion
    public $isEdit; 
    public $idArticulo;
    public $id_categoria;
    public $id_unidad_medida    = null ;
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
            $this->precio_kilo          =   0;
        }else{
        $this->isEneableItems = false;
            $this->cantidad             =   null;
            $this->precio               =   null;
            $this->peso                 =   null;
            $this->costoIni             =   null;
            $this->precio_kilo          =   null;
            $this->id_unidad_medida     =   null;
            
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
                'precio_kilo'   => 'nullable'
            ],
            [
               
                'nombre.required'           => '* Requerido',
                'cantidad.required'         => '* Requerido',
                'idunidadtipo.required'     => '* Requerido',
              
            ]
        ); 
        //valida que la cat sea siempre la clave 1
        if(!$this->id_categoria)
            $this->id_categoria = cat_categorias::where('clave', 1 )->value('id'); // Arreglar esto a estatico

        $arrayData['costo_ini']         =  $arrayData['costoIni'];
        $arrayData['id_categoria']      =  $this->id_categoria;
        $arrayData['id_unidad_medida']  =  $this->id_unidad_medida;
        $arrayData['id_unidad_tipo']    =  $this->idunidadtipo;

        if($this->generacode){

            $clave = cat_categorias::where('id', $this->id_categoria)->value('clave');
            
            $indice = "INDEX".$clave;
             
            $index = cat_indices_categorias::pluck( $indice)->first();

            if( $index ){
                $arrayData['code']    =   str_pad($clave, 3, "0", STR_PAD_LEFT)."".(str_pad(($index + 1), 3, "0", STR_PAD_LEFT));

                $firtsRow =  cat_indices_categorias::first();
                $firtsRow->update([ $indice => $index + 1 ]);
            }else{
                // si es nulo es el primer registro
                $arrayData['code']    =   str_pad($clave, 3, "0", STR_PAD_LEFT)."".(str_pad((1), 3, "0", STR_PAD_LEFT));


                $firtsRow =   cat_indices_categorias::first();
                $firtsRow->update([ $indice => 1]);
            }
        }

       
        cat_articulos::create($arrayData);

        $this->cleanFields();
        $this->alert('success', 'Articulo agregado correctamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
           ]);

    }
    public function mount()
    { 
        $this->getCategorias = cat_categorias::all();
        
    }


    public function showEdit($id){
        $this->generacode           =    false;
        $this->isEdit = true;
        $this->isDisabled = false;
        $this->idArticulo = $id;

        $articulo = cat_articulos::select('nombre','descripcion','cantidad','peso','precio','code','costo_ini as costoIni', 'id_categoria','id_unidad_medida','id_unidad_tipo','precio_kilo') 
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
        $this->precio_kilo      =   $articulo->precio_kilo;

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
                'precio_kilo'   => 'nullable'
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

        if($this->generacode){
            $count = cat_articulos::where('id_categoria', $this->id_categoria)->count();
            $clave = cat_categorias::where('id', $this->id_categoria)->value('clave');
            
            $arrayData['code']    =   str_pad($clave, 3, "0", STR_PAD_LEFT)."".(str_pad(($count + 1), 3, "0", STR_PAD_LEFT));
        }

             if($this->generacode){
            
            $clave = cat_categorias::where('id', $this->id_categoria)->value('clave');
            
            $indice = "INDEX".$clave;
             
            $index = cat_indices_categorias::pluck( $indice)->first();

            if( $index ){
                $arrayData['code']    =   str_pad($clave, 3, "0", STR_PAD_LEFT)."".(str_pad(($index + 1), 3, "0", STR_PAD_LEFT));

                $firtsRow =  cat_indices_categorias::first();
                $firtsRow->update([ $indice => $index + 1 ]);
            }else{
                // si es nulo es el primer registro
                $arrayData['code']    =   str_pad($clave, 3, "0", STR_PAD_LEFT)."".(str_pad((1), 3, "0", STR_PAD_LEFT));


                $firtsRow =   cat_indices_categorias::first();
                $firtsRow->update([ $indice => 1]);
            }
        }
        $articulo = cat_articulos::find($this->idArticulo);
        $articulo->update($arrayData);
        
        $this->alert('success', 'Articulo actualizado correctamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
           ]);
    }
    
    public function view($id){
     
        $this->isDisabled = true;

        $articulo = cat_articulos::select('nombre','descripcion','cantidad','peso','precio','code','costo_ini as costoIni', 'id_categoria','id_unidad_medida','id_unidad_tipo','precio_kilo') 
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
        $this->precio_kilo      =   $articulo->precio_kilo;
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
        $this->id_categoria;
        $this->id_unidad_medida     =    null;
        $this->idunidadtipo         =    1;
        $this->isEneableItems       =    false;
        $this->generacode           =    false;
        $this->precio_kilo           =   null;


    }

    public function delete(){
        cat_articulos::where('id',$this->idArticulo)->delete();
    }

    
}
