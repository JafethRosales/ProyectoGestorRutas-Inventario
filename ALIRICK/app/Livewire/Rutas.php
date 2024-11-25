<?php

namespace App\Livewire;

use App\Models\Ruta;
use Livewire\Component;
use Livewire\WithPagination;

class Rutas extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.historial.rutas', [
            'rutas' => Ruta::with(['user', 'clientes'])
                          ->latest()
                          ->paginate(10)
        ]);
    }
}
