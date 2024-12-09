<?php

namespace App\Livewire;

use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RutaDetails extends Component
{
    public $atributosTabla = [
        'Fecha',
        'Cliente',
        'Descripción',
        'Lista de Productos'
    ];

    public $atributosLista = [
        'Producto',
        'Precio base',
        'Cantidad'
    ];

    public $lista;
    public $productos;
    public $nombre;

    public $clientes;



    public function getProductos($id) {
        $clientes = DB::table('cliente_ruta')->join('rutas', 'cliente_ruta.ruta_id', '=', 'rutas.id')
                    ->join('clientes', 'cliente_ruta.cliente_id', '=', 'clientes.id')
                    ->select('rutas.created_at', 'clientes.name', 'cliente_ruta.descripcion', 'clientes.id', 'rutas.created_at')
                    ->where('rutas.id', '=', $id)
                    ->get();
        foreach ($clientes as $cliente ) {
            $cliente->formatDate = Carbon::parse($cliente->created_at)->toFormattedDayDateString();
        }
        return $clientes;
    }

    public function verLista($id, $fecha) {
        $this->lista = $id;
        $this->nombre = Cliente::find($this->lista)->name;
        $date = Carbon::parse($fecha)->toDate();
        $prod = DB::table('historial_productos_ruta')->where('cliente_id', "=" , $id)->whereDate('fecha', '=', $date)->get();
        $this->productos = $prod;
    }
    public function cerrar() {
        $this->lista = null;
        $this->productos = null;
        $this->nombre = null;
    }




    public function mount($id) {
        $this->clientes = $this->getProductos($id);
    }

    public function render()
    {
        return view('livewire.ruta-details');
    }
}
