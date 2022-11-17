@include('common.modalHead')
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
          
             <label> Nombre </label>
            
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Impresoras">
        </div>
        @error('name')<span class="text-danger er">{{ $message }}</span> @enderror
    </div>


    <div class="col-lg-12">
        <div class="form-group">
            
            <label>Descripcion</label>
          
            
            <input type="text" wire:model.lazy="descripcion" class="form-control" placeholder="ej: breve descripcion">
        </div>
        @error('descripcion')<span class="text-danger er">{{ $message }}</span> @enderror
    </div>
    {{-- @if ($selected_id !=0)
                
    <div class="col-lg-12">
        <div class="form-group">
            <label>Estado</label>
            <select wire:model='estado' class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                <option value="ACTIVO">ACTIVO</option>
                <option value="INACTIVO">INACTIVO</option>
            </select>
            @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
        </div>
    </div>
    @endif --}}
</div>

@include('common.modalFooter')
