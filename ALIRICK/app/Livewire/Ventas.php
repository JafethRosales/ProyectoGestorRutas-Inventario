<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Ventas extends Component
{
    public $atributosTabla = [
        'Producto',
        'Precio Base',
        'Unidades',
        'Total',
        'Fecha'
    ];

    public $ventas;

    
    public function getVentas() {
        $ventas = DB::table('lista_ventas')->get();
        return $ventas;
    }

    

  

    public function mount() {
        $this->ventas = $this->getVentas();
    }





    public function render()
    {
        return view('livewire.ventas');
    }
}
