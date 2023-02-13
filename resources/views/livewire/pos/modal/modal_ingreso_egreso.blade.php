<div wire:ignore.self class="modal fade" id="modalingresoegreso" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">
                        <b>INGRESO Y EGRESO</b>
                    </p>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <label>CARTERA</label>
                        <select wire:model="cartera_id_ie" class="form-select">
                            <option value="Elegir">Seleccionar</option>
                            @foreach ($carteras as $c)
                                <option value="{{ $c->idcartera }}">
                                    {{ $c->nombrecartera }} - {{ $c->dc }}
                                </option>
                            @endforeach
                            @foreach ($carterasg as $g)
                                <option value="{{ $g->idcartera }}">
                                    {{ $g->nombrecartera }} - {{ $g->dc }}
                                </option>
                            @endforeach
                        </select>
                        @error('cartera_id_ie')
                            <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <label>INGRESO/EGRESO</label>
                        <select wire:model="tipo_movimiento_ie" class="form-select">
                            <option value="Elegir">Seleccionar</option>
                            <option value="INGRESO">INGRESO</option>
                            <option value="EGRESO">EGRESO</option>
                        </select>
                        @error('tipo_movimiento_ie')
                            <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <label>CATEGORIA</label>
                        @if($tipo_movimiento_ie == "Elegir")
                        <select wire:model="categoria_id_ie" class="form-select" disabled>
                            
                        </select>
                        @else
                        <select wire:model="categoria_id_ie" class="form-select">
                            <option value="Elegir" selected>Seleccionar</option>
                            @foreach($categorias_ie as $c)
                                @if($c->id != 1 && $c->id != 2)
                                <option value="{{$c->id}}">{{$c->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                        @endif
                        @error('categoria_id_ie')
                            <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <label for="">CANTIDAD</label>
                        <input wire:model.lazy="cantidad_ie" class="form-control" type="number">
                        @error('cantidad_ie')
                            <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 text-center">
                        <div style="border: 2px solid #5e72e449; border-radius: 15px; padding: 5px; height: 100px;">
                            @if($this->categoria_id_ie == "Elegir" || $tipo_movimiento_ie == "Elegir")
                            Aquí aparecerá una breve descripción perteneciente a la categoria seleccionada
                            @else
                                {{$this->detallecategoria}}
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="">COMENTARIO (Obligatorio)</label>
                        <textarea wire:model.lazy="comentario" placeholder="Ingrese el motivo del ingreso o egreso" class="form-control"
                            id="exampleFormControlTextarea1" rows="3"></textarea>
                        @error('comentario')
                            <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="generar()" type="button" class="btn btn-primary">
                    @if($tipo_movimiento_ie == "Elegir")
                    Generar
                    @else
                    GENERAR {{$tipo_movimiento_ie}}
                    @endif
                </button>
            </div>
        </div>
    </div>
</div>
