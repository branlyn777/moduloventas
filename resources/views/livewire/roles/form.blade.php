@include('common.modalHead')
<div class="row">
    <div class="col-12 col-sm-6 col-md-12">
        <div class="form-group">
            <label><span class="text-warning">* </span>Nombre Rol</label>
            <input type="text" wire:model.lazy="roleName" class="form-control" placeholder="ej: Admin">
            @error('roleName')
                <span style="font-size: 0.8rem" class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label>Descripción</label>
        <div class="form-group">
            <div class="input-group mb-4">
                <textarea type="text" wire:model="descripcion" placeholder="ej: Descripción de Rol" class="form-control "></textarea>
            </div>
        </div>
        @error('descripcion')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="modal-footer">
    <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary"
        data-bs-dismiss="modal">CANCELAR</button>
    @if ($selected_id < 1)
        <button wire:click.prevent="CreateRole()" type="button" class="btn btn-primary"> GUARDAR </button>
    @else
        <button type="button" wire:click.prevent="UpdateRole()" class="btn btn-primary"> ACTUALIZAR</button>
    @endif

</div>
