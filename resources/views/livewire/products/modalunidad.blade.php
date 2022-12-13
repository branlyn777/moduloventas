<div wire:ignore.self class="modal fade" id="modalUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    <b>Agregar Unidad</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body" style="background: #f0ecec">



                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Nombre Unidad</label>
                            <input type="text" wire:model.lazy="newunidad" class="form-control" placeholder="pieza"
                                maxlenght="25">
                            @error('newunidad') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer" style="background: #f0ecec">
                <button type="button" wire:click.prevent="resetUnidad()" class="btn btn-warning close-btn text-info"
                data-dismiss="modal" style="background: #ee761c">CANCELAR</button>
                <button type="button" wire:click.prevent="StoreUnidad()"
                class="btn btn-warning close-btn text-info">GUARDAR</button>
            </div>
        </div>
    </div>
</div>
<script>
       document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('unidad-added', msg => {
                    $('#modalUnidad').modal('hide'),
                    $('#theModal').modal('show')                    
                });
        
       })
</script>


