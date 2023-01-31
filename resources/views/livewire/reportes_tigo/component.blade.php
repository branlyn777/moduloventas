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
    <h6 class="font-weight-bolder mb-0 text-white">Reportes Tigo</h6>
</nav>
@endsection


@section('tigocollapse')
nav-link
@endsection


@section('tigoarrow')
true
@endsection


@section('reportetigonav')
"nav-link active"
@endsection


@section('tigoshow')
"collapse show"
@endsection

@section('reportetigoli')
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
                        {{-- <a class="btn btn-add mb-0" wire:click="resetUI()" data-bs-toggle="modal"  data-bs-target="#theModalCategory">
                            <i class="fas fa-plus"></i> Agregar Categoría</a> --}}
                    </div>
                </div>

            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <h6>Elige el usuario</h6>
                            <div class="form-group">
                                <select wire:model="userId" class="form-select">
                                    <option value="">Todos</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="col-sm-12 col-md-3">
                            <h6>Elige el tipo de Reporte</h6>
                            <div class="form-group">
                                <select wire:model="reportType" class="form-select">
                                    <option value="0">Transacciones del Día</option>
                                    <option value="1">Transacciones por Fecha</option>
                                </select>
                            </div>
                        </div>
    
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <h6>Origen</h6>
                                <select wire:model="origenfiltro" class="form-select">
                                    <option value="0" selected>Todas</option>
                                    <option value="Sistema">Sistema</option>
                                    <option value="Telefono">Telefono</option>
                                </select>
                            </div>
                        </div>
    
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <h6>Tipo de transacción</h6>
                                <select wire:model="tipotr" class="form-select">
                                    <option value="0" selected>Todas</option>
                                    <option value="Retiro">Retiro</option>
                                    <option value="Abono">Abono</option>
                                </select>
                            </div>
                        </div>
    
                        <div class="col-sm-12 col-md-4">
                            <h6>Fecha desde</h6>
                            <div class="form-group">
                                <input @if ($reportType == 0) disabled @endif type="date" wire:model="dateFrom"
                                    class="form-control">
                            </div>
                        </div>
    
                        <div class="col-sm-12 col-md-4">
                            <h6>Fecha hasta</h6>
                            <div class="form-group">
                                <input @if ($reportType == 0) disabled @endif type="date" wire:model="dateTo"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4 mt-4">
                            <a class=" btn btn-warning btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                                href="{{ url('reporteTigo/pdf' . '/' . $userId . '/' . $reportType . '/' . $origenfiltro . '/' . $tipotr . '/' . $dateFrom . '/' . $dateTo) }}">
                                Generar
                                PDF</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm ps-2">CEDULA</th>
                                    <th class="text-uppercase text-sm ps-2">TELEFONO</th>
                                    <th class="text-uppercase text-sm ps-2">DESTINO</th>
                                    <th class="text-uppercase text-sm ps-2">IMPORTE</th>
                                    <th class="text-uppercase text-sm ps-2">ESTADO</th>
                                    <th class="text-uppercase text-sm ps-2">ORIGEN</th>
                                    <th class="text-uppercase text-sm ps-2">MOTIVO</th>
                                    @can('Origen_Mot_Com_Index')
                                        <th class="text-uppercase text-sm ps-2">GANANCIA</th>
                                    @endcan
                                    <th class="text-uppercase text-sm ps-2">FECHA</th>
                                    <th class="text-uppercase text-sm ps-2" width="50px"></th>
                                    <th class="text-uppercase text-sm ps-2">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data) < 1)
                                    <tr>
                                        <td colspan="9">
                                            <h5 class="text-center">Sin Resultados</h5>
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($data as $d)
                                    <tr
                                        style="{{ $d->estado == 'Anulada' ? 'background-color: #d97171 !important' : '' }}">
                                        <td class="text-sm mb-0" style="height: 5px;">
                                            {{ $d->cedula }}
                                        </td>
                                        <td class="text-sm mb-0">
                                            {{ $d->telefono }}
                                        </td>
                                        <td class="text-sm mb-0">
                                            {{ $d->codigo_transf }}
                                        </td>
                                        <td class="text-sm mb-0">
                                            {{ number_format($d->importe, 2) }}
                                        </td>
                                        <td class="text-sm mb-0">
                                            {{ $d->estado }}
                                        </td>
                                        <td class="text-sm mb-0">
                                            {{ $d->origen_nombre }}
                                        </td>
                                        <td class="text-sm mb-0">
                                            {{ $d->motivo_nombre }}
                                        </td>
                                        @can('Origen_Mot_Com_Index')
                                            <td class="text-sm mb-0">
                                                {{ number_format($d->ganancia) }}
                                            </td>
                                        @endcan
                                        <td class="text-sm mb-0">
                                            {{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="text-sm mb-0" width="50px">
                                            <button wire:click.prevent="getDetails({{ $d->id }})"
                                                class="btn btn-primary btn-sm" title="Ver observaciones">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-align-center">
                                                    <line x1="18" y1="10" x2="6" y2="10"></line>
                                                    <line x1="21" y1="6" x2="3" y2="6"></line>
                                                    <line x1="21" y1="14" x2="3" y2="14"></line>
                                                    <line x1="18" y1="18" x2="6" y2="18"></line>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.reportes_tigo.sales-detail')
    @include('livewire.reportes_tigo.modaleditartransaccion')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        //eventos
        window.livewire.on('show-modal', msg => {
            $('#modalDetails').modal('show')
        });
        window.livewire.on('item', msg => {
            noty(msg)
        });
        flatpickr(document.getElementsByClassName('flatpickr'), {
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
        })

    })
</script>
