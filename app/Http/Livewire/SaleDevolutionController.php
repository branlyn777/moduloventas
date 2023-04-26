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
use App\Models\SucursalUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Carbon\Carbon;


class SaleDevolutionController extends Component
{
    public $search, $salelist, $product_id, $listdestinations, $other_sucursals, $selected_destination_id, $selected_destination_name, $selected_product_name, $list_destinations, $received_amount, $stock_limit;


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->search = "";
        $this->salelist = [];
        $this->listdestinations = [];
        $this->other_sucursals = [];
        $this->selected_destination_id = 0;
    }
    public function render()
    {

        $list_products = [];
        if (strlen($this->search) > 0) {
            $list_products = Product::where("products.status", "ACTIVO") //muestra lista del buscador
                ->where("products.nombre", "like", "%" . $this->search . "%") //busca 
                ->get();
        }

        if ($this->selected_destination_id != 0) {
            $destino = Destino::find($this->selected_destination_id);
            $this->selected_destination_name = $destino->nombre;




            $cantidad = ProductosDestino::join('destinos as d', 'd.id', 'productos_destinos.destino_id')
            ->join('sucursals as s', 's.id', 'd.sucursal_id')
            ->join('products as p', 'p.id', 'productos_destinos.product_id')
            ->select('d.nombre as destino', 's.name as sucursal', 'p.codigo as co', 'productos_destinos.stock as stock', 'p.nombre as nom', 'd.id as destino_id')
            ->where("product_id", $this->product_id)
            ->where("d.id", $this->selected_destination_id)
            ->first();

            $this->stock_limit = $cantidad->stock;




        }
        $sucursal_id = SucursalUser::where("user_id", Auth()->user()->id)->where("estado", "ACTIVO")->first()->sucursal_id;
        if ($this->product_id != null) {
            //buscando el producto
            $this->listdestinations = ProductosDestino::join('destinos as d', 'd.id', 'productos_destinos.destino_id')
                ->join('sucursals as s', 's.id', 'd.sucursal_id')
                ->join('products as p', 'p.id', 'productos_destinos.product_id')
                ->select('d.nombre as destino', 's.name as sucursal', 'p.codigo as co', 'productos_destinos.stock as stock', 'p.nombre as nom', 'd.id as destino_id')
                ->where("product_id", $this->product_id)
                ->where("s.id", $sucursal_id)
                ->get();
        }
        $this->list_destinations = Destino::where('sucursal_id', $sucursal_id)
            ->get();


        return view('livewire.saledevolution.saledevolution', [
            'list_products' => $list_products
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    // mostrar
    public function showmodalsalelist(Product $product)
    {
        $this->selected_product_name = $product->nombre;
        $this->product_id = $product->id;
        $this->salelist = Sale::join("sale_details as sd", "sd.sale_id", "sales.id")
            ->join("users as u", "u.id", "sales.user_id")
            ->join("sucursals as su", "su.id", "sales.sucursal_id")
            ->join("movimientos as m", "m.id", "sales.movimiento_id")
            ->join("cliente_movs as clim", "clim.movimiento_id", "m.id")
            ->join("clientes as c", "c.id", "clim.cliente_id")
            ->select("sales.id as codigo", "u.name as nombre_usuario", "su.name as sucur", "c.nombre as nombre_cliente")
            // ->select("sales.id as codigo", "users.name as nombre")
            ->where("sales.status", "PAID")
            ->where("sd.product_id", $product->id)
            ->get();

        $this->emit("show-modalsalelist");
    }
    // cerrar pestaña
    public function hidemodalsalelist()
    {
        $this->emit("hide-modalsalelist");
        $sucursal_id = SucursalUser::where("user_id", Auth()->user()->id)->where("estado", "ACTIVO")->first()->sucursal_id;
        //buscando el producto
        $this->listdestinations = ProductosDestino::join('destinos as d', 'd.id', 'productos_destinos.destino_id')
            ->join('sucursals as s', 's.id', 'd.sucursal_id')
            ->join('products as p', 'p.id', 'productos_destinos.product_id')
            ->select('d.nombre as destino', 's.name as sucursal', 'p.codigo as co', 'productos_destinos.stock as stock', 'p.nombre as nom', 'd.id as destino_id')
            ->where("product_id", $this->product_id)
            ->where("s.id", $sucursal_id)
            ->get();


        // $this->other_sucursals = ProductosDestino::join('destinos as d', 'd.id', 'productos_destinos.destino_id')
        //     ->join('sucursals as s', 's.id', 'd.sucursal_id')
        //     ->join('products as p', 'p.id', 'productos_destinos.product_id')
        //     ->select('d.nombre as destino', 's.name as sucursal', 'p.codigo as co', 'productos_destinos.stock as stock', 'p.nombre as nom')
        //     ->where("s.id", "<>", $sucursal_id)
        //     ->get();


        $this->list_destinations = Destino::where('sucursal_id', $sucursal_id)
            ->get();
        //abre
        $this->emit("show-modaldevolution");
    }
    public function return_product()
    {
        $rules = [
            'received_amount' => 'required',

        ];
        $messages = [
            'received_amount.required' => 'Cantidad requerida',


        ];
        $this->validate($rules, $messages);

        if ($this->received_amount > $this->stock_limit) {

            $this->emit("message-warning");
        } else {


            $product_destination = ProductosDestino::where("destino_id",$this->selected_destination_id)
            ->where("product_id", $this->product_id)
            ->first();

            $new_stock = $product_destination->stock - $this->received_amount;

            $pd = ProductosDestino::find($product_destination->id);
            $pd->update([
                'stock' => $new_stock
            ]);
            $pd->save();
            dd("Registro Actualizado");



        }
    }
}
