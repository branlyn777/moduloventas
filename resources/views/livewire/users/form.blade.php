<style>
    .container {
        width: 18rem;
        height: 18rem;
        display: block;
        margin: 0 auto;
    }

    .outer {
        width: 100% !important;
        height: 100% !important;
        max-width: 18rem !important;
        /* any size */
        max-height: 18rem !important;
        /* any size */
        margin: auto;

        position: relative;
    }

    .outer img {
        width: 15rem;
        height: 15rem;
        margin: auto;
        position: absolute;
        bottom: 0;
        left: 0;
        top: 0;
        right: 0;
        z-index: 1;
        -webkit-mask-image: radial-gradient(circle 10rem at 50% 50%, black 75%, transparent 75%);
        border: 5px solid #d7d7d8;
        border-radius: 50%;
        padding: 3px;

    }

    .inner {
        background-color: #5e72e4;
        width: 45px;
        height: 45px;
        border-radius: 100%;
        position: absolute;
        bottom: 0;
        right: 0;
        -ms-transform: translate(-70%, -60%);
        transform: translate(-50%, -50%);
        z-index: 999999999;
    }

    .inner:hover {
        background-color: #69696d;
    }

    .inputfile {
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: 1;
        width: 50px;
        height: 50px;
    }

    .inputfile+label {
        font-size: 1.2rem;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
        overflow: hidden;
        width: 50px;
        height: 50px;
        pointer-events: none;
        cursor: pointer;
        line-height: 43px;
        margin: 0px -2px;
        text-align: center;
    }

    .inputfile+label svg {
        fill: #fff;
    }
</style>


<div wire:ignore.self class="modal fade" id="formUsers" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="z-index: 999999999999999999999999999999">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">
                        {{ $componentName }}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
                    </p>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
          
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row m-2">
                            <div class="col-sm-12 col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="card-body">
                                        @if ($selected_id > 0)
                                            <h5 class="font-weight-bolder">{{ $name }}</h5>
                                        @else
                                            <h5 class="font-weight-bolder">Nuevo Usuario</h5>
                                        @endif


                                        @if ($image)
                                            <div class="row">

                                                <div class="container">
                                                    <div class="outer">
                                                        <img src="{{ $image->temporaryUrl()}}">
                                                        <div class="inner">
                                                            <input class="inputfile"  type="file" wire:model='image'
                                                                name="pic" accept="image/*">
                                                            <label>
                                                                <i class="fas fa-camera text-white text-center"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @else
                                            <div class="row">

                                                <div class="container">
                                                    <div class="outer">
                                                        <img src="{{ asset('storage/usuarios/' . $imagen) }}">
                                                        <div class="inner">
                                                            <input class="inputfile" type="file" wire:model='image'
                                                                name="pic" accept="image/*">
                                                            <label class="px-0"><i
                                                                    class="fas fa-camera text-white text-center"></i></label>
                                                        </div>
                                                    </div>
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
                    <div class="col-md-8">
                        <div class="row m-2 mt-6">
                            <div class="col-sm-12 col-md-8">
                                <div class="form-group">
                                    <label> <span class="text-primary">* </span> Nombre</label>
                                    <input type="text" wire:model.lazy="name" class="form-control"
                                        {{ $status == 'LOCKED' ? "disabled='true'" : '' }}>
                                    @error('name')
                                        <span style="font-size: 0.8rem" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label> <span class="text-primary">* </span>Teléfono</label>
                                    <input type="text" wire:model.lazy="phone" class="form-control" maxlength="8"
                                        {{ $status == 'LOCKED' ? "disabled='true'" : ''}}>
                                    @error('phone')
                                        <span style="font-size: 0.8rem" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label> <span class="text-primary">* </span>Email</label>
                                    <input type="text" wire:model.lazy="email" class="form-control"
                                        placeholder="ej: correo@correo.com"
                                        {{ $status == 'LOCKED' ? "disabled='true'" : '' }}>
                                    @error('email')
                                        <span style="font-size: 0.8rem" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    @if ($selected_id == 0)
                                        <label><span class="text-primary">* </span>Contraseña</label>
                                    @else
                                        <label>Nueva contraseña (opcional)</label>
                                    @endif
                                    <input type="password" date-type='currency' wire:model.lazy="password"
                                        class="form-control" {{ $status == 'LOCKED' ? "disabled='true'" : '' }}>
                                    @error('password')
                                        <span style="font-size: 0.8rem" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label> <span class="text-primary">* </span>Asignar rol</label>
                                    <select wire:model='profile' class="form-select"
                                        {{ $status == 'LOCKED' ? "disabled='true'" : '' }}>
                                        <option value="Elegir" disabled selected>Elegir</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('profile')
                                        <span style="font-size: 0.8rem" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                            @if ($selected_id == 0)
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label><span class="text-primary" >* </span>Sucursal</label>
                                        <select wire:model='sucursal_id' class="form-select">
                                            <option value="Elegir" disabled selected>Elegir</option>
                                            @foreach ($sucursales as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('sucursal_id')
                                            <span style="font-size: 0.8rem" class="text-danger">{{ $message }}</span>
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
                                {{-- <span style="color: red; font-size: 0.8rem">* Campos Obligatorios</span> --}}
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
