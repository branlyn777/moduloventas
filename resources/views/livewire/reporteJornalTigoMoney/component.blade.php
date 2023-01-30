@section('migaspan')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="text-white" href="javascript:;">
                    <i class="ni ni-box-2"></i>
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                    href="{{ url('') }}">Inicio</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Gestion</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Reporte Jornada Tigo</h6>
    </nav>
@endsection


@section('tigocollapse')
    nav-link
@endsection


@section('tigoarrow')
    true
@endsection


@section('reportejornadatenav')
    "nav-link active"
@endsection


@section('tigoshow')
    "collapse show"
@endsection

@section('reportejornadali')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">{{ $componentName }}</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">

                    </div>
                </div>

            </div>

            <div class="card mb-4">
                <div class="card-body m-2">
                    <div class="padding-left: 12px; padding-right: 12px;">
                        <div class="row justify-content">
                            {{-- @can('Modificar_Sucursal_Caja_Jornada_Tigo_Money') --}}
                            <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem;">Seleccione la sucursal</label>
                                <select wire:model="sucursal" class="form-select">
                                    <option value="Elegir" disabled>Elegir</option>
                                    @foreach ($sucursales as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem;">Seleccione la caja</label>
                                <select wire:model="caja" class="form-select">
                                    <option value="Elegir">Elegir</option>
                                    @foreach ($cajas as $c)
                                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- @endcan --}}
                            @if (!empty(session('sesionCaja')))
                                <div class="col-12 col-sm-6 col-md-2" style="margin-bottom: 7px;">
                                    <label style="font-size: 1rem;">Fecha</label>
                                    <input type="date" wire:model="dateFrom" class="form-control"
                                        placeholder="Click para elegir">
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="text-white">
                                <tr>
                                    <th class="table-th text-withe text-center">INDICADORES DIARIOS</th>
                                    <th class="table-th text-withe text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h6 class="text-center">TOTAL INGRESOS POR SERVICIOS EXTRAS
                                            SISTEMA
                                        </h6>
                                    </td>
                                    <td>
                                        <h6>{{ $sistema }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h6 class="text-center">TOTAL INGRESOS POR SERVICIOS EXTRAS
                                            TELEFONO
                                        </h6>
                                    </td>
                                    <td>
                                        <h6>{{ $telefono }}</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h6 class="text-center">CALCULO ENTRE AMBOS</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $total }}</h6>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-12 col-md-12">
                <h6 class="text-center">NO TIENES UNA CAJA ABIERTA</h6>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        /* flatpickr(document.getElementsByClassName('flatpickr'), {
            enableTime: false,
            dateFormat: 'Y-m-d',
            locale: {
                firstDayofweek: 1,
                weekdays: {
                    shorthand: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                    longhand: [
                        "Domingo",
                        "Lunes",
                        "Martes",
                        "Miércoles",
                        "Jueves",
                        "Viernes",
                        "Sábado",
                    ],
                },
                months: {
                    shorthand: [
                        "Ene",
                        "Feb",
                        "Mar",
                        "Abr",
                        "May",
                        "Jun",
                        "Jul",
                        "Ago",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dic",
                    ],
                    longhand: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre",
                    ],
                },
            }
        }) */

        //eventos
        window.livewire.on('show-modal', msg => {
            $('#modalDetails').modal('show')
        });
    })
</script>
