<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Lote;
use App\Models\ProductosDestino;
use App\Models\SaleLote;
use App\Models\SalidaLote;
use App\Models\Sucursal;
use App\Models\TransferenciaLotes;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ComprasController extends Component
{
    use WithPagination;
    use WithFileUploads;
    private $pagination = 5;
    public $fromDate,$toDate,
            $from,
            $to,
            $filtro,
            $criterio,
           $total_compras,
            $nro,
            $fecha,
            $search,
            $datas_compras,
            $totales,
            $aprobado,$detalleCompra,$ventaTotal,$observacion,$totalitems,$compraTotal,$totalIva,$sucursal_id,$user_id,$tipofecha;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->nro=1;
        $this->filtro='Contado';
        $this->fecha='hoy';
        $this->fromDate = Carbon::parse(Carbon::now())->format('Y-m-d');
  
        $this->toDate =  Carbon::parse(Carbon::now())->format('Y-m-d');
    }
    public function render()
    {
        
        $this->consultar();
        $this->datas_compras= Compra::join('providers as prov','compras.proveedor_id','prov.id')
        ->join('users','users.id','compras.user_id')
        ->select('compras.*','compras.id as compra_id','compras.status as status_compra','prov.nombre_prov as nombre_prov','users.name')
        ->whereBetween('compras.created_at',[$this->from,$this->to])
        ->where('compras.transaccion',$this->filtro)
        ->orderBy('compras.created_at','desc')
        ->get();

        $this->totales = $this->datas_compras->sum('importe_total');

        if (strlen($this->search) > 0){
            $this->datas_compras = Compra::join('users','compras.user_id','users.id')
            ->join('providers as prov','compras.proveedor_id','prov.id')
            ->select('compras.*','compras.status as status_compra','prov.nombre_prov as nombre_prov','users.name as username')
            ->whereBetween('compras.created_at',[$this->from,$this->to])
            ->where('nombre_prov', 'like', '%' . $this->search . '%')
            ->orWhere('nro_documento', 'like', '%' . $this->search . '%')
            ->orWhere('users.name', 'like', '%' . $this->search . '%')
            ->orderBy('compras.created_at','desc')
            ->get();
            $this->totales = $this->datas_compras->sum('importe_total');
        }

        
        $usuarios = User::select("users.*")
        ->where("users.status","ACTIVE")
        ->get();
        return view('livewire.compras.component',
        ['data_compras'=>$this->datas_compras, 
        'totales'=>$this->totales,
        'listasucursales' => Sucursal::all(),
        'usuarios' => $usuarios])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    
    public function consultar()
    {
        if ($this->fecha == 'hoy') {
            $this->fromDate = Carbon::now();
            $this->toDate = Carbon::now();
            $this->from = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
            $this->to = Carbon::parse($this->toDate)->format('Y-m-d')     . ' 23:59:59';
        }
        if ($this->fecha == 'ayer') {

            $this->fromDate = Carbon::yesterday();
            $this->toDate = Carbon::yesterday();
            $this->from = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
            $this->to = Carbon::parse($this->toDate)->format('Y-m-d')     . ' 23:59:59';
        }
        if ($this->fecha == 'semana') 
        {   $this->toDate = Carbon::now();
            $this->fromDate = $this->toDate->subWeeks(1);
            $this->from = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
            $this->to = Carbon::parse(Carbon::now())->format('Y-m-d')     . ' 23:59:59';
        }

        else{
            $this->from = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
            $this->to = Carbon::parse($this->toDate)->format('Y-m-d')     . ' 23:59:59';
        }
  
    }

    
    public function editarCompra($id)
    {
        session(['id_compra' => null]);
        session(['id_compra' => $id]);
        return redirect()->route('editcompra');
    }
    protected $listeners = ['deleteRow' => 'Destroy'];
    public function Destroy(Compra $compra_edit)
    {
        //dd($compra_edit);
        //si el lote de la compra de un producto ha tenido una venta, ha sido transferido o ha tenido una salida del producto de ese lote no se puede anular la compra
            foreach ($compra_edit->compradetalle as $data) 
            {
                ProductosDestino::where('destino_id',$compra_edit->destino_id)
                ->where('product_id',$data->product_id)
                ->decrement('stock',$data->cantidad);

                $lot=Lote::join('compra_detalles','compra_detalles.lote_compra','lotes.id')
                ->where('compra_detalles.id',$data->id)
                ->delete();
                
            }
            $compra_edit->update(['status'=>'INACTIVO']);
            $this->emit('purchase-deleted', 'Compra Anulada');
    }

    public function VerDetalleCompra(Compra $id){
        $this->compraTotal=$id->importe_total;
        $this->totalitems=$id->compradetalle()->sum('cantidad');
        $this->observacion=$id->observacion;
        
        if ($id->tipo_doc == 'FACTURA') {
            
            $mm=$id->compradetalle()->get();
            $this->totalIva=$mm->sum(function($cp) {
                return (($cp->cantidad*$cp->precio)/0.87)*0.13;
            });
        }
        $this->detalleCompra= $id->compradetalle()->where('deleted_at','!=','')->get();
        $this->emit('verDetalle');


   
        //dd($this->detalleCompra);
    }

    public function Confirm($compra_edit){
        
        if ($this->verificardistribucion($compra_edit)) {
            
            $this->emit('erroreliminarCompra');
        }
        else{
            
            $this->emit('preguntareliminarCompra',$compra_edit);
           
        }
    }

    public function verificardistribucion($compra_edit){

        $lotes=CompraDetalle::where('compra_id',$compra_edit)->get('lote_compra');
        $ventas= SaleLote::whereIn('lote_id',$lotes)->get();
        $salidas=SalidaLote::whereIn('lote_id',$lotes)->get();
        $transferencias=TransferenciaLotes::whereIn('lote_id',$lotes)->get();
     

        if (!$ventas->isEmpty() or !$salidas->isEmpty() or !$transferencias->isEmpty()) {
            return true;
        }
        else{
            return false;
        }

        //dd($ventas);
    }
  
}
