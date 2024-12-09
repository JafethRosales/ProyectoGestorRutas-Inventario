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
    public $descuento;
    public $orden;
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
        if(DB::table('rutas')->whereDate('created_at', Carbon::today())->exists() && !$this->ruta){
            session()->flash('error', 'Vuelva Mañana!');
            return;
        }
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
        if(!DB::table('ordens')
            ->where('cliente_id', $id)
            ->whereDate('created_at', Carbon::today())
            ->exists()){
                session()->flash('error', 'Este cliente no hizo compras en esta visita!');
                $this->reset(['monto', 'creditos', 'rules']);
                return;
            }
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

        if(!$this->monto || $this->monto < 0.1){
            session()->flash('error', 'Ingrese una cantidad válida!');
            $this->reset(['monto', 'creditos', 'rules']);
            return;
        }

        if(!DB::table('ordens')
            ->where('cliente_id', $this->creditos)
            ->whereDate('created_at', Carbon::today())
            ->exists()){
                session()->flash('error', 'Este cliente no hizo compras en esta visita!');
                $this->reset(['monto', 'creditos', 'rules']);
                return;
            }

        if(DB::table('creditos')
            ->join('ordens', 'creditos.orden_id', '=', 'ordens.id')
            ->select('creditos.*', 'ordens.id', 'ordens.cliente_id')
            ->where('ordens.cliente_id', $this->creditos)
            ->whereDate('creditos.created_at', Carbon::today())->exists()){
            session()->flash('error', 'Ya se asignó un crédito en esta visita!');
            $this->reset(['monto', 'creditos', 'rules']);
            return;
        } 

        $ordenId = DB::table('ordens')->where('cliente_id', $this->creditos)->whereDate('created_at', Carbon::today())->first()->id;
        $orden = Orden::find($ordenId);
        $cliente = Cliente::find($this->creditos);
        $limite = $cliente->limite_credito;
        $actual = $cliente->credito;

        if ($this->monto + $actual > $limite){
            session()->flash('error', 'Se alcanzó el límite de crédito de este cliente!');
            $this->reset(['monto', 'creditos', 'rules']);
            return;
        }

        
        // Create the Pago object
        $orden->credito()->create([
            'credito' => $this->monto,
        ]);        
        DB::table('clientes')->where('id', $this->creditos)->increment('credito', $this->monto);

        // Reset the form and display a success success
        $this->reset(['monto', 'creditos', 'rules']);
        session()->flash('success', 'Crédito Guardado!');
        $this->clientes = $this->getClientes();
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
        if ($this->validandoVisita($id)){
            $this->reset(['items', 'ventas', 'descuento', 'orden']);
            session()->flash('error', 'Este cliente ya fue visitado!');
            return;
        }
        //validacion 
        $this->ventas = $id;
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
            session()->flash('errorList', 'No hay suficientes existencias de: ' . $this->items[$index]['nombre']);
            $this->removeItem($index);
        }
    }

    public function removeItem($index)
    {
        // Remove an item from the sale list
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex the array
    }

    public function cancelarCompra(){
        $this->items  = [];
        $this->ventas = null;
        $this->descuento = null;
        $this->orden = null;
    }

    public function save()
    {
        if (!$this->validandoVisita($this->ventas)){
            $cliente = Cliente::find($this->ventas);
            $this->orden = $cliente->ordens()->create([
                'descuento' => $this->descuento ?? 0,
            ]);
            DB::table('cliente_ruta')->insert([
                'cliente_id' => $this->ventas,
                'ruta_id' => $this->ruta->id,
                'descripcion' => 'Venta exitosa'
            ]);
        } else {
            $this->reset(['ventas', 'items', 'orden', 'descuento']);
            session()->flash('error', 'Este cliente ya fue visitado!');
            return;
        }
        //Crear cliente_ruta--->en save junto con orden


        if (empty($this->items)){
            session()->flash('errorList', 'Las ventas deben tener al menos un producto!');
            return;
        }
        // Validate stock before saving
        foreach ($this->items as $item) {
            $inventario = DB::table('inventario_vehiculo')->where('producto_id', $item['producto_id'])->first();
            if ($item['cantidad'] > $inventario->existencias_vehiculo) {
                session()->flash('errorList', 'No hay suficientes unidades de: ' . $item['nombre']);
                return;
            }
        }

        // Save the sale
        foreach ($this->items as $item) {
            DB::table('orden_producto')->insert([
                'orden_id' => $this->orden->id,
                'producto_id' => $item['producto_id'],
                'cantidad' => $item['cantidad'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Update stock in inventario
            DB::table('inventario_vehiculo')->where('producto_id', $item['producto_id'])->decrement('existencias_vehiculo', $item['cantidad']);
        }

        // Clear the sale list and show a success success
        $this->items = [];
        $this->ventas = null;
        $this->orden = null;
        $this->descuento = null;
        session()->flash('success', 'Venta Realizada!');
        $this->clientes = $this->getClientes();
    }





    public function render()
    {
        return view('livewire.visitas');
    }
}
