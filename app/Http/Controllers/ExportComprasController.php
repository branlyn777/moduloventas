<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\DetalleOrdenCompra;
use App\Models\OrdenCompra;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Sucursal;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;


class ExportComprasController extends Controller
{
    public $nro,$totales,$data;
    
    public function reporteComprasPdf($filtro,$fecha, $dateFrom , $dateTo,$search=null)
    {
        $this->nro=1;
        $nro=$this->nro;
       
        $totales=$this->totales;

        if (strlen($search) > 0){

            $this->data = Compra::join('movimiento_compras as mov_compra','compras.id','mov_compra.id')
                                ->join('movimientos as mov','mov_compra.id','mov.id')
                                ->join('users','mov.user_id','users.id')
                                ->join('providers as prov','compras.proveedor_id','prov.id')
                                ->select('compras.*','compras.id as compras_id','mov.*','prov.nombre_prov as nombre_prov','users.name')
                                ->where('compras.transaccion',$filtro)
                                ->where('nombre', 'like', '%' . $search . '%')
                                ->orWhere('users.name', 'like', '%' . $search . '%')
                                ->orWhere('compras.id', 'like', '%' . $search . '%')
                                ->orWhere('compras.created_at', 'like', '%' . $search . '%')
                                ->orWhere('compras.status', 'like', '%' . $search . '%')
                                ->get();
            $this->totales = $this->data->sum('importe_total');

        }
        else{
            $this->data= Compra::join('movimiento_compras as mov_compra','compras.id','mov_compra.id')
                                ->join('movimientos as mov','mov_compra.id','mov.id')
                                ->join('users','mov.user_id','users.id')
                                ->join('providers as prov','compras.proveedor_id','prov.id')
                                ->select('compras.*','compras.status as status_compra','mov.*','prov.nombre_prov as nombre_prov','users.name')
                                ->whereBetween('compras.created_at',[$dateFrom,$dateTo])
                                ->where('compras.transaccion',$filtro)
                                ->orderBy('compras.fecha_compra')
                                ->get();

        $this->totales = $this->data->sum('importe_total');
        }

        $data=$this->data;
      
       $nro= $this->nro;
       $totales=$this->totales;
       $nombreempresa = Company::find(1)->name;
       $logoempresa = Company::find(1)->image;

       $datossucursal = Sucursal::join("sucursal_users as su", "su.sucursal_id", "sucursals.id")
       ->select("sucursals.name as nombresucursal","sucursals.adress as direccionsucursal", "su.user_id")
       ->where("su.user_id", Auth()->user()->id)
       ->get()
       ->first();

        $pdf = PDF::loadView('livewire.pdf.reporteCompras', compact('data', 'filtro', 'fecha','dateFrom', 'dateTo', 'dateTo','nro','totales','datossucursal','nombreempresa','logoempresa'));

        return $pdf->stream('ComprasReport.pdf');  //visualizar
        /* return $pdf->download('salesReport.pdf');  //descargar  */
    }

    public function PrintCompraPdf($id){
      
        $datossucursal = Sucursal::join("sucursal_users as su", "su.sucursal_id", "sucursals.id")
        ->select("sucursals.name as nombresucursal","sucursals.adress as direccionsucursal", "su.user_id")
        ->where("su.user_id", Auth()->user()->id)
        ->get()
        ->first();
        $cp=Compra::find($id);

        
        $totalitems=$cp->compradetalle()->sum('cantidad');
        $observacion=$cp->observacion;
        $totaliva=0;
        $totales=$cp->importe_total;
        
        if ($cp->tipo_doc == 'FACTURA') {
            
            $mm=$cp->compradetalle()->get();
            $totaliva=$mm->sum(function($cp) {
                return (($cp->cantidad*$cp->precio)/0.87)*0.13;
            });
        }

 
        $nombreempresa = Company::find(1)->name;
        $logoempresa = Company::find(1)->image;
            $data= Compra::join('providers as prov','compras.proveedor_id','prov.id')->select('compras.*','compras.id as compra_id','prov.*')->where('compras.id',$id)->first();
            $detalle=CompraDetalle::join('products as prod','compra_detalles.product_id','prod.id')->select('compra_detalles.*','prod.*')->where('compra_id',$id)->get();
            $nro= $this->nro+1;
   
            $pdf = PDF::loadView('livewire.pdf.ImprimirCompra',compact('data','detalle','nro','logoempresa','nombreempresa','datossucursal','totalitems','totales','totaliva'));

            return $pdf->stream('CompraDetalle.pdf');  //visualizar
            /* return $pdf->download('salesReport.pdf');  //descargar  */
    }
    public function PrintOrdenCompraPdf($id){
        $datossucursal = Sucursal::join("sucursal_users as su", "su.sucursal_id", "sucursals.id")
        ->select("sucursals.name as nombresucursal","sucursals.adress as direccionsucursal", "su.user_id")
        ->where("su.user_id", Auth()->user()->id)
        ->get()
        ->first();
        $cp=OrdenCompra::find($id);

        
        $totalitems=$cp->detallecompra()->sum('cantidad');
        $observacion=$cp->observacion;
   
        $totales=$cp->importe_total;
        $fecha_orden_compra=$cp->created_at;
        $nombre_usuario= $cp->usuario->name;
     
 
        $nombreempresa = Company::find(1)->name;
        $logoempresa = Company::find(1)->image;

            $data= OrdenCompra::join('providers as prov','orden_compras.proveedor_id','prov.id')
            ->select('orden_compras.*','orden_compras.id as compra_id','prov.*')
            ->where('orden_compras.id',$id)
            ->first();

            $detalle=DetalleOrdenCompra::join('products as prod','detalle_orden_compras.product_id','prod.id')
            ->select('detalle_orden_compras.*','prod.*')
            ->where('orden_compra',$id)
            ->get();
            $nro= $this->nro+1;
   
            $pdf = PDF::loadView('livewire.pdf.ImprimirOrdenCompra',compact('data','detalle','nro','logoempresa','nombreempresa','datossucursal','totalitems','totales','fecha_orden_compra','nombre_usuario'));

            return $pdf->stream('OrdenCompraDetalle'.$cp->id.'.pdf');  //visualizar
            /* return $pdf->download('salesReport.pdf');  //descargar*/
    }

}
