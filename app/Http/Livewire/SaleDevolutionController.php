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
use App\Models\SaleDevolution;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Carbon\Carbon;


class SaleDevolutionController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search, $pagination;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->pagination = 10;
    }
    public function render()
    {
        $list_devolutions = SaleDevolution::join("sale_details as sd", "sd.id", "sale_devolutions.sale_detail_id")
        ->join("users as u", "u.id", "sale_devolutions.user_id")
        ->join("products as p", "p.id", "sd.product_id")
        ->join("sucursals as s", "s.id", "sale_devolutions.sucursal_id")
        ->select("sale_devolutions.created_at as created_at","sale_devolutions.quantity as quantity", "u.name as user", "p.nombre as name_product",
        "sale_devolutions.amount as amount","s.name as name_sucursal")
        ->where("sale_devolutions.status", "active")
        ->paginate($this->pagination);

        return view('livewire.sales.saledevolution', [
            'list_devolutions' => $list_devolutions
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}