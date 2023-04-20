<?php

namespace App\Http\Livewire;

use App\Models\Sucursal;
use Livewire\Component;

class SaleCreditController extends Component
{
    public function render()
    {

        return view('livewire.salecredit.salecredit', [
            'listasucursales' => Sucursal::all()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
