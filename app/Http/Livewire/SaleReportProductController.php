<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class SaleReportProductController extends Component
{
    public function render()
    {
        
        $tabla_productos = Product::all();




        return view('livewire.sales.salereportproduct', [
            'tabla_productos' => $tabla_productos,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
}
