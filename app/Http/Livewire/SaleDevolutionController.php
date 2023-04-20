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

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        
    }
    public function render()
    {

        $asd = "";


        return view('livewire.saledevolution.saledevolution', [
            'datosnombreproducto' => $asd
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
