<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orden extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'monto_total',
        'descuento'
    ];

    public function credito() {
        return $this->hasOne(Credito::class);
    }

    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function ventas() {
        return $this->belongsToMany(Inventario::class, 'orden_producto', 'orden_id', 'producto_id')
            ->withTimestamps()
            ->withPivot('cantidad', 'monto')
            ->using(orden_producto::class);
    }
}
