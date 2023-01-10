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
                            <h6>Cartera</h6>
                            <select wire:model='cartera_id' class="form-select">
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
                            <select wire:model='type' class="form-select">
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
                            @if ($this->type != 'Elegir')
                                <h6>Categoria</h6>
                                <select wire:model='categoria_ie_id' class="form-select">
                                    <option value="Elegir" selected disabled>Elegir</option>
                                    @foreach ($categorias_ie as $c)
                                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('categoria_ie_id')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            @else
                                <h6>Categoria</h6>
                                <p class="form-control">---</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <h6>Cantidad</h6>
                            <input type="number" wire:model.lazy="cantidad" class="form-control">
                            @error('cantidad')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12" style="padding-left: 27px;">
                        @if ($this->categoria_ie_id != 'Elegir')
                            <b>Detalles de la Categoria Seleccionada:</b>
                            <br>
                            @if ($detalle)
                                {{ $detalle }}
                            @else
                                No se puso ningún detalle a la categoria seleccionada
                            @endif


                        @endif
                    </div>




                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <h6><b>Comentario (Obligatorio)</b></h6>
                            <textarea wire:model.lazy="comentario" class="form-control" name="" rows="2"></textarea>
                            @error('comentario')
                                <span class="text-danger er">{{ $message }}</span>
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
