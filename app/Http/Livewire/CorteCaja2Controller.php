<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\Movimiento;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CorteCaja2Controller extends Component
{
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {

    }
    public function render()
    {

        $caja_especial = Caja::find(1);

        $cajas = Caja::join("sucursals as s","s.id","cajas.sucursal_id")
        ->select("cajas.nombre as nombre","cajas.estado as estado","s.name as nombresucursal")
        ->where("cajas.sucursal_id", $this->idsucursal())
        ->where("cajas.id", "<>" ,1)
        ->get();

        return view('livewire.cortecaja2.cortecaja', [
            'cajas' => $cajas,
            'caja_especial' => $caja_especial
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }



    //Obtener el Id de la Sucursal donde esta el Usuario
    public function idsucursal()
    {
        $idsucursal = User::join("sucursal_users as su","su.user_id","users.id")
        ->select("su.sucursal_id as id","users.name as n")
        ->where("users.id",Auth()->user()->id)
        ->where("su.estado","ACTIVO")
        ->get()
        ->first();
        return $idsucursal->id;
    }

    protected $listeners = [
        'corte-caja' => 'CorteCaja'
    ];

    public function CorteCaja($idcaja)
    {
        /* PONER EN INACTIVO TODOS LOS MOVIMIENTOS DE CIERRE DEL USUARIO */
        $cortes = Movimiento::where('status', 'ACTIVO')
            ->where('type', 'CIERRE')
            ->where('user_id', Auth()->user()->id)->get();
        foreach ($cortes as $c)
        {
            $c->update([
                'status' => 'INACTIVO',
            ]);
            $c->save();
        }
        /*  CREAR MOVIMIENTOS DE APERTURA CON ESTADO ACTIVO POR CADA CARTERA */
        $carteras = Cartera::where('caja_id', $idcaja)->get();
        foreach ($carteras as $c)
        {
            $movimiento = Movimiento::create([
                'type' => 'APERTURA',
                'status' => 'ACTIVO',
                'import' => 0,
                'user_id' => Auth()->user()->id
            ]);
            CarteraMov::create([
                'type' => 'APERTURA',
                'tipoDeMovimiento' => 'CORTE',
                'comentario' => '',
                'cartera_id' => $c->id,
                'movimiento_id' => $movimiento->id,
            ]);
        }
        /* DESABILITAR CAJA */
        $caja = Caja::find($idcaja);
        $caja->update([
            'estado' => 'Abierto',
        ]);
        $caja->save();


        session(['sesionCaja' => $caja->nombre]);
        session(['sesionCajaID' => $caja->id]);

        $this->emit('message-success-toast');
    }

}
