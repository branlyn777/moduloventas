<?php

namespace App\Http\Livewire;

use App\Models\ModelHasRoles;
use App\Models\OrderService;
use App\Models\Service;
use App\Models\Sucursal;
use App\Models\Transaccion;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReporteServiceController extends Component
{
    public $componentName, $data, $details, $sumDetails, $countDetails, $reportType,
        $userId, $dateFrom, $dateTo, $transaccionId, $estado, $fechas, $tecnico,
        $estadovista, $fechadesde, $fechahasta, $from, $costoEntregado, $to, $sumaUtilidad,
        $sucursal;

    public function mount()
    {
        $this->componentName = 'REPORTES SERVICIO';
        $this->data = [];
        $this->details = [];
        $this->sumDetails = 0;
        $this->countDetails = 0;
        $this->costoEntregado = 0;
        $this->reportType = 0;
        $this->userId = 0;
        $this->estado = 'Todos';
        $this->transaccionId = 0;
        $this->fechas = [];
        $this->tecnico = '';
        $this->estadovista = '';
        $this->fechadesde = '';
        $this->fechahasta = '';
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->sumaUtilidad = 0;
        $this->sucursal = 0;
    }

    public function render()
    {
        $this->trsbydate();

        $users = User::join('model_has_roles as mr', 'users.id', 'mr.model_id')
            ->join('roles as r', 'r.id', 'mr.role_id')
            ->join('role_has_permissions as rp', 'r.id', 'rp.role_id')
            ->join('permissions as p', 'p.id', 'rp.permission_id')
            ->where('p.name', 'Recepcionar_Servicio')
            //->where('users.status', 'ACTIVE')
            ->select('users.*')
            ->orderBy('name', 'asc')
            ->distinct()
            ->get();

        $sucursales = Sucursal::join('sucursal_users as suu', 'sucursals.id', 'suu.sucursal_id')
            ->select('sucursals.*')
            ->where('suu.estado', 'ACTIVO')
            ->distinct()
            ->get();

        return view('livewire.reporte_service.component', [
            'users' => $users,
            'sucursales' => $sucursales
        ])->extends('layouts.theme.app')
            ->section('content');
    }

    public function trsbydate()
    {
        $this->sumaUtilidad = 0;
        if ($this->reportType == 0) {
            $this->from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $this->to = Carbon::parse(Carbon::now())->format('Y-m-d')   . ' 23:59:59';
        } else {
            try {
                $this->from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
                $this->to = Carbon::parse($this->dateTo)->format('Y-m-d')     . ' 23:59:59';
            } catch (Exception $e) {
                DB::rollback();
                $this->emit('', 'Datos no Validos', $e->getMessage());
            }
        }

        if ($this->reportType == 1 && ($this->dateFrom == '' || $this->dateTo == '')) {
            return;
        }

        


        if($this->sucursal == '0'){
            if ($this->estado == 'Todos') {
                if ($this->userId == 0) {
                    $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                        ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                        ->join('users as u', 'u.id', 'mov.user_id')
                        ->where('mov.status', 'like', 'ACTIVO')
                        ->select(
                            'services.*',
                            DB::raw('0 as utilidad')
                        )
                        ->whereBetween('mov.created_at', [$this->from, $this->to])
                        ->orderBy('services.id', 'desc')
                        ->distinct()
                        ->get();
    
                    foreach ($this->data as $serv) {
                        foreach ($serv->movservices as $mm) {
                            if ($mm->movs->status == 'ACTIVO') {
                                $serv->utilidad = $mm->movs->import - $serv->costo;
                                $this->sumaUtilidad += $serv->utilidad;
                            }
                        }
                    }
    
                } else {
    
                    if ($this->estado == "Todos") {
                        $this->costoEntregado = 0;
                        $this->data = [];
                        $data1 = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                            ->join('users as u', 'u.id', 'mov.user_id')
                            ->where('mov.status', 'like', 'ACTIVO')
    
                            ->select(
                                'services.*',
                                DB::raw('0 as utilidad')
                            )
                            ->whereBetween('mov.created_at', [$this->from, $this->to])
                            ->where('mov.type', 'ENTREGADO')
                            ->orderBy('services.id', 'desc')
                            ->distinct()
                            ->get();
    
    
                        foreach ($data1 as $dat) {
                            foreach ($dat->movservices as $dato) {
                                if ($dato->movs->type == 'TERMINADO' && $dato->movs->user_id == $this->userId) {
                                    $this->costoEntregado += $dat->costo;
                                    array_push($this->data, $dat);
                                }
                            }
                        }
    
                        $datos2 = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                            ->join('users as u', 'u.id', 'mov.user_id')
                            ->where('mov.status', 'like', 'ACTIVO')
                            ->select(
                                'services.*',
                                DB::raw('0 as utilidad')
                            )
                            ->whereBetween('mov.created_at', [$this->from, $this->to])
                            ->where('mov.user_id', $this->userId)
                            ->orderBy('services.id', 'desc')
                            ->distinct()
                            ->get();
    
                        foreach ($datos2 as $dat1) {
                            $validar = 1;
                            foreach ($this->data as $dat2) {
                                if ($dat2->id == $dat1->id) {
                                    $validar = 0;
                                }
                            }
                            if ($validar == 1) {
                                $this->costoEntregado += $dat1->costo;
                                array_push($this->data, $dat1);
                            }
                        }
    
                        foreach ($this->data as $serv) {
                            foreach ($serv->movservices as $mm) {
                                if ($mm->movs->status == 'ACTIVO') {
                                    $serv->utilidad = $mm->movs->import - $serv->costo;
                                    $this->sumaUtilidad += $serv->utilidad;
                                }
                            }
                        }
                        
                    } else {
    
                        $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                            ->join('users as u', 'u.id', 'mov.user_id')
                            ->where('mov.status', 'like', 'ACTIVO')
                            ->select(
                                'services.*',
                                DB::raw('0 as utilidad')
                            )
                            ->whereBetween('mov.created_at', [$this->from, $this->to])
                            ->where('mov.user_id', $this->userId)
                            ->orderBy('services.id', 'desc')
                            ->distinct()
                            ->get();
    
                        foreach ($this->data as $serv) {
                            foreach ($serv->movservices as $mm) {
                                if ($mm->movs->status == 'ACTIVO') {
                                    $serv->utilidad = $mm->movs->import - $serv->costo;
                                    $this->sumaUtilidad += $serv->utilidad;
                                }
                            }
                        }
                    }
                }
            } else {
                if ($this->userId == 0) {
                    $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                        ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                        ->join('users as u', 'u.id', 'mov.user_id')
                        ->where('mov.status', 'like', 'ACTIVO')
                        ->select(
                            'services.*',
                            DB::raw('0 as utilidad')
                        )
                        ->whereBetween('mov.created_at', [$this->from, $this->to])
                        ->where('mov.type', $this->estado)
                        ->orderBy('services.id', 'desc')
                        ->distinct()
                        ->get();
                    foreach ($this->data as $serv) {
                        foreach ($serv->movservices as $mm) {
                            if ($mm->movs->status == 'ACTIVO') {
                                $serv->utilidad = $mm->movs->import - $serv->costo;
                                $this->sumaUtilidad += $serv->utilidad;
                            }
                        }
                    }
                } else {
    
                    if ($this->estado == "ENTREGADO") {
                        $this->costoEntregado = 0;
                        $this->data = [];
                        $data1 = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                            ->join('users as u', 'u.id', 'mov.user_id')
                            ->where('mov.status', 'like', 'ACTIVO')
    
                            ->select(
                                'services.*',
                                DB::raw('0 as utilidad')
                            )
                            ->whereBetween('mov.created_at', [$this->from, $this->to])
                            ->where('mov.type', $this->estado)
                            ->orderBy('services.id', 'desc')
                            ->distinct()
                            ->get();
    
    
                        foreach ($data1 as $dat) {
                            foreach ($dat->movservices as $dato) {
                                if ($dato->movs->type == 'TERMINADO' && $dato->movs->user_id == $this->userId) {
                                    $this->costoEntregado += $dat->costo;
                                    array_push($this->data, $dat);
                                }
                            }
                        }
    
                        foreach ($this->data as $serv) {
                            foreach ($serv->movservices as $mm) {
                                if ($mm->movs->status == 'ACTIVO') {
                                    $serv->utilidad = $mm->movs->import - $serv->costo;
                                    $this->sumaUtilidad += $serv->utilidad;
                                }
                            }
                        }
                    } else {
    
                        $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                            ->join('users as u', 'u.id', 'mov.user_id')
                            ->where('mov.status', 'like', 'ACTIVO')
                            ->select(
                                'services.*',
                                DB::raw('0 as utilidad')
                            )
                            ->whereBetween('mov.created_at', [$this->from, $this->to])
                            ->where('mov.user_id', $this->userId)
                            ->where('mov.type', $this->estado)
                            ->orderBy('services.id', 'desc')
                            ->distinct()
                            ->get();
                        foreach ($this->data as $serv) {
                            foreach ($serv->movservices as $mm) {
                                if ($mm->movs->status == 'ACTIVO') {
                                    $serv->utilidad = $mm->movs->import - $serv->costo;
                                    $this->sumaUtilidad += $serv->utilidad;
                                }
                            }
                        }
                    }
                }
            }
        }else{
            if ($this->estado == 'Todos') {
                if ($this->userId == 0) {
                    $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                        ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                        ->join('users as u', 'u.id', 'mov.user_id')
                        ->where('mov.status', 'like', 'ACTIVO')
                        ->where('services.sucursal_id',$this->sucursal)
                        ->select(
                            'services.*',
                            DB::raw('0 as utilidad')
                        )
                        ->whereBetween('mov.created_at', [$this->from, $this->to])
                        ->orderBy('services.id', 'desc')
                        ->distinct()
                        ->get();
    
                    foreach ($this->data as $serv) {
                        foreach ($serv->movservices as $mm) {
                            if ($mm->movs->status == 'ACTIVO') {
                                $serv->utilidad = $mm->movs->import - $serv->costo;
                                $this->sumaUtilidad += $serv->utilidad;
                            }
                        }
                    }
    
                } else {
    
                    if ($this->estado == "Todos") {
                        $this->costoEntregado = 0;
                        $this->data = [];
                        $data1 = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                            ->join('users as u', 'u.id', 'mov.user_id')
                            ->where('mov.status', 'like', 'ACTIVO')
                            ->where('services.sucursal_id',$this->sucursal)
                            ->select(
                                'services.*',
                                DB::raw('0 as utilidad')
                            )
                            ->whereBetween('mov.created_at', [$this->from, $this->to])
                            ->where('mov.type', 'ENTREGADO')
                            ->orderBy('services.id', 'desc')
                            ->distinct()
                            ->get();
    
    
                        foreach ($data1 as $dat) {
                            foreach ($dat->movservices as $dato) {
                                if ($dato->movs->type == 'TERMINADO' && $dato->movs->user_id == $this->userId) {
                                    $this->costoEntregado += $dat->costo;
                                    array_push($this->data, $dat);
                                }
                            }
                        }
    
                        $datos2 = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                            ->join('users as u', 'u.id', 'mov.user_id')
                            ->where('mov.status', 'like', 'ACTIVO')
                            ->where('services.sucursal_id',$this->sucursal)
                            ->select(
                                'services.*',
                                DB::raw('0 as utilidad')
                            )
                            ->whereBetween('mov.created_at', [$this->from, $this->to])
                            ->where('mov.user_id', $this->userId)
                            ->orderBy('services.id', 'desc')
                            ->distinct()
                            ->get();
    
                        foreach ($datos2 as $dat1) {
                            $validar = 1;
                            foreach ($this->data as $dat2) {
                                if ($dat2->id == $dat1->id) {
                                    $validar = 0;
                                }
                            }
                            if ($validar == 1) {
                                $this->costoEntregado += $dat1->costo;
                                array_push($this->data, $dat1);
                            }
                        }
    
                        foreach ($this->data as $serv) {
                            foreach ($serv->movservices as $mm) {
                                if ($mm->movs->status == 'ACTIVO') {
                                    $serv->utilidad = $mm->movs->import - $serv->costo;
                                    $this->sumaUtilidad += $serv->utilidad;
                                }
                            }
                        }
                        
                    } else {
    
                        $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                            ->join('users as u', 'u.id', 'mov.user_id')
                            ->where('mov.status', 'like', 'ACTIVO')
                            ->where('services.sucursal_id',$this->sucursal)
                            ->select(
                                'services.*',
                                DB::raw('0 as utilidad')
                            )
                            ->whereBetween('mov.created_at', [$this->from, $this->to])
                            ->where('mov.user_id', $this->userId)
                            ->orderBy('services.id', 'desc')
                            ->distinct()
                            ->get();
    
                        foreach ($this->data as $serv) {
                            foreach ($serv->movservices as $mm) {
                                if ($mm->movs->status == 'ACTIVO') {
                                    $serv->utilidad = $mm->movs->import - $serv->costo;
                                    $this->sumaUtilidad += $serv->utilidad;
                                }
                            }
                        }
                    }
                }
            } else {
                if ($this->userId == 0) {
                    $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                        ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                        ->join('users as u', 'u.id', 'mov.user_id')
                        ->where('mov.status', 'like', 'ACTIVO')
                        ->where('services.sucursal_id',$this->sucursal)
                        ->select(
                            'services.*',
                            DB::raw('0 as utilidad')
                        )
                        ->whereBetween('mov.created_at', [$this->from, $this->to])
                        ->where('mov.type', $this->estado)
                        ->orderBy('services.id', 'desc')
                        ->distinct()
                        ->get();
                    foreach ($this->data as $serv) {
                        foreach ($serv->movservices as $mm) {
                            if ($mm->movs->status == 'ACTIVO') {
                                $serv->utilidad = $mm->movs->import - $serv->costo;
                                $this->sumaUtilidad += $serv->utilidad;
                            }
                        }
                    }
                } else {
    
                    if ($this->estado == "ENTREGADO") {
                        $this->costoEntregado = 0;
                        $this->data = [];
                        $data1 = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                            ->join('users as u', 'u.id', 'mov.user_id')
                            ->where('mov.status', 'like', 'ACTIVO')
                            ->where('services.sucursal_id',$this->sucursal)
                            ->select(
                                'services.*',
                                DB::raw('0 as utilidad')
                            )
                            ->whereBetween('mov.created_at', [$this->from, $this->to])
                            ->where('mov.type', $this->estado)
                            ->orderBy('services.id', 'desc')
                            ->distinct()
                            ->get();
    
    
                        foreach ($data1 as $dat) {
                            foreach ($dat->movservices as $dato) {
                                if ($dato->movs->type == 'TERMINADO' && $dato->movs->user_id == $this->userId) {
                                    $this->costoEntregado += $dat->costo;
                                    array_push($this->data, $dat);
                                }
                            }
                        }
    
                        foreach ($this->data as $serv) {
                            foreach ($serv->movservices as $mm) {
                                if ($mm->movs->status == 'ACTIVO') {
                                    $serv->utilidad = $mm->movs->import - $serv->costo;
                                    $this->sumaUtilidad += $serv->utilidad;
                                }
                            }
                        }
                    } else {
    
                        $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                            ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                            ->join('users as u', 'u.id', 'mov.user_id')
                            ->where('mov.status', 'like', 'ACTIVO')
                            ->where('services.sucursal_id',$this->sucursal)
                            ->select(
                                'services.*',
                                DB::raw('0 as utilidad')
                            )
                            ->whereBetween('mov.created_at', [$this->from, $this->to])
                            ->where('mov.user_id', $this->userId)
                            ->where('mov.type', $this->estado)
                            ->orderBy('services.id', 'desc')
                            ->distinct()
                            ->get();
                        foreach ($this->data as $serv) {
                            foreach ($serv->movservices as $mm) {
                                if ($mm->movs->status == 'ACTIVO') {
                                    $serv->utilidad = $mm->movs->import - $serv->costo;
                                    $this->sumaUtilidad += $serv->utilidad;
                                }
                            }
                        }
                    }
                }
            }
        }



        /* if ($this->estado == 'Todos') {
            if ($this->userId == 0) {
                $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                    ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                    ->join('users as u', 'u.id', 'mov.user_id')
                    ->where('mov.status', 'like', 'ACTIVO')
                    ->select(
                        'services.*',
                        DB::raw('0 as utilidad')
                    )
                    ->whereBetween('mov.created_at', [$this->from, $this->to])
                    ->orderBy('services.id', 'desc')
                    ->distinct()
                    ->get();

                foreach ($this->data as $serv) {
                    foreach ($serv->movservices as $mm) {
                        if ($mm->movs->status == 'ACTIVO') {
                            $serv->utilidad = $mm->movs->import - $serv->costo;
                            $this->sumaUtilidad += $serv->utilidad;
                        }
                    }
                }

            } else {

                if ($this->estado == "Todos") {
                    $this->costoEntregado = 0;
                    $this->data = [];
                    $data1 = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                        ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                        ->join('users as u', 'u.id', 'mov.user_id')
                        ->where('mov.status', 'like', 'ACTIVO')

                        ->select(
                            'services.*',
                            DB::raw('0 as utilidad')
                        )
                        ->whereBetween('mov.created_at', [$this->from, $this->to])
                        ->where('mov.type', 'ENTREGADO')
                        ->orderBy('services.id', 'desc')
                        ->distinct()
                        ->get();


                    foreach ($data1 as $dat) {
                        foreach ($dat->movservices as $dato) {
                            if ($dato->movs->type == 'TERMINADO' && $dato->movs->user_id == $this->userId) {
                                $this->costoEntregado += $dat->costo;
                                array_push($this->data, $dat);
                            }
                        }
                    }

                    $datos2 = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                        ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                        ->join('users as u', 'u.id', 'mov.user_id')
                        ->where('mov.status', 'like', 'ACTIVO')
                        ->select(
                            'services.*',
                            DB::raw('0 as utilidad')
                        )
                        ->whereBetween('mov.created_at', [$this->from, $this->to])
                        ->where('mov.user_id', $this->userId)
                        ->orderBy('services.id', 'desc')
                        ->distinct()
                        ->get();

                    foreach ($datos2 as $dat1) {
                        $validar = 1;
                        foreach ($this->data as $dat2) {
                            if ($dat2->id == $dat1->id) {
                                $validar = 0;
                            }
                        }
                        if ($validar == 1) {
                            $this->costoEntregado += $dat1->costo;
                            array_push($this->data, $dat1);
                        }
                    }

                    foreach ($this->data as $serv) {
                        foreach ($serv->movservices as $mm) {
                            if ($mm->movs->status == 'ACTIVO') {
                                $serv->utilidad = $mm->movs->import - $serv->costo;
                                $this->sumaUtilidad += $serv->utilidad;
                            }
                        }
                    }
                    
                } else {

                    $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                        ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                        ->join('users as u', 'u.id', 'mov.user_id')
                        ->where('mov.status', 'like', 'ACTIVO')
                        ->select(
                            'services.*',
                            DB::raw('0 as utilidad')
                        )
                        ->whereBetween('mov.created_at', [$this->from, $this->to])
                        ->where('mov.user_id', $this->userId)
                        ->orderBy('services.id', 'desc')
                        ->distinct()
                        ->get();

                    foreach ($this->data as $serv) {
                        foreach ($serv->movservices as $mm) {
                            if ($mm->movs->status == 'ACTIVO') {
                                $serv->utilidad = $mm->movs->import - $serv->costo;
                                $this->sumaUtilidad += $serv->utilidad;
                            }
                        }
                    }
                }
            }
        } else {
            if ($this->userId == 0) {
                $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                    ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                    ->join('users as u', 'u.id', 'mov.user_id')
                    ->where('mov.status', 'like', 'ACTIVO')
                    ->select(
                        'services.*',
                        DB::raw('0 as utilidad')
                    )
                    ->whereBetween('mov.created_at', [$this->from, $this->to])
                    ->where('mov.type', $this->estado)
                    ->orderBy('services.id', 'desc')
                    ->distinct()
                    ->get();
                foreach ($this->data as $serv) {
                    foreach ($serv->movservices as $mm) {
                        if ($mm->movs->status == 'ACTIVO') {
                            $serv->utilidad = $mm->movs->import - $serv->costo;
                            $this->sumaUtilidad += $serv->utilidad;
                        }
                    }
                }
            } else {

                if ($this->estado == "ENTREGADO") {
                    $this->costoEntregado = 0;
                    $this->data = [];
                    $data1 = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                        ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                        ->join('users as u', 'u.id', 'mov.user_id')
                        ->where('mov.status', 'like', 'ACTIVO')

                        ->select(
                            'services.*',
                            DB::raw('0 as utilidad')
                        )
                        ->whereBetween('mov.created_at', [$this->from, $this->to])
                        ->where('mov.type', $this->estado)
                        ->orderBy('services.id', 'desc')
                        ->distinct()
                        ->get();


                    foreach ($data1 as $dat) {
                        foreach ($dat->movservices as $dato) {
                            if ($dato->movs->type == 'TERMINADO' && $dato->movs->user_id == $this->userId) {
                                $this->costoEntregado += $dat->costo;
                                array_push($this->data, $dat);
                            }
                        }
                    }

                    foreach ($this->data as $serv) {
                        foreach ($serv->movservices as $mm) {
                            if ($mm->movs->status == 'ACTIVO') {
                                $serv->utilidad = $mm->movs->import - $serv->costo;
                                $this->sumaUtilidad += $serv->utilidad;
                            }
                        }
                    }
                } else {

                    $this->data = Service::join('mov_services as ms', 'services.id', 'ms.service_id')
                        ->join('movimientos as mov', 'mov.id', 'ms.movimiento_id')
                        ->join('users as u', 'u.id', 'mov.user_id')
                        ->where('mov.status', 'like', 'ACTIVO')
                        ->select(
                            'services.*',
                            DB::raw('0 as utilidad')
                        )
                        ->whereBetween('mov.created_at', [$this->from, $this->to])
                        ->where('mov.user_id', $this->userId)
                        ->where('mov.type', $this->estado)
                        ->orderBy('services.id', 'desc')
                        ->distinct()
                        ->get();
                    foreach ($this->data as $serv) {
                        foreach ($serv->movservices as $mm) {
                            if ($mm->movs->status == 'ACTIVO') {
                                $serv->utilidad = $mm->movs->import - $serv->costo;
                                $this->sumaUtilidad += $serv->utilidad;
                            }
                        }
                    }
                }
            }
        } */



        if ($this->userId == 0) {
            $this->tecnico = 'Todos';
        } else {
            $this->tecnico = User::find($this->userId)->name;
        }
        $this->estadovista = $this->estado;
        $this->fechadesde = substr($this->from, 0, 10);
        $this->fechahasta = substr($this->to, 0, 10);
    }
}
