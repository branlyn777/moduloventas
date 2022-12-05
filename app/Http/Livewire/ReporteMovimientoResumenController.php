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
        $ventas, $servicios, $ingresoEgreso, $totalesIngresosVGeneral, $Banco;

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
        } else 
        {
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
            ->select('carteras.id', 'carteras.nombre as carteraNombre', 'c.nombre as cajaNombre', 'c.id as cid', 'c.monto_base', 'carteras.tipo as tipo', 
            DB::raw('0 as monto'))->get();


        $this->allop(Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', $this->sucursal, $this->caja);
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
            $this->operacionEnCajaGeneral();
            //dd($this->ventas);
            //Totales Ingresos Ventas

            $this->totalesIngresosV = new \Illuminate\Database\Eloquent\Collection;
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
                    DB::raw('0 as utilidadventa')
                )
                ->where('movimientos.status', 'ACTIVO')
                ->where('crms.type', 'INGRESO')
                ->where('crms.tipoDeMovimiento', 'VENTA')
                ->where('ca.id', $this->caja)
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->where('movimientos.status', 'ACTIVO')
                ->orderBy('movimientos.created_at', 'asc')
                ->get();

            $this->totalesIngresosVGeneral =  Movimiento::join('cartera_movs as crms','crms.movimiento_id','movimientos.id')
                ->join('operaciones_carteras_compartidas','crms.id','operaciones_carteras_compartidas.cartera_mov_id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca','ca.id','c.caja_id')
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
                ->where('crms.tipoDeMovimiento','VENTA')
                ->where('operaciones_carteras_compartidas.caja_id',$this->caja)
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->orderBy('movimientos.created_at', 'asc')
                ->get();

            $this->totalesIngresosV = $this->totalesIngresosV->concat($totalesIngresosVentas)->concat($this->totalesIngresosVGeneral);



            //dd($this->totalesIngresosV);
            //*dd($idusuarios);


            foreach ($this->totalesIngresosV as $val) {
                $vs = $this->listardetalleventas($val->idventa);

                $val->detalle = $vs;
            }

            foreach ($this->totalesIngresosV as $var) {
                $var->utilidadventa = $this->utilidadventa($var->idventa);
            }

            //Totales Ingresos Servicios


            $this->totalesIngresosS = new \Illuminate\Database\Eloquent\Collection;

            $totalesIngresosServicios = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->join('mov_services as ms', 'ms.movimiento_id', 'movimientos.id')
                ->join('services as ser', 'ser.id', 'ms.service_id')
                ->join('cat_prod_services as cps', 'cps.id', 'ser.cat_prod_service_id')
                ->select('ser.order_service_id as idordenservicio',
                    'movimientos.import as importe',
                    'ser.solucion as solucion',
                    'cps.nombre as nombrecategoria',
                    'crms.type as carteramovtype',
                    'crms.tipoDeMovimiento',
                    'c.nombre as nombrecartera',
                    'c.descripcion',
                    'c.tipo as ctipo',
                    'c.telefonoNum',
                    'movimientos.created_at as movcreacion',
                    'movimientos.id as idmov',
                    DB::raw('0 as utilidadservicios'))
                ->where('movimientos.status', 'ACTIVO')
                ->where('crms.type', 'INGRESO')
                //->where('crms.comentario', '<>', 'RECAUDO DEL DIA')
                ->where('crms.tipoDeMovimiento', '!=', 'TIGOMONEY')
                ->where('crms.tipoDeMovimiento', '!=', 'STREAMING')
                ->where('crms.tipoDeMovimiento', '!=', 'VENTA')
                ->where('crms.tipoDeMovimiento', '!=', 'EGRESO/INGRESO')
                ->where('ca.id', $this->caja)
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->orderBy('movimientos.created_at', 'asc')
                ->get();

            //dd($totalesIngresosServicios);

            $totalesIngresosServiciosGeneral = OperacionesCarterasCompartidas::join('cartera_movs as crms', 'crms.id', 'operaciones_carteras_compartidas.cartera_mov_id')
            ->join('carteras as c', 'c.id', 'crms.cartera_id')
            ->join('movimientos','movimientos.id','crms.movimiento_id')
            ->join('users as u','u.id','movimientos.user_id')
            ->join('sales as s', 's.movimiento_id', 'movimientos.id')
            ->select('s.id as idventa',
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
                DB::raw('0 as utilidadventa'))
            ->where('crms.tipoDeMovimiento','SERVICIOS')
            ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
            ->where('movimientos.status', 'ACTIVO')
            ->where('operaciones_carteras_compartidas.caja_id',$this->caja)
            ->orderBy('movimientos.created_at', 'asc')
            ->get();



            $this->totalesIngresosS = $this->totalesIngresosS->concat($totalesIngresosServicios)->concat($totalesIngresosServiciosGeneral);

            foreach ($this->totalesIngresosS as $var1) {
                $var1->utilidadservicios = $this->utilidadservicio($var1->idmov);
            }

            //Totales Ingresos (EGRESOS/INGRESOS)
            $this->totalesIngresosIE = new \Illuminate\Database\Eloquent\Collection;
            $totalesIngresosIngEg = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->select('movimientos.import as importe',
                    'crms.type as carteramovtype',
                    'crms.tipoDeMovimiento',
                    'crms.comentario as coment',
                    'c.nombre as nombrecartera',
                    'c.descripcion',
                    'c.tipo as ctipo',
                    'c.telefonoNum',
                    'movimientos.created_at as movcreacion',
                    'movimientos.id as idmov')
                ->where('movimientos.status', 'ACTIVO')
                ->where('crms.tipoDeMovimiento', 'EGRESO/INGRESO')
                ->where('ca.id', $this->caja)
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->orderBy('movimientos.created_at', 'asc')
                ->get();



            $totalesIngresosIngEgGeneral = Movimiento::join('cartera_movs as crms','crms.movimiento_id','movimientos.id')
            ->join('operaciones_carteras_compartidas','crms.id','operaciones_carteras_compartidas.cartera_mov_id')
            ->join('carteras as c', 'c.id', 'crms.cartera_id')
            ->join('cajas as ca','ca.id','c.caja_id')
            ->select('movimientos.import as importe',
                'crms.type as carteramovtype',
                'crms.tipoDeMovimiento',
                'crms.comentario as coment',
                'c.nombre as nombrecartera',
                'c.descripcion',
                'c.tipo as ctipo',
                'movimientos.created_at as movcreacion',
                'movimientos.id as idmov')
            ->where('crms.tipoDeMovimiento','EGRESO/INGRESO')
            ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
            ->where('movimientos.status', 'ACTIVO')
            ->where('operaciones_carteras_compartidas.caja_id',$this->caja)
            ->orderBy('movimientos.created_at', 'asc')
            ->get();




            $this->totalesIngresosIE = $this->totalesIngresosIE->concat($totalesIngresosIngEg->where('carteramovtype','INGRESO'))
            ->concat($totalesIngresosIngEgGeneral->where('carteramovtype','INGRESO'));

           //Totales Egresos (EGRESOS/INGRESOS)
            $this->totalesEgresosIE = new \Illuminate\Database\Eloquent\Collection;



            $this->totalesEgresosIE = $this->totalesEgresosIE->concat($totalesIngresosIngEg->where('carteramovtype','EGRESO'))
            ->concat($totalesIngresosIngEgGeneral->where('carteramovtype','EGRESO'));

            $this->trsbydatecaja();

            //operacion auxiliar para deducion de tigo money

            $this->operaciones();
        } else {
            if ($this->sucursal != 'TODAS') {
                //Totales Ingresos Ventas

                //$this->operacionEnCajaGeneral($this->sucursal);
                $this->totalesIngresosV = new \Illuminate\Database\Eloquent\Collection;

                // dd($this->ventas);
                $totalesIngresosVentas = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                    ->join('carteras as c', 'c.id', 'crms.cartera_id')
                    ->join('cajas as ca', 'ca.id', 'c.caja_id')
                    ->join('users as u', 'u.id', 'movimientos.user_id')
                    ->join('sales as s', 's.movimiento_id', 'movimientos.id')
                 
                    ->select('s.id as idventa',
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
                    )->where('movimientos.status', 'ACTIVO')
                    ->where('crms.type', 'INGRESO')
                    ->where('crms.tipoDeMovimiento', 'VENTA')
                    ->where('ca.sucursal_id', $this->sucursal)
                    ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                    ->where('ca.id','<>','1')
                    ->orderBy('movimientos.created_at', 'asc')
                    ->get();

                $totalesIngresosVGeneral=Movimiento::join('cartera_movs as crms','crms.movimiento_id','movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('operaciones_carteras_compartidas','crms.id','operaciones_carteras_compartidas.cartera_mov_id')
                ->join('cajas as ca','ca.id','c.caja_id')
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
                ->where('crms.tipoDeMovimiento','VENTA')
                ->where('ca.sucursal_id',$this->sucursal)
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->orderBy('movimientos.created_at', 'asc')
                ->get();

                $this->totalesIngresosV = $this->totalesIngresosV->concat($totalesIngresosVentas)->concat($totalesIngresosVGeneral);
               // dd($this->totalesIngresosV);

                foreach ($this->totalesIngresosV as $val) {
                    $vs = $this->listardetalleventas($val->idventa);
                    $val->detalle = $vs;
                }

                foreach ($this->totalesIngresosV as $var) {
                    $var->utilidadventa = $this->utilidadventa($var->idventa);
                }

                //Totales Ingresos Servicios
                $this->totalesIngresosS = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                    ->join('carteras as c', 'c.id', 'crms.cartera_id')
                    ->join('cajas as ca', 'ca.id', 'c.caja_id')
                    ->join('users as u', 'u.id', 'movimientos.user_id')
                    ->join('mov_services as ms', 'ms.movimiento_id', 'movimientos.id')
                    ->join('services as ser', 'ser.id', 'ms.service_id')
                    ->join('cat_prod_services as cps', 'cps.id', 'ser.cat_prod_service_id')
                    ->select('ser.order_service_id as idordenservicio',
                        'movimientos.import as importe',
                        'ser.solucion as solucion',
                        'cps.nombre as nombrecategoria',
                        'crms.type as carteramovtype',
                        'crms.tipoDeMovimiento',
                        'c.nombre as nombrecartera',
                        'c.descripcion',
                        'c.tipo as ctipo',
                        'c.telefonoNum',
                        'movimientos.created_at as movcreacion',
                        'movimientos.id as idmov',
                        DB::raw('0 as utilidadservicios'))
                    ->where('movimientos.status','ACTIVO')
                    ->where('crms.type', 'INGRESO')
                    ->where('crms.comentario', '<>', 'RECAUDO DEL DIA')
                    ->where('crms.tipoDeMovimiento', '!=', 'TIGOMONEY')
                    ->where('crms.tipoDeMovimiento', '!=', 'STREAMING')
                    ->where('crms.tipoDeMovimiento', '!=', 'VENTA')
                    ->where('crms.tipoDeMovimiento', '!=', 'EGRESO/INGRESO')
                    ->where('ca.sucursal_id', $this->sucursal)
                    ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                    ->orderBy('movimientos.created_at', 'asc')
                    ->get();

                foreach ($this->totalesIngresosS as $var1) {
                    $var1->utilidadservicios = $this->utilidadservicio($var1->idmov);
                }




                //Totales Ingresos (EGRESOS/INGRESOS)

                $IngresosEgresos=  Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
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
                )->where('movimientos.status', 'ACTIVO')
                ->where('crms.tipoDeMovimiento', 'EGRESO/INGRESO')
                ->where('ca.sucursal_id', $this->sucursal)
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->orderBy('movimientos.created_at', 'asc')
                ->get();

                $this->totalesIngresosIE = $IngresosEgresos->where('carteramovtype','INGRESO');

                //TOTALES EGRESOS
                $this->totalesEgresosIE = $IngresosEgresos->where('carteramovtype','EGRESO');



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


                $this->trsbydatesucursal();
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
                }

                foreach ($this->totalesIngresosV as $var) {
                    $var->utilidadventa = $this->utilidadventa($var->idventa);
                }

                //Totales Ingresos Servicios
                $this->totalesIngresosS = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                    ->join('carteras as c', 'c.id', 'crms.cartera_id')
                    ->join('cajas as ca', 'ca.id', 'c.caja_id')
                    ->join('users as u', 'u.id', 'movimientos.user_id')
                    ->join('mov_services as ms', 'ms.movimiento_id', 'movimientos.id')
                    ->join('services as ser', 'ser.id', 'ms.service_id')
                    ->join('cat_prod_services as cps', 'cps.id', 'ser.cat_prod_service_id')
                    ->select(
                        'ser.order_service_id as idordenservicio',
                        'movimientos.import as importe',
                        'ser.solucion as solucion',
                        'cps.nombre as nombrecategoria',
                        'crms.tipoDeMovimiento',
                        'c.nombre as nombrecartera',
                        'c.descripcion',
                        'c.tipo as ctipo',
                        'c.telefonoNum',
                        'movimientos.created_at as movcreacion',
                        'movimientos.id as idmov',
                        DB::raw('0 as utilidadservicios')
                    )
                    ->where('movimientos.status', 'ACTIVO')
                    ->where('crms.type', 'INGRESO')
                    ->where('crms.tipoDeMovimiento', '=', 'SERVICIOS')
                    ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                    ->orderBy('movimientos.created_at', 'asc')
                    ->get();

                foreach ($this->totalesIngresosS as $var1) {
                    $var1->utilidadservicios = $this->utilidadservicio($var1->idmov);
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

                    $this->totalesIngresosIE= $IngresosIE->where('carteramovtype','INGRESO');
                    $this->totalesEgresosIE= $IngresosIE->where('carteramovtype','EGRESO');

                //TOTALES EGRESOS

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
                    ->where('crms.comentario', '<>', 'RECAUDO DEL DIA')
                    ->where('crms.tipoDeMovimiento', 'VENTA')
                    ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                    ->orderBy('movimientos.created_at', 'asc')
                    ->get();




                $this->trsbydatetodos();
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
                'p.nombre as nombre',
                'sale_details.price as pv',
                'p.precio_venta as po',
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
        foreach ($salelist as $data) 
        {
            $sl = SaleLote::where('sale_detail_id', $data->id)->get();
            foreach ($sl as $data2) 
            {
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
        $this->subtotalesIngresos = $this->totalesIngresosV->sum('importe') + $this->totalesIngresosS->sum('importe') + $this->totalesIngresosIE->sum('importe');
        //Totales carteras

        /* Sumando la suma de la columna de importación en las tablas totalesIngresosV, totalesIngresosS y
     totalesIngresosIE. */
        $this->ingresosTotales = $this->totalesIngresosV->sum('importe') + $this->totalesIngresosS->sum('importe') + $this->totalesIngresosIE->sum('importe');



        //Totales carteras tipo Caja Fisica
        $this->ingresosTotalesCF = $this->totalesIngresosV->where('ctipo', 'efectivo')->sum('importe') + $this->totalesIngresosS->where('ctipo', 'efectivo')->sum('importe') + $this->totalesIngresosIE->where('ctipo', 'efectivo')->sum('importe');

        //Totales carteras tipo No Caja Fisica CON BANCOS

        $this->ingresosTotalesNoCFBancos = $this->totalesIngresosV->where('ctipo', 'Banco')->sum('importe') + $this->totalesIngresosS->where('ctipo', 'Banco')->sum('importe') + $this->totalesIngresosIE->where('ctipo', 'Banco')->sum('importe');
        //dd($this->ingresosTotalesNoCFBancos);

        //Total Utilidad Ventas y Servicios
        $this->totalutilidadSV = $this->totalesIngresosV->sum('utilidadventa') + $this->totalesIngresosS->sum('utilidadservicios');

        //Total Egresos

        $this->EgresosTotales = $this->totalesEgresosV->sum('importe') + $this->totalesEgresosIE->sum('importe');

        // egresos totales por caja fisica
        $this->EgresosTotalesCF = $this->totalesEgresosV->where('ctipo', 'CajaFisica')->sum('importe') + $this->totalesEgresosIE->where('ctipo', 'CajaFisica')->sum('importe');
     
        //Ingresos - Egresos
        $this->subtotalcaja = $this->subtotalesIngresos - $this->EgresosTotalesCF;

        $this->operacionesefectivas = $this->ingresosTotalesCF - $this->EgresosTotalesCF;

        if ($this->caja != "TODAS") {
            $this->op_recaudo =  Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->where('movimientos.status', 'ACTIVO')
                ->where('crms.type', 'EGRESO')
                ->where('crms.comentario', '=', 'RECAUDO DEL DIA')
                ->where('ca.id', $this->caja)
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->select('movimientos.import')->value('movimientos.import');
        } else {
            $this->op_recaudo = 0;
        }
        $this->op_sob_falt = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
            ->join('carteras as c', 'c.id', 'crms.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->where('movimientos.status', 'ACTIVO')
            ->where('ca.id', '=', $this->caja)
            ->where(function ($query) {
                $query->where('crms.tipoDeMovimiento','SOBRANTE')
                    ->orWhere('crms.tipoDeMovimiento','FALTANTE');
            })
            //->where('ca.id',$this->caja)

            ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
            ->select('movimientos.import', 'crms.tipoDeMovimiento as tipo_sob_fal')->get();
        $auxi_s_f = 0;
        if (count($this->op_sob_falt)) {

            if ($this->op_sob_falt[0]->tipo_sob_fal == 'FALTANTE') {

                $auxi_s_f = $this->op_sob_falt[0]->import * -1;
            } else {
                $auxi_s_f = $this->op_sob_falt[0]->import;
            }
        }

        $this->operacionesW = $this->operacionesefectivas + $this->ops + $this->total;

        $this->operacionesZ =  $this->operacionesW - $this->op_recaudo + $auxi_s_f;
    }

    public function allop($fecha, $sucursal, $caja)
    {


        $fechainicial = Carbon::parse('2015-01-01')->format('Y-m-d') . ' 00:00:00';

        if ($caja != 'TODAS') {
            $carteras = Cartera::where('carteras.tipo', 'CajaFisica')
                ->where('caja_id', $caja)
                ->where('carteras.tipo', 'CajaFisica')
                ->select('id', 'nombre', 'descripcion', DB::raw('0 as monto'))->get();
        } else {
            if ($sucursal != 'TODAS') {
                $carteras = Cartera::join('cajas', 'cajas.id', 'carteras.caja_id')
                    ->where('carteras.tipo', 'CajaFisica')
                    ->where('cajas.sucursal_id', $sucursal)
                    ->select('carteras.id as id', DB::raw('0 as monto'))
                    ->get();
            } else {
                $carteras = Cartera::where('carteras.tipo', 'CajaFisica')
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

    public function GenerarR()
    {
        $carterarec = Cartera::where('carteras.caja_id', $this->cartera_id)->where('carteras.tipo', 'CajaFisica')->select('carteras.id')->value('carteras.id');

        if ($this->cartera_id != null || $this->cantidad != null) {

            $rules = [ /* Reglas de validacion */

                'cartera_id' => 'required|not_in:Elegir',
                'cantidad' => 'required|not_in:0'

            ];
            $messages = [ /* mensajes de validaciones */

                'cartera_id.required' => 'El tipo de cartera es requerido',
                'cartera_id.not_in' => 'Seleccione un valor distinto a Elegir',
                'cantidad.required' => 'Ingrese un monto válido',
                'cantidad.not_in' => 'Ingrese un monto válido',

            ];

            $this->validate($rules, $messages);

            $mvt = Movimiento::create([
                'type' => 'TERMINADO',
                'status' => 'ACTIVO',
                'import' => $this->cantidad,
                'user_id' => Auth()->user()->id,
            ]);

            CarteraMov::create([
                'type' => 'EGRESO',
                'tipoDeMovimiento' => 'RECAUDO',
                'comentario' => 'RECAUDO DEL DIA',
                'cartera_id' =>  $carterarec,
                'movimiento_id' => $mvt->id
            ]);
            $this->emit('hide-modalR', 'Se guardo el registro');
            $this->resetUI();
        }


        if ($this->diferenciaCaja != null || $this->montoDiferencia != null or $this->cartera_id2 != null) {
            $carterarec2 = Cartera::where('carteras.caja_id', $this->cartera_id2)->where('carteras.tipo', 'CajaFisica')->select('carteras.id')->value('carteras.id');
            $rules = [ /* Reglas de validacion */
                'cartera_id2' => 'required|not_in:Elegir',
                'diferenciaCaja' => 'not_in:Elegir',
                'montoDiferencia' => 'required|not_in:0',
                'obsDiferencia' => 'required',
            ];
            $messages = [ /* mensajes de validaciones */
                'cartera_id2.required' => 'El tipo de cartera es requerido',
                'cartera_id2.not_in' => 'Seleccione un valor distinto a Elegir',
                'diferenciaCaja.not_in' => 'Seleccione un valor distinto a Elegir',
                'montoDiferencia.required' => 'El monto de la diferenia es requerido',
                'montoDiferencia.not_in' => 'Ingrese un monto válido diferente de cero',
                'obsDiferencia.required' => 'Ingrese el motivo de la operacion.'

            ];

            $this->validate($rules, $messages);

            $mvt = Movimiento::create([
                'type' => 'TERMINADO',
                'status' => 'ACTIVO',
                'import' => $this->montoDiferencia,
                'user_id' => Auth()->user()->id,
            ]);

            CarteraMov::create([
                'type' => ($this->diferenciaCaja == 'SOBRANTE') ? 'INGRESO' : 'EGRESO',
                'tipoDeMovimiento' => $this->diferenciaCaja,
                'comentario' => $this->obsDiferencia,
                'cartera_id' =>  $carterarec2,
                'movimiento_id' => $mvt->id
            ]);
            $this->emit('hide-modalR', 'Se guardo el registro');
            $this->resetUI();
        }
    }
    public function viewDetailsR()
    {

        $this->emit('show-modalR', 'open modal');
    }
    public function resetUI()
    {
        $this->cartera_id = null;
        $this->cantidad = null;
        $this->comentario = null;
    }

    public function trsbydatecaja()
    {
        $from = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
        $to = Carbon::parse($this->toDate)->format('Y-m-d')     . ' 23:59:59';

        $ingresosTelefono = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'INGRESO')
            ->where('ori.nombre', 'Telefono')
            ->where('mot.tipo', 'Abono')
            ->where('m.status', 'Activo')
            ->where('ca.id', $this->caja)
            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $egresosTelefono = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'EGRESO')
            ->where('ori.nombre', 'Telefono')
            ->where('mot.tipo', 'Retiro')
            ->where('m.status', 'Activo')
            ->where('ca.id', $this->caja)
            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $this->telefono = $ingresosTelefono - $egresosTelefono;

        $ingresosSistema = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'INGRESO')
            ->where('ori.nombre', 'Sistema')
            ->where('mot.tipo', 'Abono')
            ->where('m.status', 'Activo')
            ->where('ca.id', $this->caja)
            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $egresosSistema = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'EGRESO')
            ->where('ori.nombre', 'Sistema')
            ->where('mot.tipo', 'Retiro')
            ->where('m.status', 'Activo')
            ->where('ca.id', $this->caja)
            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $this->sistema = $ingresosSistema - $egresosSistema;

        if ($this->sistema > $this->telefono) {
            $this->total = $this->sistema + $this->telefono;
        } else {
            $this->total = $this->telefono + $this->sistema;
        }
    }
    public function trsbydatesucursal()
    {
        $from = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
        $to = Carbon::parse($this->toDate)->format('Y-m-d')     . ' 23:59:59';

        $ingresosTelefono = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'INGRESO')
            ->where('ori.nombre', 'Telefono')
            ->where('mot.tipo', 'Abono')
            ->where('m.status', 'Activo')
            ->where('s.id', $this->sucursal)

            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $egresosTelefono = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'EGRESO')
            ->where('ori.nombre', 'Telefono')
            ->where('mot.tipo', 'Retiro')
            ->where('m.status', 'Activo')
            ->where('s.id', $this->sucursal)

            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $this->telefono = $ingresosTelefono - $egresosTelefono;

        $ingresosSistema = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'INGRESO')
            ->where('ori.nombre', 'Sistema')
            ->where('mot.tipo', 'Abono')
            ->where('m.status', 'Activo')
            ->where('s.id', $this->sucursal)

            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $egresosSistema = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'EGRESO')
            ->where('ori.nombre', 'Sistema')
            ->where('mot.tipo', 'Retiro')
            ->where('m.status', 'Activo')
            ->where('s.id', $this->sucursal)

            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $this->sistema = $ingresosSistema - $egresosSistema;

        if ($this->sistema > $this->telefono) {
            $this->total = $this->sistema + $this->telefono;
        } else {
            $this->total = $this->telefono + $this->sistema;
        }
    }

    public function trsbydatetodos()
    {
        $from = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
        $to = Carbon::parse($this->toDate)->format('Y-m-d')     . ' 23:59:59';

        $ingresosTelefono = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'INGRESO')
            ->where('ori.nombre', 'Telefono')
            ->where('mot.tipo', 'Abono')
            ->where('m.status', 'Activo')

            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $egresosTelefono = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'EGRESO')
            ->where('ori.nombre', 'Telefono')
            ->where('mot.tipo', 'Retiro')
            ->where('m.status', 'Activo')

            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $this->telefono = $ingresosTelefono - $egresosTelefono;

        $ingresosSistema = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'INGRESO')
            ->where('ori.nombre', 'Sistema')
            ->where('mot.tipo', 'Abono')
            ->where('m.status', 'Activo')

            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $egresosSistema = Transaccion::join('mov_transacs as mt', 'mt.transaccion_id', 'transaccions.id')
            ->join('movimientos as m', 'm.id', 'mt.movimiento_id')
            ->join('cartera_movs as cmv', 'cmv.movimiento_id', 'm.id')
            ->join('carteras as c', 'c.id', 'cmv.cartera_id')
            ->join('cajas as ca', 'ca.id', 'c.caja_id')
            ->join('origen_motivos as om', 'transaccions.origen_motivo_id', 'om.id')
            ->join('origens as ori', 'ori.id', 'om.origen_id')
            ->join('motivos as mot', 'mot.id', 'om.motivo_id')
            ->join('sucursals as s', 's.id', 'ca.sucursal_id')
            ->where('cmv.tipoDeMovimiento', 'TIGOMONEY')
            ->where('cmv.type', 'EGRESO')
            ->where('ori.nombre', 'Sistema')
            ->where('mot.tipo', 'Retiro')
            ->where('m.status', 'Activo')

            ->whereBetween('transaccions.created_at', [$from, $to])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $this->sistema = $ingresosSistema - $egresosSistema;

        if ($this->sistema > $this->telefono) {
            $this->total = $this->sistema + $this->telefono;
        } else {
            $this->total = $this->telefono + $this->sistema;
        }
    }


    public function operacionrecaudo()
    {

        $from = date('2015-01-01');
        $to = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 23:59:59';

        $carteras2 = Cartera::join('cajas as c', 'carteras.caja_id', 'c.id')
            ->where('c.id', $this->cartera_id)
            ->where('carteras.tipo', '!=', 'Banco')
            ->where('carteras.tipo', '!=', 'TigoStreaming')
            ->select('carteras.id as idcartera', DB::raw('0 as monto'))->get();


        foreach ($carteras2 as $c2) {
            /* SUMAR TODO LOS INGRESOS DE LA CARTERA */

            $INGRESOS = Cartera::join('cartera_movs as cm', 'carteras.id', 'cm.cartera_id')
                ->join('movimientos as mov', 'mov.id', 'cm.movimiento_id')
                ->where('carteras.id', $c2->idcartera)
                ->where('cm.type', 'INGRESO')
                ->where('mov.status', 'ACTIVO')
                ->whereBetween('mov.created_at', [$from, $to])
                ->sum('mov.import');

            // dd($INGRESOS);


            /* SUMAR TODO LOS EGRESOS DE LA CARTERA */
            $EGRESOS = Cartera::join('cartera_movs as cm', 'carteras.id', 'cm.cartera_id')
                ->join('movimientos as mov', 'mov.id', 'cm.movimiento_id')
                ->where('carteras.id', $c2->idcartera)
                ->where('cm.type', 'EGRESO')
                ->where('mov.status', 'ACTIVO')
                ->whereBetween('mov.created_at', [$from, $to])
                ->sum('mov.import');

            /* REALIZAR CALCULO DE INGRESOS - EGRESOS */

            $c2->monto = $INGRESOS - $EGRESOS;
            //dd($c2->monto);
        }


        $this->optotal = $carteras2->sum('monto');
        $this->recaudo = $this->optotal - $this->sm->monto_base;
    }

    public function generarpdf($totalesIngresosV, $totalesIngresosS, $totalesIngresosIE, $totalesEgresosV, $totalesEgresosIE, $op_sob_falt)
    {
        session(['totalIngresosV' => $totalesIngresosV]);
        session(['totalIngresosS' => $totalesIngresosS]);
        session(['totalIngresosIE' => $totalesIngresosIE]);
        session(['totalEgresosV' => $totalesEgresosV]);
        session(['totalEgresosIE' => $totalesEgresosIE]);




        session(['ingresosTotalesCF' => $this->ingresosTotalesCF]); //
        session(['subtotalesIngresos' => $this->subtotalesIngresos]); //
        session(['ingresosTotalesNoCFBancos' => $this->ingresosTotalesNoCFBancos]); //
        session(['op_recaudo' => $this->op_recaudo]); //
        session(['total' => $this->total]);
        session(['subtotalcaja' => $this->subtotalcaja]);
        session(['operacionesefectivas' => $this->operacionesefectivas]);
        session(['ops' => $this->ops]);
        session(['operacionesW' => $this->operacionesW]);
        session(['EgresosTotales' => $this->EgresosTotales]);
        session(['totalutilidadSV' => $this->totalutilidadSV]);
        session(['EgresosTotalesCF' => $this->EgresosTotalesCF]);




        //Sobrante o Faltante
        session(['op_sob_falt' => $op_sob_falt]);

        //$this->operacionesZ
        session(['operacionesZ' => $this->operacionesZ]);

        //Sucursal, Caja, Fecha de Inicio y Fecha de Fin
        $caracteristicas = array($this->sucursal, $this->caja, $this->fromDate, $this->toDate);
        session(['caracteristicas' => $caracteristicas]);



        $this->emit('opentap');
    }

    public function operacionEnCajaGeneral($id = 0)
    {
        $this->Banco = [];

        //dump($this->Banco);
        $this->ventas = [];
        $this->servicios = [];
        $this->ingresoEgreso = [];

        if ($id != 0) {
            $consulta = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->where('ca.sucursal_id', $id)
                ->where('movimientos.type', 'APERTURA')
                ->where('c.tipo', 'CajaFisica')
                //->whereBetween('movimientos.created_at',[ Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00',Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->select('movimientos.*', 'ca.nombre', 'c.tipo')
                ->orderBy('movimientos.created_at', 'desc')
                ->get();
        } else {
            $consulta = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->where('ca.id', $this->caja)
                ->where('movimientos.type', 'APERTURA')
                ->where('c.tipo', 'CajaFisica')
                //->whereBetween('movimientos.created_at',[ Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00',Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->select('movimientos.*', 'ca.nombre', 'c.tipo')
                ->orderBy('movimientos.created_at', 'desc')
                ->get();
        }


        foreach ($consulta as $data) {
            if ($data->created_at == $data->created_at) {

                $ls = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                    ->join('carteras as c', 'c.id', 'crms.cartera_id')
                    ->join('cajas as ca', 'ca.id', 'c.caja_id')
                    ->join('users as u', 'u.id', 'movimientos.user_id')
                    ->where('ca.id', 1)
                    ->where('movimientos.user_id', $data->user_id)
                    ->where('movimientos.created_at', '>', $data->created_at)
                    ->select('movimientos.*', 'c.tipo', 'crms.tipoDeMovimiento')
                    ->get();
                $ls = $ls->whereBetween('created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59']);
                //dump($ls);
                foreach ($ls as $value) {


                    if (!in_array($value->id, $this->Banco)) {
                        array_push($this->Banco, $value->id);
                    }
                }

                $vent = $ls->where('tipoDeMovimiento', 'VENTA')->pluck('id');
                foreach ($vent as $dvent) {
                    array_push($this->ventas, $dvent);
                }
                $serv = $ls->where('tipoDeMovimiento', 'SERVICIOS')->pluck('id');
                foreach ($serv as $dserv) {
                    array_push($this->servicios, $dserv);
                }
                $ing = $ls->where('tipoDeMovimiento', 'EGRESO/INGRESO')->pluck('id');
                foreach ($ing as $ding) {
                    array_push($this->ingresoEgreso, $ding);
                }

                //dump("primero",$ls);
                //dump("ventas",$this->ventas);

            }
            //dd($consulta);



            $ls = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras as c', 'c.id', 'crms.cartera_id')
                ->join('cajas as ca', 'ca.id', 'c.caja_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->where('ca.id', 1)
                ->where('movimientos.user_id', $data->user_id)
                ->whereBetween('movimientos.created_at', [$data->created_at, $data->created_at])
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->select('movimientos.id', 'c.tipo', 'movimientos.import', 'crms.tipoDeMovimiento')
                ->get();

            // dump($data);
            foreach ($ls as $value) {

                if (!in_array($value->id, $this->Banco)) {
                    array_push($this->Banco, $value->id);
                }
            }
            //dump($this->Banco);


            //dump($vent);
            $vent = $ls->where('tipoDeMovimiento', 'VENTA')->pluck('id');

            foreach ($vent as $daven) {
                array_push($this->ventas, $daven);
            }
            $serv = $ls->where('tipoDeMovimiento', 'SERVICIOS')->pluck('id');
            foreach ($serv as $daserv) {
                array_push($this->servicios, $daserv);
            }
            $ing = $ls->where('tipoDeMovimiento', 'EGRESO/INGRESO')->pluck('id');
            foreach ($ing as $daing) {
                array_push($this->ingresoEgreso, $daing);
            }
        }

        $this->sumaBanco = Movimiento::whereIn('movimientos.id', $this->Banco)->where('movimientos.status', 'ACTIVO')->sum('movimientos.import');
    }
}
