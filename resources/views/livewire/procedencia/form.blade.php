@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label><span class="text-warning">*</span>Procedencia</label>
            <input type="text" wire:model.lazy="procedencia" class="form-control" placeholder="ej: Curso Laravel">
            @error('procedencia')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label><span class="text-warning">*</span>Estado</label>
            <select wire:model='estado_0' class="form-select">
                <option value="Elegir">Elegir</option>
                <option value="Activo">Activo</option>
                <option value="Desactivado">Desactivado</option>
            </select>
            @error('estado_0')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
@include('common.modalFooter')
