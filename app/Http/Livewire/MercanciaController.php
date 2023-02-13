<?php

namespace App\Http\Livewire;

use App\Imports\StockImport;
use App\Models\Ajustes;
use App\Models\CompraDetalle;
use App\Models\Destino;
use App\Models\DetalleAjustes;
use App\Models\DetalleEntradaProductos;
use App\Models\DetalleOperacion;
use App\Models\DetalleSalidaProductos;
use App\Models\IngresoProductos;
use App\Models\IngresoSalida;
use App\Models\Lote;
use App\Models\Product;
use App\Models\ProductosDestino;
use App\Models\SaleDetail;
use App\Models\SaleLote;
use App\Models\SalidaLote;
use App\Models\SalidaProductos;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Session\ExistenceAwareInterface;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class MercanciaController extends Component
{

    use WithPagination;
    use WithFileUploads;
    public  $fecha,$buscarproducto=0,$selected,$registro,$tipo_de_operacion,$qq,$lotecantidad,
    $archivo,$operacion,$search,$mensaje_toast,$costo,$ajuste,$sm,$concepto,$destino,$detalle,$tipo_proceso,$col,$destinosucursal,$observacion,$cantidad,$result,$arr,$id_operacion,$destino_delete,$nextpage,$fromDate,$toDate;
    private $pagination = 15;

    public function paginationView()    
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
       

        $this->fromDate = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->toDate =  Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->tipo_de_operacion=null;
        //Carbon::parse(now())->toDateTimeString()

    }
    public function render()
    {
        switch ($this->tipo_de_operacion) {
            case 'Ajuste':
                $this->operacion =Ajustes::join('destinos','destinos.id','ajustes.destino')
                ->join('users','users.id','ajustes.user_id')
                ->whereBetween('ajustes.created_at', [Carbon::parse($this->fromDate)->toDateTimeString(), Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->select('ajustes.*','destinos.nombre','users.name')
                ->get();
                break;
            case 'Inicial':
                $this->operacion = IngresoProductos::join('destinos','destinos.id','ajustes.detino')
                ->join('users','users.id','ajustes.user_id')
                ->whereBetween('ajustes.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->get();
                break;
            case 'Varios':
                $this->operacion =IngresoProductos::join('destinos','destinos.id','ajustes.detino')
                ->join('users','users.id','ajustes.user_id')
                ->whereBetween('ajustes.created_at', [Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59'])
                ->get();
                break;
                default:
          
                break;
        }

   
        




        return view('livewire.entradas_salidas.component')
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Seleccionar(Product $id){
       
        $this->result= $id->nombre;
        $this->selected=$id->id;
        $this->searchproduct=null;
        // $this->emit('operacion-added');
    }
    
 


   

public function ver($id,$tipo){

    if ($tipo =='ajuste') {
        $this->detalle= DetalleAjustes::where('id_ajuste',$id)->get();
        $this->observacion=Ajustes::find($id)->observacion;
        $this->emit('show-detail');
        $this->ajuste=$id;
    }
}


protected $listeners = ['eliminar_registro_operacion' => 'eliminar_registro_operacion', 'eliminar_registro_total'=>'eliminar_registro_total'];

public function verificarOperaciones($id)
{

    $operaciones=0;
    if ($this->tipo_de_operacion == 'Entrada') {
     
        // Buscamos el detalle de ingreso producto
        $auxi1=IngresoProductos::join('detalle_entrada_productos','detalle_entrada_productos.id_entrada','ingreso_productos.id')
        ->join('lotes','detalle_entrada_productos.lote_id','lotes.id')
        ->where('ingreso_productos.id',$id)
        ->select('lotes.*')
        ->get();

        // Recorremos los lotes obtenidos de la operacion entrada para verificar si tiene salidas o ventas de esos lotes
        foreach ($auxi1 as $data) {
        //Aumentamos el contador de operaciones si tiene relaciones con ventas y salidas de productos
            SaleLote::where('lote_id',$data->lote_id)->get()->count()>0 ? $operaciones++:'';
            SalidaLote::where('lote_id',$data->lote_id)->get()->count()>0 ? $operaciones++:'';
        }

        if ($operaciones>0) {
            //Mostramos un mensaje de error si existe relaciones con el sistema
            $this->emit('operacion_fallida');
        }
        else{

            //Si no tiene operaciones relacionadas se podra eliminar el registro, llama al metodo de eliminar registro una vez confirmado
                $this->emit('confirmareliminacion');
               
                $this->id_operacion= $id;
                $this->destino_delete=$auxi1->first()->destino;
      
        }

    }
    else{
        $this->emit('confirmareliminacion');
        $this->id_operacion= $id;

    }

}


public function eliminar_registro_operacion()
{

    if ($this->tipo_de_operacion == 'Entrada') {
    
        $detalle=DetalleEntradaProductos::where('id_entrada',$this->id_operacion)->get();
        foreach ($detalle as $data) {
            $data->delete();
            $lot=Lote::find($data->lote_id);
            $lot->delete();
    
            $q=ProductosDestino::where('product_id',$data->product_id)
            ->where('destino_id',$this->destino_delete)->value('stock');

            $gh=ProductosDestino::where(['product_id'=>$data->product_id,
            'destino_id'=>$this->destino_delete,
        ]);

        $gh->update([
            'stock'=>$q-$data->cantidad
        ]);

            
        }
        $del=IngresoProductos::find($this->id_operacion);
        $del->delete();
        $this->mensaje_toast = 'Registro eliminado';
        $this->emit('item-deleted');
      
    }
    else{
        $detalle=DetalleSalidaProductos::where('id_salida',$this->id_operacion)->get();
        foreach ($detalle as $data) {
            $data->delete();
   

    
            $q=ProductosDestino::where('product_id',$data->product_id)
            ->where('destino_id',$this->destino_delete)->value('stock');

            $gh=ProductosDestino::where(['product_id'=>$data->product_id,
            'destino_id'=>$this->destino_delete
        ]);

        $gh->update([
            'stock'=>$q+$data->cantidad
        ]);
    
            
        }
        $del=SalidaProductos::find($this->id_operacion);
        $del->delete();
        $this->mensaje_toast = 'Registro eliminado';
        $this->emit('item-deleted');
    }
   

}


public function eliminar_registro_total()
{
   
    $rel=DetalleEntradaProductos::where('id_entrada',$this->ing_prod_id)->get();
    foreach ($rel as $data) {
        
        
        $lot=Lote::find($data->lote_id);
        $data->delete();
        $lot->delete();

        $q=ProductosDestino::where('product_id',$data->product_id)
        ->where('destino_id',$this->destino_delete);
     
        $q->delete();

    }
    $del=IngresoProductos::find($this->ing_prod_id);
    $del->delete();
    $this->mensaje_toast = 'Registro eliminado';
    $this->emit('item-deleted');

}

public function ValidarDatos(){
    $rules = [
        'destino' => 'required|not_in:Elegir',
        'observacion' => 'required',
        'concepto' => 'required|not_in:Elegir'
    ];

    $messages = [
        'destino.required'=> 'El destino del producto es requerido',
        'concepto.required'=> 'El concepto es un dato requerido',
        'destino.not_in' => 'Elija una ubicacion del producto.',
        'concepto.not_in' => 'Elija un concepto diferente.',
        'observacion.required' => 'Agregue una observacion',
    ];

    $this->validate($rules, $messages);
    $this->nextpage=true;
}



   


    
}
