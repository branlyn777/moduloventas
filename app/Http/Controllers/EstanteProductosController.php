<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Destino;
use App\Models\DetalleOrdenCompra;
use App\Models\Location;
use App\Models\LocationProducto;
use App\Models\OrdenCompra;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Sucursal;
use Illuminate\Support\Facades\DB;

class EstanteProductosController extends Controller
{
    public $id_est;
    
    public function estanteProductoPdf($id)
    {
        $this->id_est = Location::find($id);

       

        $datosucursal=Destino::join('sucursals','sucursals.id','destinos.sucursal_id')
        ->where('destinos.id',$this->id_est->destino_id)
        ->select('destinos.nombre as destino_nombre','sucursals.name as sucursal_nombre')
        ->first();

        $codigo=$this->id_est->codigo;
        $descripcion=$this->id_est->descripcion;

        $productos=LocationProducto::join('locations','locations.id','location_productos.location')
        ->join('products','location_productos.product','products.id')
        ->join('productos_destinos','productos_destinos.product_id','products.id')
        ->where('locations.id',$id)
        ->select('products.*','productos_destinos.stock as cantidad', DB::raw('0 as otrosestantes'))
        ->get();

        foreach ($productos as $value) {
            $value->otrosestantes=$this->buscarOtrosEstantes($value->id);
        }

     


        $pdf = PDF::loadView('livewire.pdf.estanteproducto', compact('codigo','descripcion','datosucursal','productos'));

        return $pdf->stream('Detalle_Estante.pdf');
       
    }

    public function buscarOtrosEstantes($id){

        $data=LocationProducto::join('locations','locations.id','location_productos.location')
        ->join('products','location_productos.product','products.id')
        ->where('products.id',$id)
        ->select('locations.codigo as codigo')
        ->get();

        return $data;


    }

    
}
