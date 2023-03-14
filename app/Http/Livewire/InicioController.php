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

       // SaleLote::where('cantidad',0)->delete();
      
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
            
            ->get();
//dd($prod_mas_vendidos->count());
        //nuevos clientes

        $this->porcentajeclientes= $this->porcent_clientes();
        

        $calculo_costos= SaleDetail::join('sale_lotes as sl','sl.sale_detail_id','sale_details.id')
        ->join('lotes','lotes.id','sl.lote_id')
        ->join('sales','sales.id','sale_details.sale_id')
        ->where('sales.status','PAID')
        ->whereMonth('sale_details.created_at', now())
        ->groupBy('sl.sale_detail_id')
        ->selectRaw("sum(sl.cantidad*lotes.costo) as total_costo")
        ->get();
        $calculo_totalventas= SaleDetail::join('sale_lotes as sl','sl.sale_detail_id','sale_details.id')
        ->join('lotes','lotes.id','sl.lote_id')
        ->join('sales','sales.id','sale_details.sale_id')
        ->where('sales.status','PAID')
        ->whereMonth('sale_details.created_at', now())
        ->groupBy('sl.sale_detail_id')
        ->selectRaw("sum(sl.cantidad*sale_details.price) as total_venta")
        ->get();
       //dd($calculo_totalventas->sum('total_venta'));

        if ($calculo_costos->isEmpty()) {
            $this->ganancias=0;
        }
        else {
            $this->ganancias= $calculo_totalventas->sum('total_venta')-$calculo_costos->sum('total_costo');

        }

        //dd($this->ganancias);

        $this->porcentajeganancias=$this->porcent_ganancias();

                          
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
            'productos_vendidos' => $prod_mas_vendidos->take(5)
            // 'difference_percentage' => $difference_percentage,

        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function mostrarEgresos()
    {
        $this->tipo = 'EGRESO';
    }



    public function porcent_clientes(){
        $this->clientesnuevos=Cliente::whereMonth('created_at', now())->count();
        $clt=Cliente::whereMonth('created_at', now()->subMonths(1))->count();
        if ($clt==0) {
            return 100;
        }
        return ($this->clientesnuevos/$clt)*100;
       
    }

    public function porcent_ganancias(){
        $gan_actual=$this->ganancias;

        $gan_anterior=  SaleDetail::join('sale_lotes','sale_lotes.sale_detail_id','sale_details.id')
        ->whereMonth('sale_details.created_at', now()->subMonth(1))
        ->groupBy('sale_details.sale_id')
        ->selectRaw("sum(sale_details.quantity*sale_details.price) as total_ganado")
        ->get();

        if ($gan_anterior->isEmpty()) {
            $gan_anterior=100;
        }
        else {
            $lm=$gan_anterior->sum('total_ganado');

            //dd($gan_actual);
            return ($gan_actual/$lm)*100;
        }



      

    }

}
