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
        <h6 class="font-weight-bolder mb-0 text-white">Origen Motivo</h6>
    </nav>
@endsection


@section('tigocollapse')
    nav-link
@endsection


@section('tigoarrow')
    true
@endsection


@section('origenmotnav')
    "nav-link active"
@endsection


@section('tigoshow')
    "collapse show"
@endsection

@section('origenmotivoli')
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
                        <button wire:click.prevent="SyncAll()" type="button" class="btn btn-success"><i
                                class="fas fa-rotate me-2"></i> Sincronizar todos</button>
                        <button onclick="Revocar()" type="button" class="btn btn-danger"><i
                                class="fas fa-circle-xmark me-2"></i> Revocar todos</button>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
               <div class="card-body p-4">
                    <div class="padding-left: 12px; padding-right: 12px;">
                        <div class="row justify-content-between">
                            <div class="mt-lg-0 col-md-3">
                                <label style="font-size: 1rem">Seleccionar</label>
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <select wire:model="origen" class="form-select">
                                            <option value="Elegir" disabled selected>==Seleccione el Origen==</option>
                                            @foreach ($origenes as $origen)
                                                <option value="{{ $origen->id }}" selected>{{ $origen->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
                                    <th class="text-uppercase text-sm text-center">ID</th>
                                    <th class="text-uppercase text-sm text-center">MOTIVOS</th>
                                    <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($motivos as $motivo)
                                    <tr style="font-size: 14px">
                                        <td>
                                            <h6 class="text-center">{{ $motivo->id }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <div class="n-chk">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox"
                                                        wire:change="SyncPermiso($('#p' + {{ $motivo->id }}).is(':checked'), '{{ $motivo->id }}')"
                                                        id="p{{ $motivo->id }}" value="{{ $motivo->id }}"
                                                        class="new-control-input"
                                                        {{ $motivo->checked == 1 ? 'checked' : '' }}>
                                                    <span class="new-control-indicator"></span>
                                                    <h6>{{ $motivo->nombre }}</h6>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {{-- <a onclick="Confirm('{{ $motivo->id }}','{{ $motivo->nombre }}')" type="button" class="mx-3">
                                                <i class="fa-sharp fa-solid fa-circle-minus text-danger"></i>
                                            </a>

                                            <a wire:click.prevent="viewDetails({{ $motivo->id }})" type="button" class="mx-3">
                                                <i class="fa-solid fa-list"></i>
                                            </a> --}}
                                            @if ($motivo->checked == 1)
                                                @if ($motivo->condicional != 'no')
                                                    <a onclick="Confirm('{{ $motivo->id }}','{{ $motivo->nombre }}')" type="button" class="mx-3">
                                                        <i class="fa-sharp fa-solid fa-circle-minus text-danger"></i>
                                                    </a>
                                                @else
                                                    <a disabled wire:click.prevent="Condicion()" type="button" class="mx-3">
                                                        <i class="fa-sharp fa-solid fa-circle-minus text-danger"></i>
                                                    </a>
                                                @endif

                                                <a wire:click.prevent="viewDetails({{ $motivo->id }})" type="button" class="mx-3">
                                                    <i class="fas fa-plus" style="font-size: 14px"></i>
                                                </a>
                                            @endif



                                            {{-- <button wire:click.prevent="viewDetails({{ $motivo->id }})"
                                                    class="btn btn-warning">
                                                    <i class="fas fa-list"></i>
                                                </button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $motivos->links() }}
        </div>
    </div>
    @include('livewire.origen_motivo.modalDetails')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('asignado', Msg => {
            $('#modal-details').modal('hide')
            noty(Msg)
        });
        window.livewire.on('sync-error', Msg => {
            noty(Msg)
        });
        window.livewire.on('permi', Msg => {
            noty(Msg)
        });
        window.livewire.on('syncall', Msg => {
            noty(Msg)
        });
        window.livewire.on('removeall', Msg => {
            noty(Msg)
        });
        window.livewire.on('asignar', Msg => {
            $('#modal-details').modal('show')
        })
    });

    function Revocar() {

        swal.fire({
            title: 'CONFIRMAR',
            type: 'warning',
            text: '¿Confirmas revocar todos los motivos?',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            // cancelButtonColor: '#383838',
            // confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('revokeall')
                Swal.close()
            }
        })
    }

    function Confirm(id, nombre) {
        swal.fire({
            title: 'CONFIRMAR',
            type: 'warning',
            text: '¿Confirmar quitar todas las configuraciones de ' + nombre + '?',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            // cancelButtonColor: '#383838',
            // confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.close()
            }
        })
    }
</script>
