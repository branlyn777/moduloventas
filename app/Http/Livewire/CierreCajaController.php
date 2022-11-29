<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\Movimiento;
use Livewire\Component;

class CierreCajaController extends Component
{
    public $idcaja,$nombrecaja;
    public function mount($id){
        //dd($id);
      

    }
    public function index()
    {
        $this->idcaja = Caja::where('id',$id)->first()->id;
        $this->nombrecaja=Caja::where('id',$id)->first()->nombre;
        return view('livewire.cajas.cierre-caja')
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function cerrarCaja(){
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
}
