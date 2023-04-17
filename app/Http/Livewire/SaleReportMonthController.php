<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SaleReportMonthController extends Component
{
    public $user_id;
    public $year;
    public $months;

    //grafica del reporte del mes 
    public function mount()
    {
        $this->user_id = Auth()->user()->id;
        $this->year = Carbon::now()->year;
        $this->months = array();
     


            $this->listausuarios = User::join("sales as s", "s.user_id", "users.id")
                    ->select("users.*")
                    ->where("s.status", "PAID")
                    ->where("users.status", "ACTIVE")
                    ->distinct()
                    ->get();

    }
    public function render()
    {
        $this->months = [];
        if ($this->user_id == "todos")
        {
            for ($i = 1; $i < 13; $i++) {
                $total = Sale::join("users", "sales.user_id", "users.id")
                    ->where("sales.status", "=", "PAID")
                    ->whereYear("sales.created_at", $this->year)
                    ->whereMonth("sales.created_at", $i)
                    ->sum("sales.total");
        
                array_push($this->months, $total);
            } 
        }
        else
        {
            for ($i = 1; $i < 13; $i++) {
                $total = Sale::join("users", "sales.user_id", "users.id")
                    ->where("sales.status", "=", "PAID")
                    ->whereYear("sales.created_at", $this->year)
                    ->whereMonth("sales.created_at", $i)
                    ->where("sales.user_id", $this->user_id)
                    ->sum("sales.total");
        
                array_push($this->months, $total);
            } 
            
        } 

        
        //grafica del reporte del mes 
        
        $this->emit("asd");

        return view('livewire.sales.salereportmonth', [
            'listausuarios' => $this->listausuarios,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function listausuarios()
    {
        // $listausuarios = User::join("sales as s", "s.user_id", "users.id")
        //         ->select("users.*")
        //         ->where("s.status", "PAID")
        //         ->where("users.status", "ACTIVE")
        //         ->distinct()
        //         ->get();

        // if ($this->user_id == "todos")
        // {


        // } else {
        //     $listausuarios = User::join("sales as s", "s.user_id", "users.id")
        //         ->select("users.*")
        //         ->where("s.status", "PAID")
        //         ->where("users.status", "ACTIVE")
        //         ->where("users.id", $this->user_id)
        //         ->distinct()
        //         ->get();
        // }


        // return $listausuarios;
    }
}
