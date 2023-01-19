<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">{{$selected_id > 0 ? 'Editar':'Crear'}} {{$componentName}} </h5>
                </div>
                {{-- <h6 class="text-center text-light" wire:loading>POR FAVOR ESPERE</h6> --}}
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Aparador</label>
                            <select wire:model='tipo' class="form-control">
                                <option value="Elegir">Elegir</option>
                                <option value="VITRINA">Vitrina</option>
                                <option value="MOSTRADOR">Mostrador</option>
                                <option value="ESTANTE">Estante</option>
                                <option value="OTRO">Otro</option>
                            </select>
                            @error('tipo') <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Código</label>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <input type="text" wire:model.lazy="codigo" class="form-control" placeholder="ej: 012020222">
                                <button type="button" wire:click.prevent="asd()" class="btn btn-primary m-0 p-l-0 p-r-0"
                                    title="Generar Codigo">
                                    <i class="fas fa-barcode"></i>
                                </button>
                            </div>
                            {{-- <div class="input-group-prepend mb-3">
                                <input type="text" wire:model.lazy="codigo" class="form-control"
                                    placeholder="ej: 012020222">
                                <button type="button" wire:click.prevent="asd()" class="btn btn-info m-0 p-l-0 p-r-0"
                                    title="Generar Codigo">
                                    <i class="fas fa-barcode"></i>
                                </button>
                            </div> --}}
                            @error('codigo') <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Descripción</label>
                            <textarea  wire:model.lazy="descripcion" class="form-control"
                                placeholder="ej: Vitrina nueva de 3 niveles"></textarea>
                            @error('descripcion') 
                            <span class="text-danger" style="font-size: 0.8rem">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Sucursal</label>
                            <select wire:model='destino' class="form-control">
                                <option value="Elegir">Elegir</option>
                                @foreach ($data_suc as $data)

                                <option value="{{$data->id}}">{{ $data->destino}}-{{$data->sucursal}}</option>
                                @endforeach

                            </select>
                            @error('destino') <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                @if ($selected_id < 1)
                    <button wire:click.prevent="Store()" type="button" class="btn btn-primary" style="font-size: 0.8rem">
                        GUARDAR
                    </button>
                @else
                    <button type="button" wire:click.prevent="Update()" class="btn btn-primary" style="font-size: 0.8rem">
                        ACTUALIZAR
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>