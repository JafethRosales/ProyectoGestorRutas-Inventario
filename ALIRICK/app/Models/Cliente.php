<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo',
        'name',
        'calle_numero',
        'colonia',
        'codigo_postal',
        'credito',
        'limite_credito',
    ];

    public function pagos() {
        return $this->hasMany(Pago::class);
    }
    
    public function ordens() {
        return $this->hasMany(Orden::class);
    }

    public function visitas() {
        return $this->belongsToMany(Visita::class, 'cliente_visita', 'cliente_id', 'visita_id');
    }
    
    public function rutas() {
        return $this->belongsToMany(Ruta::class, 'cliente_ruta', 'cliente_id', 'ruta_id')
            ->withPivot('descripcion');
    }
    
    
}
