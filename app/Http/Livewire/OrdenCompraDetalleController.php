<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrdenCompraDetalleController extends Component
{
    public $fecha;
    public function render()
    {
        return view('livewire.compras.orden-compra-detalle')
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
