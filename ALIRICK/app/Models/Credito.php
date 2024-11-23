<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credito extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'credito',
        'debito',
    ];

    public function orden(): BelongsTo {
        return $this->belongsTo(Orden::class, 'orden_id');
    }
}
