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
use App\Models\Product;
use App\Models\ProductosDestino;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Sucursal;
use Illuminate\Support\Facades\DB;

class EstanteProductosController extends Controller
{
    public $id_est,$search2,$data_prod_mob,$arr,$col;

    public function mount(){
        $this->col=collect();
    }
    
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
        ->join('products', 'location_productos.product', '=', 'products.id')
        ->where('locations.id',$id)
        ->select('products.*',DB::raw('0 as cantidad'), DB::raw('0 as otrosestantes'))
     
        ->get();

        foreach ($productos as $value) {
            $value->otrosestantes=$this->buscarOtrosEstantes($value->id);
            $value->cantidad=$this->destinoCantidad($value->id);
        }

         
        if (strlen($this->search2) > 0)
        {
            dd($this->search2);
            $this->data_prod_mob = Product::whereNotIn('products.id',$this->arr)
                            ->where('nombre', 'like', '%' . $this->search2 . '%')
                            ->orWhere('codigo','like','%'.$this->search2.'%')
                            ->take(10)
                            ->get();
    
         
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

    public function destinoCantidad($id){
        $data=ProductosDestino::where('product_id',$id)->where('destino_id',$this->id_est->destino_id)->get();
        if ($data->count() != 0) {
          
            $data=$data->first()->stock;
            return $data;
          
        }
        return 0;
    }

    public function resetAsignar(){

        $this->search2=null;
        $this->data_prod_mob=null;
    }

    public function asignaridmob($id){

        $this->resetAsignar();
   
        $loc=LocationProducto::where('location',$this->id_est)->get('product');
        
        foreach ($loc as $data) {
            
            array_push($this->arr, $data->product);

        }
        $this->emit('show-modal');

        

    }

    
}
