<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class SaleReportMonthController extends Component
{
    public $user_id;
    public $year;
    public $months, $listausuarios, $listayears;

    //grafica del reporte del mes 
    public function mount()
    {
        if (session('y'))
        {
            // La variable de sesión existe y tiene un valor no nulo
            $this->year = session('y');
            $this->user_id = session('u');
        }
        else
        {
            
        $this->year = Carbon::now()->year;
        $this->user_id = "todos";
        }
        $this->months = array();
        $this->listausuarios = User::join("sales as s", "s.user_id", "users.id")
                ->select("users.*")
                ->where("s.status", "PAID")
                ->where("users.status", "ACTIVE")
                ->distinct()
                ->get();
        $this->listayears = User::join("sales as s", "s.user_id", "users.id")
                ->select(DB::raw('YEAR(s.created_at) as year'))
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
            for ($i = 1; $i < 13; $i++)
            {
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
        return view('livewire.sales.salereportmonth', [
            'listausuarios' => $this->listausuarios,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function actualizar()
    {
        session(['y' => $this->year]);
        session(['u' => $this->user_id]);
        return Redirect::to('reportemes');
    }
}
