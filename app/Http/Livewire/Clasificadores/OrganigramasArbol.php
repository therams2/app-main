<?php

namespace App\Http\Livewire\Clasificadores;

use App\Models\cat_organigramas;
use Livewire\Component;

class OrganigramasArbol extends Component
{    
    
    public $nombre;
    public $idnivel;
    public $estatus;
    public $iddependencia;
    public $idparent;
    public $orden;
    public $nivel;
    public function render()
    {  

        $menus          = new cat_organigramas();
        $estructuras    = cat_organigramas::select()->where('estatus', 1)
        ->where('iddependencia', $this->iddependencia)
        ->orderby('idparent')
        ->orderby('orden')
        ->orderby('nombre') 
        ->get()
        ->toArray();

        $menuAll = [];
        foreach ( $estructuras as $line) {
            $item = [ array_merge($line, ['submenu' => $menus->getChildren($estructuras, $line) ]) ];
            $menuAll = array_merge($menuAll, $item);
        }
        $niveles =  $menuAll;
        return view('livewire.clasificadores.organigramas-arbol', compact('niveles'));
    }
    public function save()
    {
 
        $datainsert = $this->validate(
            [
                'nombre'        => 'required',
              
                'idparent'      => 'required',
            ],
            [
                'nombre.required'   => '* Requerido',
          
                'idparent.required' => '* Requerido',
            ]
        );
        //  Identificar si es nodo padre
        if($this->iddependencia == 0){
            $datainsert['iddependencia']   =  0;
        }else{
            $datainsert['iddependencia']   =  $this->iddependencia;
        }
 
        $datainsert['estatus'] = 1; 
        //  Recuperamos el ultimo orden de los hijos mediante el padre
        $lastOrder = cat_organigramas::where('idparent',  $this->idparent )->max('orden') ;
 
        if($lastOrder === null){
           
            $datainsert['orden']   =  0;    //  Entra la primera vez que haya un registro
            
        }else{
        
            $datainsert['orden']   =  $lastOrder + 1;
         

        }

        //  Recuperamos el ultimo nive mediante el padre
        $lastOrder = cat_organigramas::where('id',  $this->idparent )->max('nivel') ;
        if($lastOrder === null){
            $datainsert['nivel']   =  0;    //  Entra la primera vez que haya un registro
            
        }else{
            $datainsert['nivel']   =  $lastOrder + 1;

        }

        $data = cat_organigramas::create($datainsert);
        
        //  Actualizar si es nodo padre
        if($this->iddependencia == 0){
            cat_organigramas::where('id',  $data->id)->update(array('iddependencia' =>$data->id));
        }
        $this->dispatchBrowserEvent('alert',['type' => 'success', 'message' => 'El Nivel fue guardado correctamente!']);     
    }

    public function updatediddependencia($id)
    {
        $this->iddependencia = $id;
        $this->render();
    }
    public function asignarIdParent($id)
    {
        $this->cleanFields();
 
        $this->idparent = $id;
         
    }
    public function asignarIdParentFromNew($id)
    {
        $this->cleanFields();
 
        $this->idparent = $id;
        $this->iddependencia = null;
     
         
    }

    public function asignarIdNivel($id)
    {
        $this->idnivel = $id;
    }
    public function deactivate()
    {
        cat_organigramas::where('id', $this->idnivel)->update(array('estatus' => 0));
    }
    public function cleanFields()
    {
        $this->nombre   = "";
        $this->idparent = "";
    }
  
    
}
