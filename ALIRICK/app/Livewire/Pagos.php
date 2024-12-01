<?php

namespace App\Livewire;

use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pagos extends Component
{
    public $atributosTabla = [
        'Cliente',
        'Crédito Pendiente',
        'Monto del Pago',
        'Fecha'
    ];

    public $pagos;
    public $todos = true;

    public function getPagos() {
        $pagos = DB::table('historial_pagos')->whereNull('deleted_at')->get();
        foreach ($pagos as $pago) {
            // Format the 'created_at' date to a more readable format
            $pago->formatDate = Carbon::parse($pago->created_at)->toFormattedDateString();
        }
        return $pagos;
    }

    public function onlyCreditos(){
        $pagos = DB::table('historial_pagos')->where('credito', ">", 0.00)->get();
        foreach ($pagos as $pago) {
            // Format the 'created_at' date to a more readable format
            $pago->formatDate = Carbon::parse($pago->created_at)->toFormattedDateString();
        }
        $this->pagos = $pagos;
        $this->todos = false;
    }

    public function allCredit(){
        $this->todos = true;
        $this->pagos = $this->getPagos();
    }

    public function mount() {
        $this->pagos = $this->getPagos();
    }

    

    public function render()
    {
        return view('livewire.pagos');
    }
}
