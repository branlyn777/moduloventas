<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\CarteraMovCategoria;
use App\Models\Movimiento;
use App\Models\OperacionesCarterasCompartidas;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IngresoEgresoController extends Component
{

    public $fromDate, $toDate, $caja, $data, $search, $cv, $sucursal, $sucursales, $sumaTotal, $cantidad, $mov_selected, $cantidad_edit, $comentario_edit, $carterasSucursal, $mensaje_toast, $saldo_cartera_aj;
    public $cot_dolar = 6.96;
    public $cartera_id_edit, $type_edit, $selected_id, $estado, $opciones, $cartera_id, $type, $comentario, $carterasel, $cartajusteselected, $cajaselected, $carteraselected, $carterasAjuste;

    //Para guardar el id de la categoria cartera movimiento
    public $categoria_id, $categoria_ie_id;

    //Para guardar el tipo de movimiento en los filtros
    public $tipo_movimiento;


    public function mount()
    {
        $this->tipo_movimiento = "TODOS";
        $this->selected_id = 0;
        $this->opciones = 'TODAS';
        $this->cartera_id = 'Elegir';
        $this->type = 'Elegir';
        $this->cantidad = '';
        $this->comentario = '';
        $this->fromDate = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->toDate =  Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->caja = 'TODAS';
        $this->sucursal = $this->usuarioSucursal();
        //Variable para guardar el id de una categoria en la tabla principal
        $this->categoria_id = 'Todos';
        //Variable para guardar el id de una categoria en la ventana modal modalDetails
        $this->categoria_ie_id = null;
        $this->cajaselected = false;
        $this->carterasel = 'TODAS';
        $this->estado='ACTIVO';
        //$this->sucursal=collect();

    }
    public function render()
    {

   

        $cartera = Caja::join('carteras', 'carteras.caja_id', 'cajas.id')
            ->select('carteras.nombre as carteranombre', 'carteras.id', 'cajas.nombre as cajanombre')
            ->get();



        $this->carterasAjuste = Caja::join('carteras', 'carteras.caja_id', 'cajas.id')
            ->select('carteras.nombre as carteranombre', 'carteras.id', 'cajas.nombre as cajanombre')
            ->get();


            if ($this->cajaselected==false) {

              //dump($this->fromDate,$this->toDate);
              $this->data = Movimiento::join('cartera_movs as crms', 'crms.movimiento_id', 'movimientos.id')
                        ->join('carteras as c', 'c.id', 'crms.cartera_id')
                        ->join('cajas as ca', 'ca.id', 'c.caja_id')
                        ->join('users as u', 'u.id', 'movimientos.user_id')
                        ->where('movimientos.status', '=', $this->estado)
                        ->whereBetween('movimientos.created_at', [$this->fromDate. ' 00:00:00', $this->toDate. ' 23:59:59'])
                        ->when($this->search != null, function ($query) {
                            $query->where(function ($query) {
                                $query->where('crms.tipoDeMovimiento', 'like', '%' . $this->search . '%')
                                    ->orWhere('u.name', 'like', '%' . $this->search . '%')
                                    ->orWhere('crms.comentario', 'like', '%' . $this->search . '%');
                            })
                            ->whereBetween('movimientos.created_at', [$this->fromDate. ' 00:00:00', $this->toDate. ' 23:59:59']);
                        })
                        ->when($this->carterasel != 'TODAS', function ($query) {
                            $query->where('c.id', $this->carterasel);
                        })
                        ->when($this->tipo_movimiento == 'INGRESO', function ($query) {
                            $query->where('crms.type', 'INGRESO');
                        })
                        ->when($this->tipo_movimiento == 'EGRESO', function ($query) {
                            $query->where('crms.type', 'EGRESO');
                        })
                        ->whereIn('crms.tipoDeMovimiento', ['EGRESO/INGRESO', 'FALTANTE', 'SOBRANTE', 'RECAUDO'])
                        ->orderBy('movimientos.id', 'desc')
                        ->select('movimientos.type as movimientotype', 'movimientos.import as import', 'crms.type as carteramovtype', 'crms.tipoDeMovimiento', 'crms.comentario', 'c.nombre as nombre', 'c.descripcion', 'c.tipo', 'ca.nombre as cajaNombre', 'u.name as usuarioNombre', 'movimientos.created_at as movimientoCreacion', 'movimientos.id as movid', 'movimientos.status as movstatus')
                        ->get();

                          
            }
        $this->sumaTotal = $this->data->sum('import');


        //Listando todas las categorias con estado activo

        if ($this->type == "TODOS") {
            $categorias = CarteraMovCategoria::select("cartera_mov_categorias.*")
                ->where("cartera_mov_categorias.status", "ACTIVO")
                ->get();
        } else {
            $categorias = CarteraMovCategoria::select("cartera_mov_categorias.*")
                ->where("cartera_mov_categorias.status", "ACTIVO")
                ->where("cartera_mov_categorias.tipo", $this->type)
                ->get();
        }
        if ($this->tipo_movimiento == "TODOS") {
            $categorias2 = CarteraMovCategoria::select("cartera_mov_categorias.*")
                ->where("cartera_mov_categorias.status", "ACTIVO")
                ->get();
        } else {
            $categorias2 = CarteraMovCategoria::select("cartera_mov_categorias.*")
                ->where("cartera_mov_categorias.status", "ACTIVO")
                ->where("cartera_mov_categorias.tipo", $this->tipo_movimiento)
                ->get();
        }

        if ($this->categoria_ie_id != null) {
            $detail = CarteraMovCategoria::find($this->categoria_ie_id)->detalle;
         
        } else {
            $detail = null;}

        return view('livewire.reportemovimientoresumen.ingresoegreso', [
            'carterasSucursal' => $this->carterasSucursal,
            'categorias_ie' => $categorias,
            'categorias2' => $categorias2,
            'carteras' => $cartera,
            'data' => $this->data,
            'categorias' => $categorias,
            'detalle' => $detail
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function viewDetails()
    {
        $this->emit('show-modal', 'open modal');
    }
    public function ajuste()
    {
        $this->emit('show-ajuste');
        $this->resetAjuste();
    }
    public function guardarAjuste()
    {
        $rules = [ /* Reglas de validacion */

            'cartajusteselected' => 'required|not_in:Elegir',
            'cantidad' => 'required',
            'comentario' => 'required',
        ];
        $messages = [ /* mensajes de validaciones */

            'cartajusteselected.not_in' => 'Seleccione un valor distinto a Elegir',
            'cartajusteselected.not_in' => 'Seleccione un valor distinto a Elegir',

            'cantidad.required' => 'Ingrese un monto válido',
            'cantidad.not_in' => 'Ingrese un monto válido',
            'comentario.required' => 'El comentario es obligatorio',
        ];

        $this->validate($rules, $messages);

        $mvt = Movimiento::create([
            'type' => 'TERMINADO',
            'status' => 'ACTIVO',
            'import' => $this->cantidad - $this->saldo_cartera_aj > 0 ? $this->cantidad - $this->saldo_cartera_aj : ($this->cantidad - $this->saldo_cartera_aj) * -1,
            'user_id' => Auth()->user()->id
        ]);

        CarteraMov::create([
            'type' => $this->saldo_cartera_aj > $this->cantidad ? 'INGRESO' : 'EGRESO',
            'tipoDeMovimiento' => 'AJUSTE',
            'comentario' => $this->comentario,
            'cartera_id' => $this->cartajusteselected,
            'movimiento_id' => $mvt->id
        ]);

        $cartera = Cartera::find($this->cartajusteselected);



        $cartera->update([
            'saldocartera' => $this->cantidad
        ]);

        $this->emit('close-ajuste');
        $this->resetAjuste();
    }

    public function resetAjuste()
    {
        $this->cartajusteselected = null;

        $this->cantidad = null;
        $this->comentario = null;
        $this->saldo_cartera_aj = null;
        $this->emit('close-ajuste');
        $this->resetValidation();
    }



    public function Generar()
    {
        $rules = [ /* Reglas de validacion */
            'type' => 'required|not_in:Elegir',
            'cartera_id' => 'required|not_in:Elegir',
            'categoria_ie_id' => 'required|not_in:Elegir',
            'cantidad' => 'required|not_in:0',
            'comentario' => 'required',
        ];
        $messages = [ /* mensajes de validaciones */
            'type.not_in' => 'Seleccione un valor distinto a Elegir',
            'type.not_in' => 'Seleccione un valor distinto a Elegir',
            'cartera_id.not_in' => 'Seleccione un valor distinto a Elegir',
            'cartera_id.not_in' => 'Seleccione un valor distinto a Elegir',

            'categoria_ie_id.required' => 'Seleccione una Categoria',
            'categoria_ie_id.not_in' => 'Seleccione una Categoria distinto a Elegir',

            'cantidad.required' => 'Ingrese un monto válido',
            'cantidad.not_in' => 'Ingrese un monto válido',
            'comentario.required' => 'El comentario es obligatorio',
        ];

        $this->validate($rules, $messages);

        $mvt = Movimiento::create([
            'type' => 'TERMINADO',
            'status' => 'ACTIVO',
            'import' => $this->cantidad,
            'user_id' => Auth()->user()->id,
        ]);

        $ct = CarteraMov::create([
            'type' => $this->type,
            'tipoDeMovimiento' => 'EGRESO/INGRESO',
            'comentario' => $this->comentario,
            'cartera_id' => $this->cartera_id,
            'movimiento_id' => $mvt->id,
            'cartera_mov_categoria_id' => $this->categoria_ie_id
        ]);
        $this->cv = $ct->id;
        //dd($this->cv);

        if ($this->type == "INGRESO") {
            $cartera = Cartera::find($this->cartera_id);

            $saldo_cartera = Cartera::find($this->cartera_id)->saldocartera + $this->cantidad;


            $cartera->update([
                'saldocartera' => $saldo_cartera
            ]);
        } else {
            $cartera = Cartera::find($this->cartera_id);

            $saldo_cartera = Cartera::find($this->cartera_id)->saldocartera - $this->cantidad;

            $cartera->update([
                'saldocartera' => $saldo_cartera
            ]);
        }







        //verificar que caja esta aperturada
        $cajaId = session('sesionCajaID');


     

        $this->emit('hide-modal', 'Se generó el ingreso/egreso');
        $this->resetUI();
    }
    public function resetUI()
    {
        $this->cartera_id = 'Elegir';
        $this->type = 'Elegir';
        $this->cantidad = '';
        $this->comentario = '';
        $this->emit('hide-modal');
        $this->categoria_ie_id =null;
    }
    public function usuarioSucursal()
    {
        $SucursalUsuario = User::join('sucursal_users as su', 'su.user_id', 'users.id')
            ->join('sucursals as s', 's.id', 'su.sucursal_id')
            ->where('users.id', Auth()->user()->id)
            ->where('su.estado', 'ACTIVO')
            ->select('s.*')
            ->get()
            ->first();

        return $SucursalUsuario->id;
    }
    public function generarpdf($data)
    {
        session(['ingresos' => $data]);

        session(['ingresossumatotal' => $this->sumaTotal]); //


        //Sucursal, Caja, Fecha de Inicio y Fecha de Fin
        $caracteristicas = array($this->sucursal, $this->caja, $this->fromDate, $this->toDate);
        session(['caracteristicas' => $caracteristicas]);

        //Redireccionando para crear el comprobante con sus respectvas variables
        //return redirect::to('report/pdfmovdiaresumen');

        $this->emit('openothertap');
    }
    protected $listeners = [
        'eliminar_operacion' => 'anularOperacion'
    ];
    public function anularOperacion(Movimiento $mov)
    {
        $mov->update([
            'status' => 'INACTIVO'
        ]);
        $mov->save();
        $carteraid = CarteraMov::where('movimiento_id', $mov->id)->first()->cartera_id;
        $cartera = Cartera::find($carteraid);

        $cartera->update([
            'saldocartera' => $cartera->saldocartera - $mov->import
        ]);
    }
    public function editarOperacion(Movimiento $mov)
    {
        $this->cantidad_edit = $mov->import;

        $this->cartera_id_edit = $mov->cartmov[0]->cartera_id;
        $this->type_edit = $mov->cartmov[0]->type;

        $this->comentario_edit = $mov->cartmov[0]->comentario;
        $this->mov_selected = $mov;

        $this->emit('editar-movimiento');
    }
    public function guardarEdicion()
    {

        $mov = Movimiento::find($this->mov_selected->id);
        $mov_ant = $mov->import;

        $mov->update([
            'import' => $this->cantidad_edit
        ]);
        $mov->save();


        CarteraMov::find($mov->cartmov[0]->id)->update([
            'comentario' => $this->comentario_edit
        ]);




        if ($this->type_edit == "INGRESO") {
            $cartera = Cartera::find($this->cartera_id_edit);

            $saldo_cartera = Cartera::find($this->cartera_id_edit)->saldocartera - $mov_ant + $this->cantidad_edit;

            $cartera->update([
                'saldocartera' => $saldo_cartera
            ]);
        } else {
            $cartera = Cartera::find($this->cartera_id_edit);

            $saldo_cartera = Cartera::find($this->cartera_id_edit)->saldocartera + $mov_ant - $this->cantidad_edit;

            $cartera->update([
                'saldocartera' => $saldo_cartera
            ]);
        }





        $this->resetUIedit();
    }
    public function resetUIedit()
    {
        $this->cartera_id_edit = 'Elegir';
        $this->type_edit = 'Elegir';
        $this->cantidad_edit = '';
        $this->comentario_edit = '';
        $this->emit('hide_editar');
    }
    public function listarcarterasg()
    {
        $carteras = Caja::join('carteras as car', 'cajas.id', 'car.caja_id')
            ->where('cajas.id', 1)
            ->select('car.id as idcartera', 'car.nombre as nombrecartera', 'car.descripcion as dc', 'car.tipo as tipo')
            ->get();
        return $carteras;
    }

    public function cambio_option()
    {

        dump($this->cajaselected);
        $this->cajaselected = $this->carteraselected == 'on' ? $this->cajaselected == 'off' : $this->cajaselected == 'on';
        $this->carteraselected = $this->cajaselected == 'on' ? $this->carteraselected == 'off' : $this->carteraselected == 'on';
        dump($this->cajaselected, $this->carteraselected);
    }
}
