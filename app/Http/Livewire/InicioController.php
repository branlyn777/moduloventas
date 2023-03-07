<?php

namespace App\Http\Livewire;

// use Illuminate\View\Component as ViewComponent;

use App\Models\CarteraMov;
use App\Models\CarteraMovCategoria;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Movimiento;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleLote;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class InicioController extends Component
{
    public $ventasMes, $ventaMesAnterior, $difVenta;
    public $comprasMes, $compraMesAnterior, $difCompra;
    public $ingresosMes, $ingresosMesAnterior, $difIngresos;
    public $egresosMes, $egresosMesAnterior, $difEgresos, $shouldRenderChart = [2, 6, 9, 13, 5, 6];
    public $ventasusuario,$clientesnuevos,$porcentajeclientes,$clientesmesanterior;
    //graficos
    public $ventas = [], $compras = [], $ingresos = [], $egresos = [], $meses = [], $labelingresos, $chartingresos, $intchart,
        $tipo, $chartegresos, $labelegresos, $mesesbarras = [],$ganancias;

    public function mount()
    {
        $this->tipo = 'INGRESO';
        $this->porcentajeclientes=1;
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


        $this->chartingresos = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
            ->join('cartera_mov_categorias', 'cartera_mov_categorias.id', 'cartera_movs.cartera_mov_categoria_id')
            ->where('cartera_mov_categorias.tipo', 'INGRESO')
            ->where('movimientos.status', 'ACTIVO')
            ->whereMonth('movimientos.created_at', now())
            ->groupBy('cartera_mov_categorias.nombre')
            ->selectRaw('cartera_mov_categorias.nombre, sum(movimientos.import) as total_importe')
            ->get('total_importe', 'cartera_mov_categorias.nombre');

        $this->chartegresos = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
            ->join('cartera_mov_categorias', 'cartera_mov_categorias.id', 'cartera_movs.cartera_mov_categoria_id')
            ->where('cartera_mov_categorias.tipo', 'EGRESO')
            ->where('movimientos.status', 'ACTIVO')
            ->whereMonth('movimientos.created_at', now())
            ->groupBy('cartera_mov_categorias.nombre')
            ->selectRaw('cartera_mov_categorias.nombre, sum(movimientos.import) as total_importe')
            ->get('total_importe', 'cartera_mov_categorias.nombre');


        $this->labelingresos = $this->chartingresos->pluck('nombre');
        $this->chartingresos = $this->chartingresos->pluck('total_importe');

        $this->labelegresos = $this->chartegresos->pluck('nombre');
        $this->chartegresos = $this->chartegresos->pluck('total_importe');



        $vs = Sale::whereMonth('created_at', now())
            ->where('status', 'PAID')
            ->sum('total');

        $this->chartingresos->push($vs);
        $this->labelingresos->push('Ingreso por ventas');



        $this->ventasusuario = Sale::join('users', 'users.id', 'sales.user_id')
            ->whereMonth('sales.created_at', now())
            ->where('sales.status', 'PAID')
            ->groupBy('sales.user_id')
            ->selectRaw('users.name as nombre, sum(sales.total) as total_importe')
            ->pluck('total_importe', 'nombre');


        //Grafica de barras para ingresos y egresos por categoria
        for ($i = 0; $i <= 6; $i++) {
            array_unshift($this->mesesbarras, Carbon::now()->subMonths($i)->isoFormat('MMMM'));
            $ingreso = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
                ->whereMonth('movimientos.created_at', now()->subMonths($i))
                ->where('status', 'ACTIVO')
                ->where('cartera_movs.type', 'INGRESO')
                ->where('cartera_movs.tipoDeMovimiento', 'EGRESO/INGRESO')
                ->sum('movimientos.import');
            array_unshift($this->ingresos, $ingreso);
            $egreso = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
                ->whereMonth('movimientos.created_at', now()->subMonths($i))
                ->where('status', 'ACTIVO')
                ->where('cartera_movs.type', 'EGRESO')
                ->where('cartera_movs.tipoDeMovimiento', 'EGRESO/INGRESO')
                ->sum('movimientos.import');
            array_unshift($this->egresos, $egreso);
        }

        //lista de productos mas vendidos
        $prod_mas_vendidos = Product::join("sale_details as sd", "sd.product_id", "products.id")
            ->join("sales as s", "s.id", "sd.sale_id")
            ->where("s.status", "PAID")
            ->whereMonth('s.created_at', now())
            ->groupBy('products.id')
            ->selectRaw("products.*,sum(sd.quantity) as cantidad_vendida,sum(sd.quantity*sd.price) as total_vendido")
            ->orderBy('cantidad_vendida','DESC')
            ->take(5)
            ->get();

        //nuevos clientes
        $this->clientesnuevos=Cliente::whereMonth('created_at', now())->count();
        $this->clientesmesanterior=Cliente::whereMonth('created_at', now()->subMonths(1))->count();
        $this->porcentajeclientes= ($this->clientesnuevos/ $this->clientesmesanterior)*100;


        $this->ganancias= SaleDetail::join('sale_lotes','sale_lotes.sale_detail_id','sale_details.id');
                          
        //dd($this->porcentajeclientes);
        //dd($clientesnuevos);



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
            'productos_vendidos' => $prod_mas_vendidos
            // 'difference_percentage' => $difference_percentage,

        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function mostrarEgresos()
    {
        $this->tipo = 'EGRESO';
    }


    public function obtener_cantidad_vendida($productoid)
    {
        $cantidad = SaleDetail::join("sales as s", "s.id", "sale_details.sale_id")
            ->where("sale_details.product_id", $productoid)
            ->where("s.status", "PAID")
            ->whereMonth('s.created_at', now())

            ->sum('sale_details.quantity');
        return $cantidad;
    }

    public function obtener_total_vendido($productoid)
    {

        // $total = SaleDetail::join("sales as s","s.id","sale_details.sale_id")
        // ->select(DB::raw('sale_details.price * sale_details.quantity as total'))
        // ->where("sale_details.product_id",$productoid)
        // ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
        // ->sum('total');
        // return $total;


        $total = SaleDetail::join("sales as s", "s.id", "sale_details.sale_id")
            ->select(DB::raw('sale_details.price * sale_details.quantity as total'))
            ->where("sale_details.product_id", $productoid)
            ->where("s.status", "PAID")
            ->whereMonth('s.created_at', now())

            ->get();

        $t = 0;

        foreach ($total as $tt) {
            $t = $t + $tt->total;
        }

        return $t;
    }


    public function obtener_total_costo($productoid)
    {
        $lista = SaleDetail::join("sales as s", "s.id", "sale_details.sale_id")
            ->select("sale_details.id as iddetalle", "sale_details.price as precio_venta")
            ->where("s.status", "PAID")
            ->where("sale_details.product_id", $productoid)
            ->whereMonth('s.created_at', now())

            ->get();

        $total_costo = 0;


        foreach ($lista as $l) {
            $lista_lotes = SaleLote::join("lotes as l", "l.id", "sale_lotes.lote_id")
                ->select(DB::raw('sale_lotes.cantidad * l.costo as total'))
                ->where("sale_lotes.sale_detail_id", $l->iddetalle)
                ->get();
            foreach ($lista_lotes as $ll) {
                $total_costo = $total_costo + $ll->total;
            }
        }


        return $total_costo;
    }
}
