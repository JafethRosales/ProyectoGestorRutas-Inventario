<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class orden_producto extends Pivot
{
    use HasFactory;

    protected $fillable = ['producto_id', 'orden_id', 'cantidad'];
}
