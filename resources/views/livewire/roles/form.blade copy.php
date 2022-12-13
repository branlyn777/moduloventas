<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white">
                    <b>{{ $componentName }}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="fas fa-edit"></span>
                                </span>
                            </div>
                            <input type="text" wire:model.lazy="roleName" class="form-control" placeholder="ej: Admin"
                                maxlength="255">
                        </div>
                        @error('roleName')
                            <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                @if ($selected_id < 1)
                    
                        

                        <button wire:click.prevent="CreateRole()" type="button" class="btn btn-primary">  GUARDAR </button>
                @else

                        <button type="button" wire:click.prevent="UpdateRole()" class="btn btn-primary"> ACTUALIZAR</button>
                @endif

            </div>
        </div>
    </div>
</div>




</div>
    <div class="modal-footer">
      <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
        @if ($selected_id < 1)
        <button wire:click.prevent="Store()" type="button" class="btn btn-primary">
            GUARDAR
        </button>
        @else
        <button type="button" wire:click.prevent="Update()" class="btn btn-primary">
            ACTUALIZAR
        </button>
        @endif
    </div>
  </div>
</div>
</div>