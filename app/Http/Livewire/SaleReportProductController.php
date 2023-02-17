<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\SaleDetail;
use App\Models\SaleLote;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SaleReportProductController extends Component
{
    //Para consultas de fecha de inicio y fin
    public $dateFrom, $dateTo;
    //Guarda el id de la sucursal
    public $sucursal_id;
    //Variable que guarda el id del usuario seleccionado
    public $user_id;
    //Guarda el id de la categoria producto y  la lista de categorias
    public $categoria_id, $lista_categoria;
    //Guarda la busqueda de productos
    public $search;
    //Paginacion
    public $paginacion;

    public $listasucursales, $listausuarios;

    use WithPagination;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->paginacion = 100;
        $this->sucursal_id = $this->idsucursal();
        $this->user_id = "Todos";
        $this->categoria_id = "Todos";
        $this->lista_categoria = Category::all();
        $this->listasucursales = Sucursal::all();
        $this->listausuarios = $this->listausuarios();

    }
    public function render()
    {
        if(strlen($this->search) == 0)
        {
            if($this->categoria_id == "Todos")
            {
                if($this->sucursal_id != "Todos")
                {
                    if($this->user_id != "Todos")
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("s.status","PAID")
                        ->where("s.user_id",$this->user_id)
                        ->where("cj.sucursal_id", $this->sucursal_id)
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                    else
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("s.status","PAID")
                        ->where("cj.sucursal_id", $this->sucursal_id)
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                }
                else
                {
                    if($this->user_id != "Todos")
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("s.status","PAID")
                        ->where("s.user_id",$this->user_id)
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                    else
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("s.status","PAID")
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                }
            }
            else
            {
                if($this->sucursal_id != "Todos")
                {
                    if($this->user_id != "Todos")
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->join("categories as ct","ct.id","products.category_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("ct.id",$this->categoria_id)
                        ->where("s.status","PAID")
                        ->where("s.user_id",$this->user_id)
                        ->where("cj.sucursal_id", $this->sucursal_id)
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                    else
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->join("categories as ct","ct.id","products.category_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("ct.id",$this->categoria_id)
                        ->where("s.status","PAID")
                        ->where("cj.sucursal_id", $this->sucursal_id)
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                }
                else
                {
                    if($this->user_id != "Todos")
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->join("categories as ct","ct.id","products.category_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("ct.id",$this->categoria_id)
                        ->where("s.status","PAID")
                        ->where("s.user_id",$this->user_id)
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                    else
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->join("categories as ct","ct.id","products.category_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("ct.id",$this->categoria_id)
                        ->where("s.status","PAID")
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                }
            }
        }
        else
        {
            if($this->categoria_id == "Todos")
            {
                if($this->sucursal_id != "Todos")
                {
                    if($this->user_id != "Todos")
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("s.status","PAID")
                        ->where("s.user_id",$this->user_id)
                        ->where("cj.sucursal_id", $this->sucursal_id)

                        ->where(function($query){
                            $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                  ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                        })

                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                    else
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("s.status","PAID")
                        ->where("cj.sucursal_id", $this->sucursal_id)

                        ->where(function($query){
                            $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                  ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                        })

                        
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                }
                else
                {
                    if($this->user_id != "Todos")
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("s.status","PAID")
                        ->where("s.user_id",$this->user_id)

                        ->where(function($query){
                            $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                  ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                        })

                        
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                    else
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("s.status","PAID")

                        ->where(function($query){
                            $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                  ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                        })

                        
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                }
            }
            else
            {
                if($this->sucursal_id != "Todos")
                {
                    if($this->user_id != "Todos")
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->join("categories as ct","ct.id","products.category_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("ct.id",$this->categoria_id)
                        ->where("s.status","PAID")
                        ->where("s.user_id",$this->user_id)
                        ->where("cj.sucursal_id", $this->sucursal_id)

                        ->where(function($query){
                            $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                  ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                        })

                        
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                    else
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->join("categories as ct","ct.id","products.category_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("ct.id",$this->categoria_id)
                        ->where("s.status","PAID")
                        ->where("cj.sucursal_id", $this->sucursal_id)

                        ->where(function($query){
                            $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                  ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                        })

                        
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                }
                else
                {
                    if($this->user_id != "Todos")
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->join("categories as ct","ct.id","products.category_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("ct.id",$this->categoria_id)
                        ->where("s.status","PAID")
                        ->where("s.user_id",$this->user_id)

                        ->where(function($query){
                            $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                  ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                        })

                        
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                    else
                    {
                        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
                        ->join("sales as s","s.id","sd.sale_id")
                        ->join("carteras as c","c.id","s.cartera_id")
                        ->join("cajas as cj","cj.id","c.caja_id")
                        ->join("categories as ct","ct.id","products.category_id")
                        ->select("products.id as idproducto","products.nombre as nombre_producto","products.codigo as codigo_producto", DB::raw('0 as cantidad_vendida'), DB::raw("0 as total_vendido"), DB::raw("0 as total_utilidad"))
                        ->where("ct.id",$this->categoria_id)
                        ->where("s.status","PAID")

                        ->where(function($query){
                            $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                  ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                        })

                        
                        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                        ->distinct()
                        ->get();
                    }
                }
            }
        }


        foreach($tabla_productos as $t)
        {
            $t->cantidad_vendida = $this->obtener_cantidad_vendida($t->idproducto);
            $t->total_vendido = $this->obtener_total_vendido($t->idproducto);
            $t->total_utilidad = $this->obtener_total_costo($t->idproducto);
        }


        return view('livewire.sales.salereportproduct', [
            'tabla_productos' => $tabla_productos
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    //Obtener el Id de la Sucursal donde esta el Usuario
    public function idsucursal()
    {
        $idsucursal = User::join("sucursal_users as su","su.user_id","users.id")
        ->select("su.sucursal_id as id","users.name as n")
        ->where("users.id",Auth()->user()->id)
        ->where("su.estado","ACTIVO")
        ->get()
        ->first();
        return $idsucursal->id;
    }
    //Listar a todos los usuarios que hayan realizado ventas en las fechas y sucursales seleccionadas
    public function listausuarios()
    {
        $listausuarios = User::join("sales as s", "s.user_id", "users.id")
        ->select("users.*")
        ->where("s.status","PAID")
        ->where("s.status","PAID")
        ->where("users.status","ACTIVE")
        ->distinct()
        ->get();
        return $listausuarios;
    }
    //Obtiene la cantidad vendida de un producto en un lapso de tiempo
    public function obtener_cantidad_vendida($productoid)
    {
        $cantidad = SaleDetail::join("sales as s","s.id","sale_details.sale_id")
        ->where("sale_details.product_id",$productoid)
        ->where("s.status", "PAID")
        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
        ->sum('sale_details.quantity');
        return $cantidad;
    }
    //Obtiene el total bs de un producto en un lapso de tiempo
    public function obtener_total_vendido($productoid)
    {

        // $total = SaleDetail::join("sales as s","s.id","sale_details.sale_id")
        // ->select(DB::raw('sale_details.price * sale_details.quantity as total'))
        // ->where("sale_details.product_id",$productoid)
        // ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
        // ->sum('total');
        // return $total;


        $total = SaleDetail::join("sales as s","s.id","sale_details.sale_id")
            ->select(DB::raw('sale_details.price * sale_details.quantity as total'))
            ->where("sale_details.product_id",$productoid)
            ->where("s.status", "PAID")
            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
            ->get();

        $t = 0;
        
        foreach($total as $tt)
        {
            $t = $t + $tt->total;
        }
            
        return $t;


    }
    //Obtiene el total utilidad costo de un producto en un lapso de tiempo
    public function obtener_total_costo($productoid)
    {
        $lista = SaleDetail::join("sales as s","s.id","sale_details.sale_id")
        ->select("sale_details.id as iddetalle", "sale_details.price as precio_venta")
        ->where("s.status", "PAID")
        ->where("sale_details.product_id",$productoid)
        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
        ->get();

        $total_costo = 0;

        
        foreach($lista as $l)
        {
            $lista_lotes = SaleLote::join("lotes as l","l.id","sale_lotes.lote_id")
            ->select(DB::raw('sale_lotes.cantidad * l.costo as total'))
            ->where("sale_lotes.sale_detail_id", $l->iddetalle)
            ->get();
            foreach($lista_lotes as $ll)
            {
                $total_costo = $total_costo + $ll->total;
            }
        }


        return $total_costo;
    }
}