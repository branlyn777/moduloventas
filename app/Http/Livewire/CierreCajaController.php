<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\Movimiento;
use Livewire\Component;

class CierreCajaController extends Component
{
    public $idcaja,$nombrecaja,$usuarioApertura,$diezcent,$veintecent,$cinccent,$peso,$peso2,$peso5,$billete10,$billete20,$billete50,$billete100,$billete200,$total;


    public function mount($id){
        $this->idcaja = Caja::where('id',$id)->first()->id;
        $this->nombrecaja=Caja::where('id',$id)->first()->nombre;
//         $this->diezcent=0;
// $this->veintecent=0;
// $this->cinccent=0;
// $this->peso=0;
// $this->peso2=0;
// $this->peso5=0;
// $this->billete10=0;
// $this->billete20=0;
// $this->billete50=0;
// $this->billete100=0;
// $this->billete200=0;

        
    }
    public function render()
    {
        
        $this->total=(int)$this->diezcent*0.1+(int)$this->veintecent*0.2+(int)$this->cinccent*0.5+
        (int)$this->peso*1+(int)$this->peso2*2+(int)$this->peso5*5+(int)$this->billete10*10
        +(int)$this->billete20*20+(int)$this->billete50*50+(int)$this->billete100*100+(int)$this->billete200*200;
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

    // public function tool()
    // {
    //     if
    // }
}
