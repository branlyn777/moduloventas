@include('common.modalHead')
<div class="row">
    <div class="col-12 col-sm-6 col-md-12">
        <div class="form-group">
            <div class="input-group-prepend">
                <label><span class="text-warning">* </span>Nombre </label>
            </div>
            <input type="text" wire:model.lazy="nombre" class="form-control" placeholder="ej: TV,PORTATIL,CELULAR">
        </div>
        @error('nombre')<span class="text-danger er">{{ $message }}</span> @enderror
    </div>
    <div class="col-sm-12 mt-3">
        <div class="form-group">
            <label>Estado</label>
            <select wire:model.lazy="estado" class="form-select">
                <option value="Elegir" disabled>Elegir</option>
                <option value="ACTIVO">Activo</option>
                <option value="INACTIVO">Inactivo</option>
            </select>
            @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
        </div>
    </div>
</div>
@include('common.modalFooter')
