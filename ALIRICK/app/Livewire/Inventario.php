<?php

namespace App\Livewire;

use App\Models\Inventario as ModelsInventario;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Inventario extends Component
{
    public $atributosTabla = [
        'Nombre',
        'Descripción',
        'Código',
        'Existencias',
        'Flete',
        'Precio de compra',
        'Suma',
        'Porcentaje',
        'Incremento',
        'Precio base',
        'Utilidad',
        'Editar',
        'Eliminar',
    ];
    
    
    public $inventario;
   
    public $delete = null;
    public $deleteName;
    
    public $editar = null;
    public $miProducto;
    public $codigo;
    public $nombre;
    public $descripcion;
    public $porcentaje_incremento;
    
    public $existencias;
    public $cargamento;
    
    public $precio;
    public $precio_compra;

    public $flete;
    public $unidades;
    public $total;

    
    public function clear() {
        $this->miProducto = null;
        $this->codigo = null;
        $this->nombre = null;
        $this->descripcion = null;
        $this->porcentaje_incremento = null;
    }

    public function getProductos() {
        $listaProductos = DB::table('lista_productos')->whereNull('deleted_at')->get();
        return $listaProductos;
    }

    public function mount() {
        $this->inventario = $this->getProductos();
    }

    public function confirmDelete($id)
    {
        $this->delete = $id;
        $this->deleteName = ModelsInventario::find($this->delete)->nombre;
    }
    public function cancelDelete()
    {
        $this->delete = null; // Reset the confirmation modal
        $this->deleteName = null;

        $this->inventario = $this->getProductos();
    }
    public function deleteProducto() {
        if ($this->delete){
            // Find and delete the item
            $producto = ModelsInventario::find($this->delete);
            
            if ($producto) {
                $producto->delete();
                $this->inventario = $this->getProductos(); // Refresh the items list after deletion
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
        $this->inventario = $this->getProductos();
    }
    public function editarCliente() {
        if ($this->editar === true) {
            ModelsInventario::updateOrCreate(['id' => $this->editar],
            [
                'nombre' => $this->nombre,
                'codigo' => $this->codigo,
                'descripcion' => $this->descripcion,
                'porcentaje_incremento' => $this->porcentaje_incremento,
             ]);
        } else {      
            $this->miProducto = ModelsInventario::find($this->editar);
            $data = collect([
                'nombre' => $this->nombre,
                'codigo' => $this->codigo,
                'descripcion' => $this->descripcion,
                'porcentaje_incremento' => $this->porcentaje_incremento,
                ])->filter(function ($value) {
                return !is_null($value);
            })->toArray();
            $this->miProducto->update($data);
        }
         $this->clear();
         $this->editar = null;
         $this->inventario = $this->getProductos();
    }

    public function confirmExistencias($id) {
        $this->existencias = $id;
        $this->deleteName = ModelsInventario::find($this->existencias)->nombre;
    }
    public function cancelExistencias() {
        $this->existencias = null; // Reset the confirmation modal
        $this->deleteName = null;
        $this->cargamento = null;
        $this->inventario = $this->getProductos();
    }
    public function modificarExistencias() {
        if ($this->existencias) {
            $cantidadActual = ModelsInventario::find($this->existencias);
            $cantidadActual->existencias += $this->cargamento;
            $cantidadActual->save();
        }
        $this->existencias = null; // Reset the confirmation modal
        $this->deleteName = null;
        $this->cargamento = null;
        $this->inventario = $this->getProductos();
    }

   
    public function confirmPrecio($id) {
        $this->precio = $id;
        $this->deleteName = ModelsInventario::find($this->precio)->nombre;
    }
    public function cancelPrecio() {
        $this->precio = null; // Reset the confirmation modal
        $this->precio_compra = null;
        $this->deleteName = null;
        $this->inventario = $this->getProductos();
    }
    public function modificarPrecio() {
        if ($this->precio) {
            $precioActual = ModelsInventario::find($this->precio);
            $precioActual->precio_compra = $this->precio_compra;
            $precioActual->save();
        }
        $this->precio = null; // Reset the confirmation modal
        $this->precio_compra = null;
        $this->deleteName = null;
        $this->inventario = $this->getProductos();
    }
    
    public function confirmFlete($id) {
        $this->flete = $id;
        $this->deleteName = ModelsInventario::find($this->flete)->nombre;
    }
    public function cancelFlete() {
        $this->flete = null; // Reset the confirmation modal
        $this->unidades = null;
        $this->total = null;
        $this->deleteName = null;
        $this->inventario = $this->getProductos();
    }
    public function modificarFlete() {
        if ($this->flete) {
            $fleteActual = ModelsInventario::find($this->flete);
            $fleteActual->flete = $this->total/$this->unidades;
            $fleteActual->save();
        }
        $this->flete = null; // Reset the confirmation modal
        $this->unidades = null;
        $this->total = null;
        $this->deleteName = null;
        $this->inventario = $this->getProductos();
    }
   






    public function render()
    {
        return view('livewire.inventario');
    }
}
