<div wire:ignore.self class="modal fade" id="formUsers" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">
                        {{ $componentName }}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
                    </p>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="col-md-12">

                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" wire:model.lazy="name" class="form-control"
                                {{ $status == 'LOCKED' ? "disabled='true'" : '' }}>
                            @error('name')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" wire:model.lazy="phone" class="form-control" maxlength="8"
                                {{ $status == 'LOCKED' ? "disabled='true'" : '' }}>
                            @error('phone')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" wire:model.lazy="email" class="form-control"
                                placeholder="ej: correo@correo.com" {{ $status == 'LOCKED' ? "disabled='true'" : '' }}>
                            @error('email')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            @if ($selected_id == 0)
                                <label>Contraseña</label>
                            @else
                                <label>Nueva contraseña (opcional)</label>
                            @endif
                            <input type="password" date-type='currency' wire:model.lazy="password" class="form-control"
                                {{ $status == 'LOCKED' ? "disabled='true'" : '' }}>
                            @error('password')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Asignar rol</label>
                            <select wire:model='profile' class="form-select"
                                {{ $status == 'LOCKED' ? "disabled='true'" : '' }}>
                                <option value="Elegir" disabled selected>Elegir</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('profile')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    @if ($selected_id == 0)
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Sucursal</label>
                                <select wire:model='sucursal_id' class="form-select">
                                    <option value="Elegir" disabled selected>Elegir</option>
                                    @foreach ($sucursales as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('sucursal_id')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group custom-file">
                            <input type="file" class="custom-file-input form-control" wire:model="image"
                                accept="image/x-png,image/gif,image/jpeg">
                            <label class="custom-file-label">Imagen {{ $image }}</label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        @if ($selected_id != 0)
                            <div class="form-check form-switch">
                                @if ($status == 'ACTIVE')
                                    <input class="form-check-input bg-success" type="checkbox"
                                        id="flexSwitchCheckDefault" wire:click='finalizar()'>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Inactivar
                                        Usuario</label>
                                @else
                                    <input class="form-check-input bg-secondary" type="checkbox"
                                        id="flexSwitchCheckDefault" wire:click='Activar()'>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Activar Usuario</label>
                                @endif
                            </div>

                        @endif

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">CANCELAR</button>
                @if ($selected_id < 1)
                    <button wire:click.prevent="Store()" type="button" class="btn btn-primary">
                        GUARDAR
                    </button>
                @else
                    <button type="button" wire:click.prevent="Update()" class="btn btn-primary">
                        ACTUALIZAR
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
       document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('sm', Msg => {
        $('#formUsers').modal('hide')
        $('#formUsers').modal('show')
        console.log("as");
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
       })
</script>
