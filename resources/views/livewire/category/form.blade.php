<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">{{$selected_id > 0 ? 'Editar':'Crear'}} {{$componentName}} </h5>
                    {{-- {{$componentName}}</b> | {{$selected_id > 0 ? 'EDITAR':'CREAR'}} --}}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> Nombre </label>
                            <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Impresoras">
                            @error('name')<span class="text-danger er" style="font-size: 13px">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <input type="text" wire:model.lazy="descripcion" class="form-control" placeholder="ej: breve descripcion">
                            @error('descripcion')<span class="text-danger er" style="font-size: 13px">{{ $message }}</span> @enderror
                        </div> 
                    </div>
                    {{-- @if ($selected_id !=0)
                    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Estado</label>
                            <select wire:model='estado' class="form-control">
                                <option value="Elegir" disabled>Elegir</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                            @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    @endif --}}
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
