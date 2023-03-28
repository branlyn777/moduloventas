<?php

namespace App\Http\Livewire;
use App\Models\ProcedenciaCliente;
use Livewire\Component;

class ServicesController extends Component
{
    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.servicio.services', [
            'procedenciaClientes' => ProcedenciaCliente::orderBy('id', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
