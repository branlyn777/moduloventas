<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">{{ $selected_id > 0 ? 'Editar' : 'Crear' }} {{ $componentName }} </h5>
                </div>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label><span class="text-warning">* </span> Nombre del motivo </label>
                            <input type="text" wire:model.lazy="nombre" class="form-control" placeholder="ej: Otro">
                            @error('nombre')
                                <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label><span class="text-warning">* </span> Tipo </label>
                            <select wire:model.lazy="tipo" class="form-select">
                                <option value="Elegir" disabled>Elegir</option>
                                <option value="Retiro">Retiro</option>
                                <option value="Abono">Abono</option>
                            </select>
                            @error('tipo')
                                <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">CANCELAR</button>
                @if ($selected_id < 1)
                    <button wire:click.prevent="Store()" type="button" class="btn btn-primary" style="font-size: 13px">
                        GUARDAR
                    </button>
                @else
                    <button type="button" wire:click.prevent="Update()" class="btn btn-primary"
                        style="font-size: 13px">
                        ACTUALIZAR
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
