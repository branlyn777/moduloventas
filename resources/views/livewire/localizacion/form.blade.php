<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white">
                    <b>{{$componentName}}</b> | {{$selected_id > 0 ? 'EDITAR':'CREAR'}}
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Aparador</label>
                            <select wire:model='tipo' class="form-control">
                                <option value="Elegir">Elegir</option>
                                <option value="VITRINA">Vitrina</option>
                                <option value="MOSTRADOR">Mostrador</option>
                                <option value="ESTANTE">Estante</option>
                                <option value="OTRO">Otro</option>
                            </select>
                            @error('tipo') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Código</label>



                            <div class="input-group-prepend mb-3">

                                <input type="text" wire:model.lazy="codigo" class="form-control"
                                    placeholder="ej: 012020222">
                                <button type="button" wire:click.prevent="asd()" class="btn btn-info m-0 p-l-0 p-r-0"
                                    title="Generar Codigo">
                                    <i class="fas fa-barcode"></i>
                                </button>
                            </div>
                            @error('codigo') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">



                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea  wire:model.lazy="descripcion" class="form-control"
                                placeholder="ej: Vitrina nueva de 3 niveles"></textarea>
                            @error('descripcion') 
                            <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12 col-md-8">
                        <div class="form-group">
                            <label>Sucursal</label>
                            <select wire:model='destino' class="form-control">
                                <option value="Elegir">Elegir</option>
                                @foreach ($data_suc as $data)

                                <option value="{{$data->id}}">{{ $data->destino}}-{{$data->sucursal}}</option>
                                @endforeach

                            </select>
                            @error('destino') <span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-warning close-btn text-info"
                    data-dismiss="modal" style="background: #ee761c">CANCELAR</button>
                @if ($selected_id < 1) <button type="button" wire:click.prevent="Store()"
                    class="btn btn-warning close-btn text-info">GUARDAR</button>
                    @else
                    <button type="button" wire:click.prevent="Update()"
                        class="btn btn-warning close-btn text-info">ACTUALIZAR</button>
                    @endif


            </div>
        </div>
    </div>
</div>