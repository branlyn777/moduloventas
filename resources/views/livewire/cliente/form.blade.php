@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" wire:model.lazy="nombre" class="form-control" placeholder="ej: Fenris">
            @error('nombre')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Cédula</label>
            <input type="text" wire:model.lazy="cedula" class="form-control" placeholder="12121212">
            @error('cedula')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Celular</label>
            <input type="text" wire:model.lazy="celular" class="form-control" placeholder="ej: 79564859"
                maxlength="8">
            @error('celular')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Email</label>
            <input type="text" wire:model.lazy="email" class="form-control" placeholder="ej: correo@correo.com">
            @error('email')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Fecha de Nacimiento</label>
            <input type="date" wire:model.lazy="fnacim" class="form-control" placeholder="Click para elegir">
            @error('fnacim')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" date-type='currency' wire:model.lazy="direccion" class="form-control"
                placeholder="ej: Av. Ayacucho">
            @error('direccion')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Nit</label>
            <input type="text" date-type='currency' wire:model.lazy="nit" class="form-control"
                placeholder="ej: 1515151515">
            @error('nit')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Razón Social</label>
            <input type="text" date-type='currency' wire:model.lazy="razonsocial" class="form-control"
                placeholder="ej: S.A.">
            @error('razonsocial')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Procedencia</label>
            <select wire:model='procedencia' class="form-select">
                <option value="Elegir">Elegir</option>
                @foreach ($procedenciaClientes as $item)
                <option value="{{ $item->id }}">{{ $item->procedencia }}</option>
                @endforeach
            </select>
            @error('procedencia')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')
