<?php

namespace App\Http\Livewire;

// use Illuminate\View\Component as ViewComponent;

use App\Models\CarteraMov;
use App\Models\CarteraMovCategoria;
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
    public $ventasMes, $ventaMesAnterior, $difVenta;
    public $comprasMes, $compraMesAnterior, $difCompra;
    public $ingresosMes, $ingresosMesAnterior, $difIngresos;
    public $egresosMes, $egresosMesAnterior, $difEgresos;
    //graficos
    public $ventas = [], $compras = [], $ingresos = [], $egresos = [], $meses = [], $labelingresos,$chartingresos,$intchart,$tipo;

    public function mount(){
        $this->tipo='INGRESO';
    }

    public function render()
    {

        for ($i = 0; $i <= 6; $i++) {
            array_unshift($this->meses, Carbon::now()->subMonths($i)->isoFormat('MMMM'));
            $compra = Compra::whereMonth('created_at', now()->subMonths($i))
                ->where('status', 'ACTIVO')->sum('importe_total');
            array_unshift($this->compras, $compra);
            $venta = Sale::whereMonth('created_at', now()->subMonths($i))
                ->where('status', 'PAID')
                ->sum('total');
            array_unshift($this->ventas, $venta);
        }

        
       $this->chartingresos=Movimiento::join('cartera_movs','cartera_movs.movimiento_id','movimientos.id')
        ->join('cartera_mov_categorias','cartera_mov_categorias.id','cartera_movs.cartera_mov_categoria_id')
        ->where('cartera_mov_categorias.tipo',$this->tipo)
        ->where('movimientos.status','ACTIVO')
        ->whereMonth('movimientos.created_at', now())
        ->groupBy('cartera_mov_categorias.nombre')
        ->selectRaw('cartera_mov_categorias.nombre, sum(movimientos.import) as total_importe')
        ->get('total_importe','cartera_mov_categorias.nombre');
        
   
        $this->labelingresos = $this->chartingresos->pluck('nombre');
        $this->chartingresos = $this->chartingresos->pluck('total_importe');
     
        if ($this->tipo =='INGRESO') {
            
            $vs=Sale::whereMonth('created_at', now())
            ->where('status', 'PAID')
            ->sum('total');
      
            $this->chartingresos->push($vs);
            $this->labelingresos->push('Ingreso por ventas');
        }








        // Calculo de ingresos y porcencentajes de diferencia entre el mes actual y el mes anterior

        $this->ingresosMes = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
            ->whereMonth('movimientos.created_at', Carbon::now()->format('m'))->where('cartera_movs.type', 'INGRESO')
            ->where('tipoDeMovimiento', 'EGRESO/INGRESO')
            ->sum('movimientos.import');


        $this->ingresosMesAnterior = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
            ->whereMonth('movimientos.created_at', Carbon::now()->subMonth()->format('m'))
            ->where('cartera_movs.type', 'INGRESO')
            ->where('tipoDeMovimiento', 'EGRESO/INGRESO')
            ->sum('movimientos.import');


        if ($this->ingresosMesAnterior != 0) {

            $this->difIngresos = (($this->ingresosMes / $this->ingresosMesAnterior) - 1) * 100;
        } else {
            $this->difIngresos = 0;
        }

        //grafico de ingreso
        for ($i = 1; $i < 12; $i++) {

            $ing = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
                ->where('cartera_movs.type', 'INGRESO')
                ->where('cartera_movs.tipoDeMovimiento', 'EGRESO/INGRESO')
                ->whereMonth('movimientos.created_at', $i)->sum('import');
            array_push($this->ingresos, $ing);
        }

        //calculo de egresos y porcentajes de diferencia entre el mes actual y el mes anterior
        $this->egresosMes = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
            ->whereMonth('movimientos.created_at', Carbon::now()->format('m'))->where('cartera_movs.type', 'EGRESO')
            ->where('tipoDeMovimiento', 'EGRESO/INGRESO')
            ->sum('movimientos.import');


        $this->egresosMesAnterior = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
            ->whereMonth('movimientos.created_at', Carbon::now()->subMonth()->format('m'))
            ->where('cartera_movs.type', 'EGRESO')
            ->where('tipoDeMovimiento', 'EGRESO/INGRESO')
            ->sum('movimientos.import');

        for ($i = 1; $i < 12; $i++) {
            $egr = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
                ->where('cartera_movs.type', 'EGRESO')
                ->where('cartera_movs.tipoDeMovimiento', 'EGRESO/INGRESO')
                ->whereMonth('movimientos.created_at', $i)->sum('import');

            array_push($this->egresos, $egr);
        }
        if ($this->egresosMesAnterior != 0) {
            $this->difEgresos = (($this->egresosMes / $this->egresosMesAnterior) - 1) * 100;
        } else {
            $this->difEgresos = 0;
        }




        //Cálculo del total ventas en el mes actual
        $total_current_month = Sale::whereMonth('created_at', Carbon::now()->month)->where("status", "PAID")->sum('total');


        //Obteniendo la fecha del primer dia del mes anterior
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
        //Obtniendo la fecha del dia actual pero del mes anterior
        $endOfLastMonth = Carbon::now()->subMonth()->format('Y-m-d H:m:s');

        //Cálculo del total ventas del mes anterior
        $previus_month_total = Sale::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->where("status", "PAID")->sum('total');

        // if ($previus_month_total != 0) {

            //Obteniendo el porcentaje de $endOfLastMonth
            //$percentage = ($previus_month_total * 100) / $total_current_month;


            //Calculando la diferencia
            // $difference = $total_current_month - $previus_month_total;



            //Calculando la diferencia en porcentaje
        //     $difference_percentage = 100 - $percentage;
        // } else {
        //     $difference_percentage = 0;
        // }




        return view('livewire.inicio.inicio', [

            'total_current_month' => $total_current_month,
           // 'difference_percentage' => $difference_percentage,

        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function mostrarEgresos(){
        $this->tipo='EGRESO';
    }
}
