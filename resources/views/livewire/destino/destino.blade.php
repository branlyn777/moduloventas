<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Destinos Productos</h5>
                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a class="btn bg-gradient-primary btn-sm mb-0" wire:click="modalestancia()">Nuevo Destino</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-lg-flex">
                        <div class="col-12 col-sm-6 col-md-3 text-center">
                            @include('common.searchbox')
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4 col-md-2">
                            <select wire:model='sucursal_id' class="form-control">
                                @foreach($sucursales as $s)
                                <option value="{{$s->id}}">{{$s->name}}</option>
                                @endforeach
                                <option value="Todos">Todas las Sucursales</option>
                            </select>
                            
                            <select wire:model='estados' class="form-control">
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                                <option value="TODOS">TODOS</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-container">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>NO</th>
                                                <th>NOMBRE</th>                                
                                                <th>OBSERVACION</th>
                                                <th>SUCURSAL</th>
                                                <th>FECHA CREACION</th>
                                                <th>FECHA ACTUALIZACION</th>
                                                <th>ESTADO</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($destinos as $d)
                                                @if($d->venta == "No")
                                                    <tr class="text-center">
                                                        <td>
                                                            {{ ($destinos->currentpage()-1) * $destinos->perpage() + $loop->index + 1 }}
                                                        </td>
                                                        <td>
                                                            {{ $d->nombredestino }}
                                                        </td>
                                                        <td>
                                                            {{ $d->observacion }}
                                                        </td>
                                                        <td>
                                                            {{ $d->nombresucursal }}
                                                        </td>

                                                        <td>
                                                            {{ \Carbon\Carbon::parse($d->creacion)->format('d/m/Y H:i') }}
                                                        </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($d->actualizacion)->format('d/m/Y H:i') }}
                                                        </td>
                                                        <td>
                                                            @if ($d->estado == 'ACTIVO')
                                                                <span class="badge badge-success mb-0">{{$d->estado}}</span>
                                                            @else
                                                                <span class="badge badge-danger mb-0">{{$d->estado}}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button wire:click="Edit({{ $d->iddestino }})" class="boton-celeste" title="Editar Estancia">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button onclick="Confirm('{{ $d->iddestino }}','{{ $d->nombre }}')" class="boton-rojo" title="Anular Estancia">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @else
                                                <tr class="text-center" style="background-color: rgb(248, 248, 178);">
                                                    <td>
                                                        {{ ($destinos->currentpage()-1) * $destinos->perpage() + $loop->index + 1 }}
                                                    </td>
                                                    <td>
                                                        {{ $d->nombredestino }}
                                                    </td>
                                                    <td>
                                                        {{ $d->observacion }}
                                                    </td>
                                                    <td>
                                                        {{ $d->nombresucursal }}
                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($d->creacion)->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($d->actualizacion)->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td>
                                                        @if ($d->estado == 'ACTIVO')
                                                            <span class="badge badge-success mb-0">{{$d->estado}}</span>
                                                        @else
                                                            <span class="badge badge-danger mb-0">{{$d->estado}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button wire:click="Edit({{ $d->iddestino }})" class="boton-celeste" title="Editar Estancia">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ $destinos->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.destino.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('unidad-added', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('unidad-updated', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });        
        $('theModal').on('hidden.bs.modal',function(e) {
            $('.er').css('display','none')
        })

    });

    function Confirm(id,nombre) {
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar la unidad ' + '"' + nombre + '"',
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