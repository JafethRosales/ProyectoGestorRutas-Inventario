<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hora_inicio',
        'hora_termino',
        'venta_total',
        'credito_recuperado',
        'credito_generado',
        'total_liquidar',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function clientes() {
        return $this->belongsToMany(Cliente::class, 'cliente_ruta', 'ruta_id', 'cliente_id')
            ->withPivot('descripcion');
    }
}
