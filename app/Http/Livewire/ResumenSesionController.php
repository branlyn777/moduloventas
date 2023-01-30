<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ResumenSesionController extends Component
{
    public  $id;
    public function __construct($id)
    {
        dd($id);
        $this->id=$id;
       

    }
    
    public function render()
    {
        return view('livewire.reportemovimientoresumen.resumen-sesion')
            ->extends('layouts.theme.app')
            ->section('content');
    }
}
