@include('common.modalHead')
<div class="row">
   
        <div class=" col-sm-12 col-md-6 col-lg-6 form-group">
            <label>Nombre</label>
            <input type="text" wire:model.lazy="nombre_prov" class="form-control" placeholder=""
            maxlenght="25">
            @error('nombre_prov') <span class="text-danger er">{{ $message }}</span>@enderror
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 form-group">
            <label>Apellidos</label>
            <input type="text" wire:model.lazy="apellido" class="form-control" placeholder=""
            maxlenght="25">
            @error('apellido') <span class="text-danger er">{{ $message }}</span>@enderror
        </div>
        <div class=" col-sm-12 col-md-6 col-lg-6 form-group">
            <label>Direccion</label>
            <input type="text" wire:model.lazy="direccion" class="form-control" placeholder=""
            maxlenght="25">
            @error('direccion') <span class="text-danger er">{{ $message }}</span>@enderror
        </div>
        <div class=" col-sm-12 col-md-6 col-lg-6 form-group">
            <label>NIT</label>
            <input type="text" wire:model.lazy="nit" class="form-control" placeholder=""
            maxlenght="25">
            @error('nit') <span class="text-danger er">{{ $message }}</span>@enderror
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 form-group">
            <label>Correo</label>
            <input type="text" wire:model.lazy="correo" class="form-control" placeholder=""
            maxlenght="25">
            @error('correo') <span class="text-danger er">{{ $message }}</span>@enderror
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 form-group">
            <label>Telefono</label>
            <input type="text" wire:model.lazy="telefono" class="form-control" placeholder=""
            maxlenght="25">
            @error('telefono') <span class="text-danger er">{{ $message }}</span>@enderror
        </div>
        @if ($selected_id != 0)
                  
        <div class="col-sm-12 col-md-6 form-group">
            
                <label>Estado</label>
                <select wire:model='estado' class="form-control">
                    <option value="Elegir" disabled>Elegir</option>
                    <option value="ACTIVO">ACTIVO</option>
                    <option value="INACTIVO">INACTIVO</option>
                </select>
                @error('estado') <span class="text-danger er">{{ $message }}</span>@enderror
            
        </div>
            @endif
        
        <div class="col-sm-12 col-md-11 col-lg-11 form-group">
            <label> <b> Subir Imagen</b></label>
            <div class="custom-file mt-4 p-1">
                <label class="custom-file p-0">

                    <input type="file" wire:model="image" class="form-control custom-file" style="padding-top:0.4rem"
                        accept="image/x-png,image/gif,image/jpeg" class="custom-file-input" id="inputGroupFile03">
                    </label>
                    <div wire:loading wire:target="image" wire:key="image"><i class="fa fa-spinner fa-spin mt-2 ml-2"></i> Subiendo...</div>
            </div>
            @if ($image)
            <center><img src="{{ $image->temporaryUrl() }}" width="100" alt="" class="mt-2"></center>
        @endif
        </div>



      


        


    
</div>
@include('common.modalFooter')