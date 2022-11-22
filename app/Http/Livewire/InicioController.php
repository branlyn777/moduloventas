<?php

namespace App\Http\Livewire;

// use Illuminate\View\Component as ViewComponent;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class InicioController extends Component
{
    public function render()
    {

        $variable = "";
        $ventas= 
        $users = User::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', date('Y'))
        ->orderBy('id','ASC')
        ->pluck('count');

$labels = $users->keys();
$data = $users->values();

        return view('livewire.inicio.inicio', [
            'variable' => $variable,
            'labels'=>$labels,
            'data'=>$data
        ])
        ->extends('layouts.theme.app')
        ->section('content');


    }
}
