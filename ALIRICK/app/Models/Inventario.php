<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventario extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'existencias',
        'flete',
        'precio_compra',
        'suma',
        'porcentaje_incremento',
        'porcentaje_utilidad',
        'precio_base',
    ];
    
    public function ordens() {
        return $this->belongsToMany(Orden::class, 'orden_producto', 'producto_id', 'orden_id')
            ->withTimestamps()
            ->withPivot('cantidad', 'descuento', 'monto')
            ->using(orden_producto::class);
    }

    public function vehiculos() {
        return $this->belongsToMany(Vehiculo::class, 'inventario_vehiculo', 'producto_id', 'vehiculo_id')
            ->withTimestamps()
            ->withPivot('existencias_vehiculo')
            ->using(inventario_vehiculo::class);
    }

}
