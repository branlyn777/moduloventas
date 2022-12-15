@include('common.modalHead')
<div class="row">

    <div class="col-12 col-sm-6 col-md-12">
        <div class="form-group">
            <label>Destino</label>
            <input type="text" wire:model.lazy="nombre" class="form-control"
                placeholder="Nombre de la estancia deposito, tienda, almacen, bodega" maxlenght="25">
            @error('name') <span class="text-danger er">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-12">
        <div class="form-group">
            <label>Observacion</label>
            <textarea wire:model.lazy="observacion" placeholder="Ingrese las caracteristicas de la categoria"
                class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            @error('name') <span class="text-danger er">{{ $message }}</span>@enderror
        </div>
    </div>

    @if($this->verificar)

    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <label>Sucursal</label>
            <select wire:model='sucursal' class="form-control">
                <option value="Elegir">Elegir</option>
                @foreach ($sucursales as $s)

                <option value="{{$s->id}}">{{$s->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            @if ($selected_id != 0)
            <label>Estado</label>
            <select wire:model='estadosmodal' class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                <option value="ACTIVO">ACTIVO</option>
                <option value="INACTIVO">INACTIVO</option>
            </select>
            @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
            @endif
        </div>
    </div>
    @endif
</div>
@include('common.modalFooter')