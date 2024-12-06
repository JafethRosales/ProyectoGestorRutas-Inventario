<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Rutas extends Component
{
    public $atributosTabla = [
        'Fecha',
        'Hora Inicio',
        'Hora Término',
        'Venta Total',
        'Crédito Recuperado',
        'Crédito Generado',
        'Descuentos',
        'Total a Liquidar',
        'Lista de Clientes'
    ];

    public $rutas;

    
    public function getRutas() {
        $rutas = DB::table('lista_rutas')->get();
        foreach ($rutas as $ruta ) {
            $ruta->formatDate = Carbon::parse($ruta->fecha)->toFormattedDayDateString();
        }
        return $rutas;
    }

    public function mount() {
        $this->rutas = $this->getRutas();
    }

    public function render()
    {
        return view('livewire.rutas');
    }
}
