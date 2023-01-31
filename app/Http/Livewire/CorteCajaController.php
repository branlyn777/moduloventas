<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\CarteraMov;
use App\Models\Movimiento;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CorteCajaController extends Component
{
    //Guarda el id de la sucursal
    public $idsucursal;
    //Guarda el nombre de una caja abierta (si existe)
    public $nombre_caja, $id_caja;

    public $idcaja, $nombrecaja, $usuarioApertura, $fechaApertura, $saldoAcumulado, $diezcent, $veintecent, $cinccent, $peso, $peso2, $peso5, $aperturaCaja,
        $billete10, $billete20, $billete50, $billete100, $billete200, $total, $mensaje_toast, $transacciondia, $caja, $efectivo_actual, $monto_limite, $recaudo, $showDiv, $nota_ajuste, $iniciarturno, $conteoinicial;

    public $ing_ventas,$ing_extraord,$ing_dig,$subtotal_ing,$egresos_efectivos,$ing_efectivo;

    public $toogle,
        $active1 = true,
        $active2;


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->idsucursal = $this->idsucursal();
        $this->nombre_caja = null;
        $this->id_caja = null;
        $this->active1 = true;
        // /* Caja en la cual se encuentra el usuario */
        $cajausuario = Caja::join('sucursals as s', 's.id', 'cajas.sucursal_id')
            ->join('sucursal_users as su', 'su.sucursal_id', 's.id')
            ->join('carteras as car', 'cajas.id', 'car.caja_id')
            ->join('cartera_movs as cartmovs', 'car.id', 'cartmovs.cartera_id')
            ->join('movimientos as mov', 'mov.id', 'cartmovs.movimiento_id')
            ->select("cajas.nombre as nombre_caja", "cajas.id as id_caja")
            ->where('cajas.id', '<>', 1)
            ->where('mov.user_id', Auth()->user()->id)
            ->where('mov.status', 'ACTIVO')
            ->where('mov.type', 'APERTURA')
            ->get();



        if ($cajausuario->count() > 0) {
            //Si el usuario tiene una caja abierta se actualizaran estas variables
            $this->nombre_caja = $cajausuario->first()->nombre_caja;
            $this->id_caja = $cajausuario->first()->id_caja;
        }
    }
    public function render()
    {


        //Listando todas las cajas dependiendo la eleccion de la sucursal
        if ($this->idsucursal != "Todos") {
            $cajas = Caja::join("sucursals as s", "s.id", "cajas.sucursal_id")
                ->select(
                    "cajas.nombre as nombre",
                    "cajas.id as id",
                    "cajas.estado as estado",
                    "s.name as nombresucursal",
                    DB::raw('0 as carteras'),
                    DB::raw('0 as abiertapor'),
                    DB::raw('0 as misucursal')
                )
                ->where("cajas.sucursal_id", $this->idsucursal)
                ->where("cajas.id", "<>", 1)
                ->get();
        } else {
            $cajas = Caja::join("sucursals as s", "s.id", "cajas.sucursal_id")
                ->select(
                    "cajas.nombre as nombre",
                    "cajas.id as id",
                    "cajas.estado as estado",
                    "s.name as nombresucursal",
                    DB::raw('0 as carteras'),
                    DB::raw('0 as abiertapor'),
                    DB::raw('0 as misucursal')
                )
                ->where("cajas.id", "<>", 1)
                ->get();
        }
        //llenando las nuevas columnas añadidas a las cajas DB::raw('0 as carteras') ,etc.
        foreach ($cajas as $c) {
            // Verificando si la caja esta abierta
            $cajausuario = Caja::join('sucursals as s', 's.id', 'cajas.sucursal_id')
                ->join('sucursal_users as su', 'su.sucursal_id', 's.id')
                ->join('carteras as c', 'c.caja_id', 'cajas.id')
                ->join('cartera_movs as cartmovs', 'cartmovs.cartera_id', 'c.id')
                ->join('movimientos as m', 'm.id', 'cartmovs.movimiento_id')
                ->join('users as u', 'u.id', 'm.user_id')
                ->select('u.name as nombreusuario')
                ->where('m.status', 'ACTIVO')
                ->where('m.type', 'APERTURA')
                ->where('cajas.id', $c->id)
                ->get()->first();
            if ($cajausuario) {
                //Si la caja esta abierta se guarda el nombre del usuario que lo abrio
                $c->abiertapor = $cajausuario->nombreusuario;
            } else {
                $c->abiertapor = "Nadie";
            }
            //Listando todas las carteras que tenga la caja
            $c->carteras = Cartera::where("carteras.caja_id", $c->id)
                ->where("carteras.estado", 'ACTIVO')
                ->get();
            //Guardando true o false dependiendo si la caja perteneze a la sucursal del usuario
            $c->misucursal = $this->verificarsucursalcaja($c->id);
        }
        //Obteniendo todas las sucursales activas
        $sucursales = Sucursal::where("sucursals.estado", "ACTIVO")->get();
        //Obteniedo todas las carteras que esten en la caja con id 1 (Caja General)
        $carteras_generales = Caja::join("carteras as c", "c.caja_id", "cajas.id")
            ->select("c.nombre as nombrecartera", "c.saldocartera as saldocartera")
            ->where("cajas.id", 1)
            ->where("c.estado", 'ACTIVO')
            ->get();


        //monedas y billetes

        $this->total = (int)$this->diezcent * 0.1 + (int)$this->veintecent * 0.2 + (int)$this->cinccent * 0.5 +
            (int)$this->peso * 1 + (int)$this->peso2 * 2 + (int)$this->peso5 * 5 + (int)$this->billete10 * 10
            + (int)$this->billete20 * 20 + (int)$this->billete50 * 50 + (int)$this->billete100 * 100 + (int)$this->billete200 * 200;







        return view('livewire.cortecaja.cortecaja', [
            'cajas' => $cajas,
            'carteras_generales' => $carteras_generales,
            'sucursales' => $sucursales,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    //Cierra todas las cajas en la empresa
    public function cerrartodo()
    {

        $cajas = Caja::all();

        foreach ($cajas as $c) {
            $idcaja = $c->id;


            $cortes = Movimiento::where('status', 'ACTIVO')
                ->where('type', 'APERTURA')
                ->where('user_id', Auth()->user()->id)->get();
            foreach ($cortes as $c) {
                $c->update([
                    'status' => 'INACTIVO',
                ]);
                $c->save();
            }
            /* CREAR CORTES DE CIERRE CON ESTADO ACTIVO */
            $carteras = Cartera::where('caja_id', $idcaja)->get();
            foreach ($carteras as $cart) {
                $movimiento = Movimiento::create([
                    'type' => 'CIERRE',
                    'status' => 'ACTIVO',
                    'import' => 0,
                    'user_id' => Auth()->user()->id
                ]);
                CarteraMov::create([
                    'type' => 'CIERRE',
                    'tipoDeMovimiento' => 'CORTE',
                    'comentario' => '',
                    'cartera_id' => $cart->id,
                    'movimiento_id' => $movimiento->id,
                ]);
            }
            /* HABILITAR CAJA */
            $caja = Caja::find($idcaja);
            $caja->update([
                'estado' => 'Cerrado',
            ]);
            $caja->save();

            session(['sesionCaja' => null]);
            session(['sesionCajaID' => null]);

            $this->redirect('cortecajas');
        }


        $movimientos = Movimiento::where('movimientos.status', 'ACTIVO')
            ->where('movimientos.type', 'APERTURA')
            ->get();

        foreach ($movimientos as $m) {
            $m->update([
                'status' => 'INACTIVO',
            ]);
        }
    }
    //Para ajustar Carteras
    public function ajustarcarteras()
    {



        $carteras = Cartera::all();
        foreach ($carteras as $c) {
            /* SUMAR TODO LOS INGRESOS DE LA CARTERA */
            $ingreso = Cartera::join('cartera_movs as cm', 'carteras.id', 'cm.cartera_id')
                ->join('movimientos as m', 'm.id', 'cm.movimiento_id')
                ->where('cm.type', 'INGRESO')
                ->where('m.status', 'ACTIVO')
                ->where('carteras.id', $c->id)
                ->sum('m.import');
            /* SUMAR TODO LOS EGRESOS DE LA CARTERA */
            $egreso = Cartera::join('cartera_movs as cm', 'carteras.id', 'cm.cartera_id')
                ->join('movimientos as m', 'm.id', 'cm.movimiento_id')
                ->where('cm.type', 'EGRESO')
                ->where('m.status', 'ACTIVO')
                ->where('carteras.id', $c->id)
                ->sum('m.import');
            /* REALIZAR CALCULO DE INGRESOS - EGRESOS */

            $saldo = $ingreso - $egreso;

            $car = Cartera::find($c->id);
            $car->update([
                'saldocartera' => $saldo
            ]);
            $car->save();
        }
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
    //Verifica que la caja recibida pertenesca a la sucursal del usuario
    public function verificarsucursalcaja($idcaja)
    {
        $caja = Caja::find($idcaja);
        if ($caja->sucursal_id == $this->idsucursal()) {
            return true;
        } else {
            return false;
        }
    }
    protected $listeners = [
        'corte-caja' => 'CorteCaja',
        'cerrar-caja' => 'CerrarCaja',
        'cerrar-caja-usuario' => 'CerrarCajaUsuario'
    ];

    public function CorteCaja($idcaja)
    {
        
        $rules = [
            'efectivo_actual' => 'required',
        ];
        $messages = [
            'efectivo_actual.required' => 'Ingresa un monto para apertura la caja.',
        ];

        $this->validate($rules, $messages);


        if ($this->VerificarCajaAbierta($idcaja) == false) {

            try {
                DB::beginTransaction();
                /* PONER EN INACTIVO TODOS LOS MOVIMIENTOS DE CIERRE DEL USUARIO */
                $cortes = Movimiento::where('status', 'ACTIVO')
                    ->where('type', 'CIERRE')
                    ->where('user_id', Auth()->user()->id)
                    ->get();

                foreach ($cortes as $c) {
                    $c->update([
                        'status' => 'INACTIVO',
                    ]);
                    $c->save();
                }

                /*  CREAR MOVIMIENTOS DE APERTURA CON ESTADO ACTIVO POR CADA CARTERA */
                $carteras = Cartera::where('caja_id', $idcaja)->where('tipo', 'efectivo')->get();


                if ($this->efectivo_actual != $this->saldoAcumulado) {


                    $movimiento = Movimiento::create([
                        'type' => 'APERTURA',
                        'status' => 'ACTIVO',
                        'import' => $this->efectivo_actual,
                        'user_id' => Auth()->user()->id
                    ]);
                    CarteraMov::create([
                        'type' => 'APERTURA',
                        'tipoDeMovimiento' => 'CORTE',
                        'comentario' => $this->nota_ajuste ?? 's/n',
                        'cartera_id' => $carteras->first()->id,
                        'movimiento_id' => $movimiento->id,
                    ]);


                    $margen = $this->efectivo_actual - $this->saldoAcumulado;
                    $diferenciaCaja = $margen > 0 ? 'SOBRANTE' : 'FALTANTE';
                    $mvt = Movimiento::create([
                        'type' => 'TERMINADO',
                        'status' => 'ACTIVO',
                        'import' => $margen > 0 ? $margen : $margen * (-1),
                        'user_id' => Auth()->user()->id,
                    ]);

                    CarteraMov::create([
                        'type' => ($diferenciaCaja == 'SOBRANTE') ? 'INGRESO' : 'EGRESO',
                        'tipoDeMovimiento' => $diferenciaCaja,
                        'comentario' => $this->nota_ajuste,
                        'cartera_id' => $carteras->first()->id,
                        'movimiento_id' => $mvt->id
                    ]);

                    $cartera = Cartera::find($carteras->first()->id);

                    $saldo_cartera = Cartera::find($carteras->first()->id)->saldocartera + $margen;

                    $cartera->update([
                        'saldocartera' => $saldo_cartera
                    ]);
                    $this->saldoAcumulado = $saldo_cartera;
                }

                /* HABILITAR CAJA */
                $caja = Caja::find($idcaja);
                $caja->update([
                    'estado' => 'Abierto',
                ]);
                $caja->save();



                $this->nombre_caja = $caja->nombre;
                $this->id_caja = $caja->id;

                session(['sesionCaja' => $caja->nombre]);
                session(['sesionCajaID' => $caja->id]);

                $this->emit('aperturarCajaCerrar');

                $this->reset('efectivo_actual','nota_ajuste');


                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                $this->mensaje_toast = ": " . $e->getMessage();
                $this->emit('sale-error');
            }
        } else {
            $this->emit('caja-ocupada');
        }
    }
    //Para cerrar la caja abierta por el mismo usuario
    public function CerrarCaja(Caja $caja)
    {
        $this->active1=true;

        if ($this->VerificarCajaAbierta($caja->id)) {
            $this->caja = $caja;
            $this->idcaja = $caja->id;
            $this->monto_limite = $caja->monto_base;
            $this->showDiv = false;


                $usuarioActual=Auth()->user()->id;
                $apertura=Movimiento::where('user_id',$usuarioActual)->where('type','APERTURA')->where('movimientos.status','ACTIVO')->first();
            $this->aperturaCaja = $apertura->import;
            $this->ing_ventas=Cartera::join('cartera_movs','cartera_movs.cartera_id','carteras.id')
            ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
            ->where('carteras.caja_id',$caja->id)
            ->where('cartera_movs.tipoDeMovimiento','VENTA')
            ->where('movimientos.created_at','>=',$apertura->created_at)
            ->sum('movimientos.import');

            $this->ing_extraord= Cartera::join('cartera_movs','cartera_movs.cartera_id','carteras.id')
            ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
            ->where('carteras.caja_id',$caja->id)
            ->where('cartera_movs.tipoDeMovimiento','EGRESO/INGRESO')
            ->where('cartera_movs.type','INGRESO')
            ->where('movimientos.created_at','>=',$apertura->created_at)
            ->sum('movimientos.import');
            $this->ing_efectivo=$this->ing_ventas+  $this->ing_extraord;



            $this->ing_dig= Cartera::join('cartera_movs','cartera_movs.cartera_id','carteras.id')
            ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
            ->where('carteras.caja_id',1)
            ->where('movimientos.user_id',$usuarioActual)
            ->where('movimientos.created_at','>=',$apertura->created_at)
            ->where('cartera_movs.type','INGRESO')
            ->whereIn('tipoDeMovimiento',['VENTA','EGRESO/INGRESO'])
            ->sum('movimientos.import');

            $this->subtotal_ing=$this->ing_efectivo+$this->ing_dig;

            $this->egresos_efectivos=Cartera::join('cartera_movs','cartera_movs.cartera_id','carteras.id')
            ->join('movimientos','movimientos.id','cartera_movs.movimiento_id')
            ->where('movimientos.user_id',$usuarioActual)
            ->where('movimientos.created_at','>=',$apertura->created_at)
            ->where('cartera_movs.type','EGRESO')
            ->whereIn('tipoDeMovimiento',['VENTA','EGRESO/INGRESO'])
            ->sum('movimientos.import');




            $this->saldoAcumulado = Caja::join('carteras as c', 'c.caja_id', 'cajas.id')
                ->where('cajas.id', $this->idcaja)
                ->where('c.tipo', 'efectivo')
                ->sum('c.saldocartera');




            $this->emit('abrirAjustedeCaja');
            $this->conteoinicial = false;

            // return redirect()->route('caja.cierre',[$id]);
            /* PONER EN INACTIVO TODOS LOS MOVIMIENTOS DE APERTURA DEL USUARIO */


            //  $this->emit('message-success-toast');


        } else {
            $this->emit('caja-cerrada');
        }
    }
    //Para cerrar la caja abierta por otro usuario
    public function CerrarCajaUsuario($idcaja)
    {
        if ($this->VerificarCajaAbierta($idcaja)) {
            $this->caja = $idcaja;
            //Buscando el id usuario que abrio la caja
            $cajausuario = Caja::join('sucursals as s', 's.id', 'cajas.sucursal_id')
                ->join('sucursal_users as su', 'su.sucursal_id', 's.id')
                ->join('carteras as c', 'c.caja_id', 'cajas.id')
                ->join('cartera_movs as cartmovs', 'cartmovs.cartera_id', 'c.id')
                ->join('movimientos as m', 'm.id', 'cartmovs.movimiento_id')
                ->join('users as u', 'u.id', 'm.user_id')
                ->select('u.name as nombreusuario', 'u.id as idusuario')
                ->where('m.status', 'ACTIVO')
                ->where('m.type', 'APERTURA')
                ->where('cajas.id', $idcaja)
                ->get()
                ->first();


            /* PONER EN INACTIVO TODOS LOS MOVIMIENTOS DE APERTURA DEL USUARIO */
            $cortes = Movimiento::where('status', 'ACTIVO')
                ->where('type', 'APERTURA')
                ->where('user_id', $cajausuario->idusuario)->get();
            foreach ($cortes as $c) {
                $c->update([
                    'status' => 'INACTIVO',
                ]);
                $c->save();
            }
            /* CREAR CORTES DE CIERRE CON ESTADO ACTIVO */
            $carteras = Cartera::where('caja_id', $idcaja)->get();
            foreach ($carteras as $cart) {
                $movimiento = Movimiento::create([
                    'type' => 'CIERRE',
                    'status' => 'ACTIVO',
                    'import' => 0,
                    'user_id' => $cajausuario->idusuario
                ]);
                CarteraMov::create([
                    'type' => 'CIERRE',
                    'tipoDeMovimiento' => 'CORTE',
                    'comentario' => '',
                    'cartera_id' => $cart->id,
                    'movimiento_id' => $movimiento->id,
                ]);
            }
            /* HABILITAR CAJA */
            $caja = Caja::find($idcaja);
            $caja->update([
                'estado' => 'Cerrado',
            ]);
            $caja->save();


            $this->emit('message-success-toast');

            //$this->redirect('cortecajas');
        } else {
            $this->emit('caja-cerrada');
        }
    }
    //Verifica si una caja esta abierta
    public function VerificarCajaAbierta($idcaja)
    {
        $result = false;
        //Buscando el id usuario que abrio la caja
        $cajausuario = Caja::join('carteras as c', 'c.caja_id', 'cajas.id')
            ->join('cartera_movs as cartmovs', 'cartmovs.cartera_id', 'c.id')
            ->join('movimientos as m', 'm.id', 'cartmovs.movimiento_id')
            ->join('users as u', 'u.id', 'm.user_id')
            ->select('u.name as nombreusuario', 'u.id as idusuario')
            ->where('m.status', 'ACTIVO')
            ->where('m.type', 'APERTURA')
            ->where('cajas.id', $idcaja)
            ->get();

        if ($cajausuario->count() > 0) {
            $result = true;
        }
        return $result;
    }



    public function cerrarCajaAjustada()
    {
        $cortes = Movimiento::where('status', 'ACTIVO')
            ->where('type', 'APERTURA')
            ->where('user_id', Auth()->user()->id)->get();
        foreach ($cortes as $c) {
            $c->update([
                'status' => 'INACTIVO',
            ]);
            $c->save();
        }

        /* CREAR CORTES DE CIERRE CON ESTADO ACTIVO */
        $carteras = Cartera::where('caja_id', $this->idcaja)->get();

        foreach ($carteras as $cart) {
            $movimiento = Movimiento::create([
                'type' => 'CIERRE',
                'status' => 'ACTIVO',
                'import' => 0,
                'user_id' => Auth()->user()->id
            ]);
            CarteraMov::create([
                'type' => 'CIERRE',
                'tipoDeMovimiento' => 'CORTE',
                'comentario' => '',
                'cartera_id' => $cart->id,
                'movimiento_id' => $movimiento->id,
            ]);
        }
        /* HABILITAR CAJA */
        $caja = Caja::find($this->idcaja);
        $caja->update([
            'estado' => 'Cerrado',
        ]);
        $caja->save();

        $this->nombre_caja = null;
        $this->id_caja = null;

        session(['sesionCaja' => null]);
        session(['sesionCajaID' => null]);
    }

    public function aplicarConteo()
    {
        if ($this->conteoinicial == true) {
            $this->efectivo_actual = round($this->total, 2);
            $this->resetConteo();
            $this->emit('cerrarContador');
            $this->emit('aperturarCaja');
        } else {
            $this->efectivo_actual = round($this->total, 2);
            $this->resetConteo();
            $this->emit('cerrarContador');
            $this->emit('abrirAjustedeCaja');
        }
    }
    public function resetConteo()
    {
        $this->reset(
            'diezcent',
            'veintecent',
            'cinccent',
            'peso',
            'peso2',
            'peso5',
            'billete10',
            'billete20',
            'billete50',
            'billete100',
            'billete200',
            'total'
        );
    }



    public function finArqueo()
    {

        if ($this->efectivo_actual != null) {
            $margen = $this->efectivo_actual - $this->saldoAcumulado;
            $diferenciaCaja = $margen > 0 ? 'SOBRANTE' : 'FALTANTE';
            $mvt = Movimiento::create([
                'type' => 'TERMINADO',
                'status' => 'ACTIVO',
                'import' => $margen > 0 ? $margen : $margen * (-1),
                'user_id' => Auth()->user()->id,
            ]);
            $cartera_efectiva = $this->caja->carteras->where('tipo', 'efectivo');
            CarteraMov::create([
                'type' => ($diferenciaCaja == 'SOBRANTE') ? 'INGRESO' : 'EGRESO',
                'tipoDeMovimiento' => $diferenciaCaja,
                'comentario' => $this->nota_ajuste??'s/n',
                'cartera_id' => $cartera_efectiva->first()->id,
                'movimiento_id' => $mvt->id
            ]);
            $cartera = Cartera::find($cartera_efectiva->first()->id);

            $saldo_cartera = Cartera::find($cartera_efectiva->first()->id)->saldocartera + $margen;

            $cartera->update([
                'saldocartera' => $saldo_cartera
            ]);
            $this->saldoAcumulado = $saldo_cartera;
        }

        $this->active1 = false;
    }

    public function RecaudarEfectivo()
    {

        $mvt = Movimiento::create([
            'type' => 'TERMINADO',
            'status' => 'ACTIVO',
            'import' => $this->recaudo,
            'user_id' => Auth()->user()->id,
        ]);
        $cartera_efectiva = $this->caja->carteras->where('tipo', 'efectivo');
        CarteraMov::create([
            'type' => 'EGRESO',
            'tipoDeMovimiento' => 'RECAUDO',
            'comentario' => 'RECAUDO DEL DIA',
            'cartera_id' => $cartera_efectiva->first()->id,
            'movimiento_id' => $mvt->id
        ]);

        $cartera = Cartera::find($cartera_efectiva->first()->id);

        $saldo_cartera = Cartera::find($cartera_efectiva->first()->id)->saldocartera - $this->recaudo;

        $cartera->update([
            'saldocartera' => $saldo_cartera
        ]);
        $this->saldoAcumulado = $saldo_cartera;
        $this->recaudo = null;
        $this->finalizarCierre();
    }

    public function finalizarCierre()
    {

        $cortes = Movimiento::where('status', 'ACTIVO')
            ->where('type', 'APERTURA')
            ->where('user_id', Auth()->user()->id)->get();
        foreach ($cortes as $c) {
            $c->update([
                'status' => 'INACTIVO',
            ]);
            $c->save();
        }

        /* CREAR CORTES DE CIERRE CON ESTADO ACTIVO */
        $carteras = Cartera::where('caja_id', $this->idcaja)->get();

        foreach ($carteras as $cart) {
            $movimiento = Movimiento::create([
                'type' => 'CIERRE',
                'status' => 'ACTIVO',
                'import' => $this->efectivo_actual,
                'user_id' => Auth()->user()->id
            ]);
            CarteraMov::create([
                'type' => 'CIERRE',
                'tipoDeMovimiento' => 'CORTE',
                'comentario' => '',
                'cartera_id' => $cart->id,
                'movimiento_id' => $movimiento->id,
            ]);
        }
        /* HABILITAR CAJA */
        $caja = Caja::find($this->idcaja);
        $caja->update([
            'estado' => 'Cerrado',
        ]);
        $caja->save();

        $this->nombre_caja = null;
        $this->id_caja = null;

        session(['sesionCaja' => null]);
        session(['sesionCajaID' => null]);
        $this->recaudo = null;
        $this->active1 = true;
        $this->emit('cerrarAjustedeCaja');
    }

    public function confirmarAbrir(Caja $caja)
    {
        //dd($caja);
        $this->efectivo_actual=null;
        $this->idcaja = $caja->id;
        //obtenemos la cartera efectiva
        $cajafisica = $caja->carteras->where('tipo', 'efectivo')->first()->saldocartera;

        $this->saldoAcumulado =  $cajafisica;

        $this->emit('aperturarCaja');
        $this->conteoinicial = true;
    }
}
