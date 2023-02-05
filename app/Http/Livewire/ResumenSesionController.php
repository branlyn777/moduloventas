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

    public $apertura,$cierre,$movimiento,$totalesIngresosV,$totalesIngresosIE,$totalesEgresosIE,$sobrante,$faltante,$cierremonto,$total,$caja;
    public function mount($id){
      //se recibe el id de cartera movimiento
        $this->cartera_mov=CarteraMov::find($id);
       
        $this->movimiento=Movimiento::where('id',$this->cartera_mov->movimiento_id)->first();
        $this->caja= $this->cartera_mov->cartera->caja->id;


        $this->apertura=$this->movimiento->created_at;
        $this->cierre=$this->movimiento->updated_at;
        if ($this->movimiento->status=='ACTIVO') {
            $this->cierremonto='--';
       
        }
        else{
            $this->cierremonto=CarteraMov::join('movimientos','cartera_movs.movimiento_id','movimientos.id')
            ->where('cartera_movs.cartera_id',$this->cartera_mov->cartera_id)
            ->where('cartera_movs.type','CIERRE')
            ->where('movimientos.created_at','>',$this->apertura)
            ->first()->import;
        }
    }
 
    
    public function render()
    {
    
        if ($this->movimiento->status=='ACTIVO') {
       
            $this->totalesIngresosV = collect();
            $ventas_efect=Cartera::join('cartera_movs','cartera_movs.cartera_id','carteras.id')
            ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
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
                DB::raw('0 as utilidadventa'))
            ->where('carteras.id',$this->cartera_mov->first()->cartera_id)
            ->where('cartera_movs.tipoDeMovimiento','VENTA')
            ->where('movimientos.status', 'ACTIVO')
            ->where('movimientos.created_at', '>',Carbon::parse($this->apertura)->toDateTimeString())
            ->orderBy('movimientos.created_at', 'asc')
            ->get();
            foreach ($ventas_efect as $val) {
                $vs = $this->listardetalleventas($val->idventa);
    
                
                $val->detalle = $vs;
            }
    
            foreach ($ventas_efect as $var) {
                $var->utilidadventa = $this->utilidadventa($var->idventa);
            }


            //Ventas por medios digitales

            $ventas_dig=Cartera::join('cartera_movs','cartera_movs.cartera_id','carteras.id')
            ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
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
                DB::raw('0 as utilidadventa'))
            ->where('cartera_movs.tipoDeMovimiento','VENTA')
            ->where('carteras.caja_id',1)
            ->where('movimientos.status','ACTIVO')
            ->where('u.id',$this->movimiento->user_id)
            ->where('movimientos.created_at', '>',Carbon::parse($this->apertura)->toDateTimeString())
            ->get();

            foreach ($ventas_dig as $val) {
                $vs = $this->listardetalleventas($val->idventa);
    
                $val->detalle = $vs;
            }
    
            foreach ($ventas_dig as $var) {
                $var->utilidadventa = $this->utilidadventa($var->idventa);
            }

            $this->totalesIngresosV = $this->totalesIngresosV->concat($ventas_efect)->concat($ventas_dig);







            $this->totalesIngresosIE = collect();
            $totalesIngresosIng = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
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
                ->where('crms.type', 'INGRESO')
                ->where('c.id',$this->cartera_mov->first()->cartera_id)
                ->where('movimientos.created_at', '>',Carbon::parse($this->apertura)->toDateTimeString())
            
                ->orderBy('movimientos.created_at', 'asc')
                ->get();

                $ing_dig=Cartera::join('cartera_movs','cartera_movs.cartera_id','carteras.id')
                ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
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
                    DB::raw('0 as utilidadventa'))
                ->where('cartera_movs.tipoDeMovimiento', 'EGRESO/INGRESO')
                ->where('cartera_movs.type', 'INGRESO')
                ->where('carteras.caja_id',1)
                ->where('movimientos.status','ACTIVO')
                ->where('u.id',$this->movimiento->user_id)
                ->where('movimientos.created_at', '>',Carbon::parse($this->apertura)->toDateTimeString())
                ->get();


            $this->totalesIngresosIE = $this->totalesIngresosIE->concat($totalesIngresosIng)
            ->concat($ing_dig);

            //Calculo de egresos en efectivo

           $this->totalesEgresosIE=Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
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
           ->where('crms.type', 'EGRESO')
           ->where('c.id',$this->cartera_mov->first()->cartera_id)
           ->where('movimientos.created_at', '>',Carbon::parse($this->apertura)->toDateTimeString())
           ->orderBy('movimientos.created_at', 'asc')
           ->get();

           $this->sobrante=Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                        ->join('carteras','carteras.id','crms.cartera_id')
                        ->where('crms.tipoDeMovimiento','SOBRANTE')
                        ->where('movimientos.created_at', '>',Carbon::parse($this->apertura)->toDateTimeString())
                        ->where('carteras.id',$this->cartera_mov->first()->cartera_id)
                        ->sum('import');
                        
           $this->faltante=Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                        ->join('carteras','carteras.id','crms.cartera_id')
                        ->where('crms.tipoDeMovimiento','FALTANTE')
                        ->where('movimientos.created_at', '>',Carbon::parse($this->apertura)->toDateTimeString())
                        ->where('carteras.id',$this->cartera_mov->first()->cartera_id)
                        ->sum('import');

                        $this->trsbydateabierto();

        } else {
       
            $this->totalesIngresosV = collect();
            $ventas_efect=Cartera::join('cartera_movs','cartera_movs.cartera_id','carteras.id')
            ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
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
                DB::raw('0 as utilidadventa'))
            ->where('carteras.id',$this->cartera_mov->first()->cartera_id)
            ->where('cartera_movs.tipoDeMovimiento','VENTA')
            ->where('movimientos.status', 'ACTIVO')
            ->whereBetween('movimientos.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
            ->orderBy('movimientos.created_at', 'asc')
            ->get();
            foreach ($ventas_efect as $val) {
                $vs = $this->listardetalleventas($val->idventa);
    
                
                $val->detalle = $vs;
            }
    
            foreach ($ventas_efect as $var) {
                $var->utilidadventa = $this->utilidadventa($var->idventa);
            }

//Ventas por medios digitales

            $ventas_dig=Cartera::join('cartera_movs','cartera_movs.cartera_id','carteras.id')
            ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
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
                DB::raw('0 as utilidadventa'))
            ->where('cartera_movs.tipoDeMovimiento','VENTA')
            ->where('carteras.caja_id',1)
            ->where('movimientos.status','ACTIVO')
            ->where('u.id',$this->movimiento->user_id)
            ->whereBetween('movimientos.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
            ->get();
            foreach ($ventas_dig as $val) {
                $vs = $this->listardetalleventas($val->idventa);
    
                $val->detalle = $vs;
            }
    
            foreach ($ventas_dig as $var) {
                $var->utilidadventa = $this->utilidadventa($var->idventa);
            }

            $this->totalesIngresosV = $this->totalesIngresosV->concat($ventas_efect)->concat($ventas_dig);

            //Calculo de ingresos y egresos

            $this->totalesIngresosIE = collect();
            $totalesIngresosIng = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
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
                ->where('crms.type', 'INGRESO')
                ->where('c.id',$this->cartera_mov->first()->cartera_id)
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
            
                ->orderBy('movimientos.created_at', 'asc')
                ->get();

                $ing_dig=Cartera::join('cartera_movs','cartera_movs.cartera_id','carteras.id')
                ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
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
                    DB::raw('0 as utilidadventa'))
                ->where('cartera_movs.tipoDeMovimiento', 'EGRESO/INGRESO')
                ->where('cartera_movs.type', 'INGRESO')
                ->where('carteras.caja_id',1)
                ->where('movimientos.status','ACTIVO')
                ->where('u.id',$this->movimiento->user_id)
                ->whereBetween('movimientos.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
                ->get();


                    

            $this->totalesIngresosIE = $this->totalesIngresosIE->concat($totalesIngresosIng)
            ->concat($ing_dig);

            //Calculo de egresos en efectivo

           $this->totalesEgresosIE=Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
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
           ->where('crms.type', 'EGRESO')
           ->where('c.id',$this->cartera_mov->first()->cartera_id)
           ->whereBetween('movimientos.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
           ->orderBy('movimientos.created_at', 'asc')
           ->get();

           $this->sobrante=Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
           ->join('carteras','carteras.id','crms.cartera_id')
           ->where('crms.tipoDeMovimiento','SOBRANTE')
           ->whereBetween('movimientos.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
           ->where('carteras.id',$this->cartera_mov->first()->cartera_id)
           ->sum('import');
$this->faltante=Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
            ->join('carteras','carteras.id','crms.cartera_id')
           ->where('crms.tipoDeMovimiento','FALTANTE')
           ->whereBetween('movimientos.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
           ->where('carteras.id',$this->cartera_mov->first()->cartera_id)
           ->sum('import');

           $this->trsbydatecerrado();



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

    public function generarpdf($totalesIngresosV,$totalesIngresosIE,$totalesEgresosIE)
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

    public function trsbydatecerrado()
    {
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
            ->whereBetween('transaccions.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
   
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
            ->whereBetween('transaccions.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
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
            ->whereBetween('transaccions.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
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
            ->whereBetween('transaccions.created_at', [Carbon::parse($this->apertura)->toDateTimeString(), Carbon::parse($this->cierre)->toDateTimeString()])
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $this->sistema = $ingresosSistema - $egresosSistema;

        if ($this->sistema > $this->telefono) {
            $this->total = $this->sistema + $this->telefono;
        } else {
            $this->total = $this->telefono + $this->sistema;
        }
    }
    public function trsbydateabierto()
    {
   

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
            ->where('transaccions.created_at', '>',Carbon::parse($this->apertura)->toDateTimeString())
   
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
            ->where('transaccions.created_at', '>',Carbon::parse($this->apertura)->toDateTimeString())
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
            ->where('transaccions.created_at','>',Carbon::parse($this->apertura)->toDateTimeString())
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
            ->where('transaccions.created_at', '>',Carbon::parse($this->apertura)->toDateTimeString())
            ->orderBy('transaccions.id', 'desc')
            ->sum('m.import');

        $this->sistema = $ingresosSistema - $egresosSistema;

        if ($this->sistema > $this->telefono) {
            $this->total = $this->sistema + $this->telefono;
        } else {
            $this->total = $this->telefono + $this->sistema;
        }
    }
}
