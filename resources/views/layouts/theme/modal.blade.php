<div wire:ignore.self class="modal fade" id="modalUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ajuste de Efectivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
           
                </button>
               
            </div>
            <div class="modal-body">

         
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUnidad()" class="btn btn-warning close-btn text-info"
                    data-dismiss="modal" style="background: #ee761c">CANCELAR</button>
                @if ($selected_id < 1)
                    <button type="button" wire:click.prevent="StoreUnidad()"
                        class="btn btn-warning close-btn text-info">GUARDAR</button>
                @else
                    <button type="button" wire:click.prevent="Update()"
                        class="btn btn-warning close-btn text-info">ACTUALIZAR</button>
                @endif
            
            
            </div>
        </div>
        @include('livewire.products.modalunidad')
        @include('livewire.products.modalmarca')
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('cat-added', msg => {
                $('#modalCategory').modal('hide'),
                noty(msg)
            });
            window.livewire.on('marca-added', msg => {
                $('#modalMarca').modal('hide'),
                noty(msg)
            });
            window.livewire.on('unidad-added', msg => {
                $('#modalUnidad').modal('hide'),
                noty(msg)
            });
            window.livewire.on('subcat-added', msg => {
                $('#modalSubcategory').modal('hide'),
                noty(msg)
            });
            
        });
    
      
</script>
		