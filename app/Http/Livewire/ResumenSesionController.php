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

class ResumenSesionController extends Component
{
    public $cartera_mov;

    public $apertura, $cierre, $apertura_monto, $movimiento, $usuario, $totalsesion, $totalesServicios, $operacionestigo, $totalesIngresosV, $totalesIngresosIE, $totalesEgresosIE, $sobrante, $faltante, $cierremonto, $total, $caja;
    public function mount($id)
    {
        //se recibe el id de cartera movimiento
        $this->cartera_mov = CarteraMov::find($id);

        $this->movimiento = Movimiento::where('id', $this->cartera_mov->movimiento_id)->first();
        $this->caja = $this->cartera_mov->cartera->caja->id;
        $this->usuario = $this->movimiento->user_id;
        $this->nombre_usuario = User::find($this->usuario)->name;


        $this->apertura = $this->movimiento->created_at;


        $this->cierre = $this->movimiento->updated_at == $this->movimiento->created_at ? 'Sesion Activa' : $this->movimiento->updated_at;
        if ($this->movimiento->status == 'ACTIVO') {
            $this->cierremonto = 0;
        } else {
            $this->cierremonto = CarteraMov::join('movimientos', 'cartera_movs.movimiento_id', 'movimientos.id')
                ->where('cartera_movs.cartera_id', $this->cartera_mov->cartera_id)
                ->where('cartera_movs.type', 'CIERRE')
                ->where('movimientos.created_at', '>', $this->apertura)
                ->first()->import;
        }
    }


    public function render()
    {
        if ($this->movimiento->status == 'ACTIVO') {
            /*si la caja esta abierta*/

            $this->totalesIngresosV = Cartera::join('cartera_movs', 'cartera_movs.cartera_id', 'carteras.id')
                ->join('movimientos', 'movimientos.id', 'cartera_movs.movimiento_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->join('sales as s', 's.movimiento_id', 'movimientos.id')
                ->select(
                    's.id as idventa',
                    'movimientos.import as importe',
                    'cartera_movs.tipoDeMovimiento',
                    'carteras.nombre as nombrecartera',
                    'u.id as idusuario',
                    'carteras.tipo as ctipo',
                    'movimientos.created_at as movcreacion',
                    DB::raw('0 as detalle'),
                    DB::raw('0 as utilidadventa')
                )
                ->where('u.id', $this->usuario)
                ->where('cartera_movs.tipoDeMovimiento', 'VENTA')
                ->where('movimientos.status', 'ACTIVO')
                ->where('movimientos.created_at', '>', Carbon::parse($this->apertura)->toDateTimeString())
                ->orderBy('movimientos.created_at', 'asc')
                ->get();
            foreach ($this->totalesIngresosV as $val) {
                $vs = $this->listardetalleventas($val->idventa);
                $val->detalle = $vs;
            }
            foreach ($this->totalesIngresosV as $var) {
                $var->utilidadventa = $this->utilidadventa($var->idventa);
            }



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
                ->where('u.id', $this->usuario)
                ->where('movimientos.created_at', '>', Carbon::parse($this->apertura)->toDateTimeString())
                ->orderBy('movimientos.created_at', 'asc')
                ->get();




            $this->totalesIngresosIE = $IngresosEgresos->where('carteramovtype', 'INGRESO');

            //TOTALES EGRESOS
            $this->totalesEgresosIE = $IngresosEgresos->where('carteramovtype', 'EGRESO');





            $this->sobrante = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras', 'carteras.id', 'crms.cartera_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->where('crms.tipoDeMovimiento', 'SOBRANTE')
                ->where('movimientos.created_at', '>', Carbon::parse($this->apertura)->toDateTimeString())
                ->where('u.id', $this->usuario)
                ->sum('import');

            $this->faltante = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras', 'carteras.id', 'crms.cartera_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->where('crms.tipoDeMovimiento', 'FALTANTE')
                ->where('movimientos.created_at', '>', Carbon::parse($this->apertura)->toDateTimeString())
                ->where('u.id', $this->usuario)
                ->sum('import');

            $this->totalsesion = $this->totalesIngresosV->sum('importe') + $this->totalesIngresosIE->sum('importe') - $this->totalesEgresosIE->sum('importe') - $this->faltante + $this->sobrante + $this->movimiento->import;
        } else {

            $this->totalesIngresosV = Cartera::join('cartera_movs', 'cartera_movs.cartera_id', 'carteras.id')
                ->join('movimientos', 'movimientos.id', 'cartera_movs.movimiento_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->join('sales as s', 's.movimiento_id', 'movimientos.id')
                ->select(
                    's.id as idventa',
                    'movimientos.import as importe',
                    'cartera_movs.tipoDeMovimiento',
                    'carteras.nombre as nombrecartera',
                    'u.id as idusuario',
                    'carteras.tipo as ctipo',
                    'movimientos.created_at as movcreacion',
                    DB::raw('0 as detalle'),
                    DB::raw('0 as utilidadventa')
                )
                ->where('u.id', $this->usuario)
                ->where('cartera_movs.tipoDeMovimiento', 'VENTA')
                ->where('movimientos.status', 'ACTIVO')
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])

                ->orderBy('movimientos.created_at', 'asc')
                ->get();
            foreach ($this->totalesIngresosV as $val) {
                $vs = $this->listardetalleventas($val->idventa);
                $val->detalle = $vs;
            }
            foreach ($this->totalesIngresosV as $var) {
                $var->utilidadventa = $this->utilidadventa($var->idventa);
            }






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
                ->where('u.id', $this->usuario)
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
                ->orderBy('movimientos.created_at', 'asc')
                ->get();




            $this->totalesIngresosIE = $IngresosEgresos->where('carteramovtype', 'INGRESO');

            //TOTALES EGRESOS
            $this->totalesEgresosIE = $IngresosEgresos->where('carteramovtype', 'EGRESO');




            $this->sobrante = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras', 'carteras.id', 'crms.cartera_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->where('crms.tipoDeMovimiento', 'SOBRANTE')
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
                ->where('u.id', $this->usuario)
                ->sum('import');

            $this->faltante = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                ->join('carteras', 'carteras.id', 'crms.cartera_id')
                ->join('users as u', 'u.id', 'movimientos.user_id')
                ->where('crms.tipoDeMovimiento', 'FALTANTE')
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
                ->where('u.id', $this->usuario)
                ->sum('import');

            $this->totalsesion = $this->totalesIngresosV->sum('importe') + $this->totalesIngresosIE->sum('importe') - $this->totalesEgresosIE->sum('importe') - $this->faltante + $this->sobrante + $this->movimiento->import;
        }







        return view('livewire.reportemovimientoresumen.resumensesion')
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function listardetalleventas($idventa)
    {
        $listadetalles = SaleDetail::join('sales as s', 's.id', 'sale_details.sale_id')
            ->join("products as p", "p.id", "sale_details.product_id")
            ->select(
                'sale_details.id as detalleid',
                'p.nombre as nombre',
                'sale_details.price as pv',
                DB::raw('0 as po'),
                'sale_details.quantity as cant'
            )
            ->where('sale_details.sale_id', $idventa)
            ->orderBy('sale_details.id', 'asc')
            ->get();




        foreach ($listadetalles as $dx) {
            $po = SaleLote::join("lotes as l", "l.id", "sale_lotes.lote_id")
                ->select("l.pv_lote as precio_original")
                ->where("sale_lotes.sale_detail_id", $dx->detalleid)
                ->first();

            $dx->po = $po->precio_original;
        }




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

    public function generarpdf($totalesIngresosV, $totalesIngresosIE, $totalesEgresosIE)
    {
        session(['totalesIngresosV' => $totalesIngresosV]);
        session(['totalesIngresosIE' => $totalesIngresosIE]);
        session(['totalesEgresosIE' => $totalesEgresosIE]);
        session(['movimiento' => $this->movimiento]);
        session(['sobrante' => $this->sobrante]);
        session(['faltante' => $this->faltante]);
        session(['cierremonto' => $this->cierremonto]);
        session(['total' => $this->total]);

        $this->emit('opentap');
    }
}
