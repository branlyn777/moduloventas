@include('common.modalHead')
<div class="row">
    
    <div class="col-12 col-sm-6 col-md-12">
        <div class="form-group">
            <label>Categoría equipo servicio </label>
            <select wire:model.lazy="categoryid" class="form-select">
                <option value="Elegir" disabled selected>Elegir</option>
              
                    @foreach ($cate as $cat)
                        <option value="{{ $cat->id }}" selected>{{ $cat->nombre}}</option>
                    @endforeach
              
            </select>
            @error('categoryid')<p class="text-sm text-danger">{{ $message }}</p>@enderror
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="form-group">
            <label><span class="text-warning">* </span>Nombre</label>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: LG,Samsung,..."
            maxlenght="25">
            @error('name') <p class="text-sm text-danger">{{ $message }}</p> @enderror
        </div>
    </div>
    {{-- <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><h6>Precio</h6></label>
            <input type="text" wire:model.lazy="price" class="form-control" placeholder="ej: 30"
            maxlenght="25">
            @error('price') <span class="text-danger er">{{ $message }}</span>@enderror
        </div>
    </div> --}}

    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <label>Estado</label>
            <select wire:model.lazy="status" class="form-select">
                <option value="Elegir" disabled>Elegir</option>
                <option value="ACTIVE">Activo</option>
                <option value="INACTIVE">Inactivo</option>
            </select>
            @error('status')<p class="text-sm text-danger">{{ $message }}</p>@enderror
        </div>
    </div>
        
    
</div>
@include('common.modalFooter')
