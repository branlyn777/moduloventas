
<div wire:ignore.self class="modal fade" id="modalbuscarcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                <p class="text-sm mb-0">
                    Buscar Cliente
                </p>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                
                <div class="col-sm-12">
                    
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                            <input type="text" wire:model="buscarcliente" placeholder="Buscar o Crear Cliente..." class="form-control ">
                        </div>
                    </div>
                    <br>
                    <div class="table-wrapper">
                        @if(strlen($this->buscarcliente) > 0)
                        <table>
                            <thead>
                                @if($listaclientes->count() > 0)
                                <tr>
                                    <th class="text-center">
                                        <p class="text-sm mb-0">
                                            <b>Nombre Cliente</b>
                                        </p>
                                    </th>
                                    <th class="text-center">
                                        <p class="text-sm mb-0">
                                            <b>Seleccionar</b>
                                        </p>
                                    </th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                @forelse ($listaclientes as $lc)
                                <tr>
                                    <td class="text-left">
                                        <p class="text-sm mb-0">
                                            {{ ucwords(strtolower($lc->nombre)) }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <button title="Seleccionar Cliente" wire:click.prevent="seleccionarcliente({{ $lc->id }})" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty

                                <tr class="text-center">
                                    <td colspan="2">
                                        <br>
                                        <div class="row">

    

                                            <div class="col-sm-6">
                                                <label for="validationTooltip01">
                                                    <p class="text-sm mb-0">
                                                        <b>CI</b>
                                                    </p>
                                                </label>
                                                <input wire:model.lazy="cliente_ci" class="form-control" type="text" placeholder="Opcional...">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="validationTooltipUsername">
                                                    <p class="text-sm mb-0">
                                                        <b>Celular</b>
                                                    </p>
                                                </label>
                                                <input wire:model.lazy="cliente_celular" class="form-control" type="number" placeholder="Opcional...">
                                            </div>
                                            <div class="col-sm-12">
                                                <br>
                                                <label for="validationTooltipUsername">
                                                    <p class="text-sm mb-0">
                                                        <b>Procedencia Cliente</b>
                                                    </p>
                                                </label>
                                                <select wire:model="procedencia_cliente_id" class="form-select">
                                                    <option value="Elegir">Elegir</option>
                                                    @foreach($this->procedencias as $p)
                                                    <option value="{{$p->id}}">{{$p->procedencia}}</option>
                                                    @endforeach
                                                </select>
                                                @error('procedencia_cliente_id') <span class="text-danger er">{{ $message }}</span>@enderror
                                            </div>


                                            


                                            <div class="col-sm-12">
                                                <br>
                                                <button class="btn btn-primary" wire:click.prevent="crearcliente()">
                                                    <p class="text-sm mb-0">
                                                        Crear y Usar: {{$this->buscarcliente}}
                                                    </p>
                                                </button>
                                            </div>





                                        </div>

                                        <br>

                                    </td>
                                </tr>
                                @endforelse





                            </tbody>
                        </table>
                        @endif
                    </div>

                </div>
            </div>
        </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar Ventana</button> --}}
            </div>
            <br>
        </div>
    </div>
</div>