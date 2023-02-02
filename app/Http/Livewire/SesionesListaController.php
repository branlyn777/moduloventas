<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SesionesListaController extends Component
{
    public $sucursal,$aperturas_cierres,$caja,$sm,$fromDate,$toDate;

    
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


   

        if ($this->caja!= 'TODAS') {
        
            $this->aperturas_cierres= Caja::join('carteras','carteras.caja_id','cajas.id')
            ->join('cartera_movs','cartera_movs.cartera_id','carteras.id')
            ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
            ->join('users','users.id','movimientos.user_id')
            ->where('cartera_movs.type','APERTURA')
            ->where('cajas.id',$this->caja)
            ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
            ->select('movimientos.created_at as apertura','movimientos.updated_at as cierre','cartera_movs.id','users.name','movimientos.status')
            ->get();
         
        }
        else{
            $this->aperturas_cierres= Caja::join('carteras','carteras.caja_id','cajas.id')
            ->join('cartera_movs','cartera_movs.cartera_id','carteras.id')
            ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
            ->join('users','users.id','movimientos.user_id')
            ->where('cartera_movs.type','APERTURA')
            ->where('cajas.sucursal_id',$this->sucursal)
            ->whereBetween('movimientos.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
            ->select('movimientos.created_at as apertura','movimientos.updated_at as cierre','cartera_movs.id','users.name','movimientos.status')
            ->get();    
        }



        return view('livewire.sesionescaja.sesioneslista',[
            'carterasSucursal' => $carterasSucursal,
            'sucursales' => $sucursals,
            'cajas' => $cajab

        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
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
}
