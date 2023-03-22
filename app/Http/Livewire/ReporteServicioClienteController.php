<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReporteServicioClienteController extends Component
{
    public function render()
    {
        return view('livewire.reporte_service.reporte-servicio-cliente')
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
