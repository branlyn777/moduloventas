<?php

namespace App\Http\Livewire;

use App\Models\Destino;
use App\Models\DetalleOrdenCompra;
use App\Models\OrdenCompra;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrdenCompraController extends Component
{
    public $sucursal_id,
    $estado,
    $fecha,
    $fromDate,
    $vs=[], 
    $data_orden_compras,
    $ordendetalle,
    $totalitems=0,
    $ordenTotal=0,
    $observacion='',
   
    $toDate;
    public function mount(){
        $this->verPermisos();
    }
    public function render()
    {


        $this->data_orden_compras= OrdenCompra::where('status','Activo')->get();




        $this->sucursal_id= Auth()->user()->sucursal_id;
        $this->listasucursales=Sucursal::join('destinos as dest','sucursals.id','dest.sucursal_id')
        ->whereIn('dest.id',$this->vs)
        ->select('dest.*','dest.id as destino_id','sucursals.*')
        ->get();
        return view('livewire.ordencompra.orden-compra')
        ->extends('layouts.theme.app')
        ->section('content');
    }

    
    public function verPermisos(){
       
        $ss= Destino::select('destinos.id','destinos.nombre')->get();
        $arr=[];
        foreach ($ss as $item){
            $arr[$item->nombre.'_'.$item->id]=($item->id);
        }

       foreach ($arr as $key => $value) {
        if (Auth::user()->hasPermissionTo($key)) {
            array_push($this->vs,$value);
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
}
