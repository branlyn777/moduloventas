<?php

namespace App\Http\Livewire;


use App\Models\Product;
use Livewire\Component;

class ListaProductosEstanteController extends Component
{
    public $estante_id;

    public function mount($id){
      
            $this->estante_id=$id;

    }

    public function render()
    {

      
        return view('livewire.localizacion.verdetalle')
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
