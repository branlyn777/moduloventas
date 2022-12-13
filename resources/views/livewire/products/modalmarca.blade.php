<div wire:ignore.self class="modal fade" id="modalMarca" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    <b>Agregar Marca</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body" style="background: #f0ecec">

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Nombre Marca</label>
                            <input type="text" wire:model.lazy="newmarca" class="form-control" placeholder="ejm: Sony"
                                maxlenght="25">
                            @error('newmarca') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background: #f0ecec">
                <button type="button" wire:click.prevent="resetMarca()" class="btn btn-dark close-btn text-info"
                    data-bs-dismiss="modal" style="background: #3b3f5c">Cancelar
                </button>

                <button type="button" wire:click.prevent="StoreMarca()"
                    class="btn btn-dark close-btn text-info">Guardar</button>
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

