<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\Movimiento;
use Carbon\Carbon;
use Livewire\Component;

class CierreCajaController extends Component
{
    public $idcaja,$nombrecaja,$usuarioApertura,$fechaApertura,$diezcent,$veintecent,$cinccent,$peso,$peso2,$peso5,$hoyTransacciones,
    $billete10,$billete20,$billete50,$billete100,$billete200,$total,$transacciondia,$caja,$efectivo_actual,$monto_limite,$recaudo,$showDiv;


    public function mount(Caja $id){
        $this->caja=$id;
        $this->idcaja = $id->id;
        $this->monto_limite=$id->monto_base;
       $this->showDiv=false;

    }
    public function render()
    {
        //Usuario que aperturo la caja

        $datosCaja=Caja::join('carteras as c', 'c.caja_id', 'cajas.id')
        ->join('cartera_movs as cartmovs', 'cartmovs.cartera_id', 'c.id')
        ->join('movimientos as m', 'm.id', 'cartmovs.movimiento_id')
        ->join('users as u', 'u.id', 'm.user_id')
        ->select('u.name as nombreusuario','m.created_at as movfecha')
        ->where('m.status', 'ACTIVO')
        ->where('m.type', 'APERTURA')
        ->where('cajas.id', $this->idcaja)
        ->get()
        ->first();

        //saldo cartera en efectivo hoy

        $ingresos= Caja::join('carteras as c', 'c.caja_id', 'cajas.id')
        ->join('cartera_movs as cartmovs', 'cartmovs.cartera_id', 'c.id')
        ->join('movimientos as m', 'm.id', 'cartmovs.movimiento_id')
        ->where('cajas.id', $this->idcaja)
        ->where('cartmovs.type','INGRESO')
        ->whereDay('m.created_at',Carbon::now()->format('d'))
        ->sum('m.import');
        $egresos=Caja::join('carteras as c', 'c.caja_id', 'cajas.id')
        ->join('cartera_movs as cartmovs', 'cartmovs.cartera_id', 'c.id')
        ->join('movimientos as m', 'm.id', 'cartmovs.movimiento_id')
        ->where('cajas.id', $this->idcaja)
        ->where('cartmovs.type','EGRESO')
        ->whereDay('m.created_at',Carbon::now()->format('d'))
        ->sum('m.import');

        $this->hoyTransacciones= $ingresos- $egresos;


        $this->saldoAcumulado= Caja::join('carteras as c', 'c.caja_id', 'cajas.id')
        ->where('cajas.id', $this->idcaja)
        ->where('c.tipo','efectivo')
        ->sum('c.saldocartera');



        

            $this->usuarioApertura= $datosCaja->nombreusuario;
            $this->fechaApertura= $datosCaja->movfecha;

        //Conteo de monedas y billetes 
        $this->total=(int)$this->diezcent*0.1+(int)$this->veintecent*0.2+(int)$this->cinccent*0.5+
        (int)$this->peso*1+(int)$this->peso2*2+(int)$this->peso5*5+(int)$this->billete10*10
        +(int)$this->billete20*20+(int)$this->billete50*50+(int)$this->billete100*100+(int)$this->billete200*200;

        //transacciones del dia en efectivo



        return view('livewire.cajas.cierrecaja')
                ->extends('layouts.theme.app')
                ->section('content');
    }

    public function cerrarCaja()
    {
        $cortes = Movimiento::where('status', 'ACTIVO')
            ->where('type', 'APERTURA')
            ->where('user_id', Auth()->user()->id)->get();
            foreach ($cortes as $c)
            {
                $c->update([
                    'status' => 'INACTIVO',
                ]);
                $c->save();
            }
            /* CREAR CORTES DE CIERRE CON ESTADO ACTIVO */
            $carteras = Cartera::where('caja_id', $this->idcaja)->get();
            foreach ($carteras as $cart)
            {
                $movimiento = Movimiento::create([
                    'type' => 'CIERRE',
                    'status' => 'ACTIVO',
                    'import' => 0,
                    'user_id' => Auth()->user()->id
                ]);
                CarteraMov::create([
                    'type' => 'CIERRE',
                    'tipoDeMovimiento' => 'CORTE',
                    'comentario' => '',
                    'cartera_id' => $cart->id,
                    'movimiento_id' => $movimiento->id,
                ]);
            }
            /* HABILITAR CAJA */
            $caja = Caja::find($this->idcaja);
            $caja->update([
                'estado' => 'Cerrado',
            ]);
            $caja->save();

            $this->nombre_caja = null;
            $this->id_caja = null;

            session(['sesionCaja' => null]);
            session(['sesionCajaID' => null]);

    }

    public function resetConteo(){
        $this->reset('diezcent',
        'veintecent',
        'cinccent',
        'peso',
        'peso2',
        'peso5',
        'billete10',
        'billete20',
        'billete50',
        'billete100',
        'billete200',
        'total');
    }
    public function aplicarConteo(){
            $this->efectivo_actual= number_format(round($this->total,2),2) ;
            $this->resetConteo();
            $this->emit('cerrarContador');
    }

    public function mostrar(){
       
        if ( $this->showDiv == true) {
          
            $this->showDiv=false;
        }
        else{
            $this->showDiv=true;
                }
    }

    

}
