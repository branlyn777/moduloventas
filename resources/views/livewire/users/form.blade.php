<div wire:ignore.self class="modal fade" id="formUsers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="z-index: 100000000000000000000000">
    <div class="modal-dialog modal-dialog-centered modal-xl">
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
                    <div class="col-md-5">
                        <div class="row m-2">
                            <div class="col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="card-body">
                                        @if ($selected_id > 0)
                                            <h5 class="font-weight-bolder">{{ $name }}</h5>
                                        @else
                                            <h5 class="font-weight-bolder">Nuevo Usuario</h5>
                                        @endif


                                        @if ($image)
                                            <div class="row justify-content-center">
                                                <img src="{{ $image->temporaryUrl() }}"
                                                    style="width:18rem;
                                                    height:18rem;
                                                   -webkit-mask-image:radial-gradient(circle 1rem at 50% 50%, black 75%, transparent 76%);">
                                                     <div class="rightRound"
                                                     style="max-height: auto; max-width: 15rem;
                                                     position: relative;
                                                     margin: auto;
                                                     text-align: center;">
                                                     <input type="file" wire:model='image'
                                                         style="  position: absolute;
                                                         transform: scale(2);
                                                         opacity: 0;"
                                                         accept=".jpg, .jpeg, .png">
                                                     <i class="fa fa-camera"></i>
                                                 </div>
                                                </div>
                                        @else
                                            <div class="row justify-content-center">


                                                {{--                                                     
                                                    <img src="{{ asset('storage/usuarios/' . $imagen) }}"
                                                    class="w-100 border-radius-lg shadow-lg mt-3" style="max-height: auto;min-height: 11rem; max-width: 15rem;"> --}}


                                                <img src="{{ asset('storage/usuarios/' . $imagen) }}"
                                                    style="border-radius: 50%;
                                                    border: 0.8rem solid #DCDCDC;
                                                     width: 16rem;
                                                   height: 16rem;">

                                                <div class="rightRound"
                                                    style="max-height: auto; max-width: 15rem;
                                                    position: relative;
                                                    margin: auto;
                                                    text-align: center;">
                                                    <input type="file" wire:model='image'
                                                        style="  position: absolute;
                                                        transform: scale(2);
                                                        opacity: 0;"
                                                        accept=".jpg, .jpeg, .png">
                                                    <i class="fa fa-camera"></i>
                                                </div>


                                            </div>
                                        @endif





                                    </div>
                                </div>
                                {{-- <div class="row mt-4 ps-0">
        
                                    <div class="form-group custom-file">
                                        <input type="file" class="custom-file-input form-control" wire:model="image"
                                            accept="image/x-png,image/gif,image/jpeg">
                                        <label class="custom-file-label">Imagen {{ $image }}</label>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row m-2 mt-6">
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
                                        placeholder="ej: correo@correo.com"
                                        {{ $status == 'LOCKED' ? "disabled='true'" : '' }}>
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
                                    <input type="password" date-type='currency' wire:model.lazy="password"
                                        class="form-control" {{ $status == 'LOCKED' ? "disabled='true'" : '' }}>
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
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Activar
                                                Usuario</label>
                                        @endif
                                    </div>

                                @endif

                            </div>
                        </div>
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
