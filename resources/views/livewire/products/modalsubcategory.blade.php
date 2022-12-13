<div wire:ignore.self class="modal fade" id="modalSubcategory" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
          <h5 class="modal-title text-white">
              <b>Agregar Subcategoria</b>
          </h5>
          <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
        </div>
        <div class="modal-body">

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
             <label> Nombre </label>
            <input type="text" wire:model.lazy="subcategory" class="form-control" placeholder="ej: REPUESTOS">
        </div>
        @error('subcategory')<span class="text-danger er">{{ $message }}</span> @enderror
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label>Descripcion</label>
            <input type="text" wire:model.lazy="des_subcategory" class="form-control" placeholder="ej: breve descripcion de la subcategoria">
        </div>
        @error('des_subcategory')<span class="text-danger er">{{ $message }}</span> @enderror
    </div>
</div>
</div>
        <div class="modal-footer" style="background: #f0ecec">
            <button type="button" wire:click.prevent="resetSubCat()" class="btn btn-dark close-btn text-info"
                data-dismiss="modal" style="background: #3b3f5c">CANCELAR</button>
         
                <button type="button" wire:click.prevent="StoreSubcategory()"
                    class="btn btn-dark close-btn text-info">GUARDAR</button>
            </div>
        </div>
   </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
     window.livewire.on('subcat-added', msg => {
                 $('#modalSubcategory').modal('hide'),
                 $('#theModal').modal('show')                    
             });
     
    })
</script>

