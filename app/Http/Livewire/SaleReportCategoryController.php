<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SaleReportCategoryController extends Component
{
    public $dateFrom, $dateTo;

    public function mount()
    {
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
    }
    public function render()
    {

        
        $list_categories = Category::select('categories.name as category_name', DB::raw('SUM(sale_details.quantity * sale_details.price) as total_sales'))
        ->join('products', 'categories.id', '=', 'products.category_id')
        ->join('sale_details', 'products.id', '=', 'sale_details.product_id')
        ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
        ->whereBetween('sales.created_at', [Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59'])
        ->groupBy('categories.name')
        ->orderBy('total_sales', 'DESC')
        ->get();

        $name_categories = array();
        $total_categories = array();
        foreach($list_categories as $c)
        {
            array_push($name_categories, $c->category_name);
            array_push($total_categories, intval($c->total_sales));
        }
        $chartOptions = [
            'series' => $total_categories,
            'chart' => [
                'width' => 1000,
                'type' => 'pie',
            ],
            'labels' => $name_categories,
            'responsive' => [
                [
                    'breakpoint' => 1080,
                    'options' => [
                        'chart' => [
                            'width' => 500
                        ],
                        'legend' => [
                            'position' => 'bottom'
                        ]
                    ]
                ]
            ]
        ];



        return view('livewire.sales.salereportcategory', [
            'chartOptions' => json_encode($chartOptions)
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
}
