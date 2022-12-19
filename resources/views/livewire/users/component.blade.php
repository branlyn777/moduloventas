<div>
    <div class="d-sm-flex justify-content-between">
        <div>
            {{-- <a href="javascript:void(0)" class="btn btn-icon btn-outline-white">
        New order
        </a> --}}
        </div>
        <div class="d-flex">
            {{-- <div class="dropdown d-inline">
          <a href="javascript:void(0)" class="btn btn-outline-white dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2" aria-expanded="false">
          Filtrar
          </a>
          <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2" style="">
            <li><a class="dropdown-item border-radius-md" href="javascript:void(0)">Estado: Activo</a></li>
            <li><a class="dropdown-item border-radius-md" href="javascript:void(0)">Estado: Inactivo</a></li>
            <li>
            <hr class="horizontal dark my-2">
            </li>
            <li><a class="dropdown-item border-radius-md text-danger" href="javascript:void(0)">Remover Filtros</a></li>
          </ul>
        </div> --}}
            <button wire:click="Agregar()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv"
                type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Nuevo Usuario</span>
            </button>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista de Usuarios</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder">Usuario</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder ps-2">Teléfono</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">Estado</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">Sucursal</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>



                                @foreach ($data as $r)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('storage/usuarios/' . $r->imagen) }}"
                                                        class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $r->name }}</h6>
                                                    <p class="text-xs mb-0">{{ $r->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $r->phone }}</p>
                                            <p class="text-xs mb-0">{{ $r->profile }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">

                                            @if ($r->status == 'ACTIVE')
                                                <span class="badge badge-sm bg-gradient-success">
                                                    ACTIVO
                                                </span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">
                                                    INACTIVO
                                                </span>
                                            @endif

                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs text-xs font-weight-bold">
                                                @foreach ($r->sucursalusers as $su)
                                                    @if ($su->estado == 'ACTIVO')
                                                        {{ $su->sucursal->name }}
                                                    @endif
                                                @endforeach
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($r->status == 'ACTIVE')
                                                <a href="javascript:void(0)"
                                                    wire:click.prevent="viewDetails('{{ $r->id }}')"
                                                    class="mx-3">
                                                    <i class="fas fa-eye text-default"></i>
                                                </a>
                                                <a href="javascript:void(0)" wire:click="Edit({{ $r->id }})"
                                                    class="mx-3">
                                                    <i class="fas fa-user-edit text-default"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="Confirm('{{ $r->id }}','{{ $r->name }}')"
                                                    class="mx-3">
                                                    <i class="fas fa-trash text-default"></i>
                                                </a>
                                            @endif
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

    @include('livewire.users.form')
    @include('livewire.users.modalDetails')
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('sucursal-actualizada', Msg => {
            $('#modal-details').modal('hide')
            noty(Msg)
        })
        window.livewire.on('atencion', Msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                padding: '2em'
            });
            toast({
                type: 'info',
                title: "¡No puedes eliminarte a ti mismo!",
                padding: '2em',
            })
        })
        window.livewire.on('item-deleted', Msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: "¡Acción realizada con éxito!",
                padding: '2em',
            })
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        });
        window.livewire.on('user-withsales', Msg => {
            noty(Msg)
        })
        window.livewire.on('user-fin', Msg => {
            $('#modal-details').modal('hide')
            noty(Msg)
        })
        window.livewire.on('show-modal2', Msg => {
            $('#modal-details').modal('show')
        })
    });

    function Confirm(id, name, movimientos) {
        swal({
            title: '¿Inactivar al usuario "' + name + '"?',
            text: "Se inactivará al usuario " + name + " del sistema.",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Inactivar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
            }
        })

    }
</script>
