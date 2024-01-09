<?php

namespace App\Http\Livewire\Clasificadores;

use App\Models\Cat_funcionarios;
use App\Models\Cat_nombramientos;
use App\Models\cat_organigramas;
use App\Models\Funcionario;
use Livewire\Component;

class Nombramientos extends Component
{
    //  Variables de los nombramientos
    public $search = "";
    public $searchFE = "";
    public $searchFS = "";
    public $records         = [];
    public $funcionariosE   = [];
    public $funcionariosS   = [];
    public $nombre;
    public $fecha_alta;
    public $estatusfs;
    public $estatusfe;
    public $sueldoneto;
    public $profesion;
    public $isReceptoria = true;
    public $gradoacademico;
    public $nivelacademico;
    public $documents;
    public $observaciones;
    public $fecha_baja;
    public $folio;
    public $experencia;
    public $categoria;
    public $idmunicipio;
    public $iddependencia;
    public $idorganigrama;


    //  Variables de los funcionarios
    public $nombrefuncionarioSaliente; 
    public $nombrefuncionarioE = "INTRODUCE UN NOMBRE";
    
    public $idfuncionarios;
    public $idfuncionarioe;

    public function save()
    {
        $cuentaArray = $this->validate(
            [
             
                'iddependencia'         => 'required',
                'fecha_baja'            => 'required',
                'estatusfs'             => 'required',
                'fecha_alta'            => 'required',
                'estatusfe'             => 'required',
                'categoria'             => 'required',
                'sueldoneto'            => 'required',
                'nivelacademico'        => 'required',
                'gradoacademico'        => 'required',
                'profesion'             => 'required',
                'experencia'            => 'required',
                'observaciones'         => 'required',     
                'idorganigrama'         => 'required',
                'idfuncionarios'        => 'required',
                'idfuncionarioe'        => 'required',
            ],
            [
             
                'iddependencia.required'        => '* Requerido',
                'fecha_baja.required'           => '* Requerido',
                'estatusfs.required'            => '* Requerido',
                'fecha_alta.required'           => '* Requerido',
                'estatusfe.required'            => '* Requerido',
                'categoria.required'            => '* Requerido',
                'sueldoneto.required'           => '* Requerido',
                'nivelacademico.required'       => '* Requerido',
                'gradoacademico.required'       => '* Requerido',
                'profesion.required'            => '* Requerido',
                'experencia.required'           => '* Requerido',
                'observaciones.required'        => '* Requerido',
                'idorganigrama.required' => '* Requerido',
                'idfuncionarios.required' => '* Requerido',
                'idfuncionarioe.required' => '* Requerido',
            ]
        );
 
        Cat_nombramientos::create($cuentaArray);
        //  Actualizar el jefe de departamento del Area
        cat_organigramas::where('id',$cuentaArray["idorganigrama"])->update(array('idfuncionario' =>  $cuentaArray["idfuncionarioe"]));

        //  Actualizar el estatus de los funcionarios saliente
        Cat_funcionarios::where('id',$cuentaArray["idfuncionarios"])->update(array('estatus' =>  $cuentaArray["estatusfs"]));


        //  Actualizar el estatus de los funcionarios entrante  
        Cat_funcionarios::where('id',$cuentaArray["idfuncionarioe"])->update(array('estatus' =>  $cuentaArray["estatusfe"]));
        $this->limpiarCampos();
    }


    public function searchResultFuncionario()
    {
        if (!empty($this->searchFE)) {

            $this->funcionariosE = Cat_funcionarios::orderBy('nombre', 'asc')
                ->select('*')
                ->where('nombre', 'like', '%' . $this->searchFE . '%')
                ->where('estatus', '=', '3')    // Debe de estar en espera el funcionario Entrante
                ->limit(5)
                ->get();
        }  
    }

    public function searchResultFuncionarioS()
    {
        if (!empty($this->searchFS)) {

            $this->funcionariosS = Cat_funcionarios::orderBy('nombre', 'asc')
                ->select('*')
                ->where('nombre', 'like', '%' . $this->searchFS . '%')
                ->limit(5)
                ->get();
        }  
    }

    public function searchResult()
    {
        if (!empty($this->search)) {

            $this->records = cat_organigramas::orderBy('nombre', 'asc')
                ->select('*')
                ->where('id', '!=', $this->iddependencia)
                ->where('iddependencia', '=', $this->iddependencia)
                ->where('nombre', 'like', '%' . $this->search . '%')
                ->where('estatus', '=', '1')
                ->limit(5)
                ->get();
        }  
    }
    public function asignarIdFuncionarioS($id, $nombre)
    {
        $this->searchFS = $nombre;
        $this->idfuncionarios = $id;
        $this->funcionariosS = [];
    }
    public function asignarIdFuncionarioE($id, $nombre)
    {
        $this->searchFE = $nombre;
        $this->idfuncionarioe = $id;
        $this->funcionariosE = [];
    }
    public function asignarIdArea($id, $nombre)
    {

        $this->search = $nombre;
        $this->idorganigrama = $id;
        $this->records = [];

        //  Buscar mediante id del area si cuenta con un titular 
        $getArea        = cat_organigramas::where('id', $id)->first();
        if($getArea->idfuncionario == 0){
            $this->nombrefuncionarioSaliente    = "SIN TITULAR ACTUALMENTE";
            $this->idfuncionarios        = 0;
        }else{
            $getFuncionario = Cat_funcionarios::where('id', $getArea->idfuncionario)->first();
            $this->nombrefuncionarioSaliente    = strtoupper($getFuncionario->nombre ." ".$getFuncionario->apellidos);
            $this->idfuncionarios        = $getFuncionario->id;
        }
       
    }
    public function updatediddependencia()
    {
        $this->search = "";
    }
    public function render()
    {
        return view('livewire.clasificadores.nombramientos');
    }
    public function limpiarCampos(){
        $this->search = "";
        $this->searchFE = "";
        $this->searchFS = "";
        $this->records         = [];
        $this->funcionariosE   = [];
        $this->funcionariosS   = [];
        $this->nombre= "";
        $this->fecha_alta= "";
        $this->estatusfs= "";
        $this->estatusfe= "";
        $this->sueldoneto= "";
        $this->profesion= "";
        $this->isReceptoria = true;
        $this->gradoacademico= "";
        $this->nivelacademico= "";
        $this->documents= "";
        $this->observaciones= "";
        $this->fecha_baja= "";
        $this->folio= "";
        $this->experencia= "";
        $this->categoria= "";
        $this->idmunicipio= "";
        $this->iddependencia= "";
        $this->idorganigrama= "";
    
    
        //  Variables de los funcionarios
        $this->nombrefuncionarioSaliente; 
        $this->nombrefuncionarioE = "INTRODUCE UN NOMBRE";
        
        $this->idfuncionarios= "";
        $this->idfuncionarioe= "";
    }
}