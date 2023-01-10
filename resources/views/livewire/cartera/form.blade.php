@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><span class="text-warning">* </span>Nombre de la cartera</label>
            <input type="text" wire:model.lazy="nombre" class="form-control">
            @error('nombre')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><span class="text-warning">* </span>Descripción</label>
            <input type="text" wire:model.lazy="descripcion" class="form-control">
            @error('descripcion')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><span class="text-warning">* </span>Tipo</label>
            <select wire:model='tipo' class="form-select">
                <option value="Elegir" disabled selected>Elegir</option>
                <option value="efectivo">EFECTIVO</option>
                <option value="digital">DIGITAL</option>
            </select>
            @error('tipo')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    @if ($variable == 1)
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label><span class="text-warning">* </span>Número de telefono</label>
                <input type="number" wire:model.lazy="telefonoNum" class="form-control">
                @error('telefonoNum')
                    <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                @enderror
            </div>
        </div>
    @endif
    @if ($this->mostrar_caja)
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><span class="text-warning">* </span>Caja</label>
            <select wire:model='caja_id' class="form-select">
                <option value="Elegir" disabled selected>Elegir</option>
                @foreach ($cajas as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </select>
            @error('caja_id')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    @endif
</div>
@include('common.modalFooter')
