<?php

namespace App\Livewire;

use App\Models\Cliente;
use Carbon\Carbon;
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
        'Editar',
        'Eliminar',
    ];
    
    
    public $clientes;
   
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
            $cliente->created_format = Carbon::parse($cliente->created_at)->toFormattedDateString();
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
    
    




    public function render()
    {
        return view('livewire.clientes');
    }

}
