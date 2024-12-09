<?php

namespace App\Livewire;

use App\Models\Inventario;
use App\Models\inventario_vehiculo;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cargamentos extends Component
{
    public $search = ''; // For item search
    public $items = [];  // Selected items for the transfer
    public $inventarios = []; // Search results
    public $mostrarConfirmacion;

    public function mount(){
        $this->validacion();
    }
    public function validacion(){
        if(DB::table('rutas')->where('hora_termino', null)->exists()){
            $this->mostrarConfirmacion = true;
        }
    }
    public function cerrarValidacion($bool){
        $this->mostrarConfirmacion = $bool;
    }

    public function updatedSearch()
    {   
        if ($this->search){
            $this->inventarios = Inventario::where('nombre', 'ilike', '%' . $this->search . '%')
                ->where('existencias', '>', 0) // Only show items with stock
                ->take(5) // Limit results
                ->get();} else {$this->inventarios = [];}
    }

    // Add an item to the transfer list
    public function addItem($itemId)
    {
        foreach ($this->items as $existingItem) {
            if ($existingItem['id'] == $itemId) {
                return;
            }
        }

        $item = Inventario::find($itemId);
        $this->items[] = [
            'id' => $item->id,
            'nombre' => $item->nombre,
            'cantidad' => 1, // Default quantity
            'existencias' => $item->existencias,
        ];
        // Clear the search input and results
        $this->search = '';
        $this->inventarios = [];
    }

    // Update the quantity of a specific item
    public function updateQuantity($index, $quantity)
    {
        if ($quantity > 0 && $quantity <= $this->items[$index]['existencias']) {
            $this->items[$index]['cantidad'] = $quantity;
        } else {
            session()->flash('error', 'No hay suficientes existencias de: ' . $this->items[$index]['nombre']);
            $this->removeItem($index);
        }
    }

    // Remove an item from the transfer list
    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex the array
    }

    // Save the items to the `inventario_vehiculo` table
    public function save() {   
        foreach ($this->items as $item) {
            // Validate stock before saving
            $inventario = Inventario::find($item['id']);
            if ($item['cantidad'] > $inventario->existencias) {
                session()->flash('error', 'No hay suficientes unidades de: ' . $item['nombre']);
                return;
            }

            if (DB::table('inventario_vehiculo')->where('producto_id', $item['id'])->where('vehiculo_id', 1)->exists()){
                DB::table('inventario_vehiculo')->where('producto_id', $item['id'])->where('vehiculo_id', 1)->increment('existencias_vehiculo', $item['cantidad']);
            } else {
                // Save to `inventario_vehiculo`
                inventario_vehiculo::create([
                    'producto_id' => $item['id'],
                    'existencias_vehiculo' => $item['cantidad'],
                    'vehiculo_id' => 1,
                ]);
            }

            // Update stock in `inventarios`
            $inventario->existencias -= $item['cantidad'];
            $inventario->save();
        }

        if(empty($this->items)){
            session()->flash('error', 'No agregó ningún elemento al vehículo!');
            return;
        } 
        // Clear the list and display success message
        $this->items = [];
        session()->flash('success', 'Vehículo cargado con éxito!');
    }









    public function render()
    {
        return view('livewire.cargamentos');
    }
}
