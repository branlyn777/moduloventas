<div wire:ignore.self id="modal-details" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <div class="modal-header bg-primary">
                <h4 class="text-white text-sm" id="exampleModalLabel">
                    Generar Ingreso/Egreso
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Cartera</label>
                            <select wire:model='cartera_id' class="form-select">
                                <option value="Elegir" selected disabled>Elegir</option>
                                @foreach ($carterasSucursal as $item)
                                    <option value="{{ $item->id }}">{{ $item->cajaNombre }},
                                        {{ $item->carteraNombre }}</option>
                                @endforeach
                            </select>
                            @error('cartera_id')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Ingreso/Egreso</label>
                            <select wire:model='type' class="form-select">
                                <option value="Elegir" selected disabled>Elegir</option>
                                <option value="EGRESO">EGRESO</option>
                                <option value="INGRESO">INGRESO</option>
                            </select>
                            @error('type')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            @if ($this->type != 'Elegir')
                                <label><span class="text-warning">* </span>Categoria</label>
                                <select wire:model='categoria_ie_id' class="form-select">
                                    <option value="Elegir" selected disabled>Elegir</option>
                                    @foreach ($categorias_ie as $c)
                                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('categoria_ie_id')
                                    <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                                @enderror
                            @else
                                <label><span class="text-warning">* </span>Categoria</label>
                                <p class="form-control">---</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Cantidad</label>
                            <input type="number"
                                onkeypress="if(event.keyCode < 46 || event.keyCode > 57 || event.keyCode == 47) event.returnValue = false;"
                                required wire:model.lazy="cantidad" class="form-control">
                            @error('cantidad')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12" style="padding-left: 27px;">
                        @if ($this->categoria_ie_id != 'Elegir')
                            <label>Detalles de la Categoria Seleccionada:</label>
                            <br>
                            @if ($detalle)
                                <label>{{ $detalle }}</label>
                            @else
                                <label>No se puso ningún detalle a la categoria seleccionada</label>
                            @endif


                        @endif
                    </div>




                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Comentario (Obligatorio)</label>
                            <textarea wire:model.lazy="comentario" class="form-control" name="" rows="2"></textarea>
                            @error('comentario')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" wire:click.prevent="resetUI()">Cancelar</button>
                    <button class="btn btn-primary" wire:click.prevent="Generar()">Generar</button>
                </div>

            </div>


        </div>
    </div>
</div>
