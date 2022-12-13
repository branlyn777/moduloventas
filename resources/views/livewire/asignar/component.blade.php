<div>


    <div class="d-sm-flex justify-content-between">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-sm-flex justify-content-between">
                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <div class="form-group">
                            <b class="text-black">Seleccione Rol</b>
                            <select wire:model="role" class="form-control">
                                <option value="Elegir" selected>==Seleccione el rol==</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <div class="form-group">
                            <b class="text-black">Area Permiso</b>
                            <select wire:model="permisosseleccionado" class="form-control">
                                <option value="Todos"><b>==Todos los Permisos==</b></option>
                                @foreach ($listaareas as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class=" ">

                        {{-- Boton de Sincronizar --}}
                        @if ($permisosseleccionado != 'Todos')
                            <button wire:click.prevent="SyncAll2()" type="button"
                                class="btn btn-icon btn-outline-black ms-2 export">
                                <span class="btn-inner--icon">
                                    <i class="ni ni-fat-add"></i>
                                </span class="btn-inner--text"> Sincronizar Todos
                                Area</button>
                        @else
                            <button wire:click.prevent="SyncAll()" type="button"
                                class="btn btn-icon btn-outline-black ms-2 export">
                                <span class="btn-inner--icon">
                                    <i class="ni ni-fat-add"></i>
                                </span class="btn-inner--text"> Sincronizar Todos</button>
                            {{-- <button onclick="Revocar()" type="button" class="boton-rojo-g">Revocar Todos</button> --}}
                        @endif

                        {{-- Boton de Revocar  --}}
                        @if ($permisosseleccionado == 'Todos')
                            <button onclick="Revocar()" type="button"
                                class="btn btn-icon btn-outline-black ms-2 expor">
                                <span class="btn-inner--icon">
                                    <i class="ni ni-fat-add"></i>
                                </span class="btn-inner--text"> RevocarTodos</button>
                        @endif

                        {{-- Boton de IR a Usuarios --}}
                        <button href="users" type="button" class="btn btn-icon btn-outline-black ms-2 expor">
                            <span class="btn-inner--icon">
                                <i class="ni ni-fat-add"></i>
                            </span class="btn-inner--text"> Ir a Usuarios
                        </button>

                    </div>
                </div>
                <div class="card-header pb-0">
                    <h6>Asignar Permisos</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0"">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-uppercase text-xxs font-weight-bolder"z>ID</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder"z>#</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder"z>PERMISO</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder"z>ROLES CON EL PERMISO</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder"z>AREA</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder"z>DESCRIPCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permisos as $permiso)
                                    <tr>
                                        <td class="text-xs mb-0">
                                            {{ ($permisos->currentpage() - 1) * $permisos->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="text-xs mb-0">

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
                                        <td class="text-xs mb-0">
                                            {{ $permiso->name }}
                                        </td>
                                        <td class="text-xs mb-0">
                                            {{ \App\Models\User::permission($permiso->name)->count() }}
                                        </td>
                                        <td class="text-xs mb-0">
                                            {{ $permiso->area }}
                                        </td>
                                        <td class="text-xs mb-0">
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
