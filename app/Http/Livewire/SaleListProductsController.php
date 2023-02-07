<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\Category;
use App\Models\DestinoSucursal;
use App\Models\Lote;
use App\Models\Movimiento;
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleLote;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SaleListProductsController extends Component
{
    //Para consultas de fecha de inicio y fin
    public $dateFrom, $dateTo;
    //Guarda el id de la sucursal
    public $sucursal_id;
    //Variable que guarda el id del usuario seleccionado
    public $user_id;
    //Guarda el id de la categoria producto y  la lista de categorias
    public $categoria_id, $lista_categoria;
    //Paginacion
    public $paginacion;
    //Guarda el total Bs u el total Utilidad
    public $total_precio, $total_utilidad;
    //Guarda la busqueda de productos
    public $search;
    //Guarda el id de una venta
    public $codigo;
    //Para guardar la cantidad de productos que tiene una venta antes de anular
    public $cantidad;
    //Guarda mensaje para mostrar por JavaScript
    public $message;

    use WithPagination;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->paginacion = 200;
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->sucursal_id = $this->idsucursal();
        $this->user_id = "Todos";
        $this->categoria_id = "Todos";
        $this->lista_categoria = Category::all();
    }

    public function render()
    {
        if (strlen($this->search) == 0) {
            if ($this->categoria_id == "Todos") {
                if ($this->sucursal_id != "Todos") {
                    if ($this->user_id != "Todos") {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)
                            ->where("s.user_id", $this->user_id)
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("s.user_id", $this->user_id)
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    } else {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    }
                } else {
                    if ($this->user_id != "Todos") {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("s.status", "PAID")
                            ->where("s.user_id", $this->user_id)
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("s.user_id", $this->user_id)
                            ->where("s.status", "PAID")
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    } else {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("s.status", "PAID")
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("s.status", "PAID")
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    }
                }
            } else {
                if ($this->sucursal_id != "Todos") {
                    if ($this->user_id != "Todos") {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)
                            ->where("s.user_id", $this->user_id)
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.user_id", $this->user_id)
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    } else {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    }
                } else {
                    if ($this->user_id != "Todos") {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")
                            ->where("s.user_id", $this->user_id)
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.user_id", $this->user_id)
                            ->where("s.status", "PAID")
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    } else {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")
                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    }
                }
            }
        } else {
            if ($this->categoria_id == "Todos") {
                if ($this->sucursal_id != "Todos") {
                    if ($this->user_id != "Todos") {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)
                            ->where("s.user_id", $this->user_id)

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("s.user_id", $this->user_id)
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    } else {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    }
                } else {
                    if ($this->user_id != "Todos") {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("s.status", "PAID")
                            ->where("s.user_id", $this->user_id)

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("s.user_id", $this->user_id)
                            ->where("s.status", "PAID")

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    } else {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("s.status", "PAID")

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("s.status", "PAID")

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    }
                }
            } else {
                if ($this->sucursal_id != "Todos") {
                    if ($this->user_id != "Todos") {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)
                            ->where("s.user_id", $this->user_id)

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.user_id", $this->user_id)
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    } else {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")
                            ->where("s.sucursal_id", $this->sucursal_id)

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    }
                } else {
                    if ($this->user_id != "Todos") {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")
                            ->where("s.user_id", $this->user_id)

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.user_id", $this->user_id)
                            ->where("s.status", "PAID")

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    } else {
                        //Consulta para obtener la lista de productos vendidos que se mostraran en la vista (con paginación)
                        $listaproductos = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "s.id as codigo",
                                "products.nombre as nombre_producto",
                                "sd.quantity as cantidad_vendida",
                                "s.created_at as fecha_creacion",
                                "u.name as nombre_vendedor",
                                "sd.price as precio_venta",
                                "products.id as idproducto",
                                "products.codigo as codigo_producto",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as ventareciente')
                            )
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->orderBy("s.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Consulta para obtener el total utilidad y total precio de los productos vendidos (sin paginacion)
                        $lista_productos_total = Product::join("sale_details as sd", "sd.product_id", "products.id")
                            ->join("sales as s", "s.id", "sd.sale_id")
                            ->join("users as u", "u.id", "s.user_id")
                            ->join("carteras as c", "c.id", "s.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")

                            ->join("sale_lotes as sl", "sl.sale_detail_id", "sd.id")
                            ->join("lotes as l", "l.id", "sl.lote_id")

                            ->select("products.id as idproducto", "sl.cantidad as cantidad_vendida", "l.costo as costo_producto", "sd.price as precio_venta")
                            ->where("products.category_id", $this->categoria_id)
                            ->where("s.status", "PAID")

                            ->where(function ($query) {
                                $query->where('products.nombre', 'like', '%' . $this->search . '%')
                                    ->orWhere('products.codigo', 'like', '%' . $this->search . '%');
                            })


                            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
                            ->get();
                    }
                }
            }
        }
        //Llenando las columnas adicionales a la lista de ventas ($listaproductos)
        foreach ($listaproductos as $l) {
            //Obtener el nombre de la sucursal de una venta
            $l->nombresucursal = $this->nombresucursal($l->codigo);
            //Obtener el tiempo de una venta reciente
            $l->ventareciente = $this->ventareciente($l->codigo);
        }
        $this->total_precio = 0;
        $this->total_utilidad = 0;
        //Calculando el total utilidad y el total precio ($lista_productos_total)
        foreach ($lista_productos_total as $l) {
            $this->total_utilidad = $this->total_utilidad + (($l->precio_venta - $l->costo_producto) * $l->cantidad_vendida);

            $this->total_precio = $this->total_precio + ($l->precio_venta * $l->cantidad_vendida);
        }
        return view('livewire..sales.salelistproducts', [
            'listaproductos' => $listaproductos,
            'listasucursales' => Sucursal::all(),
            'listausuarios' => $this->listausuarios(),
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    //Devuelve el tiempo en minutos de una venta reciente
    public function ventareciente($idventa)
    {
        //Variable donde se guardaran los minutos de diferencia entre el tiempo de una venta y el tiempo actual
        $minutos = -1;
        //Guardando el tiempo en la cual se realizo la venta
        $date = Carbon::parse(Sale::find($idventa)->created_at)->format('Y-m-d');
        //Comparando que el dia-mes-año de la venta sean iguales al tiempo actual
        if ($date == Carbon::parse(Carbon::now())->format('Y-m-d')) {
            //Obteniendo la hora en la que se realizo la venta
            $hora = Carbon::parse(Sale::find($idventa)->created_at)->format('H');
            //Obteniendo la hora de la venta mas 1 para incluir horas diferentes entre una hora venta y la hora actual en el else
            $hora_mas = $hora + 1;
            //Si la hora de la venta coincide con la hora actual
            if ($hora == Carbon::parse(Carbon::now())->format('H')) {
                //Obtenemmos el minuto de la venta
                $minutos_venta = Carbon::parse(Sale::find($idventa)->created_at)->format('i');
                //Obtenemos el minuto actual
                $minutos_actual = Carbon::parse(Carbon::now())->format('i');
                //Calculamos la diferencia
                $diferenca = $minutos_actual - $minutos_venta;
                //Actualizamos la variable $minutos por los minutos de diferencia si la venta fue hace 1 hora antes que la hora actual
                if ($diferenca <= 60) {
                    $minutos = $diferenca;
                }
            } else {
                //Ejemplo: Si la hora de la venta es 14:59 y la hora actual es 15:01
                //Usamos la variable $hora_mas para comparar con la hora actual, esto para obtener solo a las ventas que sean una hora antes que la hora actual
                if ($hora_mas == Carbon::parse(Carbon::now())->format('H')) {
                    //Obtenemmos el minuto de la venta con una hora antes que la hora actual
                    $minutos_venta = Carbon::parse(Sale::find($idventa)->created_at)->format('i');
                    //Obtenemos el minuto actual
                    $minutos_actual = Carbon::parse(Carbon::now())->format('i');
                    //Restamos el minuto de la venta con el minuto actual y despues le restamos 60 minutos por la hora antes añadida ($hora_mas)
                    $mv = (($minutos_venta - $minutos_actual) - 60) * -1;
                    //Actualizamos la variable $minutos por los minutos de diferencia si la venta fue hace 1 hora antes que la hora actual
                    if ($mv <= 60) {
                        $minutos = $mv;
                    }
                }
            }
        }


        return $minutos;
    }
    //Listar a todos los usuarios que hayan realizado ventas en las fechas y sucursales seleccionadas
    public function listausuarios()
    {
        $listausuarios = User::join("sales as s", "s.user_id", "users.id")
            ->select("users.*")
            ->where("s.status", "PAID")
            ->where("s.status", "PAID")
            ->where("users.status", "ACTIVE")
            ->distinct()
            ->get();
        return $listausuarios;
    }
    //Obtener el Id de la Sucursal donde esta el Usuario
    public function idsucursal()
    {
        $idsucursal = User::join("sucursal_users as su", "su.user_id", "users.id")
            ->select("su.sucursal_id as id", "users.name as n")
            ->where("users.id", Auth()->user()->id)
            ->where("su.estado", "ACTIVO")
            ->get()
            ->first();
        return $idsucursal->id;
    }
    //Devuelve el nombre de la sucursal de una venta
    public function nombresucursal($idventa)
    {
        $nombresucursal = Sucursal::join("cajas as c", "c.sucursal_id", "sucursals.id")
            ->join("carteras as car", "car.caja_id", "c.id")
            ->join("sales as s", "s.cartera_id", "car.id")
            ->select("sucursals.name as nombre_sucursal")
            ->where("s.id", $idventa)
            ->first()->nombre_sucursal;

        return $nombresucursal;
    }
    //Redirige para Editar una Venta
    public function editsale($idventa)
    {
        session(['venta_id' => $idventa]);
        $this->redirect('editarventa');
    }
    //Para confirmar anular una venta
    public function confirmaranular($idventa)
    {
        $cant = SaleDetail::where("sale_details.sale_id", $idventa)->get();
        $this->cantidad = $cant->count();
        $this->codigo = $idventa;
        $this->emit("anular-venta");
    }
    protected $listeners = [
        'anularventa' => 'anular_venta'
    ];
    //Anula una venta a travez del idventa
    public function anular_venta($idventa)
    {
        DB::beginTransaction();
        try {
            //Obteniendo Información de la Venta
            $venta = Sale::find($idventa);
            //Buscando el movimiento y desactivandolo
            $movimiento = Movimiento::find($venta->movimiento_id);
            $movimiento->update([
                'status' => 'INACTIVO'
            ]);
            $movimiento->save();

            //Buscando la cartera y disminuyendo su saldo
            $cartera = Cartera::find($venta->cartera_id);
            $cartera->update([
                'saldocartera' => $cartera->saldocartera - $venta->total
            ]);
            $cartera->save();


            //Buscando el id de destino de donde salieron los productos para la Venta
            $destinoid = DestinoSucursal::where("destino_sucursals.sucursal_id", $this->idsucursalventa($idventa))->first()->destino_id;


            //Devolviento los productos a la tienda
            //Guardando en una variable los productos y sus cantidades de una venta para devolverlos a la Tienda
            $detalleventa = SaleDetail::join('sales as s', 's.id', 'sale_details.sale_id')
                ->join("products as p", "p.id", "sale_details.product_id")
                ->select(
                    'p.id as idproducto',
                    'p.image as image',
                    'p.nombre as nombre',
                    'p.precio_venta as po',
                    'sale_details.price as pv',
                    'sale_details.quantity as cantidad',
                    'sale_details.id as sid'
                )
                ->where('sale_details.sale_id', $idventa)
                ->get();

            foreach ($detalleventa as $item) {
                //Incrementando el stock en tienda
                $tiendaproducto = ProductosDestino::join("products as p", "p.id", "productos_destinos.product_id")
                    ->join('destinos as des', 'des.id', 'productos_destinos.destino_id')
                    ->select(
                        "productos_destinos.id as id",
                        "p.nombre as name",
                        "productos_destinos.stock as stock"
                    )
                    ->where("p.id", $item->idproducto)
                    ->where("des.id", $destinoid)
                    ->where("des.sucursal_id", $this->idsucursal())
                    ->get()->first();
                $tiendaproducto->update([
                    'stock' => $tiendaproducto->stock + $item->cantidad
                ]);
            }
            foreach ($detalleventa as $i) {
                $lotes = SaleLote::where('sale_detail_id', $i->sid)
                    ->get();

                foreach ($lotes as $j) {
                    $lot = Lote::where('lotes.id', $j->lote_id)->first();
                    //dump($lot);
                    $lot->update([
                        'existencia' => $lot->existencia + $j->cantidad,
                        'status' => 'Activo'
                    ]);
                    $lotes = SaleLote::where('sale_detail_id', $i->sid)->delete();
                }
            }
            //Anulando la venta
            $venta->update([
                'status' => 'CANCELED',
            ]);
            $venta->save();

            $this->codigo = $idventa;
            DB::commit();
            $this->emit('sale-cancel-ok');
        } catch (Exception $e) {
            DB::rollback();
            $this->message = $e->getMessage();
            $this->emit('sale-error');
        }
    }
    //Devuelve el id de la sucursal de una venta
    public function idsucursalventa($idventa)
    {
        $idsucursal = Caja::join("carteras as car", "car.caja_id", "cajas.id")
            ->join("sales as s", "s.cartera_id", "car.id")
            ->select("cajas.sucursal_id as sucursal_id")
            ->where("s.id", $idventa)
            ->first()->sucursal_id;

        return $idsucursal;
    }
    //Crear Comprobante de Ventas
    public function crearcomprobante($idventa)
    {
        $this->codigo = $idventa;
        $this->emit('crear-comprobante');
    }
}
