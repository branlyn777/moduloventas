<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrdenCompraController extends Component
{
    public $sucursal_id,
    $estado,
    $fecha,
    $fromDate,
    $toDate;
    public function render()
    {
        return view('livewire.compras.orden-compra')
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
