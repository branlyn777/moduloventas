<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">{{$selected_id > 0 ? 'Editar':'Crear'}} {{$componentName}}</p>
                </h1>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Nombre Marca</label>
                            <input type="text" wire:model.lazy="nombre" class="form-control" placeholder="ejm: Sony"
                            maxlenght="25">
                            @error('nombre') <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-size: 0.8rem">CANCELAR</button>
                @if ($selected_id < 1)
                    <button wire:click.prevent="Store()" type="button" class="btn btn-primary" style="font-size: 0.8rem">
                        GUARDAR
                    </button>
                @else
                    <button type="button" wire:click.prevent="Update()" class="btn btn-primary" style="font-size: 0.8rem">
                        ACTUALIZAR
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>