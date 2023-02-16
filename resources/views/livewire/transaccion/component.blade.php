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
        <h6 class="font-weight-bolder mb-0 text-white">Tigo Money</h6>
    </nav>
@endsection


@section('tigocollapse')
    nav-link
@endsection


@section('tigoarrow')
    true
@endsection


@section('nuevanav')
    "nav-link active"
@endsection


@section('tigoshow')
    "collapse show"
@endsection

@section('nuevali')
    "nav-item active"
@endsection
<div>
    <div class="card-header pt-0">
        <div class="d-lg-flex">
            <div>
                <h5 class="text-white" style="font-size: 16px">{{ $componentName }} | {{ $pageTitle }}</h5>
            </div>
            <div class="ms-auto my-auto mt-lg-0 mt-4">
                <div class="ms-auto my-auto">
                    <button wire:click="nuevatransaccion()" class="btn btn-add">
                        <i class="fas fa-plus me-2"></i>
                        Nueva transacción
                    </button>
                </div>
            </div>
        </div>
    </div>
    <br>


    <div class="row">
        @foreach ($carterasCaja as $item)
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card">
                <div class="card-body">
                    <b>{{ $item->nombre }}:</b>
                    {{ number_format($item->monto, 2, ',', '.') }} Bs
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <br>


    <div class="card">
        <div class="card-body">
            <div class="">
                <div class="col-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <h6>Buscar</h6>
                        @include('common.searchbox')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div style="padding-left: 12px; padding-right: 12px;">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-sm  ps-2">HORA</th>
                                        <th class="text-uppercase text-sm  ps-2">CÉDULA</th>
                                        <th class="text-uppercase text-sm  ps-2">CONTACTO</th>
                                        <th class="text-uppercase text-sm  ps-2">CODIGO/TELEFONO</th>
                                        <th class="text-uppercase text-sm  ps-2">ORIGEN</th>
                                        <th class="text-uppercase text-sm  ps-2">MOTIVO</th>
                                        <th class="text-uppercase text-sm  ps-2">MONTO</th>
                                        <th class="text-uppercase text-sm  ps-2">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr
                                            style="{{ $d->estado == 'Anulada' ? 'background-color: #d97171 !important' : '' }}">
                                            <td class="text-center">
                                                <strong>{{ \Carbon\Carbon::parse($d->hora)->format('H:i') }}</strong>
                                            </td>
                                            <td class="text-sm mb-0">
                                                {{ $d->codCliente }}</strong>
                                            </td>
                                            <td class="text-sm mb-0">
                                                {{ $d->TelCliente }}</strong>
                                            </td>
                                            <td class="text-sm mb-0">
                                                {{ $d->codigotrans }}</strong>
                                            </td>
                                            <td class="text-sm mb-0">
                                                {{ $d->origen_nombre }}
                                            </td>
                                            <td class="text-sm mb-0">
                                                {{ $d->motivo_nombre }}
                                            </td>
                                            <td class="text-sm mb-0">
                                                {{ $d->importe }}
                                            </td>
                                            <td class="text-center">
                                                @if ($d->estado != 'Anulada')
                                                        <a href="javascript:void(0)" onclick="Confirm({{ $d->id }})"
                                                            class="btn btn-warning" title="Anular">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endif
                                                <a href="javascript:void(0)"
                                                    wire:click="VerObservaciones({{ $d->id }})"
                                                    class="btn btn-dark mtmobile" title="Observaciones">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-align-center">
                                                        <line x1="18" y1="10" x2="6"
                                                            y2="10">
                                                        </line>
                                                        <line x1="21" y1="6" x2="3"
                                                            y2="6">
                                                        </line>
                                                        <line x1="21" y1="14" x2="3"
                                                            y2="14">
                                                        </line>
                                                        <line x1="18" y1="18" x2="6"
                                                            y2="18">
                                                        </line>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{ $data->links() }}
        </div>
    </div>
    @include('livewire.transaccion.form')
    @include('livewire.transaccion.modalObservaciones')
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
           
        })
        window.livewire.on('item-anulado', Msg => {
      
        })
        window.livewire.on('item-error', Msg => {
         
        })
        window.livewire.on('item-actualizado', Msg => {
            $('#Modal_Observaciones').modal('hide')
          
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal2', Msg => {
            $('#modal-detailes').modal('show')
        })
        window.livewire.on('show-modal3', Msg => {
            $('#Modal_Observaciones').modal('show')
        })
        window.livewire.on('g-i/e', Msg => {
            $('#modal-detailes').modal('hide')
            noty(Msg)
        })
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

    });

    function Confirm(id) {
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Realmente desea Anular esta transacción?',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#383838',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.close()
            }
        })
    }
</script>
