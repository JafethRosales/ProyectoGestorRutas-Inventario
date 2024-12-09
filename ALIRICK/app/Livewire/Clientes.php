<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\Visita;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class Clientes extends Component
{
    public $atributosTabla = [
        'Nombre',
        'Domicilio',
        'Crédito',
        'Límite',
        'Código',
        'Creado',
        'Créditos',
        'Visitas',
        'Editar',
        'Eliminar',
    ];

    public $visitas;
    public $items = [];
    public $selectedDays = []; // Array to store selected day IDs
    public $search; 
    
    
    public $clientes;
    public $todos = true;
   
    public $delete = null;
    public $deleteName;
    
    public $editar = null;
    public $miCliente;
    public $codigo;
    public $name;
    public $calle_numero;
    public $colonia;
    public $codigo_postal;
    
    public $limite;
    public $limite_credito;


    
    public function onlyCreditos(){
        $pagos = Cliente::all()->where('credito', ">", 0.00);
        foreach ($pagos as $pago) {
            // Format the 'created_at' date to a more readable format
            $pago->formatDate = Carbon::parse($pago->created_at)->toFormattedDateString();
        }
        $this->clientes = $pagos;
        $this->todos = false;
    }
    public function allCredit(){
        $this->todos = true;
        $this->clientes = $this->getClientes();
    }

    
    public function clear() {
        $this->miCliente = null;
        $this->codigo = null;
        $this->name = null;
        $this->calle_numero = null;
        $this->colonia = null;
        $this->codigo_postal = null;
    }

    public function getClientes() {
        $listaClientes = Cliente::all();

        foreach ($listaClientes as $cliente) {
            // Format the 'created_at' date to a more readable format
            $cliente->formatDate = Carbon::parse($cliente->created_at)->toFormattedDateString();
        }

        return $listaClientes;
    }
    public function mount() {
        $this->clientes = $this->getClientes();
    }

    public function confirmDelete($id)
    {
        $this->delete = $id;
        $this->deleteName = Cliente::find($this->delete)->name;
    }
    public function cancelDelete()
    {
        $this->delete = null; // Reset the confirmation modal
        $this->deleteName = null;

        $this->clientes = $this->getClientes();
    }
    public function deleteCliente() {
        if ($this->delete){
            // Find and delete the item
            $cliente = Cliente::find($this->delete);
            
            if ($cliente) {
                $cliente->delete();
                $this->clientes = $this->getClientes(); // Refresh the items list after deletion
            }
        }
        $this->delete = null;
        $this->deleteName = null;
    }


    public function confirmEditar($id) {
        $this->editar = $id;
    }
    public function cancelEditar() {
        $this->editar = null; // Reset the confirmation modal
        $this->clear();
        $this->clientes = $this->getClientes();
    }
    public function editarCliente() {
        if ($this->editar === true) {
            Cliente::updateOrCreate(['id' => $this->editar],
            [
                'name' => $this->name,
                'codigo' => $this->codigo,
                'calle_numero' => $this->calle_numero,
                'colonia' => $this->colonia,
                'codigo_postal' => $this->codigo_postal,
             ]);
        } else {      
            $this->miCliente = Cliente::find($this->editar);
            $data = collect([
                'name' => $this->name,
                'codigo' => $this->codigo,
                'calle_numero' => $this->calle_numero,
                'colonia' => $this->colonia,
                'codigo_postal' => $this->codigo_postal,
                ])->filter(function ($value) {
                return !is_null($value);
            })->toArray();
            $this->miCliente->update($data);
        }
         $this->clear();
         $this->editar = null;
         $this->clientes = $this->getClientes();
    }

    public function confirmLimite($id) {
        $this->limite = $id;
        $this->deleteName = Cliente::find($this->limite)->name;
    }
    public function cancelLimite() {
        $this->limite = null; // Reset the confirmation modal
        $this->deleteName = null;
        $this->limite_credito = null;
        $this->clientes = $this->getClientes();
    }
    public function modificarLimite() {
        if ($this->limite) {
            $limiteCliente = Cliente::find($this->limite);
            $limiteCliente->limite_credito = $this->limite_credito;
            $limiteCliente->save();
        }
        $this->limite = null; // Reset the confirmation modal
        $this->deleteName = null;
        $this->limite_credito = null;
        $this->clientes = $this->getClientes();
    }
    
    
    public function confirmVisits($id){
        $this->visitas = $id;
    }
    public function cancelVisits() {
        $this->visitas = null; // Reset the confirmation modal
        $this->search = null;
        $this->items = [];
        $this->clientes = $this->getClientes();
    }
    public function updatedSearch() {
        if ($this->search){
            $this->selectedDays = DB::table('visitas')
                ->where('dia', 'ilike', '%' . $this->search . '%')
                ->take(2) // Limit results
                ->get();} else {$this->selectedDays = [];}

    }
    public function addItem($itemId)
    {
        foreach ($this->items as $existingItem) {
            if ($existingItem['id'] == $itemId) {
                return;
            }
        }

        $item = DB::table('visitas')->where('id', $itemId)->first();
        if ($item) {
            $this->items[] = [
                'id' => $item->id,
                'dia' => $item->dia,
            ];
        }
        // Clear the search input and results
        $this->search = '';
        $this->selectedDays = [];
    }
    public function removeItem($index)
    {
        // Remove an item from the sale list
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex the array
    }
    public function saveVisits()
    {
        // Validate that at least one day is selected
        $this->validate([
            'items' => 'required|array|min:1',
        ]);

        // Insert records into the pivot table
        foreach ($this->items as $dayId) {
            DB::table('cliente_visita')->updateOrInsert(
                ['cliente_id' => $this->visitas, 'visita_id' => $dayId['id']],
            );
        }
        $this->reset(['visitas', 'items', 'selectedDays', 'search']);
        session()->flash('success', 'Días de visita asignados!');
        $this->clientes = $this->getClientes();
    }




    public function render()
    {
        return view('livewire.clientes');
    }

}
