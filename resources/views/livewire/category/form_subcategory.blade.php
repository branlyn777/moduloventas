<div wire:ignore.self class="modal fade" id="theModal_s" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    <b>{{$componentSub}}</b> | {{$selected_id > 0 ? 'EDITAR':'CREAR'}}
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> Nombre </label>
                            <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Impresoras">
                            @error('name')<span class="text-danger er" style="font-size: 13px">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <input type="text" wire:model.lazy="descripcion" class="form-control" placeholder="ej: breve descripcion de la subcategoria">
                            @error('descripcion')<span class="text-danger er" style="font-size: 13px">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                @if ($selected_id < 1) 
                    <button type="button" wire:click.prevent="Store_Subcategoria()"
                        class="btn btn-primary">Guardar</button>
                @else
                    <button type="button" wire:click.prevent="Update()" class="btn btn-primary">Actualizar</button>
                @endif
            </div>
        </div>
    </div>
</div>