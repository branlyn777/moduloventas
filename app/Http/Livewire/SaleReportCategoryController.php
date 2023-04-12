<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SaleReportCategoryController extends Component
{
    public function render()
    {
        $chartOptions = [
            'chart' => [
                'type' => 'bar'
            ],
            'series' => [
                [
                    'name' => 'Sales',
                    'data' => [30, 40, 35, 50, 49, 60, 70, 91, 125]
                ]
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
            ]
        ];



        return view('livewire.sales.salereportcategory', [
            'chartOptions' => json_encode($chartOptions)
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
}
