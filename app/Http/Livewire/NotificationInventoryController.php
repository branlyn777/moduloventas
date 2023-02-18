<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationInventoryController extends Component
{
    public function render()
    {
        $data = "";

        return view('livewire.notificationinventory.notificationinventory', [
            'data' => $data,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
