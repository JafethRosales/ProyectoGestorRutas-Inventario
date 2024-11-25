<?php

namespace App\Livewire;

use App\Models\Credito;
use Livewire\Component;
use Livewire\WithPagination;

class Creditos extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.historial.creditos', [
            'creditos' => Credito::with('orden')
                               ->latest()
                               ->paginate(10)
        ]);
    }
}
