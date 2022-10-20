<div wire:ignore.self id="modal-mov" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>GENERAR INGRESO / EGRESO</b>
                </h5>
                <button class="close" data-dismiss="modal" type="button" aria-label="Close">
                    <span class="text-white">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <h6>Cartera</h6>
                            <select wire:model='cartera_id_edit' disabled class="form-control">
                                <option value="Elegir" selected disabled>Elegir</option>
                                @foreach ($carterasSucursal as $item)
                                    <option value="{{ $item->id }}">{{ $item->cajaNombre }},
                                        {{ $item->carteraNombre }}</option>
                                @endforeach
                            </select>
                            @error('cartera_id')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <h6>Ingreso / Egreso</h6>
                            <select wire:model='type_edit' class="form-control" disabled>
                                <option value="Elegir" selected disabled>Elegir</option>
                                <option value="EGRESO">EGRESO</option>
                                <option value="INGRESO">INGRESO</option>
                            </select>
                            @error('type')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <h6>Cantidad</h6>
                            <input type="number" wire:model.lazy="cantidad_edit" class="form-control">
                            @error('cantidad_edit')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <h6>Comentario (Obligatorio)</h6>
                            <textarea wire:model.lazy="comentario_edit" class="form-control" name="" rows="2"></textarea>
                            @error('comentario_edit')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div>
                    <a href="javascript:void(0)" class="btn btn-dark" wire:click.prevent="guardarEdicion()">Actualizar</a>
                    <a href="javascript:void(0)" class="btn btn-warning" wire:click.prevent="resetUIedit()">Cancelar</a>
                </div>
             

            </div>


        </div>
    </div>
</div>
