<div wire:ignore.self class="modal fade" id="theNewClient" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    Nuevo | Cliente
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Nombre</label>
                            <input type="text" wire:model.lazy="nombre" class="form-control" placeholder="ej: Fenris">
                            @error('nombre') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Cédula</label>
                            <input type="number" wire:model.lazy="cedula" class="form-control" placeholder="12121212" maxlength="10">
                            @error('cedula') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Celular</label>
                            <input type="number" wire:model.lazy="celular" class="form-control" 
                            placeholder="ej: 77889911" maxlength="8">
                            @error('celular') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="number" wire:model.lazy="telefono" class="form-control" 
                            placeholder="ej: 4556677" maxlength="8">
                            @error('telefono') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" wire:model.lazy="email" class="form-control"
                                placeholder="ej: correo@correo.com">
                            @error('email') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Nit</label>
                            <input type="number" wire:model.lazy="nit" class="form-control" placeholder="ej: 12345678">
                            @error('nit') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Razón Social</label>
                            <input type="text" wire:model.lazy="razon_social" class="form-control" placeholder="">
                            @error('razon_social') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Procedencia</label>
                            <select wire:model='procedencia' class="form-select">
                                
                                @foreach ($procedenciaClientes as $item)
                                    @if ($item->procedencia != 'Nuevo')
                                        <option value="{{ $item->id }}">{{ $item->procedencia }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('procedencia') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" wire:click="$emit('modalclient-hide')" class="btn btn-secondary"
                    data-dismiss="modal" style="background: #3b3f5c">CANCELAR</button>
                <button type="button" wire:click.prevent="StoreClient()"
                    class="btn btn-primary">GUARDAR</button>
            </div>
        </div>
    </div>
</div>
