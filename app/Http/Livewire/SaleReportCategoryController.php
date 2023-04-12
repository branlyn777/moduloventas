<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SaleReportCategoryController extends Component
{
    public function render()
    {
        $asd = "";
        return view('livewire.sales.salereportcategory', [
            'asd' => $asd
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
}
