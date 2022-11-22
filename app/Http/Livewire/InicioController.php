<?php

namespace App\Http\Livewire;

// use Illuminate\View\Component as ViewComponent;

use App\Models\CompraDetalle;
use App\Models\Movimiento;
use App\Models\SaleDetail;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class InicioController extends Component
{
    public $ventasMes,$ventaMesAnterior,$difVenta;
    public $comprasMes,$compraMesAnterior,$difCompra;
    public $ingresosMes,$ingresosMesAnterior,$difIngresos;
    public $egresosMes,$egresosMesAnterior,$difEgresos;
    //graficos
    public $ventas=[],$compras;
    public function render()
    {

        $variable = "";
       
        $users = User::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', date('Y'))
        ->orderBy('id','ASC')
        ->pluck('count');

        $labels = $users->keys();
        $data = $users->values();
        // Calculo de ventas y porcencentajes de diferencia entre el mes actual y el mes anterior

        $this->ventasMes= SaleDetail::whereMonth('created_at', Carbon::now()->format('m'))->get();

        $this->ventasMes= $this->ventasMes->sum(function($value){
            return $value['quantity']*$value['price'];
        });

        $this->ventaMesAnterior= SaleDetail::whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->get();

        $this->ventaMesAnterior= $this->ventaMesAnterior->sum(function($value){
            return $value['quantity']*$value['price'];
        });
        if ($this->ventaMesAnterior != 0) {
          
            $this->difVenta = ($this->ventasMes/$this->ventaMesAnterior)-1;
        }
        else{
            $this->difVenta=0;
        }

        //ventas grafico


       for ($i=1; $i < 12; $i++) { 
            $mm= SaleDetail::whereMonth('created_at',$i)->get();
            $mm=$mm->sum(function($value){
                return $value['quantity']*$value['price'];
            });
       }


       // Calculo de compras y porcencentajes de diferencia entre el mes actual y el mes anterior
        
        $this->comprasMes= CompraDetalle::whereMonth('created_at', Carbon::now()->format('m'))->get();
        $this->comprasMes=$this->comprasMes->sum(function($value){
            return $value['cantidad']*$value['precio'];
        });

        $this->compraMesAnterior= CompraDetalle::whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->get();

        $this->compraMesAnterior= $this->compraMesAnterior->sum(function($value){
            return $value['cantidad']*$value['precio'];
        });
        if ($this->compraMesAnterior != 0) {
          
            $this->difCompra = ($this->comprasMes/$this->compraMesAnterior)-1;
        }
        else{
            $this->difCompra=0;
        }


        // Calculo de ingresos y porcencentajes de diferencia entre el mes actual y el mes anterior

        $this->ingresosMes= Movimiento::join('cartera_movs','cartera_movs.movimiento_id','movimientos.id')
        ->whereMonth('movimientos.created_at', Carbon::now()->format('m'))->where('cartera_movs.type','INGRESO')
        ->where('tipoDeMovimiento','EGRESO/INGRESO')
        ->sum('movimientos.import');    
       

        $this->ingresosMesAnterior= Movimiento::join('cartera_movs','cartera_movs.movimiento_id','movimientos.id')
        ->whereMonth('movimientos.created_at', Carbon::now()->subMonth()->format('m'))
        ->where('cartera_movs.type','INGRESO')
        ->where('tipoDeMovimiento','EGRESO/INGRESO')
        ->sum('movimientos.import');

     
        if ($this->ingresosMesAnterior != 0) {
          
            $this->difIngresos = ($this->ingresosMes/$this->ingresosMesAnterior)-1;
        }
        else{
            $this->difIngresos=0;
        }



        //calculo de egresos y porcentajes de diferencia entre el mes actual y el mes anterior

        $this->egresosMes= Movimiento::join('cartera_movs','cartera_movs.movimiento_id','movimientos.id')
        ->whereMonth('movimientos.created_at', Carbon::now()->format('m'))->where('cartera_movs.type','EGRESO')
        ->where('tipoDeMovimiento','EGRESO/INGRESO')
        ->sum('movimientos.import');
       

        $this->egresosMesAnterior= Movimiento::join('cartera_movs','cartera_movs.movimiento_id','movimientos.id')
        ->whereMonth('movimientos.created_at', Carbon::now()->subMonth()->format('m'))
        ->where('cartera_movs.type','EGRESO')
        ->where('tipoDeMovimiento','EGRESO/INGRESO')
        ->sum('movimientos.import');

     
        if ($this->egresosMesAnterior != 0) {
          
            $this->difEgresos = ($this->egresosMes/$this->egresosMesAnterior)-1;
        }
        else{
            $this->difEgresos=0;
        }


    




        return view('livewire.inicio.inicio', [
            'variable' => $variable,
            'labels'=>$labels,
            'data'=>$data
        ])
        ->extends('layouts.theme.app')
        ->section('content');


    }
}
