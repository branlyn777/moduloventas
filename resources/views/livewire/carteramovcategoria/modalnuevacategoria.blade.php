@include('common.modalHead')
<div class="row">
    <div class="col-sm-12">
      <h5 class="modal-title" id="exampleModalLongTitle">
        @if($this->categoria_id == null)
        Crear Categoria
        @else
        Actualizar Categoria
        @endif
      </h5>
        <div class="form-group">
          <h6>Nombre Categoria</h6>
            <div class="input-group mb-4">
                <span class="input-group-text"><i class="fas fa-edit"></i></span>
                <input type="text" wire:model="nombrecategoria" placeholder="Ingrese nombre de la categoria" class="form-control ">
            </div>
        </div>
        @error('nombrecategoria')<span class="text-danger er">{{ $message }}</span> @enderror


        <div class="row">
          <h6>Detalle Categoria</h6>
          <div class="col-12">
              <textarea class="col-12" wire:model.lazy="detallecategoria" placeholder="Ingrese las caracteristicas de la categoria" maxlength="500" rows="10"></textarea>
          </div>
        </div>


        <div class="form-group">
          <label for="exampleFormControlInput1">Tipo</label>
          <select wire:model="tipo" class="form-control" aria-label="Default select example">
            <option value="Elegir">Seleccione a donde irá la categoria</option>
            <option value="INGRESO">INGRESO</option>
            <option value="EGRESO">EGRESO</option>
          </select>
        </div>
        @error('tipo')<span class="text-danger er">{{ $message }}</span>@enderror
    </div>
</div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
@if ($this->categoria_id == null)
    <button wire:click.prevent="save()" type="button" class="btn btn-primary">  GUARDAR </button>
@else

    <button type="button" wire:click.prevent="update()" class="btn btn-primary"> ACTUALIZAR</button>
@endif

</div>