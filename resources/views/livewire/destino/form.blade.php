<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">{{$selected_id > 0 ? 'Editar':'Crear'}} {{$componentName}} </h5>
                </div>
                {{-- <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    {{$componentName}}</b> | {{$selected_id > 0 ? 'EDITAR':'CREAR'}}
                </h1> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-12 col-sm-6 col-md-12">
                        <div class="form-group">
                            <label>Destino</label>
                            <input type="text" wire:model.lazy="nombre" class="form-control" placeholder="Nombre de la estancia depósito, tienda, almacén, bodega"
                            maxlenght="25">
                            @error('name') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-12">
                        <div class="form-group">
                            <label>Observación</label>
                            <textarea wire:model.lazy="observacion" placeholder="Ingrese las caracteristicas de la categoría" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            @error('name') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    @if($this->verificar)

                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Sucursal</label>
                            <select wire:model='sucursal' class="form-control">
                                <option value="Elegir">Elegir</option>
                                @foreach ($sucursales as $s)
                                
                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            @if ($selected_id != 0)
                            <label>Estado</label>
                            <select wire:model='estadosmodal' class="form-control">
                                <option value="Elegir" disabled>Elegir</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                                @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
                            @endif
                        </div>
                    </div>
                    @endif 
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                    @if ($selected_id < 1)
                        <button wire:click.prevent="Store()" type="button" class="btn btn-primary" style="font-size: 13px">
                            GUARDAR
                        </button>
                    @else
                        <button type="button" wire:click.prevent="Update()" class="btn btn-primary" style="font-size: 13px">
                            ACTUALIZAR
                        </button>
                    @endif
            </div>
        </div>
    </div>
</div>