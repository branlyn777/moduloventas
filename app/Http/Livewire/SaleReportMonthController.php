<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SaleReportMonthController extends Component
{
    public function render()
    { 
        $asd="";
        return view('livewire.sales.salereportmonth', [
            'categories' => $asd
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    
    }
}
