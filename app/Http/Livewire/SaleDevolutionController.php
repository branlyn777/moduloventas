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


class SaleDevolutionController extends Component
{
    public $search, $salelist;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->search="";
        $this->salelist =[];
    }
    public function render()
    {

        $list_products = [];
        if (strlen($this->search) > 0) {
            $list_products = Product::where("products.status", "ACTIVO")//muestra lista del buscador
            ->where("products.nombre","like","%" . $this->search. "%")//busca 
            ->get();
        }
       

        return view('livewire.saledevolution.saledevolution', [
            'list_products' => $list_products
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function showmodalsalelist($idproduct)
    {
        $this->salelist = Sale::join("sale_details as sd","sd.sale_id","sales.id")
        ->join("sale as s", "s.user_id", "users.id")
        ->select("sales.id as codigo", "users.name as nombre")
        ->where("sales.status", "PAID")
        ->where("sd.product_id",$idproduct)
        ->get();

        $this->emit("show-modalsalelist");
    }
}
