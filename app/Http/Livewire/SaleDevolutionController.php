<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\ClienteMov;
use App\Models\Destino;
use App\Models\DevolutionSale;
use App\Models\Location;
use App\Models\Lote;
use App\Models\Movimiento;
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleDevolution;
use App\Models\SaleLote;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class SaleDevolutionController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search, $pagination, $list_branchs, $branch_id, $dateFrom, $dateTo, $message;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->pagination = 10;
        $this->list_branchs = Sucursal::all();
        $this->branch_id = 0;
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
    }
    public function render()
    {
        $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
        $to = Carbon::parse($this->dateTo)->format('Y-m-d')     . ' 23:59:59';

        if(strlen($this->search) == 0)
        {
            if($this->branch_id == 0)
            {
                $list_devolutions = SaleDevolution::join("sale_details as sd", "sd.id", "sale_devolutions.sale_detail_id")
                ->join("users as u", "u.id", "sale_devolutions.user_id")
                ->join("products as p", "p.id", "sd.product_id")
                ->join("sucursals as s", "s.id", "sale_devolutions.sucursal_id")
                ->select("sale_devolutions.created_at as created_at","sale_devolutions.quantity as quantity", "u.name as user", "p.nombre as name_product",
                "sale_devolutions.amount as amount","s.name as name_sucursal", "sale_devolutions.id as id", "sale_devolutions.description as description",
                "sale_devolutions.walletid as walletid")
                ->where("sale_devolutions.status", "active")
                ->whereBetween('sale_devolutions.created_at', [$from, $to])
                ->orderBy("sale_devolutions.created_at","desc")
                ->paginate($this->pagination);
            }
            else
            { 
                $list_devolutions = SaleDevolution::join("sale_details as sd", "sd.id", "sale_devolutions.sale_detail_id")
                ->join("users as u", "u.id", "sale_devolutions.user_id")
                ->join("products as p", "p.id", "sd.product_id")
                ->join("sucursals as s", "s.id", "sale_devolutions.sucursal_id")
                ->select("sale_devolutions.created_at as created_at","sale_devolutions.quantity as quantity", "u.name as user", "p.nombre as name_product",
                "sale_devolutions.amount as amount","s.name as name_sucursal", "sale_devolutions.id as id", "sale_devolutions.description as description",
                "sale_devolutions.walletid as walletid")
                ->where("sale_devolutions.status", "active")
                ->where("sale_devolutions.sucursal_id", $this->branch_id)
                ->whereBetween('sale_devolutions.created_at', [$from, $to])
                ->orderBy("sale_devolutions.created_at","desc")
                ->paginate($this->pagination);
            }
        }
        else
        {
            $list_devolutions = SaleDevolution::join("sale_details as sd", "sd.id", "sale_devolutions.sale_detail_id")
            ->join("users as u", "u.id", "sale_devolutions.user_id")
            ->join("products as p", "p.id", "sd.product_id")
            ->join("sucursals as s", "s.id", "sale_devolutions.sucursal_id")
            ->select("sale_devolutions.created_at as created_at","sale_devolutions.quantity as quantity", "u.name as user", "p.nombre as name_product",
            "sale_devolutions.amount as amount","s.name as name_sucursal", "sale_devolutions.id as id", "sale_devolutions.description as description",
            "sale_devolutions.walletid as walletid")
            ->where("sale_devolutions.status", "active")
            ->where('p.nombre', 'like', '%' . $this->search . '%')
            ->paginate($this->pagination);
        }

        return view('livewire.sales.saledevolution', [
            'list_devolutions' => $list_devolutions
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    protected $listeners = [
        'cancelDevolution' => 'cancel_devolution'
    ];
    // Anula una devolución
    public function cancel_devolution(SaleDevolution $sale_devolution)
    {
        DB::beginTransaction();
        try
        {
            $sale_detail = SaleDetail::find($sale_devolution->sale_detail_id);

            $dp = ProductosDestino::where("product_id", $sale_detail->product_id)
            ->where("destino_id", $sale_devolution->destino_id)
            ->first();

            
            $l = Lote::where("product_id", $sale_detail->product_id)
            ->where("status", "Activo")
            ->select(DB::raw('SUM(existencia) as totalExistencia'))
            ->get();

            $totalExistencia = $l[0]->totalExistencia;

            $new_stock_pd = $dp->stock - $sale_devolution->quantity;
            $new_stock_l = $totalExistencia - $sale_devolution->quantity;

            if($new_stock_pd > 0)
            {
                if($new_stock_l > 0)
                {
                    $destination_product = ProductosDestino::find($dp->id);
                    $destination_product->update([
                        'stock' => $new_stock_pd
                    ]);
                    $destination_product->save();

                    $quantity = $sale_devolution->quantity;

                    $lots = Lote::where("product_id", $sale_detail->product_id)
                    ->where("status", "Activo")
                    ->where("existencia", ">", 0)
                    ->orderBy("id","asc")
                    ->get();

                    foreach($lots as $l)
                    {
                        if($quantity > 0)
                        {
                            $lot = Lote::find($l->id);
                            $q = $lot->existencia - $quantity;
                            if($q > 0)
                            {
                                $lot->update([
                                    'existencia' => $q,
                                    'status' => "Activo"
                                ]);
                                $lot->save();
                                break;
                            }
                            else
                            {
                                $quantity = $quantity - $lot->existencia;
                                $lot->update([
                                    'existencia' => 0,
                                    'status' => "Inactivo"
                                ]);
                                $lot->save();
                            }
                        }
                    }

                    $sale_devolution->update([
                        'status' => "inactive"
                    ]);
                    $sale_devolution->save();


                    if($sale_devolution->amount > 0)
                    {
                        $motion = Movimiento::find($sale_devolution->motionid);
                        $motion->update([
                            'status' => "INACTIVO"
                        ]);
                        $motion->save();
                    }
                    $this->emit("message-toast");
                }
                else
                {
                    $this->message = "No hay suficiente stock disponible para deshacer esta devolución - L";
                    $this->emit("message");
                }
    
            }
            else
            {
                $this->message = "No hay suficiente stock disponible para deshacer esta devolución - PD";
                $this->emit("message");
            }




            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollback();
            $this->message = "Error: " . $e->getMessage();
            $this->emit('message');
        }
        
    }
}
