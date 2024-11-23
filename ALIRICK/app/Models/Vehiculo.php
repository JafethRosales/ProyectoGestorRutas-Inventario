<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'modelo',
    ];

    public function productos() {
        return $this->belongsToMany(Inventario::class, 'inventario_vehiculo', 'vehiculo_id', 'producto_id')
            ->withTimestamps()
            ->withPivot('existencias_vehiculo')
            ->using(inventario_vehiculo::class);
    }
    
}
