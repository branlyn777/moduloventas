@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Nombre de la caja</label>
            <input type="text" wire:model.lazy="nombre" class="form-control">
            @error('nombre')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    {{-- <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Sucursal</label>
            <select wire:model='sucursal_id' class="form-select">
                <option value="Elegir" disabled selected>Elegir</option>
                @foreach ($sucursales as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('sucursal_id')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div> --}}
</div>
@include('common.modalFooter')
