<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\ClienteMov;
use App\Models\Destino;
use App\Models\DevolutionSale;
use App\Models\Location;
use App\Models\Movimiento;
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Carbon\Carbon;


class SaleDevolucionController extends Component
{

    public $buscarventa;

    use WithPagination;


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
          
    }
    public function render()
    {
        $detalle_venta = [];

        if(strlen($this->buscarventa) > 0)
        {
            $detalle_venta = SaleDetail::where("sale_details.sale_id", $this->buscarventa)->get();
        }





        return view('livewire.sales.saledevolucion', [
            'detalle_venta' => $detalle_venta,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    //Muestra la ventana modal devolucion
    public function modaldevolucion()
    {
        $this->emit("modaldevolucion-show");
    }



}
