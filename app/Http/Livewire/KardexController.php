<?php

namespace App\Http\Livewire;

use App\Models\DetalleEntradaProductos;
use App\Models\IngresoProductos;
use App\Models\Product;
use Livewire\Component;

class KardexController extends Component
{
    public $fromDate,$toDate,$product_name,$movimientos,$product_id;

    public function mount($id){
            $this->product_name=Product::find($id)->nombre;
            $this->product_id=$id;

    }

    public function render()
    {
        // $this->movimientos=IngresoProductos::join('detalle_entrada_productos','detalle_entrada_productos.id_entrada','ingreso_productos.id')
        // ->where('ingreso_productos.concepto','INICIAL')
        // ->where('detalle_entrada_productos.product_id',$this->product_id);
      
        return view('livewire.nivelinventarios.kardex')
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
