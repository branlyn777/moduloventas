@include('common.modalHead')
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="input-group mb-4">
                <span class="input-group-text"><i class="fas fa-edit"></i></span>
                <input type="text" wire:model="permissionName" placeholder="ej: Category_Index" class="form-control" disabled='true'>
            </div>
        </div>
        @error('permissionName')<span class="text-danger er">{{ $message }}</span> @enderror

        <br>
        <div class="input-group">
            <select class="form-select" wire:model.lazy="permissionArea">
                @foreach($areas as $a)
                <option value="{{$a->id}}">{{$a->name}}</option>
                @endforeach
                <option value="Elegir">Elegir</option>
            </select>
        </div>
        @error('permissionArea')<span class="text-danger er">{{ $message }}</span> @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <textarea class="col-12" wire:model.lazy="permissionDescripcion" placeholder="Descripcion del Permiso" maxlength="500" rows="10"></textarea>
        @error('permissionDescripcion')<span class="text-danger er">{{ $message }}</span> @enderror
    </div>
    
</div>
<div class="modal-footer">
    <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
@if ($selected_id < 1)
    <button wire:click.prevent="CreatePermission()" type="button" class="btn btn-primary">  GUARDAR </button>
@else

    <button type="button" wire:click.prevent="UpdatePermission()" class="btn btn-primary"> ACTUALIZAR</button>
@endif

</div>
