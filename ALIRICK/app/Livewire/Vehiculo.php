<?php

namespace App\Livewire;

use App\Models\Vehiculo as ModelsVehiculo;
use Carbon\Carbon;
use Livewire\Component;

class Vehiculo extends Component
{

    public $atributosTabla = [
        'Modelo',
        'Fecha Registro',
        'Editar',
        'Eliminar'
    ];
    
    
    public $vehiculos;
   
    public $delete = null;
    public $deleteName;
    
    public $editar = null;
    public $modelo;
    

    public function getAutos() {
        $lista = ModelsVehiculo::all();
        foreach ($lista as $auto) {
            // Format the 'created_at' date to a more readable format
            $auto->formatDate = Carbon::parse($auto->created_at)->toFormattedDateString();
        }
        return $lista;
    }

    public function mount() {
        $this->vehiculos = $this->getAutos();
    }

    public function confirmDelete($id)
    {
        $this->delete = $id;
        $this->deleteName = ModelsVehiculo::find($this->delete)->modelo;
    }
    public function cancelDelete()
    {
        $this->delete = null; // Reset the confirmation modal
        $this->deleteName = null;

        $this->vehiculos = $this->getAutos();
    }
    public function deleteProducto() {
        if ($this->delete){
            // Find and delete the item
            $auto = ModelsVehiculo::find($this->delete);
            
            if ($auto) {
                $auto->delete();
                $this->vehiculos = $this->getAutos(); // Refresh the items list after deletion
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
        $this->modelo = null;
        $this->vehiculos = $this->getAutos();
    }
    public function editarAuto() {
        if ($this->editar === true) {
            ModelsVehiculo::create(['modelo' => $this->modelo,]);
        } else {      
            $miVehiculo = ModelsVehiculo::find($this->editar);
            $miVehiculo->modelo = $this->modelo;
            $miVehiculo->save();
        }
         $this->modelo = null;
         $this->editar = null;
         $this->vehiculos = $this->getAutos();
    }  

    
    public function render() {
        return view('livewire.vehiculo');
    }
}
