<div wire:ignore.self class="modal fade" id="marca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">{{$this->selected_id_marca > 0 ? 'Editar':'Crear'}} Marca </p>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Nombre Marca</label>
                            <input type="text" wire:model.lazy="nombre_marca" class="form-control" placeholder="ejm: Sony"
                            maxlenght="25">
                            @error('nombre_marca') <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetUI_marca()" type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-size: 0.8rem">CANCELAR</button>
                @if ($this->selected_id_marca < 1)
                    <button wire:click.prevent="Store_marca()" type="button" class="btn btn-primary" style="font-size: 0.8rem">
                        GUARDAR
                    </button>
                @else
                    <button type="button" wire:click.prevent="Update_marca()" class="btn btn-primary" style="font-size: 0.8rem">
                        ACTUALIZAR
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>