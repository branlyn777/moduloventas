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


<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-heading">
                <h4 class="card-title text-center"><b>{{ $componentName }}</b></h4>
            </div>

            <div class="widget-content">
                <div class="row">
                    @can('Modificar_Sucursal_Caja_Jornada_Tigo_Money')
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label>
                                    <h6>Seleccione la sucursal</h6>
                                </label>
                                <select wire:model="sucursal" class="form-control">
                                    <option value="Elegir" disabled>Elegir</option>
                                    @foreach ($sucursales as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label>
                                    <h6>Seleccione la caja</h6>
                                </label>
                                <select wire:model="caja" class="form-control">
                                    <option value="Elegir">Elegir</option>
                                    @foreach ($cajas as $c)
                                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endcan
                    @if (!empty(session('sesionCaja')))
                        <div class="col-sm-12 col-md-3">
                            <h6>Fecha desde</h6>
                            <div class="form-group">
                                <input type="date" wire:model="dateFrom" class="form-control"
                                    placeholder="Click para elegir">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table table-bordered table-bordered-bd-warning mt-4">
                                    <thead class="text-white" style="background: #ee761c">
                                        <tr>
                                            <th class="table-th text-withe text-center">INDICADORES DIARIOS</th>
                                            <th class="table-th text-withe text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h6 class="text-center">TOTAL INGRESOS POR SERVICIOS EXTRAS SISTEMA
                                                </h6>
                                            </td>
                                            <td>
                                                <h6>{{ $sistema }}</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="text-center">TOTAL INGRESOS POR SERVICIOS EXTRAS TELEFONO
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
                    @else
                    <div class="col-sm-12 col-md-12">
                        <h6 class="text-center">NO TIENES UNA CAJA ABIERTA</h6>
                    </div>
                    @endif

                </div>
            </div>
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
