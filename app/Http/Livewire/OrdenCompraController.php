<?php

namespace App\Http\Livewire;

use App\Models\Destino;
use App\Models\DetalleOrdenCompra;
use App\Models\OrdenCompra;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrdenCompraController extends Component
{
    public $sucursal_id,
    $estado,
    $fecha,
    $fromDate,
    $toDate,
    $from,
    $to,
    $vs=[], 
    $data_orden_compras,
    $ordendetalle,
    $totalitems=0,
    $ordenTotal=0,
    $observacion='',
    $mensaje_toast,
    $listasucursales;
   
    public function mount(){
        
        $this->sucursal_id = $this->idsucursal();
        $this->estado='Todos';
        //dd($this->sucursal_id);
    }
    public function render()
    {
        $this->consultar();
        $this->data_orden_compras= OrdenCompra::join('destinos','destinos.id','orden_compras.destino_id')
        ->whereBetween('orden_compras.created_at',[$this->from,$this->to])
        ->when($this->estado != 'Todos', function($query){
            return $query->where('orden_compras.status',$this->estado);
        })
        ->when($this->sucursal_id != 'Todos', function($query){
  
            return $query->where('destinos.sucursal_id',$this->sucursal_id);
         
        })
        ->get();


       
        $this->listasucursales=Sucursal::all();
     
        //dd($this->listasucursales);
 
        return view('livewire.ordencompra.orden-compra')
        ->extends('layouts.theme.app')
        ->section('content');
    }

    
    public function verPermisos(){
       
        $ss= Destino::pluck('codigo_almacen','id');
     
        foreach ($ss as $key=>$value) {
            if ($value!=null) {
          
                if (Auth::user()->hasPermissionTo($value)) {
                    
                    array_push($this->vs,$key);
                }
            }
            }
        
    }

    public function VerDetalleCompra(OrdenCompra $id){
      
        $this->ordenTotal=$id->importe_total;
        $this->totalitems=$id->detallecompra()->sum('cantidad');
        $this->observacion=$id->observacion;
    
        $this->ordendetalle= $id->detallecompra()->get();

        $this->emit('verDetalle');


   
        //dd($this->detalleCompra);
    }
     
    public function anularOrden(OrdenCompra $id){

      $id->update([
            'status' =>'INACTIVO'
      ]);
      $this->mensaje_toast='OrdenCompra de compra anulada con exito.';
      $this->emit('anulacion_compra');
    }

    public function consultar()
    {
        if ($this->fecha == 'hoy') {
            $this->fromDate = Carbon::now();
            $this->toDate = Carbon::now();
            $this->from = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
            $this->to = Carbon::parse($this->toDate)->format('Y-m-d')     . ' 23:59:59';
        }
        if ($this->fecha == 'ayer') {

            $this->fromDate = Carbon::yesterday();
            $this->toDate = Carbon::yesterday();
            $this->from = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
            $this->to = Carbon::parse($this->toDate)->format('Y-m-d')     . ' 23:59:59';
        }
        if ($this->fecha == 'semana') 
        {   $this->toDate = Carbon::now();
            $this->fromDate = $this->toDate->subWeeks(1);
            $this->from = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
            $this->to = Carbon::parse(Carbon::now())->format('Y-m-d')     . ' 23:59:59';
        }

        else{
            $this->from = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
            $this->to = Carbon::parse($this->toDate)->format('Y-m-d')     . ' 23:59:59';
        }
  
    }

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
}
