<?php

namespace App\Http\Livewire\Clasificadores;

use App\Models\Cat_funcionarios;
use Livewire\Component;
use Livewire\WithFileUploads;

class Funcionario extends Component
{
    use WithFileUploads;

    //  Campos del Funcionario
    public $idfuncionario;
    public $estatusFuncionario = [
        'indice'    => [0, 1, 2, 3, 4, 5 ] , 
        'nombre'    => ['','ROTACION', 'BAJA', 'EN ESPERA', 'EN FUNCION','CANCELADO'],
        'css'       => ['','badge bg-label-info me-1',  'badge bg-label-danger me-1', 'badge bg-label-warning me-1','badge bg-label-success me-1', 'badge bg-label-primary me-1'] 
    ];
    public $search;
    public $nombre;
    public $apellidos;
    public $email;
    public $telefono;
    public $direccion;
    public $foto = "img/without_image_profile.png"; //  Por default le asignara una imagen 
    public $estatus = 0;

    //  Campos del Nombramiento


    public $nombredependencia;
    public $nombrearea;
    public $categoria;
    public $sueldoneto;
    public $fechaentrada;
    public $funcionariop;
    public $profesion;
    public $nivelacademico;
    public $gradoacademico;
    public $experencia;
    public $observaciones;





    public function render()
    {

        $funcionarios = Cat_funcionarios::select(
            'cat_funcionarios.id',
            'cat_funcionarios.nombre',
            'cat_funcionarios.telefono',
            'cat_funcionarios.apellidos',
            'cat_funcionarios.estatus',
            'cat_funcionarios.activo',

            'areas.id as idArea',
            'areas.nombre as nombreArea',
            'dependencia.nombre as nombreDependencia',
            'areas.iddependencia as iddependenciaArea'
            )
            ->leftjoin('cat_organigramas  as areas', 'areas.idfuncionario', 'cat_funcionarios.id')
            ->leftjoin('cat_organigramas  as dependencia', 'dependencia.id', 'areas.iddependencia')
            ->where('cat_funcionarios.activo', 1)
            ->where('cat_funcionarios.nombre', 'like', '%' . $this->search . '%')
            ->get();
         
           
       
        return view('livewire.clasificadores.funcionario', compact('funcionarios'));
    }

    public function updatedPhoto()
    {
        $this->validate([
            'foto' => 'image|max:1024',
        ]);
    }
    public function save()
    {
       
        $cuentaArray = $this->validate(
            [
                'nombre'        => 'required',
                'apellidos'     => 'required',
                'email'         => 'required',
                'telefono'      => 'required',
                'direccion'     => 'required',
                'funcionariop'  => 'required',
                
            ],
            [
                'nombre.required'    => '* Requerido',
                'apellidos.required' => '* Requerido',
                'email.required'     => '* Requerido',
                'telefono.required'  => '* Requerido',
                'direccion.required' => '* Requerido',
                'funcionariop.required' => '* Requerido'
            ]
        );
        $cuentaArray['estatus'] = 3; 
 
        Cat_funcionarios::create($cuentaArray);
    }
    public function showdetail($id){


        //  Traer los datos del usuario

        $detalles = Cat_funcionarios::select(
            'cat_funcionarios.nombre',
            'cat_funcionarios.telefono',
            'cat_funcionarios.apellidos',
            'cat_funcionarios.email',
            'cat_funcionarios.direccion',
            'cat_funcionarios.estatus',

            'areas.id as idArea',
            'areas.nombre as nombreArea',
            'dependencia.nombre as nombreDependencia',
            'areas.iddependencia as iddependenciaArea',

            'nombramientos.profesion        as profesion',
            'nombramientos.categoria        as categoria',
            'nombramientos.observaciones    as observaciones',
            'nombramientos.sueldoneto       as sueldoneto',
            'nombramientos.fecha_alta       as fecha_alta',
            'cat_funcionarios.funcionariop    as funcionariop',
            'nombramientos.nivelacademico     as nivelacademico',
            'nombramientos.gradoacademico     as gradoacademico',
            'nombramientos.profesion     as profesion',
            'nombramientos.experencia     as experencia',
            'nombramientos.observaciones     as observaciones'
            )



            ->leftjoin('cat_nombramientos as nombramientos', 'nombramientos.idfuncionarioe', 'cat_funcionarios.id')

            ->leftjoin('cat_organigramas  as areas', 'areas.id', 'nombramientos.idorganigrama')  //obtener area mediante el nombramiento
            
            ->leftjoin('cat_organigramas  as dependencia', 'dependencia.id', 'areas.iddependencia')

            ->where('cat_funcionarios.id', '=', $id)
            ->first();  //  Crear tabla auxiliar para identificar el nombramiento vigente


           
            $this->nombre            =  $detalles->nombre;
            $this->apellidos         =  $detalles->apellidos;
            $this->email             =  $detalles->email;
            $this->telefono          =  $detalles->telefono;
            $this->direccion         =  $detalles->direccion;
            $this->estatus           =  $detalles->estatus;
            $this->nombredependencia =  $detalles->nombreDependencia;
            $this->nombrearea        =  $detalles->nombreArea;
            $this->categoria         =  $detalles->categoria;
            $this->sueldoneto        =  $detalles->sueldoneto;
            $this->fechaentrada      =  $detalles->fecha_alta;
            $this->funcionariop      =  $detalles->funcionariop;
            $this->nivelacademico    =  $detalles->nivelacademico;
            $this->gradoacademico    =  $detalles->gradoacademico;
            $this->profesion         =  $detalles->profesion;
            $this->experencia        =  $detalles->experencia;
            $this->observaciones     =  $detalles->observaciones;
        //  LLenar las variables
       
    }
    public function showedit($id){


        //  Traer los datos del usuario

        $detalles = Cat_funcionarios::select(
            'cat_funcionarios.nombre',
            'cat_funcionarios.telefono',
            'cat_funcionarios.apellidos',
            'cat_funcionarios.email',
            'cat_funcionarios.direccion',
            'cat_funcionarios.estatus',
            'cat_funcionarios.funcionariop',

            'areas.id as idArea',
            'areas.nombre as nombreArea',
            'dependencia.nombre as nombreDependencia',
            'areas.iddependencia as iddependenciaArea',

            'nombramientos.profesion        as profesion',
            'nombramientos.categoria        as categoria',
            'nombramientos.observaciones    as observaciones',
            'nombramientos.sueldoneto       as sueldoneto',
            'nombramientos.fecha_alta       as fecha_alta',
            'cat_funcionarios.funcionariop     as funcionariop',
            'nombramientos.nivelacademico     as nivelacademico',
            'nombramientos.gradoacademico     as gradoacademico',
            'nombramientos.profesion     as profesion',
            'nombramientos.experencia     as experencia',
            'nombramientos.observaciones     as observaciones'
            )
            ->leftjoin('cat_organigramas  as areas', 'areas.idfuncionario', 'cat_funcionarios.id')
            ->leftjoin('cat_organigramas  as dependencia', 'dependencia.id', 'areas.iddependencia')
            ->leftjoin('cat_nombramientos as nombramientos', 'nombramientos.idfuncionarioe', 'cat_funcionarios.id')
            ->where('cat_funcionarios.id', '=', $id)
            ->first();
            $this->idfuncionario     =  $id;
            $this->nombre            =  $detalles->nombre;
            $this->apellidos         =  $detalles->apellidos;
            $this->email             =  $detalles->email;
            $this->telefono          =  $detalles->telefono;
            $this->direccion         =  $detalles->direccion;
            $this->funcionariop      =  $detalles->funcionariop;
       }
       public function updateFuncionario(){

        $cuentaArray = $this->validate(
            [
                'nombre'        => 'required',
                'apellidos'     => 'required',
                'email'         => 'required',
                'telefono'      => 'required',
                'direccion'     => 'required',
                'funcionariop'  => 'required',
                
            ],
            [
                'nombre.required'    => '* Requerido',
                'apellidos.required' => '* Requerido',
                'email.required'     => '* Requerido',
                'telefono.required'  => '* Requerido',
                'direccion.required' => '* Requerido',
                'funcionariop.required' => '* Requerido'
            ]
        );

            $funcionario = Cat_funcionarios::find($this->idfuncionario);
           
            $funcionario->update($cuentaArray);
       }

       public function suspender(){
        //  validar que el usuario no tenga un nombramiento vigente
        Cat_funcionarios::where('id',  $this->idfuncionario)->update(array('activo' =>0));
       
       }
       public function asignarFuncionarioId($id){
            $this->idfuncionario     =  $id;
       }


}
