<div wire:ignore.self class="modal fade" id="ajusteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">Ajustar Cantidad</h5>
                </div>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col">
                        <div class="form-group text-center align-middle">
                            <label>Cantidad Actual Sistema</label>
                            <h5>50</h5>
                            
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Nuevo Recuento Fisico</label>
                            <input type="number" wire:model.lazy="nuevo_cantidad" class="form-control">
                            @error('nuevo_cantidad')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetAjuste" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancelar</button>
                <button wire:click.prevent="guardarAjuste()" type="button" class="btn btn-primary"
                    style="font-size: 13px">Guardar Ajuste</button>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('unidad-added', msg => {
            $('#modalUnidad').modal('hide'),
                $('#theModal').modal('show')
        });
    })
</script> --}}