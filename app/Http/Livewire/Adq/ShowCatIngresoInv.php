<?php

namespace App\Http\Livewire\Adq;

use Livewire\Component;

class ShowCatIngresoInv extends Component
{
    public $concepto;
    public $code;
    public $cantidadnuevo;
    public $precionuevo;
    public $pesonuevo;
    public $costonuevo;
    public $costokilonuevo;

    public function render()
    {
        return view('livewire.adq.show-cat-ingreso-inv');
    }
}
