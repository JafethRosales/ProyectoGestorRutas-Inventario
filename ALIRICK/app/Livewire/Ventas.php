<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use function Laravel\Prompts\select;

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
        $ventas = DB::table('lista_ventas')
                    ->select(DB::raw('producto, precio_base, sum(unidades) as unidades, sum(total) as total, fecha'))
                    ->groupBy('producto','precio_base','fecha')
                    ->orderBy('fecha','desc')
                    ->get();
        foreach ($ventas as $venta ) {
            $venta->formatDate = Carbon::parse($venta->fecha)->toFormattedDayDateString();
        }
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
