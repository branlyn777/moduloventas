@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><span class="text-warning">* </span>
                Nombre de la sucursal
            </label>
            <input type="text" wire:model.lazy="name" class="form-control">
            @error('name')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>
                Teléfono
            </label>
            <input type="number" wire:model.lazy="telefono" class="form-control">
            @error('telefono')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>
                Celular
            </label>
            <input type="number" wire:model.lazy="celular" class="form-control">
            @error('celular')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>
                Número de NIT
            </label>
            <input type="text" wire:model.lazy="nit_id" class="form-control">
            @error('nit_id')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <label><span class="text-warning">* </span>
                Dirección
            </label>
            <input type="text" wire:model.lazy="adress" class="form-control">
            @error('adress')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
@include('common.modalFooter')
