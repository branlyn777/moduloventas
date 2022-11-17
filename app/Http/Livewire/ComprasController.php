<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Lote;
use App\Models\ProductosDestino;
use App\Models\SaleLote;
use App\Models\SalidaLote;
use App\Models\Sucursal;
use App\Models\SucursalUser;
use App\Models\TransferenciaLotes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ComprasController extends Component
{
    use WithPagination;
    use WithFileUploads;
    private $pagination = 15;
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
            $aprobado,$detalleCompra,$estado,$ventaTotal,$observacion,$totalitems,$compraTotal,$totalIva,$sucursal_id,$user_id,$tipofecha,$compraProducto,$search2;

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
        $this->sucursal_id=SucursalUser::where('user_id',Auth()->user()->id)->first()->sucursal_id;
        $this->estado='ACTIVO';
    }
    public function render()
    {
        
        $this->consultar();
        $datas_compras= Compra::join('users','compras.user_id','users.id')
        ->join('providers as prov','compras.proveedor_id','prov.id')
        ->select('compras.transaccion','compras.importe_total as imp_tot','compras.status'
        ,'prov.nombre_prov as nombre_prov',
        'users.name as username',
        'compras.nro_documento','compras.id')
        ->whereBetween('compras.created_at',[$this->from,$this->to])
        ->where(function ($query){
            $query->where('nombre_prov', 'like', '%' . $this->search . '%')
            ->orWhere('nro_documento', 'like', '%' . $this->search . '%')
            ->orWhere('users.name', 'like', '%' . $this->search . '%');
        })
        ->when($this->sucursal_id != 'Todos', function($query){
            $mn=[];
            $arr=Sucursal::find($this->sucursal_id);
            foreach ($arr->destinos as $data) {
                array_push($mn,$data->id);
            }
            //dd($mn);
            return $query->whereIn('compras.destino_id',$mn);
        })
        ->when($this->estado != 'Todos', function($query){
            return $query->where('compras.status',$this->estado);
        });
        
       // dd($datas_compras->get());

        $this->totales = $datas_compras->sum('compras.importe_total');

        if ($this->search2 != null) {
            $this->compraProducto=
        }
        



        //$this->compraProducto= 














        $usuarios = User::select("users.*")
        ->where("users.status","ACTIVE")
        ->get();
        return view('livewire.compras.component',
        ['data_compras'=>$datas_compras->paginate($this->pagination), 
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
        $this->detalleCompra= $id->compradetalle()->where('deleted_at','=',null)->get();
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

    public function VerComprasProducto(){
        $this->emit('comprasproducto');
    }
    public function VerProductosProveedor(){
        $this->emit('productoproveedor');
    }
  
}
