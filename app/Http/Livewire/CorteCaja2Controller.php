<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\Movimiento;
use App\Models\Sucursal;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CorteCaja2Controller extends Component
{
    //Guarda el id de la sucursal
    public $idsucursal;
    //Guarda el nombre de una caja abierta (si existe)
    public $nombre_caja, $id_caja;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->idsucursal = $this->idsucursal();
        $this->nombre_caja = null;
        $this->id_caja = null;
    }
    public function render()
    {

        //Verifica  si existe alguna caja abierta en su sucursal


         /* Caja en la cual se encuentra el usuario */
         $cajausuario = Caja::join('sucursals as s', 's.id', 'cajas.sucursal_id')
         ->join('sucursal_users as su', 'su.sucursal_id', 's.id')
         ->join('carteras as car', 'cajas.id', 'car.caja_id')
         ->join('cartera_movs as cartmovs', 'car.id', 'cartmovs.cartera_id')
         ->join('movimientos as mov', 'mov.id', 'cartmovs.movimiento_id')
         ->select("cajas.nombre as nombre_caja","cajas.id as id_caja")
         ->where('cajas.id','<>', 1)
         ->where('mov.user_id', Auth()->user()->id)
         ->where('mov.status', 'ACTIVO')
         ->where('mov.type', 'APERTURA')
         ->get();
 
         if($cajausuario->count() > 0)
         {
            $this->nombre_caja = $cajausuario->first()->nombre_caja;
            $this->id_caja = $cajausuario->first()->id_caja;
         }
        
        

        if($this->idsucursal != "Todos")
        {
            $cajas = Caja::join("sucursals as s","s.id","cajas.sucursal_id")
            ->select("cajas.nombre as nombre","cajas.id as id","cajas.estado as estado","s.name as nombresucursal",DB::raw('0 as carteras'))
            ->where("cajas.sucursal_id", $this->idsucursal)
            ->where("cajas.id", "<>" ,1)
            ->get();
        }
        else
        {
            $cajas = Caja::join("sucursals as s","s.id","cajas.sucursal_id")
            ->select("cajas.nombre as nombre","cajas.id as id","cajas.estado as estado","s.name as nombresucursal",DB::raw('0 as carteras'))
            ->where("cajas.id", "<>" ,1)
            ->get();
        }

        foreach($cajas as $c)
        {
            $c->carteras = Cartera::where("carteras.caja_id",$c->id)->get();
        }



        


        //Obteniendo todas las sucursales activas
        $sucursales = Sucursal::where("sucursals.estado","ACTIVO")->get();

        return view('livewire.cortecaja2.cortecaja', [
            'cajas' => $cajas,
            'caja_especial' => Caja::find(1),
            'sucursales' => $sucursales,
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
        'corte-caja' => 'CorteCaja',
        'cerrar-caja' => 'CerrarCaja'
    ];

    public function CorteCaja($idcaja)
    {
        /* PONER EN INACTIVO TODOS LOS MOVIMIENTOS DE CIERRE DEL USUARIO */
        $cortes = Movimiento::where('status', 'ACTIVO')
            ->where('type', 'CIERRE')
            ->where('user_id', Auth()->user()->id)
            ->get();

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

        $carteras_generales = Cartera::where('carteras.caja_id', 1)->get();
        foreach ($carteras_generales as $cg)
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
                'cartera_id' => $cg->id,
                'movimiento_id' => $movimiento->id,
            ]);
        }

        /* DESABILITAR CAJA */
        $caja = Caja::find($idcaja);
        $caja->update([
            'estado' => 'Abierto',
        ]);
        $caja->save();

        $this->nombre_caja = $caja->nombre;

        session(['sesionCaja' => $caja->nombre]);
        session(['sesionCajaID' => $caja->id]);

        $this->emit('message-success-toast');
        
        $this->redirect('cortecajas2');
    }
    //Para cerrar la caja abierta por el mismo usuario
    public function CerrarCaja($idcaja)
    {
         /* PONER EN INACTIVO TODOS LOS MOVIMIENTOS DE APERTURA DEL USUARIO */
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
        $carteras = Cartera::where('caja_id', $idcaja)->get();
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
        $caja = Caja::find($idcaja);
        $caja->update([
            'estado' => 'Cerrado',
        ]);
        $caja->save();

        $this->nombre_caja = "nada";

        session(['sesionCaja' => null]);
        session(['sesionCajaID' => null]);

        $this->emit('message-success-toast');

        $this->redirect('cortecajas2');
    }
    //Para cerrar la caja abierta por otro usuario
    public function CerrarCajaUsuario($idcaja)
    {









         /* PONER EN INACTIVO TODOS LOS MOVIMIENTOS DE APERTURA DEL USUARIO */
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
        $carteras = Cartera::where('caja_id', $idcaja)->get();
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
        $caja = Caja::find($idcaja);
        $caja->update([
            'estado' => 'Cerrado',
        ]);
        $caja->save();

        $this->nombre_caja = "nada";

        // session(['sesionCaja' => null]);
        // session(['sesionCajaID' => null]);

        $this->emit('message-success-toast');

        $this->redirect('cortecajas2');
    }

}
