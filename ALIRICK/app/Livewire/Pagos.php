<?php

namespace App\Livewire;

use App\Models\Pago;
use Livewire\Component;
use Livewire\WithPagination;

class Pagos extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.historial.pagos', [
            'pagos' => Pago::with('cliente')
                         ->latest()
                         ->paginate(10)
        ]);
    }
}
