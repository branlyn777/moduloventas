<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Company;
use App\Models\Sucursal;
use Maatwebsite\Excel\Facades\Excel;


class ExportSaleController extends Controller
{
    public function reportPDFVenta($total, $idventa,$totalitems)
    {
        //Buscar Nombre del Usuario
        $nombreusuario = User::join("sales as s", "s.user_id", "users.id")
        ->select("users.name as name")
        ->where("s.id", $idventa)
        ->get()
        ->first();
        //Obtener datos de la Venta
        $venta = Sale::join("sale_details as sd", "sd.sale_id", "sales.id")
        ->join("products as p", "p.id", "sd.product_id")
        ->select("sales.created_at as fechaventa", "sales.items as items", "p.nombre as nombre", "sd.price as precio","sd.quantity as cantidad")
        ->where("sales.id", $idventa)
        ->get();

        $totalitems = $venta->first()->items;

        //Obtener Datos del cliente
        $datoscliente = Cliente::join("cliente_movs as cm", "cm.cliente_id", "clientes.id")
        ->join("movimientos as m", "m.id", "cm.movimiento_id")
        ->join("sales as s", "s.movimiento_id", "m.id")
        ->select("s.id as id", "clientes.razon_social as razonsocial", "clientes.cedula as cedula", "clientes.celular as celular", "clientes.nombre as nombrecliente")
        ->where("s.id", $idventa)
        ->get()
        ->first();

        //Obtener datos de la sucursal
        $datossucursal = Sucursal::join("sales as s", "s.sucursal_id", "sucursals.id")
        ->select("sucursals.name as nombresucursal","sucursals.adress as direccionsucursal")
        ->where("s.id", $idventa)
        ->get()
        ->first();

        // SELECT s.name as nombresucursal,s.adress as direccionsucursal, su.user_id
        // FROM sucursals s
        // INNER JOIN sucursal_users su ON su.sucursal_id = s.id
        // where su.user_id=2

        $row_venta = Sale::find($idventa);
        $total = $row_venta->total;

        $fecha = Carbon::parse(Carbon::now());
        $nombreempresa = Company::find(1)->name;
        $logoempresa = Company::find(1)->image;

        $pdf = PDF::loadView('livewire.pdf.comprobanteventa', compact('idventa','datoscliente','venta','nombreusuario','fecha','total','totalitems','datossucursal','nombreempresa','logoempresa'));

        return $pdf->stream('comprobante N°' . $idventa . '.pdf');  //visualizar
        /* return $pdf->download('salesReport.pdf');  //descargar  */
    }
}
