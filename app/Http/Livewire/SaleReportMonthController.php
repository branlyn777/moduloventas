<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class SaleReportMonthController extends Component
{
    public $user_id = 1;
    public $year;
    public $months;
   
    //grafica del reporte del mes 
    public function mount()
    {
        $this->year = Carbon::now()->year;
        $this->months = array();

    }
    public function render()
    {
        // $ventas = Sale::query();

        // if ($this->user_id) {
        //     $ventas->where('user_id', $this->user_id);
        // }

        // $ventas = $ventas->get();

        // $listausuarios = User::join("sales as s", "s.user_id", "users.id")
        //     ->select("users.*")
        //     ->where("s.status", "PAID")
        //     ->where("users.status", "ACTIVE")
        //     ->when($this->user_id, function ($query, $user_id) {
        //         return $query->where('users.id', $user_id);
        //     })
        //     ->distinct()
        //     ->get();

        
      

        //grafica del reporte del mes 
        for ($i=1; $i < 13; $i++)
        { 
            $total = Sale::where("status","PAID")
            ->whereYear("created_at",$this->year)
            ->whereMonth("created_at", $i)
            ->sum("total");

            array_push($this->months,$total);
        }
        // dd($this->months[11]);

        $chartOptions = [
            'chart' => [
                'type' => 'bar'
            ],
            'series' => [
                [
                    'name' => 'Sales',
                    
                    'data' => [$this->months[0] , $this->months[1], $this->months[2], $this->months[3], $this->months[4], $this->months[5], 
                    $this->months[6], $this->months[7], $this->months[8],$this->months[9],$this->months[10],$this->months[11]]
                ]
            ],
            'xaxis' => [
               
                'categories' => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre','Octubre', 'Noviembre','Diciembre']
            ]
        ];

        return view('livewire.sales.salereportmonth', [
            'chartOptions' => json_encode($chartOptions),
            'listausuarios' => $this->listausuarios(),
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    
    public function listausuarios()
    { 
        $listausuarios = User::join("sales as s", "s.user_id", "users.id")
            ->select("users.*")
            ->where("s.status", "PAID")
            ->where("s.status", "PAID")
            ->where("users.status", "ACTIVE")
            ->distinct()
            ->get();
        return $listausuarios;
    }
}
