<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia',
    ];

    public function clientes() {
        return $this->belongsToMany(Cliente::class, 'cliente_visita', 'visita_id', 'cliente_id');
    }
}
