<?php

namespace App\Http\Livewire\Ing;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\egre\egre_ventas;
use App\Models\ing\ingventasdet;
use Livewire\WithPagination;

class ShowCatVentas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $idticket = 0;
    public $totalDia = 0;
    public $fecha ;  
    public $arrayData = [];
    public function render()
    {   
        if($this->fecha == Carbon::today()->toDateString() || $this->fecha == null){
            $this->fecha = Carbon::today()->toDateString();
        }
      
       // $hoy = Carbon::today()->toDateString();
        $this->totalDia = egre_ventas::whereDate('created_at', $this->fecha) ->where('estatus','<>','POS') ->sum('totalventa');
            $ventas = egre_ventas::select(
                'id',
                'totalventa',
                'importe',
                'cambio',
                'estatus',
                'created_at'
                ) 
                
                ->whereDate('created_at', $this->fecha) // Filtrar por la fecha de hoy
                ->orderByDesc('id')
                ->paginate(15);
        return view('livewire.ing.show-cat-ventas',compact('ventas'));
    }

    public function miMetodo($id){
        $this->idticket = $id;
        $ventas =  ingventasdet::select(
            'id',
            'idcatarticulos',
            'idcar',
            'idcatventas',
            'idunidadtipo',
            'idunidadmedida',
            'concepto',
            'code',
            'cantidad',
            'precio' )
            ->where('idcatventas','=', $id ) 
            ->orderByDesc('idcar') 
            ->get();
            
            $this->arrayData = $ventas;
            
        }
}
