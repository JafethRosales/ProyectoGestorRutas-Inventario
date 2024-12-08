<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class inventario_vehiculo extends Pivot
{
    use HasFactory;

    protected $fillable = ['producto_id', 'vehiculo_id', 'existencias_vehiculo'];
}
