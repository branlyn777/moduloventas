<?php

namespace App\Http\Livewire;

use App\Models\Destino;
use App\Models\DetalleOrdenCompra;
use App\Models\OrdenCompra;
use App\Models\Sucursal;
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
        
        $this->consultar();
        $this->sucursal_id= Auth()->user()->sucursal_id;
    }
    public function render()
    {


        $this->data_orden_compras= OrdenCompra::whereBetween('orden_compras.created_at',[$this->from,$this->to])
        ->when($this->estado != 'Todos', function($query){
            return $query->where('orden_compras.status',$this->estado);
        })
        ->when($this->sucursal_id != 'Todos', function($query){
            $suc=Sucursal::find($this->sucursal_id);
            dd($suc);
            return $query->whereIn('orden_compras.destino_id',$suc->destinos);
        })->get();



        $this->verPermisos();
        $this->sucursal_id= Auth()->user()->sucursal_id;
        $this->listasucursales=Sucursal::all();
     
        //dd($this->listasucursales);
 
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
}
