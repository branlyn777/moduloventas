@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><span class="text-warning">* </span>Nombre de la caja</label>
            <input type="text" wire:model.lazy="nombre" class="form-control">
            @error('nombre')
                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    @if ($this->mostrar_sucursal)
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label><span class="text-warning">* </span>Sucursal</label>
                <select wire:model='sucursal_id' class="form-select">
                    <option value="Elegir" disabled selected>Elegir</option>
                    @foreach ($sucursales as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('sucursal_id')
                    <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                @enderror
            </div>
        </div>
    @endif

</div>
@include('common.modalFooter')
