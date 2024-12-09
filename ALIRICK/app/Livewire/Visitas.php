<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\Inventario;
use App\Models\inventario_vehiculo;
use App\Models\Orden;
use App\Models\orden_producto;
use App\Models\Pago;
use App\Models\Ruta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Visitas extends Component
{
    public $search = '';
    public $items = []; // List of items being added to the sale
    public $inventario = []; // Search results for items
    public $clientes;
    public $rutaAbierta;
    public $ruta;
    public $sobrante = [];
    public $rules;
    public $pagos;
    public $monto;
    public $creditos;
    public $clienteName;
    public $incidencia;
    public $descripcion;
    public $ventas;
    public $atributosTabla = [
        'Nombre',
        'Domicilio',
        'Crédito',
        'Abrir Orden',
        'Hacer Pago',
        'Compra a Crédto',
        'Sin Ventas',
        'Visitado',
    ];




    public function getClientes(){
        $dia = Carbon::now()->dayOfWeekIso + 5; //CAMBIAR SUMA
        $clientes = DB::table('semanal')->where('visita_id',$dia)->get();
        foreach($clientes as $cliente){
            $cliente->visitado = DB::table('cliente_ruta')->where('cliente_id', $cliente->cliente_id)->where('ruta_id', $this->ruta->id)->exists();
        }
        return $clientes;       
    }

    public function mount(){
        if ($this->validandoRuta()){
            $this->ruta = DB::table('rutas')->where('hora_termino', null)->first();
            $this->clientes = $this->getClientes();
            $this->rutaAbierta = true;
        }
    }

    public function validandoVisita($id){
        $valida = $this->clientes->firstWhere('cliente_id', $id);
        return DB::table('cliente_ruta')->where('cliente_id', $valida->cliente_id)->where('ruta_id', $this->ruta->id)->exists();
    }

    public function validandoInventario(){
        return inventario_vehiculo::exists();
    }

    public function validandoRuta(){
        return DB::table('rutas')->where('hora_termino', null)->exists();
    }

    public function abrirRuta(){
        if($this->validandoInventario() && !$this->ruta){  
            $this->ruta = Ruta::create([
                'user_id' => 1,
                'hora_inicio' => Carbon::now()->toTimeString()
            ]);  
            $this->clientes = $this->getClientes();
            $this->rutaAbierta = true;
        } else {
            session()->flash('error', 'No se ha cargado el inventario!');
        }
    }

    public function cerrarRuta(){
        if($this->validandoRuta()){
            foreach($this->clientes as $visita){
                if (!$visita->visitado){
                    session()->flash('error', 'Aún hay clientes por visitar!');
                    return;
                }
            }
            $this->sobrante = DB::table('inventario_vehiculo')->get();
            foreach ($this->sobrante as $item){
                $inventario = Inventario::find($item->producto_id);
                $inventario->existencias += $item->existencias_vehiculo;
                $inventario->save();
                DB::table('inventario_vehiculo')->where('producto_id', $item->producto_id)->where('vehiculo_id', 1)->delete();
            }
            $ruta = Ruta::find($this->ruta->id);
            $ruta->update(['hora_termino' => Carbon::now()->toTimeString()]);
            $this->rutaAbierta = false;
            $this->clientes = null;
            $this->ruta = null;}
    }
   
  
    
   
    public function confirmPagos($id){
        $this->pagos = $id;
        $this->clienteName = Cliente::find($id)->name;
    }
    public function cancelPagos() {
        $this->pagos = null; // Reset the confirmation modal
        $this->monto = null;
        $this->clienteName = null;
        $this->clientes = $this->getClientes();
    }
    public function hacerPagos(){
        $this->rules = [
            'monto' => 'required|numeric|min:0.01',
        ];
        $this->validate();

        if(DB::table('pagos')->where('cliente_id', $this->pagos)->whereDate('created_at', Carbon::today())->exists()){
            session()->flash('error', 'Ya se realizó un pago en esta visita!');
            $this->reset(['monto', 'pagos', 'rules', 'clienteName']);
            return;
        }

        $credito = $this->clientes->firstWhere('cliente_id',$this->pagos)->credito;
        if($credito == 0){
            session()->flash('error', 'Este cliente no tiene adeudos!');
            $this->reset(['monto', 'pagos', 'rules', 'clienteName']);
            return;
        } else if ($this->monto > $credito) {
            session()->flash('error', 'El pago no puede ser mayor al crédito del cliente!');
            $this->reset(['monto', 'pagos', 'rules', 'clienteName']);
            return;
        }
        // Create the Pago object
        Pago::create([
            'monto' => $this->monto,
            'cliente_id' => $this->pagos,
        ]);
        
        DB::table('clientes')->where('id', $this->pagos)->decrement('credito', $this->monto);

        // Reset the form and display a success success
        $this->reset(['monto', 'pagos', 'rules', 'clienteName']);
        $this->clientes = $this->getClientes();
        session()->flash('success', 'Pago Realizado!');
    }



    public function confirmCredito($id){
        $this->creditos = $id;
    }
    public function cancelCredito() {
        $this->creditos = null; // Reset the confirmation modal
        $this->monto = null;
        $this->clientes = $this->getClientes();
    }
    public function hacerCredito(){
        $this->rules = [
            'monto' => 'required|numeric|min:0.01',
        ];
        $this->validate();

        if(DB::table('ordens')->where('cliente_id', $this->creditos)->whereDate('created_at', Carbon::today())->exists()){
            session()->flash('error', 'Ya se realizó un pago en esta visita!');
            $this->reset(['monto', 'pagos', 'rules', 'clienteName']);
            return;
        } else {
            session()->flash('error', 'No hay una orden reciente para este cliente!');
            return;
        }


        $credito = $this->clientes->firstWhere('cliente_id',$this->pagos)->credito;
        if($credito == 0){
            session()->flash('error', 'Este cliente no tiene adeudos!');
            $this->reset(['monto', 'pagos', 'rules', 'clienteName']);
            return;
        } else if ($this->monto > $credito) {
            session()->flash('error', 'El pago no puede ser mayor al crédito del cliente!');
            $this->reset(['monto', 'pagos', 'rules', 'clienteName']);
            return;
        }
        // Create the Pago object
        Pago::create([
            'monto' => $this->monto,
            'cliente_id' => $this->pagos,
        ]);
        
        DB::table('clientes')->decrement('credito', $this->monto);

        // Reset the form and display a success success
        $this->reset(['monto', 'pagos', 'rules', 'clienteName']);
        $this->clientes = $this->getClientes();
        session()->flash('success', 'Pago Realizado!');
    }





    







    public function confirmIncidencia($id){

        if ($this->validandoVisita($id)){
            $this->reset(['incidencia', 'descripcion', 'clienteName']);
            session()->flash('error', 'Este cliente ya fue visitado!');
            return;
        }
        $this->incidencia = $id;
        $this->clienteName = Cliente::find($id)->name;
    }
    public function cancelIncidencia() {
        $this->incidencia = null; // Reset the confirmation modal
        $this->descripcion = null;
        $this->clienteName = null;
        $this->clientes = $this->getClientes();
    }
    public function hacerIncidencia(){
        $sinVenta = $this->clientes->firstWhere('cliente_id', $this->incidencia);
        if ($sinVenta->visitado){
            $this->reset(['incidencia', 'descripcion', 'clienteName']);
            session()->flash('error', 'Este cliente ya fue visitado!');
            return;
        }
        DB::table('cliente_ruta')->insert([
            'cliente_id' => $this->incidencia,
            'ruta_id' => $this->ruta->id,
            'descripcion' => $this->descripcion
        ]);
        $this->reset(['incidencia', 'descripcion', 'clienteName']);
        $this->clientes = $this->getClientes();
        session()->flash('success', 'Incidencia Registrada!');
    }















    public function abrirVenta($id){
        $this->ventas = $id;
        // $cliente = Cliente::find($id);
        // $cliente->ordens()->create([
        //     'descuento' => 0
        // ]);
    }

    public function updatedSearch() {
        if ($this->search){
            // Search items dynamically from 'inventario'
            $this->inventario = DB::table('inventario_vehiculo')
                ->join('inventarios', 'producto_id', '=', 'inventarios.id')
                ->select('inventario_vehiculo.*', 'inventarios.nombre')
                ->where('nombre', 'ilike', '%' . $this->search . '%')
                ->where('existencias_vehiculo', '>', 0) // Only items with stock
                ->take(5)
                ->get();
            } else {$this->inventario = [];}
    }

    public function addItem($itemId)
    {
        foreach ($this->items as $existingItem) {
            if ($existingItem['producto_id'] == $itemId) {
                return;
            }
        }

        $item = DB::table('inventario_vehiculo')->where('producto_id', $itemId)->first();
        if ($item) {
            $name = Inventario::find($itemId)->nombre;
            $this->items[] = [
                'producto_id' => $item->producto_id,
                'nombre' => $name,
                'cantidad' => 1, // Default quantity
                'existencias_vehiculo' => $item->existencias_vehiculo,
            ];
        }
        // Clear the search input and results
        $this->search = '';
        $this->inventario = [];
    }

    public function updateQuantity($index, $quantity)
    {
        // Update the quantity for a specific item
        if ($quantity > 0 && $quantity <= $this->items[$index]['existencias_vehiculo']) {
            $this->items[$index]['cantidad'] = $quantity;
        } else {
            session()->flash('errorList', 'Invalid quantity for item: ' . $this->items[$index]['nombre']);
        }
    }

    public function removeItem($index)
    {
        // Remove an item from the sale list
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex the array
    }

    public function save()
    {
        // Validate stock before saving
        foreach ($this->items as $item) {
            $inventario = inventario_vehiculo::find($item['id']);
            if ($item['cantidad'] > $inventario->existencias_vehiculo) {
                session()->flash('error', 'Not enough stock for: ' . $item['nombre']);
                return;
            }
        }

        // Save the sale
        foreach ($this->items as $item) {
            orden_producto::create([
                'producto_id' => $item['id'],
                'cantidad' => $item['cantidad'],
            ]);

            // Update stock in inventario
            $inventario = inventario_vehiculo::find($item['id']);
            $inventario->existencias_vehiculo -= $item['cantidad'];
            $inventario->save();
        }

        // Clear the sale list and show a success success
        $this->items = [];
        session()->flash('success', 'Sale completed successfully!');
    }



    public function render()
    {
        return view('livewire.visitas');
    }
}
