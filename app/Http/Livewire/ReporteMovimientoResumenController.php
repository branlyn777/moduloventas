<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\Lote;
use App\Models\Movimiento;
use App\Models\OperacionesCarterasCompartidas;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleLote;
use App\Models\Service;
use App\Models\ServiceRepVentaInterna;
use App\Models\Sucursal;
use App\Models\Transaccion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReporteMovimientoResumenController extends Component
{
    public $idsucursal, $totalesIngresos, $totalesEgresos, $fromDate, $toDate, $cartera_id, $cartera_id2, $type, $cantidad, $tipo, $importe, $comentario, $vertotales = 0, $importetotalingresos, $importetotalegresos,
        $operacionefectivoing, $noefectivo, $operacionefectivoeg, $noefectivoeg, $sumaBanco, $op_recaudo, $recaudo, $subtotalcaja, $utilidadtotal = 5, $caja, $op_sob_falt = 0, $ops = 0, $sucursal, $total, $optotal, $sm, $diferenciaCaja, $montoDiferencia, $obsDiferencia,
        $ventas, $servicios, $ingresoEgreso, $totalesIngresosVGeneral, $Banco, $operacionfalt, $operacionsob, $operacionajuste, $operacionesZ, $operacionesW, $aperturas_cierres, $ajustes;

    public $subtotalesIngresos;

    public function mount()
    {
        $this->obtenersucursal();
        $this->fromDate = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->toDate =  Carbon::parse(Carbon::now())->format('Y-m-d');

        $this->caja = 'TODAS';
    }
    public function render()
    {
        /* Caja en la cual se encuentra el usuario */
        if (Auth::user()->hasPermissionTo('Admin_Views')) {
            $sucursals = Sucursal::all();
            if ($this->sucursal == 'TODAS') {
                $cajab = Caja::where('cajas.nombre', '!=', 'Caja General')->get();
            } else {
                $cajab = Caja::where('cajas.sucursal_id', $this->sucursal)->where('cajas.nombre', '!=', 'Caja General')->get();
            }
        } else {
            $sucursals = User::join('sucursal_users as su', 'su.user_id', 'users.id')
                ->join('sucursals as s', 's.id', 'su.sucursal_id')
                ->where('users.id', Auth()->user()->id)
                ->where('su.estado', 'ACTIVO')
                ->select('s.*')
                ->get();
            //dd($sucursales);

            $cajab = Caja::where('cajas.sucursal_id', $this->sucursal)->where('cajas.nombre', '!=', 'Caja General')->get();
        }

        $carterasSucursal = Cartera::join('cajas as c', 'carteras.caja_id', 'c.id')
            ->join('sucursals as s', 's.id', 'c.sucursal_id')
            ->where('s.id', $this->sucursal)
            ->select(
                'carteras.id',
                'carteras.nombre as carteraNombre',
                'c.nombre as cajaNombre',
                'c.id as cid',
                'c.monto_base',
                'carteras.tipo as tipo',
                DB::raw('0 as monto')
            )->get();


        // $this->saldo_acumulado(Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', $this->sucursal, $this->caja);
        $this->viewTotales();

        if ($this->cartera_id != null) {
            $this->sm = Caja::find($this->cartera_id);
            $this->operacionrecaudo();
        }






        return view('livewire.reportemovimientoresumen.reportemovimientoresumen', [
            'carterasSucursal' => $carterasSucursal,
            'sucursales' => $sucursals,
            'cajas' => $cajab

        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function idsucursaluser()
    {
        $idsucursal = User::join("sucursal_users as su", "su.user_id", "users.id")
            ->select("su.sucursal_id as id", "users.name as n")
            ->where("users.id", Auth()->user()->id)
            ->where("su.estado", "ACTIVO")
            ->get()
            ->first();
        return $idsucursal->id;
    }

    public function  updatingSucursal()
    {
        $this->caja = 'TODAS';
    }



    public function viewTotales()
    {
        $this->utilidadtotal = 0;
        if ($this->caja != 'TODAS') {

            $totalesIngresosVentas = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->join('sales as s', 's.movimiento_id', 'movimientos.id')
                ->select(
                    's.id as idventa',
                    'movimientos.import as importe',
                    'crms.type as carteramovtype',
                    'crms.tipoDeMovimiento',
                    'c.nombre as nombrecartera',
                    'c.descripcion',
                    'u.id as idusuario',
                    'c.tipo as ctipo',
                    'movimientos.created_at as movcreacion',
                    'movimientos.id as idmov',
                    DB::raw('0 as detalle'),
                    DB::raw('0 as utilidadventa'),
                    DB::raw('0 as caja')
                )
                ->where('crms.type', 'INGRESO')
                ->where('crms.tipoDeMovimiento', 'VENTA')
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->where('movimientos.status', 'ACTIVO')
                ->orderBy('movimientos.created_at', 'asc')
                ->get();

            foreach ($totalesIngresosVentas as $val) {
                $vs = $this->listardetalleventas($val->idventa);

                $val->detalle = $vs;
                $dcaja = $this->cajaoperacion($val->idmov);
                $val->caja = $dcaja;
                $val->utilidadventa = $this->utilidadventa($val->idventa);
            }



            $this->totalesIngresosV = $totalesIngresosVentas->where('caja', $this->caja);

            //Totales Ingresos (EGRESOS/INGRESOS)
            $totalesIngresosIngEg = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->select(
                    'movimientos.import as importe',
                    'crms.type as carteramovtype',
                    'crms.tipoDeMovimiento',
                    'crms.comentario as coment',
                    'c.nombre as nombrecartera',
                    'c.descripcion',
                    'c.tipo as ctipo',
                    'c.telefonoNum',
                    'movimientos.created_at as movcreacion',
                    'movimientos.id as idmov',
                    DB::raw('0 as caja')
                )
                ->where('movimientos.status', 'ACTIVO')
                ->where('crms.tipoDeMovimiento', 'EGRESO/INGRESO')
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->orderBy('movimientos.created_at', 'asc')
                ->get();
            //rellenamos la caja de los ingresos
            foreach ($totalesIngresosIngEg as $val) {

                $dcaja = $this->cajaoperacion($val->idmov);
                $val->caja = $dcaja;
            }
            $this->totalesIngresosIE = $totalesIngresosIngEg->where('carteramovtype', 'INGRESO')->where('caja', $this->caja);
            //Totales Egresos (EGRESOS/INGRESOS)
            $this->totalesEgresosIE = $totalesIngresosIngEg->where('carteramovtype', 'EGRESO')->where('caja', $this->caja);
            //operacion auxiliar para deducion de tigo money

            $this->operaciones();
        } else {
            if ($this->sucursal != 'TODAS') {
                //Totales Ingresos Ventas


                $this->totalesIngresosV = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                    ->join('carteras as c', 'c.id', 'crms.cartera_id')
                    ->join('cajas as ca', 'ca.id', 'c.caja_id')
                    ->join('users as u', 'u.id', 'movimientos.user_id')
                    ->join('sales as s', 's.movimiento_id', 'movimientos.id')
                    ->select(
                        's.id as idventa',
                        'movimientos.import as importe',
                        'crms.type as carteramovtype',
                        'crms.tipoDeMovimiento',
                        'c.nombre as nombrecartera',
                        'c.descripcion',
                        'u.id as idusuario',
                        'c.tipo as ctipo',
                        'movimientos.created_at as movcreacion',
                        'movimientos.id as idmov',
                        'ca.sucursal_id',
                        DB::raw('0 as detalle'),
                        DB::raw('0 as utilidadventa')
                    )
                    ->where('crms.type', 'INGRESO')
                    ->where('crms.tipoDeMovimiento', 'VENTA')
                    ->where('movimientos.status', 'ACTIVO')
                    ->where('s.sucursal_id', $this->sucursal)
                    ->orderBy('movimientos.created_at', 'asc')
                    ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                    ->get();

                foreach ($this->totalesIngresosV as $val) {
                    $vs = $this->listardetalleventas($val->idventa);
                    $val->detalle = $vs;
                    $val->utilidadventa = $this->utilidadventa($val->idventa);
                }

                //Totales Ingresos (EGRESOS/INGRESOS)

                $IngresosEgresos =  Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                    ->join('carteras as c', 'c.id', 'crms.cartera_id')
                    ->join('cajas as ca', 'ca.id', 'c.caja_id')
                    ->join('users as u', 'u.id', 'movimientos.user_id')
                    ->select(
                        'movimientos.import as importe',
                        'crms.type as carteramovtype',
                        'crms.tipoDeMovimiento',
                        'crms.comentario as coment',
                        'c.nombre as nombrecartera',
                        'c.descripcion',
                        'c.tipo as ctipo',
                        'c.telefonoNum',
                        'movimientos.created_at as movcreacion',
                        'movimientos.id as idmov',
                        DB::raw('0 as sucursal')
                    )->where('movimientos.status', 'ACTIVO')
                    ->where('crms.tipoDeMovimiento', 'EGRESO/INGRESO')
                    ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                    ->orderBy('movimientos.created_at', 'asc')
                    ->get();

                foreach ($IngresosEgresos as $val) {

                    $val->sucursal = $this->sucursaloperacion($val->idmov);
                }

                $this->totalesIngresosIE = $IngresosEgresos->where('carteramovtype', 'INGRESO')->where('sucursal',$this->sucursal);

                //TOTALES EGRESOS
                $this->totalesEgresosIE = $IngresosEgresos->where('carteramovtype', 'EGRESO')->where('sucursal',$this->sucursal);



                //Totales Egresos Ventas
                $this->totalesEgresosV = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                    ->join('carteras as c', 'c.id', 'crms.cartera_id')
                    ->join('cajas as ca', 'ca.id', 'c.caja_id')
                    ->join('users as u', 'u.id', 'movimientos.user_id')
                    ->join('devolution_sales as ds', 'ds.movimiento_id', 'movimientos.id')
                    ->select(
                        'ds.id as idds',
                        'movimientos.import as importe',
                        'crms.type as carteramovtype',
                        'crms.tipoDeMovimiento',
                        'c.nombre as nombrecartera',
                        'c.descripcion',
                        'c.tipo as ctipo',
                        'movimientos.created_at as movcreacion',
                        'movimientos.id as idmov'
                    )
                    ->where('movimientos.status', 'ACTIVO')
                    ->where('crms.type', 'EGRESO')
                    ->where('crms.tipoDeMovimiento', 'VENTA')
                    ->where('ca.sucursal_id', $this->sucursal)
                    ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                    ->orderBy('movimientos.created_at', 'asc')
                    ->get();

                $this->operaciones();
            } else {

                //Totales Ingresos Ventas
                $this->totalesIngresosV = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                    ->join('carteras as c', 'c.id', 'crms.cartera_id')
                    ->join('cajas as ca', 'ca.id', 'c.caja_id')
                    ->join('users as u', 'u.id', 'movimientos.user_id')
                    ->join('sales as s', 's.movimiento_id', 'movimientos.id')
                    ->select(
                        's.id as idventa',
                        'movimientos.import as importe',
                        'crms.type as carteramovtype',
                        'crms.tipoDeMovimiento',
                        'c.nombre as nombrecartera',
                        'c.descripcion',
                        'c.tipo as ctipo',
                        'movimientos.created_at as movcreacion',
                        'movimientos.id as idmov',
                        DB::raw('0 as detalle'),
                        DB::raw('0 as utilidadventa')
                    )
                    ->where('movimientos.status', 'ACTIVO')
                    ->where('crms.type', 'INGRESO')
                    ->where('crms.tipoDeMovimiento', 'VENTA')
                    ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                    ->orderBy('movimientos.created_at', 'asc')
                    ->get();
                foreach ($this->totalesIngresosV as $val) {
                    $vs = $this->listardetalleventas($val->idventa);
                    $val->detalle = $vs;
                    $val->utilidadventa = $this->utilidadventa($val->idventa);
                }

                //Totales Ingresos (EGRESOS/INGRESOS)
                $IngresosIE = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                    ->join('carteras as c', 'c.id', 'crms.cartera_id')
                    ->join('cajas as ca', 'ca.id', 'c.caja_id')
                    ->join('users as u', 'u.id', 'movimientos.user_id')
                    ->select(
                        'movimientos.import as importe',
                        'crms.type as carteramovtype',
                        'crms.tipoDeMovimiento',
                        'crms.comentario as coment',
                        'c.nombre as nombrecartera',
                        'c.descripcion',
                        'c.tipo as ctipo',
                        'c.telefonoNum',
                        'movimientos.created_at as movcreacion',
                        'movimientos.id as idmov'
                    )
                    ->where('movimientos.status', 'ACTIVO')

                    ->where('crms.tipoDeMovimiento', 'EGRESO/INGRESO')
                    ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                    ->orderBy('movimientos.created_at', 'asc')
                    ->get();

                $this->totalesIngresosIE = $IngresosIE->where('carteramovtype', 'INGRESO');
                $this->totalesEgresosIE = $IngresosIE->where('carteramovtype', 'EGRESO');
                $this->operaciones();
            }
        }
    }
    //Lista los detalles de una venta
    public function listardetalleventas($idventa)
    {
        $listadetalles = SaleDetail::join('sales as s', 's.id', 'sale_details.sale_id')
            ->join("products as p", "p.id", "sale_details.product_id")
            ->select(
                'sale_details.id as detalleid',
                'p.nombre as nombre',
                'sale_details.price as pv',
                'sale_details.original_price as po',
                'sale_details.quantity as cant'
            )
            ->where('sale_details.sale_id', $idventa)
            ->orderBy('sale_details.id', 'asc')
            ->get();
        return $listadetalles;
        //dd($this->listadetalles);
    }
    public function utilidadventa($idventa)
    {
        $auxi = 0;
        $utilidad = 0;


        $salelist = SaleDetail::where('sale_id', $idventa)->get();
        foreach ($salelist as $data) {
            $sl = SaleLote::where('sale_detail_id', $data->id)->get();
            foreach ($sl as $data2) {
                $lot = Lote::where('id', $data2->lote_id)->value('costo');
                $auxi = $data->price * $data2->cantidad - $lot * $data2->cantidad;
                $utilidad = $utilidad + $auxi;
                //dd($lot);
            }
        }

        return $utilidad;
    }


    public function operaciones()
    {
        //Totales carteras tipo Caja Fisica
        $this->ingresosTotalesCF = $this->totalesIngresosV->where('ctipo', 'efectivo')
            ->sum('importe') + $this->totalesIngresosIE->where('ctipo', 'efectivo')->sum('importe');

        //Totales carteras tipo No Caja Fisica CON BANCOS

        $this->ingresosTotalesBancos = $this->totalesIngresosV->where('ctipo', 'digital')->sum('importe') +
            $this->totalesIngresosIE->where('ctipo', 'digital')->sum('importe');
        //dd($this->ingresosTotalesNoCFBancos);
        $this->ingresos_totales = $this->ingresosTotalesCF + $this->ingresosTotalesBancos;

        //Total Utilidad Ventas y Servicios
        $this->totalutilidadSV = $this->totalesIngresosV->sum('utilidadventa') + $this->totalesIngresosIE->sum('importe');

        //Total Egresos

        $this->EgresosTotales = $this->totalesEgresosV->sum('importe') + $this->totalesEgresosIE->sum('importe');

        // egresos totales por caja fisica
        $this->EgresosTotalesCF = $this->totalesEgresosV->where('ctipo', 'efectivo')->sum('importe') + $this->totalesEgresosIE->where('ctipo', 'efectivo')->sum('importe');

        $this->saldo = $this->ingresosTotalesCF + $this->ingresosTotalesBancos - $this->EgresosTotalesCF;

        $this->total_efectivo = $this->ingresosTotalesCF - $this->EgresosTotalesCF;

        //Ingresos - Egresos
        $this->subtotalcaja = $this->subtotalesIngresos - $this->EgresosTotalesCF;
        if ($this->caja != "TODAS") {
            $ingresos = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('ca.id', $this->caja)
                ->where('movimientos.status', 'ACTIVO')
                ->where('crms.type', 'INGRESO')
                ->where('movimientos.created_at', '<', Carbon::parse($this->fromDate)->toDateTimeString())
                ->sum('movimientos.import');
            $egresos = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('ca.id', $this->caja)
                ->where('movimientos.status', 'ACTIVO')
                ->where('crms.type', 'EGRESO')
                ->where('movimientos.created_at', '<', Carbon::parse($this->fromDate)->toDateTimeString())
                ->sum('movimientos.import');
            $this->saldo_acumulado = $ingresos - $egresos;
        } else {
            $ingresos = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('ca.sucursal_id', $this->sucursal)
                ->where('movimientos.status', 'ACTIVO')
                ->where('crms.type', 'INGRESO')
                ->where('movimientos.created_at', '<', Carbon::parse($this->fromDate)->toDateTimeString())
                ->sum('movimientos.import');
            $egresos = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('ca.sucursal_id', $this->sucursal)
                ->where('movimientos.status', 'ACTIVO')
                ->where('crms.type', 'EGRESO')
                ->where('movimientos.created_at', '<', Carbon::parse($this->fromDate)->toDateTimeString())
                ->sum('movimientos.import');
            $this->saldo_acumulado = $ingresos - $egresos;
        }




        if ($this->caja != "TODAS") {
            $this->op_recaudo =  Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('movimientos.status', 'ACTIVO')
                ->where('crms.tipoDeMovimiento', 'RECAUDO')

                ->where('ca.id', $this->caja)

                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->sum('movimientos.import');


            $this->operacionfalt = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('movimientos.status', 'ACTIVO')
                ->where('ca.id', '=', $this->caja)
                ->where('crms.tipoDeMovimiento', 'FALTANTE')
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->sum('movimientos.import');

            $this->operacionsob = Movimiento::join('cartera_movs as cr', 'cr.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'cr.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('movimientos.status', 'ACTIVO')
                ->where('ca.id', $this->caja)
                ->where('cr.tipoDeMovimiento', 'SOBRANTE')
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])

                ->sum('movimientos.import');

            //Calculo de ajustes entre ingresos y egresos
            $total_ajustes = Movimiento::join('cartera_movs as cr', 'cr.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'cr.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('movimientos.status', 'ACTIVO')
                ->where('ca.id', $this->caja)
                ->where('cr.tipoDeMovimiento', 'AJUSTE')
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])->get();

            $ajustes_ingresos =  $total_ajustes->where('type', 'INGRESO')->sum('import');

            $ajustes_egresos = $total_ajustes->where('type', 'EGRESO')->sum('import');

            $this->ajustes = $ajustes_ingresos - $ajustes_egresos;
        } else {
            $this->op_recaudo = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('movimientos.status', 'ACTIVO')
                ->where('crms.tipoDeMovimiento', 'RECAUDO')
                ->where('ca.sucursal_id', $this->sucursal)

                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->sum('movimientos.import');



            $this->operacionfalt = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('movimientos.status', 'ACTIVO')
                ->where('ca.sucursal_id', $this->sucursal)
                ->where('crms.tipoDeMovimiento', 'FALTANTE')
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->sum('movimientos.import');

            $this->operacionsob = Movimiento::join('cartera_movs as cr', 'cr.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'cr.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('movimientos.status', 'ACTIVO')
                ->where('ca.sucursal_id', $this->sucursal)
                ->where('cr.tipoDeMovimiento', 'SOBRANTE')
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])

                ->sum('movimientos.import');


            //Calculo de ajustes entre ingresos y egresos por sucursal
            $total_ajustes = Movimiento::join('cartera_movs as cr', 'cr.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'cr.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('movimientos.status', 'ACTIVO')
                ->where('ca.sucursal_id', $this->sucursal)
                ->where('cr.tipoDeMovimiento', 'AJUSTE')
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])->get();

            $ajustes_ingresos =  $total_ajustes->where('type', 'INGRESO')->sum('import');

            $ajustes_egresos = $total_ajustes->where('type', 'EGRESO')->sum('import');

            $this->ajustes = $ajustes_ingresos - $ajustes_egresos;
        }


        $this->operacionesW = $this->ops;

        if ($this->caja == 'TODAS') {
            if ($this->sucursal == 'TODAS') {

                $this->operacionesZ = Caja::join('carteras', 'carteras.caja_id', 'cajas.id')
                    ->where('cajas.nombre', '!=', 'Caja General')
                    ->sum('carteras.saldocartera');
            } else {
                $this->operacionesZ = Caja::join('carteras', 'carteras.caja_id', 'cajas.id')
                    ->where('cajas.nombre', '!=', 'Caja General')
                    ->where('sucursal_id', $this->sucursal)
                    ->sum('carteras.saldocartera');
            }
        } else {

            $caja = Caja::find($this->caja);

            $this->operacionesZ = $caja->carteras->where('tipo', 'efectivo')->first()->saldocartera;
        }
    }

    public function saldo_acumulado($fecha, $sucursal, $caja)
    {


        $fechainicial = Carbon::parse('2015-01-01')->format('Y-m-d') . ' 00:00:00';

        if ($caja != 'TODAS') {
            $carteras = Cartera::where('carteras.tipo', 'efectivo')
                ->where('caja_id', $caja)
                ->select('id', 'nombre', 'descripcion', DB::raw('0 as monto'))->get();
        } else {
            if ($sucursal != 'TODAS') {
                $carteras = Cartera::join('cajas', 'cajas.id', 'carteras.caja_id')
                    ->where('carteras.tipo', 'efectivo')
                    ->where('cajas.sucursal_id', $sucursal)
                    ->select('carteras.id as id', DB::raw('0 as monto'))
                    ->get();
            } else {
                $carteras = Cartera::where('carteras.tipo', 'efectivo')
                    ->select('id', 'nombre', 'descripcion', DB::raw('0 as monto'))
                    ->get();
            }
        }



        foreach ($carteras as $c) {
            /* SUMAR TODO LOS INGRESOS DE LA CARTERA */
            $MONTO = Cartera::join('cartera_movs as cm', 'carteras.id', 'cm.cartera_id')
                ->join('movimientos as m', 'm.id', 'cm.movimiento_id')
                ->where('cm.type', 'INGRESO')
                ->where('m.status', 'ACTIVO')
                ->whereBetween('m.created_at', [$fechainicial, $fecha])
                ->where('carteras.id', $c->id)
                ->sum('m.import');
            /* SUMAR TODO LOS EGRESOS DE LA CARTERA */
            $MONTO2 = Cartera::join('cartera_movs as cm', 'carteras.id', 'cm.cartera_id')
                ->join('movimientos as m', 'm.id', 'cm.movimiento_id')
                ->where('cm.type', 'EGRESO')
                ->where('m.status', 'ACTIVO')
                ->whereBetween('m.created_at', [$fechainicial, $fecha])
                ->where('carteras.id', $c->id)->sum('m.import');
            /* REALIZAR CALCULO DE INGRESOS - EGRESOS */

            $c->monto = $MONTO - $MONTO2;
        }

        $this->ops = $carteras->sum('monto');
    }

    //Obtener el Id de la Sucursal Donde esta el Usuario
    public function obtenersucursal()
    {
        $idsucursal = User::join("sucursal_users as su", "su.user_id", "users.id")
            ->select("su.sucursal_id as id", "users.name as n")
            ->where("users.id", Auth()->user()->id)
            ->where("su.estado", "ACTIVO")
            ->get()
            ->first();
        $this->sucursal = $idsucursal->id;
    }



    public function resetUI()
    {
        $this->cartera_id = null;
        $this->cantidad = null;
        $this->comentario = null;
    }

    public function generarpdf($totalesIngresosV, $totalesIngresosS, $totalesIngresosIE, $totalesEgresosV, $totalesEgresosIE, $ingresosTotalesBancos, $operacionsob, $operacionfalt)
    {
        session(['totalIngresosV' => $totalesIngresosV]);
        session(['totalIngresosS' => $totalesIngresosS]);
        session(['totalIngresosIE' => $totalesIngresosIE]);
        session(['totalEgresosV' => $totalesEgresosV]);
        session(['totalEgresosIE' => $totalesEgresosIE]);

        session(['ingresosTotalesBancos' => $ingresosTotalesBancos]);
        session(['operacionsob' => $operacionsob]);
        session(['operacionfalt' => $operacionfalt]);




        session(['ingresosTotalesCF' => $this->ingresosTotalesCF]); //
        session(['subtotalesIngresos' => $this->subtotalesIngresos]); //
        // session(['ingresosTotalesNoCFBancos' => $this->ingresosTotalesNoCFBancos]);
        session(['op_recaudo' => $this->op_recaudo]); //
        session(['total' => $this->total]);
        session(['subtotalcaja' => $this->subtotalcaja]);
        // session(['operacionesefectivas' => $this->operacionesefectivas]);
        session(['ops' => $this->ops]);
        session(['operacionesW' => $this->operacionesW]);
        session(['EgresosTotales' => $this->EgresosTotales]);
        session(['totalutilidadSV' => $this->totalutilidadSV]);
        session(['EgresosTotalesCF' => $this->EgresosTotalesCF]);

        session(['total' => $this->total]);

        session(['operacionesZ' => $this->operacionesZ]);

        //Sucursal, Caja, Fecha de Inicio y Fecha de Fin
        $caracteristicas = array($this->sucursal, $this->caja, $this->fromDate, $this->toDate);
        session(['caracteristicas' => $caracteristicas]);



        $this->emit('opentap');
    }

    public function cajaoperacion($movimiento)
    {

        $mov = Movimiento::find($movimiento);


        $caja_abierta = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
            ->join('carteras', 'carteras.id', 'cartera_movs.cartera_id')
            ->join('cajas', 'cajas.id', 'carteras.caja_id')
            ->where('movimientos.type', 'APERTURA')
            ->where('movimientos.status', 'ACTIVO')
            ->where('movimientos.user_id', $mov->user_id)
            ->where('movimientos.created_at', '<', Carbon::parse($mov->created_at)->toDateTimeString())
            ->select('cajas.id')
            ->value('cajas.id');

        if ($caja_abierta != null) {
            return $caja_abierta;
        } else {
            $sd = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
                ->join('carteras', 'carteras.id', 'cartera_movs.cartera_id')
                ->join('cajas', 'cajas.id', 'carteras.caja_id')
                ->where('movimientos.type', 'APERTURA')
                ->where('movimientos.user_id', $mov->user_id)
                ->where('movimientos.created_at', '<', Carbon::parse($mov->created_at)->toDateTimeString())
                ->where('movimientos.updated_at', '>', Carbon::parse($mov->created_at)->toDateTimeString())
                ->select('cajas.id')
                ->value('cajas.id');
            return $sd;
        }
    }

    public function sucursaloperacion($mov)
    {
        $mov = Movimiento::find($mov);
        $caja_abierta = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
            ->join('carteras', 'carteras.id', 'cartera_movs.cartera_id')
            ->join('cajas', 'cajas.id', 'carteras.caja_id')
            ->where('movimientos.type', 'APERTURA')
            ->where('movimientos.status', 'ACTIVO')
            ->where('movimientos.user_id', $mov->user_id)
            ->where('movimientos.created_at', '<', Carbon::parse($mov->created_at)->toDateTimeString())
            ->select('cajas.sucursal_id')
            ->value('cajas.sucursal_id');

        if ($caja_abierta != null) {
            return $caja_abierta;
        } else {
            $sd = Movimiento::join('cartera_movs', 'cartera_movs.movimiento_id', 'movimientos.id')
                ->join('carteras', 'carteras.id', 'cartera_movs.cartera_id')
                ->join('cajas', 'cajas.id', 'carteras.caja_id')
                ->where('movimientos.type', 'APERTURA')
                ->where('movimientos.user_id', $mov->user_id)
                ->where('movimientos.created_at', '<', Carbon::parse($mov->created_at)->toDateTimeString())
                ->where('movimientos.updated_at', '>', Carbon::parse($mov->created_at)->toDateTimeString())
                ->select('cajas.sucursal_id')
                ->value('cajas.sucursal_id');
            return $sd;
        }
   
    }
}