<div class="d-sm-flex justify-content-between">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Asignar Permisos</h6>
            </div>

            <div class="d-lg-flex m-3">
                <div class="col-12 col-sm-6 col-md-3 text-center">
                    <div class="form-group me-3">
                        <b class="text-dark">Seleccione Rol</b>
                        <select wire:model="role" class="form-select">
                            <option value="Elegir" selected>==Seleccione el rol==</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3 text-center">
                    <div class="form-group me-2">
                        <b class="text-dark">Area Permiso</b>
                        <select wire:model="permisosseleccionado" class="form-select">
                            <option value="Todos"><b>==Todos los Permisos==</b></option>
                            @foreach ($listaareas as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-12 col-sm-12 col-md-6">
                    <div class="row justify-content-center">
                        {{-- Boton de Sincronizar --}}
                        @if ($permisosseleccionado != 'Todos')
                            <button wire:click.prevent="SyncAll2()" type="button"
                                class="col-12 col-sm-3 col-md-4 btn btn-info">
                                <span class="btn-inner--icon">
                                    <i class="fas fa-rotate me-2"></i>
                                </span class="btn-inner--text"> Sincronizar Todos
                                Area</button>
                        @else
                            <button wire:click.prevent="SyncAll()" type="button"
                                class="col-12 col-sm-3 col-md-4 btn btn-info">
                                <span class="btn-inner--icon">

                                    <i class="fas fa-rotate me-2"></i>
                                </span class="btn-inner--text"> Sincronizar Todos</button>
                            {{-- <button onclick="Revocar()" type="button" class="boton-rojo-g">Revocar Todos</button> --}}
                        @endif
                                
                        {{-- Boton de Revocar  --}}
                        @if ($permisosseleccionado == 'Todos')
                            <button onclick="Revocar()" type="button"
                                class="col-12 col-sm-3 col-md-4 btn btn-icon btn-info">
                                <span class="btn-inner--icon">

                                    <i class="fas fa-circle-xmark me-2"></i>
                                </span class="btn-inner--text"> Revocar Todos</button>
                        @endif

                        {{-- Boton de IR a Usuarios --}}
                        <a href="users" class="col-12 col-sm-3 col-md-3 btn btn-secondary" data-type="csv"
                            type="button">
                            <span class="btn-inner--text">Ir a Usuarios</span>
                            <span class="btn-inner--icon">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>


            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0"">
                    <table class="table align-items-left mb-0">
                        <thead>
                            <tr class="text-left">
                                <th class="text-uppercase text-sm text-center">ID</th>
                                <th class="text-uppercase text-sm ps-2 text-center">#</th>
                                <th class="text-uppercase text-sm ps-2 text-left">PERMISO</th>
                                <th class="text-uppercase text-sm ps-2 text-center">ROLES CON EL PERMISO</th>
                                <th class="text-uppercase text-sm ps-2 text-left">AREA</th>
                                <th class="text-uppercase text-sm ps-2 text-left">DESCRIPCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permisos as $permiso)
                                <tr>
                                    <td class="text-sm text-center">
                                        {{ ($permisos->currentpage() - 1) * $permisos->perpage() + $loop->index + 1 }}
                                    </td>
                                    <td class="text-sm ps-1 text-left">
                                        <div style="padding-top: 5px;">
                                            <label class="switch">
                                                <input type="checkbox"
                                                    wire:change="SyncPermiso($('#p' + {{ $permiso->id }}).is(':checked'), '{{ $permiso->name }}')"
                                                    id="p{{ $permiso->id }}" value="{{ $permiso->id }}"
                                                    {{ $permiso->checked == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-sm mb-0 text-left">
                                        {{ $permiso->name }}
                                    </td>
                                    <td class="text-sm mb-0 text-center">
                                        {{ \App\Models\User::permission($permiso->name)->count() }}
                                    </td>
                                    <td class="text-sm mb-0 text-left">
                                        {{ $permiso->area }}
                                    </td>
                                    <td class="text-sm mb-0 text-left">
                                        {{ $permiso->descripcion }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $permisos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('sync-error', Msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                padding: '2em'
            });
            toast({
                type: 'info',
                title: 'Error al ejecutar acción',
                padding: '2em',
            })
        });
        window.livewire.on('permi', Msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: '¡Cambio Hecho Exitósamente!',
                padding: '2em',
            })
        });
        window.livewire.on('syncall', Msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: '¡Permisos sincronizados exitósamente!',
                padding: '2em',
            })
        });
        window.livewire.on('removeall', Msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: '¡Todos los permisos removidos exitósamente!',
                padding: '2em',
            })
        });
    });

    function Revocar() {
        swal({
            title: '¿Revocar todos los Permisos?',
            text: "Esta acción removerá todos los permisos del rol seleccionado",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Revocar Permisos',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('revokeall')
            }
        })
    }
</script>
