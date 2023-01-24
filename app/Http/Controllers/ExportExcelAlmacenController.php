<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductosDestino;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportExcelAlmacenController implements  FromView,ShouldAutoSize
{
    private $destino,$stock;
    public function __construct($destino,$stock)
    {
        $this->destino=$destino;
        $this->stock=$stock;
  

    }
    
    public function view():View
    {


        $almacen = ProductosDestino::join('products as p', 'p.id', 'productos_destinos.product_id')
        ->join('destinos as dest', 'dest.id', 'productos_destinos.destino_id')
     
        //->select('productos_destinos.stock','p.*')
        ->when($this->destino == 'General', function ($query) {
            return $query->select('p.*', 'p.cantidad_minima as cant', DB::raw("SUM(productos_destinos.stock) as stock_s"))->groupBy('p.id');
        })
        ->when($this->destino != 'General', function ($query) {
            return $query->select('p.*', 'p.cantidad_minima as cant2', 'productos_destinos.stock as stock')
                ->where('productos_destinos.destino_id', $this->destino);
        })
        ->when($this->stock == 'cero', function ($query) {
            if ($this->destino == 'General') {
                return $query->having('stock_s', 0);
            } else {
                return $query->where('stock', 0);
            }
        })
        ->when($this->stock == 'bajo', function ($query) {

            if ($this->destino == 'General') {
                return $query->having('stock_s', '<', DB::raw("cant"));
            } else {
                return $query->whereColumn('stock', '<', 'cantidad_minima');
            }
        })
        ->when($this->stock == 'positivo', function ($query) {
            if ($this->destino == 'General') {
                return $query->having('stock_s', '>', 0);
            } else {
                return $query->where('stock', '>', 0);
            }
        })->get();





            return view ('products.almacen',['destinos_almacen'=> $almacen]);
    
       

    }
}
