<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Company;
use App\Models\Cotization;
use App\Models\CotizationDetail;
use App\Models\Sucursal;
use Maatwebsite\Excel\Facades\Excel;


class ExportCotizationController extends Controller
{
    public function PDFCotization($idcotization)
    {
        $cotization = Cotization::find($idcotization);

        $cotization_detalle = CotizationDetail::join("products as p","p.id","cotization_details.product_id")
        ->select("p.nombre as nombre","cotization_details.price as precio","cotization_details.quantity as cantidad")
        ->where("cotization_details.cotization_id",$idcotization)
        ->get();
        
        $fecha = Carbon::parse(Carbon::now());
        $nombreempresa = Company::find(1)->name;
        $logoempresa = Company::find(1)->image;

        //Obtener datos de la sucursal
        $datossucursal = Sucursal::select("sucursals.name as nombresucursal","sucursals.adress as direccionsucursal","sucursals.telefono as telefono","sucursals.celular as celular")
        ->where("sucursals.id", $cotization->sucursal_id)
        ->first();

        //Obtener Datos del cliente
        $datoscliente = Cliente::where("clientes.id",$cotization->cliente_id)->first();
        $fechacotizacion = $cotization->created_at;

        $nombreusuario = User::join("cotizations as c","c.user_id","users.id")
        ->select("users.name as nombreusuario")
        ->where("users.id",$cotization->user_id)
        ->first()->nombreusuario;



        $totalitems = $cotization_detalle->sum("cantidad");
        $totalbs = 0;

        foreach ($cotization_detalle as $key)
        {
            $totalbs = $totalbs + ($key['precio'] * $key['cantidad']);
        }

        $fechafinalizacion = $cotization->finaldate;


        $pdf = PDF::loadView('livewire.pdf.cotization', compact('idcotization','nombreempresa','logoempresa','fechafinalizacion',
        'datossucursal','datoscliente','fechacotizacion','nombreusuario','cotization_detalle','totalitems','totalbs'));

        return $pdf->stream('Cotización N°' . $idcotization . '.pdf');  //visualizar
        /* return $pdf->download('salesReport.pdf');  //descargar  */
    }
}
