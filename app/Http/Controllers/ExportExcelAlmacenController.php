<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductosDestino;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportExcelAlmacenController implements  FromView,ShouldAutoSize
{
    private $destino;
    public function __construct($destino)
    {
        $this->destino=$destino;
       

    }
    
    public function view():View
    {

        if ($this->destino!='General') {
      
            
            return view ('products.almacen',['destinos_almacen'=> ProductosDestino::join('products as p','p.id','productos_destinos.product_id')
            ->join('destinos as dest','dest.id','productos_destinos.destino_id')
            ->where('dest.id',$this->destino)
            ->select('p.*')
            ->groupBy('productos_destinos.product_id')
            ->selectRaw('sum(productos_destinos.stock) as stock_s')->get()
           
            ]);
        } else {
          
            return view ('products.almacen',['destinos_almacen'=> ProductosDestino::join('products as p','p.id','productos_destinos.product_id')
            ->join('destinos as dest','dest.id','productos_destinos.destino_id')
            ->select('p.*')
            ->groupBy('productos_destinos.product_id')
            ->selectRaw('sum(productos_destinos.stock) as stock_s')->get()
           
            ]);
        }

    }
}
