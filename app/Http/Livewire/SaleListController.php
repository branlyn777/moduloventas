<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\Category;
use App\Models\Cliente;
use App\Models\DestinoSucursal;
use App\Models\Lote;
use App\Models\Movimiento;
use App\Models\ProductosDestino;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleLote;
use App\Models\Sucursal;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class SaleListController extends Component
{
    public $paginacion;
    //Guarda el id de una venta
    public $venta_id;
    //Guarda cualquier tipo de mensaje para ser mostrado por javascript (Sweet Alert)
    public $mensaje;
    //FILTROS

    public $search;
    //Variable que guarda el id del usuario seleccionado
    public $user_id;
    //Variable que guarda el id de la categoria en los productos
    public $categoria_id;
    //Tipo de Fechas (Ventas de Hoy, Ventas por Fechas)
    public $tipofecha;

    //Variable para Ocultar o Mostrar mas Filtros
    public $masfiltros;

    //Variables para filtrar los resultados de la lista de ventas por fechas
    public $dateFrom, $dateTo;

    //VARIABLES PARA LA VENTANA MODAL DETALLE DE VENTA
    //Variable para guardar detalles de una venta para ser mostrados en una ventana modal
    public $detalle_venta;
    //Variable para guardar detalles generales de una venta
    public $venta;
    //Guarda la observacion de una venta
    public $observacion;
    //Guarda la cantidad total de items de una venta
    public $totalitems;
    //Guarda el total descuento o recargo de una venta
    public $desc_rec;
    //Guarda el id de la sucursal de donde se listara las ventas


    //Variables para cambiar a usuario vendedor
    public $nombreusuariovendedor;
    public $sucursal_id;
    public $timeFrom, $timeTo;

    use WithFileUploads;
    use WithPagination;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount($code = null)
    {
        $this->search = "";
        if ($code != null) {
            $this->search = $code;
        }

        $this->paginacion = 50;
        $this->masfiltros = false;
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->timeFrom = '00:00';
        $this->timeTo = '23:59';
        $this->detalle_venta = [];
        $this->tipofecha = 'hoy';
        $this->sucursal_id = $this->idsucursal();
        $this->nombreusuariovendedor = "";
        //Si el usuario tiene el permiso para filtrar lista de ventas
        if (Auth::user()->hasPermissionTo('VentasListaMasFiltros')) {
            $this->user_id = "Todos";
        } else {
            $this->user_id = Auth::user()->id;
        }
    }
    public function render()
    {
        $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
        $to = Carbon::parse($this->dateTo)->format('Y-m-d')     . ' 23:59:59';

        if (strlen($this->search) == 0) {
            if ($this->sucursal_id != "Todos") {
                if ($this->user_id == "Todos") {
                    if ($this->tipofecha == "hoy") {
                        $listaventas = Sale::join("users as u", "u.id", "sales.user_id")
                            ->join("carteras as c", "c.id", "sales.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "sales.id as codigo",
                                "sales.created_at as fechaventa",
                                "u.name as nombreusuario",
                                "c.nombre as nombrecartera",
                                "sales.total as totalbs",
                                "sales.change as totalcambio",
                                "sales.status as estado",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as totaldescuento'),
                                DB::raw('0 as datoscliente'),
                                DB::raw('0 as ventareciente')
                            )
                            //->where("sales.status","PAID")
                            ->where("sales.sucursal_id", $this->sucursal_id)
                            ->whereBetween('sales.created_at', [Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00', Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59'])
                            ->orderBy("sales.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Llenando las columnas adicionales a la lsita de ventas
                        foreach ($listaventas as $lv) {
                            //Obtener el nombre de la sucursal de una venta
                            $lv->nombresucursal = $this->nombresucursal($lv->codigo);
                            //Obtener datos de un cliente de una venta
                            $lv->datoscliente = $this->datoscliente($lv->codigo);
                            //Obtener total descuento o recargo de una venta
                            $lv->totaldescuento = $this->totaldescuento($lv->codigo);
                            //Obtener el tiempo en minutos si es una venta reciente
                            $lv->ventareciente = $this->ventareciente($lv->codigo);
                        }
                    } else {
                        $listaventas = Sale::join("users as u", "u.id", "sales.user_id")
                            ->join("carteras as c", "c.id", "sales.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "sales.id as codigo",
                                "sales.created_at as fechaventa",
                                "u.name as nombreusuario",
                                "c.nombre as nombrecartera",
                                "sales.total as totalbs",
                                "sales.change as totalcambio",
                                "sales.status as estado",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as totaldescuento'),
                                DB::raw('0 as datoscliente'),
                                DB::raw('0 as ventareciente')
                            )
                            //->where("sales.status","PAID")
                            ->where("sales.sucursal_id", $this->sucursal_id)

                            ->whereBetween('sales.created_at', [$from, $to])
                            ->whereTime('sales.created_at', '>=', $this->timeFrom)
                            ->whereTime('sales.created_at', '<=', $this->timeTo . ':59')

                            ->orderBy("sales.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Llenando las columnas adicionales a la lsita de ventas
                        foreach ($listaventas as $lv) {
                            //Obtener el nombre de la sucursal de una venta
                            $lv->nombresucursal = $this->nombresucursal($lv->codigo);
                            //Obtener datos de un cliente de una venta
                            $lv->datoscliente = $this->datoscliente($lv->codigo);
                            //Obtener total descuento o recargo de una venta
                            $lv->totaldescuento = $this->totaldescuento($lv->codigo);
                            //Obtener el tiempo en minutos si es una venta reciente
                            $lv->ventareciente = $this->ventareciente($lv->codigo);
                        }
                    }
                } else {
                    if ($this->tipofecha == "hoy") {
                        $listaventas = Sale::join("users as u", "u.id", "sales.user_id")
                            ->join("carteras as c", "c.id", "sales.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "sales.id as codigo",
                                "sales.created_at as fechaventa",
                                "u.name as nombreusuario",
                                "c.nombre as nombrecartera",
                                "sales.total as totalbs",
                                "sales.change as totalcambio",
                                "sales.status as estado",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as totaldescuento'),
                                DB::raw('0 as datoscliente'),
                                DB::raw('0 as ventareciente')
                            )
                            //->where("sales.status","PAID")
                            ->where("sales.user_id", $this->user_id)
                            ->where("sales.sucursal_id", $this->sucursal_id)
                            ->whereBetween('sales.created_at', [Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00', Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59'])
                            ->orderBy("sales.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Llenando las columnas adicionales a la lsita de ventas
                        foreach ($listaventas as $lv) {
                            //Obtener el nombre de la sucursal de una venta
                            $lv->nombresucursal = $this->nombresucursal($lv->codigo);
                            //Obtener datos de un cliente de una venta
                            $lv->datoscliente = $this->datoscliente($lv->codigo);
                            //Obtener total descuento o recargo de una venta
                            $lv->totaldescuento = $this->totaldescuento($lv->codigo);
                            //Obtener el tiempo en minutos si es una venta reciente
                            $lv->ventareciente = $this->ventareciente($lv->codigo);
                        }
                    } else {
                        $listaventas = Sale::join("users as u", "u.id", "sales.user_id")
                            ->join("carteras as c", "c.id", "sales.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "sales.id as codigo",
                                "sales.created_at as fechaventa",
                                "u.name as nombreusuario",
                                "c.nombre as nombrecartera",
                                "sales.total as totalbs",
                                "sales.change as totalcambio",
                                "sales.status as estado",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as totaldescuento'),
                                DB::raw('0 as datoscliente'),
                                DB::raw('0 as ventareciente')
                            )
                            //->where("sales.status","PAID")
                            ->where("sales.user_id", $this->user_id)
                            ->where("sales.sucursal_id", $this->sucursal_id)

                            ->whereBetween('sales.created_at', [$from, $to])
                            ->whereTime('sales.created_at', '>=', $this->timeFrom)
                            ->whereTime('sales.created_at', '<=', $this->timeTo . ':59')

                            ->orderBy("sales.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Llenando las columnas adicionales a la lsita de ventas
                        foreach ($listaventas as $lv) {
                            //Obtener el nombre de la sucursal de una venta
                            $lv->nombresucursal = $this->nombresucursal($lv->codigo);
                            //Obtener datos de un cliente de una venta
                            $lv->datoscliente = $this->datoscliente($lv->codigo);
                            //Obtener total descuento o recargo de una venta
                            $lv->totaldescuento = $this->totaldescuento($lv->codigo);
                            //Obtener el tiempo en minutos si es una venta reciente
                            $lv->ventareciente = $this->ventareciente($lv->codigo);
                        }
                    }
                }
            } else {
                if ($this->user_id == "Todos") {
                    if ($this->tipofecha == "hoy") {
                        $listaventas = Sale::join("users as u", "u.id", "sales.user_id")
                            ->join("carteras as c", "c.id", "sales.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "sales.id as codigo",
                                "sales.created_at as fechaventa",
                                "u.name as nombreusuario",
                                "c.nombre as nombrecartera",
                                "sales.total as totalbs",
                                "sales.change as totalcambio",
                                "sales.status as estado",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as totaldescuento'),
                                DB::raw('0 as datoscliente'),
                                DB::raw('0 as ventareciente')
                            )
                            //->where("sales.status","PAID")
                            ->whereBetween('sales.created_at', [Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00', Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59'])
                            ->orderBy("sales.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Llenando las columnas adicionales a la lsita de ventas
                        foreach ($listaventas as $lv) {
                            //Obtener el nombre de la sucursal de una venta
                            $lv->nombresucursal = $this->nombresucursal($lv->codigo);
                            //Obtener datos de un cliente de una venta
                            $lv->datoscliente = $this->datoscliente($lv->codigo);
                            //Obtener total descuento o recargo de una venta
                            $lv->totaldescuento = $this->totaldescuento($lv->codigo);
                            //Obtener el tiempo en minutos si es una venta reciente
                            $lv->ventareciente = $this->ventareciente($lv->codigo);
                        }
                    } else {
                        $listaventas = Sale::join("users as u", "u.id", "sales.user_id")
                            ->join("carteras as c", "c.id", "sales.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "sales.id as codigo",
                                "sales.created_at as fechaventa",
                                "u.name as nombreusuario",
                                "c.nombre as nombrecartera",
                                "sales.total as totalbs",
                                "sales.change as totalcambio",
                                "sales.status as estado",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as totaldescuento'),
                                DB::raw('0 as datoscliente'),
                                DB::raw('0 as ventareciente')
                            )
                            //->where("sales.status","PAID")

                            ->whereBetween('sales.created_at', [$from, $to])
                            ->whereTime('sales.created_at', '>=', $this->timeFrom)
                            ->whereTime('sales.created_at', '<=', $this->timeTo . ':59')

                            ->orderBy("sales.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Llenando las columnas adicionales a la lsita de ventas
                        foreach ($listaventas as $lv) {
                            //Obtener el nombre de la sucursal de una venta
                            $lv->nombresucursal = $this->nombresucursal($lv->codigo);
                            //Obtener datos de un cliente de una venta
                            $lv->datoscliente = $this->datoscliente($lv->codigo);
                            //Obtener total descuento o recargo de una venta
                            $lv->totaldescuento = $this->totaldescuento($lv->codigo);
                            //Obtener el tiempo en minutos si es una venta reciente
                            $lv->ventareciente = $this->ventareciente($lv->codigo);
                        }
                    }
                } else {
                    if ($this->tipofecha == "hoy") {
                        $listaventas = Sale::join("users as u", "u.id", "sales.user_id")
                            ->join("carteras as c", "c.id", "sales.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "sales.id as codigo",
                                "sales.created_at as fechaventa",
                                "u.name as nombreusuario",
                                "c.nombre as nombrecartera",
                                "sales.total as totalbs",
                                "sales.change as totalcambio",
                                "sales.status as estado",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as totaldescuento'),
                                DB::raw('0 as datoscliente'),
                                DB::raw('0 as ventareciente')
                            )
                            //->where("sales.status","PAID")
                            ->where("sales.user_id", $this->user_id)
                            ->whereBetween('sales.created_at', [Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00', Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59'])
                            ->orderBy("sales.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Llenando las columnas adicionales a la lsita de ventas
                        foreach ($listaventas as $lv) {
                            //Obtener el nombre de la sucursal de una venta
                            $lv->nombresucursal = $this->nombresucursal($lv->codigo);
                            //Obtener datos de un cliente de una venta
                            $lv->datoscliente = $this->datoscliente($lv->codigo);
                            //Obtener total descuento o recargo de una venta
                            $lv->totaldescuento = $this->totaldescuento($lv->codigo);
                            //Obtener el tiempo en minutos si es una venta reciente
                            $lv->ventareciente = $this->ventareciente($lv->codigo);
                        }
                    } else {
                        $listaventas = Sale::join("users as u", "u.id", "sales.user_id")
                            ->join("carteras as c", "c.id", "sales.cartera_id")
                            ->join("cajas as cj", "cj.id", "c.caja_id")
                            ->select(
                                "sales.id as codigo",
                                "sales.created_at as fechaventa",
                                "u.name as nombreusuario",
                                "c.nombre as nombrecartera",
                                "sales.total as totalbs",
                                "sales.change as totalcambio",
                                "sales.status as estado",
                                DB::raw('0 as nombresucursal'),
                                DB::raw('0 as totaldescuento'),
                                DB::raw('0 as datoscliente'),
                                DB::raw('0 as ventareciente')
                            )
                            //->where("sales.status","PAID")
                            ->where("sales.user_id", $this->user_id)

                            ->whereBetween('sales.created_at', [$from, $to])
                            ->whereTime('sales.created_at', '>=', $this->timeFrom)
                            ->whereTime('sales.created_at', '<=', $this->timeTo . ':59')

                            ->orderBy("sales.created_at", "desc")
                            ->paginate($this->paginacion);

                        //Llenando las columnas adicionales a la lsita de ventas
                        foreach ($listaventas as $lv) {
                            //Obtener el nombre de la sucursal de una venta
                            $lv->nombresucursal = $this->nombresucursal($lv->codigo);
                            //Obtener datos de un cliente de una venta
                            $lv->datoscliente = $this->datoscliente($lv->codigo);
                            //Obtener total descuento o recargo de una venta
                            $lv->totaldescuento = $this->totaldescuento($lv->codigo);
                            //Obtener el tiempo en minutos si es una venta reciente
                            $lv->ventareciente = $this->ventareciente($lv->codigo);
                        }
                    }
                }
            }
        } else {
            $listaventas = Sale::join("users as u", "u.id", "sales.user_id")
                ->join("carteras as c", "c.id", "sales.cartera_id")
                ->join("cajas as cj", "cj.id", "c.caja_id")
                ->select(
                    "sales.id as codigo",
                    "sales.created_at as fechaventa",
                    "u.name as nombreusuario",
                    "c.nombre as nombrecartera",
                    "sales.total as totalbs",
                    "sales.change as totalcambio",
                    "sales.status as estado",
                    DB::raw('0 as nombresucursal'),
                    DB::raw('0 as totaldescuento'),
                    DB::raw('0 as datoscliente'),
                    DB::raw('0 as ventareciente')
                )



                ->where('sales.id', 'like', '%' . $this->search . '%')


                ->orderBy("sales.created_at", "desc")
                ->paginate($this->paginacion);

            //Llenando las columnas adicionales a la lsita de ventas
            foreach ($listaventas as $lv) {
                //Obtener el nombre de la sucursal de una venta
                $lv->nombresucursal = $this->nombresucursal($lv->codigo);
                //Obtener datos de un cliente de una venta
                $lv->datoscliente = $this->datoscliente($lv->codigo);
                //Obtener total descuento o recargo de una venta
                $lv->totaldescuento = $this->totaldescuento($lv->codigo);
                //Obtener el tiempo en minutos si es una venta reciente
                $lv->ventareciente = $this->ventareciente($lv->codigo);
            }
        }






        $usuarios = User::select("users.*")
            ->where("users.status", "ACTIVE")
            ->get();



        return view('livewire.sales.salelist', [
            'listaventas' => $listaventas,
            'listasucursales' => Sucursal::all(),
            'usuarios' => $usuarios
        ])
            ->extends('layouts.theme.app')
            ->section('content');
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
        $venta = Sale::find($idventa);

        $cartera = Cartera::find($venta->cartera_id);

        $sucursal_id = Caja::find($cartera->caja_id)->sucursal_id;

        $nombresucursal = Sucursal::find($sucursal_id)->name;

        return $nombresucursal;
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
    //Devuelve CI, nombre y celular del cliente
    public function datoscliente($idventa)
    {
        $datoscliente = Cliente::join("cliente_movs as cm", "cm.cliente_id", "clientes.id")
            ->join("movimientos as m", "m.id", "cm.movimiento_id")
            ->join("sales as s", "s.movimiento_id", "m.id")
            ->select("clientes.nombre as nombrecliente", "clientes.cedula as cedulacliente", "clientes.celular as celularcliente")
            ->where("s.id", $idventa)
            ->get();

        return $datoscliente;
    }
    //Devuelve descuento o recargo de una venta
    public function totaldescuento($idventa)
    {
        $descuento = SaleDetail::join('sales as s', 's.id', 'sale_details.sale_id')
            ->join("products as p", "p.id", "sale_details.product_id")
            ->select(
                'sale_details.id as detalleid',
                'p.image as image',
                'p.nombre as nombre',
                'p.precio_venta as po',
                DB::raw('0 as po'),
                'sale_details.price as pv',
                'sale_details.quantity as cantidad'
            )
            ->where('sale_details.sale_id', $idventa)
            ->orderBy('sale_details.id', 'asc')
            ->get();


        foreach ($descuento as $dx) {
            $po = SaleLote::join("lotes as l", "l.id", "sale_lotes.lote_id")
                ->select("l.pv_lote as precio_original")
                ->where("sale_lotes.sale_detail_id", $dx->detalleid)
                ->first();

            if ($po != null) {
                $dx->po = $po->precio_original;
            }
        }

        $totaldescuento = 0;
        foreach ($descuento as $d) {
            $totaldescuento = (($d->pv - $d->po) * $d->cantidad) + $totaldescuento;
        }
        return $totaldescuento;
    }
    //Devuelve el tiempo en minutos de una venta reciente
    public function ventareciente($idventa)
    {
        // Crear una instancia de Carbon a partir de la fecha de transacción
        $transaction_carbon = Sale::find($idventa)->created_at;

        // Obtener la diferencia en minutos entre la fecha de transacción y la fecha actual
        $diff_in_minutes = Carbon::now()->diffInMinutes($transaction_carbon);

        return $diff_in_minutes;
    }
    //Llama y muestra detalles de una venta
    public function modaldetalle($idventa)
    {
        $this->detalleventa($idventa);
        $this->emit('modaldetalles-show');
    }
    //Actualizar las variables globales de los detalles de una venta
    public function detalleventa($idventa)
    {
        //Listando todos los productos, cantidades, precio, etc...
        $this->detalle_venta = SaleDetail::join('sales as s', 's.id', 'sale_details.sale_id')
            ->join("products as p", "p.id", "sale_details.product_id")
            ->select(
                'sale_details.id as detalleid',
                'p.id as idproducto',
                'p.image as image',
                'p.nombre as nombre',
                'sale_details.price as pv',
                'sale_details.quantity as cantidad',
                'sale_details.id as sid',
                DB::raw('0 as po')
            )
            ->where('sale_details.sale_id', $idventa)
            ->orderBy('sale_details.id', 'asc')
            ->get();


        foreach ($this->detalle_venta as $d) {
            $po = SaleLote::join("lotes as l", "l.id", "sale_lotes.lote_id")
                ->select("l.pv_lote as precio_original")
                ->where("sale_lotes.sale_detail_id", $d->detalleid)
                ->first();

            if ($po != null) {
                $d->po = $po->precio_original;
            }
        }




        //Obteniendo detalles generales (observacion, total Bs, etc..) de una venta
        $this->venta = Sale::find($idventa);

        //Obteniendo la cantidad total de los productos de una venta
        $detalle = SaleDetail::select('sale_details.*')
            ->where('sale_details.sale_id', $idventa)
            ->get();
        $totalcantidad = 0;
        foreach ($detalle as $d) {
            $totalcantidad = $d->quantity + $totalcantidad;
        }
        $this->totalitems = $totalcantidad;


        //obteniendo la cantidad total de Bs en Descuento o Recargo
        $descuento = SaleDetail::join('sales as s', 's.id', 'sale_details.sale_id')
            ->join("products as p", "p.id", "sale_details.product_id")
            ->select(
                'sale_details.id as detalleid',
                'p.image as image',
                'p.nombre as nombre',
                DB::raw('0 as po'),
                'sale_details.price as pv',
                'sale_details.quantity as cantidad'
            )
            ->where('sale_details.sale_id', $idventa)
            ->orderBy('sale_details.id', 'asc')
            ->get();

        foreach ($descuento as $des) {
            $po = SaleLote::join("lotes as l", "l.id", "sale_lotes.lote_id")
                ->select("l.pv_lote as precio_original")
                ->where("sale_lotes.sale_detail_id", $des->detalleid)
                ->first();

            if ($po != null) {
                $des->po = $po->precio_original;
            }
        }




        $descuento_recargo = 0;
        foreach ($descuento as $d) {
            $descuento_recargo = (($d->pv - $d->po) * $d->cantidad) + $descuento_recargo;
        }
        $this->desc_rec = $descuento_recargo;
    }
    //Mostrar u Ocultar Mas filtros en la Vista
    public function mostrarocultarmasfiltros()
    {
        if ($this->masfiltros) {
            $this->usuario = 'Todos';
            $this->tipofecha = 'Todos';
            $this->masfiltros = false;
        } else {
            $this->masfiltros = true;
        }
    }
    //Escucha los eventos javascript de la vista
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

            $this->venta_id = $idventa;
            DB::commit();
            $this->emit('sale-cancel-ok');
        } catch (Exception $e) {
            DB::rollback();
            $this->mensaje = $e->getMessage();
            $this->emit('sale-error');
        }
    }
    //Llama a la ventana modal para cambiar usuario vendedor
    public function modalcambiarusuario($idventa)
    {
        $this->venta_id = $idventa;
        $venta = Sale::find($idventa);
        $this->nombreusuariovendedor = User::find($venta->user_id)->name;
        $this->emit('modalcambiarusuario-show');
    }
    //Cambia el id del usuario vendedor por otro
    public function seleccionarusuario($idusuario)
    {
        $venta = Sale::find($this->venta_id);
        $venta->update([
            'user_id' => $idusuario,
        ]);
        $venta->save();
        $username = User::find($venta->user_id)->name;
        $this->mensaje = "¡Usuario Vendedor Cambiado a : " . $username . " Cambiado Exitósamente!";
        $this->emit('modalcambiarusuario-hide');
    }
    //Crear Comprobante de Ventas
    public function crearcomprobante($idventa)
    {
        $this->venta_id = $idventa;
        $this->detalleventa($idventa);
        $this->emit('crear-comprobante');
    }
    //Redirige para Editar una Venta
    public function editsale($idventa)
    {
        session(['venta_id' => $idventa]);
        $this->redirect('editarventa');
    }
}
