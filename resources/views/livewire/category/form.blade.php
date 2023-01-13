<div wire:ignore.self class="modal fade" id="theModalCategory" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">{{ $selected_id > 0 ? 'Editar' : 'Crear' }}
                        {{ $componentName }} </h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label><span class="text-warning">* </span> Nombre </label>
                            <input type="text" wire:model="name" class="form-control" placeholder="ej: Impresoras">
                            @error('name')
                                <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Descripción</label>
                            <input type="text" wire:model="descripcion" class="form-control"
                                placeholder="ej: Breve descripción">
                            @error('descripcion')
                                <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if ($selected_id != null)
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Estado</label>
                            <div class="form-group">
                              <select class="form-select" wire:model="estadocategoria">
                                <option value="ACTIVO">Activo</option>
                                <option value="INACTIVO">Inactivo</option>
                            
                              </select>
                            </div>
                          
                            @error('estadocategoria')
                                <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @endif
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">CANCELAR</button>
                @if ($selected_id < 1)
                    <button wire:click.prevent="Store()" type="button" class="btn btn-primary" style="font-size: 13px">
                        GUARDAR
                    </button>
                @else
                    <button type="button" wire:click.prevent="Update()" class="btn btn-primary"
                        style="font-size: 13px">
                        ACTUALIZAR
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
