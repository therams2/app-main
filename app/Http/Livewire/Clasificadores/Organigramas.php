<?php

namespace App\Http\Livewire\Clasificadores;

use App\Models\cat_organigramas;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Organigramas extends Component
{ 
    protected $listeners = [ 'asignarIdParent' ,'asignarIdNivel'];
    public $nombre;
    public $idnivel;
    public $estatus;
    public $idparent;
    public $orden;
    public $nivel;

    public function render()
    {
        $niveles = cat_organigramas::select()->get();
        return view('livewire.clasificadores.organigramas', compact('niveles'));
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

        cat_organigramas::create($datainsert);
        $this->dispatchBrowserEvent('alert',['type' => 'success', 'message' => 'El Nivel fue guardado correctamente!']);     
    }


    public function asignarIdParent($id)
    {
       
        $this->idparent = $id;
         
    }

    public function asignarIdNivel($id)
    {
        $this->idnivel = $id;
    }
    public function deactivate()
    {
        cat_organigramas::where('id', $this->idnivel)->update(array('estatus' => 0));
    }
}
