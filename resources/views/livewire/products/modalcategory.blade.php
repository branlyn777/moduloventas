<div wire:ignore.self class="modal fade" id="modalCategory" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">Crear Categoria</h5>
                </div>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Nombre </label>
                            <input type="text" wire:model.lazy="name" class="form-control"
                                placeholder="ej: Impresoras">
                            @error('name') <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <label>Descripcion</label>
                            <input type="text" wire:model.lazy="descripcion" class="form-control"
                                placeholder="ej: breve descripcion">
                            @error('descripcion') <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>@enderror
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetCategory()" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">CANCELAR</button>
                <button wire:click.prevent="StoreCategory()" type="button" class="btn btn-primary"
                    style="font-size: 13px">GUARDAR</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('cat-added', msg => {
            $('#modalCategory').modal('hide'),
            $('#theModal').modal('show')
        });
    })
</script>