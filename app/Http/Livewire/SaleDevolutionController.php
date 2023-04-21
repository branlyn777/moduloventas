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
    public $search, $salelist, $product_id;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->search = "";
        $this->salelist = [];
    }
    public function render()
    {

        $list_products = [];
        if (strlen($this->search) > 0) {
            $list_products = Product::where("products.status", "ACTIVO") //muestra lista del buscador
                ->where("products.nombre", "like", "%" . $this->search . "%") //busca 
                ->get();
        }


        return view('livewire.saledevolution.saledevolution', [
            'list_products' => $list_products
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    // mostrar
    public function showmodalsalelist($idproduct)
    {
        $this->product_id = $idproduct;
        $this->salelist = Sale::join("sale_details as sd", "sd.sale_id", "sales.id")
            ->join("users as u", "u.id", "sales.user_id")
            ->join("sucursals as su", "su.id", "sales.sucursal_id")
            ->join("movimientos as m", "m.id", "sales.movimiento_id")
            ->join("cliente_movs as clim", "clim.movimiento_id", "m.id")
            ->join("clientes as c", "c.id", "clim.cliente_id")
            ->select("sales.id as codigo", "u.name as nombre_usuario", "su.name as sucur", "c.nombre as nombre_cliente")
            // ->select("sales.id as codigo", "users.name as nombre")
            ->where("sales.status", "PAID")
            ->where("sd.product_id", $idproduct)
            ->get();

        $this->emit("show-modalsalelist");
    }
    // cerrar pestaña
    public function hidemodalsalelist()
    {
        $this->emit("hide-modalsalelist");
        //buscando el producto
        $listdestinations=ProductosDestino::join('destinos as d','d.id','productos_destino.destino_id')
        ->join('sucursal as s','s.id','destinos.sucursal_id')
        ->select('d.nombre as destino','s.name as sucursal')
        ->where("product_id", $this->product_id)
        ->get();
        //abre
        $this->emit("show-modaldevolution");
    }
}
