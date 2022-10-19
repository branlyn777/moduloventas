<?php

namespace App\Http\Livewire;

// use Illuminate\View\Component as ViewComponent;
use Livewire\Component;

class InicioController extends Component
{
    public function render()
    {

        $variable = "";

        return view('livewire.inicio.inicio', [
            'variable' => $variable
        ])
        ->extends('layouts.theme.app')
        ->section('content');


    }
}
