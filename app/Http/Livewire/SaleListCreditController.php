<?php

namespace App\Http\Livewire;

use App\Models\Sucursal;
use Livewire\Component;

class SaleListCreditController extends Component
{
    public function render()
    {
        // dd('hola');
        return view('livewire.salecredit.salelistcredit', [
            'listasucursales' => Sucursal::all()
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
}
