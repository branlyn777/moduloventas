<div wire:ignore.self class="modal fade" id="modalMarca" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">Agregar Marca</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Nombre Marca</label>
                            <input type="text" wire:model.lazy="newmarca" class="form-control" placeholder="ejm: Sony"
                                maxlenght="25">
                            @error('newmarca') <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetMarca()" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">CANCELAR</button>
                <button wire:click.prevent="StoreMarca()" type="button" class="btn btn-primary"
                    style="font-size: 13px">GUARDAR</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('marca-added', msg => {
            $('#modalMarca').modal('hide'),
            $('#theModal').modal('show')                    
        });
    })
</script>