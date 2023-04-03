<?php

namespace App\Http\Livewire;

// use Illuminate\View\Component as ViewComponent;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Movimiento;
use App\Models\ProcedenciaCliente;
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
    public $ventas = [], $compras = [], $ingresos = [], $egresos = [], $labels = [];


    //VARIABLES PARA PROCENDIA CLIENTES
    public $quantity_origin_client, $name_origin_client, $color_origin_client;


    public function render()
    {
        $this->name_origin_client = [];
        $this->color_origin_client = [];
        $this->quantity_origin_client = [];
        $variable = "";
        $inicio = Carbon::now()->format('m');

        for ($i = $inicio; $i < 0; $i--) {
            $monto = Sale::where('status', 'PAID')->whereMonth('created_at', $i)->sum('total');
            array_push($this->ventas, $monto);
        }
        for ($j = $inicio; $j < 0; $j--) {
            $monto = Compra::where('status', 'ACTIVO')->whereMonth('created_at', $j)->sum('importe_total');
            array_push($this->compras, $monto);
        }


        $this->ventas = Sale::selectRaw("EXTRACT(MONTH FROM created_at) as mes, SUM(total) as total_ventas")
            ->whereBetween('created_at', [
                now()->subMonths(6),
                now()
            ])
            ->groupBy('mes')
            ->pluck('total_ventas');
      
        // $meses = [];
        // foreach ($this->ventas as $venta) {
        //     $meses[] =$venta->mes->formatLocalized('%B');
           
        // }

        // return $meses;


        // Calculo de ventas y porcencentajes de diferencia entre el mes actual y el mes anterior

        $this->ventasMes = Sale::where('status', 'PAID')->whereMonth('created_at', Carbon::now()->format('m'))->sum('total');

        $this->ventaMesAnterior = Sale::where('status', 'PAID')->whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->sum('total');

        if ($this->ventaMesAnterior != 0) {
            $this->difVenta = (($this->ventasMes / $this->ventaMesAnterior) - 1) * 100;
        } else {
            $this->difVenta = 0;
        }

        //ventas grafico
        // for ($i = 1; $i < 13; $i++) {
        //     $ven = Sale::whereMonth('created_at', $i)->sum('total');
        //     array_push($this->ventas, (int)$ven);
        // }

        for ($i = 1; $i < 13; $i++) {
            $cc = Compra::whereMonth('created_at', $i)->sum('importe_total');
            array_push($this->compras, $cc);
        }
        // Calculo de compras y porcencentajes de diferencia entre el mes actual y el mes anterior

        $this->comprasMes = Compra::where('status', 'ACTIVO')->whereMonth('created_at', Carbon::now()->format('m'))->sum('importe_total');
        $this->compraMesAnterior = Compra::where('status', 'ACTIVO')->whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->sum('importe_total');
        if ($this->compraMesAnterior != 0) {

            $this->difCompra = (($this->comprasMes / $this->compraMesAnterior) - 1) * 100;
        } else {
            $this->difCompra = 0;
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
        $total_current_month = Sale::whereMonth('created_at', Carbon::now()->month)->where("status","PAID")->sum('total');


        //Obteniendo la fecha del primer dia del mes anterior
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
        //Obtniendo la fecha del dia actual pero del mes anterior
        $endOfLastMonth = Carbon::now()->subMonth()->format('Y-m-d H:m:s');

        //Cálculo del total ventas del mes anterior
        $previus_month_total = Sale::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->where("status","PAID")->sum('total');

        if($previus_month_total != 0)
        {
            
            //Obteniendo el porcentaje de $endOfLastMonth
            $percentage = ($previus_month_total * 100) / $total_current_month;


            //Calculando la diferencia
            // $difference = $total_current_month - $previus_month_total;



            //Calculando la diferencia en porcentaje
            $difference_percentage = 100 - $percentage;
        }
        else
        {
            $difference_percentage = 0;
        }




        //GRAFICO PROCEDENCIA CLENTES

        $origins = ProcedenciaCliente::where("estado","Activo")->get();





        foreach($origins as $o)
        {
            array_push($this->name_origin_client, $o->procedencia);

            $red = rand(0, 255);
            $green = rand(0, 255);
            $blue = rand(0, 255);

            $color = sprintf("#%02x%02x%02x", $red, $green, $blue);

            array_push($this->color_origin_client, $color);


            $mount = Cliente::join("procedencia_clientes as pc", "pc.id", "clientes.procedencia_cliente_id")
            ->join("cliente_movs as cm","cm.cliente_id", "clientes.id")
            ->join("movimientos as m", "m.id", "cm.movimiento_id")
            ->join("mov_services as ms", "ms.movimiento_id", "m.id")
            ->join("services as s", "s.id", "ms.service_id")
            ->join("cat_prod_services as cps", "cps.id", "s.cat_prod_service_id")
            ->select("clientes.*", "pc.procedencia as procedencia", "pc.id as idprocedencia","cps.nombre as nombrecps")
            ->whereMonth('clientes.created_at', Carbon::now()->month)
            ->whereYear('clientes.created_at', Carbon::now()->year)
            ->where("pc.estado","Activo")
            ->where("clientes.procedencia_cliente_id", $o->id)
            ->distinct()
            ->get();


            array_push($this->quantity_origin_client, $mount->count());

        }



        // $this->quantity_origin_client = [15, 20, 10];






        return view('livewire.inicio.inicio', [
            'variable' => $variable,
            'total_current_month' => $total_current_month,
            'difference_percentage' => $difference_percentage,
            'origins' => $origins,

        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
}