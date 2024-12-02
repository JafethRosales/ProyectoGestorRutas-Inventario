<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Creditos extends Component
{
    public $atributosTabla = [
        'Cliente',
        'Crédito',
        'Débito',
        'Total Compra',
        'Descuentos',
        'Fecha',
        'Productos'
    ];

    public $atributosLista = [
        'Producto',
        'Precio base',
        'Cantidad'
    ];

    public $lista;
    public $creditos;
    public $productos;

    public function getPagos() {
        $creditos = DB::table('historial_creditos')->whereNull('deleted_at')->get();
        foreach ($creditos as $credito) {
            // Format the 'created_at' date to a more readable format
            $credito->formatDate = Carbon::parse($credito->created_at)->toFormattedDateString();
        }
        return $creditos;
    }

    public function verLista($id) {
        $this->lista = $id;
        $prod = DB::table('historial_productos_creditos')->where('orden_id', "=" , $id)->get();
        $this->productos = $prod;
    }
    public function cerrar() {
        $this->lista = null;
        $this->productos = null;
    }


    public function mount() {
        $this->creditos = $this->getPagos();
    }



    public function render()
    {
        return view('livewire.creditos');
    }
}
