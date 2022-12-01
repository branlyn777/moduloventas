<?php

namespace App\Http\Livewire;

// use Illuminate\View\Component as ViewComponent;

use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Movimiento;
use App\Models\Sale;
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
    public $ventas=[],$compras=[],$ingresos=[],$egresos=[];
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

        $this->ventasMes= Sale::where('status','PAID')->whereMonth('created_at', Carbon::now()->format('m'))->sum('total');

        $this->ventaMesAnterior= Sale::where('status','PAID')->whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->sum('total');

        if ($this->ventaMesAnterior != 0) {
          
            $this->difVenta = (($this->ventasMes/$this->ventaMesAnterior)-1)*100;
           
        }
        else{
            $this->difVenta=0;
        }

        //ventas grafico

       for ($i=1; $i < 12; $i++) { 
        $ven= Sale::whereMonth('created_at',$i)->sum('total');
        array_push($this->ventas,$ven);
       }
       for ($i=1; $i < 12; $i++) { 
        $cc= Compra::whereMonth('created_at',$i)->sum('importe_total');
        array_push($this->compras,$cc);
       }
       // Calculo de compras y porcencentajes de diferencia entre el mes actual y el mes anterior
        
        $this->comprasMes= Compra::where('status','ACTIVO')->whereMonth('created_at', Carbon::now()->format('m'))->sum('importe_total');
     

        $this->compraMesAnterior= Compra::where('status','ACTIVO')->whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->sum('importe_total');

     
        if ($this->compraMesAnterior != 0) {
          
            $this->difCompra = (($this->comprasMes/$this->compraMesAnterior)-1)*100;
            
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
          
            $this->difIngresos = (($this->ingresosMes/$this->ingresosMesAnterior)-1)*100;
           
        }
        else{
            $this->difIngresos=0;
        }

       //grafico de ingreso

       for ($i=1; $i < 12; $i++) { 
        
        $ing= Movimiento::join('cartera_movs','cartera_movs.movimiento_id','movimientos.id')
        ->where('cartera_movs.type','INGRESO')
        ->where('cartera_movs.tipoDeMovimiento','EGRESO/INGRESO')
        ->whereMonth('movimientos.created_at',$i)->sum('import');
        array_push($this->ingresos,$ing);

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

        for ($i=1; $i < 12; $i++) { 
        
            $egr= Movimiento::join('cartera_movs','cartera_movs.movimiento_id','movimientos.id')
            ->where('cartera_movs.type','EGRESO')
            ->where('cartera_movs.tipoDeMovimiento','EGRESO/INGRESO')
            ->whereMonth('movimientos.created_at',$i)->sum('import');
    
    
            array_push($this->egresos,$egr);
    
           }

     
        if ($this->egresosMesAnterior != 0) {
          
            $this->difEgresos = (($this->egresosMes/$this->egresosMesAnterior)-1)*100;
         

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
