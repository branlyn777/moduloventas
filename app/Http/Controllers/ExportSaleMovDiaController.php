<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lote;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleLote;
use Barryvdh\DomPDF\Facade as PDF;

class ExportSaleMovDiaController extends Controller
{
    public function reportPDFMovDiaVenta()
    {
        $data = session('tablareporte');
        $datostablareporte = session('datostablareporte');


        $total_ingreso = 0;
        $total_egreso = 0;
        $total_utilidad = 0;



        foreach ($data as &$item)
        {

            //Obteniendo la utilidad
            $venta = $this->buscarventa($item['idmovimiento']);
            if($venta->first() != null)
            {
                $utilidad = $this->buscarutilidad($this->buscarventa($item['idmovimiento'])->first()->idventa);
                $item['utilidad'] = $utilidad;
            }
            else
            {
                $item['utilidad'] = ($item['d_price'] - $item['d_cost']) * -1;
            }


            //Obteniendo los totales
            if($item['tipo'] == "INGRESO")
            {
                $total_ingreso = $total_ingreso + $item['importe'];
            }
            else
            {
                $total_egreso = $total_egreso + $item['importe'];
            }
            $total_utilidad = $total_utilidad + $item['utilidad'];
        }

        // dd($data);

        $pdf = PDF::loadView('livewire.pdf.reportemovdiaventas', compact('data','total_ingreso','total_egreso','total_utilidad','datostablareporte'));
        return $pdf->stream('Reporte_Movimiento_Diario.pdf'); 
    }
    //Buscar Ventas por Id Movimiento
    public function buscarventa($idmovimiento)
    {
        $venta = Sale::join('movimientos as m', 'm.id', 'sales.movimiento_id')
                ->select('sales.id as idventa')
                ->where('sales.movimiento_id',$idmovimiento)
                ->get();
        return $venta;
    }
    //Devuelve el total utilidad de una venta
    public function buscarutilidad($idventa)
    {
        $auxi = 0;

        $utilidad_total = 0;

        $detalle_venta = SaleDetail::where('sale_id', $idventa)->get();
        foreach ($detalle_venta as $d) 
        {
            $sl = SaleLote::where('sale_detail_id', $d->id)->get();
            foreach ($sl as $s) 
            {

                $costo_lote = Lote::where('id', $s->lote_id)->value('costo');

                $auxi = ($d->price * $s->cantidad) - ($costo_lote * $s->cantidad);

                $utilidad_total = $utilidad_total + $auxi;
            }
        }

        return $utilidad_total;
    }

}
